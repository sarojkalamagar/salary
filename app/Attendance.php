<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{

    use SoftDeletes;

    protected $table = 'attendance';

    protected $fillable = [
        'employee_id',
        'date',
        'in_time',
        'out_time',
        'comments',
        'no_of_hours_worked'
    ];

    /**
     * Get employee
     * @return Relation
     */
    public function employee(){
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

}
