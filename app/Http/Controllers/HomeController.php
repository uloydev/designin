<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\CarouselImage;
use App\Blog;
use App\Faq;
use App\ServiceCategory;
use App\FaqCategory;

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

    public function services(Request $request)
    {
        if(isset($request->category)){
            $services = Service::where('category_id', $request->category)->paginate(10);
            $category = ServiceCategory::where('id', $request->category)->get();
            return view('services', ['services'=>$services, 'category'=>$category]);
        }else{
            $services = Service::paginate(10);
            return view('services', ['services'=>$services]);
        }
    }

    public function faq()
    {
        $faqs = Faq::with('faqCategory')->get();
        $faqCategories = FaqCategory::with('faqs')->get();
        return view('faq.index', ['faqs' => $faqs, 'faqCategories' => $faqCategories]);
    }

}
