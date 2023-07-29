@extends('layouts.auth_master')

@section('title', 'Sign Up')

@section('content')
<div class="auth">
    <div class="card">
        <div class="text-center mb-5">
            <a class="header-brand text-light" href="{{ route('register') }}"><i class="fe fe-command brand-logo"></i></a>
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
            Already have account? <a class="text-light" href="{{ route('login') }}">Sign in</a>
        </div>
    </div>
</div>
@endsection
