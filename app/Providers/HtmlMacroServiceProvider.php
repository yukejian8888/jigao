<?php

namespace App\Providers;
use Html;
use Illuminate\Support\ServiceProvider;

class HtmlMacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * 返回状态值
         * $value array()
         * $checked
         * ex. {!! Html::radio(['20' => '启用', '10' => '禁用'],$item->status)!!}
         */

        Html::macro('radio', function($value,$checked)
        {
            $radio = '';
            foreach($value as $k=>$v){
                if($k==$checked){
                    $radio = $v;
                }
            }
            return $radio;
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
