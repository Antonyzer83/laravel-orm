<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;
use App\Http\Resources\Department as Resource;

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
    public function store()
    {
        $data = $this->storeValidation();

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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Department $department)
    {
        $data = $this->updateValidation();

        $department->update($data);

        return $department->toJson();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $d = $department;
        $department->delete();
        return $d->toJson();
    }

    protected function storeValidation()
    {
        return request()->validate([
            'dept_no' => 'required|min:4|max:4|unique:departments,dept_no',
            'dept_name' => 'required|string|max:40'
        ]);
    }

    protected function updateValidation()
    {
        return request()->validate([
            'dept_name' => 'string|max:40'
        ]);
    }
}
