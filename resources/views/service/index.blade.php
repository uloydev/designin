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
        <div class="col-12 col-md-3 mb-3 mb-md-0">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                @foreach ($serviceCategories as $category)
                    <a class="nav-link {{ $loop->first ? 'active' : '' }} rounded-0"
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
                @foreach ($services as $service)
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                         id="v-pills-{{ Str::slug($service->serviceCategory->name, '-') }}"
                         role="tabpanel"
                         aria-labelledby="v-pills-{{ Str::slug($service->serviceCategory->name, '-') }}-tab">
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
                            <form action="{{ route('manage.service.destroy', $service->id) }}" method="post">
                                @csrf @method("DELETE")
                                <button type="submit" class="btn btn-danger">Remove Service</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @include('service.create')
@endsection
