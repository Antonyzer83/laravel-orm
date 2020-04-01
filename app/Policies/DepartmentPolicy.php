<?php

namespace App\Policies;

use App\Department;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DepartmentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Check if the user is manager of this department
     *
     * @param User $user
     * @param Department $department
     * @return bool
     */
    public function myEmployees(User $user, Department $department)
    {
        $employee = auth()->user()->employee()->get()[0];
        return ($employee->isManager() && $employee->myDepartment()->dept_no === $department->dept_no);
    }
}
