/**
 * Created by vvliebe on 2014/12/16.
 */

avalon.ready(function(){

       //TODO:监听hosinfo值变化
       // $(".intro").dotdotdot({
       //     ellipsis: "...",
       //     callback: function( isTruncated, orgContent){
       //         if(isTruncated){
       //             $(this).after(" <a href='#' style='position: absolute;margin-left: 550px;margin-top: 20px;' class='more-info'>更多</a>");
       //         }
       //     }
       // });
        $(".intro").each(function(){
            $(this).tooltip({
                delay: 500,
                placement: 'top',
                title: $(this).text(),
                trigger: 'hover'
            });
        });
        //$(".region-list li").click(function(){

        //});
});