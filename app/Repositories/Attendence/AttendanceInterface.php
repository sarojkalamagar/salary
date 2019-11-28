<?php

namespace App\Repositories\Attendance;

use App\Attendance;

interface AttendanceInterface{

    /**
     * Create attendance
     * @param array $values
     * @return Attendance|false
     */
    public function create($values = []);

    /**
     * Update attendance
     * @param int $id
     * @param array $values
     * @return Attendance|false
     */
    public function update($id, $values = []);

    /**
     * Find attendance
     * @param int $id
     * @return Attendance
     */
    public function find($id);

    /**
     * Delete attendance
     * @param int $id
     * @return boolean
     */
    public function delete($id);

}