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
use Illuminate\Support\Facades\Auth;
use App\Mail\NewOrderNotification;
use App\Mail\UserSubscriptionNotification;
use App\Subscription;
use App\SubscriptionOrder;
use App\TokenConversion;

class PaymentController extends Controller
{
    public function orderPayment($id, Request $request)
    {
        $token_conversion = TokenConversion::first();
        if (empty($token_conversion)) {
            return;
        }
        $user = User::findOrFail($request->user_id);
        $package = Package::findOrFail($id);
        $order = new Order;
        $quantity = intval($request->quantity);
        $budget = $package->price * $quantity;
        if (!empty($request->promo_code)) {
            $promo = Promo::where('code' , $request->promo_code)->first();
            $promo_discount = floor($budget * $promo->discount / 100);
            $budget -= $promo_discount;
            $order->promo_id = $promo->id;
        }
        if ($request->hasFile('brief_file')) {
            $order->attachment = $request->file('brief_file')->store('public/files');
        }
        if ($request->has('extras') and !empty(json_decode($request->extras))) {
            $order->extras = $request->extras;
            foreach(json_decode($order->extras) as $extras_id){
                $budget += ServiceExtras::findOrFail($extras_id)->price;
            }
        }
        if (!empty($user->subscribe_at) and !empty($user->subscribe_duration)){
            if ($user->is_subscribe and Carbon::now() <= $user->subscribe_at->addDays($user->subscribe_duration)) {
                if (ceil($budget / $token_conversion->numeral) > $user->subscribe_token){
                    $budget -= $user->subscribe_token * $token_conversion->numeral;
                    $token_usage = $user->subscribe_token;
                }
            }
        }
        $order->agent_id = intval($request->agent_id);
        $order->package_id = $package->id;
        $order->status = 'unpaid';
        $order->request = $request->message_agent;
        $order->budget = $budget;
        $order->user_id = $user->id;
        $order->quantity = $quantity;
        if (isset($token_usage)) {
            $order->token_usage = $token_usage;
            $user->subscribe_token -= $token_usage;
            $user->save();
        }
        $order->save();
        // midtrans
        $transaction_details = [
            'order_id' => 'order-'.$order->id.'-'.time(),
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
                'quantity' => $order->quantity,
                'name' => $package->service->title . '-' . $package->title,
                'price' => $package->price
            ]
        ];

        if (!empty(json_decode($order->extras))) {
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

        if (isset($token_usage) and $token_usage > 0){
            $token_data = [
                'id' => 'token',
                'quantity' => 1,
                'name' => 'subscription token',
                'price' => -($token_usage * $token_conversion->numeral)
            ];
            array_push($item_details, $token_data);
        }

        if (isset($promo_discount)) {
            $promo_data = [
                'id' => 'discount',
                'quantity' => 1,
                'name' => 'promo discount',
                'price' => -($promo_discount)
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
        // try {
            $token = Midtrans::getSnapToken($transaction_data);
            $data = ['token' => $token, 'status'=>'success'];
            $invoice = new Invoice;
            $invoice->payment_token = $token;
            $invoice->order_id = $order->id;
            $invoice->save();
            $order->invoice_id = $invoice->id;
            $order->save();
    //     } catch (\Throwable $th) {
    //         $data = ['status' => 'error'];
    //     }
        return $data;
    }

    public function subscriptionPayment($id, Request $request)
    {
        $sub = Subscription::findOrFail($id);
        $user = User::findOrFail($request->user_id);
        $order = new SubscriptionOrder;
        $order->user_id = $user->id;
        $order->subscription_id = $sub->id;
        $order->quantity = $request->quantity;
        $order->payment_status = "pending";
        $order->save();
        $transaction_details = [
            'order_id' => 'sub-'.$order->id.'-'.time(),
            // 'order_id' => time(), // only for testing
            'gross_amount' => $order->subscription->price * $order->quantity
        ];

        $customer_details = [
            'first_name' => $user->name,
            'email' => $user->email,
            'phone' => !empty($user->profile) ? $user->profile->handphone : ''
        ];

        $item_details = [
            [
                'id' => $order->id,
                'quantity' => $order->quantity,
                'name' => $order->subscription->title,
                'price' => $order->subscription->price
            ]
        ];

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
            $order->payment_token = $token;
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
        $arr = explode('-', $notif->order_id);
        $order_type = $arr[0];
        if ($order_type == 'order') {
            $orderId = $arr[1];
            $invoice = Invoice::where('order_id', $orderId)->first();
        }elseif ($order_type == 'sub') {
            $orderId = $arr[1];
            $invoice = SubscriptionOrder::findOrFail($orderId);
        }
        // signature verification
        $orderId = $notif->order_id;
        $statusCode = $notif->status_code;
        $grossAmount = $notif->gross_amount;
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $input = $orderId.$statusCode.$grossAmount.$serverKey;
        $signature = openssl_digest($input, 'sha512');
        if ($signature !== $notif->signature_key) {
            return;
        }
        $fraud = $notif->fraud_status;
        $invoice->payment_type = $type;
        $invoice->payment_status_code = $notif->status_code;
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
                    if ($order_type == 'order') {
                        $order = $invoice->order;
                        if (!empty(json_decode($order->extras))) {
                            foreach(json_decode($order->extras) as $extras_id) {
                                $extras = ServiceExtras::findOrFail($extras_id);
                                if ($extras->is_template) {
                                    if ($extras->template->effect == 'duration-1') {
                                        $order->deadline = Carbon::now()->addDays($package->duration - 1);
                                    }
                                }
                            }
                        }
                        $order->status = 'process';
                        $order->save();
                        Mail::to($order->agent->email)->send(new NewOrderNotification($order));
                    }elseif ($order_type == 'sub') {
                        $user = $invoice->user;
                        $user->is_subscribe = true;
                        $user->subscribe_to = $invoice->subscription_id;
                        $user->subscribe_at = Carbon::now();
                        $user->subscribe_duration = $invoice->subscription->duration * $invoice->quantity;
                        $user->subscribe_token = $invoice->subscription->token * $invoice->quantity;
                        $user->save();
                        Mail::to($user->email)->send(new UserSubscriptionNotification($user, $invoice));
                    }
                }
            }
        } elseif ($transaction == 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
            $invoice->setSuccess();
            if ($order_type == 'order') {
                $order = $invoice->order;
                if (!empty(json_decode($order->extras))) {
                    foreach(json_decode($order->extras) as $extras_id) {
                        $extras = ServiceExtras::findOrFail($extras_id);
                        if ($extras->is_template) {
                            if ($extras->template->effect == 'duration-1') {
                                $order->deadline = Carbon::now()->addDays($package->duration - 1);
                            }
                        }
                    }
                }
                $order->status = 'process';
                $order->save();
                Mail::to($order->agent->email)->send(new NewOrderNotification($order));
            }elseif ($order_type == 'sub') {
                $user = $invoice->user;
                $user->is_subscribe = true;
                $user->subscribe_to = $invoice->subscription_id;
                $user->subscribe_at = Carbon::now();
                $user->subscribe_duration = $invoice->subscription->duration * $invoice->quantity;
                $user->subscribe_token = $invoice->subscription->token * $invoice->quantity;
                $user->save();
                Mail::to($user->email)->send(new UserSubscriptionNotification($user, $invoice));
            }
        } elseif($transaction == 'pending'){
            // TODO set payment status in merchant's database to 'Pending'
            $invoice->setPending();
        } elseif ($transaction == 'deny') {
            // TODO set payment status in merchant's database to 'Failed'
            $invoice->setFailed();
            if ($order_type == 'order') {
                $invoice->order->status = 'canceled';
                $invoice->order->save();
            }
        } elseif ($transaction == 'expire') {
            // TODO set payment status in merchant's database to 'expire'
            $invoice->setExpired();
            if ($order_type == 'order') {
                $invoice->order->status = 'canceled';
                $invoice->order->save();
            }
        } elseif ($transaction == 'cancel') {
            // TODO set payment status in merchant's database to 'Failed'
            $invoice->setFailed();
            if ($order_type == 'order') {
                $invoice->order->status = 'canceled';
                $invoice->order->save();
            }
        }

        return;
    }

    public function redirect(Request $request)
    {
        if (empty($request->all())) {
            if(Auth::check()){
                return redirect()->route(Auth::user()->role . '.dashboard');
            }
        }
        if ($request->has('order_id') and Auth::check()) {
            $arr = explode('-', $request->order_id);
            if ($arr[0] == 'order') {
                $order = Order::findOrFail($arr[1]);
                return redirect()->route('user.order.index');
            }elseif ($arr[0] == 'sub') {
                $order = SubscriptionOrder::findOrFail($arr[1]);
                return redirect()->route('user.subscription.index');
            }else {
                return abort(404);
            }
        }
        return redirect()->route('landing-page');
    }
}
