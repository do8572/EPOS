<html>
<header>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</header>

<h3>Modul artikli</h3>
<br><br>

Izpise vse podatke artikla v DB. <br>
<form id="registration-form" class="toggle-form" method="get" action="../controller/requestHandler.php">
<label class="form-label" for="target_id">ID:</label><br>
<input type="text" class="form-field" name="target_id" value="" /><br>
<input type="submit" class="button" name="opisArtikla" value="opisArtikla" />
</form>
<hr>
Izpise seznam artiklov v DB. <br>

<form id="registration-form" class="toggle-form" method="get" action="../controller/requestHandler.php">
<input type="submit" class="button" name="izpisArtiklov" value="izpisiArtikle" />
</form>
<hr>
Ustvari artikel.<br>
<form id="registration-form" class="toggle-form" method="post" action="../controller/requestHandler.php">
<span class="form-input-holder">
<label class="form-label" for="ime">Ime:</label><br>
<input type="text" class="form-field" name="ime" value="" /><br>
<label class="form-label" for="ime">Opis:</label><br>
<input type="text" class="form-field" name="opis" value="" /><br>
<label class="form-label" for="ime">Cena:</label><br>
<input type="text" class="form-field" name="cena" value="" /><br>
</span>

<input type="submit" class="post-button" name="ustvariArtikel" value="ustvariArtikel" />
</form>
</div>
<div>
<hr>
Posodobi podatke artikla.<br>
<form id="registration-form" class="toggle-form" method="post" action="../controller/requestHandler.php">
<span class="form-input-holder">
<label class="form-label" for="target_id">ID:</label><br>
<input type="text" class="form-field" name="target_id" value="" /><br>
<label class="form-label" for="ime">Ime:</label><br>
<input type="text" class="form-field" name="ime" value="" /><br>
<label class="form-label" for="ime">Opis:</label><br>
<input type="text" class="form-field" name="opis" value="" /><br>
<label class="form-label" for="ime">Cena:</label><br>
<input type="text" class="form-field" name="cena" value="" /><br>
</span>

<input type="submit" class="post-button" name="posodobiArtikel" value="posodobiArtikel" />
</form>
Aktiviraj artikel ID.<br>
<form id="registration-form" class="toggle-form" method="post" action="../controller/requestHandler.php">
<span class="form-input-holder">
<label class="form-label" for="ime">ID:</label><br>
<input type="text" class="form-field" name="target_id" value="" /><br>
</span>

<input type="submit" class="post-button" name="aktivirajArtikel" value="aktivirajArtikel" />
</form>
<hr>
Deaktiviraj artikel ID.<br>
<form id="registration-form" class="toggle-form" method="post" action="../controller/requestHandler.php">
<span class="form-input-holder">
<label class="form-label" for="ime">ID:</label><br>
<input type="text" class="form-field" name="target_id" value="" /><br>
</span>

<input type="submit" class="post-button" name="deaktivirajArtikel" value="deaktivirajArtikel" />
</form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
