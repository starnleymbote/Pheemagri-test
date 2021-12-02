<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    use AuthenticatesUsers {
      logout as performLogout;
  }

  /**
   * Redirecting users afer logging out
   */
  public function logout(Request $request)
  {
      $this->performLogout($request);
      
      return redirect()->route('index');
  }
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    public function redirectTo() {
        $role = Auth::user()->role_id; 
        switch ($role) {
          case '1':
            return '/farmer';
            break;

        case '2':
            return '/inputprovider';
            break;
        
        case '3':
            return '/bank/investor';
            break;
        
        case '4':
            return '/vendor';
            break;
      
          default:
            return '/home'; 
          break;
        }
      }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
