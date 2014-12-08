@extends('layout.index')
@section('css')
    @parent
    {{HTML::style('css/index.css')}}
@stop

@section('body')
    @include('index.menu')
@stop