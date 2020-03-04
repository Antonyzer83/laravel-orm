<?php

namespace App\Policies;

use App\Department;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployeePolicy
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

    public function myEmployees(User $user, Department $department)
    {
        return ($user->employee()->isManager());
    }
}
