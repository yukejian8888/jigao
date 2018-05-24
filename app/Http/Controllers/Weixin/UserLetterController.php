<?php

namespace App\Http\Controllers\Weixin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserLetterController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $infos = '';
        return view( $this->_skin .'.user.user_letter.letter_list',compact('infos'));
    }
}
