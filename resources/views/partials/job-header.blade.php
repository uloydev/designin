<header>
    <div class="row mb-5 justify-content-between">
        <div class="col-12">
            <form class="navbar-search d-block navbar-search-light mr-sm-3 transform-none" method="get"
            action="{{ route('agent.list-request.search') }}">
                <div class="form-group mb-0">
                    <div class="input-group input-group-alternative input-group-merge">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="search-job">
                                <i class="fas fa-search"></i>
                            </label>
                        </div>
                        <input class="form-control" placeholder="Search by date or budget and click enter . . ." value="{{ $searching ?? '' }}"
                        type="text" id="search-job" name="search_order" required>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row justify-content-between mb-4">
        <div class="col-12 col-lg-7" id="filter-job">
            <div class="card">
                <ul class="nav">
                    {{-- <li class="nav-item">
                        <a class="nav-link text-center" href="{{ route('agent.list-request.incoming') }}">
                            Incoming Job
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        @if (Route::currentRouteName() === 'agent.list-request.index')
                            <a class="nav-link text-center active" href="{{ route('agent.list-request.index') }}">
                                Unfinished Job
                            </a>
                        @else
                            <a class="nav-link text-center" href="{{ route('agent.list-request.index') }}">
                                Unfinished Job
                            </a>
                        @endif
                    </li>
                    <li class="nav-item">
                        @if (Route::currentRouteName() === 'agent.list-request.history')
                            <a class="nav-link text-center active" href="{{ route('agent.list-request.history') }}">
                                Finished Job
                            </a>
                        @else
                            <a class="nav-link text-center" href="{{ route('agent.list-request.history') }}">
                                Finished Job
                            </a>
                        @endif
                    </li>
                    <li class="nav-item">
                        @if (Route::currentRouteName() === 'agent.list-request.complaint')
                            <a class="nav-link text-center active" href="{{ route('agent.list-request.complaint') }}">
                                Complaining Job
                            </a>
                        @else
                            <a class="nav-link text-center" href="{{ route('agent.list-request.complaint') }}">
                                Complaining Job
                            </a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="row mx-0 align-items-center justify-content-between">
                <label for="filter-request" class="text-white col-12 col-md-auto mb-3 mb-md-0 text-center">
                    Sort By
                </label>
                <div class="col-12 col-md-6 col-lg-8">
                    <form id="form-sort-job" action="" method="get">
                        <label for="sort-job" class="d-none">sort job</label>
                        <select name="sort" class="nice-select wide text-capitalize" id="sort-job">
                            <option value="budget-desc" {{ (session('sort') == 'budget-desc') ? 'selected=selected' : '' }}>Highest budget</option>
                            <option value="budget-asc" {{ (session('sort') == 'budget-asc') ? 'selected=selected' : '' }}>Cheapest budget</option>
                            <option value="duration-desc" {{ (session('sort') == 'duration-desc') ? 'selected=selected' : '' }}>Highest duration</option>
                            <option value="duration-asc" {{ (session('sort') == 'duration-asc') ? 'selected=selected' : '' }}>Lowest duration</option>
                            <option value="time-desc" {{ (!session('sort') or session('sort') == 'time-desc') ? 'selected=selected' : '' }}>Latest</option>
                            <option value="time-asc" {{ (session('sort') == 'time-asc') ? 'selected=selected' : '' }}>Oldest</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
