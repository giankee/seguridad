<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator($data)
    {
        return Validator::make($data,[
            'registerNombre' => ['required', 'alpha','min:2', 'max:20'],
            'registerApellido' => ['required', 'alpha','min:2', 'max:40'],
            'registerDni' => ['required', 'alpha_num','size:9','regex:/[0-9]{8}[A-z]{1}\b/'],
            'registerCorreo' => ['required', 'string', 'email', 'max:255','regex:/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/'],
            'password'=> ['required', 'string', 'confirmed','regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{10,}$/'],
            'registerTelefono'=> ['nullable','min:9', 'max:13','regex:/^(\+[0-9]{1,3}|0)[0-9]{9,12}\b/'],
            'registerIban'=>['required', 'string','size:28','regex:/(ES[0-9]{2} [0-9]{4} [0-9]{4} [0-9]{2} [0-9]{10})/'],
            'registerPersonalInfo'=>['nullable','min:20', 'max:250']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        /*return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);*/
    }

    public function register(Request $request){
        //return $request;
        $this->validateForm($request)->validate();
        $datosUser= new User();
        $datosUser->firstName = $request->registerNombre;
        $datosUser->lastName = $request->registerApellido;
        $datosUser->dni = $request->registerDni;
        $datosUser->email = $request->registerCorreo;
        $datosUser->password = Hash::make($request->password);
        $datosUser->confirm_password = Hash::make($request->password_confirmation);
        $datosUser->iban = $request->registerIban;
        $datosUser->country = $request->registerPais;
        $datosUser->telephone = $request->registerTelefono;
        $datosUser->personal_info = $request->registerPersonalInfo;

        $data= User::where('email',$request->registerCorreo)->first();
        if($data==null){
            $datosUser->save();
        }else return redirect()->route('register')->with('warning',': No se puede registrar el usuario');
        return redirect()->route('login')->with('success',': Registro satisfactorio');
    }

    function validateForm($request){
        return Validator::make($request->all(),[
            'registerNombre' => ['required', 'alpha','min:2', 'max:20'],
            'registerApellido' => ['required', 'alpha','min:2', 'max:40'],
            'registerDni' => ['required', 'alpha_num','size:9','regex:/[0-9]{8}[A-z]{1}\b/'],
            'registerCorreo' => ['required', 'string', 'email', 'max:255','regex:/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/'],
            'password'=> ['required', 'string', 'confirmed','regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{10,}$/'],
            'registerTelefono'=> ['nullable','min:9', 'max:13','regex:/^(\+[0-9]{1,3}|0)[0-9]{9,12}\b/'],
            'registerIban'=>['required', 'string','size:28','regex:/(ES[0-9]{2} [0-9]{4} [0-9]{4} [0-9]{2} [0-9]{10})/'],
            'registerPersonalInfo'=>['nullable','min:20', 'max:250']
        ]);
    }
}
