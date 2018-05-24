@extends('partials.admin.template')
@section('content')
    @include('partials.common.success')
    <h3>
        <!-- Breadcrumb right aligned-->
        <ol class="breadcrumb pull-right">
            <li><a href="{{route('admin.index')}}">首页</a></li>
            <li class="active">组织架构</li>
        </ol>
        组织架构
        <!-- Small text for title-->
        <span class="text-sm hidden-xs"></span>
    </h3>
    <!-- Main content -->

    <div class="panel panel-default">
        <!--panel-heading-->
        <div class="panel-body">
            <div class="table-responsive no-padding">

                <ul style="list-style:none;" >
                    @foreach($infos as $k => $v)
                        <?php $px = $v['lve']*50;?>
                    <li style="width:100px;height:30px;line-height: 30px;text-align: center;border:1px solid #eeeeee;margin-left: <?php echo $px;?>px;">
                        @if($v['pid'] != 0)
                        <img src='../style/admin/images/organization.png'/>
                        @endif
                        {{$v['name']}}
                    </li>
                    @endforeach
                </ul>

            </div>
            <!--/--table-responsive-->

        </div>
        <!--/--panel-body-->
        <div class="panel-footer">
            <a href="{{route('organization.index')}}" class="btn btn-default">取消&返回</a>
        </div>
    </div>
@endsection