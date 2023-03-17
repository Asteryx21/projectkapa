$(document).ready(function(){
    $("#form").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.floor((evt.loaded / evt.total) * 100); //nearest integer point.
                        $(".progress-bar").width(percentComplete + '%');
                        $(".progress-bar").html(percentComplete+'%');
                    }
                }, false);
                return xhr;
            },
            type: 'POST',
            url: 'reportup.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $(".progress-bar").width('0%');
                //$('#statusMsg').html('<img src="images/loading.gif"/>');
            },
            error:function(){
                $('.statusMsg').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
            },
            success: function(response){
                var response = JSON.parse(response);
               
                $('.statusMsg').html('');
                if(response.status == 1){
                    $('#form')[0].reset();
                    $('.statusMsg').html('<p style="color:#28A74B;">'+response.message+'</p>');
                    $(".statusMsg").delay(1500).fadeOut();
            
                    getData();
              
                }else{
                    $('.statusMsg').html('<p style="color:#EA4335;">'+response.message+'</p>');
                    $(".statusMsg").delay(1500).fadeOut();
                }
                $('#form').css("opacity","");
                $(".submitBtn").removeAttr("disabled");
                
            }
        });

    });
	
});
