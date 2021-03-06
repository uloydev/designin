<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\UserPortfolio;
use Illuminate\Support\Facades\Auth;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portfolios = Auth::user()->profile->portfolio;
        return view('agent.portfolio.index')->with('portfolios', $portfolios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agent.portfolio.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'portfolios.*'=>'required|file|mimes:jpg,jpeg,png',
            'portfolio_titles.*'=>'required'
        ]);
        if ($request->hasFile('portfolios')) {
            foreach ($request->file('portfolios') as $index => $file) {
                $portfolio = Storage::putFile('uploads/portfolio', $file);
                $portfolio_data = [
                    'title'=>$request->titles[$index], 
                    'image_url'=>$portfolio,
                    'user_id'=>Auth::id()
                ];
                UserPortfolio::create($portfolio_data);
            }
        }
        return redirect()->back()->with('success', 'Portfolio Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $portfolio = UserPortfolio::where('user_id', Auth::id())->findOrFail($id);
        return view('agent.portfolio.show')->with('portfolio', $portfolio);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $portfolio = UserPortfolio::where('user_id', Auth::id())->findOrFail($id);
        return view('agent.portfolio.edit')->with('portfolio', $portfolio);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'required', 
            'image'=>'file|mimes:jpg,jpeg,png,gif,svg',
        ]);
        $portfolio_data = [
            'title'=>$request->titles,
            'user_id'=>Auth::id()
        ];
        if ($request->hasFile('image')) {
            $portfolio = Storage::putFile('uploads/portfolio', $request->file('image'));
            $portfolio_data['image_url'] = $portfolio;
        }
        UserPortfolio::create($portfolio_data);
        return redirect()->back()->with('success', 'Portfolio Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $portfolio = UserPortolio::where('user_id', Auth::id())->findOrFail($id);
        Storage::delete($portfolio->image_url);
        $portfolio->delete();
        return redirect()->back()->with('success','Portfolio Deleted Successfully');
    }
}
