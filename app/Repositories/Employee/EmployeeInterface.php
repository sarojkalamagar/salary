<?php

namespace App\Repositories\Employee;

use App\Employee;
use Illuminate\Database\Eloquent\Collection;

interface EmployeeInterface{

    /**
     * Get employees
     * @return Collection
     */
    public function get();

    /**
     * Reset query for next request
     */
    public function reset();

    /**
     * Find employee
     * @param int $id
     * @return Employee
     */
    public function find($id);

}