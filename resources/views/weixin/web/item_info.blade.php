@extends('partials.weixin.template_mintui')
@section('content')
<div class="dogo-mintui-app">
    <mt-header title="详情" fixed>
        <mt-button icon="back" slot="left" @click.native="handleBack"></mt-button>
        <mt-button slot="right" class="dogo-margin">
            <img src="{{asset('style/weixin/icon/sousuo_baise.png')}}" height="20" width="20" slot="icon">
        </mt-button>
        <mt-button slot="right">
            <img src="{{asset('style/weixin/icon/xiaoxi_baise.png')}}" height="15" width="15" slot="icon">
        </mt-button>
    </mt-header>


    <div class="dogo-page-box dogo-item-info">
        <mt-swipe :auto="3000" style="height: 330px;">
            <mt-swipe-item>
                <a href="">
                    <img style="width:100%;height: 330px;" src="https://zos.alipayobjects.com/rmsportal/GjYqYNGGWOAdrsV.jpg"/>
                </a>
            </mt-swipe-item>
            <mt-swipe-item  >
                <a href="#">
                    <img style="width:100%;height: 330px;" src="https://zos.alipayobjects.com/rmsportal/XvpJYqsslOMcbhm.jpg"/>
                </a>
            </mt-swipe-item>
            <mt-swipe-item>
                <a href="#">
                    <img style="width:100%;height: 330px;" src="https://zos.alipayobjects.com/rmsportal/oyqubhFUEeJIqGY.jpg"/>
                </a>
            </mt-swipe-item>
        </mt-swipe>

        <div class="dogo-blank-10"></div>
        <div class="dogo-item-info-section dogo-bg-white">

            <div class="title">{{$infos['title']}}</div>
            <div class="flex-box flex-box-r subtitle">
                <div class="flex-md-2 price">￥{{$infos['price_discount']}}</div>
                <div class="flex-md-2 market-price">￥{{$infos['price_market']}}</div>
                <div class="flex-md-5 text-right soldout-text">已售{{$infos['goods_item_num_sale']}}件</div>
            </div>
        </div>
        <div class="dogo-blank-10"></div>
        <div class="dogo-item-info-section dogo-item-info-content dogo-bg-white">
            <mt-navbar v-model="selected">
                <mt-tab-item id="info_1">详情</mt-tab-item>
                <mt-tab-item id="info_3">评论</mt-tab-item>
            </mt-navbar>
            <div class="dogo-blank"></div>
            <!-- tab-container -->
            <mt-tab-container v-model="selected">
                <mt-tab-container-item id="info_1">
                    <div class="dogo-box">
                        <div class="dogo-box-body dogo-content">
                            {!! $infos['content'] !!}
                        </div>
                    </div>

                </mt-tab-container-item>
                <mt-tab-container-item id="info_3">

                    <div class="dogo-box dogo-comment">
                        <div class="dogo-box-header flex-box flex-box-r">
                            <div class="flex-md-1 avatar">
                                <img src="http://himg2.huanqiu.com/attachment2010/2017/0125/14/31/20170125023118166.png"/>
                            </div>
                            <div class="flex-md-3 name">
                                d******4
                            </div>
                            <div class="flex-md-2 text-right">
                                2017-09-08
                            </div>
                        </div>
                        <div class="dogo-box-body dogo-content dogo-padding-10 flex-box flex-box-r">
                            <div class="">货已收到，质量不错，皮质柔软舒适，下次还会光顾下次还会光顾，好评！！！</div>



                        </div>
                        <div class="dogo-box-footer dogo-padding-10">
                            <div class="">黑色;160/M</div>
                            <div class="">购买日期:2017-09-01</div>
                        </div>
                    </div>
                    <div class="dogo-blank-10"></div>

                    <div class="dogo-box dogo-comment">
                        <div class="dogo-box-header flex-box flex-box-r">
                            <div class="flex-md-1 avatar">
                                <img src="http://himg2.huanqiu.com/attachment2010/2017/0125/14/31/20170125023118166.png"/>
                            </div>
                            <div class="flex-md-3 name">
                                d******4
                            </div>
                            <div class="flex-md-2 text-right">
                                2017-09-08
                            </div>
                        </div>
                        <div class="dogo-box-body dogo-content dogo-padding-10 flex-box flex-box-r">
                            <div class="">货已收到，质量不错，皮质柔软舒适，下次还会光顾下次还会光顾，好评！！！</div>



                        </div>
                        <div class="dogo-box-footer dogo-padding-10">
                            <div class="">黑色;160/M</div>
                            <div class="">购买日期:2017-09-01</div>
                        </div>
                    </div>
                    <div class="dogo-blank-10"></div>


                    <div class="dogo-box dogo-comment">
                        <div class="dogo-box-header flex-box flex-box-r">
                            <div class="flex-md-1 avatar">
                                <img src="http://himg2.huanqiu.com/attachment2010/2017/0125/14/31/20170125023118166.png"/>
                            </div>
                            <div class="flex-md-3 name">
                                d******4
                            </div>
                            <div class="flex-md-2 text-right">
                                2017-09-08
                            </div>
                        </div>
                        <div class="dogo-box-body dogo-content dogo-padding-10 flex-box flex-box-r">
                            <div class="">货已收到，质量不错，皮质柔软舒适，下次还会光顾下次还会光顾，好评！！！</div>



                        </div>
                        <div class="dogo-box-footer dogo-padding-10">
                            <div class="">黑色;160/M</div>
                            <div class="">购买日期:2017-09-01</div>
                        </div>
                    </div>
                    <div class="dogo-blank-10"></div>


                    <div class="dogo-box dogo-comment">
                        <div class="dogo-box-header flex-box flex-box-r">
                            <div class="flex-md-1 avatar">
                                <img src="http://himg2.huanqiu.com/attachment2010/2017/0125/14/31/20170125023118166.png"/>
                            </div>
                            <div class="flex-md-3 name">
                                d******4
                            </div>
                            <div class="flex-md-2 text-right">
                                2017-09-08
                            </div>
                        </div>
                        <div class="dogo-box-body dogo-content dogo-padding-10 flex-box flex-box-r">
                            <div class="">货已收到，质量不错，皮质柔软舒适，下次还会光顾下次还会光顾，好评！！！</div>



                        </div>
                        <div class="dogo-box-footer dogo-padding-10">
                            <div class="">黑色;160/M</div>
                            <div class="">购买日期:2017-09-01</div>
                        </div>
                    </div>
                    <div class="dogo-blank-10"></div>

                    <div class="text-center">
                        <a href="{{route('weixin_item_comment',['id'=>'2'])}}">查看更多</a>
                    </div>
                    <div class="dogo-blank-10"></div>

                </mt-tab-container-item>
            </mt-tab-container>
        </div>
        <div class="dogo-blank-10"></div>
    </div>


    <div class="dogo-fix-tabbar dogo-shop-bottom-tabbar">
        <div class="flex-box flex-box-r">
            <div class="flex-md-2">
                <a href="{{route('weixin.index')}}">
                <div class="item-icon">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-shouye"></use>
                    </svg>
                    <div class="text">首页</div>
                </div>
                </a>
            </div>
            <div class="flex-md-2">
                <a href="#">
                <div class="item-icon">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-shangchuanmoban"></use>
                    </svg>
                <div class="text">客服</div>
                </div>
                </a>
            </div>
            <div class="flex-md-2">
                <a href="{{route('weixin_cart_list')}}">
                    <div class="item-icon">
                        <svg class="icon" aria-hidden="true">
                            <use xlink:href="#icon-cart"></use>
                        </svg>
                        <div class="text">购物车</div>
                    </div>
                </a>
            </div>
            <div class="flex-md-4">
                <mt-button class="add-cart-text" @click.native="popupVisible4 = true" size="large">加入购物车</mt-button>
            </div>
        </div>
    </div>
    <mt-popup v-model="popupVisible4" position="bottom" class="dogo-popup-cart-bottom">

        <div class="dogo-box dogo-select-sku">
            <div class="header">
                <div class="flex-box flex-box-r">
                    <div class="flex-md-5">
                        <h3>购买数量</h3>
                    </div>
                    {{--<div class="flex-md-1">@{{item.value}}</div>--}}
                    <div class="flex-md-1 text-right">
                    <mt-button @click.native="popupVisible4 = false" class="dogo-btn-nostyle">关闭</mt-button>
                    </div>
                </div>

            </div>
            <div class="body content add_cart_num">
                <div class="flex-box flex-box-r">
                    <div class="flex-md-2">
                    <div class="jian" @click="onjian">-</div>
                </div>
                <div class="flex-md-1">
                    <div class="number">
                    <input class="input" v-model="item.value">
                    </div>
                </div>
                <div class="flex-md-2 ">
                <div class="jia" @click="onjia">+</div>
                </div>
            <div class="flex-md-7 ">
                </div>

        </div>


            </div>
        </div>
        <div class="dogo-box dogo-select-addcart">
        <div class="dogo-submit-section">
            <button class="mint-button btn-sub mint-button--large" @click="add_cart">
            <label class="mint-button-text">确定</label>
            </button>
        </div>
        </div>
    </mt-popup>



</div>
<script>
    new Vue({
        el: '.dogo-mintui-app',
        data:{
            item:{
                value:1,
                min:1,
                max:30
            },
            goods_id:parseInt('{{$infos['id']}}'),
            selected:'info_1',
            popupVisible4: false,
        },
        created:function () {
        },
        methods:{
            handleBack:function () {
                window.location.href="{{route('weixin.goods',['sort_id'=>$infos['sort_id']])}}";
            },
            onjian:function () {
                var dingthis = this;
                var new_jian_value = dingthis.item.value-1;
                if (new_jian_value<1){
                    dingthis.onToast('购买的商品数量最少是一件');
                    return false;
                }
                dingthis.item.value = new_jian_value;
            },
            onjia:function () {
                var dingthis = this;
                var new_jia_value = dingthis.item.value+1;
                dingthis.item.value = new_jia_value;
            },
            onToast:function (str) {
                var self = this;
                self.$toast({
                    message:str,
                    position:'top',
                    duration:3000
                });
            },
            on_selected_cart:function (index) {
                console.log(index);
                this.is_active =index;
            },
            add_cart:function () {
                var dingthis = this;
                var goods_id = dingthis.goods_id;
                var goods_num = dingthis.item.value;
                var url = "{{route('weixin.add_cart')}}";
                var user_id = "{{session('user_id')}}";
                if(user_id==''){
                    dingthis.onToast('请登录后操作');
                    setTimeout(() => {
                        window.location.href = "{{route('weixin.login')}}";
                    }, 3000);
                    return false;
                }
                if(goods_num==''){
                    dingthis.onToast('请选择要购买商品的数量');
                    return false;
                }
                axios.post(url,{
                    goods_id:goods_id,
                    goods_num:goods_num
                }).then(function (response) {
//                        console.log(response);
                    if(response.data.status=='s'){
                        dingthis.onToast(response.data.msg);
                    }else if(response.data.status=='f'){
                        dingthis.onToast(response.data.msg);
                    }
                });
            }
            
        }
    })

</script>
@endsection
