/**
 * Created by vvliebe on 2014/12/16.
 */



$(function(){

    $("td").mouseenter(function(){
        if (!$(".datetab").hasClass("selected")) {
            $(this)
                .children("span")
                .stop()
                .fadeIn(500);
            $(this)
                .children("div")
                .css("display", "none");
        }

    })

    $("td").mouseleave(function(){
        if (!$(".datetab").hasClass("selected")) {
            $(this)
                .children("span")
                .css("display", "none");
            $(this)
                .children("div")
                .stop()
                .fadeIn(500);
        }
    })

    $("td").click(function(){
        if ($(this).hasClass("selected")) {
            $(this)
                .removeClass("selected");

            $(".datetab")
                .removeClass("selected");
        }
        else{
            $(".datetab .selected")
                .children("span")
                .css("display", "none");
            $(".datetab .selected")
                .children("div")
                .stop()
                .fadeIn(500);
            $(".datetab .selected")
                .removeClass("selected");
            $(this)
                .addClass("selected")
                .children("span")
                .stop()
                .fadeIn(500);

            $(this)
                .children("div")
                .css("display", "none");
            $(".datetab")
                .addClass("selected");
        }

    })




})