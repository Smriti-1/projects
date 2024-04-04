$(document).ready(function(){
    $(".generate-btn").click(function(e){
        e.preventDefault();
        $("#password").attr("type","text");
        $(".show-icon").css("color","blue");
        $.ajax({
            type : "POST",
            url : "php/randome_password.php",
            beforeSend : function()
            {
                $(".show-icon").removeClass("fa fa-eye");
                $(".show-icon").addClass("fa fa-circle-o-notch fa-spin");
            },
            success : function(respoone)
            {
                $(".show-icon").removeClass("fa fa-circle-o-notch fa-spin");
                $(".show-icon").addClass("fa fa-eye");
                $("#password").val(respoone);
            }
        });
    });
});