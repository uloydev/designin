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
                    <article class="profile-main-item">
                        <img src="{{ asset('img/service-design.jpg') }}" class="profile-main__order-img"
                             alt="order image">
                        <div class="profile-main__order-detail ml-xl-5">
                            <p class="mb-3">Start on:</p>
                            <p class="mb-3">Finish on:</p>
                            <p class="mb-3">Progress</p>
                            <time class="mb-3 profile-main__time text-right">14 April 2020</time>
                            <time class="mb-3 profile-main__time text-right">14 May 2020</time>
                            <progress max="100" value="80">80%</progress>
                        </div>
                    </article>
                    <article class="profile-main-item">
                        <img src="{{ asset('img/service-design.jpg') }}" class="profile-main__order-img"
                             alt="order image">
                        <div class="profile-main__order-detail ml-xl-5">
                            <p class="mb-3">Start on:</p>
                            <p class="mb-3">Finish on:</p>
                            <p class="mb-3">Progress</p>
                            <time class="mb-3 profile-main__time text-right">14 April 2020</time>
                            <time class="mb-3 profile-main__time text-right">14 May 2020</time>
                            <progress max="100" value="80">80%</progress>
                        </div>
                    </article>
                    <article class="profile-main-item">
                        <img src="{{ asset('img/service-design.jpg') }}" class="profile-main__order-img"
                             alt="order image">
                        <div class="profile-main__order-detail ml-xl-5">
                            <p class="mb-3">Start on:</p>
                            <p class="mb-3">Finish on:</p>
                            <p class="mb-3">Progress</p>
                            <time class="mb-3 profile-main__time text-right">14 April 2020</time>
                            <time class="mb-3 profile-main__time text-right">14 May 2020</time>
                            <progress max="100" value="80">80%</progress>
                        </div>
                    </article>
                </div>
            </section>
        </div>
    </div>
@endsection
@push('element')
    <div class="overlay overlay--nav-showed"></div>
@endpush
