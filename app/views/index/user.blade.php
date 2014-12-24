<div class="col-sm-3 user">
    <div id="unlogin" class="login-div @if($logininfo["login"]=="true") hide @endif">
        <div class="user-title">
            <span class="glyphicon glyphicon-user"></span> 新用户注册
        </div>
        <div class="hr"></div>
        <div class="user-body">
            <a href="/usrreg/index" class="user-register btn btn-info btn-lg">用户注册</a>
            <a href="/docreg/index" class="doctor-register btn btn-default btn-lg">医生注册</a>
            <div class="user-login">已经有帐号了？直接<button data-toggle="modal" href="#login-modal" class="btn btn-link">登录</button></div>
        </div>
    </div>
    <div id="login" class="login-div @if($logininfo["login"]=="false") hide @endif">
        <div class="user-title">
            <span class="glyphicon glyphicon-user"></span> 您已登陆
        </div>
        <div class="hr"></div>
        <div class="user-body row">
            <div class="col-sm-12">
                <img src="{{asset('images/header/1.jpg')}}" class="col-sm-offset-1 col-sm-10 img-circle img-responsive">
            </div>
            <p style="margin-top: 120px;">
                @if($logininfo['login']=="true")
                    <a href="/personinfo/index">{{$logininfo['username']}}</a>
                @endif
            </p>
        </div>
    </div>

</div>