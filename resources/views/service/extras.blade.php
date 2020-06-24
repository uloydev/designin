@extends('layouts.admin-master')
@section('page-title')
    Extras for service {{ $service->title }}
@endsection
@section('page-id', 'showExtra')
@section('page-name')
    <a href="{{ route('manage.service.index') }}" class="mr-2">
        <i class="fas fa-long-arrow-alt-left"></i>
    </a>
    <span class="font-weight-normal">Extras for service {{ $service->title }}</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                    data-target="#modal-manipulate-extra" id="btn-add-extra">
                        Add new extra
                    </button>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @forelse($allExtra as $extra)
                            <li class="list-group-item d-flex align-items-center">
                                <span class="extra-item__name">{{ $extra->name }}</span>
                                <var class="extra-item__price">{{ $extra->price }}</var>
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                data-target="#modal-manipulate-extra" data-id="{{ $service->id }}"
                                data-title="{{ $service->title }}" data-desc="{{ $extra->description }}"
                                data-token="{{ $service->price_token }}" id="btn-edit-extra">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                data-target="#modal-delete-extra" data-id="{{ $service->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </li>
                        @empty
                            <li class="list-group-item">
                                <img src="{{ asset('img/not-found.jpg') }}" alt="Extra not found" height="150"
                                     class="mx-auto d-block mt-5">
                                <h1 class="h3 text-center mt-3">No extras found for this service</h1>
                            </li>
                        @endforelse
                    </ul>
                </div>
                {{ $allExtra->links() }}
            </div>
        </div>
    </div>
@endsection
@section('element')
    <div class="modal fade" id="modal-manipulate-extra" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <span class="modal-manipulate-title"></span> extra
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="form-manipulate-extra">
                        @csrf
                        <div class="form-group">
                            <label for="name-edit">Extra name</label>
                            <input type="text" class="form-control" id="name" name="name_extra"
                            placeholder="Ex: Reduce delivery by 1 day" required>
                        </div>
                        <div class="input-group form-group">
                            <label class="col-12 px-0" for="price">Extra price</label>
                            <div class="input-group-prepend">
                                <div class="input-group-text">Rp</div>
                            </div>
                            <input type="text" class="form-control" name="price_extra"
                            id="price" placeholder="Extra price" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Price token</label>
                            <input type="number" class="form-control" id="name" name="token_extra"
                            placeholder="Price for this extra if they are using token" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" rows="3" name="benefit_extra"
                            placeholder="What will they get if using this extra" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer d-flex justify-between">
                    <button type="button" class="btn btn-link text-gray" data-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-success" form="form-manipulate-extra">
                        <span class="modal-manipulate-title"></span> extra
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-delete-extra" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Delete extra <span class="modal-extra-title"></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure to delete this extra?</p>
                    <p class="text-danger">You can't undo this</p>
                    <form action="" method="post" id="form-delete-extra">
                        @csrf @method('DELETE')
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-danger" form="form-delete-extra">
                        Yes, delete it
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
