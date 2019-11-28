<?php

namespace App\Http\Responses\Attendance;

use App\Traits\Response;
use Illuminate\Contracts\Support\Responsable;

class CreateAttendanceResponse implements Responsable
{

    use Response;
    protected
        $fail_message = 'Attendance create failed.',
        $success_message = 'Attendance create success.';
    protected
        $message = NULL,
        $data = NULL,
        $code = 500;
    protected
        $employees;

    public function __construct($employees)
    {
        $this->employees = $employees;
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
        return view('attendance.create', [
            'employees' => $this->employees
        ]);
    }
}