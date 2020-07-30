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
      for(i=0; i < res.length; i++){
        $('#shopMain').append(
          '<a href="article.php?idArtikel='+ res[i]['idArtikel'] +'" class="list-group-item list-group-item-action flex-column align-items-start">' +
            '<div class="d-flex w-100 justify-content-between">' +
              '<h5 class="mb-1">'+ res[i]['ime'] +'</h5>' +
              '<small class="text-muted">' + res[i]['cena'] + ' EUR </small>' +
            '</div>' +
            '<p class="mb-1">' + res[i]['opis'] + '</p>' +
            '<small class="text-muted"></small>' +
          '</a>'
        );
      }
    }
  });
});
