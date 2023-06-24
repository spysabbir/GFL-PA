@extends('layouts.auth_master')

@section('title', 'Forgot Password')

@section('content')
<div class="authentication-forgot d-flex align-items-center justify-content-center">
    <div class="card forgot-box">
        <div class="card-body">
            <div class="p-4 rounded">
                <div class="text-center">
                    <img src="{{ asset('asset') }}/images/icons/lock.png" width="120" alt="" />
                </div>
                <h4 class="mt-5 font-weight-bold">Forgot Password?</h4>
                <p class="text-muted">Enter your registered email ID to reset the password</p>
                @if (session('status'))
                    <div class="alert alert-info" role="alert">
                        <strong>{{ session('status') }}</strong>
                    </div>
                @endif
                <form action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <div class="my-4">
                        <label class="form-label">Email Address</label>
                        <input type="text" class="form-control form-control-lg" name="email" value="{{ old('email') }}" placeholder="Enter Email Address" />
                        @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">Send</button>
                        <a href="{{ route('login') }}" class="btn btn-white btn-lg"><i class='bx bx-arrow-back me-1'></i>Back to Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
