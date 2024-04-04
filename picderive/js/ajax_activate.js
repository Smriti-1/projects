$(document).ready(function(){
    $(".activate-btn").click(function(){
        var username = btoa($("#email").val());
        var code = btoa($("#code").val());
        $.ajax({
            type : "POST",
            url : "php/activate.php",
            data : {
                username : username,
                code : code
            },
            beforeSend : function()
            {
                $(".activate-btn").html("Please wait we are checking...");
            },
            success : function(response)
            {
                /* alert(response); */
                if(response.trim() == "user verified")
                {
                    window.location = "profile/profile.php";
                }
                else{
                    $(".login-submit-btn").html("Activate Now");
                    $(".login-submit-btn").removeAttr("disabled");
                    $("#login-code").val("");
                    var notice = document.createElement("DIV");
                    notice.className = "alert alert-warning";
                    notice.innerHTML = "<b>Wrong activation code</b>";
                    $(".login-notice").append(notice);
                    setTimeout(function(){
                        $(".login-notice").html("");
                    },5000);
                }
                
            }
        });
    });
});