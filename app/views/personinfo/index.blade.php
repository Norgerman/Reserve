{{--Created by vvliebe on 2014/12/22.--}}
@extends('layout.index')
@section('css')
 @parent
 {{HTML::style('css/common.css')}}
 {{HTML::style('css/personinfo.css')}}
@stop

@section('js')
 @parent
 {{HTML::script('js/personinfo.js')}}
@stop

@section('body')
 @include('index.nav')
 @include('index.logo')
 @include('index.menu')
 <div class="col-sm-12 main-content">
  @include('personinfo.userinfo')
 </div>
 <div class="col-sm-12 main-content">
  @include('personinfo.reserveinfo')
 </div>
@stop