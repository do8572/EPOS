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
  window.location.replace('predracun.php');
}

$(document).ready(function(){
  $.ajax({
    type: 'GET',
    url: '/epos/controller/requestHandler.php',
    contentType: 'application/json',
    data: {
      'izpisKosarica': true
    },
    success: function(res){ //console.log(res);
        var total = 0;

        for(var artikel in res){
          //console.log(res[artikel]['data']['ime']);
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

          total += res[artikel]['kolicina'] * res[artikel]['data']['cena']; //console.log(res[artikel]['cena']);
        }

      if(res.length == 0){
        $('#KosaricaMain').append(
          '<p class="mb-1">Kosarica je prazna.</p>'
        );
      }else{
        $('#KosaricaMain').append(
          '<hr>' +
          '<h5 class="mb-1 d-flex w-100 justify-content-end">Total: '+ total.toFixed(2) +'</h5>'
        );
        $('#KosaricaMain').append(
          '<div class="flex-column align-items-end" style="margin-top: 1.5rem;">' +
          '<button type="button" class="btn col-md-5 btn-primary float-md-right" onclick="zakljuciNakup()">Zakljuci</button>' +
          '</div>'
        );
      }
    }
  });
});
