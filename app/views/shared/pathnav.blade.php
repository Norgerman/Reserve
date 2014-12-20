{{--Created by vvliebe on 2014/12/19.--}}
<ol class="breadcrumb">
    @foreach($paths as $index=>$path)
        @if($index==0)
            <li><a href="{{$path[0]}}">{{$path[1]}}</a></li>
        @else
            <li class="active">{{$path[1]}}</li>
        @endif
    @endforeach
</ol>