@extends('layouts.admin-master')
@section('page-title', 'Agent Profile')
@section('page-id', 'agentProfile')
@section('page-name', 'My Profile')
@section('content')
    <div class="row">
        <div class="col-xl-4 order-xl-2">
            <div class="card card-profile">
                <img src="{{ asset('plugin/argon-dashboard/assets/img/theme/img-1-1000x600.jpg') }}" alt="Image placeholder" class="card-img-top">
                <div class="row justify-content-center">
                    <div class="col-lg-3 order-lg-2">
                        <div class="card-profile-image">
                            <img src="{{ Storage::url($profile->profile->avatar) }}" class="rounded-circle" alt="Profile">
                        </div>
                    </div>
                </div>
                <div class="card-body pt-5 pb-md-4">
                    <div class="row">
                        <div class="col">
                            <div class="card-profile-stats d-flex justify-content-center">
                                <div>
                                    <span class="heading">22</span>
                                    <span class="description">service</span>
                                </div>
                                <div>
                                    <span class="heading">10</span>
                                    <span class="description">Project</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <h5 class="h3">{{ Auth::user()->name }}</h5>
                        <div class="h5 font-weight-300">{{ $profile->profile->handphone }}</div>
                        <div class="h5 mt-4">{{ Auth::user()->email }}</div>
                        <div>
                            <i class="ni education_hat mr-2"></i>Live at {{ $profile->profile->address }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8 order-xl-1">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Edit profile </h3>
                </div>
                <div class="card-body">
                    <form>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="name">Full Name</label>
                                        <input type="text" id="name" class="form-control" name="name" placeholder="Fullname"
                                        value="{{ $profile->name }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="email">Email address</label>
                                        <input type="email" id="email" class="form-control"
                                        placeholder="Your email" value="{{ $profile->email }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="phone">Phone number</label>
                                <input type="text" id="phone" class="form-control" name="handphone"
                                       placeholder="Your phone number" value="{{ $profile->profile->handphone }}">
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="address">Address</label>
                                        <textarea name="address" id="address" rows="6"
                                        placeholder="Address" class="form-control">{{ $profile->profile->address }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="name_card">Name card</label>
                                <input type="text" id="name_card" class="form-control" name="name_card"
                                       placeholder="Your name card" value="{{ $profile->profile->name_card }}">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="bank">Bank</label>
                                <select name="bank" id="bank" class="custom-select">
                                    @foreach ($listBank as $key => $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
