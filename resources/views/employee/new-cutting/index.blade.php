@extends('layouts.master')

@section('title', 'New Cutting')

@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">New Cutting List</h3>
                <div class="card-options">
                    <a href="{{ route('employee.new-cutting.create') }}" class="btn text-white bg-green"><i class="fe fe-plus-circle"></i></a>
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
                                                    <th>Document Number</th>
                                                    <th>Document Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Document Number</th>
                                                    <th>Document Date</th>
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
                    <!-- Status Btn -->
                    <button type="button" class="btn text-white bg-pink ml-3" data-toggle="modal" data-target="#statusModal"><i class="fe fe-trash-2"></i></button>
                    <!-- Status Modal -->
                    <div class="modal fade bd-example-modal-lg" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Status</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="statusDataTable" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>Document Number</th>
                                                    <th>Document Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Document Number</th>
                                                    <th>Document Date</th>
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
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Document Date</label>
                            <input type="date" class="form-control filter_data" id="filter_document_date">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Select Status</label>
                            <select class="form-control custom-select filter_data" id="filter_status">
                                <option value="">--All--</option>
                                <option value="Running">Running</option>
                                <option value="Updating">Updating</option>
                                <option value="Submitted">Submitted</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Unique Id</label>
                            <select class="form-control custom-select filter_data select_unique_id_js" id="filter_unique_id">
                                <option value="">--All--</option>
                                @foreach ($allStyle as $style)
                                    <option value="{{ $style->unique_id }}">{{ $style->unique_id }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="allDataTable">
                        <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Document Number</th>
                                <th>Document Date</th>
                                <th>Total Cutting Qty</th>
                                <th>Remarks</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sl No</th>
                                <th>Document Number</th>
                                <th>Document Date</th>
                                <th>Total Cutting Qty</th>
                                <th>Remarks</th>
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

        $('.select_unique_id_js').select2();

        // Read Data
        $('#allDataTable').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            ajax: {
                url: "{{ route('employee.new-cutting.index') }}",
                "data":function(e){
                    e.document_date = $('#filter_document_date').val();
                    e.status = $('#filter_status').val();
                    e.unique_id = $('#filter_unique_id').val();
                },
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'document_number', name: 'document_number' },
                { data: 'document_date', name: 'document_date' },
                { data: 'total_cutting_qty', name: 'total_cutting_qty' },
                { data: 'remarks', name: 'remarks' },
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
            var url = "{{ route('employee.new-cutting.destroy', ":id") }}";
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
                            toastr.warning('Cutting data delete successfully.');
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
                url: "{{ route('employee.new-cutting.trashed') }}",
            },
            columns: [
                { data: 'document_number', name: 'document_number' },
                { data: 'document_date', name: 'document_date' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        // Style Status Data
        $('#statusDataTable').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            ajax: {
                url: "{{ route('employee.new-cutting.style.status.data') }}",
            },
            columns: [
                { data: 'document_number', name: 'document_number' },
                { data: 'document_date', name: 'document_date' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        // Restore Data
        $(document).on('click', '.restoreBtn', function () {
            var id = $(this).data('id');
            var url = "{{ route('employee.new-cutting.restore', ":id") }}";
            url = url.replace(':id', id)
            $.ajax({
                url: url,
                type: "GET",
                success: function (response) {
                    $("#trashedModal").modal('hide');
                    $('#allDataTable').DataTable().ajax.reload();
                    $('#trashedDataTable').DataTable().ajax.reload();
                    toastr.success('Cutting data restore successfully.');
                },
            });
        });

        // Force Delete Data
        $(document).on('click', '.forceDeleteBtn', function(){
            var id = $(this).data('id');
            var url = "{{ route('employee.new-cutting.force.delete', ":id") }}";
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
                            toastr.error('Cutting data force delete successfully.');
                        }
                    });
                }
            })
        })

    });
</script>
@endsection
