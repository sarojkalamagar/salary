<?php

namespace App\Repositories\Attendance;

use App\Attendance;

class AttendanceRepository implements AttendanceInterface {

    protected $attendance;

    public function __construct(Attendance $attendance)
    {
        $this->attendance = $attendance;
    }

    /**
     * Create attendance
     * @param array $values
     * @return Attendance|false
     */
    public function create($values = [])
    {
        $attendance = new Attendance($values);

        return $attendance->save() ? $attendance : false;
    }

    /**
     * Update attendance
     * @param int $id
     * @param array $values
     * @return Attendance|false
     */
    public function update($id, $values = [])
    {
        $attendance = $this->find($id);

        return $attendance->update($values) ? $attendance : false;
    }

    /**
     * Find attendance
     * @param int $id
     * @return Attendance
     */
    public function find($id)
    {
        return Attendance::findOrFail($id);
    }

    /**
     * Delete attendance
     * @param int $id
     * @return boolean
     */
    public function delete($id)
    {
        $attendance = $this->find($id);

        return $attendance->delete();
    }
}