<html>
<header>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</header>

<body>

<div>
<h3>Modul Uporabniski racun</h3>
<?php
session_start();
print_r($_SESSION);
?>
<br><br>

<form id="registration-form" class="toggle-form" method="post" action="../controller/requestHandler.php">
<input type="submit" class="post-button" name="ustvariAdministratorja" value="ustvari administratorja" />
</form>

Registrira uporabnika kot stranko<br>
<form id="registration-form" class="toggle-form" method="post" action="../controller/requestHandler.php">
<span class="form-input-holder">
<label class="form-label" for="ime">Ime:</label><br>
<input type="text" class="form-field" name="ime" value="" /><br>
<label class="form-label" for="priimek">Priimek:</label><br>
<input type="text" class="form-field" name="priimek" value="" /><br>
<label class="form-label" for="email">Elektronski naslov:</label><br>
<input type="text" class="form-field" name="email" value="" /><br>
<label class="form-label" for="naslov">Naslov:</label><br>
<input type="text" class="form-field" name="naslov" value="" /><br>
<label class="form-label" for="telefon">Telefonska stevilka:</label><br>
<input type="text" class="form-field" name="telefon" value="" /><br>
<label class="form-label" for="geslo">Geslo:</label><br>
<input type="text" class="form-field" name="geslo" value="" /><br>
</span>

<input type="submit" class="post-button" name="registracija" value="registriraj" />
</form>
<hr>
Prijavi uporabnika z geslom in email.<br>
<form id="login-form" class="toggle-form" method="post" action="../controller/requestHandler.php">
<span class="form-input-holder">
<label class="form-label" for="email">Elektronski naslov:</label><br>
<input type="text" class="form-field" name="email" value="" /><br>
<label class="form-label" for="geslo">Geslo:</label><br>
<input type="text" class="form-field" name="geslo" value="" /><br>
</span>

<input type="submit" class="post-button" name="prijava" value="prijavi" />
</form>
<hr>
Prijavi uporabnika z geslom in X.509 certifikatom.<br>
<form id="prijavax509-form" class="toggle-form" method="post" action="../controller/requestHandler.php">
<span class="form-input-holder">
<label class="form-label" for="geslo">Geslo:</label><br>
<input type="text" class="form-field" name="geslo" value="" /><br>
</span>

<input type="submit" class="post-button" name="prijavaX509" value="prijaviX509" />
</form>

<hr>
Odjavi katerega koli uporabnika.<br>
<form method="get" action="../controller/requestHandler.php">
<input type="submit" class="post-button" name="odjava" value="odjavi" />
</form>
</div>
<div>
<hr>
Posodobi uporabniski racun.<br>
<form id="registration-form" class="toggle-form" method="post" action="../controller/requestHandler.php">
<span class="form-input-holder">
<label class="form-label" for="ime">TargetID:</label><br>
<input type="text" class="form-field" name="target_id" value="" /><br>
<label class="form-label" for="ime">Ime:</label><br>
<input type="text" class="form-field" name="ime" value="" /><br>
<label class="form-label" for="ime">Priimek:</label><br>
<input type="text" class="form-field" name="priimek" value="" /><br>
<label class="form-label" for="ime">Elektronski naslov:</label><br>
<input type="text" class="form-field" name="email" value="" /><br>
<label class="form-label" for="ime">Naslov:</label><br>
<input type="text" class="form-field" name="naslov" value="" /><br>
<label class="form-label" for="ime">Telefonska stevilka:</label><br>
<input type="text" class="form-field" name="telefon" value="" /><br>
<label class="form-label" for="ime">Geslo:</label><br>
<input type="text" class="form-field" name="geslo" value="" /><br>
</span>

<input type="submit" class="post-button" name="posodobi" value="posodobi" />
</form>
</div>
<div>
<hr>
Ustvari uporabniski racun za prodajalca.<br>
<form id="p-creation-form" class="toggle-form" method="post" action="../controller/requestHandler.php">
<span class="form-input-holder">
<label class="form-label" for="ime">Ime:</label><br>
<input type="text" class="form-field" name="ime" value="" /><br>
<label class="form-label" for="ime">Priimek:</label><br>
<input type="text" class="form-field" name="priimek" value="" /><br>
<label class="form-label" for="ime">Elektronski naslov:</label><br>
<input type="text" class="form-field" name="email" value="" /><br>
<label class="form-label" for="ime">Geslo:</label><br>
<input type="text" class="form-field" name="geslo" value="" /><br>
</span>

<input type="submit" class="post-button" name="registracijaProdajalca" value="registrirajProdajalca" />
</form>
</div>
<div>
Aktiviraj uporabniski racun ID.<br>
<form id="registration-form" class="toggle-form" method="post" action="../controller/requestHandler.php">
<span class="form-input-holder">
<label class="form-label" for="target_id">ID:</label><br>
<input type="text" class="form-field" name="target_id" value="" /><br>
</span>

<input type="submit" class="post-button" name="aktiviraj" value="aktiviraj" />
</form>
<hr>
Deaktiviraj uporabniski racun ID.<br>
<form id="registration-form" class="toggle-form" method="post" action="../controller/requestHandler.php">
<span class="form-input-holder">
<label class="form-label" for="target_id">ID:</label><br>
<input type="text" class="form-field" name="target_id" value="" /><br>
</span>

<input type="submit" class="post-button" name="deaktiviraj" value="deaktiviraj" />
</form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</body>
</html>
