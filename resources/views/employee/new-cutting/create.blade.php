@extends('layouts.master')

@section('title', 'New Cutting')

@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create New Cutting</h3>
                <div class="card-options">
                    <a href="{{ route('employee.new-cutting.index') }}" class="btn text-white bg-pink"><i class="fe fe-database"></i></a>
                    <a href="#" class="card-options-fullscreen btn text-white bg-indigo" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                    <a href="javascript:void(0)" class="card-options-remove btn text-white bg-orange" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">
                <form id="createDocForm">
                    @csrf
                    <div class="row d-flex justify-content-between">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Cutting Doc No</label>
                                <input type="text" class="form-control" id="get_doc_no" readonly>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Cutting Date</label>
                                <input type="date" class="form-control" name="cutting_date" id="get_cutting_date">
                                <span class="text-danger error-text cutting_date_error"></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group mt-1">
                                <button type="submit" class="btn text-white bg-cyan" id="createDocBtn">Create</button>
                                <button type="button" class="btn text-white bg-cyan" id="updateDocBtn">Update</button>
                                <a href="{{ route('employee.new-cutting.index') }}" class="btn text-white bg-pink">Back</a>
                                <!-- Create Btn -->
                                <button type="button" class="btn text-white bg-success" data-toggle="modal" data-target="#createModal" id="addStyleBtn" disabled><i class="fe fe-plus-circle"></i></button>
                            </div>
                            <span><strong>Total Cutting:</strong> <span id="totalCuttingQty">0</span></span>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Remarks</label>
                                <textarea name="remarks" class="form-control" placeholder="Remarks" id="get_remarks"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Create Modal -->
                <div class="modal fade bd-example-modal-lg" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Create</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Unique Id</label>
                                            <select class="form-control custom-select select_unique_id_js" id="search_unique_id" style="width: 100%">
                                                <option value="">Select Unique Id</option>
                                                @foreach ($allStyle as $style)
                                                <option value="{{ $style->unique_id  }}">{{ $style->unique_id  }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class="form-label">Style Name</label>
                                            <select class="form-control custom-select select_style_js" id="search_style" style="width: 100%">
                                                <option value="">Select Style</option>
                                                @foreach ($allStyle as $style)
                                                <option value="{{ $style->style_id }}">{{ $style->style->style_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover table-borderless align-middle">
                                            <thead>
                                                <tr>
                                                    <th>Unique Id</th>
                                                    <th>Style</th>
                                                    <th>Season</th>
                                                    <th>Color</th>
                                                    <th>Wash</th>
                                                    <th>Wash</th>
                                                    <th>Cutting Qty</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="get_search_result">
                                                <!-- Content will be inserted here via AJAX -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped" id="allDataTable">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Unique Id</th>
                                    <th>Cutting Qty</th>
                                    <th>Total Cutting Qty</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Unique Id</th>
                                    <th>Cutting Qty</th>
                                    <th>Total Cutting Qty</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
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
        $('.select_style_js').select2();

        $('#createDocBtn').show();
        $('#updateDocBtn').hide();

        // Store Data
        $('#createDocForm').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: "{{ route('employee.new-cutting.store') }}",
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
                        $('#get_doc_no').val(response.getId.id);
                        $('#get_cutting_date').val(response.getId.cutting_date);
                        $('#get_remarks').val(response.getId.remarks);
                        $('#addStyleBtn').attr('disabled', false);
                        $('#createDocBtn').hide();
                        $('#updateDocBtn').show();
                        $('#allDataTable').DataTable().ajax.reload();
                        toastr.success('Cutting data store successfully.');
                    }
                }
            });
        });

        $(document).on('click', '#updateDocBtn', function () {
            var id = $('#get_doc_no').val();
            var cutting_date = $('#get_cutting_date').val();
            var remarks = $('#get_remarks').val();
            var url = "{{ route('employee.new-cutting.update', ":id") }}";
            url = url.replace(':id', id)
            $.ajax({
                url: url,
                type: 'PUT',
                data: {cutting_date: cutting_date, remarks: remarks},
                beforeSend:function(){
                    $(document).find('span.error-text').text('');
                },
                success: function(response) {
                    if (response.status == 400) {
                        $.each(response.error, function(prefix, val){
                            $('span.'+prefix+'_error').text(val[0]);
                        })
                    }else{
                        $('#get_cutting_date').val(response.cuttindDoc.cutting_date);
                        $('#get_remarks').val(response.cuttindDoc.remarks);
                        $('#allDataTable').DataTable().ajax.reload();
                        toastr.success('Cutting data update successfully.');
                    }
                }
            });
        });

        // Get Style Info
        $(document).on('change', '#search_unique_id, #search_style', function() {
            // $('#get_search_result').html('');
            var unique_id = $('#search_unique_id').val();
            var style_id = $('#search_style').val();
            $.ajax({
                url: "{{ route('employee.get.search.style.info') }}",
                type: "POST",
                data: {unique_id:unique_id, style_id:style_id},
                success: function (response) {
                    $('#get_search_result').html(response);
                },
            });
        });

        // Add Style
        $(document).on('click', '#addCutingStyleBtn', function () {
            var row = $(this).closest('tr');
            var cutting_doc_no = $('#get_doc_no').val();
            var unique_id = row.find('td:eq(0)').text();
            var cutting_qty = row.find('input[name="cutting_qty"]').val();
            $.ajax({
                url: "{{ route('employee.add.new-cutting.style') }}",
                type: 'POST',
                data: { cutting_doc_no: cutting_doc_no, unique_id: unique_id, cutting_qty: cutting_qty },
                beforeSend:function(){
                    $(document).find('span.error-text').text('');
                },
                success: function(response) {
                    if (response.status == 400) {
                        $.each(response.error, function(prefix, val){
                            row.find('span.'+prefix+'_error').text(val[0]);
                        })
                    }else{
                        $('#allDataTable').DataTable().ajax.reload();
                        toastr.success('Cutting data store successfully.');
                    }
                }
            });
        });

         // Get Style Data
         $('#allDataTable').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            ajax: {
                url: "{{ route('employee.get.new-cutting.style') }}",
                "data":function(e){
                    e.cutting_summary_id = $('#get_doc_no').val();
                },
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'unique_id', name: 'unique_id' },
                { data: 'cutting_qty', name: 'cutting_qty' },
                { data: 'styleWiseTotalCuttingQty', name: 'styleWiseTotalCuttingQty' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            drawCallback: function (settings) {
                var api = this.api();
                var totalCuttingQty = api.column(2).data().reduce(function (a, b) {
                    return parseInt(a) + parseInt(b);
                }, 0);
                $('#totalCuttingQty').text(totalCuttingQty);
            },
        });
    });
</script>
@endsection
