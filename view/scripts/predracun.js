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
    success: function(res){ //console.log(res);
        var total = 0;

        for(var artikel in res){
          //console.log(res[artikel]['data']['ime']);
          var cnt = 1;

          $('#predracun').append(
            '<tr>'+
              '<td class="text-center">'+ cnt +'</td>'+
              '<td>'+ res[artikel]['data']['ime'] +'</td>'+
              '<td class="text-right">'+ res[artikel]['kolicina'] +'</td>'+
              '<td class="text-right">'+ res[artikel]['data']['cena'] +' EUR</td>'+
              '<td class="text-right">'+ res[artikel]['data']['cena'] * res[artikel]['kolicina'] +' EUR</td>'+
            '</tr>'
          );

          cnt++;
          total += res[artikel]['kolicina'] * res[artikel]['data']['cena']; //console.log(res[artikel]['cena']);
        }

        var ddv = 0.22;

        $('#subtotal').append(total.toFixed(2) + " EUR");
        $('#ddv').append((total * ddv).toFixed(2) + " EUR");
        $('#total').append((total * (1 + ddv)).toFixed(2) + " EUR");
        $('.mytotal').append((total * (1 + ddv)).toFixed(2) + " EUR");
      }
  });

    $.ajax({
      type: 'POST',
      url: '/epos/controller/requestHandler.php',
      data: {
        'opisUporabnika': true,
        'target_id': null
      },
      success: function(res){ console.log(res[0]);
        $('#naslovnik').append(res[0]['ime'] + " " + res[0]['priimek']);
        $('#naslov').append(res[0]['naslov']);
        $('#telefon').append(res[0]['telefonska stevilka']);
        $('#mail').append(res[0]['elektronski naslov']);
      }
    });

    var d = new Date();
    var date = d.getDate();
    var month = d.getMonth() + 1; // Since getMonth() returns month from 0-11 not 1-12
    var year = d.getFullYear();

    $(".mydate").append(date+ "." +month+ "." +year);
});
