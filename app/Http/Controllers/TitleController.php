<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Http\Requests\TitleRequest;
use App\Title;
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
     * @param Employee $employee
     * @param TitleRequest $request
     * @return string
     */
    public function store(Employee $employee, TitleRequest $request)
    {
        $data = $request->validated();
        $data['emp_no'] = $employee->emp_no;
        $data['from_date'] = date('Y-m-d');
        $data['to_date'] = '9999-01-01';

        $lastTitle = $employee->titles()->where('to_date', '9999-01-01')->first();
        /*$lastTitle = Title::where([
            ['to_date', '9999-01-01'],
            ['emp_no', $employee->emp_no],
        ])->first();*/
        $lastTitle['to_date'] = date('Y-m-d');
        $lastTitle->save();

        //$title = $employee->titles()->create($data);
        $newTitle = Title::create($data);

        return $newTitle->toJson();
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
            ->offset($id)
            ->limit($id)->get();

        return $title->toJson();
    }
}
