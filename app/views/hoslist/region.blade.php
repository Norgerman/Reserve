{{--Created by vvliebe on 2014/12/16.--}}
{{--{{HTML::script('json/hoslist.js')}}--}}
 <?php
    $provinces = array(
                        "北京市",
                        "天津市",
                        "上海市",
                        "重庆市",
                        "河北省",
                        "河南省",
                        "云南省",
                        "辽宁省",
                        "黑龙江省",
                        "湖南省",
                        "安徽省",
                        "山东省",
                        "新疆",
                        "江苏省",
                        "浙江省",
                        "江西省",
                        "湖北省",
                        "广西壮族",
                        "甘肃省",
                        "山西省",
                        "内蒙古",
                        "陕西省",
                        "吉林省",
                        "福建省",
                        "贵州省",
                        "广东省",
                        "青海省",
                        "西藏",
                        "四川省",
                        "宁夏回族",
                        "海南省"
                        );

    $hoslist = array (
        array ( 'h_id' => 1 ,
                'name' => 2 ,
                'rank' => 3 ,
                'address' => 4 ,
                'description' => 5 ,
                'tel' => 6
                ),
        array (
            'h_id' => 2 ,
            'name' => 4 ,
            'rank' => 5 ,
            'address' => 6 ,
            'description' => 7 ,
            'tel' => 8 )
            );
 ?>
    <div class="col-sm-12 region-div">
        <div class="col-sm-2 region">选择地区</div>
        <div class="col-sm-10 region-body">
            <ul class="region-list">
               @foreach($provinces as  $index=>$province)
                 <li><a href="javascript:void(0);">{{$province}}</a></li>
               @endforeach
            </ul>
        </div>
     </div>

     <div class="col-sm-12 hospital-list">
        <h4 class="media-title">选择医院</h4>
        <ul class="media-list">
            <li class="media">
                <div class="pull-left">123</div>
                <div class="media-body">
                    <div class="media-right">ok</div>
                </div>
            </li>
            <li class="media">
                <div class="pull-left">123</div>
                <div class="media-body">
                    <div class="media-heading">选择医院</div>
                </div>
            </li>
        </ul>
     </div>
