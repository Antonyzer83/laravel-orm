<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
