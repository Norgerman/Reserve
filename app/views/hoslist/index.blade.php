@extends('layout.index')
@section('css')
    @parent
    {{HTML::style('css/common.css')}}
    {{HTML::style('css/hoslist.css')}}
@stop

@section('js')
    @parent
    {{Html::script('lib/jquery.dotdotdot.min.js')}}
    {{HTML::script('js/hoslist.js')}}
@stop

@section('body')
    @include('index.nav')
    @include('index.logo')
    @include('index.menu')
    <div class="main-content">
        @include('hoslist.flow')
        @include('hoslist.region')
    </div>

@stop