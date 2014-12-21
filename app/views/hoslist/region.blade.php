{{--Created by vvliebe on 2014/12/16.--}}
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
 ?>
<script>
    var hosinfo = eval({{$hosinfo}});
    var hosdata = avalon.define('hosinfo',function(vm){
        vm.hosinfo = hosinfo;
        vm.$watch('hosinfo',function(a) {
            console.log('watch');
        });
        vm.rendered = function(){
            console.log(123);
            $(".intro").dotdotdot({
                ellipsis: "...",
                callback: function( isTruncated, orgContent){
                    if(isTruncated){
                        $(this).after(" <a href='#' style='position: absolute;margin-left: 550px;margin-top: 20px;' class='more-info'>更多</a>");
                    }
                }
            });
        }
        vm.myclick = function(province){

            var addr = province;
            $.ajax('/hoslist/hoslist',{
                type: 'get',
                data: {"addr":addr,"pagenum":1},
                dataType: 'json',
                success: function(data){
                    vm.hosinfo=data;
                },
                error: function(){
                    alert('error');
                }
            });
        }
    });
    avalon.scan();
</script>
{{--         print_r($hosinfo);--}}
<div  ms-controller="hosinfo">
    <div class="col-sm-12 region-div">
        <div class="col-sm-2 region">选择地区</div>
        <div class="col-sm-10 region-body">
            <ul class="region-list">
               @foreach($provinces as  $index=>$province)
                 <li><a href="javascript:void(0);"  ms-click="myclick('{{$province}}')">{{$province}}</a></li>
               @endforeach
            </ul>
        </div>
     </div>

     <div class="col-sm-12 hospital-list">
        <h4 class="media-title">选择医院 <span class="glyphicon glyphicon-map-marker" style="color: red"></span><a href="#">北京市</a></h4>
        <ul class="media-list">
            {{--@foreach($hosinfo['hosinfo']['list'] as $index => $hospital)--}}
                <li class="media" ms-repeat-item="hosinfo.hosinfo.list" data-repeat-rendered="rendered">
                    <div class="media-left">
                        <img src="{{asset('images/hoslist/1.jpg')}}" class="media-object" alt="123"/>
                    </div>
                    <div class="media-body">
                        <div class="media-heading"><h4 style="margin:0;word-spacing: 10px;"><a ms-href="/detail/index?hospital_id=@{{item.h_id}}">@{{item.name}}</a> <small>@{{item.rank}}</small></h4></div>
                        <div class="hosinfo">
                            <p>地址:&nbsp;<span>@{{item.address}}</span></p>
                            <p>电话:&nbsp;<span>@{{item.tel}}</span></p>
                            <p>简介:&nbsp;<span class="intro" >@{{item.description}}</span></p>
                        </div>
                    </div>
                    <div class="media-right col-sm-2 zan">
                        <a href="#"><span class="glyphicon glyphicon-thumbs-up text-primary"></span></a>
                        <div class="bg-primary col-sm-6 col-sm-offset-3" style="font-size: medium;">@{{item.zan}}</div>
                    </div>
                </li>
            {{--@endforeach--}}
        </ul>
     </div>
     <div class="pagination-div">
         <ul class="pagination">
            <li><a href="#">首页</a></li>
             {{--{{$pagecount}}--}}
             {{--@for($index = 1; $index<=$pagecount; $index++)--}}
                <li ms-class="active" ><a href="#">{{$index}}</a></li>
             {{--@endfor--}}
            <li><a href="#">尾页</a></li>
         </ul>
     </div>

</div>