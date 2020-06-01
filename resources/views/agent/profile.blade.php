@extends('layouts.admin-master')
@section('page-title', 'Agent Profile')
@section('page-id', 'agentProfile')
@section('page-name', 'My Profile')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-xl-4 order-xl-2">
            <div class="card card-profile">
                <img src="{{ asset('plugin/argon-dashboard/assets/img/theme/img-1-1000x600.jpg') }}" alt="Image placeholder"
                     class="card-img-top">
                <div class="row justify-content-center">
                    <div class="col-lg-3 order-lg-2">
                        <div class="card-profile-image">
                            <form action="{{ route('agent.profile.avatar.update') }}"
                            id="upload-profile" method="post" enctype="multipart/form-data">
                                @csrf @method('PUT')
                                <input type="file" id="profile-img" name="avatar" class="d-none profile__input"
                                       accept="image/*" form="upload-profile">
                                <label for="profile-img" class="profile__label">
                                    <img src="{{ Storage::url($profile->avatar) }}"
                                         class="rounded-circle profile__img" alt="Profile">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </label>
                            </form>
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
                        <h5 class="h3">{{ $profile->user->name }}</h5>
                        <div class="h5 font-weight-300">{{ $profile->handphone }}</div>
                        <div class="h5 mt-4">{{ $profile->user->email }}</div>
                        <div>
                            <i class="ni education_hat mr-2"></i>Live at {{ $profile->address }}
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
                    <form action="{{ route('agent.profile.update') }}" method="post"
                    enctype="multipart/form-data" class="profile__form-edit">
                        @csrf @method('PUT')
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="name">Full Name</label>
                                    <input type="text" id="name" class="form-control" name="name" placeholder="Fullname"
                                    value="{{ $profile->user->name }}" required>
                                </div>
                                @error('name')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="email">Email address</label>
                                    <input type="email" id="email" name="email" class="form-control"
                                    placeholder="Your email" value="{{ $profile->user->email }}" required>
                                </div>
                                @error('email')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label class="form-control-label" for="phone">Phone number</label>
                                <input type="text" id="phone" class="form-control" name="handphone"
                                placeholder="Your phone number" value="{{ $profile->handphone }}" required>
                            </div>
                            @error('handphone')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="address">Address</label>
                                    <textarea name="address" id="address" rows="6"
                                    placeholder="Address" class="form-control" required>{{ $profile->address }}</textarea>
                                </div>
                                @error('address')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <div class="custom-file">
                                    <input type="file" class="form-control profile__file" name="name_card" id="name_card"
                                    accept="image/*">
                                    <label class="custom-file-label" for="name_card">Upload Name Card</label>
                                </div>
                            </div>
                            @error('name_card')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <div class="custom-file">
                                    <input type="file" class="form-control profile__file" name="portfolios[]" id="portfolio"
                                    accept="application/pdf, application/msword, .odt" multiple>
                                    <label class="custom-file-label" for="portfolio">Portfolio</label>
                                </div>
                            </div>
                            @error('portfolios')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label class="form-control-label" for="bank">Bank</label>
                                <select name="bank" id="bank" class="custom-select" required>
                                    @foreach ($listBank as $bank)
                                        @if ($bank->value === $profile->bank)
                                            <option value="{{ $bank->value }}" selected>{{ $bank->label }}</option>
                                        @else
                                            <option value="{{ $bank->value }}">{{ $bank->label }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            @error('bank')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="account_number">Account number</label>
                                    <input type="number" id="account_number" class="form-control" name="account_number"
                                    placeholder="Your Account Number" value="{{ $profile->account_number }}" required>
                                </div>
                                @error('account_number')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-default">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
