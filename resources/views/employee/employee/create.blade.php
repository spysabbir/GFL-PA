@extends('layouts.master')

@section('title', 'Employee')

@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create Employee</h3>
                <div class="card-options">
                    <a href="{{ route('employee.employee.index') }}" class="btn text-white bg-pink"><i class="fe fe-database"></i></a>
                    <a href="#" class="card-options-fullscreen btn text-white bg-indigo" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                    <a href="javascript:void(0)" class="card-options-remove btn text-white bg-orange" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">
                <form id="createForm" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter your name">
                                <span class="text-danger error-text name_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Father Name</label>
                                <input type="text" class="form-control" name="father_name" placeholder="Enter your father name">
                                <span class="text-danger error-text father_name_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Mother Name</label>
                                <input type="text" class="form-control" name="mother_name" placeholder="Enter your mother name">
                                <span class="text-danger error-text mother_name_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Personal Email</label>
                                <input type="email" class="form-control" name="personal_email" placeholder="Enter your personal email">
                                <span class="text-danger error-text personal_email_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Official Email</label>
                                <input type="email" class="form-control" name="official_email" placeholder="Enter your official email">
                                <span class="text-danger error-text official_email_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Primary Phone Number</label>
                                <input type="text" class="form-control" name="primary_phone_number" placeholder="Enter your primary phone number">
                                <span class="text-danger error-text primary_phone_number_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Emergency Phone Number</label>
                                <input type="text" class="form-control" name="emergency_phone_number" placeholder="Enter your emergency phone number">
                                <span class="text-danger error-text emergency_phone_number_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Gender Name</label>
                                <select name="gender" id="" class="form-control custom-select">
                                    <option value="">--Select Gender--</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                <span class="text-danger error-text gender_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" name="date_of_birth">
                                <span class="text-danger error-text date_of_birth_error"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Address</label>
                                <textarea class="form-control" name="address" placeholder="Enter your address"></textarea>
                                <span class="text-danger error-text address_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Department Name</label>
                                <select name="department_id" id="" class="form-control custom-select">
                                    <option value="">--Select Department--</option>
                                    @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text department_id_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Designation Name</label>
                                <select name="designation_id" id="" class="form-control custom-select">
                                    <option value="">--Select Designation--</option>
                                    @foreach ($designations as $designation)
                                    <option value="{{ $designation->id }}">{{ $designation->designation_name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text designation_id_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Nid No</label>
                                <input type="number" class="form-control" name="nid_no" placeholder="Enter your nid no">
                                <span class="text-danger error-text nid_no_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Date of Join</label>
                                <input type="date" class="form-control" name="date_of_join">
                                <span class="text-danger error-text date_of_join_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Profile Photo</label>
                                <input type="file" class="form-control" name="profile_photo" id="image">
                                <img src="" alt="Profile Photo" id="imagePreview" width="100" height="100">
                                <span class="text-danger error-text profile_photo_error"></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group mt-1">
                                <button type="submit" class="btn text-white bg-cyan mt-4">Create</button>
                            </div>
                        </div>
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Store Image Preview
        $('#image').change(function(){
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imagePreview').attr('src', e.target.result).show();
            }
            reader.readAsDataURL(this.files[0]);
        });

        // Store Data
        $('#createForm').submit(function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{ route('employee.employee.store') }}",
                type: 'POST',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                beforeSend: function(){
                    $(document).find('span.error-text').text('');
                },
                success: function(response) {
                    if (response.status == 400) {
                        $.each(response.error, function(prefix, val){
                            $('span.'+prefix+'_error').text(val[0]);
                        })
                    } else {
                        if (response.status == 401) {
                            toastr.error('This nid no is already added.');
                        } else {
                            $('#createForm')[0].reset();
                            toastr.success('Employee store successfully.');
                        }
                    }
                }
            });
        });
    });
</script>
@endsection
