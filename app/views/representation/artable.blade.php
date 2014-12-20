{{--Created by vvliebe on 2014/12/16.--}}
{{--{{HTML::script('json/question.js')}}--}}


@section('js')
    @parent
    {{HTML::script('js/artable.js')}}
@stop

<?php
    $to=array("上","下","晚");
    $day=array("2014-12-9","2014-12-10","2014-12-11","2014-12-12","2014-12-13","2014-12-14","2014-12-15");

?>


    <table class="table artable">
        <caption></caption>
        <thead>
           <tr>
              <th></th>
                @for($i=0;$i<=6;$i++)
                   <th @if ($i%2==0)class="light"@endif> {{$day[$i]}}  </th>
                @endfor
           </tr>
        </thead>
        <tbody>
           @foreach ($to as $index=>$to)
              <tr>
                            <th>{{$to}}</th>
                            @for($i=1;$i<=7;$i++)
                               <td @if($i%2==1) class="light"@endif date="{{$day[$i-1]}}" tim="{{$to}}">
                               </td>

                            @endfor

              </tr>
           @endforeach





        </tbody>
     </table>







