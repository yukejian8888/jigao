<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UserGroupUpdate;
use App\Models\ManageGroupModel;
use App\Models\UserGroupModel;
use App\Models\UserModel;

class UserGroupController extends CommonController
{
    protected $fields = [
        'group_id' => 0,
        'status_auth' => 10,
    ];

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $infos = UserModel::find((int)$id);
        $data['id'] = (int)$id;
        $data['infos'] = $infos;
        //通过user_id获取user_group表中的数据
        $data['group_radio_list'] = get_manage_group_radio_list();
        $infos_user_group = UserGroupModel::where('user_id',$id)->first();
        $data['group_id'] = $infos_user_group->group_id;
        $data['status_auth'] = $infos_user_group->status_auth;

//        dump($data);
//        exit;
        return view($this->skin . '.user_group.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserGroupUpdate $request, $id)
    {
        $infos = UserGroupModel::where('user_id',$id)->firstOrFail();
        $infos->group_id = $request->get('group_id');
        $infos->status_auth = $request->get('status_auth');

        $infos->save();
        return redirect()
            ->route('user.index')
            ->with([
                'flash_message' => '编辑成功'
            ]);
    }
}
