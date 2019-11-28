<?php

namespace App\Http\Controllers;

use App\Http\Requests\Attendance\StoreAttendanceRequest;
use App\Http\Responses\Attendance\UpdateAttendanceResponse;
use App\Services\AttendanceService;
use App\Services\EmployeeService;
use App\Http\Responses\Attendance\CreateAttendanceResponse;

class AttendanceController extends Controller
{

    protected $employeeService, $attendanceService;

    public function __construct(EmployeeService $employeeService, AttendanceService $attendanceService)
    {
        $this->employeeService = $employeeService;
        $this->attendanceService = $attendanceService;
    }

    /**
     * Show attendance form
     * @return CreateAttendanceResponse
     */
    public function create(){
        $employees = $this->employeeService->getEmployees();

        return new CreateAttendanceResponse($employees);
    }

    /**
     * Store attendance
     * @param StoreAttendanceRequest $request
     * @return UpdateAttendanceResponse
     */
    public function store(StoreAttendanceRequest $request){
        $values = $request->getInputValues();

        $employee = $this->employeeService->findEmployee($values['employee_id']);
        $existingAttendance = $employee->hasAttendance(date('Y-m-d'));

        if(!$request->in_time && !$request->out_time){
            $attendance = true;
            if($existingAttendance)
                $attendance = $this->attendanceService->deleteAttendance($existingAttendance->id);
        }else{
            if($existingAttendance){
                $attendance = $this->attendanceService->updateAttendance($existingAttendance->id, $values);
            }else{
                $attendance = $this->attendanceService->createAttendance($values);
            }
        }

        return new UpdateAttendanceResponse($attendance);
    }

}
