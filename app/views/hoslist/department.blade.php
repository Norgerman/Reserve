{{--Created by vvliebe on 2014/12/19.--}}
<div class="panel panel-primary department-div">
    <div class="panel-heading">
        选择科室
    </div>
    <div class="panel-body department-box">
        <div class="col-sm-2 department">
            <ul class="list-group">
                <li class="list-group-item list-group-item-success isclick active">1</li>
                <li class="list-group-item list-group-item-success">2</li>
                <li class="list-group-item list-group-item-success">3</li>
                <li class="list-group-item list-group-item-success">4</li>
                <li class="list-group-item list-group-item-success">5</li>
                <li class="list-group-item list-group-item-success">6</li>
                <li class="list-group-item list-group-item-success">7</li>
                <li class="list-group-item list-group-item-success">8</li>
            </ul>
        </div>
        <div class="col-sm-10 detail-department">
            <div class="col-sm-12">
                <ul>
                    @for($index=0;$index<18;$index++)
                        <li><a class="btn btn-primary" href="#">{{$index}}</a></li>
                    @endfor
                </ul>
            </div>
        </div>
    </div>
</div>