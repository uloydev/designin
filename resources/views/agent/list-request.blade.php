@extends('layouts.admin-master')
@section('page-title', 'List Request | Unfinished Job')
@section('page-id', 'listRequest')
@section('page-name', 'Unfinished Job')
@section('header')
    @include('partials.job-header')
@endsection
@section('content')
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
                                            {{ $order->package->title }}
                                        </button>
                                    </h2>
                                    @if ($order->progress == '100')
                                        <button type="button" class="btn btn-default btn-sm" data-toggle="modal"
                                        data-target="#modal-result" data-backdrop="static" data-id="{{$order->id}}">
                                            Send result
                                        </button>
                                    @endif
                                    <button type="button" class="btn btn-outline-default btn-sm" data-toggle="modal"
                                    data-target="#modal-progress" data-backdrop="static" data-id="{{$order->id}}">
                                        Report progress
                                    </button>
                                </div>
                                <div id="collapse{{$order->id}}" aria-labelledby="heading{{$order->id}}"
                                data-parent="#accordion-request" class="collapse">
                                    <div class="card-body">{!! $order->request !!}</div>
                                    <ul class="card-footer border-top-0 mb-0 pt-0">
                                        <li>
                                            Remaining offer slots for customers
                                            <span class="mb-0 text-primary ml-auto">{{'2'}}</span>
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
    <div class="modal fade" id="modal-progress" tabindex="-1" role="dialog" aria-labelledby="modalProgressTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Report progress for job <span class="modal-job-title"></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" class="col px-4" method="post" id="form-update-job-progress">
                        @csrf @method('PUT')
                        <div class="form-row justify-between align-items-center">
                            <div class="col-9">
                                <input name='progress' type="text" class="progress-job">
                            </div>
                            <div class="col-auto text-right" id="progress-job-val">0</div>
                        </div>
                    </form>
                    <div class="row mx-0 align-items-center mt-2">
                        <p class="mb-0">Progress right now: </p>
                        <div class="col">
                            <div class="progress mt-3">
                                <div class="progress-bar" role="progressbar" style="width: {{ '25' }}%">
                                    {{ '25' }}%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-between">
                    <button type="button" class="btn btn-link text-gray" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-default" form="form-update-job-progress">
                        Update progress
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-result" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Send result for job <span class="modal-job-title"></span> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form-send-job">
                        @csrf @method('PUT')
                        <div class="custom-file">
                            <input type="file" class="custom-file-input invisible file-custom__input" id="sendResult"
                            accept="image/*, .psd, .xd, .sketch, video/mp4, video/x-m4v, video/*, .zip, .rar, .7z">
                            <label class="custom-file-label" for="sendResult">Result file</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer d-flex justify-between">
                    <button type="button" class="btn btn-link text-gray" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-default" form="form-send-job">
                        Send result
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
