@extends('layouts.admin-master')
@section('page-id', 'subscription')
@section('page-name', 'Manage Subscription')
@section('page-title', 'Manage Subscription')
@section('header')
    <header>
        <div class="row justify-between align-items-center mb-5">
            <div class="col-12 col-md-auto mb-3 mb-md-0">
                <div class="card card-stats mb-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total subscription item</h5>
                                <span class="h2 font-weight-bold mb-0">{{ $totalSubcription }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-orange text-white rounded-circle shadow">
                                    <i class="fas fa-rss"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-auto">
                <button type="button" class="btn btn-secondary btn-block" data-target="#addSubscription"  data-toggle="modal">
                    Add new subcription
                </button>
            </div>
        </div>
    </header>
@endsection
@section('content')
    <div class="card">
        <div class="row">
            @forelse($subscriptions as $subscription)
                <div class="col-12 col-md-4 col-xl-3">
                    <article class="card shadow-none subscription__item">
                        <img class="card-img-top" src="{{ Storage::url($subscription->img) }}" alt="Subscription Image">
                        <div class="card-header border-bottom-0 d-flex align-items-center justify-between">
                            <h5 class="card-title mb-0">{{ Str::words($subscription->title, 3) }}</h5>
                            <div class="btn-group dropleft">
                                <button type="button" class="btn btn-link text-gray p-0 shadow-none before-none dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <button type="button" class="dropdown-item text-warning" data-id="{{ $subscription->id }}"
                                            data-target="#editSubscription" data-desc="{{ $subscription->desc }}" data-toggle="modal">
                                        edit
                                    </button>
                                    <button type="button" class="dropdown-item text-danger" data-toggle="modal"
                                            data-target="#deleteSubscription" data-id="{{ $subscription->id }}">
                                        delete
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-text subscription__detail">
                                {!! Str::words($subscription->desc, 10) !!}
                            </div>
                            <a href="{{ route('manage.subscription.show', $subscription->id) }}" class="text-primary">
                                See item
                            </a>
                            <span class="badge badge-default float-md-right">{{ 'IDR ' . $subscription->price }}</span>
                        </div>
                    </article>
                </div>
            @empty
                <div class="alert alert-light" role="alert">
                    No subscription item
                </div>
            @endforelse
        </div>
    </div>
    @if ($totalSubcription > 12)
        {{ $subscriptions->links() }}
    @endif
    @include('subscription.manipulate')
@endsection
