@extends('partials.admin.template')
@section('content')
    @include('partials.common.success')
    <section class="content-header">
        <h1>
            品牌分类管理
            <small>Optional description</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li class="active">品牌分类管理</li>
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
                                <h5>品牌分类列表</h5>
                            </div>
                            <div class="col-sm-10 text-right">
                                <a href="{{route('brandsort.create')}}" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>&nbsp;添加</a>
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
            url:'{{route("sort_tree_grid",['sort_name'=>'brand_sort'])}}',
            idField:'id',
            treeField:'name',
            rownumbers: true,
            fitColumns: true,
            autoRowHeight: false,
            showFooter: true,
            animate: true,
            columns:[[
                {field: 'id', title: 'ID', width: 20, align: 'center'},
                {field: 'name', title: '名称',width: 200},
                {field: 'status_name', title: '状态',width: 30},
                {field:'action',title:'操作',width:30}
            ]]
        });
    </script>
@endsection