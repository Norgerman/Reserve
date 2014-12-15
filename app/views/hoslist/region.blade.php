{{--Created by vvliebe on 2014/12/16.--}}
{{--{{HTML::script('json/hoslist.js')}}--}}
 <?php
    $hosdata = array(
                    array(
                        "北京",
                        "上海"
                        ),
                    array(
                        array("北医三院","仁和医院","北医六院"),
                        array("同济医院","上海长海医院")
                        )
                    );
 ?>
 <div class="col-sm-12 region-div">
    <div class="col-sm-2 region">选择地区</div>
    <div class="col-sm-10 region-body">
        {{--<h1 class="page-header">haha</h1>--}}

        <ul class="region-list nav nav-tabs">
           @foreach($hosdata[0] as  $index=>$province)
             <li class="@if($index==0) active @endif"><a href="#tab{{$index+1}}" data-toggle="tab">{{$province}}</a></li>
           @endforeach
        </ul>
        <div class="hospital-list tab-content">
            @foreach($hosdata[1] as $index => $hoses)
                <div class="tab-pane @if($index==0) active @endif" id="tab{{$index+1}}">
                    <ul>
                        @foreach($hoses as $num => $hos)
                            <li><a href="#">{{$hos}}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

    </div>
 </div>