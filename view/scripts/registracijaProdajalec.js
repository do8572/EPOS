$(document).ready(function(){
  $(".form-signin").submit(function(e){
    e.preventDefault();
    console.log("registriram");

    $.ajax({
      type: 'POST',
      url: '/epos/controller/requestHandler.php',
      data: {
        'registracijaProdajalca': true,
        'email': $("#inputEmail").val(),
        'geslo': $("#inputPassword").val(),
        'ime': $("#ime").val(),
        'priimek': $("#priimek").val()
      },
      success: function(res){
        if(res == 0){
          $.ajax({
            type: 'POST',
            url: '/epos/controller/requestHandler.php',
            data: {
              'prijava': true,
              'email': $("#inputEmail").val(),
              'geslo': $("#inputPassword").val()
            },
            success: function(res){   //console.log(res);
              if(res == 0){
                console.log("successfull sign in");
              }
            },
            error: function(xhr, ajaxOptions, thrownError){
              console.log(xhr.responseText);
              console.log(thrownError);
            }
          });

          window.location.replace("seznamUporabnikov.php");
        }
      }
    });
  });


});
