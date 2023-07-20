@extends('layouts.auth_master')

@section('title', 'Sign Up')

@section('content')
<div class="auth">
    <div class="card">
        <div class="text-center mb-5">
            <a class="header-brand" href="index.html"><i class="fe fe-command brand-logo"></i></a>
        </div>
        <div class="card-body">
            <div class="card-title">Create new account</div>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group style2">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter name">
                    @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="form-group style2">
                    <label class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter your email">
                    @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="form-group style2">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter password">
                    @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="form-group style2">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Enter confirm password">
                    @error('password_confirmation')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary btn-block">Create new account</button>
                </div>
            </form>
        </div>
        <div class="text-center text-muted">
            Already have account? <a href="{{ route('login') }}">Sign in</a>
        </div>
        <div class="card-footer text-center mt-3">
            <button type="button" class="btn btn-icon btn-facebook"><i class="fa fa-facebook"></i></button>
            <button type="button" class="btn btn-icon btn-twitter"><i class="fa fa-twitter"></i></button>
            <button type="button" class="btn btn-icon btn-google"><i class="fa fa-google"></i></button>
            <button type="button" class="btn btn-icon btn-youtube"><i class="fa fa-youtube"></i></button>
            <button type="button" class="btn btn-icon btn-vimeo"><i class="fa fa-vimeo"></i></button>
        </div>
    </div>
</div>
@endsection
