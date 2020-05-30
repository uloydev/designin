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
                        <p class="text-center text-md-left mb-3">Order deadline: <time>{{ $order->deadline }}</time></p>
                        @if (Auth::user()->role === 'agent')
                            <p class="text-center text-md-left">Customer name: <time>{{ $order->user->name }}</time></p>
                        @else
                            <p class="text-center text-md-left">Agent name: <time>{{ $order->agent->name }}</time></p>
                        @endif
                    </div>
                </div>
                @if (Auth::user()->role === 'agent')
                    <a href="{{ route('agent.list-request.index') }}" class="order-detail__back-btn">
                        <i class='bx bx-arrow-back mr-3'></i> Back
                    </a>
                @else
                    <a href="{{ route('user.order.index') }}" class="order-detail__back-btn">
                        <i class='bx bx-arrow-back mr-3'></i> Back
                    </a>
                @endif
                <a href="javascript:void(0);" class="btn" id="get-chat">get chat</a>
            </aside>
            <section class="order-chat">
                @if (count($messages) > 0)
                    <div class="order-chat__top">
                        <div class="row flex-column mx-0" id="chat-list"></div>
                    </div>
                @else
                    <div class="order-chat__top text-center">
                        No chat before. Let's chat now!
                    </div>
                @endif
                @if (Route::currentRouteName() === 'agent.chat.index')
                    <form class="order-chat__send-box" method="post" action="{{ route('agent.chat.store') }}">
                        @csrf
                        <input type="hidden" value="{{ Auth::id() }}" name="sender_id" required readonly>
                        <input type="hidden" value="{{ $order->id }}" name="order_id" required readonly>
                        <label for="chat" class="d-none">send chat</label>
                        <input type="text" id="chat" name="message" class="input-custom input-custom--rounding"
                        placeholder="Type a message . . ." autocomplete="off" required>
                        <button type="submit" class="btn order-chat__send-btn"><i class='bx bxs-send'></i></button>
                    </form>
                @elseif (Route::currentRouteName() === 'user.chat.index')
                    <form class="order-chat__send-box" method="post" action="{{ route('user.chat.store') }}">
                        @csrf
                        <input type="hidden" value="{{ Auth::id() }}" name="sender_id" required readonly>
                        <input type="hidden" value="{{ $order->id }}" name="order_id" required readonly>
                        <label for="chat" class="d-none">send chat</label>
                        <input type="text" id="chat" name="message" class="input-custom input-custom--rounding"
                        placeholder="Type a message . . ." autocomplete="off" required>
                        <button type="submit" class="btn order-chat__send-btn"><i class='bx bxs-send'></i></button>
                    </form>
                @endif
            </section>
        </div>
    </div>
@endsection
@section('script')
    <script>
        const orderId = document.querySelector('input[name="order_id"]').value;
        const role = '{{ Auth::user()->role }}';
        setInterval(function () {
            $.get('/' + role + '/order/' + orderId + '/get-chat', function (data) {
                $("#chat-list").empty().html(data);
            });
            const listChatHeight = document.querySelector('.order-chat__top .row').scrollHeight;
            document.querySelector('.order-chat__top').scrollTo(0, listChatHeight);
        }, 1000);
    </script>
@endsection
