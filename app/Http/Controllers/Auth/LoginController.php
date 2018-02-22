<?php

namespace App\Http\Controllers\Auth;

use App\Common\CommonParam;
use App\Common\CommonTrait\MyAuthenticatesUsers;
use App\Http\Controllers\Controller;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
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

//    use AuthenticatesUsers;
    use MyAuthenticatesUsers;
    public $commonParam;

    public function __construct()
    {
        $this->commonParam = new CommonParam();
    }

    /**
     * 主页
     * @param Request $req
     */
    public function index(Request $req){
        $systemVersion = ($this->commonParam)::$systemVersion;
        return view('welcome', compact('systemVersion'));
    }


    public function login(Request $request)
    {

        /*User::create([
            'name' => 'admin123',
            'user_name' => '超级管理员',
            'password' => bcrypt('admin123'),
            'phone' => '15087064991',
            'email' => 'admin@hotmail.com',
            'created_at' => date('Y-m-d H:i:s',time()),
            'created_by' => '超级管理员'
        ]);*/

        $this->validateLogin($request);

        // 限制密码登录错误过多
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            // 登录成功返回信息
            return $this->sendLoginResponse($request);
        }

        // 记录一次登录失败
        $this->incrementLoginAttempts($request);
        // 返回登录失败的消息
        return $this->sendFailedLoginResponse($request);
    }
}
