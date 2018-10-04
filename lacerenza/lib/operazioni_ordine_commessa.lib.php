<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.OrdiniCommessa.php");
require_once("../classi/class.Commesse.php");
require_once("../classi/class.Log.php");
session_start();

$tipo = $_POST['tipo'];
$log = new Log();

switch($tipo){
	case "inserimento":
		$id_commessa = $_POST['id_commessa'];
		$commessa = new Commesse();
		$e_query_commessa = $commessa->caricaCommesseById($id_commessa);
		$row_commessa = $e_query_commessa->fetch_array();
        $fornitore = $_POST['fornitore'];
		
		$ordine = new OrdiniCommessa();
		$e_query_inserimento = $ordine->inserisci($id_commessa, $row_commessa['codice'], $row_commessa['descrizione'], $fornitore);
		
		//LOG
		$log->inserisciLog("Inserimento ordine", $_SESSION['username'], "verde");
		echo $e_query_inserimento;
	break;
	
	case "elimina":
		$ordine = new OrdiniCommessa();
		$id = $_POST['id'];
		$id_commessa = $_POST['id_commessa'];

		$e_query_elimina = $ordine->elimina($id);
		
		if($e_query_elimina > 0){
			$dir = "../uploads/commesse/".$id_commessa."/ordini_commessa/".$id."/";
			function rrmdir($dir) {
		   if (is_dir($dir)) {
			 $objects = scandir($dir);
			 foreach ($objects as $object) {
			   if ($object != "." && $object != "..") {
				 if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
			   }
			 }
			 reset($objects);
			 rmdir($dir);
		   }
		 } 
		 rrmdir($dir);

		}
		//LOG
		$log->inserisciLog("Eliminazione ordine nella commessa", $_SESSION['username'], "rosso");
		echo $e_query_elimina;
		
	break;	
	
	case "elimina_allegato":
		$ordine = new OrdiniCommessa();
		$id = $_POST['id'];
		$id_commessa = $_POST['id_commessa'];
		$nome = $_POST['nome'];
		$e_query_elimina = $ordine->eliminaAllegato($id);
		if($e_query_elimina >= 0){
			//elimino fisicamente l'allegato
			$target_path = "../uploads/commesse/".$id_commessa."/ordini/".$nome;
			if (file_exists($target_path)) { 
				unlink($target_path);
			}
		}
		
		echo $e_query_elimina;
	break;
	
	case "modifica":
		$id = $_POST['id_da_modificare'];
		$fornitore = $_POST['fornitore'];
		
		$ordine = new OrdiniCommessa();
		$e_query_inserimento = $ordine->modifica($id, $fornitore);
		
		$log->inserisciLog("Modifica ordine", $_SESSION['username'], "blu");
		echo $e_query_inserimento;
	break;	
}	

?>