<?php

include_once(__DIR__ . '/../base/connect.php');
include_once('uporabniki.php');
include_once('artikli.php');

class Kosarica{
  private $Database, $uporabnik, $artikel;

	public function __construct(){
		$this->Database = new connectDB('epos');
		$this->uporabnik = new Uporabnik();
    $this->artikel = new Artikel();

		if(session_status() == PHP_SESSION_NONE){
			session_start();
		}

    if($this->uporabnik->jeStranka() && !isset($_SESSION['kosarica'])){
      $this->inicializiraj();
    }
	}

  public function inicializiraj(){
    if(!$this->uporabnik->jeStranka()){
      return -1;
    }

    $_SESSION['kosarica'] = [];
    $_SESSION['total'] = 0;
  }

  public function izbrisi(){
    if(isset($_SESSION['kosarica'])){
      unset($_SESSION['kosarica']);
    }
  }

  public function dodaj($idArtikel, $kolicina){
    if(!is_numeric($idArtikel) || !is_numeric($kolicina)){
      return -4;
    }

    $data = $this->artikel->opis($idArtikel);

    if($data == -1 || $data == -2){
      return $data;
    }

    if(isset($_SESSION['kosarica']) && isset($_SESSION['kosarica'][$idArtikel])){
      $_SESSION['kosarica'][$idArtikel]['kolicina'] += $kolicina;
      return 1;
    }else{
      $_SESSION['kosarica'][$idArtikel]['data'] = $data[0];
      $_SESSION['kosarica'][$idArtikel]['kolicina'] = $kolicina;
      return 2;
    }
  }

  public function odstrani($idArtikel, $kolicina){
    if(!is_numeric($idArtikel) || !is_numeric($kolicina)){
      return -4;
    }

    $_SESSION['kosarica'][$idArtikel]['kolicina'] -= $kolicina;

    if($_SESSION['kosarica'][$idArtikel]['kolicina'] <= 0){
      unset($_SESSION['kosarica'][$idArtikel]);
      if(count($_SESSION['kosarica']) > 0){
        return 2;
      }else{
        unset($_SESSION['kosarica']);
        return 3;
      }
    }

    return 0;
  }

  public function zakljuci(){
    $idNarocila = $this->Database->changeWithId("INSERT INTO epos.Narocila (idStranka, datum_narocila, stanje)
    VALUES (?,?, 'neobdelano')", [$_SESSION['session_id'], date('Y-m-d')]);

    foreach(array_keys($_SESSION['kosarica']) as $idArtikel){
      $artikel = $_SESSION['kosarica'][$idArtikel]['data'];

      $this->Database->change("INSERT INTO epos.Narocila_has_Artikli (idNarocilo, idArtikel, cena, kolicina, originalnoIme) VALUES (?,?,?,?,?)",
      [$idNarocila, $idArtikel, $artikel['cena'], $_SESSION['kosarica'][$idArtikel]['kolicina'], $artikel['ime']]);

        $this->odstrani($idArtikel, $_SESSION['kosarica'][$idArtikel]['kolicina']);
      }

    return 0;
  }

  public function opis(){
    return $_SESSION['kosarica'];
  }
}
