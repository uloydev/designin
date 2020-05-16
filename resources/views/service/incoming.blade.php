@extends('layouts.admin-master')
@section('page-id', 'incomingJob')
@section('page-name', 'Incoming Job')
@section('page-title', 'Job Incoming')
@section('header')
    @include('partials.job-header')
@endsection
@section('content')
    @if (session('approval'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="alert-text text-capitalize">{{ session('approval') }}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="mb-0">Incoming Job</h3>
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
                                <button type="button" class="btn btn-link p-0 text-success mr-3" data-toggle="modal"
                                        data-target="#modal-approval" data-backdrop="static" data-id="1">
                                    <i class="fas fa-check-circle"></i>
                                </button>
                                <button type="button" class="btn btn-link text-danger p-0" data-toggle="modal"
                                        data-target="#modal-rejection" data-backdrop="static" data-id="1">
                                    <i class="fas fa-times-circle"></i>
                                </button>

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
                                <div class="card-footer">
                                    <time>20 March 2020 19:50</time>
                                </div>
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
    @include('service.approval')
@endsection
