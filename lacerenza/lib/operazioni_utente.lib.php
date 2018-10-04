<?php
include("../databases/db_function.php");

require_once("../classi/class.Utenti.php");
session_start();

$tipo = $_POST['tipo'];

switch($tipo){
	case "inserimento":
		$username = $_POST['username'];
		$password = $_POST['password'];
		$ruolo = $_POST['ruolo'];
		$nome = $_POST['nome'];
		$cognome = $_POST['cognome'];
		$mansione = $_POST['mansione'];
		$email = $_POST['email'];
		
		$nome = StringInputCleaner($nome);
		$cognome = StringInputCleaner($cognome);
		$mansione = StringInputCleaner($mansione);
		
		$utenti = new Utenti();
		$e_query_inserimento = $utenti->inserisciUtente($username, $password, $ruolo, $nome, $cognome, $mansione, $email);
		echo $e_query_inserimento;
	break;
	
	case "elimina":
		$utenti = new Utenti();
		$id = $_POST['id'];
		$username = $_POST['username'];
		if($username != $_SESSION['username']){
			$e_query_elimina = $utenti->eliminaUtente($id);
			echo $e_query_elimina;
		} else {
			echo "error";	
		}
	break;	
	
	case "modifica":
		$utenti = new Utenti();
		$id = $_POST['id'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$ruolo = $_POST['ruolo'];	
		$nome = $_POST['nome'];
		$cognome = $_POST['cognome'];
		$mansione = $_POST['mansione'];
		$email = $_POST['email'];
		
		$nome = StringInputCleaner($nome);
		$cognome = StringInputCleaner($cognome);
		$mansione = StringInputCleaner($mansione);
		
		$e_query_modifica = $utenti->modificaUtente($username, $password, $ruolo, $id, $nome, $cognome, $mansione, $email);
		echo $e_query_modifica;
	break;	
}	

//To SANITIZE String value use
function StringInputCleaner($data) {
	//remove space bfore and after
	$data = trim($data);
	//remove slashes
	$data = stripslashes($data);
	$data = (filter_var($data, FILTER_SANITIZE_STRING));
	$data = utf8_encode($data);
	return $data;
}

?>