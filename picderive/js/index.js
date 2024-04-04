$(document).ready(function(){
    $(".show-icon").click(function(){
        if($("#password").attr("type") == "password")
        {
            $("#password").attr("type","text");
            $(".show-icon").css("color","blue");
        }
        else{
            $("#password").attr("type","password");
            $(this).css("color","#ccc");
        }
    });
});