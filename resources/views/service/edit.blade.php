@extends('layouts.admin-master')
@section('page-title')
    Edit Service {{ $service->title }}
@endsection
@section('page-name')
    Edit Service <strong class="font-weight-bolder">{{ $service->title }}</strong>
@endsection()
@section('page-id', 'serviceEdit')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{-- routing on js bcz this page used both in admin & agent edit service --}}" method="post"
                    id="service-edit-form" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <input type="hidden" value="{{ $service->id }}" name="service_id" required readonly>
                        <div class="form-group">
                            <label for="service-title" class="mb-3">Service Name</label>
                            <input type="text" name="service_title" class="form-control text-dark"
                                   id="service-title" placeholder="Insert category name" value="{{ $service->title }}">
                        </div>
                        <div class="form-group">
                            <label for="service-description"></label>
                            <textarea name="service_description" id="service-description"
                             rows="7" class="form-control text-dark"
                             placeholder="Service content">{{ $service->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="service-category">Pick Service Category</label>
                            <select class="custom-select" name="category" id="service-category">
                                <option selected disabled>Category Service</option>
                                @foreach ($serviceCategories as $category)
                                    @if ($service->service_category_id === $category->id)
                                        <option value="{{ $service->service_category_id }}" selected>
                                            {{ $service->serviceCategory->name }}
                                        </option>
                                    @else
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <p class="text-darker">Service Logo</p>
                            <img src="{{ Storage::url($service->image) }}" alt="Service Logo Preview" height="200">
                            <div class="custom-file">
                                <input type="file" name="service_img" class="custom-file-input d-none"
                                       id="serviceLogo" accept="image/*">
                                <label class="custom-file-label" for="serviceLogo">Update Logo</label>
                            </div>
                        </div>
                        <a href="{{ url()->previous() }}" class="btn btn-link text-muted">Cancel</a>
                        <button type="submit" class="btn btn-success">Update service</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
