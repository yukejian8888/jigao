<div class="dogo-slide-06">
<div class="focusBox">
    <ul class="pic">
        @php($infos_ad = get_ad_list_by_sortid(1))
        @foreach($infos_ad as $k=>$v)
            <li><a href="{{$v['url']}}">{!! html::image($v['pic']) !!}</a></li>
        @endforeach
    </ul>
    <div class="txt-bg"></div>
    <div class="txt">
        <ul>
            @foreach($infos_ad as $k=>$v)
                <li><a href="{{$v['url']}}">{{$v['title']}}</a></li>
            @endforeach
        </ul>
    </div>

    <ul class="num">
        @foreach($infos_ad as $k=>$v)
            <li><a>{{$k+1}}</a><span></span></li>
        @endforeach
    </ul>
</div>
</div><!--slide-->
<script>
    $(function () {
        jQuery(".focusBox").slide({ titCell:".num li", mainCell:".pic",effect:"leftLoop", autoPlay:true,trigger:"click",
            //下面startFun代码用于控制文字上下切换
            startFun:function(i){
                jQuery(".focusBox .txt li").eq(i).animate({"bottom":0}).siblings().animate({"bottom":-36});
            }
        });
    });
</script>