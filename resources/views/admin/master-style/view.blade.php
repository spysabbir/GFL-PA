@extends('layouts.master')

@section('title', 'Master Style')

@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">View Master Style</h3>
                <div class="card-options">
                    <a href="{{ route('admin.master-style.index') }}" class="btn text-white bg-pink"><i class="fe fe-database"></i></a>
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
                                <th>{{ $masterStyle->id }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Buyer Name</td>
                                <td>{{ $masterStyle->buyer->buyer_name }}</td>
                            </tr>
                            <tr>
                                <td>Style Name</td>
                                <td>{{ $masterStyle->style->style_name }}</td>
                            </tr>
                            <tr>
                                <td>Style Description</td>
                                <td>{{ $masterStyle->style_description }}</td>
                            </tr>
                            <tr>
                                <td>Season Name</td>
                                <td>{{ $masterStyle->season->season_name }}</td>
                            </tr>
                            <tr>
                                <td>Color Name</td>
                                <td>{{ $masterStyle->color->color_name }}</td>
                            </tr>
                            <tr>
                                <td>Wash Name</td>
                                <td>{{ $masterStyle->wash->wash_name }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>{{ $masterStyle->status }}</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Created by</th>
                                <th>{{ $masterStyle->user->name }}</th>
                            </tr>
                            <tr>
                                <th>Created at</th>
                                <th>{{ $masterStyle->created_at->format('Y-m-d H:i:s') }}</th>
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

</script>
@endsection
