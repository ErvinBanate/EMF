<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;


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

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function ShowLoginForm()
    {
    	return view('authentication.login');
    }

    public function HandleLogin(Request $request)
    {
        
        $credentials = $request->except(['_token']);

        if (auth()->attempt($credentials)) 
        {
          return redirect()->route('home');
        }

        session()->flash('message', 'Invalid Credentials');

        session()->flash('type', 'danger');

        return redirect()->back();
    }
}
