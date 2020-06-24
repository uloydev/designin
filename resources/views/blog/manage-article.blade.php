@extends('layouts.admin-master')
@section('page-title', 'Blog Management')
@section('page-name', 'Blog Management')
@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="alert-text">{{ session('success') }}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('update_category'))
        <div class="alert alert-success" role="alert">
            {{ session('update_category') }}
        </div>
    @elseif(session('creata_category'))
        <div class="alert alert-success" role="alert">
            {{ session('creata_category') }}
        </div>
    @elseif($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <p class="alert-text mb-0">
                @foreach ($errors->all() as $error)
                    <span class="d-block">{{ $error }}</span>
                @endforeach
            </p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row">
        <div class="col-12 px-0">
            <div class="nav-wrapper">
                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0 active" id="tab-article-text-1-tab" data-toggle="tab"
                           href="#tab-article" role="tab" aria-controls="tab-article-text-1" aria-selected="true">
                            <i class="ni ni-cloud-upload-96 mr-2"></i> Articles
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tab-category-text-2-tab" data-toggle="tab"
                           href="#tab-category" role="tab" aria-controls="tab-category-text-2" aria-selected="false">
                            <i class="ni ni-bell-55 mr-2"></i> Categories
                        </a>
                    </li>
                </ul>
            </div>
            <div class="tab-content py-4">
                <div class="tab-pane fade show active" id="tab-article" role="tabpanel"
                     aria-labelledby="tab-article-text-1-tab">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="mb-0">All Article</h3>
                                </div>
                                <div class="col text-right">
                                    <a href="{{ route('manage.blog.create') }}" class="btn btn-sm btn-primary">
                                        create new article
                                    </a>
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
                                    <th>Show on homepage</th>
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
                                            <a href="{{ route('blog.show', $article->id) }}"
                                            class="btn btn-primary btn-sm" target="_blank">
                                                See article
                                            </a>
                                        </td>
                                        <td>
                                            @if ($article->is_main == 1)
                                                True
                                            @else
                                                False
                                            @endif
                                        </td>
                                        <td>{{ $article->created_at->format('d M Y') }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-warning"
                                            href="{{ route('manage.blog.edit', $article->id) }}">
                                                Edit
                                            </a>
                                            <button type="button" class="btn btn-danger show-modal" data-toggle="modal"
                                                    data-article-title="{{ Str::slug($article->title, '-') }}"
                                                    data-target="#delete-article" data-article-id="{{ $article->id }}">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12">{{ $blogs->links() }}</div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab-category" role="tabpanel" aria-labelledby="tab-category-text-2-tab">
                    <div class="card bg-default" style="overflow: hidden">
                        <div class="card-header bg-transparent border-0">
                            <div class="row mx-0 justify-content-between align-items-center">
                                <h3 class="text-white mb-0">All Category</h3>
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                        data-target="#add-category-article">
                                    Create new category
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-dark table-flush">
                                <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Category Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($blogCategories as $category)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $category->name  }}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-warning"
                                                        data-toggle="modal" data-target="#edit-category-article"
                                                        data-category-name="{{ Str::slug($category->name, '-') }}"
                                                        data-category-id="{{ $category->id }}">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-danger"
                                                        data-toggle="modal" data-target="#delete-category-article"
                                                        data-category-name="{{ Str::slug($category->name, '-') }}"
                                                        data-category-id="{{ $category->id }}">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('element')
    @include('blog.manipulate')
@endsection
