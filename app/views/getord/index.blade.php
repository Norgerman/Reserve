@extends('layout.index')
@section('css')
    @parent
    {{HTML::style('css/common.css')}}
    {{HTML::style('css/getord.css')}}
@stop

@section('js')
    @parent
    {{HTML::script('js/getord.js')}}
@stop

@section('body')
    @include('getord.nav')
    @include('getord.logo')
    @include('getord.menu')

　　@include('getord.getord')
@stop