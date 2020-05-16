<header>
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
                        <a class="nav-link text-center" href="{{ route('agent.list-request.incoming') }}">
                            Incoming Job
                        </a>
                    </li>
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
                    <form action="" method="get">
                        <select class="nice-select wide text-capitalize" id="filter-request">
                            <option value="1">Highest budget</option>
                            <option value="1">Cheapest budget</option>
                            <option value="2">Highest duration</option>
                            <option value="2">Cheapest duration</option>
                            <option value="" selected>Latest</option>
                            <option value="">Oldest</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
