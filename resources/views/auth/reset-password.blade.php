@extends('layouts.auth_master')

@section('title', 'Genrate New Password')

@section('content')
<div class="auth">
    <div class="card">
        <div class="text-center mb-5">
            <a class="header-brand text-white" href="{{ route('password.store') }}"><i class="fe fe-command brand-logo"></i></a>
        </div>
        <div class="card-body">
            <div class="card-title">Genrate New Password</div>
            <p class="text-muted">We received your reset password request. Please enter your new password!</p>
            <form action="{{ route('password.store') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <input type="hidden" name="email" value="{{ old('email', $request->email) }}">

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
                    <button type="submit" class="btn btn-primary btn-block">Change Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
