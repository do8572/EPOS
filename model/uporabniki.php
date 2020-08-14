<?php

include_once(__DIR__ . '/../base/connect.php');

class Uporabnik{
	private $Database;

	public function __construct(){
		$this->Database = new connectDB('epos');

		if(session_status() == PHP_SESSION_NONE){
			session_start();
		}
	}

	public function jePrijavljen(){
		return isset($_SESSION['loggedin']) &&
				 isset($_SESSION['session_id']) &&
				 isset($_SESSION['username']) &&
				 isset($_SESSION['role']) &&
				 $_SESSION['loggedin'] == TRUE;
	}

	public function jeStranka(){
		return $this->jePrijavljen() &&
				 $_SESSION['role'] == 'stranka';
	}

	public function jeProdajalec(){
		return $this->jePrijavljen() &&
				 $_SESSION['role'] == 'prodajalec';
	}

	public function jeAdministrator(){
		return $this->jePrijavljen() &&
				 $_SESSION['role'] == 'administrator';
	}

	public function preveriPodatke($ime, $priimek, $email, $geslo, $naslov, $telefon){
		if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i",$email)){
			return FALSE;
		}

		return TRUE;
	}

	public function opis($target_id){
		if(!$this->jePrijavljen()){
			return null;
		}

		if($target_id == null){
			$target_id = $_SESSION['session_id'];
		}

		$data = $this->Database->retrieve("SELECT * FROM epos.Uporabniki WHERE idUporabnik = ?",
		 [$target_id]);

		 if($target_id != $_SESSION['session_id']){
			 $tar_role = $data[0]['vloga'];

			 if(($tar_role == 'stranka' && $_SESSION['role'] != 'prodajalec') ||
 				($tar_role == 'prodajalec' && $_SESSION['role'] != 'administrator') ||
				$tar_role == 'administrator'){
 					return -5;
 				}
		 }

		return $data;
	}

	public function ustvariAdministratorja(){
		if(!isset($_SERVER['HTTPS'])){
			return -1;
		}

		$hash = password_hash('epos', PASSWORD_BCRYPT);

		if($this->Database->change("INSERT INTO epos.Uporabniki (vloga, ime, priimek,
		 `elektronski naslov`, geslo, stanje) VALUES ('administrator', 'david', 'ocepek'
			 , 'do8572@student.uni-lj.si', ? ,'aktiviran')",
		[$hash])){
			return 0;
		}

		return -4;
	}

	public function registrirajStranko($ime, $priimek, $email, $geslo, $naslov, $telefonska){
		if(!isset($_SERVER['HTTPS'])){
			return -1;
		}

		if($this->jePrijavljen() && !$this->jeProdajalec()){
			return -2;
		}

		if(!$this->preveriPodatke($ime, $priimek, $email, $geslo, $naslov, $telefonska)){
			return -3;
		}

		$ime = htmlspecialchars($ime); $priimek = htmlspecialchars($priimek);
		$email = htmlspecialchars($email); $naslov = htmlspecialchars($naslov);
		$telefonska = htmlspecialchars($telefonska);

		$hash = password_hash($geslo, PASSWORD_BCRYPT);

		if(!$this->Database->change("INSERT INTO epos.Uporabniki (vloga, ime, priimek,
		 `elektronski naslov`, geslo, naslov, `telefonska stevilka`, stanje) VALUES ('stranka', ?,?,?,?,?,?,'aktiviran')",
		[$ime, $priimek, $email, $hash, $naslov, $telefonska])){
			return -4;
		}

		return 0;
	}

	public function registrirajProdajalca($ime, $priimek, $email, $geslo){
		if(!isset($_SERVER['HTTPS'])){
			return -1;
		}

		if(!$this->jeAdministrator()){
			return -2;
		}

		if(!$this->preveriPodatke($ime, $priimek, $email, $geslo, null, null)){
			return -3;
		}

		$ime = htmlspecialchars($ime); $priimek = htmlspecialchars($priimek);
		$email = htmlspecialchars($email);

		$hash = password_hash($geslo, PASSWORD_BCRYPT);

		if($this->Database->change("INSERT INTO epos.Uporabniki (vloga, ime, priimek,
		 `elektronski naslov`, geslo, stanje) VALUES ('prodajalec', ?,?,?,?,'aktiviran')",
		[$ime, $priimek, $email, $hash])){
			return 0;
		}

		return -4;
	}

	public function prijavi($email, $geslo){
		if(!isset($_SERVER['HTTPS'])){
			return -1;
		}

		if($this->jePrijavljen()){
			return -2;
		}

		session_regenerate_id();

		$rowInUporabniki = $this->Database->retrieve("SELECT * FROM Uporabniki WHERE `elektronski naslov` = ? AND stanje = 'aktiviran'", [$email]);

		if($rowInUporabniki == null){
			return -3;
		}

		$hash = $rowInUporabniki[0]['geslo'];

		if(!password_verify($geslo, $hash)) {
			return $hash;
		}

		$_SESSION['loggedin'] = TRUE;
      $_SESSION["session_id"] = $rowInUporabniki[0]['idUporabnik'];
      $_SESSION["username"] = $rowInUporabniki[0]['ime'];
      $_SESSION["role"] = $rowInUporabniki[0]['vloga'];

		return 0;
	}

	public function prijaviX509($geslo){
		if(!isset($_SERVER['HTTPS'])){
			return -1;
		}

		$client_cert = filter_input(INPUT_SERVER, "SSL_CLIENT_CERT");
		$cert_data = openssl_x509_parse($client_cert);
		$email = $cert_data['subject']['emailAddress'];

		return $this->prijavi($email, $geslo);
	}

	public function odjavi(){
		if(isset($_SESSION['kosarica'])){
			unset($_SESSION['kosarica']);
		}

		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == TRUE){
            $_SESSION['loggedin'] = FALSE;
            unset($_SESSION["session_id"]);
            unset($_SESSION["username"]);
            unset($_SESSION["role"]);

            return 0;
      }

      return -1;
	}

	public function posodobiRacun($target_id, $ime, $priimek, $email, $geslo, $telefon, $naslov){
		if(!isset($_SERVER['HTTPS'])){
			return -1;
		}

		if(!$this->jePrijavljen()){
			return -2;
		}

		if(!$this->preveriPodatke($ime, $priimek, $email, $geslo, $telefon, $naslov)){
			return $email;
		}

		if($target_id == null){
			$target_id = $_SESSION['session_id'];
		}

		if($target_id != $_SESSION['session_id']){
			$tar_role = $this->Database->retrieve("SELECT `vloga` FROM Uporabniki WHERE `idUporabnik` = ?", [$target_id]);

			if($tar_role == null){
				return -4;
			}

			if(($tar_role == 'stranka' && $_SESSION['role'] != 'prodajalec') ||
				($tar_role == 'prodajalec' && $_SESSION['role'] != 'administrator')){
					return -5;
				}
		}

		$ime = htmlspecialchars($ime); $priimek = htmlspecialchars($priimek);
		$email = htmlspecialchars($email);

		if($naslov != null){
			$naslov = htmlspecialchars($naslov);
		}
		if($telefon != null){
			$telefon = htmlspecialchars($telefon);
		}

		$hash = password_hash($geslo, PASSWORD_BCRYPT);

		if($this->Database->change("UPDATE epos.Uporabniki SET ime = ?, priimek = ?,
		 `elektronski naslov` = ?, geslo = ?, `telefonska stevilka` = ?, naslov = ? WHERE idUporabnik = ?",
		[$ime, $priimek, $email, $hash, $telefon, $naslov, $target_id])){
			return 0;
		}

		return -6;
	}

	public function aktivirajUporabniskiRacun($target_id){
		if(!$this->jePrijavljen()){
			return -1;
		}

		if($this->Database->change("UPDATE epos.Uporabniki SET stanje = 'aktiviran' WHERE idUporabnik = ?",
		[$target_id])){
			return 0;
		}

		return -3;
	}

	public function deaktivirajUporabniskiRacun($target_id){
		if(!$this->jePrijavljen()){
			return -1;
		}

		if($this->Database->change("UPDATE epos.Uporabniki SET stanje = 'deaktiviran' WHERE idUporabnik = ?",
		[$target_id])){
			return 0;
		}

		return -3;
	}

	public function seznam(){
		if(!$this->jePrijavljen() || $this->jeStranka()){
			return -1;
		}

		$tip = null;

		if($this->jeProdajalec()){
			$tip = 'stranka';
		}else{
			$tip = 'prodajalec';
		}

		return $this->Database->retrieve("SELECT * FROM epos.Uporabniki WHERE vloga = ?",
		 [$tip]);
	}
}
