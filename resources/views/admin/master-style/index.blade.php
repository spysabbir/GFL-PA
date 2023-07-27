@extends('layouts.master')

@section('title', 'Master Style')

@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Master Style List</h3>
                <div class="card-options">
                    <a href="{{ route('admin.master-style.create') }}" class="btn text-white bg-green"><i class="fe fe-plus-circle"></i></a>
                    <!-- Trashed Btn -->
                    <button type="button" class="btn text-white bg-pink ml-3" data-toggle="modal" data-target="#trashedModal"><i class="fe fe-trash-2"></i></button>
                    <!-- Trashed Modal -->
                    <div class="modal fade bd-example-modal-lg" id="trashedModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Trashed</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="trashedDataTable" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>Buyer Name</th>
                                                    <th>Style Name</th>
                                                    <th>Season Name</th>
                                                    <th>Color Name</th>
                                                    <th>Wash Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Buyer Name</th>
                                                    <th>Style Name</th>
                                                    <th>Season Name</th>
                                                    <th>Color Name</th>
                                                    <th>Wash Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fullscreen Btn -->
                    <a href="#" class="card-options-fullscreen btn text-white bg-indigo btn-sm" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                    <!-- Close Btn -->
                    <a href="javascript:void(0)" class="card-options-remove btn text-white bg-orange btn-sm" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Select Status</label>
                            <select class="form-control custom-select filter_data" id="status">
                                <option value="">--All--</option>
                                <option value="Hold">Hold</option>
                                <option value="Running">Running</option>
                                <option value="Close">Close</option>
                                <option value="Cancel">Cancel</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="allDataTable">
                        <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Unique Id</th>
                                <th>Buyer Name</th>
                                <th>Style Name</th>
                                <th>Season Name</th>
                                <th>Color Name</th>
                                <th>Wash Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <!-- Modal -->
                            <div class="modal fade bd-example-modal-lg" id="statusEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Status</h5>
                                            <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="statusEditForm">
                                                @csrf
                                                <input type="hidden" id="master_style_id">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label class="form-label">Select Status</label>
                                                            <select class="form-control custom-select" name="status" id="get_status">
                                                                <option value="">--All--</option>
                                                                <option value="Hold">Hold</option>
                                                                <option value="Running">Running</option>
                                                                <option value="Close">Close</option>
                                                                <option value="Cancel">Cancel</option>
                                                            </select>
                                                            <span class="text-danger error-text update_status_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label class="form-label">Status Change Date</label>
                                                            <input type="date" class="form-control" name="status_change_date" id="get_status_change_date">
                                                            <span class="text-danger error-text update_status_change_date_error"></span>
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
                            </div>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sl No</th>
                                <th>Unique Id</th>
                                <th>Buyer Name</th>
                                <th>Style Name</th>
                                <th>Season Name</th>
                                <th>Color Name</th>
                                <th>Wash Name</th>
                                <th>Status</th>
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
                url: "{{ route('admin.master-style.index') }}",
                "data":function(e){
                    e.status = $('#status').val();
                },
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'unique_id', name: 'unique_id' },
                { data: 'buyer_name', name: 'buyer_name' },
                { data: 'style_name', name: 'style_name' },
                { data: 'season_name', name: 'season_name' },
                { data: 'color_name', name: 'color_name' },
                { data: 'wash_name', name: 'wash_name' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        // Filter Data
        $(document).on('change', '.filter_data', function(e){
            e.preventDefault();
            $('#allDataTable').DataTable().ajax.reload();
        })

        // Delete Data
        $(document).on('click', '.deleteBtn', function(){
            var id = $(this).data('id');
            var url = "{{ route('admin.master-style.destroy', ":id") }}";
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
                            toastr.warning('Master style delete successfully.');
                            $('#trashedDataTable').DataTable().ajax.reload();
                        }
                    });
                }
            })
        })

        // Trashed Data
        $('#trashedDataTable').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            ajax: {
                url: "{{ route('admin.master-style.trashed') }}",
            },
            columns: [
                { data: 'buyer_name', name: 'buyer_name' },
                { data: 'style_name', name: 'style_name' },
                { data: 'season_name', name: 'season_name' },
                { data: 'color_name', name: 'color_name' },
                { data: 'wash_name', name: 'wash_name' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        // Restore Data
        $(document).on('click', '.restoreBtn', function () {
            var id = $(this).data('id');
            var url = "{{ route('admin.master-style.restore', ":id") }}";
            url = url.replace(':id', id)
            $.ajax({
                url: url,
                type: "GET",
                success: function (response) {
                    $("#trashedModal").modal('hide');
                    $('#allDataTable').DataTable().ajax.reload();
                    $('#trashedDataTable').DataTable().ajax.reload();
                    toastr.success('Master style restore successfully.');
                },
            });
        });

        // Force Delete Data
        $(document).on('click', '.forceDeleteBtn', function(){
            var id = $(this).data('id');
            var url = "{{ route('admin.master-style.force.delete', ":id") }}";
            url = url.replace(':id', id)
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        method: 'GET',
                        success: function(response) {
                            $("#trashedModal").modal('hide');
                            $('#trashedDataTable').DataTable().ajax.reload();
                            toastr.error('Master style force delete successfully.');
                        }
                    });
                }
            })
        })

        // Status Edit Data
        $(document).on('click', '.statusEditBtn', function () {
            var id = $(this).data('id');
            var url = "{{ route('admin.master-style.status.edit', ":id") }}";
            url = url.replace(':id', id)
            $.ajax({
                url: url,
                type: "GET",
                success: function (response) {
                    $('#master_style_id').val(response.id);
                    $('#get_status').val(response.status);
                    $('#get_status_change_date').val(response.status_change_date);
                },
            });
        });

        // Status Update Data
        $('#statusEditForm').submit(function (event) {
            event.preventDefault();
            var id = $('#master_style_id').val();
            var url = "{{ route('admin.master-style.status.update', ":id") }}";
            url = url.replace(':id', id)
            $.ajax({
                url: url,
                type: "POST",
                data: $(this).serialize(),
                beforeSend:function(){
                    $(document).find('span.error-text').text('');
                },
                success: function (response) {
                    if (response.status == 401) {
                        toastr.error('Master style bpo order not found.');
                    }else{
                        if (response.status == 400) {
                            $.each(response.error, function(prefix, val){
                                $('span.update_'+prefix+'_error').text(val[0]);
                            })
                        } else {
                            $("#statusEditModal").modal('hide');
                            $('#allDataTable').DataTable().ajax.reload();
                            toastr.success('Master style update successfully.');
                        }
                    }
                },
            });
        });

    });
</script>
@endsection
