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

var aktiviraj = function(id){
  $.ajax({
    type: 'POST',
    url: '/epos/controller/requestHandler.php',
    data: {
      'aktiviraj': true,
      'target_id': id
    },
    success: function(res){
      location.reload();
    }
  });
}

var deaktiviraj = function(id){   //console.log(id);
  $.ajax({
    type: 'POST',
    url: '/epos/controller/requestHandler.php',
    data: {
      'deaktiviraj': true,
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
  var jeAdministrator = getUrlParameter('jeAdministrator');
  if(jeAdministrator != undefined){
    $('#novUporabnik').remove();
    $('.flex-column').append(
      '<button id="novUporabnik" type="button" class="btn col-md-5 btn-primary float-md-right" onclick="window.location.replace(\'registracijaProdajalec.php\')">Nov racun</button>'
    );
  }

  $.ajax({
    type: 'POST',
    url: '/epos/controller/requestHandler.php',
    data: {
      'seznamUporabnikov': true
    },
    success: function(res){   //console.log(res);
      for(i=0; i < res.length; i++){
        var gumb = "";

        if(res[i]['stanje'] == 'aktiviran'){
          gumb = '<button type="button" class="btn btn-secondary float-md-right" onclick="deaktiviraj('+ res[i]['idUporabnik'] +')">Deaktiviraj</button>';
        }else{
          gumb = '<button type="button" class="btn btn-primary float-md-right" onclick="aktiviraj('+ res[i]['idUporabnik'] +')">Aktiviraj</button>';
        }

        $('#SeznamMain').append(
          '<div class="list-group-item list-group-item-action flex-column align-items-start">' +
            '<div class="d-flex w-100 justify-content-between">' +
              '<a href="profil.php?idProfil='+ res[i]['idUporabnik'] +' class="text-dark"><h5 class="mb-1">' + res[i]['ime'] + ' ' + res[i]['priimek'] +'</h5></a>' +
            '</div>' +
            '<p class="mb-1">' + res[i]['elektronski naslov'] + '</p>' +
            gumb +
          '</div>'
        );
      }
    }
  });
});
