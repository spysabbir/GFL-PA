
{{-- @foreach ($role->permissions as $permission)
<span class="badge bg-info">{{ $permission->name }}</span>
@endforeach --}}

@extends('layouts.master')

@section('title', 'Role in Permission')

@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create Role in Permission</h3>
                <div class="card-options">
                    <a href="#" class="card-options-fullscreen text-white bg-indigo px-1" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                    <a href="javascript:void(0)" class="card-options-remove text-white bg-orange px-1" data-toggle="card-remove"><i class="fe fe-x"></i></a>
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
                    {{-- @foreach ($permission_groups as $group)
                    <div class="row mt-5">
                        <div class="col-lg-2 col-md-4">
                            <div class="form-check">
                                <input class="form-check-input group-checkbox" type="checkbox" id="PermissionGroup_{{ $group->group_name }}">
                                <label class="form-check-label" for="PermissionGroup_{{ $group->group_name }}">
                                    {{ $group->group_name }}
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
                                    <input class="form-check-input group-permission" type="checkbox" name="permission_id[]" value="{{ $permission->id }}" id="permission_id{{ $permission->id }}">
                                    <label class="form-check-label" for="permission_id{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <span class="text-danger error-text permission_id_error"></span>
                    </div>
                    @endforeach --}}
                    @foreach ($permission_groups as $group)
                    <div class="row mt-5">
                        <div class="col-lg-2 col-md-4">
                            <div class="form-check">
                                <input class="form-check-input group-checkbox_{{ $group->group_name }}" type="checkbox" id="PermissionGroup_{{ $group->group_name }}">
                                <label class="form-check-label" for="PermissionGroup_{{ $group->group_name }}">
                                    {{ $group->group_name }}
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
                                    <input class="form-check-input group-permission_{{ $group->group_name }}" type="checkbox" name="permission_id[]" value="{{ $permission->id }}" id="permission_id{{ $permission->id }}">
                                    <label class="form-check-label" for="permission_id{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <span class="text-danger error-text permission_id_error"></span>
                    </div>
                    @endforeach


                    <div class="col-md-2">
                        <div class="form-group mt-1">
                            <button type="submit" class="btn text-white bg-cyan mt-4">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Role Permission List</h3>
                <div class="card-options">
                    <!-- Fullscreen Btn -->
                    <a href="#" class="card-options-fullscreen btn text-white bg-indigo btn-sm" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                    <!-- Close Btn -->
                    <a href="javascript:void(0)" class="card-options-remove btn text-white bg-orange btn-sm" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="allDataTable">
                        <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Role Name</th>
                                <th>Permission Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Modal -->
                            {{-- <div class="modal fade bd-example-modal-lg" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                            <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="editForm">
                                                @csrf
                                                <input type="hidden" id="permission_id">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="form-group">
                                                            <label class="form-label">Permission Name</label>
                                                            <input type="text" class="form-control" name="name" id="permission_name">
                                                            <span class="text-danger error-text update_name_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group mt-1">
                                                            <button type="submit" class="btn text-white bg-teal mt-4">Update</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sl No</th>
                                <th>Role Name</th>
                                <th>Permission Name</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
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

        // PermissionAll
        // $('#PermissionAll').click(function () {
        //     if ($(this).is(':checked')) {
        //         $('input[type=checkbox]').prop('checked', true);
        //     }else{
        //         $('input[type=checkbox]').prop('checked', false);
        //     }
        // });

        // Handle the group-wise check system for multiple groups
        $('[class^="group-checkbox_"]').change(function() {
            const groupName = this.className.split('group-checkbox_')[1];
            const isChecked = $(this).prop('checked');
            $(`.group-permission_${groupName}`).prop('checked', isChecked);
        });

        // Handle individual permission checkboxes within a group
        $('[class^="group-permission_"]').change(function() {
            const groupName = this.className.split('group-permission_')[1];
            const groupContainer = $(`.group-checkbox_${groupName}`).parents('.row');
            const allPermissions = groupContainer.find(`.group-permission_${groupName}`);
            const checkedPermissions = groupContainer.find(`.group-permission_${groupName}:checked`);
            const groupCheckbox = groupContainer.find(`.group-checkbox_${groupName}`);

            if (allPermissions.length === checkedPermissions.length) {
                groupCheckbox.prop('checked', true);
            } else {
                groupCheckbox.prop('checked', false);
            }
        });

        // Read Data
        $('#allDataTable').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            ajax: {
                url: "{{ route('admin.role-permission.index') }}",
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'name', name: 'name' },
                { data: 'permissions', name: 'permissions' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
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
                        $('#createForm')[0].reset();
                        $('#allDataTable').DataTable().ajax.reload();
                        toastr.success('Role in permission store successfully.');
                    }
                }
            });
        });

        // Edit Data
        $(document).on('click', '.editBtn', function () {
            var id = $(this).data('id');
            var url = "{{ route('admin.permission.edit', ":id") }}";
            url = url.replace(':id', id)
            $.ajax({
                url: url,
                type: "GET",
                success: function (response) {
                    $('#permission_id').val(response.id);
                    $('#permission_name').val(response.name);
                },
            });
        });

        // Update Data
        $('#editForm').submit(function (event) {
            event.preventDefault();
            var id = $('#permission_id').val();
            var url = "{{ route('admin.permission.update', ":id") }}";
            url = url.replace(':id', id)
            $.ajax({
                url: url,
                type: "PUT",
                data: $(this).serialize(),
                beforeSend:function(){
                    $(document).find('span.error-text').text('');
                },
                success: function (response) {
                    if (response.status == 400) {
                        $.each(response.error, function(prefix, val){
                            $('span.update_'+prefix+'_error').text(val[0]);
                        })
                    }else{
                        $("#editModal").modal('hide');
                        $('#allDataTable').DataTable().ajax.reload();
                        toastr.success('Permission update successfully.');
                    }
                },
            });
        });

        // Delete Data
        $(document).on('click', '.deleteBtn', function(){
            var id = $(this).data('id');
            var url = "{{ route('admin.permission.destroy', ":id") }}";
            url = url.replace(':id', id)
            Swal.fire({
                title: 'Are you sure?',
                text: "You can bring it back though!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        method: 'DELETE',
                        success: function(response) {
                            $('#allDataTable').DataTable().ajax.reload();
                            toastr.warning('Permission delete successfully.');
                        }
                    });
                }
            })
        })
    });
</script>
@endsection
