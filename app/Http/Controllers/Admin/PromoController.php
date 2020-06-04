<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Promo;

class PromoController extends Controller
{
    public function index()
    {
        $promos = Promo::latest()->paginate(10);
        return view('promo.manage', ['promos'=>$promos]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $promo = new Promo;

        $promo->name = $request->promo_name;
        $promo->started_at = $request->promo_start;
        $promo->ended_at = $request->promo_end;
        $promo->code = $request->promo_code;
        $promo->discount = $request->promo_discount;
        $promo->limit = $request->promo_limit;
        $promo->save();

        return redirect()->back()->with('create', 'Succefully add new promo');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $promo = Promo::findOrFail($id);
        $promo->name = $request->promo_name;
        $promo->started_at = $request->promo_start;
        $promo->ended_at = $request->promo_end;
        $promo->code = $request->promo_code;
        $promo->discount = $request->promo_discount;
        $promo->limit = $request->promo_limit;
        $promo->save();

        return redirect()->back()->with('update', 'Succefully update promo');
    }

    public function destroy($id)
    {
        $promo = Promo::findOrFail($id);
        $promo->delete();
        return redirect()->back()->with('delete', 'Succefully delete promo');
    }
}
