@extends('partials.weixin.template_mintui')
@section('content')
    <div class="dogo-mintui-app">
        <mt-header title="详细内容" fixed>
            <mt-button icon="back" slot="left" @click.native="handleBack"></mt-button>
        </mt-header>

    <div class="dogo-page-box dogo-news-info">

        <div class="dogo-news-info-section dogo-padding-10">
            <div class="dogo-box">
                @if($infos)
                <div class="dogo-box-header">
                    <h1>{{$infos->title}}</h1>
                    <div class="flex-box flex-box-r">
                        <div class="flex-md-4 text">
                            {{$infos->created_at}}
                        </div>
                        <div class="flex-md-4 text-right text">浏览量:{{$infos->view}}</div>
                    </div>
                </div>
                <div class="dogo-blank"></div>
                <div class="dogo-box-body content">
                    {!! $infos->content !!}
                </div>
                    @else
                    <div class="dogo-no-infos text-center">暂无数据</div>
                    @endif
            </div>
            <!--flex-box-->
        </div>




    </div>

    </div>
    <script>
        new Vue({
            el: '.dogo-mintui-app',
            data: {
            },
            methods: {
                handleBack:function () {
                    window.location.href=history.go(-1);
                }
            }

        })

    </script>
@endsection
