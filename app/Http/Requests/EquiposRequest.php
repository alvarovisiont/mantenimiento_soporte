<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EquiposRequest extends Request
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
            'bm'         => 'unique:equipos',
            'nom_equipo' => 'unique:equipos',
            'ip'         => 'unique:equipos',
            'monitor'    => 'unique:equipos',
            'raton'      => 'unique:equipos',
            'teclado'    => 'unique:equipos'
        ];
    }

    public function messages()
    {
        return [
            'unique' => 'Ya ha sido registrado una información en este campo con estas características'
        ];
    }
}
