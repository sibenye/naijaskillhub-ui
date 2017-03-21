<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Services\Auth\ApiAuthUserProvider;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
     * |--------------------------------------------------------------------------
     * | Register Controller
     * |--------------------------------------------------------------------------
     * |
     * | This controller handles the registration of new users as well as their
     * | validation and creation. By default this controller uses a trait to
     * | provide this functionality without requiring any additional code.
     * |
     */

    use RegistersUsers;

    /**
     *
     * @var ApiAuthUserProvider
     */
    private $apiAuthUserProvider;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ApiAuthUserProvider $apiAuthUserProvider)
    {
        $this->middleware('guest');
        $this->apiAuthUserProvider = $apiAuthUserProvider;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data,
                [
                        'email' => 'required|email|max:200',
                        'password' => 'required|min:8|confirmed',
                        'firstName' => 'required|max:45',
                        'lastName' => 'required|max:45',
                        'credentialType' => 'required|max:20',
                        'accountType' => 'required|max:20'
                ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return $this->apiAuthUserProvider->registerUser($data);
    }

    /**
     * This overrides corresponding function in RegistersUsers trait.
     *
     * @param Request $request
     * @param mixed $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        if (is_null($user)) {
            $request->session()->flash('apiError', 'Unable to register User');
            return view('auth.register');
        }

        return null;
    }
}
