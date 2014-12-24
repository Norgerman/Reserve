{{--Created by vvliebe on 2014/12/19.--}}

<script>
    var doclist = eval({{$doclist}});
    var doctordata = avalon.define('doccontroller',function(vm){
        vm.pagelist = doclist.pagecount;
        vm.doclist = doclist.docinfo.list;
        vm.pagenum = doclist.docinfo.pagenum;
        vm.docnum = 0;
        vm.pagecount = doclist.pagecount[doclist.pagecount.length-1];
        vm.visit = vm.doclist[vm.docnum].visit;
        vm.time = ['上午','下午','晚上'];
        vm.docname = vm.doclist[vm.docnum].name;
        vm.returntime = 1;
        vm.selecttime = vm.time[0];
        vm.selectvisit = vm.visit[0];
        vm.submitreserve = function(){
            var vid = vm.selectvisit.v_id;
            var time = vm.returntime;
            $.ajax('/order/order',{
                type: 'post',
                data: {visit_id:vid,time:time},
                dataType: 'json',
                success: function(data){
//                   status o_id
                    if(data.status==1)
                        window.location = "/personinfo/index";
                    else
                        //TODO:没成功提交数据
                        alert('没成功提交数据');

                },
                error: function(){
                    alert('error');
                }
            });
        }
        vm.selectdoctor = function(num){
            vm.docnum = num;
            vm.visit = vm.doclist[vm.docnum].visit;
        }
        vm.reserve = function (i,j) {
            if(vm.visit[j].time[i]==0)
                return;
            vm.returntime = i+1;
            vm.selecttime = vm.visit[j].work_date+" "+vm.time[i];
            vm.selectvisit = vm.visit[j];
            $.ajax('/order/userinfo',{
                type: 'get',
                success: function(data){
//                    <td>姓名</td>
//                    <td>身份证号</td>
//                    <td>手机号</td>
                    $(".user-info-tr").children().remove();
                    $("<td>"+data.name+"</td>").appendTo($(".user-info-tr"));
                    $("<td>"+data.idnum+"</td>").appendTo($(".user-info-tr"));
                    $("<td>"+data.tel+"</td>").appendTo($(".user-info-tr"));
                    $("#reserve-modal").modal('show');
                },
                error: function (req) {
                    if(req.status==403){
                        alert("请先登录!");
                        $("#login-modal").modal('show');
                    }
                }
            });
        }
        vm.gopage = function(num){
            if(num == vm.pagenum)
                return;
            $.ajax('/doclist/doclist',{
                type: 'get',
                data: {"pagenum":num},
                dataType: 'json',
                success: function(data){
                    vm.docnum = 0;
                    vm.doclist = data.docinfo.list;
                    vm.pagenum = data.docinfo.pagenum;
                    vm.pagecount = data.pagecount[data.pagecount.length-1];
                    vm.visit = vm.doclist[vm.docnum].visit;
                    vm.docname = vm.doclist[vm.docnum].name;
                },
                error: function(){
                    alert('error');
                }
            });
        }
    });
    avalon.scan();

    avalon.ready(function(){

        $(".login-btn").click(function () {
            var username = $("input[name=username]").val();
            var password = $("input[name=password]").val();
            $.ajax("/index/login",{
                type: "post",
                data: {
                    username: username,
                    password: password
                },
                dataType: "json",
                success: function(data){
                    if(data['status']==1){
                        $("#login-modal").modal("hide");
                    }else{
                        //TODO: 登陆框显示错误
                        alert('登陆失败，用户名或密码错误');
                    }
                },
                error: function(){
                    alert('404');
                    $("#login-modal").modal("hide");
                }
            });
        });
    });
</script>
<div class="reserve clearfix" style="background-color: #f0f0f0;padding: 20px;margin-top: 20px;">
         <h2 style="margin: 0;" class="col-sm-10">
             <a href="/detail/index?hospital_id={{$hosinfo['h_id']}}"> {{$hosinfo['name']}}</a> &gt;
             <span>{{$depinfo['name']}}</span> &gt;
         </h2>
         <a href="#" class="btn btn-primary col-sm-2" style="display: inline-block">预约</a>
     </div>

<div ms-controller="doccontroller">

    <div style="margin-top: 20px" class="select-doctor panel panel-primary">
        <div class="panel-heading">
            <span class="media-title">选择医生</span>
        </div>
        <div class="panel-body" style="padding: 5px">
            <ul class="media-list doclist">
                <li class="media clearfix" ms-repeat-item="doclist" ms-class="active:docnum==$index">
                    <div class="media-left col-sm-2" style="padding: 0;">
                        <img src="{{asset('images/doclist/1.png')}}" class="media-object" alt="123"/>
                    </div>
                    <div class="media-body doctor-info col-sm-8" ms-click="selectdoctor($index)">
                        <div class="media-heading"><h4 style="margin:0;word-spacing: 10px;"><a href="#">@{{item.name}}</a> <small>主任医师</small></h4></div>
                        <div class="docinfo">
                            <p>电话:&nbsp;<span>@{{item.tel}}</span></p>
                            <p>简介:&nbsp;<span class="intro">@{{item.description}}</span></p>
                        </div>
                    </div>
                    <div class="media-right col-sm-2 zan">
                        <a href="#"><span class="glyphicon glyphicon-thumbs-up text-primary"></span></a>
                        <div class="bg-primary col-sm-6 col-sm-offset-3" style="font-size: medium;">@{{item.zan}}</div>
                    </div>
                </li>
            </ul>
        </div>
        <div style="text-align: center">
            <ul class="pagination" style="margin: 0">
                <li><a href="javascript:void(0);" ms-click="gopage(1)">首页</a></li>
                <li ms-class="active:pagenum==item" ms-repeat-item="pagelist"><a ms-click="gopage(item)" href="javascript:void(0);">@{{item}}</a></li>
                <li><a href="javascript:void(0);" ms-click="gopage(pagecount)">尾页</a></li>
            </ul>
        </div>
    </div>

    <div class="selecttime" style="margin-top: 20px">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">选择时间</h3>
            </div>
            <div class="panel-body row">
                <div class="col-sm-9">
                    <table class="table table-condensed">
                        <tr>
                            <th></th>
                            <th ms-repeat-item="visit">@{{item.work_date}}</th>
                        </tr>
                        <tr class="data-tr" ms-repeat-item="time">
                            <th>@{{item}}</th>
                            <td ms-repeat-el="visit" ms-click="reserve($outer.$index,$index)" ms-class-1="clickable:el.time[$outer.$index]!=0" ms-class="unclickable:el.time[$outer.$index]==0">@{{el.time[$outer.$index]}}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-sm-3">
                    <div class="tip">
                        预约，即“约定将来订立一定契约的契约”。通常，人们把将来要订立的契约称为本约，而以订立本约为其标的合同便是预约。按照私法自治原则，当事人享有广泛的合同自由，包括是否订立合同、与谁订立合同、订立什么样内容与形式的合同的自由等。预约，无疑是对与谁和就何种事情订立合同等作出预先安排，这似乎是对当事人合同自由进行了限制，实质上却把合同自由运用到极至。
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--预约模态框--}}

    <div class="modal fade" id="reserve-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">预约订单</h4>
                </div>
                <div class="modal-body">
                    <div class="panel panel-primary">
                        <div class="panel-heading">用户信息</div>
                        <table class="table table-condensed userinfo">
                            <tr>
                                <td>姓名</td>
                                <td>身份证号</td>
                                <td>手机号</td>
                            </tr>
                            <tr class="user-info-tr">

                            </tr>
                        </table>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">预约信息</div>
                        <table class="table table-condensed" id="reserveinfo">
                            <tr>
                                <td>医院</td>
                                <td>科室</td>
                                <td>医生</td>
                                <td>时间</td>
                            </tr>
                            <tr>
                                <td>{{$hosinfo['name']}}</td>
                                <td>{{$depinfo['name']}}</td>
                                <td>@{{docname}}</td>
                                <td>@{{selecttime}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" ms-click="submitreserve()" class="btn-submit-reserve btn btn-primary">提交订单</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</div>

