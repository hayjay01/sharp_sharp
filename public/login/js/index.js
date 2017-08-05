// Toggle Function
$('.toggle').click(function(){
  // Switches the Icon
  $(this).children('i').toggleClass('fa-pencil');
  // Switches the forms  
  $('.form').animate({
    height: "toggle",
    'padding-top': 'toggle',
    'padding-bottom': 'toggle',
    opacity: "toggle"
  }, "slow");
});

    function loader_register(v){
        if(v === "on"){
            $("#register_form").css({
                opacity : 0.2
            });
            $("#loader").show();
        }else{
            $("#register_form").css({
                opacity : 1
            });
            $("#loader").hide();
        }
    }

    function loader_login(l){
        if(l === "on"){
            $("#login_form").css({
                opacity: 0.2
            });
            $("#loader").show();
        }else{
            $("#login_form").css({
                opacity: 1
            });
            $("#loader").hide();
        }
    }

    function printErrorMsg (msg) {

        $(".print-error-msg").find("ul").html('');
 
        $(".print-error-msg").css('display','block');

        $(".print-error-msg").fadeOut(5000);

        $.each( msg, function( key, value ) {

            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');

        });

	}

$(document).ready(function() {

  $("#register_button").click(function() {
    var url = $("#register_form").attr('action');
    loader_register('on');
    $.ajax({
      url: url,
      method: 'POST',
      dataType: 'JSON',
      data: $("#register_form").serialize(),
      success: function(data){
        if($.isEmptyObject(data.error)){

                if(data.success === "Success"){
                    loader_register('off');
                    $(".print-success-msg").text('Registered successfully....').show();
                    $(".print-success-msg").fadeOut(5000);                        
                    $('#register_form')[0].reset();
                }

            }else{
                loader_register('off');
                printErrorMsg(data.error);
            }
        }
    
  });
});

function redirectIflogin(url_dashboard)
  {
      window.location = url_dashboard;
  }

$("#login_button").click(function() {
  var url_login = $("#login_form").attr('action');
  var login_form = $("#login_form").serializeArray();
  loader_login('on');
  $.post(url_login, login_form, function(data) {
        if(data === "fail"){
            loader_login('off');
            $("#log").addClass('alert alert-danger').fadeIn(2000, function() {
                $(this).hide();
            });
            $("#msg").text('Invalid login credentials')
        }else{
            loader_login('off');
            $("#log").addClass('alert alert-success').fadeIn(2000, function() {
                $(this).hide();
            });
            $("#msg").text('Logged in, redirecting...');
             redirectIflogin('/user/dashboard');
        }
        
    });
});

});