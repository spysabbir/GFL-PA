@extends('layouts.master')

@section('title', 'Employee')

@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Employee</h3>
                <div class="card-options">
                    <a href="{{ route('employee.employee.index') }}" class="btn text-white bg-pink"><i class="fe fe-database"></i></a>
                    <a href="#" class="card-options-fullscreen btn text-white bg-indigo" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                    <a href="javascript:void(0)" class="card-options-remove btn text-white bg-orange" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">
                <form id="editForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <input type="hidden" id="employee_id" value="{{ $employee->id }}">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Profile Photo</label>
                                <input type="file" class="form-control" name="profile_photo" id="image">
                                <img src="{{ asset('uploads/profile_photo') }}/{{ $employee->profile_photo }}" alt="Profile Photo" id="imagePreview" width="100" height="100">
                                <span class="text-danger error-text update_profile_photo_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $employee->name }}">
                                <span class="text-danger error-text update_name_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ $employee->email }}">
                                <span class="text-danger error-text update_email_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Phone Number</label>
                                <input type="text" class="form-control" name="phone_number" value="{{ $employee->phone_number }}">
                                <span class="text-danger error-text update_phone_number_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Gender Name</label>
                                <select name="gender" id="" class="form-control custom-select">
                                    <option value="">--Select Gender--</option>
                                    <option value="Male" @selected($employee->gender == 'Male')>Male</option>
                                    <option value="Female" @selected($employee->gender == 'Female')>Female</option>
                                </select>
                                <span class="text-danger error-text update_gender_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" name="date_of_birth" value="{{ $employee->date_of_birth }}">
                                <span class="text-danger error-text update_date_of_birth_error"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Address</label>
                                <textarea class="form-control" name="address">{{ $employee->address }}</textarea>
                                <span class="text-danger error-text update_address_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Department Name</label>
                                <select name="department_id" id="" class="form-control custom-select">
                                    <option value="">--Select Department--</option>
                                    @foreach ($departments as $department)
                                    <option value="{{ $department->id }}" @selected($employee->department_id == $department->id)>{{ $department->department_name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text update_department_id_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Designation Name</label>
                                <select name="designation_id" id="" class="form-control custom-select">
                                    <option value="">--Select Designation--</option>
                                    @foreach ($designations as $designation)
                                    <option value="{{ $designation->id }}" @selected($employee->designation_id == $designation->id)>{{ $designation->designation_name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text update_designation_id_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Nid No</label>
                                <input type="number" class="form-control" name="nid_no" value="{{ $employee->nid_no }}">
                                <span class="text-danger error-text update_nid_no_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Date of Join</label>
                                <input type="date" class="form-control" name="date_of_join" value="{{ $employee->date_of_join }}">
                                <span class="text-danger error-text update_date_of_join_error"></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group mt-1">
                                <button type="submit" class="btn text-white bg-cyan mt-4">Update</button>
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

        // Employee Update Data
        // $('#editForm').submit(function (event) {
        //     event.preventDefault();
        //     var id = $('#employee_id').val();
        //     var url = "{{ route('employee.employee.update', ":id") }}";
        //     url = url.replace(':id', id)
        //     var formData = new FormData(this);
        //     $.ajax({
        //         url: url,
        //         type: "PUT",
        //         data: formData,
        //         dataType: 'json',
        //         contentType: false,
        //         processData: false,
        //         beforeSend:function(){
        //             $(document).find('span.error-text').text('');
        //         },
        //         success: function (response) {
        //             console.log(response);
        //             // if (response.status == 400) {
        //             //     $.each(response.error, function(prefix, val){
        //             //         $('span.update_'+prefix+'_error').text(val[0]);
        //             //     })
        //             // }else{
        //             //     if (response.status == 401) {
        //             //         toastr.error('This nid no is already added.');
        //             //     } else {
        //             //         toastr.success('Employee update successfully.');
        //             //     }
        //             // }
        //         },
        //     });
        // });

        $('#editForm').submit(function (event) {
            event.preventDefault();
            var id = $('#employee_id').val();
            var url = "{{ route('employee.employee.update', ':id') }}";
            url = url.replace(':id', id);
            var formData = new FormData(this);
            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                beforeSend: function(){
                    $(document).find('span.error-text').text('');
                },
                success: function (response) {
                    if (response.status == 400) {
                        $.each(response.error, function(prefix, val){
                            $('span.update_'+prefix+'_error').text(val[0]);
                        })
                    } else {
                        if (response.status == 401) {
                            toastr.error('This nid no is already added.');
                        } else {
                            toastr.success('Employee update successfully.');
                        }
                    }
                },
            });
        });

    });
</script>
@endsection
