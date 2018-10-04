<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.Commesse.php");
require_once("../classi/class.Log.php");
session_start();

$tipo = $_POST['tipo'];
$log = new Log();

switch($tipo){

	case "aggiorna_data":
		$data = $_POST['da_data'];
		$data = CapovolgiData($data);
		$commessa = new Commesse();
		if($data != ""){
			$date = $commessa->getAllDate();
		}
		if($date->id != "" && $date->id != "0"){
			$commessa->modificaData($data, $date->id);
		} else {
			$commessa->inserisciData($data);
		}

		echo $res;
	break;

	case "inserimento":
		$codice = $_POST['codice'];
		$localita = $_POST['localita'];
		$data_inizio = $_POST['data_inizio'];
		$data_fine = $_POST['data_fine'];
		$descrizione = $_POST['descrizione'];
		$annotazioni = $_POST['annotazioni'];
		$data_inizio = CapovolgiData($data_inizio);
		$campo1 = $_POST['campo1'];
		$campo2 = $_POST['campo2'];
		$campo3 = $_POST['campo3'];
		$campo4 = $_POST['campo4'];
		$campo5 = $_POST['campo5'];
		$campo6 = $_POST['campo6'];

		$localita = StringInputCleaner($localita);
		//$localita = str_replace("°", "&deg;", $localita);
		
		$descrizione = StringInputCleaner($descrizione);
		//$descrizione = str_replace("°", "&deg;", $descrizione);
		
		
		$annotazioni = StringInputCleaner($annotazioni);
		//$annotazioni = str_replace("°", "&deg;", $annotazioni);
		if($data_fine != ""){
			$data_fine = CapovolgiData($data_fine);
		}
		$commessa = new Commesse();
		$e_query_inserimento = $commessa->inserisciCommessa($codice, $localita, $data_inizio, $data_fine, $descrizione, $annotazioni, $campo1, $campo2, $campo3, $campo4, $campo5, $campo6);
		
		//LOG
		$log->inserisciLog("Inserimento commessa", $_SESSION['username'], "verde");
		echo $e_query_inserimento;
	break;

	case "archivia":

		$id_commessa = $_POST['id'];
		$operazione = $_POST['operazione'];

		$valore_operazione;

		if($operazione == "archivia") {
			$valore_operazione = 1;
		} else {
			$valore_operazione = 0;
		}

		$commessa = new Commesse();
		$e_query_inserimento = $commessa->modificaArchiviazione($id_commessa, $valore_operazione);

		//LOG
		$log->inserisciLog("Archiviazione commessa", $_SESSION['username'], "verde");
		echo $e_query_inserimento;

	break;

	case "elimina":
		$commessa = new Commesse();
		$id = $_POST['id'];
		$e_query_elimina = $commessa->eliminaCommessa($id);
		if($e_query_elimina > 0){
		$dir = "../uploads/commesse/".$id;
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
		$log->inserisciLog("Eliminazione commessa", $_SESSION['username'], "rosso");
		echo $e_query_elimina;
		
	break;	
	
	case "modifica":
		$id_commessa = $_POST['id'];
		$codice = $_POST['codice'];
		$localita = $_POST['localita'];
		$data_inizio = $_POST['data_inizio'];
		$data_fine = $_POST['data_fine'];
		$descrizione = $_POST['descrizione'];
		$annotazioni = $_POST['annotazioni'];
		$data_inizio = CapovolgiData($data_inizio);
		$campo1 = $_POST['campo1'];
		$campo2 = $_POST['campo2'];
		$campo3 = $_POST['campo3'];
		$campo4 = $_POST['campo4'];
		$campo5 = $_POST['campo5'];
		$campo6 = $_POST['campo6'];

		$localita = StringInputCleaner($localita);
		// $localita = str_replace("°", "&deg;", $localita);
		
		$descrizione = StringInputCleaner($descrizione);
		// $descrizione = str_replace("°", "&deg;", $descrizione);
		
		
		$annotazioni = StringInputCleaner($annotazioni);
		// $annotazioni = str_replace("°", "&deg;", $annotazioni);
		
		if($data_fine != ""){
			$data_fine = CapovolgiData($data_fine);
			$risultato = delta_tempo($data_inizio, $data_fine, 'g');
		}
		if($risultato >= 0){
			$commessa = new Commesse();
			$e_query_inserimento = $commessa->modificaCommessa($id_commessa, $codice, $localita, $data_inizio, $data_fine, $descrizione, $annotazioni, $campo1, $campo2, $campo3, $campo4, $campo5, $campo6);
			if($e_query_inserimento >= 0){
				$commessa->modRuolinoDescrizione($id_commessa, $descrizione);
				$commessa->modProgrammazioneDescrizione($id_commessa, $descrizione);
				$commessa->modMagazzinoDescrizione($id_commessa, $descrizione);
			}
			//LOG
			$log->inserisciLog("Modifica commessa", $_SESSION['username'], "blu");
			echo $e_query_inserimento;
		} else {
			echo "error_data";	
		}
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