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
  var idNarocilo = getUrlParameter('idNarocilo');

  $.ajax({
    type: 'POST',
    url: '/epos/controller/requestHandler.php',
    data: {
      'opisNarocila': true,
      'target_id': idNarocilo
    },
    success: function(res){console.log(res);
      var total = 0;

      if(res == -1){
        $('#NarocilaMain').append(
          '<h5 style="margin-top: 1.5rem">Unable to retrieve profile.</h5>'
        );
      }else{
        for(var i=0; i < res.length; i++){
                $('#NarocilaMain').append(
                  '<a href="article.php?idArtikel='+ res[i]['idArtikel'] +'" class="list-group-item list-group-item-action flex-column align-items-start">' +
                    '<div class="d-flex w-100 justify-content-between">' +
                      '<h5 class="mb-1">'+ res[i]['originalnoIme'] +'</h5>' +
                      '<small class="text-muted">' + res[i]['cena'] + 'EUR</small>' +
                    '</div>' +
                    '<p class="mb-1">x' + res[i]['kolicina'] +'</p>' +
                  '</a>'
                );

                total += res[i]['kolicina'] * res[i]['cena'];
        }
        $('#NarocilaMain').append(
          '<hr>' +
          '<h5 class="mb-1 d-flex w-100 justify-content-end">Total: '+ total.toFixed(2) +'</h5>'
        );
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
    }
  });
});
