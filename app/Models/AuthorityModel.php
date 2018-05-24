<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthorityModel extends Model
{
    //
    protected $table = 'authority';

    protected  $fillable = [
        'name','status','pid','authority_route','remarks'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

}
