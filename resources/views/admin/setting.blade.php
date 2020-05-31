@extends('layouts.admin-master')
@section('page-id', 'adminSetting')
@section('page-title', 'Setting Page')
@section('page-name', 'Setting Page')
@section('content')
    @if (session('success'))
        <div class="alert alert-default" role="alert">{{ session('success') }}</div>
    @elseif($errors->any())
        <div class="col-12">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="h3 mb-0">Token conversion</h1>
                </div>
                <form action="{{ route('admin.convert-token') }}" class="card-body" method="post">
                    @csrf @method('PUT')
                    <div class="form-group">
                        <label class="form-control-label" for="conversion">1 Token to rupiah</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">Rp</span>
                            </div>
                            <input type="text" name="numeral" class="form-control" id="conversion"
                            value="{{ $tokenConversion->numeral }}" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-default">Change conversion</button>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h1 class="mb-0 h3">Manage slider on landing page</h1>
                    <button type="button" class="btn btn-primary shadow-none btn-sm"
                            data-toggle="modal" data-target="#addSlider">
                        Add new slider
                    </button>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($sliders as $slider)
                            <li class="py-4 border-top-0 border-left-0 border-right-0 border-bottom d-flex justify-content-between align-items-center">
                                <img src="{{ Storage::url($slider->img) }}" alt="" height="100">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-secondary shadow-none bg-white text-warning"
                                            data-toggle="modal" data-target="#updateSlider" data-id="{{ $slider->id }}">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-secondary shadow-none bg-white text-danger"
                                            data-toggle="modal" data-target="#deleteSlider" data-id="{{ $slider->id }}">
                                        Delete
                                    </button>
                                </div>
                            </li>
                        @empty
                            <li>
                                No slider on homepage
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('element')
    @include('admin.main-slider')
@endsection
