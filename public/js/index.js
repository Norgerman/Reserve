$(function(){
    $(".search-ul a").click(function(){
        $(".search-text").text($(this).text());
        var ph = "请输入"+$(this).text()+"名称";
        $("input[type=search]").attr('placeholder',ph);
    });
});