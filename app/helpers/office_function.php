<?php
/**
 * Created by PhpStorm.
 * User: cooper
 * Date: 2016/12/10
 * Time: 上午6:05
 */
if (!function_exists('get_weekly_item_by_weekly_id')) {
    /**
     * 获取周报名称
     * @param $weekly_id 通过周报id
     */
    function get_weekly_item_by_weekly_id($weekly_id)
    {
        $infos = \App\Models\WeeklyItemModel::where('weekly_id',$weekly_id)->get();
        $infos = object_to_array($infos);
        return $infos;
    }
}