{{--Created by vvliebe on 2014/12/19.--}}
<div class="panel panel-primary department-div">
    <div class="panel-heading">
        选择科室
    </div>
    <div class="panel-body department-box">
        <ul class="nav nav-tabs department" role="tablist">
            @foreach($hosdetail['depinfo'] as $index => $detail)
                <li role="presentation" class="@if($index==0) active @endif col-sm-2"><a href="{{'#tab'.$index}}" role="tab" data-toggle="tab">{{$detail['class_name']}}</a></li>
            @endforeach
        </ul>
        <div class="col-sm-12 detail-department tab-content">
            @foreach($hosdetail['depinfo'] as $i => $deplist)
                <div id="{{'tab'.$i}}" role="tabpanel" class="tab-pane @if($i==0) active @endif ">
                    <ul class="clearfix">
                        @foreach($deplist['deplist'] as $j => $department)
                            <li><a class="btn btn-primary" href="/doclist/doctortime?hospital_id={{$hosdetail['hosinfo']['h_id']}}&?department_id={{$department['d_id']}}">{{$department['name']}}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</div>