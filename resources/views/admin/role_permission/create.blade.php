@extends('layouts.master')

@section('title', 'Role in Permission')

@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create Role in Permission</h3>
                <div class="card-options">
                    <a href="{{ route('admin.role-permission.index') }}" class="btn text-white bg-pink"><i class="fe fe-database"></i></a>
                    <a href="#" class="card-options-fullscreen btn text-white bg-indigo" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                    <a href="javascript:void(0)" class="card-options-remove btn text-white bg-orange" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">
                <form id="createForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Role Name</label>
                                <select name="role_id" id="role_id" class="form-control custom-select">
                                    <option value="">--Select Role--</option>
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text role_id_error"></span>
                            </div>
                        </div>
                        <div class="col-md-3 pt-2">
                            <div class="form-check mt-4">
                                <input class="form-check-input" type="checkbox" id="PermissionAll">
                                <label class="form-check-label" for="PermissionAll">
                                    Permission All
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-2 col-md-4">
                            <h4 class="text-center">Group Name</h4>
                            <hr>
                        </div>
                        <div class="col-lg-10 col-md-8">
                            <h4  class="text-center">Permission Name</h4>
                            <hr>
                        </div>
                    </div>
                    @foreach ($permission_groups as $group)
                    <div class="row mt-5">
                        <div class="col-lg-2 col-md-4">
                            <div class="form-check">
                                <input class="form-check-input group-checkbox" type="checkbox" data-group="{{ $group->group_name }}" id="PermissionGroup_{{ $group->group_name }}">
                                <label class="form-check-label" for="PermissionGroup_{{ $group->group_name }}">
                                    <span class="badge bg-success text-uppercase">{{ $group->group_name }}</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-10 col-md-8">
                            @php
                            $permissions = App\Models\User::getPermissionByGroupName($group->group_name);
                            @endphp
                            <div class="d-flex justify-content-between">
                                @foreach ($permissions as $permission)
                                <div class="form-check">
                                    <input class="form-check-input group-permission" type="checkbox" data-group="{{ $group->group_name }}" name="permission_id[]" value="{{ $permission->id }}" id="permission_id{{ $permission->id }}">
                                    <label class="form-check-label" for="permission_id{{ $permission->id }}">
                                        <span class="badge bg-dark text-capitalize">{{ $permission->name }}</span>
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <span class="text-danger error-text permission_id_error"></span>

                    <div class="col-md-2">
                        <div class="form-group mt-1">
                            <button type="submit" class="btn text-white bg-cyan mt-4">Create</button>
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
    document.addEventListener("DOMContentLoaded", function () {
        const groupCheckboxes = document.querySelectorAll(".group-checkbox");
        const permissionCheckboxes = document.querySelectorAll(".group-permission");
        const permissionAllCheckbox = document.getElementById("PermissionAll");

        groupCheckboxes.forEach(groupCheckbox => {
            groupCheckbox.addEventListener("change", function () {
                const groupName = this.getAttribute("data-group");
                const groupPermissionCheckboxes = document.querySelectorAll(`.group-permission[data-group="${groupName}"]`);
                const isChecked = this.checked;

                groupPermissionCheckboxes.forEach(permissionCheckbox => permissionCheckbox.checked = isChecked);
                checkPermissionAllCheckbox();
            });
        });

        permissionCheckboxes.forEach(permissionCheckbox => {
            permissionCheckbox.addEventListener("change", function () {
                const groupName = this.getAttribute("data-group");
                const groupPermissionCheckboxes = document.querySelectorAll(`.group-permission[data-group="${groupName}"]`);
                const groupCheckbox = document.querySelector(`.group-checkbox[data-group="${groupName}"]`);

                const allChecked = Array.from(groupPermissionCheckboxes).every(permission => permission.checked);

                groupCheckbox.checked = allChecked;
                checkPermissionAllCheckbox();
            });
        });

        permissionAllCheckbox.addEventListener("change", function () {
            const isChecked = this.checked;
            groupCheckboxes.forEach(groupCheckbox => groupCheckbox.checked = isChecked);
            permissionCheckboxes.forEach(permissionCheckbox => permissionCheckbox.checked = isChecked);
        });

        function checkPermissionAllCheckbox() {
            const allGroupCheckboxes = Array.from(groupCheckboxes);
            const allPermissionCheckboxes = Array.from(permissionCheckboxes);

            const allGroupChecked = allGroupCheckboxes.every(groupCheckbox => groupCheckbox.checked);
            const allPermissionChecked = allPermissionCheckboxes.every(permissionCheckbox => permissionCheckbox.checked);

            permissionAllCheckbox.checked = allGroupChecked && allPermissionChecked;
        }
    });
</script>

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
                url: "{{ route('admin.role-permission.store') }}",
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
                        if (response.status == 401) {
                            toastr.error('This role is already added.');
                        } else {
                            $('#createForm')[0].reset();
                            $('#allDataTable').DataTable().ajax.reload();
                            toastr.success('Role in permission store successfully.');
                        }
                    }
                }
            });
        });
    });
</script>
@endsection
