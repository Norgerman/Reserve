@extends('layout.index')
@section('css')
    @parent
    {{HTML::style('css/common.css')}}
    {{HTML::style('css/hoslist.css')}}
@stop

@section('js')
    @parent
    {{HTML::script('js/hoslist.css')}}
@stop

@section('body')
    @include('index.nav')
    @include('index.logo')
    @include('index.menu')
    <div class="col-sm-offset-1 col-sm-10">
        @include('hoslist.flow')
        @include('hoslist.region')
    </div>

@stop