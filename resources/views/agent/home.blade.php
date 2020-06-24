@extends('layouts.admin-master')
@section('page-title', 'Agent Dashboard')
@section('page-id', 'agentDashboard')
@section('page-name', 'My Dashboard')
@section('header')
    <div class="row">
        <div class="col-xl-4 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <a href="{{ route('agent.service.index') }}" class="d-block">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">My Service</h5>
                                <span class="h2 font-weight-bold mb-0">{{$serviceCount}} Post</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                    <i class="fas fa-truck-loading"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <a href="{{ route('agent.list-request.index')}}" class="d-block">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Unfinished Job</h5>
                                <span class="h2 font-weight-bold mb-0">{{$unfinishedJobCount}} Project</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                    <i class="fas fa-spinner"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-12">
            <div class="card card-stats">
                <div class="card-body">
                        <a href="{{ route('agent.list-request.history') }}" class="d-block">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Job Past 30 Days</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$lastMonthJobCount}} Project</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-indigo text-white rounded-circle shadow">
                                        <i class="fas fa-clipboard-check"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-0 d-flex justify-between align-items-center">
                    <h3 class="mb-0">Customer Request</h3>
                    <a href="{{ route('agent.list-request.index') }}" class="btn btn-sm btn-default">
                        See more
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th>Order Title</th>
                            <th>Order come in</th>
                            <th>Customer email</th>
                            <th>Status</th>
                            <th colspan="2">Action</th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        @foreach($orders as $order)
                            <tr>
                                <td>
                                    <div class="media align-items-center">
                                        <a href="{{ route('service.show', $order->id) }}"
                                           class="avatar rounded-circle mr-2">
                                            <img alt="Service Cover" height="50px"
                                                 src="{{ Storage::url($order->package->service->image) }}"
                                                 style="width: 50px !important;">
                                        </a>
                                        <div class="media-body">
                                            <span class="name mb-0 text-sm">
                                                {{ Str::words($order->package->service->title, 5) }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $order->created_at->format('d M Y') }}</td>
                                <td>{{ $order->user->email }}</td>
                                <td>{{ $order->status }}</td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#"
                                           role="button" data-toggle="dropdown" aria-haspopup="true"
                                           aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            @switch($order->status)
                                                @case('process')
                                                <a class="dropdown-item text-default"
                                                   href="{{ route('agent.list-request.index') .
                                                   '#availableReqest' . ($loop->index + 1) }}">
                                                    See detail
                                                </a>
                                                @break
                                                @case('complaint')
                                                <a class="dropdown-item text-default"
                                                   href="{{ route('agent.list-request.complaint') .
                                                   '#complaintRequest' . ($loop->index + 1) }}">
                                                    See detail
                                                </a>
                                                @break
                                            @endswitch
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header border-0 bg-default d-flex justify-between align-items-center">
                    <h3 class="mb-0 text-white">My Service Post</h3>
                    <a href="{{ route('agent.service.index') }}" class="btn btn-sm btn-white">See more</a>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush table-dark">
                        <thead class="thead-dark">
                        <tr>
                            <th>Service Title</th>
                            <th>Package</th>
                            <th colspan="2">Category</th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        @foreach($services as $service)
                            <tr>
                                <td>
                                    <div class="media align-items-center">
                                        <a href="{{ route('service.show', $service->id) }}"
                                        class="avatar rounded-circle mr-2">
                                            <img alt="Service Cover" height="50px"
                                            src="{{ Storage::url($service->image) }}"
                                            style="width: 50px !important;">
                                        </a>
                                        <div class="media-body">
                                            <span class="name mb-0 text-sm">
                                                {{ Str::words($service->title, 5) }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @foreach($service->package as $package)
                                        {{ $package->title }}
                                    @endforeach
                                </td>
                                <td>{{ $service->serviceCategory->name }}</td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#"
                                           role="button" data-toggle="dropdown" aria-haspopup="true"
                                           aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item text-default" target="_blank"
                                               href="{{ route('service.show', $service->id) }}">
                                                See service
                                            </a>
                                            <a href="{{ route('agent.service.edit', $service->id) }}"
                                               class="dropdown-item text-warning">
                                                Edit service
                                            </a>
                                            <form action="{{ route('agent.service.destroy', $service->id) }}">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">
                                                    Delete service
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('element')
    <div class="modal fade" id="dashboard-delete-service" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
