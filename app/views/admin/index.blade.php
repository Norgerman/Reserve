{{--Created by vvliebe on 2014/12/23.--}}

@extends('layout.index')
@section('css')
    @parent
    {{HTML::style('css/common.css')}}
@stop

@section('js')
    @parent
@stop

@section('body')
    <div class="panel panel-default">
        <div class="panel-heading">管理员登陆</div>
        <div class="panel-body">
            Panel content
        </div>
        <div class="panel-footer">Panel footer</div>
    </div>
@stop