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
        @foreach ($categories as $category)
            <h1 class="mb-5 text-center text-md-left">{{ $category->name ?? '' }}</h1>
            <section class="category row">
            @foreach ($category->services as $service)
                <div class="col-12 col-md-6 mb-md-5 col-lg-4 col-xl-3">
                    <a href="">
                        <div class="service card p-0">
                            <img src="{{ Storage::url($service->image)}}" class="card__img" alt="Desainin Service Category">
                            <div class="card__header">
                                <h2 class="card__heading service__title">{{ $service->title }}</h2>
                            </div>
                            <div class="card__body service__content">
                                <p>{{ $service->description }}</p>
                                <p>{{ $service->agent->name }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </section>
        @endforeach
        {{-- @foreach ($services as $service)
        <div>service : {{$service->title}}</div>
        <div>description : {{$service->description}}</div>
        <div>agent : {{$service->agent->name}}</div>
        <div>package :</div>
        <div>
            <ul>
                @foreach ($service->package as $package)
                <li>{{ $package->title }} seharga {{ $package->price }}</li>
                @endforeach
            </ul>
        </div>
        <hr>
        @endforeach --}}
    </div>
@endsection
