@extends('layouts.admin-master')
@section('page-title', 'List Request | Unfinished Job')
@section('page-id', 'listRequest')
@section('page-name', 'Unfinished Job')
@section('css')
    <link href="{{ asset('plugin/powerange/dist/powerange.min.css') }}" rel="stylesheet">
@endsection
@section('header')
    <div class="row mb-5 justify-content-between">
        <div class="col-12">
            <form class="navbar-search d-block navbar-search-light mr-sm-3 transform-none" id="navbar-search-main">
                <div class="form-group mb-0">
                    <div class="input-group input-group-alternative input-group-merge">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input class="form-control" placeholder="Search by location, duration, budget" type="text">
                    </div>
                </div>
                <button type="button" class="close" data-action="search-close"
                data-target="#navbar-search-main" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </form>
        </div>
    </div>
    <div class="row justify-content-between mb-4">
        <div class="col-12 col-md-5" id="filter-job">
            <div class="card">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link text-center" href="{{ route('agent.list-request.index') }}">
                            Unifinished Job
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-center" href="{{ route('agent.list-request.history') }}">
                            Finished Job
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="row mx-0 align-items-center">
                <label for="filter-request" class="text-white col-12 col-md-4 mb-3 mb-md-0 text-center">
                    Sort By
                </label>
                <div class="col-12 col-md-8">
                    <select class="nice-select wide text-capitalize" id="filter-request">
                        <option value="1">Highest budget</option>
                        <option value="1">Cheapest budget</option>
                        <option value="2">Highest duration</option>
                        <option value="2">Cheapest duration</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
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
                        {{-- foreach --}}
                        <article class="accordion__item">
                            {{-- headingOne change to heading{{ $var->id }} --}}
                            <div id="headingOne" class="d-flex mb-2 align-items-center">
                                <h2 class="mb-0 d-inline-block mr-auto job-agent-title">
                                    <button class="btn btn-link collapsed text-capitalize" type="button"
                                            data-toggle="collapse" data-target="#collapseOne"
                                            aria-expanded="false" aria-controls="collapseOne">
                                        <i class="fas fa-chevron-up rotate-180 mr-2"></i> Job title one
                                    </button>
                                </h2>
                                <button type="button" class="btn btn-outline-default btn-sm" data-toggle="modal"
                                        data-target="#modal-progress" data-backdrop="static" data-id="1">
                                    Report progress
                                </button>
                                <a href="" class="btn btn-link text-danger">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                            {{-- headingOne change to heading{{ $var->id }} --}}
                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                 data-parent="#accordion-request">
                                <div class="card-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                    terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                                    dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                                    Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin
                                    coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica,
                                    craft beer labore wes anderson cred nesciunt sapiente ea proident.
                                    Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                                    farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard
                                    of them accusamus labore sustainable VHS.
                                </div>
                                <ul class="card-footer border-top-0 mb-0 pt-0">
                                    <li>
                                        Remaining offer slots for customers
                                        <span class="mb-0 text-primary ml-auto">2</span>
                                    </li>
                                    <li>
                                        Progress
                                        <span class="mb-0 text-primary ml-auto mr-3 progress-value">
                                            {{ '100' }}%
                                        </span>
                                        <span class="badge badge-pill badge-success progress-done">
                                            <i class="fas fa-check"></i>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </article>
                        {{-- endforeach --}}
                    </div>
                </div>
{{--                <div class="card-footer border-top-0">--}}
{{--                    {{ $vars->links()  }}--}}
{{--                </div>--}}
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
                                <input type="text" class="progress-job">
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
@endsection
@push('script')
    <script src="{{ asset('plugin/powerange/dist/powerange.min.js') }}"></script>
@endpush

