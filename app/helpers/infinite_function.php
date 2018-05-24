<?php
if (!function_exists('infiniteclass')) {
	/**
	 * 无限级分类处理
	 * $data 需要处理的数据源
	 * $id 起点
	 * $lve 层级记录
	 */
	function infiniteclass($data , $id = 0,$lve = 0 ) {
		static $son = array();
		foreach($data as $key => $value) {
			if($value['pid'] == $id) {
				$value['lve'] = $lve;
				$son[] = $value;
				infiniteclass($data , $value['id'],$lve+1);
			}
		}
		return $son;
	}
}

if (!function_exists('get_select_menu')) {
	/**
	*select 菜单函数
	*$default 是否添加默认option，和option值
	*$model 查询的模型
	*$field 需要的字段
	*$pid 是否需要子集1为需要，空或者其他为不需要
	*/
	function get_select_menu_k_v($default=null,$model,$field,$pid=null){
		$select_array = array();
		if(!is_null($default)){
			$select_array[] = $default;
		}
		if($pid == 1) {
			$select_data = $model::where('pid', '0')->get();
		}else{
			$select_data = $model::get();
		}
		foreach($select_data as $k => $v){
			$select_array[$v['attributes']['id']]=$v['attributes'][$field];
		}
		return $select_array;
	}
}
if (!function_exists('add_table_data')) {
	/**
	 *$model 模型
	 *$data 添加的数组
	 * $fied 查询条件字段
	 *$id 被添加者id
	 * $userid 添加者id
	 * $add_user  添加者字段名
	 * $role_id 写入数据的字段
	 * $del 是否执行删除命令
	 */
	function add_table_data($model,$data,$fied,$id,$userid,$add_user,$role_id,$del=null){
		if($del == 1) {
			$res = $model::where($fied, $id)->delete();//删除原有角色权限记录
		}
		$input[$fied] = $id;
		$input[$add_user] = $userid;
		if(count($data) >0 ) {
			foreach ($data as $item) {
				$input[$role_id] = $item;
				$result = $model::create($input);
			}
			return $result;
		}

	}
}
if (!function_exists('del_destroy')) {
	/**
	 * 删除权限验证
	 * 验证返回值的code字段即可
	 * 返回值4000：没有删除权限
	 * 返回值1000：有删除权限
	 *$fun 调用方法的函数名
	 * $user_role 当前用户拥有角色
	 */
	function del_destroy($fun,$user_role){
		$array = [];
		$model = new \App\Models\RoleAuthorityModel();
		$data = $model::whereIn('role_id',$user_role)->pluck('authority_id');
		$model = new \App\Models\AuthorityModel();
		foreach($data as $item){
			$array[] = $model::where('id',$item)->pluck('authority_route');
		}
		$routearry = [];
		for($i=0;$i<count($array);$i++){
			$routearry[] = $array[$i]['0'];
		}

		$url = $_SERVER["REQUEST_URI"];
		$url = substr($url,1);
		$url = $url .'/'.$fun;
		$route = preg_replace ("/\/\d+/","",$url);
		if(!in_array($route,$routearry)){
			$array = array('status' => 'f', 'code' => 4000, 'msg' => '没有删除权限');
		}else{
			$array = array('status' => 'f', 'code' => 1000, 'msg' => '有删除权限');
		}
		return $array;
	}
}


