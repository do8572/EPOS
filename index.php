<html>
<input type="submit" class="button" name="izpisArtiklov" value="izpisiArtikle" />

<script>
$(document).ready(function(){
	$('.button').click(function()){
		var clickBtnValue = $(this).val();
		var ajaxurl = './entity/artikli.php';
		data = {'action': clickBtnValue};
		$.get(ajaxurl, data, function(response){
			alert("izpisArtiklov");		
		});
	});
});
</script>
</html>

<?php
include_once(__DIR__ . '/base/connect.php');
include_once(__DIR__ . '/base/config.php');
include_once(__DIR__ . '/entity/uporabniki.php');

$trenutniUporabnik = new uporabniskiRacun();	

#redirect
/*
if($trenutniUporabnik->prijavljen()) {
	echo "hello, world";
	#redirect to what the sign in is
}else{
	header('Location: ' . URL . 'frontend/anonymous.php');
}
*/

#TEST: registriraj
/*
$anonimni = new AnonimniUporabnik();
$anonimni->registriraj('david', 'ocepek', 'do8572@student.uni-lj.si', 'jakarta 11', '0123456789', 'mcgregor');
*/

