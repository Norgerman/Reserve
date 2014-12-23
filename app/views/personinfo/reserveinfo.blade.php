{{--Created by vvliebe on 2014/12/23.--}}
<div class="col-sm-3">
    <div class="col-sm-12">
        <div class="user-header">
            <span class="text-primary title"> 信用等级 </span>
        </div>
        <div class="hr"></div>
        <div class="user-body row">
            <ul style="list-style: none;margin: 0px;padding-left: 10%" class="clearfix">
                @for($index = 0 ;$index<5;$index++)
                    <li style="float: left;min-width: 18%; font-size: xx-large">
                        <span class="text-primary glyphicon @if($index<3) glyphicon-star @else glyphicon-star-empty @endif"></span>
                    </li>
                @endfor
            </ul>
        </div>
    </div>
</div>
<div class="col-sm-9">
    <div class="user-info col-sm-12">
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
                            <span style="margin-right: 20px">5天</span>
                            <a class="btn btn-xs btn-default">取消预约</a>
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
                            <td>{{$order['status']}}</td>
                        </tr>
                    </table>
                    <div class="panel-footer clearfix">
                        <div style="float: right;word-spacing: 20px;">
                            <a href="#" class="btn btn-primary">打印</a>
                            <a href="#" class="btn btn-primary">付款</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>