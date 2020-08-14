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

var dodajArtikel = function(id){
  $.ajax({
    type: 'GET',
    url: '/epos/controller/requestHandler.php',
    contentType: 'application/json',
    data: {
      'dodajArtikel': true,
      'target_id': id,
      'kolicina': 1
    },
    success: function(res){
      window.location.replace("kosarica.php");
    }
  });
}

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
      $.ajax({
        type: 'GET',
        url: '/epos/controller/requestHandler.php',
        contentType: 'application/json',
        data: {
          'opisUporabnika': true,
          'target_id': null
        },
        success: function(res2){  //console.log(res2);
          if(res2 == null || res2[0]['vloga'] != 'stranka'){
            $('#articleMain').append(
              '<img class="card-img-top img-fluid" src="../images/900x400.jpg" alt="broken link">'+
              '<div class="card-body">'+
                '<h3 class="card-title">'+ res[0]['ime'] +'</h3>'+
                '<h4>'+ res[0]['cena'] +' EUR</h4>'+
                '<p class="card-text">'+ res[0]['opis'] +'</p>'+
              '</div>'
            );
          }else{
            $('#articleMain').append(
              '<img class="card-img-top img-fluid" src="../images/900x400.jpg" alt="broken link">'+
              '<div class="card-body">'+
                '<h3 class="card-title">'+ res[0]['ime'] +'</h3>'+
                '<h4>'+ res[0]['cena'] +' EUR</h4>'+
                '<p class="card-text">'+ res[0]['opis'] +'</p>'+
                '<div class="row justify-content-end">' +
                  '<div class="col-md-3">' +
                '<button type="button" class="btn btn-primary" onclick="dodajArtikel(' + idArtikel + ')">DodajArtikel</button>' +
                '</div></div>' +
              '</div>'
            );
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
