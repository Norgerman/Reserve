@extends('layout.index')
@section('css')
    @parent
    {{HTML::style('css/common.css')}}
    {{HTML::style('css/index.css')}}
@stop

@section('js')
    @parent
    {{HTML::script('js/index.js')}}
@stop

@section('body')
    @include('index.nav')
    @include('index.logo')
    @include('index.menu')
    <div class="col-sm-12 main-content clearfix">
        @include('index.quickreserve')
        @include('index.slider')
        @include('index.user')
    </div>
    <div class="col-sm-12 main-content">
        @include('index.query')
    </div>
@stop