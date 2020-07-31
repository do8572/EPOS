var odstraniArtikel = function(idArtikel){
  $.ajax({
    type: 'GET',
    url: '/epos/controller/requestHandler.php',
    contentType: 'application/json',
    data: {
      'odstraniArtikel': true,
      'target_id': idArtikel,
      'kolicina': 1
    },
    success: function(res){
      console.log("odstranjen");
      location.reload();
    }
  });
}

var dodajArtikel = function(idArtikel){
  $.ajax({
    type: 'GET',
    url: '/epos/controller/requestHandler.php',
    contentType: 'application/json',
    data: {
      'dodajArtikel': true,
      'target_id': idArtikel,
      'kolicina': 1
    },
    success: function(res){
      location.reload();
    }
  });
}

var zakljuciNakup = function(){
  $.ajax({
    type: 'POST',
    url: '/epos/controller/requestHandler.php',
    data: {
      'zakljuciNakup': true
    },
    success: function(res){
      console.log('zakljucen nakup');
      window.location.replace("narocila.php");
    },
    error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
    }
  });
}

$(document).ready(function(){
  $.ajax({
    type: 'GET',
    url: '/epos/controller/requestHandler.php',
    contentType: 'application/json',
    data: {
      'izpisKosarica': true
    },
    success: function(res){
      console.log(res);

        for(var artikel in res){
          console.log(res[artikel]['data']['ime'])
          $('#KosaricaMain').append(
            '<div class="list-group-item list-group-item-action flex-column align-items-start">' +
              '<div class="d-flex w-100 justify-content-between">' +
                '<a href="article.php?idArtikel='+ artikel +' class="text-dark"><h5 class="mb-1">' + res[artikel]['data']['ime'] +'</h5></a>' +
                '<small class="text-muted">' + res[artikel]['data']['cena'] + ' EUR </small>' +
              '</div>' +
              '<p class="mb-1">x' + res[artikel]['kolicina'] + '</p>' +
            '<button type="button" class="btn btn-secondary float-md-right" onclick="odstraniArtikel('+ artikel +')">Odstani</button>' +
            '<button type="button" class="btn btn-primary float-md-right" onclick="dodajArtikel('+ artikel +')">Dodaj</button>' +
            '</div>'
          );
        }

      if(res.length == 0){
        $('#KosaricaMain').append(
          '<p class="mb-1">Kosarica je prazna.</p>'
        );
      }else{
        $('#KosaricaMain').append(
          '<div class="flex-column align-items-end" style="margin-top: 1.5rem;">' +
          '<button type="button" class="btn col-md-5 btn-primary float-md-right" onclick="zakljuciNakup()">Zakljuci</button>' +
          '</div>'
        );
      }
    }
  });
});
