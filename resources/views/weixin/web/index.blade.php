@extends('partials.weixin.template_mintui')
@section('content')
<div class="dogo-mintui-app">
    <mt-header title="商城" fixed class="dogo-header">
        <mt-button icon="back"  slot="left">
            <img src="{{asset('style/weixin/icon/fenlei_baise.png')}}" class="fenlei" slot="icon">
        </mt-button>
        <mt-button slot="right" class="dogo-margin">
            <img src="{{asset('style/weixin/icon/sousuo_baise.png')}}" class="sousuo" slot="icon">
        </mt-button>
        <mt-button slot="right">
            <img src="{{asset('style/weixin/icon/xiaoxi_baise.png')}}" class="xiaoxi" slot="icon">
        </mt-button>
    </mt-header>
    <div class="dogo-page-margin">

    @include('partials.weixin.silde')

    <div class="dogo-box-section dogo-home-sort">
        <div class="flex-box-r flex-box text-center">
            <div class="flex-md-1">
                <div class="icon">
                    <img src="https://gw.alicdn.com/tps/TB1FDOHLVXXXXcZXFXXXXXXXXXX-183-129.png?imgtag=avatar">
                </div>
                <div class="title">女装</div>
            </div>
            <div class="flex-md-1">
                <div class="icon">
                    <img src="https://zos.alipayobjects.com/rmsportal/oyqubhFUEeJIqGY.jpg" >
                </div>
                <div class="title">女装</div>
            </div>
            <div class="flex-md-1">
                <div class="icon">
                    <img src="https://zos.alipayobjects.com/rmsportal/oyqubhFUEeJIqGY.jpg" >
                </div>
                <div class="title">女装</div>
            </div>
            <div class="flex-md-1">
                <div class="icon">
                    <img src="https://zos.alipayobjects.com/rmsportal/oyqubhFUEeJIqGY.jpg" >
                </div>
                <div class="title">女装</div>
            </div>
            <div class="flex-md-1">
                <div class="icon">
                    <img src="https://zos.alipayobjects.com/rmsportal/oyqubhFUEeJIqGY.jpg" >
                </div>
                <div class="title">女装</div>
            </div>
        </div>
        <div class="dogo-blank"></div>
        <div class="flex-box-r flex-box text-center">
            <div class="flex-md-1">
                <div class="icon">
                    <img src="https://zos.alipayobjects.com/rmsportal/oyqubhFUEeJIqGY.jpg" >
                </div>
                <div class="title">女装</div>
            </div>
            <div class="flex-md-1">
                <div class="icon">
                    <img src="https://zos.alipayobjects.com/rmsportal/oyqubhFUEeJIqGY.jpg" >
                </div>
                <div class="title">女装</div>
            </div>
            <div class="flex-md-1">
                <div class="icon">
                    <img src="https://zos.alipayobjects.com/rmsportal/oyqubhFUEeJIqGY.jpg" >
                </div>
                <div class="title">女装</div>
            </div>
            <div class="flex-md-1">
                <div class="icon">
                    <img src="https://zos.alipayobjects.com/rmsportal/oyqubhFUEeJIqGY.jpg" >
                </div>
                <div class="title">女装</div>
            </div>
            <div class="flex-md-1">
                <div class="icon">
                    <img src="https://zos.alipayobjects.com/rmsportal/oyqubhFUEeJIqGY.jpg" >
                </div>
                <div class="title">女装</div>
            </div>
        </div>
    </div>
    <div class="dogo-section dogo-home-redian">
        <div class="flex-box flex-box-r ">
            <div class="flex-md-2">
                <div class="icon">
                    <img src="https://zos.alipayobjects.com/rmsportal/oyqubhFUEeJIqGY.jpg" >
                </div>
            </div>
            <div class="flex-md-8">
                <div class="text">
                    <ul>
                        <li><a href="#">批发市场已经上线了</a> </li>
                        <li><a href="#">购买小助手</a> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>






    <div class="dogo-home-shop-section ">
        <div class="dogo-box-header text-center h_green">
                <span class="h_tag"></span>
                <span class="h_title">时尚青春</span>
                <span class="h_tag"></span>
        </div>
        <div class="dogo-box-body content item-list-content">
            <div class="dogo-page-row ">
            </div><!--row-->
        </div>
    </div>

    </div>

    <mt-tabbar class="dogo-tabbar" :fixed="true">
        <mt-tab-item id="shouye" class=" active-tabbar" href="{{route('weixin.index')}}">
            <img slot="icon" src="{{asset('style/weixin/icon/shouye_hover.png')}}">
            首页
        </mt-tab-item>
        <mt-tab-item id="fenlei" href="{{route('weixin_item_sort.index')}}">
            <img slot="icon" src="{{asset('style/weixin/icon/fenlei.png')}}">
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
        <mt-tab-item id="我的" href="{{route('u_weixin.index')}}">
        <img slot="icon" src="{{asset('style/weixin/icon/wode.png')}}">
        我的
        </mt-tab-item>
    </mt-tabbar>


</div>
<script>
    new Vue({
        el: '.dogo-mintui-app',
        data:{
        },
        methods:{
        }

    })

</script>
@endsection
