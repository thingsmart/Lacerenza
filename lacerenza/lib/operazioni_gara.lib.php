<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.Gare.php");
require_once("../classi/class.Log.php");
session_start();

$tipo = $_POST['tipo'];
$log = new Log();

switch($tipo){
	case "inserimento":
		$data_emissione = $_POST['data_emissione'];
		$data_emissione = Capovolgidata($data_emissione);
		$data_scadenza = $_POST['data_scadenza'];
		$data_scadenza = Capovolgidata($data_scadenza);
        $descrizione = $_POST['descrizione'];
        $polizze = $_POST['polizze'];
        $avcp = $_POST['avcp'];
        $passoe = $_POST['passoe'];
        
		$descrizione = StringInputCleaner($descrizione);
		//$descrizione = str_replace("°", "&deg;", $descrizione);
		
		//nome del file
		$filename = $_FILES['files']['name'];
		
		$gare = new Gare();
		$e_query_inserimento = $gare->inserisci($descrizione, $data_emissione, $data_scadenza, $polizze, $avcp, $passoe);
		
		
		
		//LOG
		$log->inserisciLog("Inserimento gara: | id=".$e_query_inserimento, $_SESSION['username'], "verde");
		echo $e_query_inserimento;
	break;
	
	
	
	case "elimina":
		$gare = new Gare();
		$id = $_POST['id'];
		$e_query_elimina = $gare->elimina($id);
		if($e_query_elimina > 0){
			$dir = "../uploads/gare/".$id."/";
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
		$log->inserisciLog("Eliminazione gara: id=".$id, $_SESSION['username'], "rosso");
		echo $e_query_elimina;
		
	break;	
	
	// case "elimina_allegato":
		// $gare = new Gare();
		// $id = $_POST['id'];
		// $nome = $_POST['nome'];
		// $e_query_elimina = $gare->eliminaAllegato($id);
		// if($e_query_elimina >= 0){
			// //elimino fisicamente l'allegato
			// $dir = "../uploads/tecnica/".$id."/".$nome;
			// function rrmdir($dir) {
		   // if (is_dir($dir)) {
			 // $objects = scandir($dir);
			 // foreach ($objects as $object) {
			   // if ($object != "." && $object != "..") {
				 // if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
			   // }
			 // }
			 // reset($objects);
			 // rmdir($dir);
		   // }
		 // } 
		 // rrmdir($dir);
		// }
		// //LOG
		// $log->inserisciLog("Eliminazione allegato preventivo: ".$target_path, $_SESSION['username'], "rosso");
		// echo $e_query_elimina;
	// break;
	
	case "modifica":
		$id = $_POST['id_da_modificare'];
		$data_emissione = $_POST['data_emissione'];
		$data_emissione = Capovolgidata($data_emissione);
		$data_scadenza = $_POST['data_scadenza'];
		$data_scadenza = Capovolgidata($data_scadenza);
        $descrizione = $_POST['descrizione'];
        $polizze = $_POST['polizze'];
        $avcp = $_POST['avcp'];
        $passoe = $_POST['passoe'];
		
		$descrizione = StringInputCleaner($descrizione);
		//$descrizione = str_replace("°", "&deg;", $descrizione);
		
		
		$gare = new Gare();
		$e_query_inserimento = $gare->modifica($id, $descrizione, $data_emissione, $data_scadenza, $polizze, $avcp, $passoe);
		
		$log->inserisciLog("Modifica gara", $_SESSION['username'], "blu");
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