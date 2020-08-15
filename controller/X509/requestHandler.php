<?php
include_once(__DIR__ . '/../../model/artikli.php');
include_once(__DIR__ . '/../../model/uporabniki.php');
include_once(__DIR__ . '/../../model/kosarica.php');
include_once(__DIR__ . '/../../model/narocila.php');

header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	#print_r($_POST);

	if(isset($_POST['registracija'])){
			$racun = new Uporabnik();
			$res = $racun->registrirajStranko($_POST['ime'],
			$_POST['priimek'], $_POST['email'], $_POST['geslo'], $_POST['naslov'], $_POST['telefon']);
			echo json_encode($res);
			exit;
	}elseif(isset($_POST['prijava'])) {
			$racun = new Uporabnik();
			$res = $racun->prijavi($_POST['email'], $_POST['geslo'], "stranka");
			echo json_encode($res);
			exit;
	}elseif(isset($_POST['prijavaX509'])){
			$racun = new Uporabnik();
			$res = $racun->prijaviX509($_POST['geslo']);
			echo json_encode($res);
			exit;
	}elseif(isset($_POST['ustvariAdministratorja'])){
			$racun = new Uporabnik();
			$res = $racun->ustvariAdministratorja();
			echo json_encode($res);
			exit;
	}elseif(isset($_POST['registracijaProdajalca'])){
		$racun = new Uporabnik();
		$res = $racun->registrirajProdajalca($_POST['ime'], $_POST['priimek'], $_POST['email'], $_POST['geslo']);
		echo json_encode($res);
		exit;
	}elseif(isset($_POST['posodobi'])){
		$racun = new Uporabnik();
		$res = $racun->posodobiRacun($_POST['target_id'], $_POST['ime'], $_POST['priimek'], $_POST['email'], $_POST['geslo'], $_POST['telefon'], $_POST['naslov']);
		echo json_encode($res);
		exit;
	}elseif(isset($_POST['aktiviraj'])){
		$racun = new Uporabnik();
		$res = $racun->aktivirajUporabniskiRacun($_POST['target_id']);
		echo json_encode($res);
		exit;
	}elseif(isset($_POST['deaktiviraj'])){
		$racun = new Uporabnik();
		$res = $racun->deaktivirajUporabniskiRacun($_POST['target_id']);
		echo json_encode($res);
		exit;
	}elseif(isset($_POST['ustvariArtikel'])){
		$artikel = new Artikel();
		$res = $artikel->ustvari($_POST['ime'], $_POST['opis'], $_POST['cena']);
		echo json_encode($res);
		exit;
	}elseif(isset($_POST['posodobiArtikel'])){
		$artikel = new Artikel();
		$res = $artikel->posodobi($_POST['target_id'], $_POST['ime'], $_POST['opis'], $_POST['cena']);
		echo json_encode($res);
		exit;
	}elseif(isset($_POST['aktivirajArtikel'])){
		$artikel = new Artikel();
		$res = $artikel->aktiviraj($_POST['target_id']);
		echo json_encode($res);
		exit;
	}elseif(isset($_POST['deaktivirajArtikel'])){
		$artikel = new Artikel();
		$res = $artikel->deaktiviraj($_POST['target_id']);
		echo json_encode($res);
		exit;
	}elseif(isset($_POST['zakljuciNakup'])){
		$kosarica = new Kosarica();
		$res = $kosarica->zakljuci();
		#print_r($_SESSION);
		echo json_encode($res);
		exit;
	}elseif(isset($_POST['potrdiNarocilo'])){
		$narocila = new Narocila();
		$res = $narocila->potrdi($_POST['target_id']);
		#print_r($res);
		echo json_encode($res);
		exit;
	}elseif(isset($_POST['prekliciNarocilo'])){
		$narocila = new Narocila();
		$res = $narocila->preklici($_POST['target_id']);
		#print_r($res);
		echo json_encode($res);
		exit;
	}elseif(isset($_POST['stornirajNarocilo'])){
		$narocila = new Narocila();
		$res = $narocila->storniraj($_POST['target_id']);
		#print_r($res);
		echo json_encode($res);
		exit;
	}
}elseif($_SERVER['REQUEST_METHOD'] == 'GET') {
	#print_r($_GET);

	if(isset($_GET['odjava'])){
			$racun = new Uporabnik();
			$res = $racun->odjavi();
			echo json_encode($res);
			exit;
	}elseif(isset($_GET['opisArtikla'])){
		$artikel = new Artikel();
		$res = $artikel->opis($_GET['target_id']);
		echo json_encode($res);
		exit;
	}elseif(isset($_GET['izpisArtiklov'])){
		$seznam = new SeznamArtiklov();
		$res = $seznam->izpis();
		echo json_encode($res);
		exit;
	}elseif(isset($_GET['izpisVsihArtiklov'])){
		$seznam = new SeznamArtiklov();
		$res = $seznam->izpisVse();
		echo json_encode($res);
		exit;
	}elseif(isset($_GET['dodajArtikel'])){
		$seznam = new Kosarica();
		$res = $seznam->dodaj($_GET['target_id'], $_GET['kolicina']);
		#print_r($_SESSION);
		echo json_encode($res);
		exit;
	}elseif(isset($_GET['odstraniArtikel'])){
		$seznam = new Kosarica();
		$res = $seznam->odstrani($_GET['target_id'], $_GET['kolicina']);
		#print_r($_SESSION);
		echo json_encode($res);
		exit;
	}elseif(isset($_GET['opisNarocila'])){
		$narocila = new Narocila();
		$res = $narocila->opis($_GET['target_id']);
		echo json_encode($res);
		exit;
	}elseif(isset($_GET['seznamNarocil'])){
		$narocila = new Narocila();
		$res = $narocila->seznam($_GET['stanje']);
		echo json_encode($res);
		exit;
	}elseif(isset($_GET['opisUporabnika'])){
			$racun = new Uporabnik();
			$res = $racun->opis($_GET['target_id']);
			echo json_encode($res);
			exit;
	}elseif(isset($_GET['izpisKosarica'])){
			$kosarica = new Kosarica();
			$res = $kosarica->opis();
			echo json_encode($res);
			exit;
	}elseif(isset($_GET['seznamUporabnikov'])){
			$racun = new Uporabnik();
			$res = $racun->seznam();
			echo json_encode($res);
			exit;
	}
}
