$(function(){
    //$(".search-ul a").click(function(){
    //    $(".search-text").text($(this).text());
    //    var ph = "请输入"+$(this).text()+"名称";
    //    $("input[type=search]").attr('placeholder',ph);
    //});
    $(".login-btn").click(function(event){
        var username = $("input[name=username]").val();
        var password = $("input[name=password]").val();
        $.ajax("/index/login",{
            type: "post",
            data: {
                username: username,
                password: password
            },
            dataType: "json",
            success: function(data){
                if(data['status']=="succeed"){
                    if($("#login").hasClass('hide')){
                        $(".login-div").toggleClass('hide');
                    }
                }
                $("#login-modal").modal("hide");
            },
            error: function(){
                $("#login-modal").modal("hide");
                alert("error");
            }
        });
        event.preventDefault();
    });
});