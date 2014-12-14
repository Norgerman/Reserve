@extends('layout.index')
@section('css')
    @parent
    {{HTML::style('css/register.css')}}
@stop

@section('js')
    @parent
    {{HTML::script('js/register.js')}}
@stop

@section('body')
    @include('index.nav')
    @include('index.logo')
    @include('index.menu')
    <div class="col-sm-12 main-content clearfix">

    </div>

@stop