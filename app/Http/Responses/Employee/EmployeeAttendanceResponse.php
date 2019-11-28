<?php

namespace App\Http\Responses\Employee;

use App\Traits\Response;
use Illuminate\Contracts\Support\Responsable;

class EmployeeAttendanceResponse implements Responsable
{

    use Response;
    protected
        $fail_message = 'Employee attendance retrieve failed.',
        $success_message = 'Employee attendance retrieve success.';
    protected
        $message = NULL,
        $data = NULL,
        $code = 500;
    protected
        $employee;

    public function __construct($employee)
    {
        $this->employee = $employee;
        $this->code = 200;
        $this->message = $this->success_message;
    }

    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\\Illuminate\Http\Request $request
     * @return \Illuminate\Http\\Illuminate\Http\Response
     */
    public function toResponse($request)
    {
        if ($request->expectsJson()) return $this->jsonResponse();
        return $this->htmlResponse();
    }

    /**
     * Generate JSON response
     */
    public function jsonResponse()
    {
        return $this->response($this->data, $this->message, $this->code);
    }

    /**
     * Generate HTML response
     */
    public function htmlResponse()
    {
        return view('employee.attendance', [
            'employee' => $this->employee
        ]);
    }
}