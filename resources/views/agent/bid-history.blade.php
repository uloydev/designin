@extends('layouts.admin-master')
@section('page-id', 'bidHistory')
@section('page-title', 'My Bid History')
@section('page-name', 'My Bid History')
@section('header')
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Total Bid</h5>
                            <span class="h2 font-weight-bold mb-0">350,897</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-default text-white rounded-circle">
                                <i class="ni ni-chart-bar-32"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Bid Active</h5>
                            <span class="h2 font-weight-bold mb-0">2,356</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-orange text-white rounded-circle">
                                <i class="ni ni-chart-pie-35"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Won Bid</h5>
                            <span class="h2 font-weight-bold mb-0">924</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Lost Bid</h5>
                            <span class="h2 font-weight-bold mb-0">49</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-danger text-white rounded-circle">
                                <i class="fas fa-times"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row mx-0">
        <div class="col-12 card">
            <form action="" class="row mx-0 align-items-center mt-4 mb-2">
                <label for="filter-history-job" class="mb-0 col-auto">Sort By</label>
                <select name="" id="filter-history-job" class="nice-select col col-md-3 wide">
                    <option value="" selected>All</option>
                    <option value="">Bid won</option>
                    <option value="">Bid lost</option>
                </select>
            </form>
            <div class="accordion" id="accordionHistoryJob">
                <div class="p-3">
                    <div class="d-flex align-items-center" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse"
                            data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Project Title
                            </button>
                        </h2>
                        <span class="text-gray ml-auto">28 Apr 2020</span>
                        <div class="btn-group dropleft ml-2">
                            <button type="button" class="btn btn-secondary dropdown-toggle"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item text-danger" href="#">Delete</a>
                                <a class="dropdown-item" href="#" target="_blank">See project</a>
                            </div>
                        </div>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                    data-parent="#accordionHistoryJob">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                        terry richardson ad squid. 3 wolf moon officia aute, non cupidatat
                        skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                        Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin
                        coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica,
                        craft beer labore wes anderson cred nesciunt sapiente ea proident.
                        Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                        farm-to-table, raw denim aesthetic synth nesciunt you probably haven't
                        heard of them accusamus labore sustainable VHS.
                        <p class="mt-3 mb-0">
                            Status: <span class="badge badge-success">Won</span>
                        </p>
                    </div>
                </div>
                <div class="p-3">
                    <div class="d-flex align-items-center" id="headingTwo">
                        <h2 class="mb-0 font-bold">
                            <button class="btn btn-link collapsed" type="button"
                            data-toggle="collapse" data-target="#collapseTwo"
                            aria-expanded="false" aria-controls="collapseTwo">
                                Project Title 2
                            </button>
                        </h2>
                        <span class="text-gray ml-auto">28 Apr 2020</span>
                        <div class="btn-group dropleft ml-2">
                            <button type="button" class="btn btn-secondary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item text-danger" href="#">Delete</a>
                                <a class="dropdown-item" href="#" target="_blank">See project</a>
                            </div>
                        </div>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                    data-parent="#accordionHistoryJob">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                        terry richardson ad squid. 3 wolf moon officia aute, non cupidatat
                        skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                        Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin
                        coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica,
                        craft beer labore wes anderson cred nesciunt sapiente ea proident.
                        Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                        farm-to-table, raw denim aesthetic synth nesciunt you probably haven't
                        heard of them accusamus labore sustainable VHS.
                        <p class="mt-3 mb-0">
                            Status: <span class="badge badge-success">Won</span>
                        </p>
                    </div>
                </div>
                <div class="p-3">
                    <div id="headingThree" class="d-flex align-items-center">
                        <h2 class="mb-0 font-bold">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseThree" aria-expanded="false"
                            aria-controls="collapseThree">
                                Project Title 3
                            </button>
                        </h2>
                        <span class="text-gray ml-auto">28 Apr 2020</span>
                        <div class="btn-group dropleft ml-2">
                            <button type="button" class="btn btn-secondary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item text-danger" href="#">Delete</a>
                                <a class="dropdown-item" href="#" target="_blank">See project</a>
                            </div>
                        </div>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                    data-parent="#accordionHistoryJob">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                        terry richardson ad squid. 3 wolf moon officia aute, non cupidatat
                        skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                        Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin
                        coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica,
                        craft beer labore wes anderson cred nesciunt sapiente ea proident.
                        Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                        farm-to-table, raw denim aesthetic synth nesciunt you probably haven't
                        heard of them accusamus labore sustainable VHS.
                        <p class="mt-3 mb-0">
                            Status: <span class="badge badge-success">Won</span>
                        </p>
                    </div>
                </div>
            </div>
{{--            {{ $vars->links() }}--}}
        </div>
    </div>
@endsection
