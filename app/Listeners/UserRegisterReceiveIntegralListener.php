<?php

namespace App\Listeners;

use App\Events\UserRegisterEvent;
use App\Models\UserModel;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegisterReceiveIntegralListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserRegisterEvent  $event
     * @return void
     */
    public function handle(UserRegisterEvent $event)
    {
        //增加积分，先获取当前总积分，写入积分记录，最后更新总积分
    }
}
