<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Http\Requests\SalaryRequest;
use App\Salary;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Employee $employee
     * @return string
     */
    public function index(Employee $employee)
    {
        $salaries = $employee->salaries()->orderBy('to_date', 'DESC')->get();

        return $salaries->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Employee $employee
     * @param SalaryRequest $request
     * @return void
     */
    public function store(Employee $employee, SalaryRequest $request)
    {
        $data = $request->validated();
        $data['emp_no'] = $employee->emp_no;
        $data['from_date'] = date('Y-m-d');
        $data['to_date'] = '9999-01-01';

        $employee->salaries()
            ->where('to_date', '9999-01-01')
            ->update(['to_date' => date('Y-m-d')]);

        $newSalary = Salary::create($data);

        return $newSalary->toJson();
    }

    /**
     * Display the specified resource.
     *
     * @param Employee $employee
     * @param int $id
     * @return string
     */
    public function show(Employee $employee, $id)
    {
        $salary = $employee->salaries()
            ->orderBy('to_date')
            ->skip($id - 1)
            ->take(1)
            ->get();

        return $salary->toJson();
    }
}
