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
 @if($logininfo['login']=="true")
   <div class="col-sm-12 main-content">
    @include('personinfo.userinfo')
   </div>
   <div class="col-sm-12 main-content">
    @include('personinfo.reserveinfo')
   </div>
 @else
   <script>

     $(".login-btn").click(function () {
      var username = $("input[name=username]").val();
      var password = $("input[name=password]").val();
       $.ajax("/index/login",{
        type: "post",
        data: {
         username: username,
         password: password
        },
        dataType: "json",
        success: function(data){
         if(data['status']==1){
           window.location="/personinfo/index";
         }else{
          //TODO: 登陆框显示错误
          alert('meiren');
         }
        },
        error: function(){
         alert('404');
         $("#login-modal").modal("hide");
        }
       });
     });
     $("#login-modal").modal('show');
   </script>
 @endif
@stop