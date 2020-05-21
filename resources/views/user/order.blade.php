@extends('layouts.customer-master')
@section('page-title', 'Order Management')
@section('page-id', 'userOrder')
@section('header')
    <header>
        @include('partials.nav')
    </header>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-between align-items-start">
            @include('user.profile')
            <section class="profile-main">
                @include('partials.profile-nav')
                <form action="" class="profile-main__filter">
                    <label for="order-filter"><h1>Your order</h1></label>
                    <select name="" id="order-filter" class="profile-main__orderBy wide mt-3 mt-lg-0">
                        <option value="">All order</option>
                        <option value="">Completed</option>
                        <option value="">Active</option>
                        <option value="">Canceled</option>
                    </select>
                </form>
                <div class="profile-main__content">
                    @forelse($orders as $order)
                    <article class="profile-main-item">
                        <img src="{{ Storage::url($order->package->image) }}" class="profile-main__order-img"
                             alt="order image {{ $order->id }}" data-id="{{ $order->id }}">
                        <div class="profile-main__order-detail ml-xl-5">
                            <div class="mb-3">
                                What you order
                                <span class="profile-main__title">{{ $order->package->title }}</span>
                            </div>
                            <div class="mb-3">
                                Start on:
                                <time class="profile-main__time">{{ $order->started_at }}</time>
                            </div>
                            <div class="mb-3">
                                Finish on:
                                <time class="profile-main__time">{{ $order->deadline }}</time>
                            </div>
                            <div class="mb-3">
                                Progress
                                <progress max="100" value="{{ $order->progress }}">{{ $order->progress }}</progress>
                            </div>
                        </div>
                    </article>
                    @empty
                        <img src="{{ asset('img/empty-state.svg') }}" alt="No request" class="mx-auto d-block my-5">
                        <h1 class="text-center display-4 text-muted">You have no order</h1>
                    @endforelse
                </div>
            </section>
        </div>
    </div>
@endsection
@push('element')
    <div class="overlay overlay--nav-showed"></div>
@endpush
