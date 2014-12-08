 <?php
 $arr = array("首页","按医院预约","按科室预约","在线咨询","查询个人信息")

 ?>

    <div class="menu">
    <div class="submenu clearfix">
        <ul id="menulist">
        @foreach ($arr as $menuname)
        <li class="menublock">{{$menuname}}</li>
        @endforeach
        </ul>
    </div>
    </div>
