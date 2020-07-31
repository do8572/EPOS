$(document).ready(function(){
  $.ajax({
    type: 'GET',
    url: '/epos/controller/requestHandler.php',
    contentType: 'application/json',
    data: {
      'opisUporabnika': true,
      'target_id': null
    },
    success: function(res){
      if(res == null){
        $('#navbarNavAltMarkup').append(
          '<div class="navbar-nav ml-auto">' +
          '  <a class="nav-item nav-link" href="prijava.php">Prijava</a>' +
          '  <a class="nav-item nav-link" href="registracija.php">Registracija</a>' +
          '</div>'
        );
      }else if(res[0]['vloga'] == 'prodajalec'){
        $('#navbarNavAltMarkup').append(
          '<div class="navbar-nav">' +
          '  <a class="nav-item nav-link" href="profil.php?idProfil='+ res[0]['idUporabnik'] +'">Profil</a>' +
          '  <a class="nav-item nav-link" href="narocila.php">Narocila</a>' +
          '  <a class="nav-item nav-link" href="seznamUporabnikov.php">Stranke</a>' +
          '  <a class="nav-item nav-link" href="seznamArtiklov.php">Artikli</a>' +
          '</div>' +
          '<div class="navbar-nav ml-auto">' +
          '  <a id="odjavi" class="nav-item nav-link" href="#">Odjavi</a>' +
          '</div>'
        );
      }else if(res[0]['vloga'] == 'stranka'){
        $('#navbarNavAltMarkup').append(
          '<div class="navbar-nav">' +
          '  <a class="nav-item nav-link" href="profil.php?idProfil='+ res[0]['idUporabnik'] +'">Profil</a>' +
          '  <a class="nav-item nav-link" href="kosarica.php">Kosarica</a>' +
          '  <a class="nav-item nav-link" href="narocila.php">Narocila</a>' +
          '</div>' +
          '<div class="navbar-nav ml-auto">' +
          '  <a id="odjavi" class="nav-item nav-link" href="#">Odjavi</a>' +
          '</div>'
        );
      }else if(res[0]['vloga'] == 'administrator'){
        $('#navbarNavAltMarkup').append(
          '<div class="navbar-nav">' +
          '  <a class="nav-item nav-link" href="profil.php?idProfil='+ res[0]['idUporabnik'] +'">Profil</a>' +
          '  <a class="nav-item nav-link" href="seznamUporabnikov.php?jeAdministrator=true">Prodajalci</a>' +
          '</div>' +
          '<div class="navbar-nav ml-auto">' +
          '  <a id="odjavi" class="nav-item nav-link" href="#">Odjavi</a>' +
          '</div>'
        );
      }

      $(document).on("click", "a#odjavi", function(){
        console.log("odjava");

        $.ajax({
          type: 'GET',
          url: '/epos/controller/requestHandler.php',
          contentType: 'application/json',
          data: {
            'odjava': true
          },
          success: function(res){
            window.location.replace("trgovina.php");
          }
        });
      });
    },
    error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
    }
  });
});
