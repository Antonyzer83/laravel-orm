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
            ->limit(50)
            ->get();

        $managers = Employee::join('titles', 'titles.emp_no', 'employees.emp_no')
            ->where([
                ['title', 'Manager'],
                ['to_date', '9999-01-01'],
            ])
            ->get();

        $this->createUsers($employees);
        $this->createUsers($managers);
    }

    private function createUsers($employees) {
        foreach ($employees as $employee) {
            $data = [];
            $data['emp_no'] = $employee->emp_no;
            $data['email'] = strtolower($employee->first_name) . '.' . strtolower($employee->last_name) . '@employees.edu';
            $data['password'] = bcrypt('azertyuiop');

            User::create($data);
        }
    }
}
