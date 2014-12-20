/**
 * Created by vvliebe on 2014/12/16.
 */



$(function(){
    $(".qta-div .lab-la").click(function(){
        $(this).toggleClass("selected");
    })

    $(".qt-div .input-button").click(function(){
        a="";
        title=$(".qt-div .input-title input").val();
        context=$(".qt-div .input-context textarea").val();
        $(".qt-div .qta-div .selected").each(function(index){
            a=a+"#"+$(this).html();
        })
        $.ajax({
            url:"Controller/question/question",
            async:false,
            data:{"title":title,
                  "context":context,
                  "label":a
                  },
            success:function(){
                $(".alert-success").fadeIn();
            },
            error:function(){
                $(".alert-failure").fadeIn();
            }


        });
    })
})