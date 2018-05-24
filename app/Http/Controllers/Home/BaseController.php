<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    //
    public function __construct()
    {
        $skin = get_cfg_by_name('cfg_skin');
        $this->_skin = $skin;
    }
}
