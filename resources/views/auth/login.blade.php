@extends('layouts.auth_master')

@section('title', 'Sign in')

@section('content')
<div class="auth">
    <div class="card">
        <div class="text-center mb-5">
            <a class="header-brand text-light" href="{{ route('login') }}"><i class="fe fe-command brand-logo"></i></a>
        </div>
        <div class="card-body">
            <div class="card-title">Login to your account</div>
            @if (session('status'))
                <div class="alert alert-info" role="alert">
                    <strong>{{ session('status') }}</strong>
                </div>
            @endif
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group style2">
                    <label class="form-label">Email / Username</label>
                    <input type="text" class="form-control" name="login" value="{{ old('login') }}" placeholder="Enter your email or username">
                    @error('login')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="form-group style2">
                    <label class="form-label">Password<a href="{{ route('password.request') }}" class="float-right small">I forgot password</a></label>
                    <input type="password" class="form-control" name="password" placeholder="Enter password">
                    @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="custom-control custom-checkbox" for="remember_me">
                    <input type="checkbox" class="custom-control-input" id="remember_me" name="remember"/>
                    <span class="custom-control-label">Remember me</span>
                    </label>
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
