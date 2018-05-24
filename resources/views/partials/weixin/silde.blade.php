<div class="dogo-slide dogo-element-silde">
<mt-swipe :auto="3000" style="height: 200px;">
    @php($infos_ad = get_ad_list_by_sortid(1))
    @foreach($infos_ad as $k=>$v)
    <mt-swipe-item>
        <a href="{{$v['url']}}">
            <img style="width:100%;height: 230px;" src="{{$v['pic']}}"/>
        </a>
    </mt-swipe-item>
    @endforeach
</mt-swipe>
</div>