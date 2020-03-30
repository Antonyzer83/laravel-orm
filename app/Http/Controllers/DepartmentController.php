<?php

namespace App\Http\Controllers;

use App\Department;
use App\Http\Requests\DepartmentRequest;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return Department::all()->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentRequest $request)
    {
        $data = $request->validated();

        $department = Department::create($data);

        return $department->toJson();
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Department $department)
    {
        return $department->toJson();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DepartmentRequest $request
     * @param Department $department
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentRequest $request, Department $department)
    {
        $data = $request->validated();

        $department->update($data);

        return $department->toJson();
    }

    /**
     * Get all current employees from a department
     *
     * @param $id
     * @return mixed
     */
    public function employees($id)
    {
        $department = Department::find($id);

        $employees = $department->employees()->where('to_date', '9999-01-01')->get();

        return $employees->toJson();
    }
}
