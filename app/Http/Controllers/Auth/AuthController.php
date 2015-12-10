<?php namespace Tenderos\Http\Controllers\Auth;

use Tenderos\Http\Controllers\Controller;
use Tenderos\Entities\User;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class AuthController extends Controller {

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

    private $loginView              = 'auth.login.form';
    private $loginTerms             = 'auth.login.terms';
    private $registerView           = 'auth.register.options';
    private $registerProducerView   = 'auth.register.producer';
    private $registerShopkeeperView = 'auth.register.shopkeeper';
    private $username               = 'username';
    protected $redirectPath         = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['getLogout', 'getTerms', 'postTerms']]);
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
            'name'              => 'required|max:255',
            'email'             => 'required|email|max:255|unique:users',
            'username'          => 'required|max:255|unique:users',
            'password'          => 'required|confirmed|min:6',
            'municipality_id'   => 'required|exists:municipalities,id',
            'terms'             => 'required'
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
        return User::create($data);
    }

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return view($this->loginView);
    }

    /**
     * Show the application terms form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTerms()
    {
        return view($this->loginTerms);
    }

    /**
     * Send Post application terms.
     *
     * @return \Illuminate\Http\Response
     */
    public function postTerms()
    {
        Auth::user()->acceptTerms();
        return redirect()->to('/');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return view($this->registerView);
    }

    /**
     * Show the application Producer registration
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegisterProducer()
    {
        return view($this->registerProducerView);
    }

    /**
     * Show the application Producer registration
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegisterShopkeeper()
    {
        return view($this->registerShopkeeperView);
    }

}