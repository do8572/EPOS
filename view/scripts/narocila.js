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

var potrdi = function(id){
  $.ajax({
    type: 'POST',
    url: '/epos/controller/requestHandler.php',
    data: {
      'potrdiNarocilo': true,
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

var storniraj = function(id){
  $.ajax({
    type: 'POST',
    url: '/epos/controller/requestHandler.php',
    data: {
      'stornirajNarocilo': true,
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

var preklici = function(id){
  $.ajax({
    type: 'POST',
    url: '/epos/controller/requestHandler.php',
    data: {
      'prekliciNarocilo': true,
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
  var jeProdajalec = getUrlParameter('jeProdajalec');

  $.ajax({
    type: 'GET',
    url: '/epos/controller/requestHandler.php',
    contentType: 'application/json',
    data: {
      'seznamNarocil': true,
      'stanje': 'neobdelano'
    },
    success: function(res){
      if(jeProdajalec == undefined){
        for(i=0; i < res.length; i++){
          $('#NarocilaMain').append(
            '<div class="list-group-item list-group-item-action flex-column align-items-start">' +
              '<div class="d-flex w-100 justify-content-between">' +
                '<a href="narocilo.php?idNarocilo='+ res[i]['idNarocilo'] +' class="text-dark"><h5 class="mb-1">' + res[i]['idNarocilo'] +'</h5></a>' +
                '<small class="text-muted">' + res[i]['stanje'] + '</small>' +
              '</div>' +
              '<p class="mb-1">' + res[i]['datum_narocila'] + '</p>' +
            '</div>'
          );
        }
      }else{
        for(i=0; i < res.length; i++){
          var gumb = "";

          if(res[i]['stanje'] == 'neobdelano'){
            gumb = '<button type="button" class="btn btn-secondary float-md-right" onclick="preklici('+ res[i]['idNarocilo'] +')">Preklici</button>'
                 + '<button type="button" class="btn btn-primary float-md-right" onclick="potrdi('+ res[i]['idNarocilo'] +')">Potrdi</button>';
          }else if(res[i]['stanje'] == 'potrjeno'){
            gumb = '<button type="button" class="btn btn-primary float-md-right" onclick="storniraj('+ res[i]['idNarocilo'] +')">Storniraj</button>';
          }

          $('#NarocilaMain').append(
            '<div class="list-group-item list-group-item-action flex-column align-items-start">' +
              '<div class="d-flex w-100 justify-content-between">' +
                '<a href="narocilo.php?idNarocilo='+ res[i]['idNarocilo'] +' class="text-dark"><h5 class="mb-1">' + res[i]['idNarocilo'] +'</h5></a>' +
                '<small class="text-muted">' + res[i]['stanje'] + '</small>' +
              '</div>' +
              gumb +
              '<p class="mb-1">' + res[i]['datum_narocila'] + '</p>' +
            '</div>'
          );
        }
      }
    }
  });
});
