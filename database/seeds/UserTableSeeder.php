<?php

use App\Employee;
use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employees = Employee::orderBy('emp_no')
            ->limit(100)
            ->get();

        foreach ($employees as $employee) {
            $data = [];
            $data['emp_no'] = $employee->emp_no;
            $data['email'] = strtolower($employee->first_name) . '.' . strtolower($employee->last_name) . '@employees.edu';
            $data['password'] = bcrypt('azertyuiop');

            User::create($data);
        }
    }
}
