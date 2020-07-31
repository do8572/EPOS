$(document).ready(function(){
  $(".form-signin").submit(function(e){
    e.preventDefault();
    console.log("nov artikel");

    $.ajax({
      type: 'POST',
      url: '/epos/controller/requestHandler.php',
      data: {
        'ustvariArtikel': true,
        'ime': $("#ime").val(),
        'opis': $("#opis").val(),
        'cena': $("#cena").val()
      },
      success: function(res){
        if(res == 0){
          window.location.replace("seznamArtiklov.php");
        }
      }
    });
  });


});
