@extends('layouts.customer-master')
@section('page-title', 'Order Management')
@section('page-id', 'userOrder')
@section('css') <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> @endsection
@section('header')
    <header>
        @include('partials.nav')
    </header>
@endsection
@section('script')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script>
        let filter = $('#order-filter').val();
        $('#order-filter').change(function(){
            if($(this).val() !== filter){
                $('#form-filter-order').submit();
            }
        });
    </script>
@endsection
@section('content')
    @if (session('success'))
        <div class="alert alert--success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert--error">
            {{ session('error') }}
        </div>
    @endif
    <div class="container">
        <div class="row justify-content-between align-items-start">
            @include('user.profile')
            <section class="profile-main">
                @include('partials.profile-nav')
                <form id="form-filter-order" action="" class="profile-main__filter">
                    <label for="order-filter"><h1>Your order</h1></label>
                    <select name="filter" id="order-filter" class="profile-main__orderBy wide mt-3 mt-lg-0">
                        <option value="all" {{(!session('filter') or session('filter') == 'all') ? 'selected=selected' : ''}}>
                            All order
                        </option>
                        <option value="completed" {{(session('filter') == 'completed') ? 'selected=selected' : ''}}>
                            Completed
                        </option>
                        <option value="process" {{(session('filter') == 'process') ? 'selected=selected' : ''}}>
                            Active
                        </option>
                        <option value="canceled" {{(session('filter') == 'canceled') ? 'selected=selected' : ''}}>
                            Canceled
                        </option>
                    </select>
                </form>
                <div class="profile-main__content">
                    @forelse($orders as $order)
                        <article class="profile-main-item">
                            <img src="{{ Storage::url($order->package->image) }}" class="profile-main__order-img"
                                 alt="order image {{ $order->id }}" data-id="{{ $order->id }}">
                            <div class="profile-main__order-detail ml-xl-5">
                                <div class="mb-3">
                                    What you order
                                    <span class="profile-main__title">
                                        {{ $order->package->service->title ?? 'service deleted by admin'}}
                                    </span>
                                </div>
                                <div class="mb-3">
                                    Start on:
                                    <time class="profile-main__time">
                                        {{ $order->started_at ?? 'not start yet' }}
                                    </time>
                                </div>
                                <div class="mb-3">
                                    Finish on:
                                    <time class="profile-main__time">{{ $order->deadline ?? '-' }}</time>
                                </div>
                                @if ($order->status == 'process')
                                    <div class="mb-3">
                                        Progress
                                        <progress max="100" value="{{ $order->progress }}">{{ $order->progress }}</progress>
                                    </div>
                                @elseif ($order->status != 'process')
                                    <div class="mb-3">
                                        Status
                                        @if ($order->status == 'complaint' or $order->status == 'canceled')
                                            <p class="text-danger font-bold">{{ $order->status }}</p>
                                        @elseif($order->status == 'unpaid')
                                            <p class="text-warning font-bold">{{ $order->status }}</p>
                                        @elseif($order->status == 'check_revision' or $order->status == 'check_result')
                                        <p class="text-success font-bold">{{ $order->status }}</p>
                                        @elseif ($order->waiting == 'waiting')
                                            <p class="text-gray font-bold">{{ $order->status }}</p>
                                        @else
                                            <p class="text-success font-bold">{{ $order->status }}</p>
                                        @endif
                                    </div>
                                    @if (!empty($order->invoice))
                                        <div class="mb-3 d-flex flex-column flex-md-row">
                                            <a href="javascript:void(0);" class="btn" id="pay-button"
                                            data-payment-token="{{$order->invoice->payment_token ?? ''}}">
                                                Pay now
                                            </a>
                                        </div>
                                    @endif
                                @endif
                                    @if (!empty($order->result))
                                        <div class="mb-3 d-flex flex-column flex-md-row">
                                            <a class="btn text-warning"
                                               href="{{ route('order.result.download',
                                               ['id'=>$order->id, 'result_id'=>$order->result->id]) }}">
                                                Download Result
                                            </a>
                                        </div>
                                        @if ($order->status == 'check_result')
                                            <div class="mb-3 d-flex flex-column flex-md-row">
                                                <a class="btn text-success" href="{{ route('user.order.accept',
                                                ['id'=>$order->id, 'result_id'=>$order->result->id]) }}">
                                                    Accept Result
                                                </a>
                                                <a class="btn text-danger" href="{{ route('user.order.reject',
                                                ['id'=>$order->id, 'result_id'=>$order->result->id]) }}">
                                                    Reject Result ({{ $order->max_revision - $order->revision->count() }}
                                                    revision left)
                                                </a>
                                            </div>
                                        @endif
                                    @endif
                                    @if ($order->revision->count() > 0)
                                        @foreach ($order->revision as $revision)
                                            <div class="mb-3 d-flex flex-column flex-md-row">
                                                <a class="btn text-warning" href="{{ route('order.result.download',
                                                   ['id'=>$order->id, 'result_id'=>$revision->id]) }}">
                                                    Download Revision {{ $loop->iteration }}
                                                </a>
                                            </div>
                                        @endforeach
                                        @if ($order->status == 'check_revision')
                                            <div class="mb-3 d-flex flex-column flex-md-row">
                                                <a class="btn text-success" href="{{ route('user.order.accept',
                                                ['id'=>$order->id, 'result_id'=>$order->revision->last()->id]) }}">
                                                    Accept Result
                                                </a>
                                                <a class="btn text-danger" href="{{ route('user.order.reject',
                                                ['id'=>$order->id, 'result_id'=>$order->revision->last()->id]) }}">
                                                    Reject Result
                                                    ({{ $order->max_revision - $order->revision->count() }} revision left)
                                                </a>
                                            </div>
                                        @endif
                                    @endif
                                <div class="row mx-0">
                                    <a href="javascript:void(0);" class="btn-success btn-modal" data-target="#modal-review">
                                        Review
                                    </a>
                                    <a href="{{ route('user.chat.index', $order->id) }}" class="profile-main__btn-chat">
                                        Chat agent
                                    </a>
                                </div>
                            </div>
                        </article>
                    @empty
                        <img src="{{ asset('img/empty-state.svg') }}" alt="No request" class="mx-auto d-block my-5">
                        <h1 class="text-center display-4 text-muted">You have no order</h1>
                    @endforelse
                    {{ $orders->links() }}
                </div>
            </section>
        </div>
    </div>
@endsection
@push('element')
    @include('partials.review-job')
@endpush
