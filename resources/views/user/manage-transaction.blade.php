@extends('layouts.customer-master')
@section('page-id', 'myTransaction')
@section('page-title', 'Manage Transaction')
@section('header')
    @include('partials.nav')
@endsection
@section('css') <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> @endsection
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
                        <option value="latest" {{(!session('filter') or session('filter') == 'latest') ? 'selected=selected' : ''}}>
                            Recent
                        </option>
                        <option value="oldest" {{(session('filter') == 'oldest') ? 'selected=selected' : ''}}>Oldest</option>
                        <option value="finish" {{(session('filter') == 'finish') ? 'selected=selected' : ''}}>Finish</option>
                        <option value="process" {{(session('filter') == 'process') ? 'selected=selected' : ''}}>Unfinished</option>
                    </select>
                </form>
                <div class="profile-main__content">
                    @forelse ($orders as $order)
                    <article class="profile-main-item">
                        <div class="col profile-main-item__detail">
                            <div class="profile-main__job-detail">
                                <p class="mb-3">
                                    Project name:&nbsp;
                                    <span class="profile-main__job-title">
                                        {{ '(' . $order->package->title . ') ' . Str::limit($order->package->service->title, 20) }}
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
                                <div class="mb-3 d-flex justify-content-between align-items-center">
                                    Status:
                                    <span data-status="unpaid" class="profile-main-item__status">
                                        {{ $order->status }}
                                    </span>
                                </div>
                                @if (!$order->is_reviewed)
                                <div class="mb-3 d-flex justify-content-between align-items-center">
                                    Review
                                    <a href="javascript:void(0);" class="btn-success btn-modal" data-target="#modal-review">
                                        Click to review
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </article>
                    @empty
                        <img src="{{ asset('img/empty-state.svg') }}" alt="No request" class="mx-auto d-block my-5">
                        <h1 class="text-center display-4 text-muted">You have no transaction</h1>
                    @endforelse
                </div>
                {{ $orders->links() }}
            </section>
        </div>
    </div>
@endsection
@push('element')
    @isset($order)
        @includeWhen($order->is_reviewed == false AND $order->status === 'finished', 'partials.review-job')
    @endisset
@endpush
