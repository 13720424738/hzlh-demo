<?php

namespace Modules\Crew\Http\Controllers;

use Modules\Crew\Entities\Crew\Crew;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

// use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function crew(): Crew
    {
        return Auth::crew();
    }

    public function crewLogin(Request $request)
    {
        $credentials = request(['username', 'password']);

        return ($token = Auth::guard('crew')->attempt($credentials))
            ? response(['token' => 'bearer ' . $token], 200)
            : response(['error' => '账号或密码错误'], 400);
    }
}
