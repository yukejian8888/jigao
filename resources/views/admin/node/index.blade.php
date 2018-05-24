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
                    <a href="{{route('node.create')}}" class="btn btn-labeled btn-info"><span class="btn-label"><i class="fa fa-plus"></i></span>添加</a>
                </div>

                <div class="col-md-6">
                    {!! Form::open(['route' => ['node.index'],'method' => 'get','class'=>'form-inline']) !!}
                    <div class="input-group pull-right">
                        {!! Form::text('word', '',['class'=>'form-control ','placeholder'=>'名称']) !!}
                        <span class="input-group-btn">
                            {!! Form::submit('查询',['class'=>'btn btn-default  ','type'=>'submit']) !!}
                        </span>
                    </div>
                    {!! Form::close() !!}
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
                    @foreach($infos as $item)
                        <?php $class = $item['pid'] <> 0 ?'pid'.$item['pid']:"";?>
                        <?php $style = $item['pid'] <> 0 ?'display:none':"";?>
                        <tr class="dogo-remove-{{$item->id}}  {{$class}} " style="{{$style}}">
                            <td>{{$item->id}}</td>
                            <?php $px = $item['lve']==0?30:$item['lve']*30;?>
                            <td style="padding-left: {{$px}}px;"  >
                                @if( $item['lve'] <> 0)
                                    <img src='../style/admin/images/organization.png'>
                                @endif
                                {{$item->name}}
                            </td>
                            <td>{!! Html::radio(['20' => '禁用', '10' => '启用'],$item->status)!!}</td>
                            <td>
                                <div class="dogo-text-links">
                                    <a href="{{route('node.edit',['id'=>$item['id']])}}" title="编辑"><i class="fa fa-edit"> </i> 编辑</a>&nbsp;
                                    {{--<a href="{{route('node.show',['id'=>$item['id']])}}" title="查看"><i class="fa icon-eye"> </i> 查看</a>&nbsp;--}}
                                    <a href="javascript:void(0)" class="dogo-click-delete" title="删除" data-url="{{route('node.destroy',['id'=>$item['id']])}}" data-title="{{$item->name}}" data-id="{{$item->id}}"><i class="fa fa-trash-o"> </i> 删除</a>
                                    @if($item['pid'] == 0 )
                                    <a href="javascript:void(0)" class="" title="查看子节点" onclick="list_son_node('pid{{$item->id}}');" ><i class="fa fa-trash-o"> </i> 查看子节点</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            <!--/--table-responsive-->

        </div>
        <!--/--panel-body-->
    </div>
    <script>
        function list_son_node(pid){
            $("." + pid).toggle();
        }
    </script>
@endsection