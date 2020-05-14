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
                    <h2 class="text-gray mt-3">Top service that will serve you as lovely it be</h2>
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
                <div id="service-slider-{{ $category->id }}">
                    @foreach ($category->services as $service)
                        <div class="px-3">
                            <div class="service card p-0">
                                <img src="{{ Storage::url($service->image) }}" class="card__img service__img-item"
                                     alt="Desainin Service Category">
                                <div class="card__header">
                                    <h3 class="service__title">{{ Str::limit($service->title, 35) }}</h3>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ Storage::url($service->agent->profile->avatar) }}"
                                             alt="Service agent avatar" height="20">
                                        <h4 class="ml-2 service__agent-name">{{ $service->agent->name }}</h4>
                                    </div>
                                </div>
                                <div class="card__body service__content">
                                    {!! Str::limit($service->description, 150) !!}
                                </div>
                                <div class="service__action">
                                    <p class="service__rating">Rating : {{ $service->rating }}</p>
                                    <span>Start at: <var>IDR 300,000</var></span>
                                    <a href="{{ route('service.show', $service->id) }}" class="service__goto">
                                        <span>click service</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @empty
            <div class="alert alert--light">
                No service category
            </div>
        @endforelse
    </div>
@endsection
