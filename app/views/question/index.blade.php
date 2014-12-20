@extends('layout.index')
@section('css')
    @parent
    {{HTML::style('css/common.css')}}
    {{HTML::style('css/question.css')}}
@stop

@section('js')
    @parent
    {{HTML::script('js/question.js')}}
@stop

@section('body')
    @include('index.nav')
    @include('index.logo')
    @include('index.menu')
    <div class="main-content">
        @include('question.flow')
        @include('question.qtable')
    </div>

@stop