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
    <div class="row" style="margin-top: 10%;">
        <form method="post" action="/admin/login" class="form-horizontal col-sm-6 col-sm-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">管理员登陆</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="username" class="col-sm-2 control-label">用户名</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="username" id="username" placeholder="请输入用户名">
                        </div>
                    </div>
                    @if($result=="username")
                        <p class="text-danger col-sm-offset-2">没有此管理员用户</p>
                    @endif
                    <div class="form-group">
                        <label for="password" class="col-sm-2 control-label">密码</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" id="password" placeholder="请输入密码">
                        </div>
                    </div>
                    @if($result=="password")
                        <p class="text-danger col-sm-offset-2">密码错误</p>
                    @endif
                </div>
                <div class="panel-footer clearfix">
                    <button type="submit" class="pull-right btn btn-primary">登 陆</button>
                </div>
            </div>
        </form>
    </div>
@stop