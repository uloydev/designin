@extends('layouts.customer-master')
@section('page-title', 'All Services')
@section('page-id', 'services')
@section('header')
    <header>
        @include('partials.nav')
        <div class="container">
            <div class="row justify-content-between">
                <img src="{{ asset('img/service.png') }}" class="service-header__img">
                <div class="col service-header__caption">
                    <h1 class="service-header__heading">Our Services</h1>
                </div>
            </div>
        </div>
    </header>
@endsection
@section('content')
    <div class="container">
        @forelse ($categories as $category)
            <section class="category" id="{{ Str::slug($category->name, '-') }}">
                <h1 class="mb-5 text-center text-md-left">{{ $category->name ?? '' }}</h1>
                <div class="row">
                    @forelse ($category->services as $service)
                        <div class="col-12 col-md-6 mb-md-5 col-lg-4 col-xl-3">
                            <a href="">
                                <div class="service card p-0">
                                    <img src="{{ Storage::url($service->image) }}" class="card__img"
                                         alt="Desainin Service Category">
                                    <div class="card__header">
                                        <h2 class="card__heading service__title">{{ $service->title }}</h2>
                                    </div>
                                    <div class="card__body service__content">
                                        <p>{{ $service->description }}</p>
                                        <p class="mt-3 service__rating">Rating : {{ ceil($rating) }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert--light text-center" style="font-size: 18px">
                                <p class="mb-3">All service in category {{ $category->name }} is not available now.</p>
                                <p>
                                    <a href="{{ route('contact-us.index') }}" class="text-link">Contact us</a>
                                    if you really need it
                                </p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </section>
        @empty
            <div class="alert alert--light">
                No service category
            </div>
        @endforelse
    </div>
@endsection
