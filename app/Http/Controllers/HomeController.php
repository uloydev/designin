<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\CarouselImage;
use App\News;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $images = CarouselImage::all();
        $services = Service::latest()->take(5)->get();
        $news = News::paginate(5);
        return view('landing')->with([
            'images' => $images,
            'services' => $services,
            'news' => $news,
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
}
