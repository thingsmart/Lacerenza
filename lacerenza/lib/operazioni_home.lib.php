<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.Tagliandi.php");
require_once("../classi/class.Log.php");
session_start();

$tipo = $_POST['tipo'];
$log = new Log();

switch($tipo){
	
	case "allarme":
		$id = $_POST['id'];
		$id_mezzo = $_POST['id_mezzo'];
		$tabella = $_POST['tabella'];
		$query_allarme = "UPDATE $tabella SET eseguito = 1 WHERE id=$id;";
        $e_query_allarme = EseguiQuery($query_allarme,"inserimento");
		
		$log->inserisciLog("Eliminazione allarme", $_SESSION['username'], "rosso");
		echo $e_query_allarme;
	break;	
}	

?>