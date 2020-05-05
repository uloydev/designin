@extends('layouts.admin-master')
@section('page-id', 'serviceEdit')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1>Edit service <strong>{{ $service->title }}</strong></h1>
                </div>
                <div class="card-body pt-0">
                    <form action="{{ route('manage.service.update', $service->id) }}" method="post"
                          id="service-edit-form" enctype="multipart/form-data">
                        @csrf @method('PUT')
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
                            <img src="" alt="Service Logo Preview">
                            <div class="custom-file">
                                <input type="file" name="service_img" class="custom-file-input d-none"
                                       id="serviceLogo" accept="image/*">
                                <label class="custom-file-label" for="serviceLogo">Update Logo</label>
                            </div>
                        </div>
                        <a href="" class="btn btn-link text-muted">Cancel</a>
                        <button type="submit" class="btn btn-success">Update service</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
