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
                if(data['status']==1){
                    if($("#login").hasClass('hide')){
                        $(".login-div").toggleClass('hide');
                        $("#login-modal").modal("hide");
                    }
                }else{
                    //TODO: 登陆框显示错误
                    alert('meiren');
                }
            },
            error: function(){
                alert('404');
                $("#login-modal").modal("hide");
            }
        });
    });
    $("#area").change(function(){
        //alert($(this).val());
        var province = $(this).val();
        if(province=="请选择地区")
        {
            $("#hospital").attr("disabled","true").children().remove();
            $("<option>请先选择地区</option>").appendTo($("#hospital"));
            $("#department").attr("disabled","true").children().remove();
            $("<option>请先选择医院</option>").appendTo($("#department"));
            $(".btn-reserve").attr("disabled","true");
            return;
        }
        $.ajax('/index/hospital',{
            type: 'get',
            data: {'addr':province},
            dataType: 'json',
            success: function(data){
                var dom;
                $("#hospital").removeAttr("disabled").children().remove();
                for(var i = 0 ; i<data.length;i++){
                    dom = "<option value='"+data[i].h_id+"'>"+data[i].name+"</option>";
                    $(dom).appendTo($("#hospital"));
                }
                $("#department").attr("disabled","true").children().remove();
                $("<option>请先选择医院</option>").appendTo($("#department"));
                if(data.length>0)
                    getdepartment(data[0].h_id);
            },
            error: function(){}
        });
    });
    $("#hospital").change(function(){
        //alert($(this).val());
        var h_id = $(this).val();
        getdepartment(h_id);
    });
    function getdepartment(h_id){
        $.ajax('/index/department',{
            type: 'get',
            data: {'hospital_id':h_id},
            dataType: 'json',
            success: function(data){
                var dom;
                $("#department").removeAttr("disabled").children().remove();
                for(var i = 0 ; i<data.length;i++){
                    dom = "<option value='"+data[i].d_id+"'>"+data[i].name+"</option>";
                    $(dom).appendTo($("#department"));
                }
                $(".btn-reserve").removeAttr("disabled");
            },
            error: function(){}
        });
    }
    $(".btn-reserve").click(function(){
        var d_id = $("#department").val();
        window.location = "/doclist/doctortime?department_id="+d_id;
    });
});