<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected  $fillable = [
        'name','email','password','phone','birthday','status','com_id','office_id','remarks','department','homeaddress','jurisdiction','sex'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password','remember_token',
    ];

}
