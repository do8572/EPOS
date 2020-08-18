<?php

include_once(__DIR__ . '/../base/connect.php');

class Artikel{
	public function __construct(){}	
	
	public function ustvari(){}
	
	public function opis(){}
	
	public function posodobi(){}
	
	public function aktiviraj(){}
	
	public function deaktiviraj(){}
}

class SeznamArtiklov{
	private $Database;
	
	public function __construct(){
		$this->Database = new connectDB('epos');
		
		if(session_status() == PHP_SESSION_NONE){
			session_start();		
		}	
	}	
	
	public function izpis(){
		$this->Database->retrieve("SELECT * FROM Artikli", []);		
	}	
}
