<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NodeModel extends Model
{
    //
    protected $table = 'node';

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
