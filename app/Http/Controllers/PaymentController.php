<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans;
use App\Order;
use App\Invoice;
use App\Package;
use App\Promo;
use App\ServiceExtras;
use App\User;
use Storage;
use Illuminate\Support\Str;
use illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewOrderNotification;

class PaymentController extends Controller
{
    public function orderPayment($id, Request $request)
    {
        /**
         * request parameter [
         * user_id, 
         * promo_code, 
         * brief_file, 
         * extras, 
         * agent_id, 
         * message_agent, 
         * quantity
         * ]
         */
        // security level very low need to be fixed later
        $user = User::findOrFail($request->user_id);
        $package = Package::findOrFail($id);
        $order = new Order;
        $quantity = intval($request->quantity);
        $budget = $request->grand_total;
        // $budget = $package->price * $quantity;
        // if (!empty($request->promo_code)) {
        //     $promo = Promo::where('code' , $request->promo_code)->get();
        //     $budget -= $budget * $promo->discount / 100;
        //     $order->promo_id = $promo->id;
        // }
        // if ($request->hasFile('brief_file')) {
        //     $order->attachment = $request->file('brief_file')->store('public/files');
        // }
        // if ($request->has('extras')) {
        //     $order->extras = $request->extras;
        //     foreach(json_decode($order->extras) as $extras_id){
        //         $budget += ServiceExtras::findOrFail($extras_id)->price;
        //     }
        // }
        $order->agent_id = intval($request->agent_id);
        $order->package_id = $package->id;
        $order->status = 'unpaid';
        $order->request = $request->message_agent;
        $order->budget = $budget;
        $order->user_id = $user->id;
        $order->quantity = $quantity;
        $order->extras = $request->extras;
        $order->save();
        // var_dump($order);die;
        // midtrans
        $transaction_details = [
            'order_id' => $order->id,
            // 'order_id' => time(), // only for testing
            'gross_amount' => $order->budget
        ];

        $customer_details = [
            'first_name' => $user->name,
            'email' => $user->email,
            'phone' => !empty($user->profile) ? $user->profile->handphone : ''
        ];

        $item_details = [
            [
                'id' => $package->id,
                'quantity' => $request->quantity,
                'name' => $package->service->title . '-' . $package->title,
                'price' => $package->price
            ]
        ];

        if (!empty($order->extras)) {
            foreach(json_decode($order->extras) as $extras_id){
                $extras = ServiceExtras::findOrFail($extras_id);
                $extras_data = [
                    'id' => $extras->id,
                    'quantity' => 1,
                    'name' => Str::words($extras->name, 3, '...'),
                    'price' => $extras->price
                ];
                array_push($item_details, $extras_data);
            }
        }

        if ($request->token_usage > 0){
            $token_data = [
                'id' => 'token',
                'quantity' => 1,
                'name' => 'subscription token',
                'price' => -($request->token_usage * 10000)
            ];
            array_push($item_details, $token_data);
        }

        if ($request->promo_discount > 0) {
            $promo_data = [
                'id' => 'discount',
                'quantity' => 1,
                'name' => 'promo discount',
                'price' => -($request->promo_discount)
            ];
            array_push($item_details, $promo_data);
        }

        // Send this options if you use 3Ds in credit card request
        $credit_card_option = [
            'secure' => true,
            'channel' => 'migs'
        ];

        $transaction_data = [
            'transaction_details' => $transaction_details,
            'item_details' => $item_details,
            'customer_details' => $customer_details,
            'credit_card' => $credit_card_option,
        ];
        try {
            $token = Midtrans::getSnapToken($transaction_data);
            $data = ['token' => $token, 'status'=>'success'];
            $invoice = new Invoice;
            $invoice->payment_token = $token;
            $invoice->order_id = $order->id;
            $invoice->save();
            $order->invoice_id = $invoice->id;
            $order->save();
        } catch (\Throwable $th) {
            $data = ['status' => 'error'];
        }
        return $data;
    }

    public function notification(Request $notif)
    {
        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $orderId = $notif->order_id;
        $fraud = $notif->fraud_status;
        $invoice = Invoice::where('order_id', $orderId);
        $invoice->payment_type = $type;
        if ($transaction == 'capture') {
            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($type == 'credit_card') {
                if($fraud == 'challenge') {
                    // TODO set payment status in merchant's database to 'Challenge by FDS'
                    // TODO merchant should decide whether this transaction is authorized or not in MAP
                    $invoice->setPending();
                } else {
                    // TODO set payment status in merchant's database to 'Success'
                    $invoice->setSuccess();
                    $order = $invoice->order;
                    foreach(json_decode($order->extras) as $extras_id) {
                        $extras = ServiceExtras::findOrFail($extras_id);
                        if ($extras->is_template) {
                            if ($extras->template->effect == 'duration-1') {
                                $order->deadline = Carbon::now()->addDays($package->duration - 1);
                            }
                        }
                    }
                    $order->status = 'process';
                    $order->save();
                    Mail::to($order->agent->email)->send(new NewOrderNotification($order));
                }
            }
        } elseif ($transaction == 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
            $invoice->setSuccess();
            $order = $invoice->order;
            foreach(json_decode($order->extras) as $extras_id) {
                $extras = ServiceExtras::findOrFail($extras_id);
                if ($extras->is_template) {
                    if ($extras->template->effect == 'duration-1') {
                        $order->deadline = Carbon::now()->addDays($package->duration - 1);
                    }
                }
            }
            $order->status = 'process';
            $order->save();
            Mail::to($order->agent->email)->send(new NewOrderNotification($order));
        } elseif($transaction == 'pending'){
            // TODO set payment status in merchant's database to 'Pending'
            $invoice->setPending();
        } elseif ($transaction == 'deny') {
            // TODO set payment status in merchant's database to 'Failed'
            $invoice->setFailed();
            $invoice->order->status = 'canceled';
            $invoice->order->save();
        } elseif ($transaction == 'expire') {
            // TODO set payment status in merchant's database to 'expire'
            $invoice->setExpired();
            $invoice->order->status = 'canceled';
            $invoice->order->save();
        } elseif ($transaction == 'cancel') {
            // TODO set payment status in merchant's database to 'Failed'
            $invoice->setFailed();
            $invoice->order->status = 'canceled';
            $invoice->order->save();
        }
        
        return;
    }
    // public function status
}
