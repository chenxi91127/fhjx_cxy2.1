<?php
namespace App\Common\CommonTrait;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

trait MyAuthenticatesUsers {
    use AuthenticatesUsers;

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
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'name';
    }

    protected function validateLogin(Request $request)
    {
        $rules = array(
            $this->username() => 'required|string|between:2,50',
            'password' => 'required|string|min:3',
        );
        $message = array();

        $attributes = array(
            'name' => '用户名',
            'password' => '用户密码',
        );
        $this->validate($request, $rules, $message, $attributes);
    }
}