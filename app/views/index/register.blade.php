@extends('layout.index')
@section('css')
    @parent
    {{HTML::style('css/common.css')}}
    {{HTML::style('css/register.css')}}
@stop

@section('js')
    @parent
    {{HTML::script('js/register.js')}}
@stop

@section('body')
    @include('index.menu')
    <div class="col-sm-12">
        <div class="form-div">
        </div>
    </div>
@stop