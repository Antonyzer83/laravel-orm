<?php

namespace App\Http\Controllers;

use App\Employee;
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
        return response()->json(Resource::collection(Employee::paginate(15)));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        $data = $this->storeValidation();

        $bigId = Employee::max('emp_no');
        $data['emp_no'] = $bigId + 1;

        $employee = Employee::create($data);

        return response()->json($employee);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return response()->json(Employee::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id)
    {
        $data = $this->updateValidation();

        $employee = Employee::find($id);
        $employee->update($data);

        return response()->json($employee);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Employee::delete($id);
    }

    protected function storeValidation()
    {
        return request()->validate([
            'birth_date' => 'required|date',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'gender' => 'required|in:M,F',
            'hire_date' => 'required|date'
        ]);
    }

    protected function updateValidation()
    {
        return request()->validate([
            'birth_date' => 'date',
            'first_name' => 'string',
            'last_name' => 'string',
            'gender' => 'in:M,F',
            'hire_date' => 'date'
        ]);
    }
}
