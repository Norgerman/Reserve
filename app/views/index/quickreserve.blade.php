<?php
    $provinces = array(
            "请选择地区",
            "北京市",
            "天津市",
            "上海市",
            "重庆市",
            "河北省",
            "河南省",
            "云南省",
            "辽宁省",
            "黑龙江省",
            "湖南省",
            "安徽省",
            "山东省",
            "新疆",
            "江苏省",
            "浙江省",
            "江西省",
            "湖北省",
            "广西壮族",
            "甘肃省",
            "山西省",
            "内蒙古",
            "陕西省",
            "吉林省",
            "福建省",
            "贵州省",
            "广东省",
            "青海省",
            "西藏",
            "四川省",
            "宁夏回族",
            "海南省"
            );
?>
<div class="col-sm-3 qs">
    <div class="qs-title">
        <span>快速预约</span>
    </div>
    <div class="hr"></div>
    <div class="qs-div">
        <form class="form-horizontal qs-form">
            <div class="form-group">
                <label class="col-sm-3 control-label" for="area">地区</label>
                <div class="col-sm-9">
                    <select id="area" class="form-control">
                        @foreach($provinces as $index => $province)
                            <option class="area">{{$province}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="hospital">医院</label>
                <div class="col-sm-9">
                    <select id="hospital" class="form-control" disabled>
                        <option value="-1">请先选择地区</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="department">科室</label>
                <div class="col-sm-9">
                    <select id="department" disabled class="form-control">
                        <option value="-1">请先选择医院</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-9 col-sm-offset-3">
                    <input type="button" value="我要预约" disabled class="btn-reserve btn btn-default col-sm-12">
                </div>
            </div>
        </form>
    </div>
</div>