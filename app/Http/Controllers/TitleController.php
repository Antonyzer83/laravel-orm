<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

class TitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Employee $employee
     * @return string
     */
    public function index(Employee $employee)
    {
        $titles = $employee->titles()->get();

        return $titles->toJson();
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
        $title = $employee->titles()
            ->orderBy('to_date')
            ->offset($id - 1)
            ->limit($id)->get();

        return $title->toJson();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
