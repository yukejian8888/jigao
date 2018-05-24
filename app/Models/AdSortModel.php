<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class AdSortModel extends Model
{
    //将 Laravel\Scout\Searchable trait 加到你想要做检索的模型，这个 trait 会注册一个模型观察者来保持模型同步到检索的驱动
//    use Searchable;
    protected $table = 'ad_sort';
//    protected $primaryKey = 'id';//设置表的主键，默认每张表的主键是id，重新设置属性来覆盖

    /**
     * Eloquent默认主键字段是自增的整型数据，这意味着主键将会被自动转化为int类型，如果你想要使用非自增或非数字类型主键，
     * 必须在对应模型中设置$incrementing属性为false。
     */
//    protected $incrementing = false;

    /**
     * Eloquent 期望created_at和updated_at已经存在于数据表中，如果你不想要这些 Laravel 自动管理的列，在模型类中设置$timestamps属性为false
     */
//    public $timestamps = false;
    /**
     * 自定义时间戳格式
     * 模型日期列的存储格式
     *
     * @var string
     */
//    protected $dateFormat = 'U';
    /**
     * 为模型指定不同的连接
     * The connection name for the model.
     *
     * @var string
     */
//    protected $connection = 'connection-name';
    /**
     * $fillable
     * 可以被批量赋值的属性
     * 也是白名单
     * @var array
     */
    protected $fillable = ['name','status'];






}
