@extends('layouts.master')

@section('title', 'Style')

@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create Style</h3>
                <div class="card-options">
                    <a href="{{ route('admin.style.index') }}" class="btn text-white bg-pink"><i class="fe fe-database"></i></a>
                    <a href="#" class="card-options-fullscreen btn text-white bg-indigo" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                    <a href="javascript:void(0)" class="card-options-remove btn text-white bg-orange" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">
                <form id="createForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Buyer Name</label>
                                <select name="buyer_id" id="" class="form-control custom-select">
                                    <option value="">--Select Buyer--</option>
                                    @foreach ($buyers as $buyer)
                                    <option value="{{ $buyer->id }}">{{ $buyer->buyer_name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text buyer_id_error"></span>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="form-label">Style Name</label>
                                <input type="text" class="form-control" name="style_name" placeholder="Style Name">
                                <span class="text-danger error-text style_name_error"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Style Description</label>
                                <textarea class="form-control" name="style_description" placeholder="Style Description"></textarea>
                                <span class="text-danger error-text style_description_error"></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="form-label">Season Name</label>
                                <select name="season_id" id="" class="form-control custom-select">
                                    <option value="">--Select Season--</option>
                                    @foreach ($seasons as $season)
                                    <option value="{{ $season->id }}">{{ $season->season_name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text season_id_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Color Name</label>
                                <select name="color_id" id="" class="form-control custom-select">
                                    <option value="">--Select Color--</option>
                                    @foreach ($colors as $color)
                                    <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text color_id_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Wash Name</label>
                                <select name="wash_id" id="" class="form-control custom-select">
                                    <option value="">--Select Wash--</option>
                                    @foreach ($washs as $wash)
                                    <option value="{{ $wash->id }}">{{ $wash->wash_name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text wash_id_error"></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="form-label">Type Of Garments</label>
                                <select name="type_of_garments" id="" class="form-control custom-select">
                                    <option value="">--Select Type--</option>
                                    <option value="Long Pant">Long Pant</option>
                                    <option value="Short Pant">Short Pant</option>
                                    <option value="Jacket">Jacket</option>
                                </select>
                                <span class="text-danger error-text type_of_garments_error"></span>
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
