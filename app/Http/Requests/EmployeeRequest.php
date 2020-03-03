<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'emp_no' => 'integer|unique:employees,emp_no',
            'birth_date' => 'date',
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'gender' => 'string|in:M,F',
            'hire_date' => 'date|after:birth_date'
        ];

        if ($this->isMethod('POST')) {
            $keys = array_keys($rules);
            for ($i = 0; $i < sizeof($rules); $i++) {
                $rules[$keys[$i]] .= '|required';
            }
        }

        return $rules;
    }
}
