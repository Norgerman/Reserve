{{--Created by vvliebe on 2014/12/19.--}}
 <div class="reserve clearfix" style="background-color: #f0f0f0;padding: 20px;margin-top: 20px;">
     <h2 style="margin: 0;" class="col-sm-10"><span>北京大学第三医院</span> > <span>胸外科</span> ></h2>
     <a href="#" class="btn btn-primary col-sm-2" style="display: inline-block">预约</a>
 </div>
<div class="selecttime" style="margin-top: 20px">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">选择时间</h3>
        </div>
        <div class="panel-body row">
            <div class="col-sm-7">
                sdfjl
            </div>
            <div class="col-sm-5">
                <div class="tip">
                    预约，即“约定将来订立一定契约的契约”。通常，人们把将来要订立的契约称为本约，而以订立本约为其标的合同便是预约。按照私法自治原则，当事人享有广泛的合同自由，包括是否订立合同、与谁订立合同、订立什么样内容与形式的合同的自由等。预约，无疑是对与谁和就何种事情订立合同等作出预先安排，这似乎是对当事人合同自由进行了限制，实质上却把合同自由运用到极至。
                </div>
            </div>
        </div>
    </div>
</div>
<div class="select-doctor">
    <h4 class="media-title">选择医生 <span class="glyphicon glyphicon-map-marker" style="color: red"></span><a href="#">北京市</a></h4>
    <ul class="media-list">
        {{--@foreach($pageData['hosinfo']['list'] as $index => $hospital)--}}
        @for($index=0;$index<4;$index++)
            <li class="media">
                <div class="media-left">
                    <img src="{{asset('images/hoslist/1.jpg')}}" class="media-object" alt="123"/>
                </div>
                <div class="media-body">
                    <div class="media-heading"><h4 style="margin:0;word-spacing: 10px;"><a href="#">@{{$hospital['name']}}</a> <small>@{{$hospital['rank']}}</small></h4></div>
                    <div class="hosinfo">
                        <p>地址:&nbsp;<span>@{{$hospital['address']}}</span></p>
                        <p>电话:&nbsp;<span>@{{$hospital['tel']}}</span></p>
                        <p>简介:&nbsp;<span class="intro">@{{$hospital['description']}}</span></p>
                    </div>
                </div>
                <div class="media-right col-sm-2 zan">
                    <a href="#"><span class="glyphicon glyphicon-thumbs-up text-primary"></span></a>
                    <div class="bg-primary col-sm-6 col-sm-offset-3" style="font-size: medium;">@{{$hospital['zan']}}</div>
                </div>
            </li>
        @endfor
        {{--@endforeach--}}
    </ul>
</div>