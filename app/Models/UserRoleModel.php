<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRoleModel extends Model
{
    //
    protected $table = 'user_role';
    protected  $fillable = [
        'user_id', 'role_id','add_user_id'
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
