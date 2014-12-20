{{--Created by vvliebe on 2014/12/16.--}}
{{--{{HTML::script('json/question.js')}}--}}

@extends('...layout.index')
@section('css')
    @parent
    {{HTML::style('css/datetab.css')}}
@stop

@section('js')
    @parent
    {{HTML::script('js/datetab.js')}}
@stop

<?php
    $to=array("上","下","晚");

?>

@section('body')
    <table class="table datetab">
        <caption></caption>
        <thead>
           <tr>
              <th></th>

                <th class="light"> 12.9  </th>
                <th> 12.9  </th>
                <th class="light"> 12.9  </th>
                <th> 12.9  </th>
                <th class="light"> 12.9  </th>
                <th> 12.9  </th>
                <th class="light"> 12.9  </th>

           </tr>
        </thead>
        <tbody>
           @foreach ($to as $index=>$to)
              <tr>
                            <td>{{$to}}</td>
                            @for($i=1;$i<=7;$i++)
                               <td @if($i%2==1) class="light"@endif>
                                 <div>选择</div>
                                 <span class="glyphicon glyphicon-ok" style="display:none"></span>
                               </td>

                            @endfor

              </tr>


           @endforeach


        </tbody>
     </table>

@stop





