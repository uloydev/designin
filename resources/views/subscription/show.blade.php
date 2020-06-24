@extends('layouts.customer-master')
@section('page-id', 'seeSubscription')
@section('page-title')
    {{ $subscription->title }}
@endsection
@section('script')
    <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
@endsection
@section('header')
    <header>
        @include('partials.nav')
        <div class="container">
            <div class="row justify-content-center justify-content-md-between">
                <img class="mb-5 mb-md-0" src="{{ Storage::url($subscription->img) }}"
                alt="{{ $subscription->title . 'Image' }}" height="300">
                <div class="col-12 col-md-6 subscription-single__caption">
                    <h1>{{ $subscription->title }}</h1>
                </div>
            </div>
        </div>
    </header>
@endsection
@section('content')
    <div class="container">
        <h1 class="mb-5">What's include in this subscription package</h1>
        <div class="subscription__desc">
            {!! $subscription->desc !!}
        </div>
        <div class="subscription__action">
            <form id="subscribe-form" action="{{ route('user.subscription.payment', $subscription->id) }}" method="post" data-subscription-id="{{ $subscription->id }}">
                @csrf
                <p>Quantity : </p>
                <input type="number" min="1" max="200" value="1" name="quantity" required>
                <input type="hidden" name="user_id" value="{{Auth::id()}}">
                <button type="submit" class="subscription__btn">Subscribe now</button>
            </form>
        </div>
    </div>
@endsection
