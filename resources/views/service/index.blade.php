@extends('layouts.admin-master')
@section('page-title', 'Manage Service')
@section('page-id', 'service')
@section('header')
    <header class="mb-5 d-flex align-items-center">
        <h1 class="text-white mb-0 mr-auto">Service Management</h1>
        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#create-service">
            Create Service
        </button>
        <a href="{{ route('manage.service-category.index') }}" class="btn btn-sm btn-default">Manage category</a>
    </header>
@endsection
@section('content')
    <div class="row">
        @if (session('create'))
            <div class="col-12 alert alert-success alert-dismissible fade show" role="alert">
                <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                <span class="alert-text">{{ session('create') }}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="col-12 col-md-3 mb-3 mb-md-0">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                @foreach ($serviceCategories as $category)
                    <a class="nav-link rounded-0"
                       id="v-pills-{{ Str::slug($category->name, '-')  }}-tab" data-toggle="pill" role="tab"
                       href="#v-pills-{{ Str::slug($category->name, '-') }}"
                       aria-controls="v-pills-{{ Str::slug($category->name, '-') }}"
                       aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>
        <div class="col-12 col-md-9 card mb-0">
            <div class="tab-content card-body" id="v-pills-tabContent">
                @foreach ($serviceCategories as $category)
                    <div class="tab-pane fade"
                    id="v-pills-{{ Str::slug($category->name, '-') }}"
                    role="tabpanel"
                    aria-labelledby="v-pills-{{ Str::slug($category->name, '-') }}-tab">
                        <div class="carousel slide" id="carouselService{{ Str::slug($category->name, '-') }}"
                             data-ride="carousel" data-interval="0" data-wrap="false">
                            <div class="carousel-inner">
                                @if (count($category->services) > 1)
                                    @foreach ($category->services as $service)
                                        <article class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                            <figure class="service__content">
                                                <img src="{{ Storage::url($service->image) }}"
                                                     alt="Desainin Service {{ $service->serviceCategory->name }}">
                                                <figcaption>
                                                    <p class="service__title">{{ $service->title }}</p>
                                                    <p class="service__detail">{{ $service->description }}</p>
                                                </figcaption>
                                            </figure>
                                            <div class="service__action">
                                                @if (Auth::user()->role == 'agent' AND $service->agent_id == Auth::id())
                                                <a href="{{ route('manage.service.edit', $service->id) }}"
                                                   class="btn btn-success">
                                                    Edit
                                                </a>
                                                @else
                                                <a href="{{ route('manage.service.edit', $service->id) }}"
                                                   class="btn btn-success">
                                                    Edit
                                                </a>
                                                @endif
                                                <button type="button" class="btn btn-danger"
                                                        data-toggle="modal" data-target="#modal-delete-service"
                                                        data-id="{{ $service->id }}" data-title="{{ $service->title }}">
                                                    Remove Service
                                                </button>
                                            </div>
                                        </article>
                                    @endforeach
                                    <a class="carousel-control-prev"
                                       href="#carouselService{{ Str::slug($category->name, '-') }}"
                                       role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next"
                                       href="#carouselService{{ Str::slug($category->name, '-') }}"
                                       role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                @elseif (count($category->services) === 1)
                                    <article>
                                        <figure class="service__content">
                                            <img src="{{ Storage::url($service->image) }}"
                                                 alt="Desainin Service {{ $service->serviceCategory->name }}">
                                            <figcaption>
                                                <p class="service__title">{{ $service->title }}</p>
                                                <p class="service__detail">{{ $service->description }}</p>
                                            </figcaption>
                                        </figure>
                                        <div class="service__action">
                                            @if (Auth::user()->role == 'agent' AND $service->agent_id == Auth::id())
                                            <a href="{{ route('manage.service.edit', $service->id) }}" class="btn btn-success">
                                                Edit
                                            </a>
                                            @else
                                            <a href="{{ route('manage.service.edit', $service->id) }}" class="btn btn-success">
                                                Edit
                                            </a>
                                            @endif
                                            <button type="button" class="btn btn-danger"
                                            data-toggle="modal" data-target="#modal-delete-service"
                                            data-id="{{ $service->id }}" data-title="{{ $service->title }}">
                                                Remove Service
                                            </button>
                                        </div>
                                    </article>
                                @else
                                    <div class="alert alert-secondary" role="alert">
                                        No record found
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @include('service.create-delete')
@endsection
