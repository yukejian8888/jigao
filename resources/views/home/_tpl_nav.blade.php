<div class="dogo-custom-01 bg-red text-center">
    <h1><a href="{{route('home.index')}}">cms演示</a> </h1>
</div>
<div class="dogo-sortmenu-05 dogo-wp12">
    <div class="row">
        <div class="col-md-2">
            <div class="block-bd">
                <ul class="line">
                    {{--<li>--}}
                        {{--<a href="{{route('home.index')}}">--}}
                            {{--<i class="fa-icon fa fa-home" aria-hidden="true"></i>首页--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    @php($infos_article_sort = get_all_article_sort_list())
                    @foreach($infos_article_sort as $k=>$v)
                    <li>
                        <a href="{{route('home.article_list',$v['id'])}}">
                            {{--<i class="fa-icon fa fa-camera" aria-hidden="true"></i>--}}
                            {{$v['name']}}
                        </a>
                    </li>
                    @endforeach
                </ul>
                <!--line-->
                <div class="dogo-clear"></div>
            </div>
        </div><!--block-bd-->
    </div><!--row-->
</div><!--sortmenu-->