<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.Utilizzo.php");
require_once("../classi/class.Log.php");
session_start();

$tipo = $_POST['tipo'];
$log = new Log();

switch($tipo){
	case "inserimento":
		$id_mezzo = $_POST['id_mezzo'];
		$id_commessa = $_POST['id_commessa'];
		$dettagli = $_POST['dettagli'];
		$n_ore = $_POST['n_ore'];
		$data = $_POST['data'];
		$data = Capovolgidata($data);
        $n_ore = str_replace(",", ".", $n_ore);
        
		$dettagli = StringInputCleaner($dettagli);
		//$dettagli = str_replace("°", "&deg;", $dettagli);
		
		$presenze = new Utilizzo();
		$e_query_inserimento = $presenze->inserisciUtilizzo($id_commessa, $id_mezzo, $data, $dettagli, $n_ore);
		
		//LOG
		$log->inserisciLog("Inserimento utilizzo mezzo", $_SESSION['username'], "verde");
		echo $e_query_inserimento;
	break;
	
	case "elimina":
		$presenze = new Utilizzo();
		$id = $_POST['id'];
		$e_query_elimina = $presenze->eliminaUtilizzo($id);
		
		//LOG
		$log->inserisciLog("Eliminazione utilizzo mezzo", $_SESSION['username'], "rosso");
		echo $e_query_elimina;
		
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