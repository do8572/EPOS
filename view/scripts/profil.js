var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};

$(document).ready(function(){
  var idProfil = getUrlParameter('idProfil');

  $.ajax({
    type: 'POST',
    url: '/epos/controller/requestHandler.php',
    data: {
      'opisUporabnika': true,
      'target_id': idProfil
    },
    success: function(res){   //console.log(res);
      if(res == null){
        window.location.replace("trgovina.php");
      }else if(res.length == 0 || res == -5){
        $(".card").remove();
        $(".container").append(
          '<h5 style="margin-top: 1.5rem">Unable to retrieve profile.</h5>'
        );
      }else{
        $("input#ime").val(res[0]['ime']);
        $("input#priimek").val(res[0]['priimek']);
        $("input#email").val(res[0]['elektronski naslov']);
        $("input#vloga").val(res[0]['vloga']);

        if(res[0]['vloga'] == "stranka"){
          $("input#telefon").val(res[0]['telefonska stevilka']);
          $("input#naslov").val(res[0]['naslov']);
        }else{
          $("input#telefon").remove();
          $("input#naslov").remove();
          $(".TBR").remove();
        }

        $("#profil").submit(function(e){
          e.preventDefault();
          $("input").prop('disabled', false);
          $("input#vloga").prop('disabled', true);
          $("input#email").prop('disabled', true);
          $("#profil").attr('id', 'posodobiProfil');

          $("#posodobiProfil").submit(function(e){
            e.preventDefault();
            console.log('stranka');

            if(res[0]['vloga'] == "stranka"){
              $.ajax({
                type: 'POST',
                url: '/epos/controller/requestHandler.php',
                data: {
                  'posodobi': true,
                  'target_id': idProfil,
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
            }else{
              $.ajax({
                type: 'POST',
                url: '/epos/controller/requestHandler.php',
                data: {
                  'posodobi': true,
                  'target_id': idProfil,
                  'ime': $("input#ime").val(),
                  'priimek': $("input#priimek").val(),
                  'geslo': $("input#geslo").val(),
                  'email': $("input#email").val(),
                  'telefon': null,
                  'naslov': null
                },
                success: function(res){
                  if(res == 0){
                    location.reload();
                    $("input").prop('disabled', true);
                  }
                },
                error: function(xhr, ajaxOptions, thrownError){
                  console.log(xhr.responseText);
                  console.log(thrownError);
                }
              });
            }
          });
        });
      }
    },
    error: function(xhr, ajaxOptions, thrownError){
      $(".card").remove();
      $(".container").append(
        '<h5 style="margin-top: 1.5rem">Unable to retrieve profile.</h5>'
      );

      console.log(xhr.responseText);
      console.log(thrownError);
    }
  });
});
