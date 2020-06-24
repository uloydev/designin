@extends('layouts.admin-master')
@section('page-id', 'adminDashboard')
@section('page-name', 'Dashboard')
@section('page-title', 'Dashboard')
@section('header')
    <div class="row">
      <div class="col-xl-3 col-md-6">
        <div class="card card-stats">
          <div class="card-body">
            <div class="row">
              <div class="col">
                <h5 class="card-title text-uppercase text-muted mb-0">Total Blog Article</h5>
                <span class="h2 font-weight-bold mb-0">{{ $totalArticle }}</span>
              </div>
              <div class="col-auto">
                <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                  <i class="fas fa-newspaper"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6">
        <div class="card card-stats">
          <!-- Card body -->
          <div class="card-body">
            <div class="row">
              <div class="col">
                <h5 class="card-title text-uppercase text-muted mb-0">Total Promo</h5>
                <span class="h2 font-weight-bold mb-0">{{ $totalPromo }}</span>
              </div>
              <div class="col-auto">
                <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                    <i class="fas fa-tags"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6">
        <div class="card card-stats">
          <!-- Card body -->
          <div class="card-body">
            <div class="row">
              <div class="col">
                <h5 class="card-title text-uppercase text-muted mb-0">Total Agent</h5>
                <span class="h2 font-weight-bold mb-0">{{ $totalAgent }}</span>
              </div>
              <div class="col-auto">
                <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                  <i class="fas fa-user-secret"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6">
        <div class="card card-stats">
          <!-- Card body -->
          <div class="card-body">
            <div class="row">
              <div class="col">
                <h5 class="card-title text-uppercase text-muted mb-0">Total Customer</h5>
                <span class="h2 font-weight-bold mb-0">{{ $totalCustomer }}</span>
              </div>
              <div class="col-auto">
                <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                  <i class="fas fa-users"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card bg-default">
                <div class="card-body">
                    <div class="chart">
                        <!-- Chart wrapper -->
                        <canvas id="income-value" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row mx-0 align-items-center justify-content-between">
                        <h3 class="mb-0">Ongoing / unfinished project</h3>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Service title</th>
                            <th>On worker</th>
                            <th>Price</th>
                            <th>Progress</th>
                            <th>Status</th>
                            <th>Deadline</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $orders->firstItem() + $loop->index }}</td>
                                <td>{{ $order->package->service->title }}</td>
                                <td>{{ $order->agent->email }}</td>
                                <td>{{ 'IDR ' . $order->package->price}}</td>
                                <td>
                                    <div class="progress" style="height: 30px">
                                        <div class="progress-bar px-2" role="progressbar" style="width: {{ $order->progress . '%' }}"
                                             aria-valuenow="{{ $order->progress }}" aria-valuemin="0" aria-valuemax="100">
                                            {{ $order->progress . '%' }}</div>
                                    </div>
                                </td>
                                <td>
                                    @if ($order->status == 'complaint')
                                        <span class="badge badge-warning">{{ $order->status }}</span>
                                    @else
                                        <span class="badge badge-info">{{ $order->status }}</span>
                                    @endif
                                </td>
                                <td>{{ $order->deadline->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row mx-0 align-items-center justify-content-between">
                        <h3 class="mb-0">Latest 10 Article</h3>
                        <a href="{{ route('manage.blog.index') }}" class="btn btn-sm btn-primary">See all</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Category</th>
                                <th>Title</th>
                                <th class="text-center">Show article</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $article)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $article->category->name }}</td>
                                <td>{{ Str::words($article->title, 8) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('manage.blog.show', $article->id) }}" class="btn btn-primary">
                                        See article
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-warning" href="{{ route('manage.blog.edit', $article->id) }}">
                                        Edit
                                    </a>
                                    <button type="button" class="btn btn-danger show-modal" data-toggle="modal"
                                    data-article-title="{{ Str::slug($article->title, '-') }}"
                                    data-target="#delete-article" data-article-id="{{ $article->id }}">Delete</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card bg-default shadow">
                <div class="card-header bg-transparent border-0">
                    <div class="row mx-0 justify-content-between align-items-center">
                        <h3 class="text-white mb-0">Our Services</h3>
                        <a href="{{ route('manage.service.index') }}" class="btn btn-sm btn-secondary">
                            See all services
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-dark table-flush">
                        <thead class="thead-dark">
                        <tr>
                            <th>Service Name</th>
                            <th>Category</th>
                            <th colspan="2">Agent</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $service)
                            <tr>
                                <td>
                                    <div class="media align-items-center">
                                        <img class="rounded-circle mr-2" height="30" width="30"
                                        alt="Image placeholder" src="{{ Storage::url($service->image)  }}">
                                        <div class="media-body">
                                            <span class="name mb-0 text-sm">{{ $service->title  }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $service->serviceCategory->name  }}</td>
                                <td>{{ $service->agent->name }}</td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item text-primary"
                                               href="{{ route('manage.service.show', $service->id) }}">
                                                See details
                                            </a>
                                            <a class="dropdown-item text-warning"
                                               href="{{ route('manage.service.edit', $service->id)  }}">
                                                Edit
                                            </a>
                                            <form action="{{ route('manage.service.destroy', $service->id) }}"
                                                  class="dropdown-item" method="post">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-link p-0 text-danger">
                                                    delete
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
    @include('blog.manipulate')
@endsection
@push('script')
    <script>
        $(document).ready(function () {
            var SalesChart = (function() {
                const $chart = $('#income-value');
                function init($chart) {
                    let salesChart = new Chart($chart, {
                        type: 'line',
                        options: {
                            scales: {
                                yAxes: [{
                                    gridLines: {
                                        lineWidth: 1,
                                        color: Charts.colors.gray[900],
                                        zeroLineColor: Charts.colors.gray[900]
                                    },
                                    ticks: {
                                        callback: function(value) {
                                            if (!(value % 10)) {
                                                return '$' + value + 'k';
                                            }
                                        }
                                    }
                                }]
                            },
                            tooltips: {
                                callbacks: {
                                    label: function(item, data) {
                                        let label = data.datasets[item.datasetIndex].label || '',
                                            yLabel = item.yLabel,
                                            content = '';

                                        if (data.datasets.length > 1) {
                                            content += '$' + yLabel + 'k';
                                        }

                                        content += '$' + yLabel + 'k';
                                        return content;
                                    }
                                }
                            }
                        },
                        data: {
                            labels: [
                                'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                            ],
                            datasets: [{
                                label: 'Income',
                                data: [
                                    @for($i = 1; $i <= count($incomeArr); $i++)
                                    {{ $incomeArr[$i] }},
                                    @endfor
                                ]
                            }]
                        }
                    });
                    // Save to jQuery object
                    $chart.data('chart', salesChart);
                }
                if ($chart.length) {
                    init($chart);
                }

            })();
        });
    </script>
@endpush
