{{--{{HTML::style('lib/bootstrap/css/bootstrap.min.css')}}--}}
{{--{{HTML::script('lib/jquery.js')}}--}}
{{--{{HTML::script('lib/bootstrap/js/bootstrap.min.js')}}--}}
<div class="slider-box col-sm-6 clearfix">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators clearfix" style="bottom: -10px;">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img src="{{asset("images/slider1.jpg")}}" class="img-responsive" style="width: 100%;" alt="123">
          {{--<div class="carousel-caption">--}}
            {{--hello--}}
          {{--</div>--}}
        </div>
        <div class="item">
          <img src="{{asset("images/slider2.jpg")}}" class="img-responsive" style="width: 100%;" alt="456">
          {{--<div class="carousel-caption">--}}
            {{--hello2--}}
          {{--</div>--}}
        </div>
        <div class="item">
          <img src="{{asset("images/slider3.jpg")}}" class="img-responsive" style="width: 100%;" alt="456">
          {{--<div class="carousel-caption">--}}
            {{--hello3--}}
          {{--</div>--}}
        </div>
      </div>

      <!-- Controls -->
      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
</div>