 <?php
 $arr = array("首页","按医院预约","按科室预约","在线咨询","查询个人信息")

 ?>

<div class="menu col-sm-12">
    <div class="clearfix">
        <ul id="menulist">
            @foreach ($arr as $menuname)
                <li class="menublock col-sm-2 col-lg-1">{{$menuname}}</li>
            @endforeach
            <div class="btn-group btn-help hidden-xs hidden-sm hidden-md">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                帮助中心 <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">注册指南</a></li>
                <li><a href="#">预约指南</a></li>
                <li><a href="#">账号管理</a></li>
                <li class="divider"></li>
                <li><a href="#">常见问题</a></li>
              </ul>
            </div>
        </ul>
    </div>
</div>
