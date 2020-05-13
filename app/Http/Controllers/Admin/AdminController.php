<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Blog;
use App\User;
use App\BlogCategory;
use Illuminate\Http\Response;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $test = [0, 20, 10, 30, 15, 40, 20, 60, 20, 100, 90, 50];
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
            'test' => $test,
            'totalArticle' => $totalArticle
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(int $id): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, int $id): Response
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(int $id): Response
    {
        //
    }
}
