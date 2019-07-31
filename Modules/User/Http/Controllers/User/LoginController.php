<?php

namespace Modules\User\Http\Controllers;

use Modules\User\Entities\User\User;
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

    public function login(Request $request)
    {
        $credentials = request(['cellphone', 'password']);

        // var_dump('hahaha');

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = $this->user();

        return $this->respondWithToken($user, (string) $token);
    }

    /**
     * 获取当前登录用户.
     *
     * @return \Modules\User\Entities\User\User
     */
    protected function user(): User
    {
        return Auth::user();
    }

    protected function respondWithToken(User $user, string $token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60,
            'data'         => [
                'id'         => $user->id,
                'cellphone'  => $user->cellphone,
                'avatar'     => $user->avatar,
                'publishDate'=> Carbon::parse('+11 months')->toDateString(),
            ],
        ]);
    }
}
