<?php

namespace App\Repositories\Employee;

use App\Employee;
use Illuminate\Database\Eloquent\Collection;

class EmployeeRepository implements EmployeeInterface{

    protected $query;
    protected $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
        $this->query = $employee;
    }

    /**
     * Get employees
     * @return Collection
     */
    public function get()
    {
        $employees = $this->query->get();
        $this->reset();

        return $employees;
    }

    /**
     * Reset query for next request
     * @return void
     */
    public function reset()
    {
        $this->query = $this->employee;
    }

    /**
     * Find employee
     * @param int $id
     * @return Employee
     */
    public function find($id)
    {
        return Employee::findOrFail($id);
    }
}