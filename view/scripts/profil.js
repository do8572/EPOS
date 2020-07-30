$(document).ready(function(){
  $.ajax({
    type: 'GET',
    url: '/epos/controller/requestHandler.php',
    contentType: 'application/json',
    data: {
      'opisUporabnika': true
    },
    success: function(res){
      if(res == null){
        window.location.replace("trgovina.php");
      }else{
        $("input#ime").val(res[0]['ime']);
        $("input#priimek").val(res[0]['priimek']);
        $("input#email").val(res[0]['elektronski naslov']);
        $("input#vloga").val(res[0]['vloga']);

        if(res[0]['vloga'] == "stranka"){
          $("input#telefon").val(res[0]['telefonska stevilka']);
          $("input#naslov").val(res[0]['naslov']);
        }

        $("#profil").submit(function(e){
          e.preventDefault();
          $("input").prop('disabled', false);
          $("input#vloga").prop('disabled', true);
          $("#profil").attr('id', 'posodobiProfil');

          $("#posodobiProfil").submit(function(e){
            e.preventDefault();

            $.ajax({
              type: 'POST',
              url: '/epos/controller/requestHandler.php',
              data: {
                'posodobi': true,
                'target_id': null,
                'ime': $("input#ime").val(),
                'priimek': $("input#priimek").val(),
                'geslo': $("input#geslo").val(),
                'email': $("input#email").val(),
                'telefon': $("input#telefon").val(),
                'naslov': $("input#naslov").val()
              },
              success: function(res){
                if(res == 0){
                  location.reload();
                  $("input").prop('disabled', true);
                }
              },
              error: function(xhr, ajaxOptions, thrownError){
                alert(xhr.responseText);
                alert(thrownError);
              }
            });
          });
        });
      }
    }
  });
});
