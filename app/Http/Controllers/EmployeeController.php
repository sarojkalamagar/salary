<?php

namespace App\Http\Controllers;

use App\Http\Responses\Employee\EmployeeAttendanceResponse;
use App\Http\Responses\Employee\EmployeeSalaryResponse;
use App\Http\Responses\Employee\ParticularDayAttendanceResponse;
use App\Services\EmployeeService;
use App\Traits\CustomPaginator;

class EmployeeController extends Controller
{

    use CustomPaginator;

    protected $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    /**
     * Get employee salary
     * @return EmployeeSalaryResponse
     */
    public function salary(){
        $employees = $this->paginate($this->employeeService->getEmployees(), 20);

        return new EmployeeSalaryResponse($employees);
    }

    /**
     * Get employee's attendance
     * @param int $id
     * @return EmployeeAttendanceResponse
     */
    public function attendance($id){
        $employee = $this->employeeService->findEmployee($id);

        if(request()->has('date') and request('date') != ''){

            $attendance = $employee->hasAttendance(request('date'));

            return response()->json($attendance);
        }

        return new EmployeeAttendanceResponse($employee);
    }

}
