<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Http\Request;
use App\Http\Resources\Employee as Resource;

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
     * @return \Illuminate\Http\JsonResponse
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
     * @return \Illuminate\Http\JsonResponse
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
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Employee $employee)
    {
        $e = $employee;
        $employee->delete();
        return $e->toJson();
    }
}
