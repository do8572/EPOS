$(document).ready(function(){
  $(".form-signin").submit(function(e){
    e.preventDefault();
    console.log("prijavljam");

    if($("#prijavaX509").is(":checked")){
      $.ajax({
        type: 'POST',
        url: '/epos/controller/X509/requestHandler.php',
        data: {
          'prijavaX509': true,
          'geslo': $("#inputPassword").val()
        },
        success: function(res){
          if(res == 0){
            window.location.replace("trgovina.php");
          }
        }
      });
    }else{
      $.ajax({
        type: 'POST',
        url: '/epos/controller/requestHandler.php',
        data: {
          'prijava': true,
          'email': $("#inputEmail").val(),
          'geslo': $("#inputPassword").val()
        },
        success: function(res){
          if(res == 0){
            window.location.replace("trgovina.php");
          }
        }
      });
    }
  });
});
