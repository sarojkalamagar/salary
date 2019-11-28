<?php

namespace App\Services;

use App\Employee;
use App\Repositories\Employee\EmployeeInterface;
use Illuminate\Database\Eloquent\Collection;

class EmployeeService{

    protected $employee;

    public function __construct(EmployeeInterface $employee)
    {
        $this->employee = $employee;
    }

    /**
     * Get employees
     * @return Collection
     */
    public function getEmployees(){
        return $this->employee->get();
    }

    /**
     * Find employee
     * @param int $id
     * @return Employee
     */
    public function findEmployee($id){
        return $this->employee->find($id);
    }

}