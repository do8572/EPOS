<?php

include_once(__DIR__ . '/../base/connect.php');

class uporabniskiRacun{
	private $Database;
	
	public function __construct(){
		$this->Database = new connectDB('epos');
		
		if(session_status() == PHP_SESSION_NONE){
			session_start();		
		}	
	}
	
	public function prijavljen(){
		return isset($_SESSION['loggedin']) &&
				 isset($_SESSION['session_id']) &&
				 isset($_SESSION['username']) &&
				 isset($_SESSION['type']) &&
				 $_SESSION['loggedin'] == TRUE;
	}
	
	public function jeStranka(){
		return $this->prijavljen() &&
				 $_SESSION['type'] == 'stranka';
	}
	
	public function jeProdajalec(){
		return $this->prijavljen() &&
				 $_SESSION['type'] == 'prodajalec';
	}
	
	public function jeAdministrator(){
		return $this->prijavljen() &&
				 $_SESSION['type'] == 'administrator';
	}
	
	public function preveriPodatke(){
		return TRUE;
	}
	
	public function registrirajSebe($ime, $priimek, $email, $naslov, $telefonska, $geslo){
		if($this->prijavljen()){
			return -1;		
		}
		
		if(!$this->preveriPodatke()){
			return -2;		
		}
		
		$hash = password_hash($geslo, PASSWORD_BCRYPT);
					
		if($this->Database->change("INSERT INTO epos.Uporabniki (vloga, ime, priimek,
		 `elektronski naslov`, geslo, naslov, `telefonska stevilka`, stanje) VALUES ('stranka', ?,?,?,?,?,?,'aktiviran')", 
		[$ime, $priimek, $email, $hash, $naslov, $telefonska])){
			return 0;
		}
		
		return -3;
	}
	
	public function registrirajStranko($ime, $priimek, $email, $geslo){
		if(!$this->jeProdajalec()){
			return -1;		
		}
		
		if(!$this->preveriPodatke()){
			return -2;		
		}
		
		$hash = password_hash($geslo, PASSWORD_BCRYPT);
					
		if($this->Database->change("INSERT INTO epos.Uporabniki (vloga, ime, priimek,
		 `elektronski naslov`, geslo, stanje) VALUES ('stranka', ?,?,?,?,'aktiviran')", 
		[$ime, $priimek, $email, $hash])){
			return 0;
		}
		
		return -3;
	}
	
	public function registrirajProdajalca($ime, $priimek, $email, $geslo){
		if(!$this->jeAdministrator()){
			return -1;		
		}
		
		if(!$this->preveriPodatke()){
			return -2;		
		}
		
		$hash = password_hash($geslo, PASSWORD_BCRYPT);
					
		if($this->Database->change("INSERT INTO epos.Uporabniki (vloga, ime, priimek,
		 `elektronski naslov`, geslo, stanje) VALUES ('prodajalec', ?,?,?,?,'aktiviran')", 
		[$ime, $priimek, $email, $hash])){
			return 0;
		}
		
		return -3;
	}
	
	public function prijavi($email, $geslo){
		$rowInUporabniki = $this->Database->retrieve("SELECT * FROM Uporabniki WHERE `elektronski naslov` = ?", [$email]);
		$hash = $rowInUporabniki[0]['geslo'];		
		
		if($hash == null){
			return -1;		
		}
		
		if(!password_verify($geslo, $hash)) {
			return $rowInUporabniki;
		}
		
		$_SESSION['loggedin'] = TRUE;
      $_SESSION["session_id"] = $rowInUporabniki[0]['idUporabnik'];
      $_SESSION["username"] = $rowInUporabniki[0]['ime'];
      $_SESSION["type"] = $rowInUporabniki[0]['vloga'];
		
		return 0;
	}
	
	public function prijaviX509($geslo){
		$client_cert = filter_input(INPUT_SERVER, "SSL_CLIENT_CERT");
		$cert_data = openssl_x509_parse($client_cert);
		$email = $cert_data['subject']['emailAddress'];
		
		return $this->prijavi($email, $geslo);
	}
	
	public function odjavi(){
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == TRUE){
            $_SESSION['loggedin'] = FALSE;
            unset($_SESSION["session_id"]);
            unset($_SESSION["username"]);
            unset($_SESSION["type"]);
            
            return 0;
      }
      
      return -1;	
	}	
	
	public function ustvariUporabniskiRacunProdajalec($ime, $priimek, $email, $geslo){
		if($this->prijavljen()){
			return -1;		
		}
		
		if(!$this->preveriPodatke()){
			return -2;		
		}
		
		if($_SESSION['type'] != 'administrator'){
			return -4;		
		}
		
		$hash = password_hash($geslo, PASSWORD_BCRYPT);
					
		if($this->Database->change("INSERT INTO epos.Uporabniki (vloga, ime, priimek,
		 `elektronski naslov`, geslo, stanje) VALUES ('prodajalec', ?,?,?,?,?,?,'aktiviran')", 
		[$ime, $priimek, $email, $hash])){
			return 0;
		}
		
		return -3;
	}
	
	public function ustvariUporabniskiRacunStranka(){
		if($this->prijavljen()){
			return -1;		
		}
		
		if(!$this->preveriPodatke()){
			return -2;		
		}
		
		if($_SESSION['type'] != 'prodajalec'){
			return -4;		
		}
		
		$hash = password_hash($geslo, PASSWORD_BCRYPT);
					
		if($this->Database->change("INSERT INTO epos.Uporabniki (vloga, ime, priimek,
		 `elektronski naslov`, geslo, naslov, `telefonska stevilka`, stanje) VALUES ('stranka', ?,?,?,?,?,?,'aktiviran')", 
		[$ime, $priimek, $email, $hash, $naslov, $telefonska])){
			return 0;
		}
		
		return -3;
	}
	
	public function posodobiPodatke(){
	
	}
	
	public function aktivirajUporabniskiRacun(){}
	
	public function deaktivirajUporabniskiRacun(){}
}

#TODO: prijavi se s pomocjo gesla in uporabniskega imena ali X.509 certifikata

#TODO: aktiviraj deaktiviraj nekoga nizjega