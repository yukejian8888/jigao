<?php

namespace App\Providers;
use Form;
use Illuminate\Support\ServiceProvider;

class FormMacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     * $value array
     *
     * @return void
     */
    public function boot()
    {
        Form::macro('selectWeekDay', function () {
            $days = [
                'monday'    => 'Monday',
                'tuesday'   => 'Tuesday',
                'wednesday' => 'Wednesday',
                'thursday'  => 'Thursday',
                'friday'    => 'Friday',
                'saturday'  => 'Saturday',
                'sunday'    => 'Sunday',
            ];
            return Form::select('day', $days, null, ['class' => 'form-control']);
        });
        /**
         * $name input name
         * $value array()
         * $checked
         * $option
         * not support html attr "id"
         * ex. Form::multicheckbox('fortitle',['L' => 'Large', 'S' => 'Small', 'N' => 'null'],['L','N'],['class'=>'form-control','placeholder'=>'title'])
         */
        Form::macro('multicheckbox', function($name,$value,$checked,$option_checkbox = [],$option_label = [])
        {
            $html_string = '';
            $checkbox = '';
            foreach($value as $k=>$v){
                if(in_array($k,$checked)){
                    $checkbox = Form::checkbox($name, $k,true,$option_checkbox).$v;
                }else{
                    $checkbox = Form::checkbox($name, $k,'',$option_checkbox).$v;
                }
                $html_string .= '<label>'.$checkbox.'</label>&nbsp;';
            }
            return $html_string;
        });

        /**
         * $name input name
         * $value array()
         * $checked
         * $option
         * not support html attr "id"
         * ex. Form::multiradio('sex',['L' => 'Large', 'S' => 'Small', 'N' => 'null'],'S')
         */

        Form::macro('multiradio', function($name,$value,$checked,$option_radio = [],$option_label = [])
        {
            $html_string = '';
            $radio = '';
            foreach($value as $k=>$v){
                if($k==$checked){
                    $radio = Form::radio($name, $k,true,$option_radio).$v;
                }else{
                    $radio = Form::radio($name, $k,'',$option_radio).$v;
                }
                $html_string .= '<label>'.$radio.'</label>&nbsp;';
            }
            return $html_string;
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
