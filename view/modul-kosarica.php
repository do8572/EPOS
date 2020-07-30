<html>
<header>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</header>

<h3>Modul kosarica</h3>
<br><br>

Doda artikel v kosarico. <br>
<form id="registration-form" class="toggle-form" method="get" action="../controller/requestHandler.php">
<label class="form-label" for="target_id">ID:</label><br>
<input type="text" class="form-field" name="target_id" value="" /><br>
<label class="form-label" for="kolicina">kolicina:</label><br>
<input type="text" class="form-field" name="kolicina" value="" /><br>
<input type="submit" class="button" name="dodajArtikel" value="dodajArtikel" />
</form>
<hr>

<form id="registration-form" class="toggle-form" method="get" action="../controller/requestHandler.php">
	<label class="form-label" for="target_id">ID:</label><br>
	<input type="text" class="form-field" name="target_id" value="" /><br>
	<label class="form-label" for="kolicina">kolicina:</label><br>
	<input type="text" class="form-field" name="kolicina" value="" /><br>
<input type="submit" class="button" name="odstraniArtikel" value="odstraniArtikel" />
</form>
<hr>

<form id="registration-form" class="toggle-form" method="post" action="../controller/requestHandler.php">
<input type="submit" class="button" name="zakljuciNakup" value="zakljuci" />
</form>
<hr>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
