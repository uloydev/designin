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
                        <option value="latest" {{(!session('filter') or session('filter') == 'latest') ? 'selected=selected' : ''}}>
                            Latest
                        </option>
                        <option value="oldest" {{(session('filter') == 'oldest' ? 'selected=selected' : '')}}>
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
                                    Subscription name: <span>{{ Str::words($subscription->title, 5) }}</span>
                                </p>
                                <p class="mb-3">From: <time>{{ $subscription->created_at->format('d M Y') }}</time></p>
                                <p class="mb-3">
                                    Price:
                                    <var class="profile-main-item__price">{{ 'IDR ' . $subscription->price }}</var>
                                </p>
                                <a href="{{ route('user.subscription.show', $subscription->id)  }}" class="profile-main-item__link">
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
