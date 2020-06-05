<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Order;
use App\ProjectResult;
use Illuminate\Support\Facades\Auth;

class DownloadController extends Controller
{
    
    public function downloadResult($id, $result_id)
    {
        $order = Order::findOrFail($id);
        $result = ProjectResult::findOrFail($result_id);
        if(Auth::user()->role == 'agent'){
            if ($order->id !== $result->order_id or $order->agent_id !== Auth::id()) {
                return abort(401);
            }
        }elseif(Auth::user()->role == 'user'){
            if ($order->id !== $result->order_id or $order->user_id !== Auth::id()) {
                return abort(401);
            }
        }else{
            return abort(401);
        }
        return Storage::download($result->file);
    }
}
