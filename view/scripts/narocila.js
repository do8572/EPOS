$(document).ready(function(){
  $.ajax({
    type: 'GET',
    url: '/epos/controller/requestHandler.php',
    contentType: 'application/json',
    data: {
      'seznamNarocil': true,
      'stanje': 'neobdelano'
    },
    success: function(res){
      for(i=0; i < res.length; i++){
        $('#NarocilaMain').append(
          '<a href="narocilo.php?idNarocilo='+ res[i]['idNarocilo'] +'" class="list-group-item list-group-item-action flex-column align-items-start">' +
            '<div class="d-flex w-100 justify-content-between">' +
              '<h5 class="mb-1">'+ res[i]['idNarocilo'] +'</h5>' +
              '<small class="text-muted">' + res[i]['stanje'] + '</small>' +
            '</div>' +
            '<p class="mb-1">'+ res[i]['datum_narocila'] +'</p>' +
            '<small class="text-muted"></small>' +
          '</a>'
        );
      }
    }
  });
});
