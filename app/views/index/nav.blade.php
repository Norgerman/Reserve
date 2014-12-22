
<div class="nav-bar col-sm-12">
    <span>您好，欢迎来到挂号网！</span>
    @if($logininfo["login"]=="false")
        <a class="btn btn-link btn-login" data-toggle="modal" href="#login-modal">登陆</a>
        <divider></divider>
        <a class="btn btn-link btn-register" href="/usrreg/index">注册</a>
    @endif
</div>

<div id="login-modal" class="modal fade">
    <div class="modal-dialog" >
        <div class="modal-content" >
            <div class="modal-header">
                <span style="font-size: large; font-weight: bolder">登陆</span>
            </div>
            <div class="modal-body" style="padding-bottom: 10px">
                <form class="form-horizontal" method="post" role="form">
                  <div class="form-group">
                    <label for="username" class="col-sm-2 control-label">用户名</label>
                    <div class="col-sm-8 input-group">
                      <input type="text" class="form-control" name="username" id="username" placeholder="用户名">
                      <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">密码</label>
                    <div class="col-sm-8 input-group">
                      <input type="password" name="password" class="form-control" id="password" placeholder="密码">
                      <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-8" style="padding: 0;">
                      <button type="button" class="login-btn btn btn-default" style="word-spacing: 10px;">登陆 <span class="glyphicon glyphicon-hand-right"></span></button>
                    </div>
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>

