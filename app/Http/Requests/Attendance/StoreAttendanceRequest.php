<?php

namespace App\Http\Requests\Attendance;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttendanceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'employee_id' => 'required|exists:employees,id'
        ];

        return $rules;
    }

    /**
     * Validation error messages
     * @return array
     */
    public function messages(){
        return [
            'employee_id.required' => ':attribute is required.',
            'employee_id.exists' => ':attribute doesn\'t exist.'
        ];
    }

    /**
     * Name => label binding
     * @return array
     */
    public function attributes()
    {
        return [
            'employee_id' => 'Employee'
        ];
    }

    /**
     * Get input values
     * @return array
     */
    public function getInputValues(){
        $values = $this->only([
            'employee_id',
            'comments'
        ]);

        $values['date'] = date('Y-m-d');

        if($this->in_time){
            $values['in_time'] = $this->in_time . ':00';
        }else{
            $values['in_time'] = null;
        }

        if($this->out_time){
            $values['out_time'] = $this->out_time . ':00';
        }else{
            $values['out_time'] = null;
        }

        $time1 = strtotime($values['in_time']);
        $time2 = strtotime($values['out_time']);

        if($this->out_time && $this->in_time)
            $values['no_of_hours_worked'] = round(abs( $time2 - $time1 ) / 3600,2);
        else
            $values['no_of_hours_worked'] = 0;

        return $values;
    }
}
