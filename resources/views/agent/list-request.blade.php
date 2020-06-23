@extends('layouts.admin-master')
@section('page-title', 'List Request | Unfinished Job')
@section('page-id', 'listRequest')
@section('page-name', 'Unfinished Job')
@section('header')
    @include('partials.job-header')
@endsection
@section('content')
    <div class="alert alert-danger no-fadeout alert-dismissible fade show" id="alert-error" role="alert" style="display: none">
        Something when wrong. Please <a href="{{ route('contact-us.index') }}">contact admin</a>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="mb-0">All Available Request</h3>
                </div>
                <div class="card-body">
                    <div class="accordion" id="accordion-request">
                        @forelse ($orders as $order)
                            <article class="accordion__item">
                                <div id="heading{{$order->id}}" class="d-flex mb-2 align-items-center">
                                    <h2 class="mb-0 d-inline-block mr-auto job-agent-title">
                                        <button class="btn btn-link collapsed text-capitalize" type="button"
                                        data-toggle="collapse" data-target="#collapse{{$order->id}}"
                                        aria-expanded="false" aria-controls="collapse{{$order->id}}">
                                            <i class="fas fa-chevron-up rotate-180 mr-2"></i>
                                            {{ $order->package->service->title }}
                                            {{ '(' . $order->package->title . ')' }}
                                        </button>
                                    </h2>
                                    @if ($order->progress == '100')
                                        @if ($order->status == 'process')
                                            <button type="button" class="btn btn-default btn-sm" data-toggle="modal"
                                            data-target="#modal-result" data-backdrop="static" data-id="{{$order->id}}">
                                                Send result
                                            </button>
                                        @else
                                            <span class="text-gray">Already finished but customer not accept yet</span>
                                        @endif
                                    @else
                                        <button type="button" class="btn btn-outline-default btn-sm" data-toggle="modal"
                                                data-target="#modal-progress" data-backdrop="static" data-id="{{$order->id}}"
                                                data-progress="{{ $order->progress }}">
                                            Report progress
                                        </button>
                                    @endif
                                </div>
                                @if (!empty($order->result))
                                    <div class="mb-3 d-flex flex-column flex-md-row">
                                        <a href="{{ route('order.result.download',
                                           ['id'=>$order->id, 'result_id'=>$order->result->id]) }}"
                                           class="btn text-warning">Download Result</a>
                                    </div>
                                @endif
                                @if ($order->revision->count() > 0)
                                    @foreach ($order->revision as $revision)
                                        <div class="mb-3 d-flex flex-column flex-md-row">
                                            <a href="{{ route('order.result.download',
                                               ['id'=>$order->id, 'result_id'=>$revision->id]) }}"
                                               class="btn text-warning">Download Revision {{ $loop->iteration }}</a>
                                        </div>
                                    @endforeach
                                @endif
                                <div id="collapse{{$order->id}}" aria-labelledby="heading{{$order->id}}"
                                data-parent="#accordion-request" class="collapse">
                                    <div class="card-body">{!! $order->request !!}</div>
                                    <ul class="card-footer border-top-0 mb-0 pt-0">
                                        <li>
                                            From customer:
                                            <span class="text-primary ml-auto">{{ $order->user->email }}</span>
                                        </li>
                                        <li>
                                            Remaining offer slots for customers
                                            <span class="mb-0 text-primary ml-auto">{{ $order->max_revision }}</span>
                                        </li>
                                        <li>
                                            Progress
                                            <span class="mb-0 text-primary ml-auto mr-3 progress-value">
                                                {{ $order->progress . '%' }}
                                            </span>
                                                <span class="badge badge-pill badge-success progress-done">
                                                <i class="fas fa-check"></i>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="mr-auto">Chat customer</span>
                                            <a href="{{ route('agent.chat.index', $order->id) }}" class="btn-sm btn-info btn">
                                                Click to chat
                                            </a>
                                        </li>
                                        <li>
                                            <span class="mr-auto">Order come in</span>
                                            <time>{{ $order->created_at->format('d M Y') }}</time>
                                        </li>
                                    </ul>
                                </div>
                            </article>
                        @empty
                            <img src="{{ asset('img/empty-state.svg') }}" alt="No request"
                            class="mx-auto d-block my-5">
                            <h1 class="text-center display-4 text-muted">Good job! You have no ongoing job</h1>
                        @endforelse
                    </div>
                </div>
                @if ($totalOrderNotDone > 0)
                    <div class="card-footer border-top-0">
                        {{ $orders->links()  }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('element')
    @include('agent.manage-progress')
@endsection
@push('script')
    <script>
        const params = new URLSearchParams(window.location.search);
        $('#form-sort-job #sort-job').change(function (e) {
            e.preventDefault();
            let url = document.location.href.split('?')[0] + '?';
            if (params.toString() !== "") {
                params.toString().split('&').forEach(element=>{
                    let q = element.split('=');
                    if (q[0] !== 'sort') {
                        url += q[0] + '=' + q[1] + '&';
                    }
                });
            }
            window.location.replace(url + $('#form-sort-job').serialize());
        });
    </script>
@endpush
