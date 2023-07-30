@extends('layouts.master')

@section('title', 'Role in Permission')

@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Role Permission List</h3>
                <div class="card-options">
                    <a href="{{ route('admin.role-permission.create') }}" class="btn text-white bg-green"><i class="fe fe-plus-circle"></i></a>
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

        // Delete Data
        $(document).on('click', '.deleteBtn', function(){
            var id = $(this).data('id');
            var url = "{{ route('admin.role-permission.destroy', ":id") }}";
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
                            toastr.warning('Role in permission delete successfully.');
                        }
                    });
                }
            })
        })
    });
</script>
@endsection
