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
        $serviceCategories = ServiceCategory::all();
        $blogs = Blog::paginate(5);
        return view('landing')->with([
            'images' => $images,
            'serviceCategories' => $serviceCategories,
            'blogs' => $blogs,
        ]);
    }

    // public function serviceSearch(Request $request)
    // {
    //     $query = $request->q;
    //     $services = Service::where('title', 'like', '%'.$query.'%')->paginate(10);
    //     return view('services', ['services'=>$services]);
    // }

    public function services(Request $request)
    {
        $services = Service::all();
        if (isset($request->category)) {
            $categories = ServiceCategory::where('id', $request->category)->get();
            $services = Service::where('service_category_id', $request->category)->paginate(10);
        }
        else {
            $categories = ServiceCategory::all();
        }
        return view('services', compact('categories', 'services'));
    }

    public function faq()
    {
        $faqs = Faq::with('faqCategory')->get();
        $faqCategories = FaqCategory::with('faqs')->get();
        return view('faq.index', ['faqs' => $faqs, 'faqCategories' => $faqCategories]);
    }

}
