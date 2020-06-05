@extends('layouts.customer-master')
@section('page-id', 'myTransaction')
@section('page-title', 'Manage Transaction')
@section('header')
    @include('partials.nav')
@endsection
@section('script')
    <script>
        let filter = $('#transaction-filter').val();
        $('#transaction-filter').change(function(){
            if($(this).val() !== filter){
                $('#form-filter-transaction').submit();
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
                <form action="" id="form-filter-transaction" class="profile-main__filter justify-content-lg-start">
                    <label for="transaction-filter" class="mr-lg-auto"><h1>My Transaction</h1></label>
                    <select name="filter" id="transaction-filter" class="profile-main__orderBy wide mt-3 mt-lg-0">
                        <option value="latest" selected>Recent</option>
                        <option value="oldest">Oldest</option>
                        <option value="finish">Finish</option>
                        <option value="process">Unfinished</option>
                    </select>
                </form>
                <div class="profile-main__content">
                    {{-- foreach --}}
                    @foreach ($orders as $order)
                    <article class="profile-main-item">
                        <div class="col profile-main-item__detail">
                            <div class="profile-main__job-detail">
                                <p class="mb-3">
                                    Project name:&nbsp;
                                    <span class="profile-main__job-title">
                                        {{ $order->package->service->title . ' - ' . $order->package->title }}
                                    </span>
                                </p>
                                <p class="mb-3">
                                    Start on:
                                    <time class="mb-3 profile-main__time text-right">
                                        {{ $order->start_at ?? '-' }}
                                    </time>
                                </p>
                                <p class="mb-3">
                                    Finish on:
                                    <time class="mb-3 profile-main__time text-right">
                                        {{ $order->deadline ?? '-' }}
                                    </time>
                                </p>
                                <p class="mb-3">Status:
                                    <span data-status="unpaid" class="profile-main-item__status">
                                        {{ $order->status }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </article>
                    @endforeach
                    {{-- endforeach --}}
                </div>
            </section>
        </div>
    </div>
@endsection
