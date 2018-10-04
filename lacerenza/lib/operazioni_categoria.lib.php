<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.Categorie.php");
require_once("../classi/class.Log.php");
session_start();

$tipo = $_POST['tipo'];
$log = new Log();

switch($tipo){
	case "inserimento":
		$id_verbale = $_POST['id_verbale'];
		$descrizione = $_POST['descrizione'];
		$importo = $_POST['importo'];        
		$descrizione = StringInputCleaner($descrizione);
		//$descrizione = str_replace("°", "&deg;", $descrizione);
		$importo = str_replace(",", ".", $importo);
		$categoria = new Categorie();
		$e_query_inserimento = $categoria->inserisciCategoria($id_verbale, $descrizione, $importo);
		
		//LOG
		$log->inserisciLog("Inserimento categoria verbale", $_SESSION['username'], "verde");
		echo $e_query_inserimento;
	break;
	
	case "elimina":
		$categoria = new Categorie();
		$id = $_POST['id'];
		$e_query_elimina = $categoria->eliminaCategoria($id);
		
		//LOG
		$log->inserisciLog("Eliminazione categoria verbale", $_SESSION['username'], "rosso");
		echo $e_query_elimina;
		
	break;	
	
	
	
	case "modifica":
		$id = $_POST['id_da_modificare'];
		$id_verbale = $_POST['id_verbale'];
		$descrizione = $_POST['descrizione'];
		$importo = $_POST['importo'];   
        $descrizione = StringInputCleaner($descrizione);
		//$descrizione = str_replace("°", "&deg;", $descrizione);
		$importo = str_replace(",", ".", $importo);

		$categoria = new Categorie();
		$e_query_inserimento = $categoria->modificaFattura($id, $descrizione, $importo);
		
		$log->inserisciLog("Modifica categoria verbale", $_SESSION['username'], "blu");
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