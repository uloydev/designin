@extends('layouts.admin-master')
@section('page-id', 'manageAgent')
@section('page-title', 'Manage Agent')
@section('page-name', 'Manage Agent')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @elseif(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header border-0 justify-content-between d-flex align-items-center flex-column flex-md-row">
            <h3 class="mb-0">Agent management</h3>
            <form action="{{ route('manage.agent.search') }}" class="flex-grow-1 mx-5 my-3 my-md-0" method="get">
                <label for="search_agent" class="d-none">Search agent</label>
                <input type="search" name="search_agent" id="search_agent" placeholder="Search agent by name or email and click enter"
                class="form-control" value="{{ $query ?? '' }}">
            </form>
            <button type="button" class="btn btn-default btn-sm btn-create-agent" data-toggle="modal" data-target="#modal-manipulate-agent">
                Add new agent
            </button>
        </div>
        <!-- Light table -->
        <div class="table-responsive">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                <tr>
                    <th>Agent Name</th>
                    <th>Agent Email</th>
                    <th>Agent Phone Number</th>
                    <th>Agent Name Card</th>
                    <th>Agent Account Number</th>
                    <th>Agent Bank Using</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="list">
                @forelse ($agents as $agent)
                    <tr class="agent__detail">
                        <td>
                            <div class="media align-items-center">
                                <a class="avatar rounded-circle mr-3" href="#">
                                    <img alt="Desainin Agent {{ $agent->profile->name }}" class="rounded-circle"
                                         src="{{ Storage::url($agent->profile->avatar) }}">
                                </a>
                                <div class="media-body">
                                    <span class="name mb-0 text-sm agent__name">{{ $agent->name }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="agent__email">{{ $agent->email }}</td>
                        <td class="agent__phone">{{ $agent->profile->handphone }}</td>
                        <td class="agent__name-card">
                            @if($agent->profile->name_card != null)
                                <a href="{{ Storage::url($agent->profile->name_card) }}"
                                   class="text-link" target="_blank">
                                    See name card
                                </a>
                            @else
                                No name card provide
                            @endif
                        </td>
                        <td class="agent__acc-number">{{ $agent->profile->account_number }}</td>
                        <td class="agent__bank">{{ $agent->profile->bank }}</td>
                        <td class="text-right">
                            <div class="dropdown">
                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <button type="button" class="dropdown-item btn btn-link text-warning btn-edit-agent"
                                    data-toggle="modal" data-address="{{ $agent->profile->address }}"
                                    data-target="#modal-manipulate-agent" data-id="{{ $agent->id }}">
                                        Edit agent
                                    </button>
                                    <button type="button" class="dropdown-item btn btn-link text-danger btn-delete-agent"
                                    data-toggle="modal" data-target="#modal-remove-agent" data-id="{{ $agent->id }}">
                                        Delete agent
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            No agent found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="col-12">
            {{ $agents->links() }}
        </div>
    </div>
    @include('agent.manipulate')
@endsection
