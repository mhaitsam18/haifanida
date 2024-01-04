(function($){
    "use strict";
    $("#contactForm").validator().on("submit",function(event){
        if(event.isDefaultPrevented()){
            formError();
            submitMSG(false,"Apakah Anda sudah mengisi formulir dengan benar?");
        }else{
            // event.preventDefault();
            // submitForm();
        }
    });
    function submitForm(){

        var nama_pengirim=$("#nama_pengirim").val();
        var email_pengirim=$("#email_pengirim").val();
        var subjek=$("#subjek").val();
        var nomor_wa_pengirim=$("#nomor_wa_pengirim").val();
        var pesan=$("#pesan").val();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type:"POST",
            url:"/kontak-kami",
            data:{
                "_token": csrfToken,
                "nama_pengirim=":nama_pengirim,
                "email_pengirim=":email_pengirim,
                "subjek=":subjek,
                "nomor_wa_pengirim=":nomor_wa_pengirim,
                "pesan=":pesan
            },
            success:function(text){
                if(text=="success"){
                    formSuccess();
                }else{
                    formError();
                    submitMSG(false,text);
                }
            }
        });
    }
    function formSuccess(){
        $("#contactForm")[0].reset();
        submitMSG(true,"Pesan Terkirim!");
    }
    function formError(){
        $("#contactForm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
        function(){
            $(this).removeClass();
        });
    }
    function submitMSG(valid,msg){
        if(valid){
            var msgClasses="h4 tada animated text-success";
        }else {
            var msgClasses="h4 text-danger";
        }
        $("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
    }
}(jQuery));
