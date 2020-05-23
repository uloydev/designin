@extends('layouts.customer-master')
@section('page-title', 'Manage My Jobs')
@section('page-id', 'manageJob')
@section('header')
    @include('partials.nav')
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-between align-items-start">
            @include('user.profile')
            <section class="profile-main">
                @include('partials.profile-nav')
                <form action="" class="profile-main__filter justify-content-lg-start">
                    <label for="order-filter" class="mr-lg-auto"><h1>Your Job</h1></label>
                    <a href="javascript:void(0)" class="profile-main__btn-create-job mr-lg-3 btn-modal"
                    data-target="#modal-create-job">
                        Create new job
                    </a>
                    <select name="" id="order-filter" class="profile-main__orderBy wide mt-3 mt-lg-0">
                        <option value="" selected>Recent</option>
                        <option value="">Oldest</option>
                        <option value="">Finish</option>
                        <option value="">Unfinished</option>
                    </select>
                </form>
                <div class="profile-main__content">
                    {{-- foreach --}}
                    <article class="profile-main-item">
                        <div class="col profile-main-item__detail">
                            <div class="profile-main__job-detail">
                                <p class="mb-3">Job title: </p>
                                <p class="mb-3">Start on: </p>
                                <p class="mb-3">Finish on: </p>
                                <p class="mb-3">Progress</p>
                                <p class="mb-3 text-right job-title">Design landing page</p>
                                <time class="mb-3 profile-main__time text-right job-start">14 April 2020</time>
                                <time class="mb-3 profile-main__time text-right job-end">14 May 2020</time>
                                <div class="job-description d-none">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum
                                    laborum laudantium nostrum!
                                </div>
                                <progress max="100" value="80">80%</progress>
                            </div>
                            <div class="profile-main__job-action">
                                <a href="javascript:void(0);" class="profile-main__btn-edit-job btn-modal"
                                data-target="#modal-edit-job">
                                    <i class='bx bxs-message-rounded-edit' ></i>
                                </a>
                                <a href="javascript:void(0);" class="profile-main__btn-delete-job btn-modal"
                                data-target="#modal-delete-job">
                                    <i class='bx bxs-trash-alt'></i>
                                </a>
                            </div>
                        </div>
                    </article>
                    <article class="profile-main-item">
                        <div class="col profile-main-item__detail">
                            <div class="profile-main__job-detail">
                                <p class="mb-3">Job title: </p>
                                <p class="mb-3">Start on: </p>
                                <p class="mb-3">Finish on: </p>
                                <p class="mb-3">Progress</p>
                                <p class="mb-3 text-right">Design landing page</p>
                                <time class="mb-3 profile-main__time text-right">14 April 2020</time>
                                <time class="mb-3 profile-main__time text-right">14 May 2020</time>
                                <progress max="100" value="80">80%</progress>
                            </div>
                            <div class="profile-main__job-action">
                                <a href="" class="profile-main__btn-edit-job">
                                    <i class='bx bxs-message-rounded-edit' ></i>
                                </a>
                                <a href="" class="profile-main__btn-delete-job">
                                    <i class='bx bxs-trash-alt'></i>
                                </a>
                            </div>
                        </div>
                    </article>
                    {{-- endforeach --}}
                </div>
            </section>
        </div>
    </div>
@endsection
@push('element')
    <div class="modal" id="modal-delete-job">
        <div class="modal__content">
            <div class="modal__header">
                <h2 class="modal__title">Delete job with title <span class="modal__job-title"></span></h2>
                <a href="" class="btn-close-modal"><i class='bx bx-x' ></i></a>
            </div>
            <div class="modal__body text-center">
                <p>Are you sure wanna delete job with title <span class="modal__job-title"></span>?</p>
                <p class="mt-3"><strong>You can't undo this</strong></p>
                <form action="" class="d-none" id="form-delete-job">
                    @csrf @method('DELETE')
                </form>
            </div>
            <div class="modal__footer">
                <button type="submit" class="btn-danger col mx-auto" form="form-delete-job">
                    Delete this job
                </button>
            </div>
        </div>
    </div>
    <div class="modal" id="modal-create-job">
        <div class="modal__content">
            <div class="modal__header">
                <h2 class="modal__title">Post a job</h2>
                <a href="" class="btn-close-modal"><i class='bx bx-x' ></i></a>
            </div>
            <div class="modal__body">
                <form action="" method="post">
                    @csrf
                    <input class="input-custom mb-4" placeholder="Job title" type="text" required>
                    <input type="text" class="input-custom datepicker-here mb-3"
                    placeholder="Start date (ex: 13 Jan 2020)" required>
                    <input type="text" class="input-custom datepicker-here mb-3"
                    placeholder="End date (ex: 13 Feb 2020)" required>
                    <textarea name="detail_job" class="input-custom" rows="10"
                    placeholder="Description of your job"></textarea>
                    <div class="file-custom mt-4">
                        <input type="file" id="file-job" name="file_job" class="file-custom__input"
                        data-label="Insert document">
                        <label for="file-job" class="file-custom__label">Insert document</label>
                    </div>
                </form>
            </div>
            <div class="modal__footer">
                <button type="submit" class="btn-success col mx-auto">Add new job</button>
            </div>
        </div>
    </div>
    <div class="modal" id="modal-edit-job">
        <div class="modal__content">
            <div class="modal__header">
                <h2 class="modal__title">Edit a job</h2>
                <a href="" class="btn-close-modal"><i class='bx bx-x' ></i></a>
            </div>
            <div class="modal__body">
                <form action="" method="post">
                    @csrf
                    <input class="input-custom mb-4" name="job_title"
                    placeholder="Job title" type="text" required>
                    <input type="text" class="input-custom datepicker-here mb-3" name="job_start_time"
                           placeholder="Start date (ex: 13 Jan 2020)" required>
                    <input type="text" class="input-custom datepicker-here mb-3" name="job_end_time"
                           placeholder="End date (ex: 13 Feb 2020)" required>
                    <textarea name="detail_job" class="input-custom" rows="10"
                              placeholder="Description of your job"></textarea>
                    <div class="file-custom mt-4">
                        <input type="file" id="file-job" name="file_job" class="file-custom__input"
                               data-label="Insert document">
                        <label for="file-job" class="file-custom__label">Update document</label>
                    </div>
                </form>
            </div>
            <div class="modal__footer justify-content-end">
                <button type="submit" class="btn-success col mx-auto">Update job detail</button>
            </div>
        </div>
    </div>
    <div class="overlay overlay--nav-showed"></div>
@endpush
