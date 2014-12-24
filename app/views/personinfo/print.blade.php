{{--Created by vvliebe on 2014/12/23.--}}
 <html>
    <head>
        {{HTML::style('lib/bootstrap/css/bootstrap.css')}}
        <style>
            .content{
                margin:10% 30%;
            }
            @media print{
                .content{
                    margin:10% 10%;
                }
            }
        </style>
    </head>
    <body>
        <div class="panel panel-primary content">
            <div class="panel-heading">
                打印单
            </div>

            <table style="text-indent: 15px;" class="table table-bordered table-conse table-condensed">
                <tr>
                    <td>姓名</td>
                    <td>{{$userinfo['name']}}</td>
                    <td>联系方式</td>
                    <td>{{$userinfo['tel']}}</td>
                </tr>
                <tr>
                    <td>身份证</td>
                    <td colspan="3">{{$userinfo['idnum']}}</td>
                </tr>
                <tr>
                    <td>医院</td>
                    <td colspan="3">{{$orderinfo['hospitalname']}}</td>
                </tr>
                <tr>
                    <td>科室</td>
                    <td colspan="3">{{$orderinfo['departmentname']}}</td>
                </tr>
                <tr>
                    <td>医生</td>
                    <td colspan="3">{{$orderinfo['doctorname']}}</td>
                </tr>
                <tr>
                    <td>时间</td>
                    <td colspan="3">
                        @if($orderinfo['time']==1)
                            上午
                        @elseif($orderinfo['time']==2)
                            下午
                        @else
                            晚上
                        @endif
                    </td>
                </tr>
            </table>
            <div class="panel-footer" style="text-align: right;word-spacing: 50px;">
                挂号费：___________
                挂号日期：__________
            </div>
        </div>
    </body>
 </html>