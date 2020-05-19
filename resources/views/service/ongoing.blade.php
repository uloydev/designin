@extends('layouts.admin-master')
@section('page-id', 'ongoingJob')
@section('page-name', 'Ongoing Job')
@section('page-title', 'Job Ongoing')
@section('header') @include('partials.job-header') @endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="mb-0">Ongoing Job</h3>
                </div>
                <div class="card-body">
                    <div class="accordion" id="accordion-request">
                        @forelse ($ongoings as $order)
                            <article class="accordion__item">
                                <div id="heading{{ $order->id }}" class="d-flex mb-2 align-items-center">
                                    <h2 class="mb-0 d-inline-block mr-auto job-agent-title">
                                        <button class="btn btn-link collapsed text-capitalize" type="button"
                                                data-toggle="collapse" data-target="#collapse{{$order->id}}"
                                                aria-expanded="false" aria-controls="collapse{{$order->id}}">
                                            <i class="fas fa-chevron-up rotate-180 mr-2"></i>
                                            {{ Str::words($order->package->title, 5) }}
                                        </button>
                                    </h2>
                                    <button type="button" class="btn btn-outline-default btn-sm mr-3"
                                    data-toggle="modal" data-target="#modal-revision" data-backdrop="static"
                                    data-id="{{ $order->id }}" data-title="{{ $order->title }}">
                                        Send revision
                                    </button>
                                </div>
                                <div id="collapse{{$order->id}}" class="collapse"
                                aria-labelledby="heading{{$order->id}}" data-parent="#accordion-request">
                                    <div class="card-body">
                                        {{$order->request}}
                                    </div>
                                    <div class="card-footer">
                                        <time>Ordered At : {{$order->created_at}}</time>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="alert alert-secondary mb-0 no-fadeout" role="alert">
                                <span class="alert-text">
                                    No ongoing job
                                </span>
                            </div>
                        @endforelse
                    </div>
                </div>
                <div class="card-footer border-top-0">
                    {{ $ongoings->links()  }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('element')
    <div class="modal fade" id="modal-revision" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Send revision for job <span class="modal-job-title"></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form-revision-job" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="custom-file">
                            <input type="file" class="custom-file-input invisible file-custom__input" id="revision">
                            <label class="custom-file-label" for="revision">Send Revision file</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer d-flex justify-between">
                    <button type="button" class="btn btn-link text-gray" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" form="form-revision-job">
                        Send
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
