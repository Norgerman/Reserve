/**
 * Created by vvliebe on 2014/12/14.
 */
$(function () {
    $(".btn-group>.btn").click(function(){
        if($(this).attr('target')=="user"){
            //alert("user");
            $(".reg-form").attr('action','/usrreg/usersignin');
        }else if($(this).attr('target')=="doctor"){
            //alert("doctor");
            $(".reg-form").attr('action','/docreg/docsignin');
        }
        if(!$(this).hasClass('active'))
        {
            $(".different").toggleClass("not-current-user");
            $(this).addClass("active").parent().siblings().children().removeClass("active");
        }
    });

})