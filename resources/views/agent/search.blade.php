@extends('layouts.admin-master')
@section('page-id', 'manageAgent')
@section('page-title', 'Manage Agent')
@section('content')
    <div class="card">
        <!-- Card header -->
        <div class="card-header border-0 justify-content-between d-flex align-items-center flex-column flex-md-row">
            <h3 class="mb-0">Agent management</h3>
            <form action="{{ route('manage.agent.search') }}" class="flex-grow-1 mx-5 my-3 my-md-0" method="get">
                <label for="search_agent" class="d-none">search agent</label>
                <input type="search" name="search_agent" id="search_agent" placeholder="Search agent by name or email and click enter"
                class="form-control" value="{{ $query }}">
            </form>
            <button type="button" class="btn btn-default btn-sm" id="btn-create-agent"
            data-toggle="modal" data-target="#modal-edit-agent">
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
                @foreach ($agents as $agent)
                    <tr>
                        <td>
                            <div class="media align-items-center">
                                <a class="avatar rounded-circle mr-3" href="#">
                                    <img alt="Desainin Agent {{ $agent->profile->name }}" class="rounded-circle"
                                         src="{{ Storage::url($agent->profile->avatar) }}">
                                </a>
                                <div class="media-body">
                                    <span class="name mb-0 text-sm" id="agent__name">{{ $agent->name }}</span>
                                </div>
                            </div>
                        </td>
                        <td id="agent__email">{{ $agent->email }}</td>
                        <td id="agent__phone">{{ $agent->profile->handphone }}</td>
                        <td id="agent__name-card">{{ $agent->profile->name_card }}</td>
                        <td id="agent__acc-number">{{ $agent->profile->account_number }}</td>
                        <td id="agent__bank" class="text-uppercase">{{ $agent->profile->bank }}</td>
                        <td class="text-right">
                            <div class="dropdown">
                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <button type="button" class="dropdown-item btn btn-link text-warning edit-agent"
                                    data-toggle="modal" data-address="{{ $agent->profile->address }}"
                                    data-target="#modal-edit-agent" data-id="{{ $agent->id }}">
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
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-12">
            {{ $agents->links() }}
        </div>
    </div>
    @include('agent.manipulate')
@endsection
