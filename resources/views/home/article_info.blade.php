@extends('partials.home.template')
@section('content')
    <div class="dogo-page-content dogo-wp100">
        <div class="dogo-wp12">
            <div class="dogo-blank-10"></div>
            <div class="row">
                <div class="col-md-2">
                    @include('home._tpl_nav')
                </div><!--col-md-->
                <div class="col-md-7">
                    @include('home._tpl_article_info')
                </div><!--col-md-->
                <div class="col-md-3">
                    {{--@include('home._tpl_sidebar_01')--}}
                    {{--<div class="dogo-blank-20"></div>--}}
                    @include('home._tpl_sidebar_02')
                    <div class="dogo-blank-20"></div>
                </div><!--col-md-->
            </div><!--row-->

            <div class="dogo-blank-20"></div>
        </div><!--wp12-->
    </div><!--dogo-page-content-->
@endsection
