<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans;

class PaymentController extends Controller
{
    public function orderPayment(Request $request)
    {
        $transaction_details = [
            'order_id' => time(),
            'gross_amount' => 10000
        ];

        $customer_details = [
            'first_name' => 'User',
            'email' => 'user@gmail.com',
            'phone' => '08238493894'
        ];

        $custom_expiry = [
            'start_time' => date("Y-m-d H:i:s O", time()),
            'unit' => 'day',
            'duration' => 2
        ];

        $item_details = [
            'id' => 'PROD-1',
            'quantity' => 1,
            'name' => 'Product-1',
            'price' => 10000
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
            'expiry' => $custom_expiry,
            'credit_card' => $credit_card_option,
        ];

        try {
            $token = Midtrans::getSnapToken($transaction_data);
            $data = ['token' => $token, 'status'=>'success'];
        } catch (\Throwable $th) {
            $data = ['status' => 'error'];
        }
        return $data;
    }
}
