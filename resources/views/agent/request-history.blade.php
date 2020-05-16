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
                <div class="card">
                    <div class="card-header d-flex justify-between align-items-center job-history-title">
                        <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse"
                            data-target="#collapse{{ '1' }}" aria-expanded="true" aria-controls="collapse{{ '1' }}">
                                <i class="fas fa-chevron-up rotate-180 mr-2"></i> Project Title 1
                            </button>
                        </h2>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                        data-target="#delete-history-job" data-id="1">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>

                    <div id="collapse{{ '1' }}" class="collapse show" data-parent="#accordionJobHistory">
                        <div class="card-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson
                            ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck
                            quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird
                            on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                            helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan
                            excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table,
                            raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                            labore sustainable VHS.
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
                                Start date: <time class="font-weight-600">23 Mar 2020</time>
                            </p>
                            <p class="d-flex justify-between text-default">
                                End date: <time class="font-weight-600">23 Apr 2020</time>
                            </p>
                        </div>
                    </div>
                </div>
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
