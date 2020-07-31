<?php

include_once(__DIR__ . '/../base/connect.php');
include_once('uporabniki.php');

class Artikel{
	private $Database, $uporabnik;

	public function __construct(){
		$this->Database = new connectDB('epos');
		$this->uporabnik = new Uporabnik();

		if(session_status() == PHP_SESSION_NONE){
			session_start();
		}
	}

	public function ustvari($ime, $opis, $cena){
		if(!$this->uporabnik->jeProdajalec()){
			return -1;
		}

		if($this->Database->change("INSERT INTO epos.Artikli (idProdajalec, ime, opis, cena, stanje)
		VALUES (?,?,?,?,'aktiviran')",
		[$_SESSION['session_id'], $ime, $opis, $cena])){
			return 0;
		}

		return -2;
	}

	public function opis($target_id){
		$data = $this->Database->retrieve("SELECT * FROM epos.Artikli WHERE idArtikel = ?", [$target_id]);

		if($data != null){
			return $data;
		}

		return -2;
	}

	public function posodobi($target_id, $ime, $opis, $cena){
		$rowInArtikli = $this->opis($target_id);

		if($rowInArtikli == -1 || $rowInArtikli == -2){
			return $rowInArtikli;
		}

		if($rowInArtikli[0]['idProdajalec'] != $_SESSION['session_id']){
			return -3;
		}

		if($this->Database->change("UPDATE epos.Artikli SET ime = ?, opis = ?,
		 cena = ? WHERE idArtikel = ?", [$ime, $opis, $cena, $target_id])){
			return 0;
		}

		return -4;
		}

		public function aktiviraj($target_id){
			$rowInArtikli = $this->opis($target_id);

			if($rowInArtikli == -1 || $rowInArtikli == -2){
				return $rowInArtikli;
			}

			if($rowInArtikli[0]['idProdajalec'] != $_SESSION['session_id']){
				return -3;
			}

			if($this->Database->change("UPDATE epos.Artikli SET stanje = 'aktiviran' WHERE idArtikel = ?",
			[$target_id])){
				return 0;
			}

			return -3;
		}

		public function deaktiviraj($target_id){
			$rowInArtikli = $this->opis($target_id);

			if($rowInArtikli == -1 || $rowInArtikli == -2){
				return $rowInArtikli;
			}

			if($rowInArtikli[0]['idProdajalec'] != $_SESSION['session_id']){
				return -3;
			}

			if($this->Database->change("UPDATE epos.Artikli SET stanje = 'deaktiviran' WHERE idArtikel = ?",
			[$target_id])){
				return 0;
			}

			return -3;
		}
}

class SeznamArtiklov{
	private $Database, $uporabnik;

	public function __construct(){
		$this->Database = new connectDB('epos');
		$this->uporabnik = new Uporabnik();

		if(session_status() == PHP_SESSION_NONE){
			session_start();
		}
	}

	public function izpis(){
		return $this->Database->retrieve("SELECT * FROM Artikli WHERE stanje = 'aktiviran'", []);
	}

	public function izpisVse(){
		return $this->Database->retrieve("SELECT * FROM Artikli", []);
	}
}
