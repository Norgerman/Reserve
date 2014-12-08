 <?php
 $arr = array("首页","按医院预约","按科室预约","在线咨询","查询个人信息")

 ?>

<div class="menu">
    <div class="clearfix">
        <ul id="menulist">
            @foreach ($arr as $menuname)
                <li class="menublock">{{$menuname}}</li>
            @endforeach
            <div class="btn-group btn-help">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                Action <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>
            </div>
        </ul>
    </div>
</div>
