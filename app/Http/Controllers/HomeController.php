<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\CarouselImage;
use App\Blog;
use App\Faq;

class HomeController extends Controller
{
    public function index()
    {
        $images = CarouselImage::all();
        $services = Service::latest()->take(5)->get();
        $blogs = Blog::paginate(5);
        return view('landing')->with([
            'images' => $images,
            'services' => $services,
            'blogs' => $blogs,
        ]);
    }

    public function serviceSearch(Request $request)
    {
        $query = $request->q;
        $services = Service::where('title', 'like', '%'.$query.'%')->paginate(10);
        return view('services', ['services'=>$services]);
    }

    public function services()
    {
        $services = Service::paginate(10);
        return view('services', ['services'=>$services]);
    }

    public function blog()
    {
        $blogs = Blog::paginate(5);
        return view('blog')->with('blogs', $blogs);
    }

    public function faq()
    {
        $faqs = Faq::all();
        return view('faq')->with('faqs', $faqs);
    }

}
