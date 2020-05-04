@extends('layouts.blog-master')
@section('page-title', 'Edit article')
@section('page-id', 'blogEdit')
@section('content')
  <div class="container py-4">
  <form action="{{ route('manage.blog.update', $article->id) }}" method="post" enctype="multipart/form-data">
      @method('PUT') @include('blog.form')
      <button type="submit" class="btn btn-success btn-block">Update article</button>
    </form>
  </div>
@endsection
