<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';  //定义用户表名称
    protected $primaryKey = "id";    //定义用户表主键
    public $timestamps = false;         //是否有created_at和updated_at字段

    /**
     * The attributes that are mass assignable.
     * 'name'(姓名), 'phone'(电话), 'email'(电子邮件), 'password'(密码), 'is_no'(账号状态)
     * @var array
     */
    protected $fillable = [
        'name', 'user_name', 'phone', 'email', 'password', 'is_no', 'created_at', 'created_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
