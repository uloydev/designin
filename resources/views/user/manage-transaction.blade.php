@extends('layouts.customer-master')
@section('page-id', 'myTransaction')
@section('page-title', 'Manage Transaction')
@section('header')
    @include('partials.nav')
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-between align-items-start">
            @include('user.profile')
            <section class="profile-main">
                @include('partials.profile-nav')
                <form action="" class="profile-main__filter justify-content-lg-start">
                    <label for="order-filter" class="mr-lg-auto"><h1>My Transaction</h1></label>
                    <select name="" id="order-filter" class="profile-main__orderBy wide mt-3 mt-lg-0">
                        <option value="" selected>Recent</option>
                        <option value="">Oldest</option>
                        <option value="">Finish</option>
                        <option value="">Unfinished</option>
                    </select>
                </form>
                <div class="profile-main__content">
                    {{-- foreach --}}
                    <article class="profile-main-item">
                        <div class="col profile-main-item__detail">
                            <div class="profile-main__job-detail">
                                <p class="mb-3">
                                    Project name:&nbsp;
                                    <span class="profile-main__job-title">Design landing page</span>
                                </p>
                                <p class="mb-3">
                                    Start on:
                                    <time class="mb-3 profile-main__time text-right">
                                        14 April 2020
                                    </time>
                                </p>
                                <p class="mb-3">
                                    Finish on:
                                    <time class="mb-3 profile-main__time text-right">
                                        14 May 2020
                                    </time>
                                </p>
                                <p class="mb-3">Status:
                                    <span data-status="unpaid" class="profile-main-item__status">
                                        Unpaid
                                    </span>
                                </p>
                            </div>
                        </div>
                    </article>
                    <article class="profile-main-item">
                        <div class="col profile-main-item__detail">
                            <div class="profile-main__job-detail">
                                <p class="mb-3">
                                    Project name:&nbsp;
                                    <span class="profile-main__job-title">Design landing page</span>
                                </p>
                                <p class="mb-3">
                                    Start on:
                                    <time class="mb-3 profile-main__time text-right">
                                        14 April 2020
                                    </time>
                                </p>
                                <p class="mb-3">
                                    Finish on:
                                    <time class="mb-3 profile-main__time text-right">
                                        14 May 2020
                                    </time>
                                </p>
                                <p class="mb-3">Status:
                                    <span data-status="waiting" class="profile-main-item__status">
                                        waiting
                                    </span>
                                </p>
                            </div>
                        </div>
                    </article>
                    <article class="profile-main-item">
                        <div class="col profile-main-item__detail">
                            <div class="profile-main__job-detail">
                                <p class="mb-3">
                                    Project name:&nbsp;
                                    <span class="profile-main__job-title">Design landing page</span>
                                </p>
                                <p class="mb-3">
                                    Start on:
                                    <time class="mb-3 profile-main__time text-right">
                                        14 April 2020
                                    </time>
                                </p>
                                <p class="mb-3">
                                    Finish on:
                                    <time class="mb-3 profile-main__time text-right">
                                        14 May 2020
                                    </time>
                                </p>
                                <p class="mb-3">Status:
                                    <span data-status="process" class="profile-main-item__status">
                                        process
                                    </span>
                                </p>
                            </div>
                        </div>
                    </article>
                    <article class="profile-main-item">
                        <div class="col profile-main-item__detail">
                            <div class="profile-main__job-detail">
                                <p class="mb-3">
                                    Project name:&nbsp;
                                    <span class="profile-main__job-title">Design landing page</span>
                                </p>
                                <p class="mb-3">
                                    Start on:
                                    <time class="mb-3 profile-main__time text-right">
                                        14 April 2020
                                    </time>
                                </p>
                                <p class="mb-3">
                                    Finish on:
                                    <time class="mb-3 profile-main__time text-right">
                                        14 May 2020
                                    </time>
                                </p>
                                <p class="mb-3">Status:
                                    <span data-status="complaint" class="profile-main-item__status">
                                        complaint
                                    </span>
                                </p>
                            </div>
                        </div>
                    </article>
                    <article class="profile-main-item">
                        <div class="col profile-main-item__detail">
                            <div class="profile-main__job-detail">
                                <p class="mb-3">
                                    Project name:&nbsp;
                                    <span class="profile-main__job-title">Design landing page</span>
                                </p>
                                <p class="mb-3">
                                    Start on:
                                    <time class="mb-3 profile-main__time text-right">
                                        14 April 2020
                                    </time>
                                </p>
                                <p class="mb-3">
                                    Finish on:
                                    <time class="mb-3 profile-main__time text-right">
                                        14 May 2020
                                    </time>
                                </p>
                                <p class="mb-3">Status:
                                    <span data-status="finished" class="profile-main-item__status">
                                        finished
                                    </span>
                                </p>
                            </div>
                        </div>
                    </article>
                    {{-- endforeach --}}
                </div>
            </section>
        </div>
    </div>
@endsection
