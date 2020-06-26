@extends('layouts.customer-master')
@section('page-id', 'userSubscription')
@section('page-title','My Subscription')
@section('header')
    @include('partials.nav')
@endsection
@section('script')
    <script data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}" src="https://app.midtrans.com/snap/snap.js"></script>
    <script>
        let filter = $('#sub-filter').val();
        $('#sub-filter').change(function(){
            if($(this).val() !== filter){
                $('#sub-filter-form').submit();
            }
        });
    </script>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-between align-items-start">
            @include('user.profile')
            <section class="profile-main">
                @include('partials.profile-nav')
                <form action="" id="sub-filter-form" class="profile-main__filter">
                    <label for="sub-filter">
                        <h1>My Subscription</h1>
                        <a href="{{ route('landing-page'). '#subscription' }}" class="text-link mt-2 d-inline-block">
                            Buy new subscription
                        </a>
                    </label>
                    <select name="filter" id="sub-filter" class="profile-main__orderBy wide mt-3 mt-lg-0">
                        <option value="latest"
                            {{ (!session('filter') or session('filter') == 'latest') ? 'selected=selected' : '' }}>
                            Latest
                        </option>
                        <option value="oldest"
                            {{ (session('filter') == 'oldest' ? 'selected=selected' : '') }}>
                            Oldest
                        </option>
                    </select>
                </form>
                <div class="profile-main__content">
                    @if (!empty($mySubscription))
                        <article class="profile-main-item">
                            <img src="{{ Storage::url($mySubscription->img) }}" class="profile-main__order-img"
                                 alt="order image">
                            <div class="profile-main__order-detail ml-lg-auto">
                                <p class="mb-3">
                                    Subscription name:
                                    <span class="subscription__title">
                                        {{ Str::words($mySubscription->title, 5) }}
                                    </span>
                                </p>
                                <p class="mb-3">From: <time>{{ $mySubscription->created_at->format('d M Y') }}</time></p>
                                <p class="mb-3">
                                    Price:
                                    <var class="profile-main-item__price money-formatting">
                                        {{ $mySubscription->price }}
                                    </var>
                                </p>
                                <p class="mb-3">Status : {{ $mySubscription->payment_status }}</p>
                                <a href="javascript:void(0);" class="profile-main-item__link btn-modal"
                                   data-target="#modal-subscription-detail"
                                   data-subscription-title="{{ $mySubscription->title }}"
                                   data-subscription-detail="{{ $mySubscription->desc }}"
                                   data-subscription-img="{{ Storage::url($mySubscription->img) }}"
                                   data-subscription-duration="{{ $mySubscription->duration }}">
                                    See details
                                </a>
                            </div>
                        </article>
                    @else
                        <article class="profile-main-item flex-column align-items-center justify-content-start col-12">
                            <img src="{{ asset('img/zero-state.svg') }}" alt="No subscribtion found">
                            <p class="mt-4">
                                You never subscribe anything.
                                <a href="{{ route('landing-page'). '#subscription' }}" class="text-link">
                                    Let's subscribe
                                </a>
                            </p>
                        </article>
                    @endif
                    @forelse ($subscriptionHistory as $order)
                        <article class="profile-main-item">
                            <img src="{{ Storage::url($order->subscription->img) }}" class="profile-main__order-img" alt="order image">
                            <div class="profile-main__order-detail ml-lg-auto">
                                <p class="mb-3">
                                    Subscription name: <span>{{ Str::words($order->subscription->title, 5) }}</span>
                                </p>
                                <p class="mb-3">From: <time>{{ $order->subscription->created_at->format('d M Y') }}</time></p>
                                <p class="mb-3">
                                    Price:
                                    <var class="profile-main-item__price money-formatting">
                                        {{ $order->subscription->price }}
                                    </var>
                                </p>
                                <p class="mb-3">Status : {{ $order->payment_status }}</p>
                                @if ($order->payment_status == "unpaid")
                                    <div class="mb-3">
                                        <a href="javascript:void(0);" class="btn d-flex btn-pay"
                                        data-payment-token="{{$order->payment_token ?? ''}}">
                                            Pay now
                                        </a>
                                    </div>
                                @endif
                                <a href="javascript:void(0);" class="profile-main-item__link btn-modal"
                                    data-target="#modal-subscription-detail"
                                    data-subscription-title="{{ $order->subscription->title }}"
                                    data-subscription-detail="{{ $order->subscription->desc }}"
                                    data-subscription-img="{{ Storage::url($order->subscription->img) }}"
                                    data-subscription-duration="{{ $order->subscription->duration }}">
                                    See details
                                </a>
                            </div>
                        </article>
                    @empty
                        <article class="profile-main-item flex-column align-items-center justify-content-start col-12">
                            <p class="mt-4">
                                You don't have subscription history.
                            </p>
                        </article>
                    @endforelse
                    {{ $subscriptionHistory->links() }}
                </div>
            </section>
        </div>
    </div>
@endsection
@push('element')
    <div class="modal" id="modal-subscription-detail">
        <div class="modal__content">
            <div class="modal__header">
                <h1 class="modal__title mb-0">{{--text on js--}}</h1>
                <a href="javascript:void(0);" class="btn-close-modal"><i class='bx bx-x'></i></a>
            </div>
            <div class="modal__body">
                <span id="modal-subscription-duration" class="mb-3 d-block text-success font-bold"></span>
            </div>
        </div>
    </div>
@endpush
