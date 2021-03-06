@extends('layouts.admin-master')
@section('page-id', 'managePromo')
@section('page-name', 'Promo Management')
@section('page-title', 'Manage Promo')
@section('header')
    <div class="row mb-4">
        <div class="col-12">
            <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#addPromo">
                Add new promo
            </button>
        </div>
    </div>
@endsection
@section('content')
    @if (session('create'))
        <div class="alert alert-success" role="alert">
            {{ session('create') }}
        </div>
    @elseif(session('edit'))
        <div class="alert alert-success" role="alert">
            {{ session('edit') }}
        </div>
    @elseif(session('delete'))
        <div class="alert alert-success" role="alert">
            {{ session('delete') }}
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                {{-- table must be scrollable --}}
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort">Promo name</th>
                                <th scope="col" class="sort">Start date</th>
                                <th scope="col" class="sort">End date</th>
                                <th scope="col" class="sort">Code</th>
                                <th scope="col" class="sort">Discount</th>
                                <th scope="col" class="sort">Limit</th>
                                <th scope="col" class="sort" colspan="2">Usage</th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @foreach ($promos as $promo)
                                <tr>
                                    <td class="promo-name">{{ $promo->name }}</td>
                                    <td class="promo-start">{{ $promo->started_at }}</td>
                                    <td class="promo-end">{{ $promo->ended_at }}</td>
                                    <td class="promo-code">{{ $promo->code }}</td>
                                    <td class="promo-disc">{{ $promo->discount }}%</td>
                                    <td class="promo-limit">{{ $promo->limit }}</td>
                                    <td>{{ $promo->usage }}</td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <button type="button" class="dropdown-item text-warning dropdown-item--edit-promo"
                                                        data-toggle="modal" data-target="#editPromo" data-id="{{$promo->id}}">
                                                    Edit
                                                </button>
                                                <button type="button" class="dropdown-item text-danger dropdown-item--delete-promo"
                                                        data-toggle="modal" data-target="#deletePromo" data-id="{{$promo->id}}">
                                                    Delete
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer border-top-0">
                    {{ $promos->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('promo.manipulate')
@endsection
