@extends('partials.weixin.template_mintui')
@section('content')
    <div class="dogo-mintui-app">
        <mt-header title="帮助中心" fixed class="dogo-header">
            <mt-button icon="back" slot="left" @click.native="handleBack"></mt-button>
            <mt-button slot="right">
                <img src="{{asset('style/weixin/icon/xiaoxi_baise.png')}}" class="xiaoxi" slot="icon">
            </mt-button>
        </mt-header>

    <div class="dogo-page-box dogo-user">

        <div class="dogo-user-section">
            @php($info_sort = get_page_sort_list_by_id(1))
            @if($info_sort)
            @foreach($info_sort as $k=>$v)
                <mt-cell
                        title="·{{$v['name']}}"
                        to="{{route('weixin_help',['id'=>$v['id']])}}"
                        is-link
                        value="">
                </mt-cell>
            @endforeach
            @else
                <div class="dogo-no-infos text-center">暂无数据</div>
            @endif
        </div>

    </div>

    </div>
    <script>
        new Vue({
            el: '.dogo-mintui-app',
            data: {
            },
            methods: {
                handleBack:function () {
                    window.location.href=history.go(-1);
                },
                onSubmit: function () {
                    console.log('dedede');
                }
            }

        })

    </script>
@endsection
