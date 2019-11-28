<?php

namespace App\Http\Responses\Attendance;

use App\Traits\Response;
use Illuminate\Contracts\Support\Responsable;

class UpdateAttendanceResponse implements Responsable
{

    use Response;
    protected
        $fail_message = 'Attendance update failed.',
        $success_message = 'Attendance update success.';
    protected
        $message = NULL,
        $data = NULL,
        $code = 500;
    protected
        $attendance;

    public function __construct($attendance)
    {
        $this->attendance = $attendance;
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
        if($this->attendance){
            return redirect()->back()->with([
                'success_msg' => $this->success_message
            ]);
        }else{
            return redirect()->back()->with([
                'fail_msg' => $this->fail_message
            ]);
        }
    }
}