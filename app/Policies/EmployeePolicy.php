<?php

namespace App\Policies;

use App\Employee;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployeePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create employees.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->employee()->first()->isManager();
    }

    /**
     * Create employee's title
     *
     * Manager's department
     *
     * @param User $user
     * @param Employee $employee
     * @return bool
     */
    public function createSalaryTitle(User $user, Employee $employee)
    {
        $manager = $user->employee()->where('emp_no', auth()->user()->emp_no)->first();
        return $manager->isManager() && $manager->myDepartment()->dept_no === $employee->myDepartment()->dept_no;
    }

    /**
     * Show employee's salary
     *
     * Manager's department or himself
     *
     * @param User $user
     * @param Employee $employee
     * @return bool
     */
    public function showSalary(User $user, Employee $employee)
    {
        $manager = $user->employee()->where('emp_no', auth()->user()->emp_no)->first();
        return $manager->isManager() && $manager->myDepartment()->dept_no === $employee->myDepartment()->dept_no || $manager->emp_no === $employee->emp_no;
    }

    /**
     * Determine whether the user can update the employee.
     *
     * Manager's department or himself
     *
     * @param  \App\User  $user
     * @param  \App\Employee  $employee
     * @return mixed
     */
    public function update(User $user, Employee $employee)
    {
        $manager = $user->employee()->where('emp_no', auth()->user()->emp_no)->first();
        return ($manager->isManager() && $manager->myDepartment()->dept_no === $employee->myDepartment()->dept_no) || $manager->emp_no === $employee->emp_no;
    }
}
