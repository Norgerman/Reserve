{{--Created by vvliebe on 2014/12/19.--}}

<script>
    var doclist = eval({{$doclist}});
    var doctordata = avalon.define('doccontroller',function(vm){
        vm.pagelist = doclist.pagecount;
        vm.doclist = doclist.docinfo.list;
        vm.pagenum = doclist.docinfo.pagenum;
        vm.pagecount = doclist.pagecount[doclist.pagecount.length-1];
        vm.visit = vm.doclist[0].visit;
        vm.time = ['上午','下午','晚上'];
        vm.gopage = function(num){
            if(num == vm.pagenum)
                return;
            $.ajax('/doclist/doclist',{
                type: 'get',
                data: {"pagenum":num},
                dataType: 'json',
                success: function(data){
                    vm.doclist=data.docinfo.list;
                    vm.pagenum = data.docinfo.pagenum;
                    vm.pagecount = data.pagecount[data.pagecount.length-1];
                },
                error: function(){
                    alert('error');
                }
            });
        }
    });
    avalon.scan();
    avalon.ready(function(){
        console.log(doctordata.doclist[0].name);
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
                <li class="media" ms-repeat-item="doclist">
                    <div class="media-left">
                        <img src="{{asset('images/hoslist/1.jpg')}}" class="media-object" alt="123"/>
                    </div>
                    <div class="media-body">
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
                            <td ms-repeat-el="visit" ms-class-1="clickable:el.peonum!=20" ms-class="unclickable:el.peonum==20">@{{el.peonum}}</td>
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

</div>