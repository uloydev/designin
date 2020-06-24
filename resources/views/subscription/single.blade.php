+@extends('layouts.admin-master')
@section('page-id', 'singleSubscription')
@section('page-title') {{ $subscription->title }} @endsection
@section('page-name')
    <a href="{{ route('manage.subscription.index') }}" class="mr-2 text-white">
        <i class="fas fa-long-arrow-alt-left"></i>
    </a>
    {{ $subscription->title }}
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <img class="card-img-top col-12 col-md-6 col-lg-4 mx-md-auto"
                src="{{ Storage::url($subscription->img) }}" alt="Card image cap">
                <div class="btn-group dropleft position-absolute top-1 right-1">
                    <button type="button" class="btn btn-secondary dropdown-toggle shadow-none before-none"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <div class="dropdown-menu">
                        <button type="button" class="dropdown-item text-warning dropdown-item--edit-subscription"
                                data-toggle="modal" data-id="{{ $subscription->id }}" data-duration="{{ $subscription->duration }}"
                                data-target="#editSubscription" data-desc="{{ $subscription->desc }}"
                                data-title="{{ $subscription->title }}" data-price="{{ $subscription->price }}"
                                data-token="{{ $subscription->token }}">Edit</button>
                        <button type="button" class="btn btn-link text-danger dropdown-item dropdown-item--delete-subscription"
                                data-toggle="modal" data-target="#deleteSubscription" data-id="{{ $subscription->id }}">
                            Delete
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3 justify-between">
                        <h2 class="card-title mb-0">{{ $subscription->title }}</h2>
                        <span class="text-success">
                            Price: <var class="font-style-normal font-bold">{{ $subscription->price }}</var>
                        </span>
                    </div>
                    <div class="card-text">
                        {!! $subscription->desc !!}
                    </div>
                </div>
                <div class="card-footer">
                    <p>Duration: {{ $subscription->duration . ' days' }}</p>
                    <p>Credit: {{ $subscription->token . ' token' }}</p>
                </div>
            </div>
        </div>
    </div>
    @include('subscription.manipulate')
@endsection
