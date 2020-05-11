<?php

namespace App\Http\Controllers;

use App\Client;
use App\Testimony;
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
        $clients = Client::all();
        $testimonies = Testimony::where('is_main', true)->get();
        return view('landing')->with([
            'images' => $images,
            'serviceCategories' => $serviceCategories,
            'blogs' => $blogs,
            'testimonies' => $testimonies,
            'clients' => $clients
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
        foreach ($services as $service) {
            if ($service->testimonies->count() != 0){
                $score = 0;
                foreach ($service->testimonies as $testimony) {
                    $score += $testimony->rating;
                }
                $rating = $score / $service->testimonies->count();
            }
        }
        if (isset($request->category)) {
            $categories = ServiceCategory::where('id', $request->category)->get();
            $services = Service::where('service_category_id', $request->category)->paginate(10);
        }
        else {
            $categories = ServiceCategory::has('services')->get();
        }
        return view('service.all', ['categories' => $categories, 'services' => $services, 'rating' => $rating]);
    }

    public function showService($id)
    {
        $service = Service::findOrFail($id);
//        if ($service->testimonies->count() != 0){
//            $score = 0;
//            foreach ($service->testimonies as $testimony) {
//                $score += $testimony->rating;
//            }
//            $rating = $score / $service->testimonies->count();
//        }
        $rating = 4;
        return view('service.single', ['service' => $service, 'rating' => $rating]);
    }

    public function faq()
    {
        $faqs = Faq::with('faqCategory')->get();
        $faqCategories = FaqCategory::with('faqs')->get();
        return view('faq.index', ['faqs' => $faqs, 'faqCategories' => $faqCategories]);
    }

}
