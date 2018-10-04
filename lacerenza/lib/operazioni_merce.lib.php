<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.Magazzino.php");

require_once("../classi/class.Log.php");
session_start();

$tipo = $_POST['tipo'];
$log = new Log();

switch($tipo){
	case "inserimento":
		
		$id_testata_magazzino = $_POST['id_testata_magazzino'];
		$materiale = $_POST['materiale'];
		$quantita = $_POST['quantita'];
		$quantita = str_replace(",", ".", $quantita);
		$materiale = StringInputCleaner($materiale);
		
		$magazzino = new Magazzino();
		$e_query_inserimento = $magazzino->inserisci($id_testata_magazzino, $materiale, $quantita);
		
		//LOG
		$log->inserisciLog("Inserimento merce magazzino", $_SESSION['username'], "verde");
		echo $e_query_inserimento;
	break;
	
	case "elimina":
		$magazzino = new Magazzino();
		$id = $_POST['id'];
		$e_query_elimina = $magazzino->elimina($id);
		
		//LOG
		$log->inserisciLog("Eliminazione merce magazzino", $_SESSION['username'], "rosso");
		echo $e_query_elimina;
		
	break;	
	
	case "modifica":
		$id = $_POST['id'];
		$id_testata_magazzino = $_POST['id_testata_magazzino'];
		$materiale = $_POST['materiale'];
		$quantita = $_POST['quantita'];
		$quantita = str_replace(",", ".", $quantita);
		$materiale = StringInputCleaner($materiale);
		//$materiale = str_replace("°", "&deg;", $materiale);
		
		$magazzino = new Magazzino();
		$e_query_modifica = $magazzino->modifica($id, $id_testata_magazzino, $materiale, $quantita);
		
		//LOG
		$log->inserisciLog("Modifica magazzino", $_SESSION['username'], "verde");
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