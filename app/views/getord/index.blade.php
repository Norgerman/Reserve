@extends('layout.index')
@section('css')
    @parent
    {{HTML::style('css/common.css')}}
    {{HTML::style('css/getord.css')}}
@stop

@section('js')
    @parent
@stop

@section('body')
    @include('index.nav')
    @include('index.logo')
    @include('index.menu')

　　@include('getord.getord')
@stop