{{--Created by vvliebe on 2014/12/19.--}}
@extends('layout.index')
@section('css')
    @parent
    {{HTML::style('css/common.css')}}
    {{HTML::style('css/hospital.css')}}
@stop

@section('js')
    @parent
    {{HTML::script('js/hospital.js')}}
@stop

@section('body')
    @include('index.nav')
    @include('index.logo')
    @include('index.menu')
    <div class="main-content">

    </div>

@stop