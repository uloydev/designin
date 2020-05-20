<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function index()
    {
        return view('promo.manage');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $promo = new Promo;

        $promo->promo_name = $request->promo_name;
        $promo->promo_start = $request->promo_start;
        $promo->promo_end = $request->promo_end;
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

        $promo->promo_name = $request->promo_name;
        $promo->promo_start = $request->promo_start;
        $promo->promo_end = $request->promo_end;
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
