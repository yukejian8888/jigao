<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationModel extends Model
{
    protected $table = 'organization';

    protected  $fillable = [
        'name','status','pid','remarks'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

}
