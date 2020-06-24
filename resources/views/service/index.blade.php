@extends('layouts.admin-master')
@section('page-title', 'Manage Service')
@section('page-id', 'service')
@section('page-name', 'Service Management')
@section('css')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endsection
@section('header')
    <header class="mb-5 d-flex align-items-center">
        <button type="button" class="btn btn-success btn-sm mr-auto" data-toggle="modal"
        data-target="#create-service">
            Create Service
        </button>
        @if (Auth::user()->role === 'admin')
            <a href="{{ route('manage.service-category.index') }}" class="btn btn-sm btn-default">
                Manage category
            </a>
        @endif
    </header>
@endsection
@section('content')
    @if (session('success_update'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="alert-text">{{ session('success_update') }}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif (session('delete'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="alert-text">{{ session('delete') }}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif (session('progress'))
        <div class="col-12 alert alert-success alert-dismissible fade show" role="alert">
            <span class="alert-text">{{ session('progress') }}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif (session('create'))
        <div class="col-12 alert alert-success alert-dismissible fade show" role="alert">
            <span class="alert-text">{{ session('create') }}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row">
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
            <div class="tab-content card-body" id="service-manage">
                @foreach ($serviceCategories as $category)
                    <div class="tab-pane fade" id="v-pills-{{ Str::slug($category->name, '-') }}"
                    role="tabpanel" aria-labelledby="v-pills-{{ Str::slug($category->name, '-') }}-tab">
                        <div class="carousel slide" id="carouselService{{ Str::slug($category->name, '-') }}"
                             data-ride="carousel" data-interval="0" data-wrap="false">
                            <div class="carousel-inner">
                                @if (count($services->where('service_category_id', $category->id)) > 1)
                                    @forelse ($services->where('service_category_id', $category->id) as $service)
                                        <article class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                            <figure class="service__content">
                                                <img src="{{ Storage::url($service->image) }}"
                                                     alt="Desainin Service {{ $service->serviceCategory->name }}">
                                                <figcaption>
                                                    <div class="service__desc">
                                                        <p class="service__title">{{ $service->title }}</p>
                                                        @if (Auth::user()->role === 'admin')
                                                            <div class="btn-group dropleft">
                                                                <button type="button" aria-haspopup="true"
                                                                class="btn btn-link dropdown-toggle"
                                                                data-toggle="dropdown" aria-expanded="false">
                                                                    <i class="fas fa-ellipsis-v"></i>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <div class="dropdown-item">
                                                                            <a class="btn btn-link btn-sm text-gray-dark d-block"
                                                                               href="{{ route('manage.service-extras.index', $service->id) }}">
                                                                                See extras
                                                                            </a>
                                                                    </div>
                                                                    <div class="dropdown-item">
                                                                        <a class="btn btn-link btn-sm mr-auto text-gray-dark d-block"
                                                                           href="{{ route('manage.package.index', $service->id) }}">
                                                                            Manage package
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="service__detail">
                                                        {!! Str::limit($service->description, 250) !!}
                                                    </div>
                                                    @if (Auth::user()->role === 'admin')
                                                        <p class="badge badge-default">
                                                            Owner agent name : {{ $service->agent->name }}
                                                        </p>
                                                    @endif
                                                </figcaption>
                                            </figure>
                                            <div class="service__action">
                                                @if (Auth::user()->role == 'agent')
                                                    <a href="{{ route('agent.service.edit', $service->id) }}"
                                                       class="btn btn-success">
                                                        Edit
                                                    </a>
                                                    <button type="button" class="btn btn-danger" id="from-agent"
                                                    data-toggle="modal" data-target="#modal-delete-service"
                                                    data-id="{{ $service->id }}" data-title="{{ $service->title }}">
                                                        Remove Service
                                                    </button>
                                                @else
                                                    <a href="{{ route('manage.service.edit', $service->id) }}"
                                                    class="btn btn-success">
                                                        Edit
                                                    </a>
                                                    <button type="button" class="btn btn-danger"
                                                    data-toggle="modal" data-target="#modal-delete-service"
                                                    data-id="{{ $service->id }}" data-title="{{ $service->title }}">
                                                        Remove Service
                                                    </button>
                                                @endif
                                            </div>
                                        </article>
                                    @empty
                                        <article class="carousel-item active">
                                            <img src="{{ asset('img/our-service.jpg') }}" alt="">
                                        </article>
                                    @endforelse
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
                                @elseif (count($services->where('service_category_id', $category->id)) === 1)
                                    @forelse ($services->where('service_category_id', $category->id) as $service)
                                    <article>
                                        <figure class="service__content">
                                            <img src="{{ Storage::url($service->image) }}"
                                                 alt="Desainin Service {{ $service->serviceCategory->name }}">
                                            <figcaption>
                                                <div class="service__desc">
                                                    <p class="service__title">{{ $service->title }}</p>
                                                    @if (Auth::user()->role === 'admin')
                                                        <div class="btn-group dropleft">
                                                            <button type="button" aria-haspopup="true"
                                                                    class="btn btn-link dropdown-toggle"
                                                                    data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fas fa-ellipsis-v"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <div class="dropdown-item">
                                                                    <a class="btn btn-link btn-sm text-gray-dark d-block"
                                                                       href="{{ route('manage.service-extras.index', $service->id) }}">
                                                                        See extras
                                                                    </a>
                                                                </div>
                                                                <div class="dropdown-item">
                                                                    <a class="btn btn-link btn-sm mr-auto text-gray-dark d-block"
                                                                       href="{{ route('manage.package.index', $service->id) }}">
                                                                        Manage package
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="service__detail">
                                                    {!! Str::limit($service->description, 250) !!}
                                                </div>
                                                @if (Auth::user()->role === 'admin')
                                                    <p class="badge badge-default">
                                                        Owner agent name : {{ $service->agent->name }}
                                                    </p>
                                                @endif
                                            </figcaption>
                                        </figure>
                                        <div class="service__action">
                                            @if (Auth::user()->role == 'agent')
                                                <a href="{{ route('agent.service.edit', $service->id) }}"
                                                   class="btn btn-success">
                                                    Edit
                                                </a>
                                                <button type="button" class="btn btn-danger" id="from-agent"
                                                data-toggle="modal" data-target="#modal-delete-service"
                                                data-id="{{ $service->id }}" data-title="{{ $service->title }}">
                                                    Remove Service
                                                </button>
                                            @else
                                                <a class="btn btn-success" href="{{ route('manage.service.edit', $service->id) }}">
                                                    Edit
                                                </a>
                                                <button type="button" class="btn btn-danger"
                                                data-toggle="modal" data-target="#modal-delete-service"
                                                data-id="{{ $service->id }}" data-title="{{ $service->title }}">
                                                    Remove Service
                                                </button>
                                            @endif
                                        </div>
                                    </article>
                                    @empty
                                        <article class="service__not-found">
                                            <img src="{{ asset('img/our-service.jpg') }}" alt="">
                                        </article>
                                    @endforelse
                                @else
                                    <article class="service__not-found">
                                        <img src="{{ asset('img/our-service.jpg') }}" alt="No service found" height="200">
                                        <h2 class="h3">No service found in this category</h2>
                                    </article>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @include('service.create-delete')
    @includeWhen(Auth::user()->role === 'admin', 'service.edit-fee')
@endsection
@push('script')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
@endpush
