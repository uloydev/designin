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
use App\User;
use App\Subscription;

class HomeController extends Controller
{
    public function index()
    {
        $images = CarouselImage::all();
        $serviceCategories = ServiceCategory::all();
        $blogs = Blog::paginate(5);
        $clients = Client::all();
        $testimonies = Testimony::where('is_main', true)->get();
        $subscriptions = Subscription::all();
        return view('landing')->with([
            'images' => $images,
            'serviceCategories' => $serviceCategories,
            'blogs' => $blogs,
            'testimonies' => $testimonies,
            'clients' => $clients,
            'subscriptions'=>$subscriptions
        ]);
    }

    public function services(Request $request)
    {
        if (isset($request->category)) {
            $categories = array(ServiceCategory::findOrFail($request->category));
        }else {
            $categories = ServiceCategory::has('services')->get();
        }
        foreach ($categories as $category) {
            foreach ($category->services as $service) {
                $rating = $service->testimonies->pluck('rating')->avg();
                $rating = $rating ? $rating : 0;
                $service->rating = $rating;
            }
        }
        return view('service.all', ['categories' => $categories]);
    }

    public function showService($id)
    {
        $service = Service::findOrFail($id);
        $rating = $service->testimonies->pluck('rating')->avg();
        $rating = $rating ? $rating : 0;
        return view('service.single', ['service' => $service, 'rating' => $rating]);
    }

    public function faq(Request $request)
    {
        if($request->has('search_faq')){
            $faqs = Faq::where('question','like','%'.$request->search_faq.'%')
            ->orWhere('answer','like','%'.$request->search_faq.'%')->get();
            $faqCategories = FaqCategory::all();
        }else{
            $faqs = Faq::all();
            $faqCategories = FaqCategory::all();
        }
        return view('faq.index', ['faqs' => $faqs, 'faqCategories' => $faqCategories]);
    }

    public function searchAgentJob(Request $request)
    {
        $agents = User::where('role' ,'agent')->where('name', 'like', '%'.$request->search_agent_job.'%')->take(4);
        $services = Service::where('title', 'like', '%'.$request->search_agent_job.'%')
        ->orWhere('description', 'like', '%'.$request->search_agent_job.'%')->take(4);
        return view('search.agentjob', [
            'agents'=>$agents,
            'services'=>$services
        ]);
    }

}
