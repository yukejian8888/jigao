<div class="dogo-article-list-09 ">
    <div class="dogo-blank-10"></div>

@foreach($infos as $v)
    @php($user_info = get_user_info($v['user_id']))

    <div class="block-bd dogo-padding-10 dogo-border-radius-5">
        <div class="line two">
            <div class="row">
                <div class="col-md-3">
                    <div class="pic">
                        <a href="{{route('home.article_info',['id'=>$v['id']])}}">
                            {{check_pic_empty($v['pic'])}}
                        </a>
                    </div>
                </div><!--col-md-->
                <div class="col-md-9">
                    <div class="title">
                        <a href="{{route('home.article_info',['id'=>$v['id']])}}">{{$v['title']}}</a>
                    </div>
                    <div class="dogo-blank-10"></div>
                    <div class="sub-title">
                        <!--<span class="avatar"><a href="javascript:void(0);">{!! html::image($user_info['avatar']) !!}</a> </span>-->
                        {{--<span><a href="javascript:void(0);">{{$user_info['name']}}</a> </span>--}}
                        {{--<span><a href="javascript:void(0);">{{$v['view']}}</a> </span>--}}
                        <span><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;{{$v['created_at']}}</span>
                    </div>
                </div><!--col-md-->
            </div><!--row-->
        </div><!--line-->
    </div><!--block-bd-->
@endforeach
</div><!--article-->
