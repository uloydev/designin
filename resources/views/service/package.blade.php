@extends('layouts.admin-master')
@section('page-title') Package for service {{ $service->title }} @endsection
@section('page-id', 'showPackage')
@section('page-name')
    <a href="{{ route('agent.service.index') }}" class="mr-2">
        <i class="fas fa-long-arrow-alt-left"></i>
    </a>
    <span class="font-weight-normal">Package for service {{ $service->title }}</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
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
                                        data-target="#modal-manipulate-package" data-id="{{ $service->id }}"
                                        data-title="{{ $service->title }}" data-desc="{{ $package->description }}"
                                        data-token="{{ $service->price_token }}" id="btn-edit-package">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#modal-delete-package">
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
    <div class="modal fade" id="modal-manipulate-package" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <span class="modal-manipulate-title"></span> package
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="form-manipulate-package">
                        @csrf
                        <div class="form-group">
                            <label for="name-edit">package name</label>
                            <input type="email" class="form-control" id="name" name="name_package"
                                   placeholder="Ex: Reduce delivery by 1 day" required>
                        </div>
                        <div class="input-group form-group">
                            <label class="col-12 px-0" for="price">package price</label>
                            <div class="input-group-prepend">
                                <div class="input-group-text">Rp</div>
                            </div>
                            <input type="text" class="form-control" name="price_package"
                                   id="price" placeholder="package price" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Price token</label>
                            <input type="number" class="form-control" id="name" name="token_package"
                                   placeholder="Price for this package if they are using token" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" rows="3" name="benefit_package"
                                      placeholder="What will they get if using this package" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer d-flex justify-between">
                    <button type="button" class="btn btn-link text-gray" data-dismiss="modal">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-success" form="form-manipulate-package">
                        <span class="modal-manipulate-title"></span> package
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-delete-package" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Delete package <span class="modal-package-title"></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure to delete this package?</p>
                    <p class="text-danger">You can't undo this</p>
                    <form action="" method="post" id="form-delete-package">
                        @csrf @method('DELETE')
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-danger" form="form-delete-package">
                        Yes, delete it
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
