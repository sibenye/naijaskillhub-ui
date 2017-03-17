<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Services\AuthService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
     * |--------------------------------------------------------------------------
     * | Login Controller
     * |--------------------------------------------------------------------------
     * |
     * | This controller handles authenticating users for the application and
     * | redirecting them to your home screen. The controller uses a trait
     * | to conveniently provide its functionality to your applications.
     * |
     */

    use AuthenticatesUsers;
    private $authService;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web');

        $this->middleware('guest', [
                'except' => 'logout'
        ]);
    }

    /*
     * public function authenticate(Request $request)
     * {
     * $this->validate($request,
     * [
     * 'email' => 'required',
     * 'password' => 'required'
     * ]);
     * $viewBag = $this->authService->authenticate($request->input('email'),
     * $request->input('password'));
     *
     * return redirect('/profile/edit');
     * }
     */
}
