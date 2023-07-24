@extends('layouts.master')

@section('title', 'Style')

@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Style</h3>
                <div class="card-options">
                    <a href="#" class="card-options-fullscreen text-white bg-indigo px-1" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                    <a href="javascript:void(0)" class="card-options-remove text-white bg-orange px-1" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">
                <form id="editForm">
                    @csrf
                    <div class="row">
                        <input type="hidden" id="style_id" value="{{ $style->id }}">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Buyer Name</label>
                                <select name="buyer_id" id="" class="form-control custom-select">
                                    <option value="">--Select Buyer--</option>
                                    @foreach ($buyers as $buyer)
                                    <option value="{{ $buyer->id }}" @selected($style->buyer_id == $buyer->id)>{{ $buyer->buyer_name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text update_buyer_id_error"></span>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="form-label">Style Name</label>
                                <input type="text" class="form-control" name="style_name" value="{{ $style->style_name }}">
                                <span class="text-danger error-text update_style_name_error"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Style Description</label>
                                <textarea class="form-control" name="style_description">{{ $style->style_description }}</textarea>
                                <span class="text-danger error-text update_style_description_error"></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="form-label">Season Name</label>
                                <select name="season_id" id="" class="form-control custom-select">
                                    <option value="">--Select Season--</option>
                                    @foreach ($seasons as $season)
                                    <option value="{{ $season->id }}" @selected($style->season_id == $season->id)>{{ $season->season_name }}</option>
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
                                    <option value="{{ $color->id }}" @selected($style->color_id == $color->id)>{{ $color->color_name }}</option>
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
                                    <option value="{{ $wash->id }}" @selected($style->wash_id == $wash->id)>{{ $wash->wash_name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text update_wash_id_error"></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="form-label">Type Of Garments</label>
                                <select name="type_of_garments" id="" class="form-control custom-select">
                                    <option value="">--Select Type--</option>
                                    <option value="Long Pant" @selected($style->type_of_garments == 'Long Pant')>Long Pant</option>
                                    <option value="Short Pant" @selected($style->type_of_garments == 'Short Pant')>Short Pant</option>
                                    <option value="Jacket" @selected($style->type_of_garments == 'Jacket')>Jacket</option>
                                </select>
                                <span class="text-danger error-text update_type_of_garments_error"></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group mt-1">
                                <button type="submit" class="btn text-white bg-cyan mt-4">Edit</button>
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

        // Update Data
        $('#editForm').submit(function (event) {
            event.preventDefault();
            var id = $('#style_id').val();
            var url = "{{ route('admin.style.update', ":id") }}";
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
                        toastr.success('Style update successfully.');
                    }
                },
            });
        });
    });
</script>
@endsection
