@extends('partials.admin.template')
@section('content')
    @include('partials.common.success')
    <section class="content-header">
        <h1>
            微信菜单管理
            <small>Optional description</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li class="active">微信菜单管理</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">

    <div class="row">
        <div class="col-xs-12">

            <div class="box box-danger">
                <div class="box-header">

                    <div class="row">
                        <div class="col-sm-2">
                            <h5>微信菜单列表</h5>
                        </div>
                        <div class="col-sm-10 text-right">
                            <a href="{{route('wechat_menu.create')}}" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>&nbsp;添加</a>
                            <a href="javascript:void(0)" class="btn btn-info btn-sm dogo-wechat-menu-create"><i class="fa fa-plus"></i>&nbsp;创建微信菜单</a>
                            <a href="javascript:void(0)" class="btn btn-info btn-sm dogo-wechat-menu-delete"><i class="fa fa-trash-o"></i>&nbsp;清空微信菜单</a>
                        </div>

                    </div>
                </div>
                <!-- /.box-header -->
                <div class="dogo-box-body">
                    <table id="dogo_treegrid" class="dogo-tree-grid"></table>
                </div>

            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    </section>
    <script>
        $('#dogo_treegrid').treegrid({
            url:'{{route("sort_tree_grid",['sort_name'=>'wechat_menu'])}}',
            idField:'id',
            treeField:'name',
            rownumbers: true,
            fitColumns: true,
            autoRowHeight: false,
            showFooter: true,
            animate: true,
            columns:[[
                {field: 'id', title: 'ID', width: 20, align: 'center'},
                {field: 'name', title: '名称',width: 100},
                {field: 'type', title: '事件类型',width: 30},
                {field: 'status_name', title: '状态',width: 30},
                {field:'action',title:'操作',width:30}
            ]]
        });

        $(function () {
            $('.dogo-wechat-menu-create').click(function () {
                var url = "{{route('wechat_menu_create')}}";
                axios.post(url,
                    {
                        headers:{
                            'X-XSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                        }
                    }).then(function (response) {
                        console.log(response);
                    if(response.data.status=='s'){
                        layer.msg(response.data.msg);
                    }else if(response.data.status=='f'){
                        layer.msg(response.data.msg);
                    }
                });
            });
            $('.dogo-wechat-menu-delete').click(function () {
                var url = "{{route('wechat_menu_delete')}}";
                axios.post(url,
                    {
                        headers:{
                            'X-XSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                        }
                    }).then(function (response) {
                    console.log(response);
                    if(response.data.status=='s'){
                        layer.msg(response.data.msg);
                    }else if(response.data.status=='f'){
                        layer.msg(response.data.msg);
                    }
                });
            });
            $('.dogo-wechat-menu-getlist').click(function () {
                var url = "{{route('wechat_menu_list')}}";
                axios.post(url,
                    {
                        headers:{
                            'X-XSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                        }
                    }).then(function (response) {
                    console.log(response);
                    if(response.data.status=='s'){
                        layer.msg(response.data.msg);
                    }else if(response.data.status=='f'){
                        layer.msg(response.data.msg);
                    }
                });
            });
        });

    </script>

@endsection