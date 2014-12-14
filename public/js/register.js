/**
 * Created by vvliebe on 2014/12/14.
 */
$(function () {
    $(".btn-group>.btn").click(function(){
        $(this).addClass("active").parent().siblings().children().removeClass("active");
    });
})