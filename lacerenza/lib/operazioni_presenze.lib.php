<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.Presenze.php");
require_once("../classi/class.Log.php");
session_start();

$tipo = $_POST['tipo'];
$log = new Log();

switch($tipo){
	case "inserimento":
		$id_dipendente = $_POST['id_dipendente'];
		$dettagli_commessa = $_POST['dettagli_commessa'];
		$dati_esplosi = explode("-", $dettagli_commessa);
		$id_commessa = $dati_esplosi[0];
		$costo = $_POST['costo'];
		$costo = str_replace(",", ".", $costo);
		
		$dettagli = $_POST['dettagli'];
		$n_ore = $_POST['n_ore'];
		$data = $_POST['data_giorno'];
		$data = $data;
        $n_ore = str_replace(",", ".", $n_ore);
        
		$presenze = new Presenze();
		$e_query_inserimento = $presenze->inserisciPresenza($id_commessa, $id_dipendente, $data, $dettagli, $n_ore, $costo);
		
		//LOG
		$log->inserisciLog("Inserimento presenza", $_SESSION['username'], "verde");
		echo $e_query_inserimento;
	break;
	
	case "elimina":
		$presenze = new Presenze();
		$id = $_POST['id'];
		$e_query_elimina = $presenze->eliminaPresenza($id);
		
		//LOG
		$log->inserisciLog("Eliminazione presenza", $_SESSION['username'], "rosso");
		echo $e_query_elimina;
		
	break;	
	
	
}	

?>