/**
 * Created by vvliebe on 2014/12/16.
 */



$(function(){



    $("td").click(function(){
            $(".artable .selected")
                .removeClass("selected");
            $(this)
                .addClass("selected");
        });







})