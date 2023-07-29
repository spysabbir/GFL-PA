@extends('layouts.auth_master')

@section('title', 'Forgot Password')

@section('content')
<div class="auth">
    <div class="card">
        <div class="text-center mb-5">
            <a class="header-brand text-light" href="{{ route('password.email') }}"><i class="fe fe-command brand-logo"></i></a>
        </div>
        <div class="card-body">
            <div class="card-title">Forgot password</div>
            <p class="text-muted">Enter your email address and your password will be reset and emailed to you.</p>
            @if (session('status'))
                <div class="alert alert-info" role="alert">
                    <strong>{{ session('status') }}</strong>
                </div>
            @endif
            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="form-group style2">
                    <label class="form-label" for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter your email">
                    @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary btn-block">Send me new password</button>
                </div>
            </form>
        </div>
        <div class="text-center text-muted">
            Forget it, <a class="text-light" href="{{ route('login') }}">Send me Back</a> to the Sign in screen.
        </div>
    </div>
</div>
@endsection
