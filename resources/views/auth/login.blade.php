@extends('layouts.auth_master')

@section('title', 'Sign in')

@section('content')
<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
    <div class="container-fluid">
        <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
            <div class="col mx-auto">
                <div class="mb-4 text-center">
                    <img src="{{ asset('asset') }}/images/logo-img.png" width="180" alt="" />
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="p-4 rounded">
                            <div class="text-center">
                                <h3 class="">Sign in</h3>
                                <p>Don't have an account yet? <a href="{{ route('register') }}">Sign up here</a>
                                </p>
                            </div>
                            <div class="form-body">
                                @if (session('status'))
                                    <div class="alert alert-info" role="alert">
                                        <strong>{{ session('status') }}</strong>
                                    </div>
                                @endif
                                <form class="row g-3" action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="col-12">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="Email Address">
                                        @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="password" class="form-label">Enter Password</label>
                                        <div class="input-group" id="show_hide_password">
                                            <input type="password" class="form-control border-end-0" id="password" placeholder="Enter Password">
                                            <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                        </div>
                                        @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                                            <label class="form-check-label" for="remember_me">Remember Me</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-end">	<a href="{{ route('password.request') }}">Forgot Password ?</a>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Sign in</button>
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
