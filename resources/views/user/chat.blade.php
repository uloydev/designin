@extends('layouts.customer-master')
@section('page-id', 'userChat')
@section('page-title', 'Chat Desainin')
@section('header')
    <header>
        @include('partials.nav')
    </header>
@endsection
@section('content')
    <div class="container">
        <div class="row mx-0">
            <aside class="order-detail justify-content-md-between justify-content-lg-start">
                <img src="{{ Storage::url($order->package->image) }}" alt="order {{ $order->id }}" class="order-detail__img">
                <div class="order-detail__info">
                    <div class="order-detail__capt">
                        <h1 class="text-gray text-center text-md-left mt-2 mb-3 mt-md-0">
                            {{ $order->package->service->title }}
                        </h1>
                        @if ($order->attachment <> '')
                            <p class="text-center text-md-left mb-2 mb-md-0 mb-lg-3">
                                File you attach:
                                <a href="{{ Storage::url($order->attachment) }}" target="_blank" class="text-link">
                                    See File
                                </a>
                            </p>
                        @endif
                    </div>
                    <div class="order-detail__capt">
                        <p class="mb-3 text-center text-md-left">Order start: <time>{{ $order->started_at }}</time></p>
                        <p class="text-center text-md-left">Order deadline: <time>{{ $order->deadline }}</time></p>
                    </div>
                </div>
                <a href="{{ route('user.order.index') }}" class="order-detail__back-btn">
                    <i class='bx bx-arrow-back mr-3'></i> Back
                </a>
            </aside>
            <section class="order-chat">
                <div class="order-chat__top">
                    <div class="row flex-column mx-0">
                        <div class="order-chat__wrapper">
                            <div class="order-chat__agent">
                                <img class="order-chat__avatar" src="{{ Storage::url('temporary/avatar-agent.jpg') }}"
                                     alt="Agent avatar">
                                <div class="order-chat__box">
                                    <p class="order-chat__message">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. A animi cum, enim ipsa mollitia nemo
                                        quasi? Dicta, exercitationem, sunt. Maiores.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="order-chat__wrapper">
                            <div class="order-chat__myself">
                                <img class="order-chat__avatar" src="{{ Storage::url('temporary/people.webp') }}"
                                     alt="Customer avatar">
                                <div class="order-chat__box">
                                    <p class="order-chat__message">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. A animi cum, enim ipsa mollitia nemo
                                        quasi? Dicta, exercitationem, sunt. Maiores.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="order-chat__wrapper">
                            <div class="order-chat__agent">
                                <img class="order-chat__avatar" src="{{ Storage::url('temporary/avatar-agent.jpg') }}"
                                     alt="Agent avatar">
                                <div class="order-chat__box">
                                    <p class="order-chat__message">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. A animi cum, enim ipsa mollitia nemo
                                        quasi? Dicta, exercitationem, sunt. Maiores.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="order-chat__wrapper">
                            <div class="order-chat__myself">
                                <img class="order-chat__avatar" src="{{ Storage::url('temporary/people.webp') }}"
                                     alt="Customer avatar">
                                <div class="order-chat__box">
                                    <p class="order-chat__message">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. A animi cum, enim ipsa mollitia nemo
                                        quasi? Dicta, exercitationem, sunt. Maiores.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="order-chat__wrapper">
                            <div class="order-chat__agent">
                                <img class="order-chat__avatar" src="{{ Storage::url('temporary/avatar-agent.jpg') }}" alt="Agent avatar">
                                <div class="order-chat__box">
                                    <p class="order-chat__message">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. A animi cum, enim ipsa mollitia nemo
                                        quasi? Dicta, exercitationem, sunt. Maiores.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="order-chat__wrapper">
                            <div class="order-chat__myself">
                                <img class="order-chat__avatar" src="{{ Storage::url('temporary/people.webp') }}" alt="Customer avatar">
                                <div class="order-chat__box">
                                    <p class="order-chat__message">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. A animi cum, enim ipsa mollitia nemo
                                        quasi? Dicta, exercitationem, sunt. Maiores.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="order-chat__wrapper">
                            <div class="order-chat__agent">
                                <img class="order-chat__avatar" src="{{ Storage::url('temporary/avatar-agent.jpg') }}" alt="Agent avatar">
                                <div class="order-chat__box">
                                    <p class="order-chat__message">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. A animi cum, enim ipsa mollitia nemo
                                        quasi? Dicta, exercitationem, sunt. Maiores.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="order-chat__wrapper">
                            <div class="order-chat__myself">
                                <img class="order-chat__avatar" src="{{ Storage::url('temporary/people.webp') }}" alt="Customer avatar">
                                <div class="order-chat__box">
                                    <p class="order-chat__message">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. A animi cum, enim ipsa mollitia nemo
                                        quasi? Dicta, exercitationem, sunt. Maiores.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form class="order-chat__send-box" method="post">
                    @csrf
                    <input type="text" class="input-custom input-custom--rounding" placeholder="Type a message . . ." required>
                    <button type="submit" class="btn order-chat__send-btn"><i class='bx bxs-send'></i></button>
                </form>
            </section>
        </div>
    </div>
@endsection
