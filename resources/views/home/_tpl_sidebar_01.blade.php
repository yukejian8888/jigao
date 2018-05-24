<div class="dogo-article-list-04 dogo-border-top-red">
    <div class="block-hd">
        <h3>随机信息</h3>
    </div>
    <div class="block-bd">
        @php($infos_article = get_article_list_by_random())
        @foreach($infos_article as $k=>$v)
            <div class="row">
                <div class="col-md-4">
                    <div class="pic">
                        <a href="{{route('home.article_info',$v['id'])}}">
                            {{check_pic_empty($v['pic'])}}
                        </a>
                    </div>
                </div>
                <!--col-->
                <div class="col-md-8">
                    <div class="title">
                        <a href="{{route('home.article_info',$v['id'])}}">{{$v['title']}}</a>
                    </div>
                </div>
                <!--col-->
            </div>
        <!--row-->
        <div class="dogo-blank-10"></div>
        @endforeach
    </div>
</div>