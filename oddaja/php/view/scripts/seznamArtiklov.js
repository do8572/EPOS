var aktiviraj = function(id){
  $.ajax({
    type: 'POST',
    url: '/epos/controller/requestHandler.php',
    data: {
      'aktivirajArtikel': true,
      'target_id': id
    },
    success: function(res){
      location.reload();
    }
  });
}

var deaktiviraj = function(id){   console.log(id);
  $.ajax({
    type: 'POST',
    url: '/epos/controller/requestHandler.php',
    data: {
      'deaktivirajArtikel': true,
      'target_id': id
    },
    success: function(res){
      location.reload();
    },
    error: function(xhr, ajaxOptions, thrownError){
      console.log(xhr.responseText);
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
      'izpisVsihArtiklov': true
    },
    success: function(res){   console.log(res);
      for(i=0; i < res.length; i++){
        var gumb = "";

        if(res[i]['stanje'] == 'aktiviran'){
          gumb = '<button type="button" class="btn btn-secondary float-md-right" onclick="deaktiviraj('+ res[i]['idArtikel'] +')">Deaktiviraj</button>';
        }else{
          gumb = '<button type="button" class="btn btn-primary float-md-right" onclick="aktiviraj('+ res[i]['idArtikel'] +')">Aktiviraj</button>';
        }

        $('#SeznamMain').append(
          '<div class="list-group-item list-group-item-action flex-column align-items-start">' +
            '<div class="d-flex w-100 justify-content-between">' +
              '<a href="artikelProfil.php?idArtikel='+ res[i]['idArtikel'] +'" class="text-dark"><h5 class="mb-1">' + res[i]['ime'] + '</h5></a>' +
              '<small class="text-muted">' + res[i]['cena'] + ' EUR </small>' +
            '</div>' +
            gumb +
            '<p class="mb-1">' + res[i]['opis'] + '</p>' +
          '</div>'
        );
      }
    }
  });
});
