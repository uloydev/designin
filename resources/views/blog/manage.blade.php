@extends('layouts.admin-master')
@section('page-title', 'Blog Management')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                          <h3 class="mb-0">All Article</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{ route('manage.blog.create') }}" class="btn btn-sm btn-primary">create new article</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th>No.</th>
                                <th>Category</th>
                                <th>Title</th>
                                <th class="text-center">Show article</th>
                                <th>Created At</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blogs as $article)
                            <tr>
                                <td>{{ $number++ }}</td>
                                <td>{{ $article->category->name }}</td>
                                <td>{{ Str::words($article->title, 6) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('manage.blog.show', $article->id) }}" class="btn btn-primary btn-sm">See article</button>
                                </td>
                                <td>{{ $article->created_at }}</td>
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
                <div class="col-12">{{ $blogs->links() }}</div>
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
