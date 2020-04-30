@extends('layouts.blog-master')
@section('page-title', 'Create new article')
@section('page-id', 'blogCreate')
@section('content')
  <div class="container py-4">
    <form action="{{ route('manage.blog.store') }}" method="post" enctype="multipart/form-data">
      @include('blog.form')
      <button type="submit" class="btn btn-success btn-block">Add new article</button>
    </form>
  </div>
@endsection
@section('element')
  <div class="modal fade" id="blog-add-category" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="add-categoryLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="add-categoryLabel">Add new category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="" id="form-add-category" action="{{route('manage.blog-category.store')}}" method="post">
            @csrf
            <input type="text" placeholder="Add your new category" class="form-control" nmae="name">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" form="form-add-category" class="btn btn-success">Submit</button>
        </div>
      </div>
    </div>
  </div>
@endsection
