/**
 * Created by vvliebe on 2014/12/19.
 */
$(function(){
    $(".department li").click(function(){
        $(this).addClass('active').addClass('isclick').siblings().removeClass('active').removeClass('isclick');

    });
    $(".department li").mouseenter(function(){
        $(this).addClass('active').siblings().each(function(){
            if(!$(this).hasClass('isclick')){
                $(this).removeClass('active')
            }
        });
    });
    $(".department li").mouseout(function(){
        if(!$(this).hasClass('isclick'))
            $(this).removeClass('active');
    });
});