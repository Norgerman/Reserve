<div class="col-sm-7 qs-box">
    <div class="qs-title">
        <ul class="clearfix">
            <qsname>快速预约</qsname>
            <li>选择医院 <span class="glyphicon glyphicon-circle-arrow-right"></span></li>
            <li>选择科室 <span class="glyphicon glyphicon-circle-arrow-right"></span></li>
            <li>选择日期 <span class="glyphicon glyphicon-circle-arrow-right"></span></li>
            <li>确认预约 <span class="glyphicon glyphicon-circle-arrow-right"></span></li>
            <li>医院取号 </li>
        </ul>
    </div>
    <div class="qs-content">
        <div class="col-sm-5">
            <div class="qs-info">
                <ul>
                    <li><span class="text-primary glyphicon glyphicon-ok"></span> xxx</li>
                    <li><span class="text-primary glyphicon glyphicon-ok"></span> xxx</li>
                    <li><span class="text-primary glyphicon glyphicon-ok"></span> xxx</li>
                </ul>
            </div>
        </div>
        <?php
            $hospitals = array('1','2');
            $types = array('t1','t2');
            $areas = array('a1','a2');
        ?>
        <div class="col-sm-7">
            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <label class="col-sm-5 control-label" for="s1">按医院所属区域:</label>
                    <div class="col-sm-7">
                        <select id="s1" class="form-control">
                          @foreach($hospitals as $hospital)
                            <option>{{$hospital}}</option>
                          @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label" for="s1">按医院所属区域:</label>
                    <div class="col-sm-7">
                        <select id="s1" class="form-control">
                          @foreach($types as $type)
                            <option>{{$type}}</option>
                          @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label" for="s1">按医院所属区域:</label>
                    <div class="col-sm-7">
                        <select id="s1" class="form-control">
                          @foreach($areas as $area)
                            <option>{{$area}}</option>
                          @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-5 col-sm-5">
                        <input type="submit" value="我要预约" class="btn btn-primary col-sm-12">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>