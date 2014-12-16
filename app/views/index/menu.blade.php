 <?php
 $arr = array(array("首页","/"),array("医院",""),array("科室",""),array("在线咨询",""),array("个人信息",""));

 ?>

<div class="menu col-sm-12">
    <div class="clearfix">
        <ul id="menulist" class="clearfix">
            @foreach ($arr as $menuname)
                <a href="{{$menuname[1]}}"><li class="menublock">{{$menuname[0]}}</li></a>
            @endforeach
            <li class="search-box">
                <form class="clearfix">
                    <div class="input-area">
                        <input type="text" class="search-text" placeholder="搜索">
                        <button class="search-btn">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </div>
                </form>
            </li>
        </ul>
    </div>
</div>
