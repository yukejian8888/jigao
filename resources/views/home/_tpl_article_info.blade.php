<div class="dogo-article-info-010 dogo-padding-15">
    @if($infos)
        @php($user_info = get_user_info($infos['user_id']))
    <div class="block-hd">
        <div class="title">
            <h3>{{$infos['title']}}</h3>
        </div><!--title-->
        <div class="desc">
            {{--<span><a href="javascript:void(0)"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;{{$user_info['name']}}</a></span>--}}
            {{--<span><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;{{$infos['view']}}</span>--}}
            <span><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;{{$infos['created_at']}}</span>
        </div><!--desc-->
        @if(!empty($infos['source_url']))
        <div class="desc">
            <span class="url">原文&nbsp;<a href="{{$infos['source_url']}}" target="_blank"><i class="fa fa-link" aria-hidden="true"></i>&nbsp;{{$infos['source_url']}}</a></span>
        </div><!--desc-->
            @endif
    </div><!--block-hd-->
    <div class="dogo-blank-10"></div>
    <div class="block-bd">
        <div class="content">
            {!! $infos['content'] !!}
        </div><!--content-->
    </div><!--block-bd-->
    @endif
</div>
