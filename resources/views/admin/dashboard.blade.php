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
                <span class="h2 font-weight-bold mb-0">{{ $totalPromos }}</span>
              </div>
              <div class="col-auto">
                <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                  <i class="ni ni-chart-pie-35"></i>
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
                  <i class="ni ni-money-coins"></i>
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
                  <i class="ni ni-chart-bar-32"></i>
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
                    <div class="row align-items-center">
                        <div class="col">
                          <h3 class="mb-0">Latest 10 Article</h3>
                        </div>
                        <div class="col text-right">
                          <a href="{{ route('manage.blog.index') }}" class="btn btn-sm btn-primary">See all</a>
                        </div>
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
                                    <a href="{{ route('manage.blog.show', $article->id) }}" class="btn btn-primary">See article</button>
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
                    Are you sure wanna delete article with title
                    <strong class="modal-article-title"></strong>
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
