<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use DB;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = 'layout';

//Para que inicie sesion con usuario en vez de email
        protected $username = "usuario";

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'cedula' => 'required|max:8|min:7|unique:users',
            'name' => 'required|max:70',
            'apellido' => 'required|max:80',
            'usuario' => 'required|max:18|unique:users',
            'nivel' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */

    public function index() {
    }

          

    public function create(array $data)
    {
        //para redireccionar despues de registrar
        $this->redirectTo = '/layout';
        return User::create([
            'cedula' => $data['cedula'],
            'name'   => $data['name'],
            'apellido' => $data['apellido'],
            'usuario' => $data['usuario'],
            'password' => bcrypt($data['password']),
            'nivel' => $data['nivel'],
        ]);
    }


}
