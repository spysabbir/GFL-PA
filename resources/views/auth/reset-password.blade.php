@extends('layouts.auth_master')

@section('title', 'Genrate New Password')

@section('content')
<div class="authentication-reset-password d-flex align-items-center justify-content-center">
    <div class="row">
        <div class="col-12 col-lg-10 mx-auto">
            <div class="card">
                <div class="row g-0">
                    <div class="col-lg-5 border-end">
                        <div class="card-body">
                            <div class="p-5">
                                <div class="text-start">
                                    <img src="{{ asset('asset') }}/images/logo-img.png" width="180" alt="">
                                </div>
                                <h4 class="mt-5 font-weight-bold">Genrate New Password</h4>
                                <p class="text-muted">We received your reset password request. Please enter your new password!</p>
                                <form action="{{ route('password.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" name="email" value="{{ old('email', $request->email) }}" id="email" placeholder="Enter Email Address">
                                        @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group" id="show_hide_password">
                                            <input type="password" class="form-control border-end-0" name="password" id="password" placeholder="Enter Password">
                                            <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                        </div>
                                        @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                                        <div class="input-group" id="show_hide_password">
                                            <input type="password" class="form-control border-end-0" name="password_confirmation" id="password_confirmation" placeholder="Enter Confirm Password">
                                            <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                        </div>
                                        @error('password_confirmation')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary">Change Password</button>
                                        <a href="{{ route('login') }}" class="btn btn-light"><i class='bx bx-arrow-back mr-1'></i>Back to Login</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <img src="{{ asset('asset') }}/images/login-images/forgot-password-frent-img.jpg" class="card-img login-img h-100" alt="...">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
