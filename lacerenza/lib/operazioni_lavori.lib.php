<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.Lavori.php");
require_once("../classi/class.Log.php");
session_start();

$tipo = $_POST['tipo'];
$log = new Log();

switch($tipo){
	case "inserimento":		
        $cod_lavoro = $_POST['cod_lavoro'];
        $descrizione = $_POST['descrizione'];
        $attivita = $_POST['attivita'];
        $lavorazione = $_POST['lavorazione'];

		$descrizione = StringInputCleaner($descrizione);
		//$descrizione = str_replace("°", "&deg;", $descrizione);
		
		$attivita = StringInputCleaner($attivita);
		//$attivita = str_replace("°", "&deg;", $attivita);
		
		
		$lavorazione = StringInputCleaner($lavorazione);
		//$lavorazione = str_replace("°", "&deg;", $lavorazione);
		
		$lavori = new Lavori();
		$e_query_inserimento = $lavori->inserisci($cod_lavoro, $descrizione, $attivita, $lavorazione);
		
		
		//LOG
		$log->inserisciLog("Inserimento attivita: ", $_SESSION['username'], "verde");
		echo $e_query_inserimento;
	break;
	
	case "elimina":
		$lavori = new Lavori();
		$id = $_POST['id'];
		$e_query_elimina = $lavori->elimina($id);
		
		//LOG
		$log->inserisciLog("Eliminazione attivita: id=".$id, $_SESSION['username'], "rosso");
		echo $e_query_elimina;
		
	break;	
	
	
	
	case "modifica":
		$id = $_POST['id_da_modificare'];
		 $cod_lavoro = $_POST['cod_lavoro'];
        $descrizione = $_POST['descrizione'];
        $attivita = $_POST['attivita'];
        $lavorazione = $_POST['lavorazione'];
	
	
		$descrizione = StringInputCleaner($descrizione);
		//$descrizione = str_replace("°", "&deg;", $descrizione);
		
		$attivita = StringInputCleaner($attivita);
		//$attivita = str_replace("°", "&deg;", $attivita);
		
		
		$lavorazione = StringInputCleaner($lavorazione);
		//$lavorazione = str_replace("°", "&deg;", $lavorazione);
		
		$lavori = new Lavori();
		$e_query_inserimento = $lavori->modifica($id, $cod_lavoro, $descrizione, $attivita, $lavorazione);
		
		$log->inserisciLog("Modifica attivita", $_SESSION['username'], "blu");
		echo $e_query_inserimento;
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