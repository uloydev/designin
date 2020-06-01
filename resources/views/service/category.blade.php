@extends('layouts.admin-master')
@section('page-title', 'Service Category Management')
@section('page-id', 'serviceCategory')
@section('header')
    <header class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="text-white mb-0">Service Category Management</h1>
        <button type="button" class="btn btn-default" data-toggle="modal" id="create-service-category"
        data-target="#create-edit-category">
            Create category
        </button>
    </header>
    @if (session('success'))
        <div class="alert alert-default" role="alert">{{ session('success') }}</div>
    @elseif($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
@section('content')
    <ul class="list-group">
        @forelse ($serviceCategory as $category)
            <li class="list-group-item d-flex align-items-center py-4">
                <img src="{{ Storage::url($category->image_url) }}" alt="Desainin Service Category" height="30">
                <span class="ml-2">{{ $category->name }}</span>
                <button type="button" class="btn btn-link text-warning py-0 ml-auto" id="edit-service-category"
                data-toggle="modal" data-target="#create-edit-category"
                data-category-id="{{ $category->id }}" data-category-name="{{ $category->name }}">
                    Edit
                </button>
                <button type="button" class="btn btn-link text-danger py-0" data-toggle="modal"
                data-target="#delete-category" data-category-id="{{ $category->id }}">
                    Remove
                </button>
            </li>
        @empty
            <li class="list-group-item">No category found</li>
        @endforelse
    </ul>
    @include('service.manipulate')
@endsection
