@extends('layout.master')

@section('main-content')
    <div class="row">
        <div class="col-lg-12">
            <p>
                <a href="{{ route('employee.salary') }}"><i class="fa fa-arrow-left"></i> Salary</a>
                <a href="{{ route('attendance.create') }}"><i class="fa fa-arrow-left"></i> Attendance</a>
            </p>
            <h1>Employee attendance</h1>
            <p class="text-green">Attendance for: {{ date('Y') }} {{ date('M', strtotime(date('Y-m-d'))) }}</p>
            <p>Employee: {{ $employee->name  }}</p>
            <p>Total half days: {{ $employee->calculateHalfDays(date('Y'), date('m')) }}, Total full days: {{ $employee->calculateFullDays(date('Y'), date('m')) }}</p>
        </div>
        <div class="col-lg-12">
            <table class="table">
                <thead>
                <tr>
                    <th>SN</th>
                    <th>In time</th>
                    <th>Out time</th>
                    <th>Comments</th>
                    <th>No. of hours</th>
                </tr>
                </thead>
                <tbody>
                @forelse($employee->attendance as $attendance)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $attendance->in_time }}</td>
                        <td>{{ $attendance->out_time }}</td>
                        <td>{{ $attendance->comments }}</td>
                        <td>{{ $attendance->no_of_hours_worked }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No attendance found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <p class="text-grey">*Missing either in time or out time sets total worked hours to 0 which is counted as half day.</p>
        </div>
    </div>
@endsection

@section('page-info')
    <title>Employee attendance | {{ $employee->name }}</title>
@endsection

@section('page-specific-css')

@endsection

@section('page-specific-js')

@endsection