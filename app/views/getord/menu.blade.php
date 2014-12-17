 <?php
 $arr = array("首页","医院","科室","医生")

 ?>

<div class="menu col-sm-12">
    <div class="clearfix">
        <ul id="menulist" class="clearfix">
            @foreach ($arr as $menuname)
                <li class="menublock">{{$menuname}}</li>
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