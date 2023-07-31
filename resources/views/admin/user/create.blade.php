@extends('layouts.master')

@section('title', 'User Create')

@section('content')
<div class="row clearfix justify-content-center">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">User Create</h3>
                <div class="card-options">
                    <a href="{{ route('admin.user.index') }}" class="btn text-white bg-pink btn-sm"><i class="fe fe-database"></i></a>
                    <!-- Fullscreen Btn -->
                    <a href="#" class="card-options-fullscreen btn text-white bg-indigo btn-sm" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                    <!-- Close Btn -->
                    <a href="javascript:void(0)" class="card-options-remove btn text-white bg-orange btn-sm" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">
                <form id="createForm">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Employee Id</label>
                        <input type="text" class="form-control" name="employee_id" placeholder="Enter your employee id">
                        <span class="text-danger error-text employee_id_error"></span>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter your name">
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="form-group">
                        <label class="form-label">User Name</label>
                        <input type="text" class="form-control" name="user_name" placeholder="Enter your user name">
                        <span class="text-danger error-text user_name_error"></span>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter your email">
                        <span class="text-danger error-text email_error"></span>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Role</label>
                        <select name="roles" class="form-control custom-select">
                            <option value="">--Select Role--</option>
                            @foreach ($allRole as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error-text roles_error"></span>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Create new account</button>
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

          // Store Data
          $('#createForm').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: "{{ route('admin.user.store') }}",
                type: 'POST',
                data: formData,
                dataType: 'json',
                beforeSend:function(){
                    $(document).find('span.error-text').text('');
                },
                success: function(response) {
                    if (response.status == 400) {
                        $.each(response.error, function(prefix, val){
                            $('span.'+prefix+'_error').text(val[0]);
                        })
                    }else{
                        $('#createForm')[0].reset();
                        $('#allDataTable').DataTable().ajax.reload();
                        toastr.success('User store successfully.');
                    }
                }
            });
        });
    });
</script>
@endsection
