<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class AuthRequest extends FormRequest
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
        if (Route::current()->uri === "api/login") {
            $rules = [
                'email' => 'required|email|exists:users,email',
                'password' => 'required|string',
            ];
        } else {
            $rules = [
                'name' => 'required|string',
                'email' => 'required|email',
                'password' => 'required|string',
                'c_password' => 'required|string|same:password',
            ];
        }

        return $rules;
    }
}
