@extends('layouts.admin-master')
@section('page-title') Package for service {{ $service->title }} @endsection
@section('page-id', 'showPackage')
@section('css') <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet"> @endsection
@section('page-name')
    <a href="{{ route('agent.service.index') }}" class="mr-2">
        <i class="fas fa-long-arrow-alt-left"></i>
    </a>
    <span class="font-weight-normal">Package for service {{ $service->title }}</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            @if($errors->any())
            <div class="alert alert-danger mb-3" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
            </div>
            @elseif(session('success'))
                <div class="alert alert-info mb-3" role="alert">
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="alert alert-warning mb-3" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <div class="card">
                @if (count($allPackage) < 3)
                    <div class="card-header">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#modal-manipulate-package" id="btn-add-package">
                            Add new package
                        </button>
                    </div>
                @endif
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @forelse($allPackage as $package)
                            <li class="list-group-item d-flex align-items-center">
                                <span class="package-item__name">{{ $package->title }}</span>
                                <var class="package-item__price">{{ $package->price }}</var>
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                data-duration="{{ $package->duration }}" data-target="#modal-manipulate-package"
                                data-id="{{ $package->id }}" id="btn-edit-package"
                                data-desc="{{ $package->description }}" data-token="{{ $service->price_token }}">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" id="btn-delete-package"
                                data-target="#modal-delete-package" data-id="{{ $package->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </li>
                        @empty
                            <li class="list-group-item">
                                <img src="{{ asset('img/not-found.jpg') }}" alt="package not found" height="150"
                                     class="mx-auto d-block mt-5">
                                <h1 class="h3 text-center mt-3">No packages found for this service</h1>
                            </li>
                        @endforelse
                    </ul>
                </div>
                {{ $allPackage->links() }}
            </div>
        </div>
    </div>
@endsection
@section('element')
    @include('service.manipulate-package')
@endsection
@push('script')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
@endpush
