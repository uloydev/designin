@extends('layouts.admin-master')
@section('page-id', 'incomingJob')
@section('page-name', 'Incoming Job')
@section('page-title', 'Job Incoming')
@section('header')
    @include('partials.job-header')
@endsection
@section('content')
    <div class="alert alert-success alert-dismissible no-fadeout d-none" role="alert" id="alert-approve">
        <span class="alert-text text-capitalize">Successfully approve job</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @if (session('reject'))
        <div class="alert alert-success alert-dismissible d-none" role="alert" id="alert-approve">
            <span class="alert-text text-capitalize">{{ session('reject') }}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="mb-0">Incoming Job</h3>
                </div>
                <div class="card-body">
                    <div class="accordion" id="accordion-request">
                        @forelse ($orders as $order)
                        <article class="accordion__item" data-id="{{ $order->id }}">
                            <div id="heading{{$order->id}}" class="d-flex mb-2 align-items-center">
                                <h2 class="mb-0 d-inline-block mr-auto job-agent-title">
                                    <button class="btn btn-link collapsed text-capitalize" type="button"
                                    data-toggle="collapse" data-target="#collapse{{ $loop->index + 1 }}"
                                    aria-expanded="false" aria-controls="collapse{{ $loop->index + 1 }}">
                                        <i class="fas fa-chevron-up rotate-180 mr-2"></i>{{$order->package->title}}
                                    </button>
                                </h2>
                                <button type="button" class="btn btn-link p-0 text-success mr-3" data-toggle="modal"
                                data-target="#modal-approval" data-backdrop="static" data-id="{{$order->id}}">
                                    <i class="fas fa-check-circle"></i>
                                </button>
                                <button type="button" class="btn btn-link text-danger p-0" data-toggle="modal"
                                data-target="#modal-rejection" data-backdrop="static" data-id="{{$order->id}}">
                                    <i class="fas fa-times-circle"></i>
                                </button>

                            </div>
                            <div id="collapse{{ $loop->index + 1 }}" class="collapse"
                            aria-labelledby="heading{{$loop->index + 1}}" data-parent="#accordion-request">
                                <div class="card-body">
                                    {{$order->request}}
                                </div>
                                <div class="card-footer">
                                    <p>From : <span class="customer-email">{{ $order->user->email }}</span></p>
                                    <time>Ordered At : {{ $order->created_at->format('d M Y') }}</time>
                                </div>
                            </div>
                        </article>
                        @empty
                            <img src="{{ asset('img/empty-state.svg') }}" alt="No request"
                            class="mx-auto d-block my-5">
                            <h1 class="text-center display-4 text-muted">Just chill! You have no incoming job</h1>
                        @endforelse
                    </div>
                </div>
                <div class="card-footer border-top-0">
                    {{ $orders->links()  }}
                </div>
            </div>
        </div>
    </div>
    @include('service.approval')
@endsection
