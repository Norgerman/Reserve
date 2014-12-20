{{--Created by vvliebe on 2014/12/16.--}}
{{--{{HTML::script('json/question.js')}}--}}
 <?php
    $qlabel = array(
                       "label1",
                       "label2",
                       "label3"

                        );

    $qlabel2 = array(
                           "label1",
                           "label2",
                           "label3"

                            );



    $isAnswer=1;

    $question="100";
    $answer="000";
    $solvedtime="2014-12-20";
 ?>

 <div class="qt-div">
    <div class="qta-div">

     <div class="inp-div">
     <form role="form">
           <div class="input-title">
                 <input type="text" class="form-control" id="name" placeholder="请输入标题">
           </div>
           <div class="input-context">
               <textarea class="form-control" rows="15" placeholder="请输入你想要解决的问题"></textarea>
             </div>
          </form>
     <button type="button" class="btn btn-primary input-button">
           提交
        </button>

        <div class="alert alert-warning alert-failure" style="display:none">
           <a href="#" class="close" data-dismiss="alert">
              &times;
           </a>
           <strong style="font-size:15px">失败!</strong>发送问题失败。
        </div>

         <div class="alert alert-warning alert-success" style="display:none">
                   <a href="#" class="close" data-dismiss="alert">
                      &times;
                   </a>
                   <strong style="font-size:15px">成功!</strong>发送问题成功了。
         </div>
     </div>
   </div>


   <div class="quefor">
      <div class="panel panel-default panel-a">
         <div class="panel-heading">
            <div class="panel-title">

               <div class="qutim">
                  <label>解决时间:</label>
                  <p> {{ $solvedtime }}</p>
               </div>
            </div>
         </div>


         <div class="panel-body">
         <div class="panel-t">提问</div>
                     <div class="panel-body">
                       {{ $question }}
                     </div>
         <div class="bo"></div>
          @if ($isAnswer==1)
            <div class="panel-t">回答</div>
                     <div class="panel-body">
                        {{ $answer }}
                     </div>
          @endif
         </div>
      </div>
   </div>
 </div>


