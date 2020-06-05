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
                                        @if (!empty($order->result))
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
                                    @if (!empty($order->result))
                                        <div class="mb-3 d-flex flex-column flex-md-row">
                                            <a href="{{ route('order.result.download', ['id'=>$order->id, 'result_id'=>$order->result->id]) }}" class="btn text-warning">Download Result</a>
                                        </div>
                                    @endif
                                    @if ($order->revision->count() > 0)
                                        @foreach ($order->revision as $revision)
                                            <div class="mb-3 d-flex flex-column flex-md-row">
                                                <a href="{{ route('order.result.download', ['id'=>$order->id, 'result_id'=>$revision->id]) }}" class="btn text-warning">Download Revision {{ $loop->iteration }}</a>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
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
                                        <li>
                                            <span class="mr-auto">Chat customer</span>
                                            <a href="{{ route('agent.chat.index', $order->id) }}" class="btn-sm btn-info btn">
                                                Click to chat
                                            </a>
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
    <div class="modal fade" id="loadingApprove" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <svg class="spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                        <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
                    </svg>
                </div>
            </div>
        </div>
    </div>

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
                    <form action="" class="pr-3" method="post" id="form-update-job-progress">
                        @csrf @method('PUT')
                        <div class="form-row mx-0 justify-content-between align-items-center">
                            <div class="col-9">
                                <input name='progress' type="text" class="progress-job" data-slider-value="0">
                            </div>
                            <div id="progress-job-val">0</div>
                        </div>
                    </form>
                    <div class="row mx-0 align-items-center mt-2">
                        <p class="mb-0">Progress right now: </p>
                        <div class="col">
                            <div class="progress mt-3">
                                <div class="progress-bar">{{-- value on js --}}</div>
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
                    <form method="post" action="{{-- routing on js --}}" id="form-send-job" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="result-message">Message to customer</label>
                            <textarea name="message" id="result-message" placeholder="Message result"
                            class="form-control" rows="10" required></textarea>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input invisible file-custom__input"
                            id="sendResult" name="result_file"
                            accept="image/*, .psd, .xd, .sketch, .mp4, .zip, .rar, .7z, .pdf">
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
