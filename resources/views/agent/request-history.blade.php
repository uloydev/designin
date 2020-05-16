@extends('layouts.admin-master')
@section('page-title', 'List Request | Job History')
@section('page-id', 'jobHistory')
@section('page-name', 'Finished Job')
@section('css')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection
@section('header')
    @include('partials.job-header')
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="accordion" id="accordionJobHistory">
                @foreach ($orders as $order)
                <div class="card">
                    <div class="card-header d-flex justify-between align-items-center job-history-title">
                        <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse"
                            data-target="#collapse{{ $order->id }}" aria-expanded="true" aria-controls="collapse{{ $order->id }}">
                                <i class="fas fa-chevron-up rotate-180 mr-2"></i>{{$order->package->title}}
                            </button>
                        </h2>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                    data-target="#delete-history-job" data-id="{{$order->id}}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>

                    <div id="collapse{{ $order->id }}" class="collapse show" data-parent="#accordionJobHistory">
                        <div class="card-body">
                            {{$order->request}}
                            <form action="{{--please using ajax--}}" class="mt-3 border-top pt-4">
                                <div class="form-group">
                                    <label for="message-review" class="text-gray">Message to customer</label>
                                    <textarea name="rating_review" class="form-control" id="message-review" rows="10"
                                    placeholder="What what do you think to your customer..." required></textarea>
                                </div>
                                <div class="form-row align-items-center justify-between">
                                    <div class="col">
                                        <label class="text-gray" id="rating">Rating</label>
                                        <div class="review-rating"></div>{{-- fieldname: rating --}}
                                    </div>
                                    <button type="submit" class="btn btn-default">Send Review</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <p class="d-flex justify-between text-default">
                            Start date: <time class="font-weight-600">{{$order->started_at}}</time>
                            </p>
                            <p class="d-flex justify-between text-default">
                            End date: <time class="font-weight-600">{{$order->deadline}}</time>
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('element')
    <div class="modal fade" id="delete-history-job" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove <span class="modal-job-history-title"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        You sure wanna remove
                        <span class="modal-job-history-title font-weight-600"></span> from  history ?
                    </p>
                    <form action="{{--routing on js--}}" method="post" id="form-delete-job-history" class="d-none">
                        @csrf @method('DELETE')
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link text-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" form="form-delete-job-history">Remove it</button>
                </div>
            </div>
        </div>
    </div>
@endsection
