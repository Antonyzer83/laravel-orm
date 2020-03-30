<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Http\Requests\EmployeeRequest;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return Employee::paginate(15)->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EmployeeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(EmployeeRequest $request)
    {
        $data = $request->validated();

        $employee = Employee::create($data);

        return $employee->toJson();
    }

    /**
     * Display the specified resource.
     *
     * @param Employee $employee
     * @return string
     */
    public function show(Employee $employee)
    {
        return $employee->toJson();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EmployeeRequest $request
     * @param Employee $employee
     * @return string
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $data = $request->validated();

        $employee->update($data);

        return $employee->toJson();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Employee $employee
     * @return string
     * @throws \Exception
     */
    public function destroy(Employee $employee)
    {
        $e = $employee;
        $employee->delete();
        return $e->toJson();
    }

    /**
     * Check the employee's title
     *
     * @param $id
     * @return array
     */
    public function isManager($id)
    {
        $employee = Employee::find($id);

        if ($employee !== null)
            return ['status' => $employee->isManager()];

        return ['status' => null];
    }

    /**
     * Get the current department of one employee
     *
     * @param $id
     * @return array
     */
    public function myDepartment($id)
    {
        $employee = Employee::find($id);

        if ($employee !== null)
            return ['department' => $employee->myDepartment()];

        return ['department' => null];
    }
}
