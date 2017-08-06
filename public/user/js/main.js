$(document).ready(function() {
// error function
function printErrorMsg (msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display','block');
    $(".print-error-msg").fadeOut(5000);
    $.each( msg, function( key, value ) {
        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
    });
}

// updating username and password

    $("#submit_pass").click(function() {
        var url = $("#update_pass").attr('action');
        var $this = $(this);
        $this.button('loading');

        $("#update_pass").css({
            opacity: 0.5
        });

        $.ajax({
            url: url,
            method: "POST",
            dataType: "JSON",
            data: $("#update_pass").serialize(),
            success: function(data){
            if($.isEmptyObject(data.error)){
                if(data.success === "Success"){
                    setTimeout(function() {
                    $this.button('reset');
                    });
                    $("#update_pass").css({
                        opacity: 1
                    });
                    $(".print-success-msg").text('Updated successfully....').show();
                    $(".print-success-msg").fadeOut(10000);
                    setTimeout(function() {
                         $('#myModal').modal('hide');
                    }, 5000);                   
                }
            }else{
                setTimeout(function() {
                $this.button('reset');
                });
                $("#update_pass").css({
                        opacity: 1
                    });
                printErrorMsg(data.error);
            }
            }
        });
    });

// $("i").click(function () {
//   $("input[type='file']").trigger('click');
// });

// $('input[type="file"]').on('change', function() {
//   var val = $(this).val();
//   $(this).siblings('span').text(val);
// })

// creating post

$("#post_submit").click(function() {
    var url = $("#post_create").attr('action');
    var $this = $(this);
    $this.button('loading');

    $.ajax({
        url: url,
        method: "POST",
        dataType: "JSON",
        data: $("#post_create").serialize(),
        success: function(data){
            if($.isEmptyObject(data.error)){
                if(data.success === "Success"){
                    setTimeout(function() {
                    $this.button('reset');
                    });
                    $("#update_pass").css({
                        opacity: 1
                    });
                    $(".print-success-msg").text('Updated successfully....').show();
                    $(".print-success-msg").fadeOut(10000);
                    setTimeout(function() {
                         $('#myModal').modal('hide');
                    }, 5000);                   
                }
            }else{
                setTimeout(function() {
                $this.button('reset');
                });
                $("#update_pass").css({
                        opacity: 1
                    });
                printErrorMsg(data.error);
            }
        }
    })
})

// creating group

$("#group_submit").click(function() {
    var url = $("#group_form").attr('action');
    var $this = $(this);
    $this.button('loading');
    $.ajax({
        url: url,
        method: "POST",
        dataType: "JSON",
        data: $("#group_form").serialize(),
        success: function(data){
            if($.isEmptyObject(data.error)){
                if(data.success === "Success"){
                    setTimeout(function() {
                    $this.button('reset');
                    });
                    $("#group_form").css({
                        opacity: 1
                    });
                    $(".print-success-msg").text('Updated successfully....').show();
                    $(".print-success-msg").fadeOut(5000);
                    $("#group_form")[0].reset();
                }
            }else{
                setTimeout(function() {
                $this.button('reset');
                });
                $("#group_form").css({
                        opacity: 1
                    });
                printErrorMsg(data.error);
            }
        }
    });
});



});