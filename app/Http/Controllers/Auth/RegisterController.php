<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Roles;
use Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
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
    //protected $redirectTo = '/';
    //protected $redirectTo = RouteServiceProvider::HOME;

    protected function redirectTo()
    {
        $role = Auth::user()->role_id;

        if ($role == 4) {
            return '/vendor';
        }
        elseif($role == 3)
        {
            return '/bank/investor';
        }
        elseif($role == 2)
        {
            return '/inputprovider';
        }
        else
        {
            return '/farmer';
        }
        
    }

    // public function redirectTo() {
    //     $role = Auth::user()->role_id; 
    //     switch ($role) {
    //       case '1':
    //         return '/farmer';
    //         break;

    //     case '2':
    //         return '/inputprovider';
    //         break;
        
    //     case '3':
    //         return '/bank/investor';
    //         break;
        
    //     case '4':
    //         return '/vendor';
    //         break;
      
    //       default:
    //         return '/home'; 
    //       break;
    //     }
    //   }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $role = Roles::select('id','name')->get();

        return view('auth.register')->with('role', $role);
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
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:55', 'unique :users'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required', 'int'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'role_id' => $data['role_id'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
