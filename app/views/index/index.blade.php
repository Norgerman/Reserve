@extends('layout.index')
@section('css')
    @parent
    {{HTML::style('css/index.css')}}
@stop

@section('body')
    @include('index.nav')
    @include('index.logo')
    @include('index.menu')
@stop