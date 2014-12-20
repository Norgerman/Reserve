{{--Created by vvliebe on 2014/12/19.--}}
@extends('layout.index')
@section('css')
    @parent
    {{HTML::style('css/common.css')}}
    {{HTML::style('css/doctortime.css')}}
@stop

@section('js')
    @parent
@stop

@section('body')
    @include('index.nav')
    @include('index.logo')
    @include('index.menu')
    <div class="main-content">
        @include('hoslist.flow')
        @include('hoslist.reserve')
    </div>

@stop