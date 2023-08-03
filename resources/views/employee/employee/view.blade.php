@extends('layouts.master')

@section('title', 'Employee')

@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Employee</h3>
                <div class="card-options">
                    <a href="{{ route('employee.employee.index') }}" class="btn text-white bg-pink"><i class="fe fe-database"></i></a>
                    <!-- Fullscreen Btn -->
                    <a href="#" class="card-options-fullscreen btn text-white bg-indigo btn-sm" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                    <!-- Close Btn -->
                    <a href="javascript:void(0)" class="card-options-remove btn text-white bg-orange btn-sm" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Employee Id</th>
                                <th>{{ $employee->id }}</th>
                            </tr>
                            <tr>
                                <th>Employee Name</th>
                                <th>{{ $employee->name }}</th>
                                <th>Employee Status</th>
                                <th>{{ $employee->status }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Father Name</td>
                                <td>{{ $employee->father_name }}</td>
                                <td>Mother Name</td>
                                <td>{{ $employee->mother_name }}</td>
                            </tr>
                            <tr>
                                <td>Personal Email</td>
                                <td>{{ $employee->personal_email }}</td>
                                <td>Official Email</td>
                                <td>{{ $employee->official_email }}</td>
                            </tr>
                            <tr>
                                <td>Primary Phone Number</td>
                                <td>{{ $employee->primary_phone_number }}</td>
                                <td>Emergency Phone Number</td>
                                <td>{{ $employee->emergency_phone_number }}</td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td>{{ $employee->gender }}</td>
                                <td>Date of Birth</td>
                                <td>{{ $employee->date_of_birth }}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td colspan="3">{{ $employee->address }}</td>
                            </tr>
                            <tr>
                                <td>Department</td>
                                <td>{{ App\Models\Department::find($employee->department_id)->department_name }}</td>
                                <td>Designation</td>
                                <td>{{ App\Models\Designation::find($employee->designation_id)->designation_name }}</td>
                            </tr>
                            <tr>
                                <td>Nid No</td>
                                <td>{{ $employee->nid_no }}</td>
                                <td>Date of Join</td>
                                <td>{{ $employee->date_of_join }}</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Created By</th>
                                <th>{{ $employee->creater->name }}</th>
                                <th>Created At</th>
                                <th>{{ $employee->created_at->format('Y-m-d H:i:s A') }}</th>
                            </tr>
                            <tr>
                                <th>Updated By</th>
                                <th>{{ $employee->updated_by ? $employee->updater->name : 'N/A'}}</th>
                                <th>Updated At</th>
                                <th>{{ $employee->updated_at->format('Y-m-d H:i:s A') }}</th>
                            </tr>
                            <tr>
                                <th>Deleted By</th>
                                <th>{{ $employee->deleted_by ? $employee->deleter->name : 'N/A' }}</th>
                                <th>Deleted At</th>
                                <th>{{ $employee->deleted_at ? date('d-M,Y h:m:s A', strtotime($employee->deleted_at)) : 'N/A'}}</th>
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

    });
</script>
@endsection
