<?php

include_once(__DIR__ . '/../base/connect.php');
include_once('uporabniki.php');

class Narocila{
  private $Database, $uporabnik;

  public function __construct(){
		$this->Database = new connectDB('epos');
    $this->uporabnik = new Uporabnik();

		if(session_status() == PHP_SESSION_NONE){
			session_start();
		}
	}

  public function seznam($stanje){
    if($this->uporabnik->jeStranka()){
      return $this->Database->retrieve("SELECT * FROM epos.Narocila WHERE idStranka = ? AND stanje = ?",
      [$_SESSION['session_id'], $stanje]);
    }

    if($this->uporabnik->jeProdajalec()){
      return $this->Database->retrieve("SELECT * FROM epos.Narocila WHERE idProdajalec = ? AND stanje = ?",
      [$_SESSION['session_id'], $stanje]);
    }

    return -1;
  }

  public function opis($idNarocila){
    return $this->Database->retrieve("SELECT * FROM epos.Narocila_has_Artikli WHERE idNarocilo = ?",
    [$idNarocila]);
  }

  public function potrdi($idNarocila){
    if($this->uporabnik->jeProdajalec()){
      return $this->Database->change("UPDATE epos.Narocila SET stanje = 'potrjeno' WHERE
         stanje = 'neobdelano' AND idNarocilo = ? AND idProdajalec = ?",
      [$idNarocila, $_SESSION['session_id']]);
    }

    return -1;
  }

  public function preklici($idNarocila){
    if($this->uporabnik->jeProdajalec()){
      return $this->Database->change("UPDATE epos.Narocila SET stanje = 'preklicano' WHERE
         stanje = 'neobdelano' AND idNarocilo = ? AND idProdajalec = ?",
      [$idNarocila, $_SESSION['session_id']]);
    }

    return -1;
  }

  public function storniraj($idNarocila){
    if($this->uporabnik->jeProdajalec()){
      return $this->Database->change("UPDATE epos.Narocila SET stanje = 'stornirano' WHERE
         stanje = 'potrjeno' AND idNarocilo = ? AND idProdajalec = ?",
      [$idNarocila, $_SESSION['session_id']]);
    }

    return -1;
  }
}
