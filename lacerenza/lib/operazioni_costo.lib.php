<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.Log.php");
require_once("../classi/class.Costi.php");


session_start();

$tipo = $_POST['tipo'];
$log = new Log();

switch($tipo){
	case "inserimento":
		$mese = $_POST['mese'];
		$anno = $_POST['anno'];
		$costo = $_POST['costo'];
		$id_dipendente = $_POST['id_dipendente'];
		$id_commessa = $_POST['id_commessa'];
		$mese_per_data = mese_data ($mese);
		
		if($mese_per_data == "13"){
			$data_inizio = "0000-00-00";
			$data_fine = "0000-00-00";
		} else {
			$giorni_mese = date("t", strtotime("$anno-$mese_per_data-01"));
			$data_inizio = $anno."-".$mese_per_data."-01";
			$data_fine = $anno."-".$mese_per_data."-".$giorni_mese;
		}
		$costo = str_replace(",", ".", $costo);
		$costi = new Costi();
		$e_query_inserimento = $costi->inserisciCosto($id_dipendente, $costo, $mese, $anno, $data_inizio, $data_fine, $id_commessa);
		//LOG
		$log->inserisciLog("Inserimento costo", $_SESSION['username'], "verde");
		echo $e_query_inserimento;
        break;
		
		case "modifica":
		$id = $_POST['id'];
		$costo = $_POST['costo'];
		
	
		$costo = str_replace(",", ".", $costo);
		$costi = new Costi();
		$e_query_inserimento = $costi->modificaCosto($id, $costo);
		//LOG
		$log->inserisciLog("Modifica costo", $_SESSION['username'], "verde");
		echo $e_query_inserimento;
        break;
	
	case "elimina":
		$costi = new Costi();
		$id = $_POST['id'];
        $e_query_elimina = $costi->eliminaCosto($id);
        //LOG
		$log->inserisciLog("Eliminazione costo", $_SESSION['username'], "rosso");
        echo $e_query_elimina;
		
        break;	
    
}	

function mese_data ($mese) {

	 
	switch($mese) {
		case "GENNAIO": $mese_finale = "01"; break; //MINUTI
		case "FEBBRAIO": $mese_finale = "02"; break; //MINUTI
		case "MARZO": $mese_finale = "03"; break; //MINUTI
		case "APRILE": $mese_finale = "04"; break; //MINUTI
		case "MAGGIO": $mese_finale = "05"; break; //MINUTI
		case "GIUGNO": $mese_finale = "06"; break; //MINUTI
		case "LUGLIO": $mese_finale = "07"; break; //MINUTI
		case "AGOSTO": $mese_finale = "08"; break; //MINUTI
		case "SETTEMBRE": $mese_finale = "09"; break; //MINUTI
		case "OTTOBRE": $mese_finale = "10"; break; //MINUTI
		case "NOVEMBRE": $mese_finale = "11"; break; //MINUTI
		case "DICEMBRE": $mese_finale = "12"; break; //MINUTI		
		case "ANNUALE": $mese_finale = "13"; break; //MINUTI		
			}
	 
	return $mese_finale;
}
?>