<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Client;
use App\LandingHeaderSlider;
use App\Testimony;
use App\Service;
use App\CarouselImage;
use App\Blog;
use App\Faq;
use Illuminate\Support\Facades\Auth;
use App\ServiceCategory;
use App\FaqCategory;
use App\User;
use App\Subscription;
use App\Reason;
use App\Package;
use App\Order;
use App\Promo;
use App\Mail\NewOrderNotification;
use App\Mail\ContactAgentNotification;

class HomeController extends Controller
{
    public function index()
    {
        $topService = Service::where('is_popular', true)->limit(4)->get();
        $images = CarouselImage::all();
        $promos = Blog::where('is_main', true)->whereHas('category', function (Builder $query){
            $query->where('name', 'Promo');
        })->get(); //get blog where is_main true and where category promo on model blogCategory
        $clients = Client::where('is_show', true)->get();
        $testimonies = Testimony::where('is_main', true)->get();
        $subscriptions = Subscription::all();
        $reasons = Reason::all();
        $landingHeaders = LandingHeaderSlider::all();
//        dd($landingHeaders);
        return view('landing')->with([
            'images' => $images,
            'promos' => $promos,
            'testimonies' => $testimonies,
            'clients' => $clients,
            'subscriptions' => $subscriptions,
            'reasons' => $reasons,
            'topService' => $topService,
            'landingHeaders' => $landingHeaders
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
        $testimonies = $service->testimonies;
        $packages = $service->package;
        return view('service.single', [
            'service' => $service,
            'rating' => $rating,
            'testimonies' => $testimonies,
            'packages' => $packages
        ]);
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

    public function makeOrder(Request $request, $id)
    {
        $this->middleware('auth');
        $user = Auth::user();
        $package = Package::findOrFail($id);
        $order = new Order;
        if ($request->hasFile('attachment')) {
            $order->attachment = $request->file('attachment')->store('public/files');
        }
        $order->agent_id = intval($request->agent_id);
        $order->package_id = $package->id;
        $order->status = 'waiting';
        $order->request = $request->user_request;
        $budget = $package->price;
        if ($user->is_subscribe) {
            $subscription = $user->subscription;
            $budget -= $budget * $subscription->discount / 100;
        }
        if ($request->has('promo_code')) {
            $promo = Promo::where('code' , $request->promo_code)->get();
            $budget -= $budget * $promo->discount / 100;
            $order->promo_id = $promo->id;
        }
        $order->budget = $budget;
        $order->user_id = $user->id;
        $order->save();

        Mail::to(User::find($request->agent_id)->email)->send(new NewOrderNotification($order));
        return redirect()->route('user.order.index')->with(
            'success', 'Order placed Successfully. you have to wait for agent to accept your order'
        );
    }

    public function checkPromoCode(Request $request)
    {
        $promo = Promo::where('code', $request->promo_code)->get();
        if (empty($promo)) {
            return ['status'=>'failed', 'message'=>'wrong promo code'];
        }
        if (empty(Promo::where('code', $request->promo_code)->where('ended_date' < Carbon::now())->get())) {
            return ['status'=>'failed', 'message'=>'promo code expired'];
        }
        if ($promo->usage >= $promo->limit){
            return ['status'=>'failed', 'message'=>'promo usage exceed'];
        }
        return ['status'=>'success', 'message'=>'promo code applied', 'discount' => $promo->discount];
    }

    public function contactAgent($id, Request $request)
    {
        $this->middleware('auth');
        $sevice = Service::findOrFail($id);
        $request->validate([
            'message_agent' => 'required',
            'message_file' => 'mimes:jpeg,png,psd'
        ]);
        $agent = Auth::user();
        Mail::to($agent->email)->send(new ContactAgent($request->all(), $agent, $service));
        return redirect()->back()->withSuccess('Message to Agent has Sent Successfully');
    }
}
