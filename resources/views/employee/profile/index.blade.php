@extends('layouts.master')

@section('title', 'Profile')

@section('content')
<div class="row clearfix">
    <div class="col-lg-4 col-md-12">
        <div class="card">
            <img class="avatar avatar-xxl m-2"  src="{{ asset('uploads/profile_photo') }}/{{ $employee->profile_photo }}" alt="Profile Photo" id="imagePreview">
            <div class="card-body">
                <h4 class="card-title">Name: {{ Auth::user()->name }}</h4>
                <h4 class="card-title">Role: {{ Auth::user()->role }}</h4>
                <p class="card-text"><strong>Address: </strong>{{ $employee->address }}</p>
                {{-- <div class="row">
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
                </div> --}}
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Email: </strong>{{ Auth::user()->email }}</li>
                <li class="list-group-item"><strong>Department: </strong>{{ $employee->department_id }}</li>
                <li class="list-group-item"><strong>Designation: </strong>{{ $employee->designation_id }}</li>
                <li class="list-group-item"><strong>Primary Phone Number: </strong>{{ $employee->primary_phone_number }}</li>
                <li class="list-group-item"><strong>Gender: </strong>{{ $employee->gender }}</li>
                <li class="list-group-item"><strong>Date of Birth: </strong>{{ $employee->date_of_birth }}</li>
                <li class="list-group-item"><strong>Date of Join: </strong>{{ $employee->date_of_join }}</li>
                <li class="list-group-item"><strong>Nid No: </strong>{{ $employee->nid_no }}</li>
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
                <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                    @csrf
                    @method('patch')
                    <div class="row clearfix">
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Profile Photo</label>
                                <input type="file" class="form-control" name="profile_photo" id="image">
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
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Father's Name</label>
                                <input type="text" class="form-control" name="father_name" value="{{ old('father_name', $user->father_name) }}">
                                @error('father_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Mother's Name</label>
                                <input type="text" class="form-control" name="mother_name" value="{{ old('mother_name', $user->mother_name) }}">
                                @error('mother_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Emergency Phone Number</label>
                                <input type="text" class="form-control" name="emergency_phone_number" value="{{ old('emergency_phone_number', $employee->emergency_phone_number) }}">
                                @error('emergency_phone_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-0">
                                <label class="form-label">Address</label>
                                <textarea class="form-control" placeholder="Address" name="address">{{ old('address', $employee->address) }}</textarea>
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

@section('script')
<script>
    $(document).ready(function() {
        // Store Image Preview
        $('#image').change(function(){
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imagePreview').attr('src', e.target.result).show();
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>
@endsection

