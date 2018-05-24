@extends('partials.weixin.template_mintui')
@section('content')
    <div class="dogo-mintui-app">
        <mt-header title="资讯" fixed>
            <mt-button icon="back" slot="left" @click.native="handleBack"></mt-button>
        </mt-header>


        <mt-loadmore class="dogo-page-boxtwo" :top-method="loadTop" :bottom-method="loadBottom" @bottom-status-change="
        handleBottomChange"
        :bottom-all-loaded="allLoaded" ref="loadmore" topPullText="topPullText" topDropText="topDropText" topLoadingText
        ="topLoadingText" bottomPullText="bottomPullText" bottomDropText="bottomDropText" bottomLoadingText="
        bottomLoadingText">

        <div class=" dogo-news-list">

            <div class="dogo-news-list-section" v-for="item in listinfo" v-if="item.id">

                    <a :href="item.href" >
                    <div class="flex-box flex-box-r">
                        <div class="flex-md-3" v-if="item.pic">
                            <img class="img"
                                 :src="item.pic">
                        </div>
                        <div class="flex-md-9">
                            <div class="flex-box flex-box-r">
                                <div class="flex-md-12 title">@{{ item.title }}</div>
                            </div>
                            <div class="subtitle">@{{ item.description }}</div>
                            <div class="time">@{{ item.created_at }}</div>
                        </div>
                    </div>
                </a>
                <!--flex-box-->
            </div>

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
                    {id:'',href:'',title:'',description:'',pic:'',created_at:''},
                ],
                prev_page_url:'{{route('weixin_article.get_more_list')}}',
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
                            var obj = listdata,list_box=[];
                            if(response.data.list.prev_page_url){
                                list_box = dingthis.listinfo;
                            }
                            obj.forEach(function (value,index) {
                                var listinfo={
                                    id:value.id,
                                    title:value.title,
                                    href:value.href,
                                    description:value.description,
                                    pic:value.pic,
                                    created_at:value.created_at
                                };
                                list_box.push(listinfo);
                                dingthis.listinfo=list_box;
                            });
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
