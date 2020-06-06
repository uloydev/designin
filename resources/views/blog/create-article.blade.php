@extends('layouts.blog-master')
@section('page-title', 'Create new article')
@section('page-id', 'blogCreate')
@section('css')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endsection
@section('content')
    @if ($errors->any())
        <div class="alert alert--danger">
            @foreach($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @elseif(session('success'))
        <div class="alert alert--success">
            {{ session('success') }}
        </div>
    @endif
  <div class="container py-4">
      <form action="{{ route('manage.blog.store') }}" method="post" enctype="multipart/form-data">
          @include('blog.form')
          <a href="" class="btn text-warning"><i class='bx bx-left-arrow-alt' ></i> Back</a>
          <button type="submit" class="btn btn-success float-right">Add new article</button>
      </form>
  </div>
@endsection
@section('element')
  <div class="modal fade" id="blog-add-category">
      <div class="modal__content">
          <div class="modal__header">
              <h5 class="modal__title">Add new category</h5>
              <a href="javascript:void(0);" class="btn-close-modal">
                  <i class='bx bx-x'></i>
              </a>
          </div>
          <div class="modal__body pt-4">
              <form class="" id="form-add-category" action="{{ route('manage.blog-category.store') }}" method="post">
                  @csrf
                  <div class="col-12 px-0">
                      <label for="add-category" class="d-none">Add category here</label>
                      <input type="text" placeholder="Ex: promos" id="add-category" class="input-custom" name="name" required>
                  </div>
              </form>
          </div>
          <div class="modal__footer">
              <button type="submit" form="form-add-category" class="btn btn-success d-block col-12">
                  Submit
              </button>
          </div>
      </div>
  </div>
@endsection
@push('script')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
@endpush
