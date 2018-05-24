@extends('partials.weixin.template_mintui')
@section('content')
<div class="dogo-mintui-app">
    <mt-header title="分类" fixed>
        {{--<mt-button icon="back"  slot="left">--}}
        {{--</mt-button>--}}
        <mt-button slot="right" class="dogo-margin">
            <img src="{{asset('style/weixin/icon/sousuo_baise.png')}}" height="20" width="20" slot="icon">
        </mt-button>
        <mt-button slot="right">
            <img src="{{asset('style/weixin/icon/xiaoxi_baise.png')}}" height="15" width="15" slot="icon">
        </mt-button>
    </mt-header>


    <div class="flex-box flex-box-r dogo-page-box dogo-item-sort">
        <div class="dogo-box-one item-left" :style="style">
            @php($goods_item_sort_list = get_goods_item_sort_list_by_id(0))
            <mt-navbar v-model="selected" class="dogo-navbar" >
                @foreach($goods_item_sort_list as $k=>$v)
                    <mt-tab-item id="sort_{{$v['id']}}">{{$v['name']}}</mt-tab-item>
                @endforeach
            </mt-navbar>
        </div>

        <div class="dogo-box-two item-right" :style="style">
            <!-- tab-container -->
            <mt-tab-container v-model="selected" :fixed="true">
                @foreach($goods_item_sort_list as $k=>$v)

                <mt-tab-container-item id="sort_{{$v['id']}}">
                    @php($goods_item_sort_list_subone = get_goods_item_sort_list_by_id($v['id']))
                    @foreach($goods_item_sort_list_subone as $k_subone=>$v_subone)
                    <div class="dogo-panel ">
                        <div class="dogo-panel-header panel-sort">
                            <mt-cell title="{{$v_subone['name']}}" is-link to="{{route('weixin_item_list',['id'=>$v_subone['id']])}}">
                                <img slot="icon" src="{{asset('style/weixin/icon/yuandian_hongse.png')}}" width="10" height="10">
                            </mt-cell>
                        </div>

                        <div class="dogo-panel-content sort-children">
                            <div class="dogo-page-row">

                                @php($goods_item_sort_list_subtwo = get_goods_item_sort_list_by_id($v_subone['id']))
                                @foreach($goods_item_sort_list_subtwo as $k_subtwo=>$v_subtwo)
                                <div class="col-md-4">
                                    <a href="{{route('weixin_item_list',['id'=>$v_subtwo['id']])}}">
                                    <div class="one">
                                        <div class="pic"><img src="{{$v_subtwo['pic']}}"/></div>
                                        <div class="title">{{$v_subtwo['name']}}</div>
                                    </div>
                                    </a>
                                </div>
                                @endforeach
                            </div>

                        </div>
                        <div class="dogo-panel-header"></div>
                    </div>
                    @endforeach
                </mt-tab-container-item>
                @endforeach

            </mt-tab-container>


        </div>
    </div>







    <mt-tabbar class="dogo-tabbar" :fixed="true">
        <mt-tab-item id="shouye" href="{{route('weixin.index')}}">
            <img slot="icon" src="{{asset('style/weixin/icon/shouye.png')}}">
            首页
        </mt-tab-item>
        <mt-tab-item id="fenlei" class=" active-tabbar" href="{{route('weixin_item_sort.index')}}">
            <img slot="icon" src="{{asset('style/weixin/icon/fenlei_hover.png')}}">
            分类
        </mt-tab-item>
        <mt-tab-item id="faxian" href="{{route('weixin_discovery_list')}}">
            <img slot="icon" src="{{asset('style/weixin/icon/faxian.png')}}">
            发现
        </mt-tab-item>
        <mt-tab-item id="gouwuche" href="{{route('weixin_cart_list')}}">
            <img slot="icon" src="{{asset('style/weixin/icon/gouwuche.png')}}">
            购物车
        </mt-tab-item>
        <mt-tab-item id="我的" @click="onSubmit" href="{{route('u_weixin.index')}}">
        <img slot="icon" src="{{asset('style/weixin/icon/wode.png')}}">
        我的
        </mt-tab-item>
    </mt-tabbar>


</div>
<script>
    new Vue({
        el: '.dogo-mintui-app',
        data:{
            selected:'sort_1',
            style:{
                height:'356px'
            }
        },
        created:function () {
            var height = window.innerHeight-80;
            this.style.height = height+'px';
            console.log('create',height);
        },
        methods:{
            onSubmit:function () {
                console.log('dedede');
            }
        }

    })

</script>
@endsection
