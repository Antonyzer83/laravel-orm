<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
            'dept_no' => 'min:4|max:4|unique:departments,dept_no',
            'dept_name' => 'string|max:40'
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
