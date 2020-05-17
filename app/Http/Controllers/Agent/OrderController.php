<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(Request $request)
    {
        if ($request->has('sort', 'sort_type')) {
            try {
                $orders = Order::where('status', 'process')
                ->orWhere('status', 'complaint')
                ->where('agent_id', Auth::id())
                ->join('package', 'package.id', '=', 'orders.package_id')
                ->orderBy($request->sort, $request->sort_type)->paginate(10);
            } catch (\Throwable $th) {
                return abort('404');
            }
        }else{
            $orders = Order::where('status', 'process')
            ->orWhere('status', 'complaint')
            ->where('agent_id', Auth::id())
            ->latest()->paginate(10);
        }
        return view('agent.list-request', [
            'orders'=>$orders,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Order::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Order History Deleted Successfully');
    }

    public function history(Request $request)
    {
        if ($request->has('sort', 'sort_type')) {
            $orders = Order::where('agent_id', Auth::id())
            ->where('status', 'finished')
            ->join('package', 'package.id', '=', 'orders.package_id')
            ->orderBy($request->sort, $request->sort_type)->paginate(10);
        }else{
            $orders = Order::where('agent_id', Auth::id())->where('status', 'finished')->latest()->paginate(10);
        }
        return view('agent.request-history', [
            'orders'=>$orders
        ]);
    }

    public function bidHistory(Request $request)
    {
        if ($request->has('sort', 'sort_type')) {
            $orders = Order::where('agent_id', Auth::id())
            ->join('package', 'package.id', '=', 'orders.package_id')
            ->orderBy($request->sort, $request->sort_type)->paginate(10);;
        }else{
            $orders = Order::where('agent_id', Auth::id())->latest()->paginate(10);
        }
        return view('agent.bid-history', [
            'orders'=>$orders
        ]);
    }

    public function incoming()
    {
        return view('service.incoming');
    }

    public function approval($id)
    {
        $order = Order::findOrFail($id);
        $order->approval = $request->approval;
        $order->save();
        return redirect()->back('approval', 'Succesfully' . $request->approval . 'Incoming Job');
    }
}
