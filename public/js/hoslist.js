/**
 * Created by vvliebe on 2014/12/16.
 */

$(function(){
    $(".intro").dotdotdot({
        ellipsis: "...",
        callback: function( isTruncated, orgContent){
            if(isTruncated){
                $(this).after(" <a href='#' style='position: absolute;margin-left: 550px;margin-top: 20px;' class='more-info'>更多</a>");
            }
        }
    });
    $(".intro").each(function(){
        $(this).tooltip({
            delay: 500,
            placement: 'top',
            title: $(this).text(),
            trigger: 'hover'
        });
    });
    $(".region-list li").click(function(){
        $(this).children('a').addClass('active').parent('li').siblings().children('a').removeClass('active');
        var addr = $(this).children('a').text();
        $.ajax('/hoslist/hoslist',{
            type: 'get',
            data: {"addr":addr,"pagenum":1},
            dataType: 'json',
            success: function(data){
                //TODO:数据
            },
            error: function(){
                alert('error');
            }
        });
    });

});