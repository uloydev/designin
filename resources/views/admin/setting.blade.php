@extends('layouts.admin-master')
@section('page-id', 'adminSetting')
@section('page-title', 'Setting Page')
@section('page-name', 'Setting Page')
@section('content')
    @if (session('success'))
        <div class="alert alert-default" role="alert">{{ session('success') }}</div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('admin.convert-token') }}" class="card-body" method="post">
                    @csrf @method('PUT')
                    <div class="form-group">
                        <label class="form-control-label" for="conversion">1 Token to rupiah</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">Rp</span>
                            </div>
                            <input type="text" name="numeral" class="form-control" id="conversion"
                            value="{{ $tokenConversion->numeral }}" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-default">Change conversion</button>
                </form>
            </div>
        </div>
    </div>
@endsection
