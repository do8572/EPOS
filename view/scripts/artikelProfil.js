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
  var idArtikel = getUrlParameter('idArtikel');

  $.ajax({
    type: 'GET',
    url: '/epos/controller/requestHandler.php',
    contentType: 'application/json',
    data: {
      'opisArtikla': true,
      'target_id': idArtikel
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
        $("input#opis").val(res[0]['opis']);
        $("input#cena").val(res[0]['cena']);

        $("#profil").submit(function(e){
          e.preventDefault();
          $("input").prop('disabled', false);
          $("#profil").attr('id', 'posodobiProfil');

          $("#posodobiProfil").submit(function(e){
            e.preventDefault();

              $.ajax({
                type: 'POST',
                url: '/epos/controller/requestHandler.php',
                data: {
                  'posodobiArtikel': true,
                  'target_id': idArtikel,
                  'ime': $("input#ime").val(),
                  'opis': $("input#opis").val(),
                  'cena': $("input#cena").val(),
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
