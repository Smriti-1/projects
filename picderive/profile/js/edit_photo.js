// rename coading
$(document).ready(function(){
    $(".edit-icon").each(function(){
        $(this).click(function(){
            var edit_icon = $(this);
            var image_path = $(this).attr("data-location");
            var footer = this.parentElement;
            var span = footer.getElementsByTagName("SPAN")[0];
            span.contentEditable = true;
            span.focus();
            var old_name = span.innerHTML;
            $(this).addClass("d-none");
            var save_icon = footer.getElementsByClassName("save-icon")[0];
            $(save_icon).removeClass("d-none");
            $(save_icon).click(function(){
                var photo_name = span.innerHTML;
                $.ajax({
                    type : "POST",
                    url : "php/rename.php",
                    data : {
                        photo_name : photo_name,
                        image_path : image_path
                    },
                    beforeSend : function()
                    {
                        $(".loader").removeClass("d-none");
                        $(save_icon).addClass("d-none");
                    },
                    success : function(response)
                    {
                        if(response.trim() == "file already exsist, please enter other name")
                        {
                            alert(response);
                            $(".loader").addClass("d-none");
                            $(save_icon).removeClass("d-none");
                            span.focus();
                        }
                        else if(response.trim() == "success")
                        {
                            span.innerHTML = photo_name;
                            span.contentEditable = false;
                            $(".loader").addClass("d-none");
                            $(save_icon).addClass("d-none");
                            $(edit_icon).removeClass("d-none"); 

                            var previouis_download_link = footer.getElementsByClassName("download-icon")[0].getAttribute("data-location");
                            current_download_link = previouis_download_link.replace(old_name,photo_name);
                            footer.getElementsByClassName("download-icon")[0].setAttribute("data-location",current_download_link);
                            footer.getElementsByClassName("download-icon")[0].setAttribute("file-name",photo_name);
                            footer.getElementsByClassName("delete-icon")[0].setAttribute("data-location",current_download_link);
                        }
                    }
                });
            });
        });
    });
});

 

//download coading
$(document).ready(function(){
    $(".download-icon").each(function(){
        $(this).click(function(){
            var download_link = $(this).attr("data-location");
            var file_name = $(this).attr("file-name");
            var a = document.createElement("A");
            a.href = download_link;
            a.download = file_name;
            a.click();
        });
    });
});


 //delete coading
$(document).ready(function(){
    $(".delete-icon").each(function(){
        $(this).click(function(){
            var del_icon = this;
            $.ajax({
                type : "POST",
                url : "php/delete.php",
                data : {
                    photo_path : $(this).attr("data-location")
                },
                beforeSend : function()
                {
                    $(this).removeClass("fa fa-trash");
                    $(this).removeClass("fa fa-spinner fa-spin");
                },
                success : function(response)
                {
                    /* alert(response); */
                    if(response.trim() == "delete success")
                    {
                        del_icon.parentElement.parentElement.style.display = "none";
                    }
                    else{
                        alert(response);
                    }
                },
            });
        });
    });
});