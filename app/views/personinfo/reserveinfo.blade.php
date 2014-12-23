{{--Created by vvliebe on 2014/12/23.--}}
<div class="col-sm-3">
    <div class="col-sm-12 main-div">
        <div class="user-header">
            <span class="text-primary title"> 信用等级 </span>
        </div>
        <div class="hr"></div>
        <div class="user-body row">
            <ul style="list-style: none;margin: 0px;padding-left: 10%" class="clearfix">
                @for($index = 0 ;$index<5;$index++)
                    <li style="float: left;min-width: 18%; font-size: xx-large">
                        <span class="text-primary glyphicon @if($index<$userinfo['credit']) glyphicon-star @else glyphicon-star-empty @endif"></span>
                    </li>
                @endfor
            </ul>
        </div>
    </div>
</div>

<div class="col-sm-9">
    <div class="user-info col-sm-12 main-div">
        <div class="user-header">
            <span class="text-primary title"> 预约列表 </span>
        </div>
        <div class="hr"></div>
        <div class="user-body">
            @foreach($orders as $order)
                <div class="panel panel-primary">
                    <div class="panel-heading clearfix">
                        <span>预约单</span>
                        <span style="float: right;">
                            <span class="glyphicon glyphicon-time"></span>
                            <span style="margin-right: 20px">{{$order['date']}}</span>
                            <a oid="{{$order['o_id']}}" class="btn-reserve-cancel btn btn-xs btn-default">取消预约</a>
                        </span>
                    </div>
                    <table class="table table-condensed" id="reserveinfo">
                        <tr>
                            <td>医院</td>
                            <td>科室</td>
                            <td>医生</td>
                            <td>时间</td>
                            <td>状态</td>
                        </tr>
                        <tr>
                            <td>{{$order['hospitalname']}}</td>
                            <td>{{$order['departmentname']}}</td>
                            <td>{{$order['doctorname']}}</td>
                            <td>
                                @if($order['time']==1)
                                    上午
                                @elseif($order['time']==2)
                                    下午
                                @else
                                    晚上
                                @endif
                            </td>
                            <td>
                                {{--1:人没去，2: 未付款 3. 已付款 4.已取消 5。已完成--}}
                                @if($order['status']==1)
                                    已过期
                                @elseif($order['status']==2)
                                    未付款
                                @elseif($order['status']==3)
                                    已付款
                                @elseif($order['status']==4)
                                    已取消
                                @elseif($order['status']==5)
                                    已完成
                                @endif
                            </td>
                        </tr>
                    </table>
                    <div class="panel-footer clearfix">
                        <div style="float: right;word-spacing: 20px;">
                            <a class="btn btn-primary">打印</a>
                            <a class="btn-pay btn btn-primary" money="@{{$order['pay']}}" oid="{{$order['o_id']}}" @if($order['status']!=2) disabled @endif>付款</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>


<div class="modal fade" id="pay-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">付款</h4>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" placeholder="淘宝用户名">
                <input type="password" class="form-control" placeholder="密码">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary">付款</button>
            </div>
        </div>
    </div>
</div>