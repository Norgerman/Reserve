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
                'name' => "北京大学第三医院" ,
                'rank' => "三级甲等" ,
                'address' => "北京大学旁边" ,
                'description' => "最好的医院之一" ,
                'tel' => "8888-8888",
                'zan' => 1234
                ),
        array (
            'h_id' => 2 ,
            'name' => "北京大学第三医院" ,
            'rank' => "三级甲等" ,
            'address' => "北京大学旁边" ,
            'description' => "最好的医院之一" ,
            'tel' => "8888-8887" ,
            'zan' => 12345
            )
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
            @foreach($hoslist as $index => $hospital)
                <li class="media">
                    <div class="media-left">
                        <img src="{{asset('images/hoslist')}}/{{$hospital['h_id']}}.jpg" class="media-object" alt="123"/>
                    </div>
                    <div class="media-body">
                        <div class="media-heading"><h2 style="margin:0;">{{$hospital['name']}} <small>{{$hospital['rank']}}</small></h2></div>
                        <div>{{$hospital['description']}}</div>
                    </div>
                    <div class="media-right col-sm-2 zan">
                        <a href="#"><span class="glyphicon glyphicon-thumbs-up text-primary"></span></a>
                        <div class="bg-primary col-sm-6 col-sm-offset-3" style="font-size: medium;">{{$hospital['zan']}}</div>
                    </div>
                </li>
            @endforeach
        </ul>
     </div>
     <div class="pagination-div">
         <ul class="pagination">
            <li><a href="#">首页</a></li>
            <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#">尾页</a></li>
         </ul>
     </div>
     <div class="col-sm-12 hos-detail">

     </div>
