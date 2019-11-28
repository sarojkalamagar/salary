<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{

    use SoftDeletes;

    protected $table = 'employees';

    protected $fillable = [
        'name',
        'salary_per_month'
    ];

    /**
     * Get attendance
     * @return Relation
     */
    public function attendance(){
        return $this->hasMany(Attendance::class, 'employee_id', 'id');
    }

    /**
     * Check whether employee has attendance for a specific date or not
     */
    public function hasAttendance($date){
        return $this->attendance()->where('date', $date)->first();
    }

    /**
     * Calculate salary for specific year and month
     * @param int $year
     * @param int $month
     * @return float
     */
    public function calculateSalary($year, $month){
        $noOfDays = date('t', mktime(0, 0, 0, $month, 1, $year));
        $firstDay = $year . '-' . $month . '-01';

        $noOfHolidays = count(Holiday::where('date', '>=', $firstDay)->where('date', '<=', date('Y-m-d'))->get());
        $noOfWeekOffs = 4;
        $totalDaysToWork = $noOfDays - $noOfHolidays - $noOfWeekOffs;

        $halfWorkedDaysCount = $this->calculateHalfDays($year, $month);
        $fullWorkedDaysCount = $this->calculateFullDays($year, $month);

        $halfSalaries = $halfWorkedDaysCount * (5000/$totalDaysToWork);
        $fullSalaries = $fullWorkedDaysCount * (10000/$totalDaysToWork);

        return round($fullSalaries + $halfSalaries, 2);
    }

    /**
     * Calculate half days
     * @param int $year
     * @param int $month
     * @return int
     */
    public function calculateHalfDays($year, $month){
        $noOfDays = date('t', mktime(0, 0, 0, $month, 1, $year));
        $firstDay = $year . '-' . $month . '-01';
        $lastDay = $year . '-' . $month . '-' . $noOfDays;

        $halfWorkedDaysCount = count(Attendance::where('employee_id', $this->id)->where('date', '>=', $firstDay)->where('date', '<=', $lastDay)->where('no_of_hours_worked', '<', 8)->get());

        return $halfWorkedDaysCount;
    }

    /**
     * Calculate ful days
     * @param int $year
     * @param int $month
     * @return int
     */
    public function calculateFullDays($year, $month){
        $noOfDays = date('t', mktime(0, 0, 0, $month, 1, $year));
        $firstDay = $year . '-' . $month . '-01';
        $lastDay = $year . '-' . $month . '-' . $noOfDays;

        $fullWorkedDaysCount = count(Attendance::where('employee_id', $this->id)->where('date', '>=', $firstDay)->where('date', '<=', $lastDay)->where('no_of_hours_worked', '>=', 8)->get());

        return $fullWorkedDaysCount;
    }

}
