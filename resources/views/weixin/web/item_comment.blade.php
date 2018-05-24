@extends('partials.weixin.template_mintui')
@section('content')
<div class="dogo-mintui-app">
    <mt-header title="评论列表" fixed>
        <mt-button icon="back" slot="left" @click.native="handleBack"></mt-button>
        <mt-button slot="right" class="dogo-margin">
            <img src="{{asset('style/weixin/icon/sousuo_baise.png')}}" height="20" width="20" slot="icon">
        </mt-button>
        <mt-button slot="right">
            <img src="{{asset('style/weixin/icon/xiaoxi_baise.png')}}" height="15" width="15" slot="icon">
        </mt-button>
    </mt-header>


    <div class="dogo-page-box dogo-item-info">


        <div class="dogo-blank-10"></div>
        <div class="dogo-item-info-section dogo-bg-white">
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

        </div>
        <div class="dogo-blank-10"></div>

        <div class="dogo-item-info-section dogo-bg-white">
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

        </div>
        <div class="dogo-blank-10"></div>

        <div class="dogo-item-info-section dogo-bg-white">
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

        </div>
        <div class="dogo-blank-10"></div>

        <div class="dogo-item-info-section dogo-bg-white">
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

        </div>
        <div class="dogo-blank-10"></div>

        <div class="dogo-item-info-section dogo-bg-white">
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

        </div>
        <div class="dogo-blank-10"></div>







    </div>


</div>
<script>
    new Vue({
        el: '.dogo-mintui-app',
        data:{
            selected:'info_1',
        },
        created:function () {
            var height = window.innerHeight-80;
        },
        methods:{
            handleBack:function () {
                window.location.href="{{route('weixin_item_list')}}";
            },
            onSubmit:function () {
                console.log('dedede');
            }
        }

    })

</script>
@endsection
