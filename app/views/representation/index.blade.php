@extends('layout.index')
@section('css')
    @parent
    {{HTML::style('css/common.css')}}
    {{HTML::style('css/representation.css')}}
@stop

@section('js')
    @parent
    {{Html::script('lib/jquery.dotdotdot.min.js')}}
    {{HTML::script('js/representation.js')}}
@stop

@section('body')
    @include('index.logo')
    @include('representation.department')
    @include('representation.seltim')


@stop