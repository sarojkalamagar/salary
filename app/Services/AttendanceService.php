<?php

namespace App\Services;

use App\Attendance;
use App\Repositories\Attendance\AttendanceInterface;

class AttendanceService{

    protected $attendance;

    public function __construct(AttendanceInterface $attendance)
    {
        $this->attendance = $attendance;
    }

    /**
     * Create attendance
     * @param array $values
     * @return Attendance|false
     */
    public function createAttendance($values = []){
        return $this->attendance->create($values);
    }

    /**
     * Update attendance
     * @param int $id
     * @param array $values
     * @return Attendance|false
     */
    public function updateAttendance($id, $values = []){
        return $this->attendance->update($id, $values);
    }

    /**
     * Delete attendance
     * @param int $id
     * @return boolean
     */
    public function deleteAttendance($id){
        return $this->attendance->delete($id);
    }

}