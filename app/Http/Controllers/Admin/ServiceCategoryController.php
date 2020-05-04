<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ServiceCategory;
use Illuminate\Http\Request;

class ServiceCategoryController extends Controller
{

    public function index()
    {
        $serviceCategory = ServiceCategory::all();
        return view('service.category', ['serviceCategory' => $serviceCategory]);
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
}
