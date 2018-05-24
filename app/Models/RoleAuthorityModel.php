<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleAuthorityModel extends Model
{
    protected $table = 'role_authority';

    protected  $fillable = [
        'role_id','authority_id','add_user_id'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];
}
