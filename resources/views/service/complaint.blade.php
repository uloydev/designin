@extends('layouts.admin-master')
@section('page-id', 'ongoingJob')
@section('page-name', 'Ongoing Job')
@section('page-title', 'Job Ongoing')
@section('header')
    @include('partials.job-header')
    @if (session('success'))
        <div class="text-center mb-5 alert alert-default" role="alert">
            {{ session('success') }}
        </div>
    @endif
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="mb-0">Complaint Job</h3>
                </div>
                <div class="card-body">
                    <div class="accordion" id="accordion-request">
                        @forelse ($complaints as $order)
                            <article class="accordion__item" id="complaintRequest{{ $loop->index + 1 }}">
                                <div id="heading{{ $order->id }}" class="d-flex mb-2 align-items-center">
                                    <h2 class="mb-0 d-inline-block mr-auto job-agent-title">
                                        <button class="btn btn-link collapsed text-capitalize" type="button"
                                                data-toggle="collapse" data-target="#collapse{{ $order->id }}"
                                                aria-expanded="false" aria-controls="collapse{{ $order->id }}">
                                            <i class="fas fa-chevron-up rotate-180 mr-2"></i>
                                            {{ Str::words($order->package->service->title, 5) ?? 'service deleted by admin' }}
                                            {{ '(' . $order->package->title . ')' }}
                                        </button>
                                    </h2>
                                    <button type="button" class="btn btn-outline-default btn-sm mr-3"
                                    data-toggle="modal" data-target="#modal-revision" data-backdrop="static"
                                    data-id="{{ $order->id }}" data-title="{{ $order->title }}">
                                        Send revision ({{ $order->max_revision - $order->revision->count() }} left)
                                    </button>
                                </div>
                                <div id="collapse{{ $order->id }}" class="collapse"
                                aria-labelledby="heading{{ $order->id }}" data-parent="#accordion-request">
                                    <div class="card-body">
                                        {{ $order->request }}
                                    </div>
                                    <div class="card-footer border-top-0 py-0">
                                        <p>Customer: <span>{{ $order->user->email }}</span></p>
                                        <time class="text-muted">
                                            Complained At : {{ $order->updated_at->format('d M Y') }}
                                        </time>
                                    </div>
                                </div>
                                @if (!empty($order->result))
                                        <div class="mb-3 d-flex flex-column flex-md-row">
                                            <a href="{{ route('order.result.download',
                                            ['id'=>$order->id, 'result_id'=>$order->result->id]) }}" class="btn text-warning">
                                                Download Result
                                            </a>
                                        </div>
                                    @endif
                                    @if ($order->revision->count() > 0)
                                        @foreach ($order->revision as $revision)
                                            <div class="mb-3 d-flex flex-column flex-md-row">
                                                <a href="{{ route('order.result.download',
                                                ['id'=>$order->id, 'result_id'=>$revision->id]) }}" class="btn text-warning">
                                                    Download Revision {{ $loop->iteration }}
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif
                            </article>
                        @empty
                            <img src="{{ asset('img/work-done.jpg') }}" alt="No complain job"
                            class="mx-auto d-block" height="250">
                            <h1 class="text-center display-4 text-muted">Good job! You have no ongoing job</h1>
                        @endforelse
                    </div>
                </div>
                @if ($totalComplaint > 10)
                    <div class="card-footer border-top-0">
                        {{ $complaints->links()  }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    @include('service.approval')
@endsection
