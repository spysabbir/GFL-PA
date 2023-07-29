@extends('layouts.master')

@section('title', 'Master Style')

@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">View Master Style</h3>
                <div class="card-options">
                    <a href="{{ route('employee.master-style.index') }}" class="btn text-white bg-pink"><i class="fe fe-database"></i></a>
                    <a href="#" class="card-options-fullscreen btn text-white bg-indigo" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                    <a href="javascript:void(0)" class="card-options-remove btn text-white bg-orange" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Unique Id </th>
                                        <th colspan="3"><span class="badge bg-success p-2">{{ $masterStyle->unique_id  }}</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Buyer Name</td>
                                        <td colspan="3">{{ $masterStyle->buyer->buyer_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Style Name</td>
                                        <td colspan="3">{{ $masterStyle->style->style_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Season Name</td>
                                        <td>{{ $masterStyle->season->season_name }}</td>
                                        <td>Color Name</td>
                                        <td>{{ $masterStyle->color->color_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Wash Name</td>
                                        <td>{{ $masterStyle->wash->wash_name }}</td>
                                        <td>Type of Garment</td>
                                        <td>{{ $masterStyle->garmentType->item_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>
                                            @if ($masterStyle->status == 'Inactive')
                                                <span class="badge bg-info">{{ $masterStyle->status }}</span>
                                            @elseif ($masterStyle->status == 'Running')
                                                <span class="badge bg-success">{{ $masterStyle->status }}</span>
                                            @elseif ($masterStyle->status == 'Hold')
                                                <span class="badge bg-warning">{{ $masterStyle->status }}</span>
                                            @elseif ($masterStyle->status == 'Close')
                                                <span class="badge bg-primary">{{ $masterStyle->status }}</span>
                                            @else
                                                <span class="badge bg-danger">{{ $masterStyle->status }}</span>
                                            @endif
                                        </td>
                                        <td>Closing Date</td>
                                        <td>{{ ($masterStyle->status_change_date) ? $masterStyle->status_change_date : 'N/A' }}</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Created By</th>
                                        <th>{{ $masterStyle->creater->name }}</th>
                                        <th>Created At</th>
                                        <th>{{ $masterStyle->created_at->format('Y-m-d H:i:s A') }}</th>
                                    </tr>
                                    <tr>
                                        <th>Updated By</th>
                                        <th>{{ $masterStyle->updated_by ? $masterStyle->updater->name : 'N/A'}}</th>
                                        <th>Updated At</th>
                                        <th>{{ $masterStyle->updated_at->format('Y-m-d H:i:s A') }}</th>
                                    </tr>
                                    <tr>
                                        <th>Deleted By</th>
                                        <th>{{ $masterStyle->deleted_by ? $masterStyle->deleter->name : 'N/A' }}</th>
                                        <th>Deleted At</th>
                                        <th>{{ $masterStyle->deleted_at ? date('d-M,Y h:m:s A', strtotime($masterStyle->deleted_at)) : 'N/A'}}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <h3 class="text-center">Total Order Qty: {{ $styleWiseBpoOrder->sum('order_quantity') }}</h3>
                        <div class="table-responsive">
                            <table class="table table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>Bpo No</th>
                                        <th>Order Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($styleWiseBpoOrder as $bpoOrder)
                                    <tr>
                                        <td>{{ $bpoOrder->bpo_no }}</td>
                                        <td>{{ $bpoOrder->order_quantity }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="2">
                                            <span class="text-danger">Bpo Order Not Found</span>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Bpo No</th>
                                        <th>Order Quantity</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
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
