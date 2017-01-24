<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegisterRequest extends Request
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
        return [
            'cedula' => 'required|max:8|min:7|unique:users',
            'name' => 'required|max:70',
            'apellido' => 'required|max:80',
            'usuario' => 'required|max:18|unique:users',
            'nivel' => 'required',
            'password' => 'required|min:6|confirmed',
        ];
    }

}
