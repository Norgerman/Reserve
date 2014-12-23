/**
 * Created by vvliebe on 2014/12/23.
 */
$(function () {
    $(".btn-reserve-cancel").click(function () {
        if(!window.confirm('亲，有病就该及时医治啊，您确定要取消订单吗？'))
            return;
        var oid = $(this).attr('oid');
        $.ajax('/order/reject',{
            type: 'post',
            data: {order_id: oid},
            dataType: 'json',
            success: function(data){
                if(data.status == 1){
                    alert('您成功取消了订单!');
                    window.location="/personinfo/index";
                }
            },
            error: function(){
                alert('error');
            }
        });
    });

    $(".btn-pay").click(function () {
        alert($(this));
    });
});