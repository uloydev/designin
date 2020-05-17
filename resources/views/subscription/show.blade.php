@extends('layouts.customer-master')
@section('page-id', 'seeSubscription')
@section('page-title')
    {{ $subscription->title }}
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
            <form action="" method="post">
                @csrf
                <p>Quantity : </p>
                <input type="number" min="1" max="200" value="1" required>
                <button type="submit" class="subscription__btn">Subscribe now</button>
            </form>
        </div>
    </div>
@endsection
