@extends('layouts.master')

@section('title', 'Style')

@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">View Style</h3>
                <div class="card-options">
                    <a href="{{ route('admin.style.index') }}" class="btn text-white bg-pink"><i class="fe fe-database"></i></a>
                    <a href="#" class="card-options-fullscreen btn text-white bg-indigo" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                    <a href="javascript:void(0)" class="card-options-remove btn text-white bg-orange" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>{{ $style->id }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Buyer Name</td>
                                <td>{{ $style->buyer->buyer_name }}</td>
                            </tr>
                            <tr>
                                <td>Style Name</td>
                                <td>{{ $style->style_name }}</td>
                            </tr>
                            <tr>
                                <td>Style Description</td>
                                <td>{{ $style->style_description }}</td>
                            </tr>
                            <tr>
                                <td>Season Name</td>
                                <td>{{ $style->season->season_name }}</td>
                            </tr>
                            <tr>
                                <td>Color Name</td>
                                <td>{{ $style->color->color_name }}</td>
                            </tr>
                            <tr>
                                <td>Wash Name</td>
                                <td>{{ $style->wash->wash_name }}</td>
                            </tr>
                            <tr>
                                <td>Type of Garments</td>
                                <td>{{ $style->type_of_garments }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>{{ $style->status }}</td>
                            </tr>
                            <tr>
                                <td>Closing Date</td>
                                <td>{{ ($style->status) == 'Close' ? $style->closing_date : 'N/A' }}</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Created by</th>
                                <th>{{ $style->user->name }}</th>
                            </tr>
                            <tr>
                                <th>Created at</th>
                                <th>{{ $style->created_at->format('Y-m-d H:i:s') }}</th>
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

        // Store Data
        $('#createForm').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: "{{ route('admin.style.store') }}",
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
                        toastr.success('Style store successfully.');
                    }
                }
            });
        });
    });
</script>
@endsection
