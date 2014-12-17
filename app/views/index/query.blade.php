<div class="col-sm-9 query-box">
    <div class="hotlist-div clearfix">
        @for($i = 0 ; $i < 4 ; $i++)
            <div class="col-sm-3">
                <div class="thumbnail" style="margin-bottom: 0;">
                    <img src="{{asset('images/hoslist/1.jpg')}}" >
                    <div class="caption" style="overflow: hidden;word-wrap: break-word;text-align: center;">
                        <a href="#">北京大学第三医院</a>
                        <p>好评率:<span>93%</span></p>
                        <p>距离:<span>100m</span></p>
                    </div>
                </div>
            </div>
        @endfor
    </div>
    <div class="doclist-div clearfix">
        @for($i = 0 ; $i < 4 ; $i++)
            <div class="col-sm-3">
                <div class="thumbnail" style="margin-bottom: 0;">
                    <img src="{{asset('images/hoslist/1.jpg')}}" >
                    <div class="caption" style="overflow: hidden;word-wrap: break-word;text-align: center;">
                        <a href="#">钟南山</a>
                        <p>主治医师</p>
                        <p>擅长领域:<span>肺炎</span></p>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>
<div class="note col-sm-3">
    <div style="text-indent: 10px">公告</div>
    <div class="hr"></div>
    <ul style="list-style: none;">
        <li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li><a href="#">46</a></li>
        <li><a href="#">466</a></li>
        <li><a href="#">4666</a></li>
    </ul>
</div>


