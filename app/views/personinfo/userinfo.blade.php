{{--Created by vvliebe on 2014/12/23.--}}
    <div class="col-sm-3">
        <div class="col-sm-12 main-div">
            <div class="user-header">

                <span class="text-primary title"> {{$logininfo['username']}} </span>
            </div>
            <div class="hr"></div>
            <div class="user-body row">
                <img src="{{asset('images/header/1.jpg')}}" class="col-sm-offset-1 col-sm-10 img-circle img-responsive">
            </div>
        </div>
    </div>
    <div class="col-sm-9">
        <div class="user-info col-sm-12 main-div">
            <div class="user-header">
                <span class="text-primary title"> 个人信息 </span>
            </div>
            <div class="hr"></div>
            <div class="user-body">
                <div class="panel panel-primary">
                    <table class="table table-condensed" id="reserveinfo">
                        <tr>
                            <td>用户名</td>
                            <td>真实姓名</td>
                            <td>身份证号码</td>
                            <td>手机号码</td>
                        </tr>
                        <tr>
                            <td>{{$userinfo['username']}}</td>
                            <td>{{$userinfo['name']}}</td>
                            <td>{{$userinfo['idnum']}}</td>
                            {{--<td>{{$userinfo['credit']}}</td>--}}
                            <td>{{$userinfo['tel']}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
