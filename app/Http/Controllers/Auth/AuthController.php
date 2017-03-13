<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Auth;
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
    protected $redirectTo = 'escritorioBienvenida';

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
        //$this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    
    // Función que susplanta la función por default de authUsers para desplegar errores en los datos de acceso (Credenciales)

    protected function sendFailedLoginResponse()
    {

        return view('auth.login')->with('failedLogin', 'Error en sus credenciales. Intentelo de nuevo por favor');
    }



    protected function validator(array $data)
    {
        return Validator::make($data, [
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


    public function logout()
    {
         $user = User::where('id_user', '=', Auth::user()->id_user)->firstOrFail();
         $user->online = 0;
         $user->save();
         Auth::logout();

         return view('auth.login');
    }


}
