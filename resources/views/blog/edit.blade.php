@extends('layouts.blog-master')
@section('page-title', 'Edit article')
@section('page-id', 'blogEdit')
@section('css')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endsection
@section('content')
  <div class="container py-4">
  <form action="{{ route('manage.blog.update', $article->id) }}" method="post" enctype="multipart/form-data">
      @method('PUT') @include('blog.form')
      <button type="submit" class="btn btn-success btn-block">Update article</button>
    </form>
  </div>
@endsection
