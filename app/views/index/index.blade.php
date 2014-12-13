@extends('layout.index')
@section('css')
    @parent
    {{HTML::style('lib/bootflat/css/bootflat.css')}}
    {{HTML::style('css/index.css')}}
@stop

@section('js')
    @parent
    {{HTML::script('js/index.js')}}
    {{HTML::script('lib/bootflat/js/icheck.min.js')}}
    {{HTML::script('lib/bootflat/js/jquery.fs.selecter.min.js')}}
    {{HTML::script('lib/bootflat/js/jquery.fs.stepper.min.js')}}
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