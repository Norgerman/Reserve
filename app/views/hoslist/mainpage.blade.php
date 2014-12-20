{{--Created by vvliebe on 2014/12/19.--}}

<div class="panel panel-primary mainpage">
    <div class="panel-heading">
        <h3 class="panel-title">医院主页</h3>
    </div>
    <div class="panel-body">
        <div class="media row">
            <div CLASS="media-left col-sm-2">
                <img src="{{asset('images/hoslist/1.jpg')}}" class="img-thumbnail">
            </div>
            <div class="media-body col-sm-9">
                <div class="media-heading"><h4 style="margin:0;word-spacing: 10px;"><a href="#">{{$hosdetail['hosinfo']['name']}}</a> <small>{{$hosdetail['hosinfo']['rank']}}</small></h4></div>
                <div class="hosinfo">
                    <p>地址:&nbsp;<span>{{$hosdetail['hosinfo']['address']}}</span></p>
                    <p>电话:&nbsp;<span>{{$hosdetail['hosinfo']['tel']}}</span></p>
                    <p>简介:&nbsp;<span class="intro">{{$hosdetail['hosinfo']['description']}}</span></p>
                </div>
            </div>
            <div class="media-right media-middle col-sm-1" style="text-align: center;">
                <a href="#" style="font-size: xx-large"><span class="col-sm-12 glyphicon glyphicon-thumbs-up text-primary"></span></a>
                <div class="bg-primary col-sm-12" style="font-size: medium;">{{$hosdetail['hosinfo']['zan']}}</div>
            </div>
        </div>
    </div>
</div>