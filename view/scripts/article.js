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
    success: function(res){
      $.ajax({
        type: 'GET',
        url: '/epos/controller/requestHandler.php',
        contentType: 'application/json',
        data: {
          'opisUporabnika': true
        },
        success: function(res2){
          if(res2 == null){
            $('#articleMain').append(
              '<img class="card-img-top img-fluid" src="http://placehold.it/900x400" alt="">'+
              '<div class="card-body">'+
                '<h3 class="card-title">'+ res[0]['ime'] +'</h3>'+
                '<h4>'+ res[0]['cena'] +' EUR</h4>'+
                '<p class="card-text">'+ res[0]['opis'] +'</p>'+
              '</div>'
            );
          }else{
            $('#articleMain').append(
              '<img class="card-img-top img-fluid" src="http://placehold.it/900x400" alt="">'+
              '<div class="card-body">'+
                '<h3 class="card-title">'+ res[0]['ime'] +'</h3>'+
                '<h4>'+ res[0]['cena'] +' EUR</h4>'+
                '<p class="card-text">'+ res[0]['opis'] +'</p>'+
                '<div class="row justify-content-end">' +
                  '<div class="col-md-3">' +
                '<button type="button" class="btn btn-primary">DodajArtikel</button>' +
                '</div></div>' +
              '</div>'
            );
          }
        }
      });
    }
  });
});
