@extends('partials.weixin.template_mintui')
@section('content')
<div class="dogo-mintui-app">
    <mt-header title="分类" fixed>
        <mt-button icon="back" slot="left" @click.native="handleBack"></mt-button>
        <mt-button slot="right" class="dogo-margin">
            <img src="{{asset('style/weixin/icon/sousuo_baise.png')}}" height="20" width="20" slot="icon">
        </mt-button>
        <mt-button slot="right">
            <img src="{{asset('style/weixin/icon/xiaoxi_baise.png')}}" height="15" width="15" slot="icon">
        </mt-button>
    </mt-header>



    <mt-loadmore class="dogo-page-boxtwo" :top-method="loadTop" :bottom-method="loadBottom" @bottom-status-change="
        handleBottomChange"
    :bottom-all-loaded="allLoaded" ref="loadmore" topPullText="topPullText" topDropText="topDropText" topLoadingText
    ="topLoadingText" bottomPullText="bottomPullText" bottomDropText="bottomDropText" bottomLoadingText="
        bottomLoadingText">





    <div class="dogo-panel item-list">
        <div class="dogo-panel-header ">
            <mt-cell title="男装" is-link to="//github.com">
                <img slot="icon" src="{{asset('style/weixin/icon/yuandian_hongse.png')}}" width="10" height="10">
            </mt-cell>
        </div>

        <div class="dogo-panel-content item-list-content">
            <div class="dogo-page-row ">
                <div class="col-md-6" v-for="item in listinfo" v-if="item.id">
                    <a :href="item.href">
                        <div class="box">
                            <div class="pic"><img :src="item.pic"/></div>
                            <div class="title">@{{ item.sku_title }}</div>
                            <div class="text flex-box">
                                <div class="price">
                                    ￥@{{ item.price_discount }}
                                </div>
                                <div class="eye">
                                    @{{ item.num_sale }}
                                    <img src="https://ss1.baidu.com/6ONXsjip0QIZ8tyhnq/it/u=3325821691,1136853297&fm=58" width="15" height="15"/>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div><!--row-->
        </div><!--dogo-panel-content-->
    </div>



    <div slot="top" class="mint-loadmore-top">
                <span v-show="topStatus !== 'loading'" :class="{ 'is-rotate': topStatus === 'drop' }">
                    ↓下拉刷新</span>
        <span v-show="topStatus === 'loading'">
                    <mt-spinner type="snake"></mt-spinner>
                </span>
    </div>

    <div slot="bottom" class="mint-loadmore-bottom dogo-loadmore">
        <span v-show="bottomStatus !== 'loading'" :class="{ 'is-rotate': bottomStatus === 'drop' }">↑加载更多</span>
        <span v-show="bottomStatus === 'loading'">
                    <mt-spinner type="snake"></mt-spinner>
                </span>
    </div>
    </mt-loadmore>




</div>
<script>
    new Vue({
        el: '.dogo-mintui-app',
        data: {
            allLoaded: false,//若为真，则 bottomMethod 不会被再次触发
            topStatus: '',
            bottomStatus: '',
            listinfo:[
                {id:'',href:'',sku_title:'',num_sale:'',pic:'',created_at:'',price_discount:''},
            ],
            prev_page_url:'{{route('weixin_item_list.get_more_list',['sort_id'=>$infos['id']])}}',
            next_page_url:'',
        },
        created: function () {
            var dingthis = this;
            var url = dingthis.prev_page_url;
            dingthis.getMoreList(url);
        },
        methods: {
            handleBack () {
                window.location.href = "{{route('weixin.index')}}";
            },
            handleTopChange(status) {
                this.topStatus = status;
            },
            handleBottomChange(status) {
                this.bottomStatus = status;
            },
            loadTop(){
                var dingthis = this;
                var url = dingthis.prev_page_url;
                dingthis.getMoreList(url);
                this.$refs.loadmore.onTopLoaded();
            },
            loadBottom() {
                var dingthis = this;
                var url = dingthis.next_page_url;
                dingthis.getMoreList(url);
//                    this.allLoaded = true;// 若数据已全部获取完毕
                this.$refs.loadmore.onBottomLoaded();
            },
            //加载更多
            getMoreList(url){
                var dingthis = this;
                axios.post(url, {
//                        phone:phone,
                }).then(function (response) {
                    dingthis.$toast(response.data.msg);
                    if (response.data.status == 's') {
                        var listdata = response.data.list.data;
                        console.log('listdata',listdata);
                        var obj = listdata,list_box=[];
                        if(response.data.list.prev_page_url){
                            list_box = dingthis.listinfo;
                        }
                        obj.forEach(function (value,index) {
                            var listinfo={
                                id:value.id,
                                sku_title:value.sku_title,
                                href:value.href,
                                price_discount:value.price_discount,
                                num_sale:value.num_sale,
                                pic:value.pic,
                                created_at:value.created_at
                            };
                            list_box.push(listinfo);
                            dingthis.listinfo=list_box;
                        });
                        console.log(response.data.list.next_page_url);
                        if(response.data.list.prev_page_url){
                            //下拉重新加载，不是上一页
//                                dingthis.prev_page_url = response.data.list.prev_page_url;
                        }
                        if(response.data.list.next_page_url){
                            dingthis.next_page_url = response.data.list.next_page_url;
                            dingthis.allLoaded = false;// 数据还可加载
                        }else{
                            dingthis.allLoaded = true;// 若数据已全部获取完毕
                        }
                    } else if (response.data.status == 'f') {
                        dingthis.$toast(response.data.msg);
                    }
                });
            }
            //end
        }

    })

</script>
@endsection
