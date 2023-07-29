@extends('layouts.master')

@section('title', 'Master Style')

@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Master Style</h3>
                <div class="card-options">
                    <a href="{{ route('employee.master-style.index') }}" class="btn text-white bg-pink"><i class="fe fe-database"></i></a>
                    <a href="#" class="card-options-fullscreen btn text-white bg-indigo" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                    <a href="javascript:void(0)" class="card-options-remove btn text-white bg-orange" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">
                <h4 class="text-center">Status: <strong id="getStatus"></strong></h4>
                <form id="editForm">
                    @csrf
                    <div class="row">
                        <input type="hidden" id="masterStyle_id" value="{{ $masterStyle->id }}">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Buyer Name</label>
                                <select name="buyer_id" id="" class="form-control custom-select">
                                    <option value="">--Select Buyer--</option>
                                    @foreach ($buyers as $buyer)
                                    <option value="{{ $buyer->id }}" @selected($masterStyle->buyer_id == $buyer->id)>{{ $buyer->buyer_name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text update_buyer_id_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Style Name</label>
                                <select name="style_id" id="" class="form-control custom-select">
                                    <option value="">--Select Style--</option>
                                    @foreach ($styles as $style)
                                    <option value="{{ $style->id }}" @selected($masterStyle->style_id == $style->id)>{{ $style->style_name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text update_style_id_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Season Name</label>
                                <select name="season_id" id="" class="form-control custom-select">
                                    <option value="">--Select Season--</option>
                                    @foreach ($seasons as $season)
                                    <option value="{{ $season->id }}" @selected($masterStyle->season_id == $season->id)>{{ $season->season_name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text update_season_id_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Color Name</label>
                                <select name="color_id" id="" class="form-control custom-select">
                                    <option value="">--Select Color--</option>
                                    @foreach ($colors as $color)
                                    <option value="{{ $color->id }}" @selected($masterStyle->color_id == $color->id)>{{ $color->color_name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text update_color_id_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Wash Name</label>
                                <select name="wash_id" id="" class="form-control custom-select">
                                    <option value="">--Select Wash--</option>
                                    @foreach ($washs as $wash)
                                    <option value="{{ $wash->id }}" @selected($masterStyle->wash_id == $wash->id)>{{ $wash->wash_name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text update_wash_id_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Type of Garment</label>
                                <select name="garment_type_id" id="" class="form-control custom-select">
                                    <option value="">--Select Type--</option>
                                    @foreach ($garmentTypes as $garmentType)
                                    <option value="{{ $garmentType->id }}" @selected($masterStyle->garment_type_id == $garmentType->id)>{{ $garmentType->item_name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text update_garment_type_id_error"></span>
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

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Bpo and Order</h3>
                <div class="card-options">
                    <a href="#" class="card-options-fullscreen btn text-white bg-indigo" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                    <a href="javascript:void(0)" class="card-options-remove btn text-white bg-orange" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-7 col-md-12">
                        <form id="bpoOrderCreateForm">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="master_style_id" value="{{ $masterStyle->id }}">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Bpo No</label>
                                        <input type="text" class="form-control" name="bpo_no" placeholder="Bpo No">
                                        <span class="text-danger error-text bpo_no_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Order Quantity</label>
                                        <input type="number" class="form-control" name="order_quantity" placeholder="Order Quantity">
                                        <span class="text-danger error-text order_quantity_error"></span>
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
                    <div class="col-lg-1 col-md-12 pt-2">
                        <span class="badge tag-pink my-3 p-3">Or</span>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <form id="bpoOrderUploadForm" enctype="multipart/form-data">
                            @csrf
                            <span id="field_error" class="text-danger"></span>
                            <div class="row">
                                <input type="hidden" id="masterStyleId" value="{{ $masterStyle->id }}">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="form-label">Bpo and Order File (.xlsx, .xls)</label>
                                        <input type="file" class="form-control" name="bpo_order_file" accept=".xlsx, .xls">
                                        <span class="text-danger error-text update_bpo_order_file_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mt-1">
                                        <button type="submit" class="btn text-white bg-cyan mt-4">Upload</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <h3 class="text-center">Total Order Qty: <strong id="getSumOrder"></strong></h3>
                <div class="table-responsive">
                    <table class="table table-striped text-center" id="allBpoOrderTable">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="allBpoOrderChecked" > <button type="button" class="btn text-white bg-red btn-sm" id="deleteAll">Delete All</button></th>
                                <th>Sl No</th>
                                <th>Bpo No</th>
                                <th>Order Oty</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <!-- Modal -->
                            <div class="modal fade bd-example-modal-lg" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Bpo Order Edit</h5>
                                            <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="bpoOrderEditForm">
                                                @csrf
                                                <input type="hidden" id="bpoOrderEditId">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="form-label">Bpo No</label>
                                                            <input type="text" class="form-control" name="bpo_no" id="bpo_no">
                                                            <span class="text-danger error-text update_bpo_no_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="form-label">Order Quantity</label>
                                                            <input type="number" class="form-control" name="order_quantity" id="order_quantity">
                                                            <span class="text-danger error-text update_order_quantity_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
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
                                <th>Select</th>
                                <th>Sl No</th>
                                <th>Bpo No</th>
                                <th>Order Oty</th>
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

        // Master Style Update Data
        $('#editForm').submit(function (event) {
            event.preventDefault();
            var id = $('#masterStyle_id').val();
            var url = "{{ route('employee.master-style.update', ":id") }}";
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
                        if (response.status == 401) {
                            toastr.error('This master style already added please enter unique style info.');
                        } else {
                            toastr.success('Master style update successfully.');
                        }
                    }
                },
            });
        });

        // Get Sum Order
        getMasterStyleDetails();
        function getMasterStyleDetails() {
            var id = $('#masterStyle_id').val();
            $.ajax({
                url: "{{ route('employee.master-style.get.details', ':id') }}".replace(':id', id),
                type: "GET",
                dataType: "json",
                success: function(response) {
                    $('#getSumOrder').text(response.sumOrder);
                    $('#getStatus').text(response.status);
                },
            });
        }

        // Read Bpo & Order Data
        var masterStyle_id = $('#masterStyle_id').val();
        var bpoOrderListUrl = "{{ route('employee.bpo-order.list', ":masterStyle_id") }}";
        bpoOrderListUrl = bpoOrderListUrl.replace(':masterStyle_id', masterStyle_id),
        $('#allBpoOrderTable').DataTable({
            processing: true,
            // serverSide: true,
            searching: true,
            ajax: {
                url: bpoOrderListUrl,
            },
            columns: [
                { data: 'checkbox', name: 'checkbox' },
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'bpo_no', name: 'bpo_no' },
                { data: 'order_quantity', name: 'order_quantity' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        // Bpo & Order Store Data
        $('#bpoOrderCreateForm').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: "{{ route('employee.bpo-order.store') }}",
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
                        $('#bpoOrderCreateForm')[0].reset();
                        $('#allBpoOrderTable').DataTable().ajax.reload();
                        toastr.success('Bpo order store successfully.');
                        getMasterStyleDetails();
                    }
                }
            });
        });

        // Bpo & Order Upload
        $('#bpoOrderUploadForm').submit(function (event) {
            event.preventDefault();
            var id = $('#masterStyleId').val();
            var url = "{{ route('employee.bpo-order.upload', ":id") }}";
            url = url.replace(':id', id);
            var formData = new FormData(this);
            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                    $('#field_error').text('');
                },
                success: function (response) {
                    if (response.status === 400) {
                        $.each(response.error, function(prefix, val) {
                            $('span.update_' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        if (response.status === 500) {
                            $('#field_error').text(response.field_error);
                        } else {
                            $('#bpoOrderUploadForm')[0].reset();
                            $('#allBpoOrderTable').DataTable().ajax.reload();
                            toastr.success('Bpo & Order uploaded successfully.');
                            getMasterStyleDetails();
                        }
                    }
                }
            });
        });

        // Bpo & Order Edit
        $(document).on('click', '.editBtn', function () {
            var id = $(this).data('id');
            var url = "{{ route('employee.bpo-order.edit', ":id") }}";
            url = url.replace(':id', id)
            $.ajax({
                url: url,
                type: "GET",
                success: function (response) {
                    $('#bpoOrderEditId').val(response.id);
                    $('#bpo_no').val(response.bpo_no);
                    $('#order_quantity').val(response.order_quantity);
                },
            });
        });

        // Bpo & Order Update
        $('#bpoOrderEditForm').submit(function (event) {
            event.preventDefault();
            var id = $('#bpoOrderEditId').val();
            var url = "{{ route('employee.bpo-order.update', ":id") }}";
            url = url.replace(':id', id)
            $.ajax({
                url: url,
                type: "POST",
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
                        $('#allBpoOrderTable').DataTable().ajax.reload();
                        toastr.success('Bpo order update successfully.');
                        getMasterStyleDetails();
                    }
                },
            });
        });

        // Bpo & Order Delete
        $(document).on('click', '.deleteBtn', function(){
            var id = $(this).data('id');
            var url = "{{ route('employee.bpo-order.delete', ":id") }}";
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
                        method: 'GET',
                        success: function(response) {
                            $('#allBpoOrderTable').DataTable().ajax.reload();
                            toastr.warning('Bpo order delete successfully.');
                            getMasterStyleDetails();
                        }
                    });
                }
            })
        })

        // Select All Checkbox
        $(document).on('click', '#allBpoOrderChecked', function(){
            $('.bpoOrderChecked').prop('checked', $(this).prop('checked'));
        })

        // Select Bpo & Order Delete
        $(document).on('click', '#deleteAll', function (e) {
            e.preventDefault();
            var all_selected_id = [];
            $('.bpoOrderChecked').each(function(){
                if($(this).is(":checked")){
                    all_selected_id.push($(this).val());
                }
            });
            var all_selected_id = all_selected_id.toString();
            $.ajax({
                url: "{{ route('employee.bpo-order.delete.all') }}",
                type: "POST",
                data: {all_selected_id:all_selected_id},
                success: function (response) {
                    if(response.status == 400){
                        toastr.warning('Please select minimum 1 item.');
                    }else{
                        toastr.error('Bpo order delete successfully.');
                        $('#allBpoOrderChecked').prop('checked', false);
                        $('#allBpoOrderTable').DataTable().ajax.reload();
                        getMasterStyleDetails();
                    }
                },
            });
        });

    });
</script>
@endsection
