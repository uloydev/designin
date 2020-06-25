@extends('layouts.customer-master')
@section('page-id', 'userSubscription')
@section('page-title','My Subscription')
@section('header')
    @include('partials.nav')
@endsection
@section('script')
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
                    @forelse($mySubscription as $subscription)
                        <article class="profile-main-item">
                            <img src="{{ Storage::url($subscription->img) }}" class="profile-main__order-img"
                                 alt="order image">
                            <div class="profile-main__order-detail ml-lg-5">
                                <p class="mb-3">
                                    Subscription name:
                                    <span class="subscription__title">
                                        {{ Str::words($subscription->title, 5) }}
                                    </span>
                                </p>
                                <p class="mb-3">From: <time>{{ $subscription->created_at->format('d M Y') }}</time></p>
                                <p class="mb-3">
                                    Price:
                                    <var class="profile-main-item__price">{{ 'IDR ' . $subscription->price }}</var>
                                </p>
                                <a href="" class="btn btn-success mb-3">Pay now</a>
                                <a class="profile-main-item__link btn-modal"
                                   data-target="#modal-subscription-detail"
                                   data-subscription-title="{{ $subscription->title }}"
                                   data-subscription-detail="{{ $subscription->desc }}"
                                   data-subscription-img="{{ Storage::url($subscription->img) }}"
                                   data-subscription-duration="{{ $subscription->duration }}"
                                   href="javascript:void(0);">
                                    See details
                                </a>
                            </div>
                        </article>
                    @empty
                        <article class="profile-main-item flex-column align-items-center justify-content-start col-12">
                            <img src="{{ asset('img/zero-state.svg') }}" alt="No subscribtion found">
                            <p class="mt-4">
                                You never subscribe anything.
                                <a href="{{ route('landing-page'). '#subscription' }}" class="text-link">
                                    Let's subscribe
                                </a>
                            </p>
                        </article>
                    @endforelse
                </div>
                {{ $mySubscription->links() }}
            </section>
        </div>
    </div>
@endsection
@push('element')
    <div class="modal" id="modal-subscription-detail">
        <div class="modal__content" style="overflow: auto">
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
