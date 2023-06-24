@extends('layouts.auth_master')

@section('title', 'Sign Up')

@section('content')
<div class="d-flex align-items-center justify-content-center my-5 my-lg-0">
    <div class="container">
        <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
            <div class="col mx-auto">
                <div class="my-4 text-center">
                    <img src="{{ asset('asset') }}/images/logo-img.png" width="180" alt="" />
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="p-4 rounded">
                            <div class="text-center">
                                <h3 class="">Sign Up</h3>
                                <p>Already have an account? <a href="{{ route('login') }}">Sign in here</a>
                                </p>
                            </div>
                            <div class="form-body">
                                <form class="row g-3" method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="col-12">
                                        <label for="name" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="name" placeholder="Enter Full Name">
                                        @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="email" placeholder="Enter Email Address">
                                        @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group" id="show_hide_password">
                                            <input type="password" class="form-control border-end-0" name="password" id="password" placeholder="Enter Password">
                                            <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                        </div>
                                        @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                                        <div class="input-group" id="show_hide_password">
                                            <input type="password" class="form-control border-end-0" name="password_confirmation" id="password_confirmation" placeholder="Enter Confirm Password">
                                            <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                        </div>
                                        @error('password_confirmation')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary"><i class='bx bx-user'></i>Sign up</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>
</div>
@endsection
