@extends('layouts.customer-master')
@section('page-id', 'userProfile')
@section('header')
    <header>
        @include('partials.nav')
    </header>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-between">
            <aside class="profile-aside">
                <figure class="profile-aside__box">
                    <img src="{{ asset('img/people.webp') }}" alt="Profile Picture" class="profile-aside__img">
                    <figcaption class="profile-aside__detail">
                        <a href="" class="profile-aside__name">Bariq Dharmawan</a>
                    </figcaption>
                </figure>
                <div class="profile-aside__contact">
                    <p class="profile-aside__text">
                        Email: <a href="mailto:email@gmail.com" class="profile-aside__link">email@gmail.com</a>
                    </p>
                    <p class="profile-aside__text">
                        Phone number: <a href="tel:+6287776196047" class="profile-aside__link">087776196047</a>
                    </p>
                    <p class="profile-aside__text">
                        Address live: <span>DKI Jakarta</span>
                    </p>
                </div>
                <div class="profile-aside__box-info">
                    <p class="profile-aside__text">
                        Finished order: <span class="profile-aside__info">10 order</span>
                    </p>
                    <p class="profile-aside__text">
                        Current order: <span class="profile-aside__info">10 order</span>
                    </p>
                    <p class="profile-aside__text">
                        Join on: <time>Mei 27 2019</time>
                    </p>
                </div>
            </aside>
            <section class="profile-main">
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
                    <article class="profile-main__order">
                        <img src="{{ asset('img/service-design.jpg') }}" class="profile-main__img"
                             alt="order image">
                        <div class="profile-main__order-detail ml-xl-5">
                            <p class="mb-3">Start on:</p>
                            <p class="mb-3">Finish on:</p>
                            <p class="mb-3">Progress</p>
                            <time class="mb-3 text-right">14 April 2020</time>
                            <time class="mb-3 text-right">14 May 2020</time>
                            <progress max="100" value="80">80%</progress>
                        </div>
                    </article>
                    <article class="profile-main__order">
                        <img src="{{ asset('img/service-design.jpg') }}" class="profile-main__img"
                             alt="order image">
                        <div class="profile-main__order-detail ml-xl-5">
                            <p class="mb-3">Start on:</p>
                            <p class="mb-3">Finish on:</p>
                            <p class="mb-3">Progress</p>
                            <time class="mb-3 text-right">14 April 2020</time>
                            <time class="mb-3 text-right">14 May 2020</time>
                            <progress max="100" value="80">80%</progress>
                        </div>
                    </article>
                    <article class="profile-main__order">
                        <img src="{{ asset('img/service-design.jpg') }}" class="profile-main__img"
                             alt="order image">
                        <div class="profile-main__order-detail ml-xl-5">
                            <p class="mb-3">Start on:</p>
                            <p class="mb-3">Finish on:</p>
                            <p class="mb-3">Progress</p>
                            <time class="mb-3 text-right">14 April 2020</time>
                            <time class="mb-3 text-right">14 May 2020</time>
                            <progress max="100" value="80">80%</progress>
                        </div>
                    </article>
                </div>
            </section>
        </div>
    </div>
@endsection
@section('element')
    <div class="overlay overlay--nav-showed"></div>
@endsection
