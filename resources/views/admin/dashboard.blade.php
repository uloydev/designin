@extends('layouts.admin-master')
@section('page-title', 'Dashboard')
@section('header')
    <!-- Card stats -->
    <div class="row">
      <div class="col-xl-3 col-md-6">
        <div class="card card-stats">
          <!-- Card body -->
          <div class="card-body">
            <div class="row">
              <div class="col">
                <h5 class="card-title text-uppercase text-muted mb-0">Total Blog Article</h5>
                <span class="h2 font-weight-bold mb-0">{{ count($articles) }}</span>
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
                <span class="h2 font-weight-bold mb-0">{{ count($agents) }}</span>
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
                <h5 class="card-title text-uppercase text-muted mb-0">Total User</h5>
                <span class="h2 font-weight-bold mb-0">{{ count($users) }}</span>
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
                                    <a href="{{ route('manage.blog.show', $article->id) }}" class="btn btn-primary">See article</a>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-warning" href="{{ route('manage.blog.edit', $article->id) }}">Edit</a>
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
                        <a href="{{ route('manage.service.index') }}" class="btn btn-sm btn-secondary">See all services</a>
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
                                        <img class="rounded-circle mr-2" height="30" alt="Image placeholder"
                                             src="{{ Storage::url('img/t-shirt.png')  }}">
                                        <div class="media-body">
                                            <span class="name mb-0 text-sm">{{ $service->title  }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $service->serviceCategory->name  }}</td>
                                <td>{{ $service->agent->name }}</td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown"
                                           aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item text-primary" href="{{ route('manage.service.show', $service->id) }}">
                                                See details
                                            </a>
                                            <a class="dropdown-item text-warning" href="{{ route('manage.service.edit', $service->id)  }}">
                                                Edit
                                            </a>
                                            <form class="dropdown-item" action="{{ route('manage.service.destroy', $service->id) }}" method="post">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-link p-0 text-danger">delete</button>
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
    <div class="modal fade" id="delete-article" tabindex="-1" role="dialog"
    aria-labelledby="delete-article" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-default">
                        Delete article <span class="modal-article-title"></span>
                    </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure wanna delete the article with title <strong class="modal-article-title"></strong>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Cancel</button>
                    <form action="{{--routing on js--}}" method="post">
                        @csrf @method("DELETE")
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
