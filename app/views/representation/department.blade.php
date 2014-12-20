{{--Created by vvliebe on 2014/12/16.--}}
 <?php
    $departmentl = array(
                          "内科",
                          "外科",
                          "骨科",
                          "中医科",
                          "其他",

                       );
    $department = array(
                         "内科"=>array(
                                                    array("id"=>"1","name"=>'12'),
                                                    array("id"=>"2","name"=>'123'),
                                                    array("id"=>"3","name"=>'1')
                         ),
                         "外科"=>array(
                                                    array("id"=>"1","name"=>'12'),
                                                    array("id"=>"2","name"=>'123'),
                                                    array("id"=>"3","name"=>'1')
                                                  ),
                         "骨科"=>array(
                                                    array("id"=>"1","name"=>'12'),
                                                    array("id"=>"2","name"=>'123'),
                                                    array("id"=>"3","name"=>'1')

                         ),
                         "中医科"=>array(
                                                    array("id"=>"1","name"=>'12'),
                                                    array("id"=>"2","name"=>'123'),
                                                    array("id"=>"3","name"=>'1')

                         ),
                         "其他"=>array(
                                                    array("id"=>"1","name"=>'12'),
                                                    array("id"=>"2","name"=>'123'),
                                                    array("id"=>"3","name"=>'1')
                                                  )
                         );




 ?>
    <div class="col-sm-12 department-div">
        <div class="col-sm-2 department">选择科室</div>
        <div class="col-sm-10 department-body">
            <ul class="department-list">
            @foreach($departmentl as  $dep)
            <div class="panel panel-default department-panel">
                     <div class="panel-heading">
                        <div class="panel-title">
                        {{$dep}}
                        </div>
                     </div>
                     <div class="panel-body">
                        @foreach($department[$dep] as $de)
                           <label class="lab-dep" d_id="{{$de['id']}}">{{$de['name']}}</label>
                        @endforeach
                     </div>
            </div>
            @endforeach
            </ul>
        </div>
     </div>



