<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Client;
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
use App\ServiceExtras;
use app\TokenConversion;

class HomeController extends Controller
{
    public function index()
    {
        $topService = ServiceCategory::all();
        $images = CarouselImage::all();
        $promos = Blog::where('is_main', true)->whereHas('category', function (Builder $query){
            $query->where('name', 'Promo');
        })->get(); //get blog where is_main true and where category promo on model blogCategory
        $clients = Client::where('is_show', true)->get();
        $testimonies = Testimony::where('is_main', true)->get();
        $subscriptions = Subscription::all();
        $reasons = Reason::all();
        $blogs = Blog::where('is_main', true)->get();
        $inspirations = Service::where('is_popular', true)->get();
        return view('landing')->with([
            'images' => $images,
            'promos' => $promos,
            'testimonies' => $testimonies,
            'clients' => $clients,
            'subscriptions' => $subscriptions,
            'reasons' => $reasons,
            'topService' => $topService,
            'inspirations' => $inspirations,
            'blogs' => $blogs
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
                $testimony = Testimony::where('service_id', $service->id)->pluck('rating');
                $rating = empty($testimony) ? 0 : $testimony->avg();
                $service->rating = $rating;
            }
        }
        return view('service.all', ['categories' => $categories]);
    }

    public function showService(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $testimony = Testimony::where('service_id', $service->id)->pluck('rating');
        $rating = empty($testimony) ? 0 : $testimony->avg();
        $packages = $service->package;
        $promos = Promo::whereDate('ended_at', '>', Carbon::now()->format('Y-m-d h:m:s'))->get();
        $extras_template = ServiceExtras::where('is_template', true)->get();
        $testimonies = $service->testimonies;
        return view('service.single', [
            'service' => $service,
            'rating' => $rating,
            'testimonies' => $testimonies,
            'packages' => $packages,
            'promos' => $promos,
            'extras_template' => $extras_template
        ]);
    }

    public function filterService(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $testimony = Testimony::where('service_id', $service->id)->pluck('rating');
        $rating = empty($testimony) ? 0 : $testimony->avg();
        $packages = $service->package;
        $promos = Promo::whereDate('ended_at', '>', Carbon::now()->format('Y-m-d h:m:s'))->get();
        $extras_template = ServiceExtras::where('is_template', true)->get();

        $filtering = $request->review_filter;
        $testimonies = '';
        if ($filtering == 'recent') {
            $testimonies = $service->testimonies()->latest()->get();
        }
        else if ($filtering == 'asc') {
            $testimonies = $service->testimonies()->orderBy('rating', 'asc')->get();
        }
        else if ($filtering == 'desc') {
            $testimonies = $service->testimonies()->orderBy('rating', 'desc')->get();
        }

        return view('service.single', [
            'service' => $service,
            'rating' => $rating,
            'testimonies' => $testimonies,
            'packages' => $packages,
            'promos' => $promos,
            'extras_template' => $extras_template,
            'filtering' => $filtering
        ]);
    }

    public function faq()
    {
        $faqs = Faq::all();
        $faqCategories = FaqCategory::all();
        return view('faq.index', ['faqs' => $faqs, 'faqCategories' => $faqCategories]);
    }

    public function searchAgentJob(Request $request)
    {
        $query = $request->search_agent_job;
        $agents = User::where('role' ,'agent')->where('name', 'like', '%'.$request->search_agent_job.'%')->take(4);
        $categories = ServiceCategory::whereHas('services', function (Builder $query) use ($request) {
            $query->where('title', 'LIKE', '%' . $request->search_agent_job . '%');
        })->paginate(10);
        return view('service.all', [
            'agents' => $agents,
            'categories' => $categories,
            'query' => $query
        ]);
    }

    public function makeOrder(Request $request, $id)
    {
        $token_conversion = TokenConversion::first();
        if (empty($token_conversion)) {
            return abort(500);
        }
        $user = Auth::user();
        $package = Package::findOrFail($id);
        $order = new Order;
        $quantity = intval($request->quantity);
        $budget = $package->price * $quantity;
        if (!empty($request->promo_code)) {
            $promo = Promo::where('code' , $request->promo_code)->first();
            $budget -= $budget * $promo->discount / 100;
            $order->promo_id = $promo->id;
        }
        if ($request->has('extras') and !empty($request->extras)) {
            $order->extras = $request->extras;
            foreach(json_decode($order->extras) as $extras_id) {
                $extras = ServiceExtras::findOrFail($extras_id);
                $budget += $extras->price;
                if ($extras->is_template) {
                    if ($extras->template->effect == 'duration-1') {
                        $order->deadline = Carbon::now()->addDays($package->duration - 1);
                    }
                }
            }
        }
        if (!empty($user->subscribe_at) and !empty($user->subscribe_duration)){
            if ($user->is_subscribe and Carbon::now() <= $user->subscribe_at->addDays($user->subscribe_duration)){
                if ($user->subscribe_token >= ceil($budget / $token_conversion->numeral)) {
                    $token_usage = ceil($budget / $token_conversion->numeral);
                    $budget = 0;
                }else{
                    return abort(401);
                }
            }else{
                return abort(401);
            }
        }else{
            return abort(401);
        }
        $order->agent_id = intval($request->agent_id);
        $order->package_id = $package->id;
        $order->status = 'process';
        $order->started_at = Carbon::now();
        $order->request = $request->message_agent;
        $order->budget = $budget;
        $order->user_id = $user->id;
        $order->quantity = $quantity;
        if ($request->hasFile('brief_file')) {
            $order->attachment = $request->file('brief_file')->store('public/files');
        }
        if (isset($token_usage)) {
            $order->token_usage = $token_usage;
            $user->subscribe_token -= $token_usage;
            $user->save();
        }
        $order->save();
        Mail::to($order->agent->email)->send(new NewOrderNotification($order));
        return redirect()->route('user.order.index')->with(
            'success', 'Order placed Successfully'
        );
    }

    public function redirectOrderPage($id)
    {
        $service_id = Package::findOrFail($id)->service->id;
        return redirect()->route('service.show', $service_id);
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

    // public function contactAgent($id, Request $request)
    // {
    //     $this->middleware('auth');
    //     $sevice = Service::findOrFail($id);
    //     $request->validate([
    //         'message_agent' => 'required',
    //         'message_file' => 'mimes:jpeg,png,psd'
    //     ]);
    //     $agent = Auth::user();
    //     Mail::to($agent->email)->send(new ContactAgent($request->all(), $agent, $service));
    //     return redirect()->back()->withSuccess('Message to Agent has Sent Successfully');
    // }

    // public function serviceSearch(Request $request)
    // {
    //     $service = Service::where('title', 'LIKE', '%' . $request . '%')->paginate();
    //     $service->appends(['search' => $q]);
    // }
}
