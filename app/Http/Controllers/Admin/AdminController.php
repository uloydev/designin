<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\Service;
use App\TokenConversion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Blog;
use App\User;

class AdminController extends Controller
{

    public function index()
    {
        $incomes = Order::select('id', 'created_at')->get()->groupBy(function ($date){
            return Carbon::parse($date->created_at)->format('m');
        });
        $incomesCount = [];
        $incomeArr = [];
        foreach ($incomes as $key => $income) {
            $incomesCount[(int)$key] = count($income);
        }
        for($i = 1; $i <= 12; $i++){
            if(!empty($incomesCount[$i])){
                $incomeArr[$i] = $incomesCount[$i];
            }else{
                $incomeArr[$i] = 0;
            }
        }
        $articles = Blog::latest()->take(10)->get();
        $totalArticle = Blog::count();
        $totalPromo = Blog::whereHas('category', function($query){
            $query->where('name', 'Promo');
        })->count();
        $totalAgent = User::where('role', 'agent')->count();
        $totalCustomer = User::where('role', 'user')->count();
        $services = Service::take(10)->get();
        return view('admin.dashboard', [
            'articles' => $articles,
            'totalAgent' => $totalAgent,
            'totalCustomer' => $totalCustomer,
            'totalPromo' => $totalPromo,
            'services' => $services,
            'incomeArr' => $incomeArr,
            'totalArticle' => $totalArticle
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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
        //
    }

    public function destroy($id)
    {
        //
    }

    public function setting()
    {
        $tokenConversion = TokenConversion::first();
        return view('admin.setting', ['tokenConversion' => $tokenConversion]);
    }

    public function updateToken(Request $request)
    {
        TokenConversion::first()->update([
            'numeral' => $request->numeral
        ]);
        return redirect()->back()->with('success', 'Successfully change token numeral to rupiah');
    }
}
