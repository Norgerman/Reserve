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
 $pageData = array(
         'hosinfo' => array(
                 'count' => 2,
                 'list' => array(
                             0 => array(
                                     'h_id' => 1,
                                     'name' => "北医三院",
                                     'rank' => "x级x等",
                                     'address' => "北京市xxx",
                                     'description' => "隔壁",
                                     'province' => '北京市',
                                     'tel' => 6,
                                     'zan' => 0),
                             1 => array(
                                     'h_id' => 2,
                                     'name' => "xxx医院",
                                     'rank' => "x级x等",
                                     'address' => "上海市xxx",
                                     'province' => '北京市',
                                     'description' => "哈哈saflafasdfasf啊都是发到fads发士大夫手动阀手动阀撒旦发射点发胜多负少士大夫士大夫撒地方阿道夫飞洒地方啊sdkjflakdsjfl对手啦空间flak圣诞节flak圣诞节flak说到减肥了adsl付款记录是的空间方腊时的看见分厘卡似的范老师的课件flask的解放拉萨的放假了空手道解放",
                                     'tel' => 8,
                                     'zan' => 0)
                            ),
                    'pagenum' => 3
                     ),
         'pagecount' => 5
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
            @foreach($pageData['hosinfo']['list'] as $index => $hospital)
                <li class="media">
                    <div class="media-left">
                        <img src="{{asset('images/hoslist')}}/{{$hospital['h_id']}}.jpg" class="media-object" alt="123"/>
                    </div>
                    <div class="media-body">
                        <div class="media-heading"><h4 style="margin:0;word-spacing: 10px;"><a href="#">{{$hospital['name']}}</a> <small>{{$hospital['rank']}}</small></h4></div>
                        <div class="hosinfo">
                            <p>地址:&nbsp;<span>{{$hospital['address']}}</span></p>
                            <p>电话:&nbsp;<span>{{$hospital['tel']}}</span></p>
                            <p>简介:&nbsp;<span class="intro">{{$hospital['description']}}</span></p>
                        </div>
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
             @for($index = 1; $index<=$pageData['pagecount']; $index++)
                <li @if($index==$pageData['hosinfo']['pagenum']) class="active" @endif><a href="#">{{$index}}</a></li>
             @endfor
            <li><a href="#">尾页</a></li>
         </ul>
     </div>
     <div class="col-sm-12 hos-detail">

     </div>
