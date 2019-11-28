@extends('layout.master')

@section('main-content')
    <div class="row">
        <div class="col-lg-12">
            <p>
                <a href="{{ route('employee.salary') }}">Salary <i class="fa fa-arrow-right"></i></a>
            </p>
            <h1>Attendance</h1>
        </div>
        <div class="col-lg-12">
            <form action="{{ route('attendance.store') }}" method="POST">
                {{ csrf_field() }}

                <div class="row">

                    <div class="col-lg-12">
                        <p class="text-green">Date: {{ date('Y-m-d') }}, {{ date('D', strtotime(date('Y-m-d'))) }}</p>
                    </div>

                    <div class="form-group col-lg-12">
                        <label for="employee-input">Employee*</label>
                        <select id="employee-input" class="form-control" name="employee_id" required>
                            <option value="">Select</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }} data-attendance-url="{{ route('employee.attendance', $employee->id) }}?date={{ date('Y-m-d') }}">{{ $employee->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-lg-6">
                        <label for="in-time-input">In time</label>
                        <input id="in-time-input" class="form-control" name="in_time" value="{{ old('in_time') }}" type="time" />
                        {{ $errors->first('in_time', '<span class="errorMessage">:message</span>') }}
                    </div>

                    <div class="form-group col-lg-6">
                        <label for="out-time-input">Out time</label>
                        <input id="out-time-input" class="form-control" name="out_time" value="{{ old('out_time') }}" type="time" />
                        {{ $errors->first('out_time', '<span class="errorMessage">:message</span>') }}
                    </div>

                    <div class="form-group col-lg-12">
                        <label for="comments-input">Comments</label>
                        <textarea id="comments-input" class="form-control" name="comments" placeholder="Enter comments about tasks performed today." style="height: 200px;">{{ old('comments') }}</textarea>
                        {{ $errors->first('out_time', '<span class="errorMessage">:message</span>') }}
                    </div>

                    <div class="form-group col-lg-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection

@section('page-info')
    <title>Add attendance entry</title>
@endsection

@section('page-specific-css')

@endsection

@section('page-specific-js')
    <script>
        $(document).on('change', '#employee-input', function(){
            var employeeId = $(this).val();

            if(employeeId){
                var url = $(this).find(':selected').data('attendance-url');

                $.get(url)
                    .done(function( response ) {
                        $('#in-time-input').val(response.in_time);
                        $('#out-time-input').val(response.out_time);
                    });
            }else{
                clearTimeInputs();
            }
        });

        function clearTimeInputs(){
            $('#in-time-input').val('');
            $('#out-time-input').val('');
        }
    </script>
@endsection