@extends('layouts.master')

@section('title', 'Profile')

@section('content')
<div class="row clearfix">
    <div class="col-lg-4 col-md-12">
        <div class="card">
            <img class="card-img-top" src="{{ asset('asset') }}/images/gallery/6.jpg" alt="Card image cap">
            <div class="card-body">
                <h4 class="card-title">{{ Auth::user()->name }}</h4>
                <ul class="social-links list-inline mb-4">
                    <li class="list-inline-item"><a href="javascript:void(0)" title="Facebook" data-toggle="tooltip"><i class="fa fa-facebook"></i></a></li>
                    <li class="list-inline-item"><a href="javascript:void(0)" title="Twitter" data-toggle="tooltip"><i class="fa fa-twitter"></i></a></li>
                    <li class="list-inline-item"><a href="javascript:void(0)" title="1234567890" data-toggle="tooltip"><i class="fa fa-phone"></i></a></li>
                    <li class="list-inline-item"><a href="javascript:void(0)" title="@skypename" data-toggle="tooltip"><i class="fa fa-skype"></i></a></li>
                </ul>
                <p class="card-text">795 Folsom Ave, Suite 600 San Francisco, 94107</p>
                <div class="row">
                    <div class="col-4">
                        <h6><strong>3265</strong></h6>
                        <span>Post</span>
                    </div>
                    <div class="col-4">
                        <h6><strong>1358</strong></h6>
                        <span>Followers</span>
                    </div>
                    <div class="col-4">
                        <h6><strong>10K</strong></h6>
                        <span>Likes</span>
                    </div>
                </div>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Daniel@example.com</li>
                <li class="list-group-item">+ 202-555-2828</li>
                <li class="list-group-item">October 22th, 1990</li>
            </ul>
        </div>
    </div>
    <div class="col-lg-8 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Profile</h3>
                <div class="card-options">
                    <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">
                {{-- <form method="post" action="{{ route('password.update') }}">
                    @csrf
                    @method('put') --}}
                <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('patch')
                    <div class="row clearfix">
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Profile Photo</label>
                                <input type="file" class="form-control" name="profile_photo">
                                @error('profile_photo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-0">
                                <label class="form-label">Address</label>
                                <textarea class="form-control" placeholder="Address" name="address"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Update Profile</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Password</h3>
                <div class="card-options">
                    <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')
                    <div class="row clearfix">
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <label class="form-label">Current Password</label>
                                <input type="password" class="form-control" name="current_password" placeholder="Current Password">
                                @error('current_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <label class="form-label">New Password</label>
                                <input type="password" class="form-control" name="password" placeholder="New Password">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                                @error('password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
