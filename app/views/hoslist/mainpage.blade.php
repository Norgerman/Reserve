{{--Created by vvliebe on 2014/12/19.--}}
<?php
$positVar = json_encode(array("positX"=>$hosdetail['hosinfo']['lat'], "positY"=>$hosdetail['hosinfo']['lng'], "positName"=>$hosdetail['hosinfo']['name'], "positDes"=>$hosdetail['hosinfo']['address'], "positTel"=>$hosdetail['hosinfo']['tel']));
?>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.5&ak=82GWUyPdpxV2PcqhbeSBzZ7a"></script>
<script src="http://d1.lashouimg.com/static/js/release/jquery-1.4.2.min.js" type="text/javascript"></script>

<div class="panel panel-primary mainpage">
    <div class="panel-heading">
        <h3 class="panel-title">医院主页</h3>
    </div>
    <div class="panel-body">
        <div class="media row">
            <div CLASS="media-left col-sm-2">
                <img src="{{asset('images/hoslist/1.jpg')}}" class="img-thumbnail">
            </div>
            <div class="media-body col-sm-5">
                <div class="media-heading"><h4 style="margin:0;word-spacing: 10px;"><a href="#">{{$hosdetail['hosinfo']['name']}}</a> <small>{{$hosdetail['hosinfo']['rank']}}</small></h4></div>
                <div class="hosinfo">
                    <p>地址:&nbsp;<span>{{$hosdetail['hosinfo']['address']}}</span></p>
                    <p>电话:&nbsp;<span>{{$hosdetail['hosinfo']['tel']}}</span></p>
                    <p>简介:&nbsp;<span class="intro">{{$hosdetail['hosinfo']['description']}}</span></p>
                </div>
            </div>
            <div class="col-sm-5" style="height: 50%;">
                <div style="width:100%; height: 100%" id="container"></div>
            </div>
            {{--<div class="media-right media-middle col-sm-1" style="text-align: center;">--}}
                {{--<a href="#" style="font-size: xx-large"><span class="col-sm-12 glyphicon glyphicon-thumbs-up text-primary"></span></a>--}}
                {{--<div class="bg-primary col-sm-12" style="font-size: medium;">{{$hosdetail['hosinfo']['zan']}}</div>--}}
            {{--</div>--}}
        </div>
    </div>
</div>


<script type="text/javascript">
    var positVar = eval({{$positVar}});

    var map = new BMap.Map("container");
    map.centerAndZoom(new BMap.Point(positVar.positX,positVar.positY), 13);
    map.enableScrollWheelZoom();
    var marker=new BMap.Marker(new BMap.Point(positVar.positX,positVar.positY));
    map.addOverlay(marker);
    var licontent="<b>"+positVar.positName+"</b><br>";
    licontent+="<span><strong>地址：</strong>"+positVar.positDes+"</span><br>";
    licontent+="<span><strong>电话：</strong>"+positVar.positTel+"</span><br>";
    licontent+="<span class=\"input\"><strong></strong><input class=\"outset\" type=\"text\" name=\"origin\" value=\"北京站\"/><input class=\"outset-but\" type=\"button\" value=\"公交\" onclick=\"gotobaidu(1)\" /><input class=\"outset-but\" type=\"button\" value=\"驾车\"  onclick=\"gotobaidu(2)\"/><a class=\"gotob\" href=\"url=\"http://api.map.baidu.com/direction?destination=latlng:"+marker.getPosition().lat+","+marker.getPosition().lng+"|name:天安门"+"®ion=北京"+"&output=html\" target=\"_blank\"></a></span>";

    var hiddeninput="<input type=\"hidden\" value=\""+'北京'+"\" name=\"region\" /><input type=\"hidden\" value=\"html\" name=\"output\" /><input type=\"hidden\" value=\"driving\" name=\"mode\" /><input type=\"hidden\" value=\"latlng:"+marker.getPosition().lat+","+marker.getPosition().lng+"|name:天安门"+"\" name=\"destination\" />";

    var content1 ="<form id=\"gotobaiduform\" action=\"http://api.map.baidu.com/direction\" target=\"_blank\" method=\"get\">" + licontent +hiddeninput+"</form>";

    var opts1 = { width: 300 };

    var  infoWindow = new BMap.InfoWindow(content1, opts1);
    marker.openInfoWindow(infoWindow);
    marker.addEventListener('click',function(){
        marker.openInfoWindow(infoWindow);
    });

    function gotobaidu(type)
    {
        if($.trim($("input[name=origin]").val())=="")
        {
            alert("请输入起点！");
            return;
        }else{
            if(type==1)
            {
                $("input[name=mode]").val("transit");
                $("#gotobaiduform")[0].submit();
            }else if(type==2)
            {
                $("input[name=mode]").val("driving");
                $("#gotobaiduform")[0].submit();
            }
        }
    }
</script>