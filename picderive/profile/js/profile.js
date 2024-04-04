$(document).ready(function(){
    $(".upload-icon").click(function(){
        var input = document.createElement("INPUT");
        input.type = "file";
        input.accept = "image/*";
        input.click();
        input.onchange = function()
        {
            var file  = new FormData();
            file.append("data",this.files[0]);
            $.ajax({
                type : "POSt",
                url : "php/upload.php",
                data : file,
                contentType : false,
                processData : false,
                cache : false,
                success : function(response)
                {
                    alert(response);
                    $.ajax({
                        type : "POST",
                        url : "php/count_photo.php",
                        beforeSend : function()
                        {
                            $(".count-photo").html("updating...");
                        },
                        success : function(response)
                        {
                            $(".count-photo").html(response);
                        },
                    });
                    $.ajax({
                        type : "POST",
                        url : "php/memory.php",
                        beforeSend : function()
                        {
                            $(".memory-status").html("updating...");
                            $(".free-space").html("updating...");
                        },
                        success : function(response)
                        {
                            var json_response = JSON.parse(response);
                            var memory_status = json_response[0];
                            var free_memory = json_response[1];
                            var percentage = json_response[2]+"%";
                            $(".memory-status").html(memory_status);
                            $(".free-space").html("FREE SPACE : "+free_memory+"MB");
                        },
                    });
                },
            });
        }
    });
});