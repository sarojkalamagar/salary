@extends('layout.master')

@section('main-content')
    <div class="row">
        <div class="col-lg-12">
            <p>
                <a href="{{ route('attendance.create') }}"><i class="fa fa-arrow-left"></i> Attendance</a>
            </p>
            <h1>Employee salary</h1>
            <p class="text-green">{{ date('Y') }} {{ date('M', strtotime(date('Y-m-d'))) }} Employee Salary</p>
            <p>Total employees: {{ count($employees) }}</p>
        </div>
        <div class="col-lg-12">
            <table class="table">
                <thead>
                <tr>
                    <th>SN</th>
                    <th>Employee</th>
                    <th>Month</th>
                    <th>Salary</th>
                    <th>Half days</th>
                    <th>Full days</th>
                </tr>
                </thead>
                <tbody>
                @forelse($employees as $employee)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td><a href="{{ route('employee.attendance', $employee->id) }}" title="View attendance">{{ $employee->name }}</a></td>
                        <td>{{ date('Y') }} {{ date('M', strtotime(date('Y-m-d'))) }}</td>
                        <td>{{ $employee->calculateSalary(date('Y'), date('m')) }}</td>
                        <td>{{ $employee->calculateHalfDays(date('Y'), date('m')) }}</td>
                        <td>{{ $employee->calculateFullDays(date('Y'), date('m')) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No employees found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="col-lg-12">
            {{ $employees->links() }}
        </div>
    </div>
@endsection

@section('page-info')
    <title>Employee salary</title>
@endsection

@section('page-specific-css')

@endsection

@section('page-specific-js')

@endsection