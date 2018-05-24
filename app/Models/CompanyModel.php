<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyModel extends Model
{
    protected $table = 'company';

    protected  $fillable = [
        'com_name','com_address','com_telphone','contact','contact_telphone','com_status','own',
        'shorthand','remarks'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

}
