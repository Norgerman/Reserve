/**
 * Created by vvliebe on 2014/12/16.
 */



$filtab=function(dat){
    i=0;
    //var de="[{'date':'2014-12-9','tim':'上','name':'123'},{'date':'2014-12-10','tim':'上','name':'123'},{'date':'2014-12-11','tim':'上','name':'123'},{'date':'2014-12-13','tim':'上','name':'123'},{'date':'2014-12-14','tim':'上','name':'123'},{'date':'2014-12-15','tim':'上','name':'123'}]";
    //de=eval("("+de+")");
    $.each(dat,function(idx,da){
        $(".artable td[date='"+da.date+"'][tim='"+da.tim+"']")
            .html(da.name);
    });
}

$fildo=function(dat){
    $(".doc-btn-group .btn").remove();
    //var de="[{'id':1,'name':'1'},{'id':2,'name':'123'},{'id':3,'name':'123'}]";
    //de=eval("("+de+")");
    $.each(dat,function(idx,da){
        $("<label class=\"btn btn-primary\" doc_id=\""+da.id+"\"><input type=\"radio\" name=\"options\" id=\"option1\" ><div>"+da.name+"</div></label>")
            .appendTo(".doc-btn-group");
    });

}

$laclick=function(){
    $(".doc-btn-group label").click(function(){
        alert(1);
        if ($(".artable .selected")!=null){
            $(".artable .selected").html($(this).children("div").html());
            $.ajax({
                type: "post",
                url: "representation/gdo",
                data:{"doc_id":$(this).attr("doc_id"),"date":$(".artable .selected").attr("date"),"tim":$(".artable .selected").attr("tim")},
                dataType: "json",
                success: function () {
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                }
            });
        }



    })
}


$(function(){
    $(".lab-dep").click(function(){
            $(".department-div .selected")
                .removeClass("selected");
            $(this)
                .addClass("selected");
        $fildo(123);
        $.ajax({
            type: "post",
            url: "representation/gtable",
            data:{"department":$(".department-div .selected").attr("d_id")},
            dataType: "json",
            success: function (data) {
                $filtab(data);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
            }
        });

        $.ajax({
            type: "post",
            url: "representation/gdo",
            data:{"department":$(".department-div .selected").attr("d_id")},
            dataType: "json",
            success: function (data) {
                $fildo(data);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
            }
        });

        $laclick();

        });











})