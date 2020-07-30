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
    $data = $this->artikel->opis($idArtikel);

    if($data == -1 || $data == -2){
      return $data;
    }

    $idProdajalec = $data[0]['idProdajalec'];

    if(isset($_SESSION['kosarica'][$idProdajalec]) &&
     isset($_SESSION['kosarica'][$idProdajalec][$idArtikel])){
      $_SESSION['kosarica'][$idProdajalec][$idArtikel] += $kolicina;
      return 1;
    }else{
      $_SESSION['kosarica'][$idProdajalec][$idArtikel] = $kolicina;
      return 2;
    }
  }

  public function odstrani($idArtikel, $kolicina){
    $idProdajalec = null;

    foreach(array_keys($_SESSION['kosarica']) as $Prodajalec){
      if(isset($_SESSION['kosarica'][$Prodajalec][$idArtikel])){
        $idProdajalec = $Prodajalec;
        break;
      }
    }

    if($idProdajalec == null){
      return -1;
    }

    $_SESSION['kosarica'][$idProdajalec][$idArtikel] -= $kolicina;

    if($_SESSION['kosarica'][$idProdajalec][$idArtikel] <= 0){
      unset($_SESSION['kosarica'][$idProdajalec][$idArtikel]);
      if(count($_SESSION['kosarica'][$idProdajalec]) != 0){
        return 2;
      }else{
        unset($_SESSION['kosarica'][$idProdajalec]);
        return 3;
      }
    }

    return 0;
  }

  public function zakljuci(){
    foreach(array_keys($_SESSION['kosarica']) as $idProdajalec){
      $idNarocila = $this->Database->changeWithId("INSERT INTO epos.Narocila (idProdajalec, idStranka, datum_narocila, stanje)
      VALUES (?,?,?, 'neobdelano')", [$idProdajalec, $_SESSION['session_id'], date('Y-m-d')]);

      foreach(array_keys($_SESSION['kosarica'][$idProdajalec]) as $idArtikel){
        $artikel = $this->artikel->opis($idArtikel)[0];

        $this->Database->change("INSERT INTO epos.Narocila_has_Artikli (idNarocilo, idArtikel, cena, kolicina) VALUES (?,?,?,?)",
      [$idNarocila, $idArtikel, $artikel['cena'], $_SESSION['kosarica'][$idProdajalec][$idArtikel]]);

        $this->odstrani($idArtikel, $_SESSION['kosarica'][$idProdajalec][$idArtikel]);
      }
    }

    return 0;
  }

  public function opis(){
    return $_SESSION['kosarica'];
  }
}
