<div class="dogo-footer-02 dogo-wp100">
    <div class="block-bd dogo-wp12">
        <div class="float-left">
            @php($cfg_copyright = get_cfg_by_name('cfg_copyright'))
            @php($cfg_icpbeian = get_cfg_by_name('cfg_icpbeian'))
            <p>{!! $cfg_copyright !!} {!! $cfg_icpbeian !!} </p>
        </div>
        <div class="float-right">
            <div class="sns-info">
                {{--<ul>--}}
                    {{--<li class="sns-icon popover-options">--}}
                        {{--<a href="javascript:void(0)" title="" data-container="body" data-toggle="popover" data-content="<img class=&quot;code&quot; src=&quot;http://p1.pstatp.com/thumb/1a6b000fe922a3f71682&quot;/> " data-original-title="<h2>微信二维码</h2>">--}}
                            {{--<img src="http://p1.pstatp.com/thumb/1a6b000fe922a3f71682">--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li class="sns-icon">--}}
                        {{--<a href="javascript:void(0)">--}}
                            {{--<img src="http://p1.pstatp.com/thumb/1a6b000fe922a3f71682">--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<div class="dogo-clear"></div>--}}
                {{--</ul>--}}
            </div>
        </div>
    </div>
    <div class="dogo-clear"></div>
</div>


<script>

    $(function () { $(".popover-options a").popover({
        html : true
        ,trigger:'focus'
        ,placement:'top'
    });
    });


</script>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-22505318-1', 'auto');
    ga('send', 'pageview');

</script>
