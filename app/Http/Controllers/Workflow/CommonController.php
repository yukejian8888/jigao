<?php

namespace App\Http\Controllers\Workflow;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    //
    public function __construct()
    {
        $this->skin = 'workflow';
    }
}
