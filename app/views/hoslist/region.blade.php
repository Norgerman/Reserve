{{--Created by vvliebe on 2014/12/16.--}}
 <?php
    $provinces = json_encode(array(
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
                        ));
 ?>
<script>
    var hosinfo = eval({{$hosinfo}});
    var provinces = eval({{$provinces}});
    var hosdata = avalon.define('hosinfo',function(vm){
        vm.procvinces = provinces;
        vm.province = provinces[0];
        vm.hosinfo = hosinfo;
        vm.pagenum = vm.hosinfo.hosinfo.pagenum;
        vm.pagecount = vm.hosinfo.pagecount[vm.hosinfo.pagecount.length-1];
        vm.myclick = function(province){

            var addr = province;
            vm.province = addr;
            $.ajax('/hoslist/hoslist',{
                type: 'get',
                data: {"addr":addr,"pagenum":1},
                dataType: 'json',
                success: function(data){
                    vm.hosinfo=data;
                    vm.pagenum = data.hosinfo.pagenum;
                    vm.pagecount = data.pagecount[data.pagecount.length-1];
                },
                error: function(){
                    alert('error');
                }
            });
        }
        vm.clickzan = function (hid,index) {
            $.ajax('/hoslist/zan',{
                type: 'post',
                data: {hospital_id: hid},
                dataType: 'json',
                success: function (data) {
                    $(".media-li:nth-child("+(index+1)+")").children('div').children('.zan-div').text(data.zan);
                },
                error: function () {
                    alert('error');
                }
            });
        }
        vm.gopage = function (num) {
            if(num==vm.pagenum)
                return;
            $.ajax('/hoslist/hoslist',{
                type: 'get',
                data: {"pagenum":num},
                dataType: 'json',
                success: function(data){
                    vm.hosinfo=data;
                    vm.pagenum = data.hosinfo.pagenum;
                    vm.pagecount = data.pagecount[data.pagecount.length-1];
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
                <li  ms-repeat-item="provinces"><a href="javascript:void(0);" ms-class="active:province==item" ms-click="myclick(item)">@{{item}}</a></li>
            </ul>
        </div>
     </div>

     <div class="col-sm-12 hospital-list">
        <h4 class="media-title">选择医院 <span class="glyphicon glyphicon-map-marker" style="color: red"></span><a href="#">@{{province}}</a></h4>
        <ul class="media-list">
            {{--@foreach($hosinfo['hosinfo']['list'] as $index => $hospital)--}}
                <li class="media media-li" ms-repeat-item="hosinfo.hosinfo.list" data-repeat-rendered="rendered">
                    <div class="media-left">
                        <img style="width:200px;height: 120px;" ms-src="{{asset('images/hoslist/')}}/@{{item.h_id}}.jpg" class="media-object" alt="123"/>
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
                        <a href="javascript:void(0);" ms-click="clickzan(item.h_id,$index)"><span class="glyphicon glyphicon-thumbs-up text-primary"></span></a>
                        <div class="zan-div bg-primary col-sm-6 col-sm-offset-3" style="font-size: medium;">@{{item.zan}}</div>
                    </div>
                </li>
            {{--@endforeach--}}
        </ul>
     </div>
     <div class="pagination-div">
         <ul class="pagination">
            <li><a href="javascript:void(0);" ms-click="gopage(1)">首页</a></li>
             {{--{{$pagecount}}--}}
             {{--@for($index = 1; $index<=$pagecount; $index++)--}}
                <li ms-class="active:pagenum==item" ms-repeat-item="hosinfo.pagecount"><a href="javascript:void(0);" ms-click="gopage(item)">@{{item}}</a></li>
             {{--@endfor--}}
            <li><a href="javascript:void(0);" ms-click="gopage(pagecount);">尾页</a></li>
         </ul>
     </div>

</div>