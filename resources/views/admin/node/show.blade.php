@extends('partials.admin.template')
@section('content')
    @include('partials.common.success')
    <h3>
        <!-- Breadcrumb right aligned-->
        <ol class="breadcrumb pull-right">
            <li><a href="{{route('admin.index')}}">首页</a></li>
            <li class="active">权限管理</li>
        </ol>
        权限管理
        <!-- Small text for title-->
        <span class="text-sm hidden-xs"></span>
    </h3>
    <!-- Main content -->

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6">
                    <a href="javascript:void(0);" onclick="form_add();" class="btn btn-labeled btn-info"><span class="btn-label"><i class="fa fa-plus"></i></span>{{$infos->name}}添加</a>
                </div>

                <div class="col-md-6">
                    <div class="input-group pull-right">
                        <a href="{{route('authority.index')}}" class="btn btn-default">取消&返回</a>
                    </div>
                </div>
            </div><!--row-->
        </div>
        <!--panel-heading-->
        <div class="panel-body">
            <div class="table-responsive no-padding">
                <table class="table  table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>名称</th>
                        <th>状态</th>
                        <th width="240px">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($infos['authority'] as $item)
                        <tr class="dogo-remove-{{$item->id}}">
                            <td>{{$item->id}}</td>
                            <?php $px = $item['lve']==0?30:$item['lve']*30;?>
                            <td style="padding-left: {{$px}}px;">
                                @if( $item['lve'] <> 0)
                                    <img src='../style/admin/images/organization.png'>
                                @endif
                                {{$item->name}}
                            </td>
                            <td>{!! Html::radio(['20' => '禁用', '10' => '启用'],$item->status)!!}</td>
                            <td>
                                <div class="dogo-text-links">
                                    <a href="{{route('authority.edit',['id'=>$item['id']])}}" title="编辑"><i class="fa fa-edit"> </i> 编辑</a>&nbsp;
                                    <a href="{{route('authority.show',['id'=>$item['id']])}}" title="查看"><i class="fa icon-eye"> </i> 查看</a>&nbsp;
                                    <a href="javascript:void(0)" class="dogo-click-delete" title="删除" data-url="{{route('authority.destroy',['id'=>$item['id']])}}" data-title="{{$item->name}}" data-id="{{$item->id}}"><i class="fa fa-trash-o"> </i> 删除</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            <!--/--table-responsive-->
            <div>
                <form id="authority">
                    <input type="hidden" name="pid" value="{{$infos->id}}"/>
                    权限名称：<input type="text" name="name[]"/>

                </form>
                <input type="button" value="保存"/>
            </div>
        </div>
        <!--/--panel-body-->
    </div>
    <script>
        var form_status = true;
        function form_add(){
            form_status = false;
            if(form_status == false){
                var add_input = document.createElement("input");
                     add_input.name = 'name[]';
                     add_input.type = 'text';
                var old_input = document.getElementById("authority");
                old_input.appendChild(add_input);
            }else{

            }
        }
    </script>
@endsection