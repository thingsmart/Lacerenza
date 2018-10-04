<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.Comunicazioni.php");
require_once("../classi/class.Log.php");
session_start();

$tipo = $_POST['tipo'];
$log = new Log();

switch($tipo){
	case "inserimento":
		$dettagli_commessa = $_POST['dettagli_commessa'];
						
		$dati_commessa_esplosi = explode("-", $dettagli_commessa);
		$id_commessa = ($dati_commessa_esplosi[0] != "") ? $dati_commessa_esplosi[0] : -1;
		$descrizione_commessa = $dati_commessa_esplosi[1];

		$tipo_comunicazione = $_POST['tipo_comunicazione'];
		$testo = $_POST['testo'];
		$note = $_POST['note'];
		$data = $_POST['data'];
		$destinatario = $_POST['destinatario'];
		$destinatario_reale = $_POST['destinatario_reale'];
		$data = CapovolgiData($data);
		
		// $testo = str_replace("°", "&deg;", $testo);
		$testo = StringInputCleaner($testo);
		
		//$note = str_replace("°", "&deg;", $note);
		$note = StringInputCleaner($note);
		
		//$destinatario = str_replace("°", "&deg;", $destinatario);
		$destinatario = StringInputCleaner($destinatario);
		$destinatario_reale = StringInputCleaner($destinatario_reale);

		
		$comunicazioni = new Comunicazioni();
		$e_query_inserimento = $comunicazioni->inserisci($data, $id_commessa, $descrizione_commessa, $tipo_comunicazione, $destinatario, $testo, $note, $destinatario_reale);
		
		//LOG
		$log->inserisciLog("Inserimento magazzino", $_SESSION['username'], "verde");
		echo $e_query_inserimento;
	break;
	
	case "elimina":
		$comunicazioni = new Comunicazioni();
		$id = $_POST['id'];
		$e_query_elimina = $comunicazioni->elimina($id);
		
		if($e_query_elimina > 0){
		$dir = "../uploads/comunicazioni/".$id;
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
		$log->inserisciLog("Eliminazione comunicazione", $_SESSION['username'], "rosso");
		echo $e_query_elimina;
		
	break;	
	
	case "elimina_allegato":
		$comunicazioni = new Comunicazioni();
		$id_comunicazione = $_POST['id_comunicazione'];
		$nome = $_POST['nome'];
		$id_allegato= $_POST['id_allegato'];
		$e_query_elimina = $comunicazioni->eliminaAllegato($id_allegato);
		
		if($e_query_elimina >= 0){
			if($nome != ""){
				$target_path = "../uploads/comunicazioni/".$id_comunicazione."/".$nome;
				if (file_exists($target_path)) { 
					unlink($target_path);
				}
			}

		}
		//LOG
		$log->inserisciLog("Eliminazione allegato comunicazione", $_SESSION['username'], "rosso");
		echo $e_query_elimina;
		
	break;	
	
	case "allega":
		$id_comunicazione = $_POST['id_per_allegato'];
		$descrizione = $_POST['descrizione_allegato'];
		
		//perorso dove fare upload file
		$target_path = "../uploads/comunicazioni/".$id_comunicazione."/";
		$target_path_salva = "uploads/comunicazioni/".$id_comunicazione."/";
		//nome del file
		$filename = $_FILES['files']['name'];
		
		if($filename != ""){
			//creo cartella se non esiste
			if (!is_dir($target_path)) { 
				$crea = mkdir($target_path, 0777, true);
			}
            $link_file = "../uploads/comunicazioni/".$id_comunicazione."/".$filename;
            if (file_exists($link_file)) { 
                $filename = date("d_m_Y_h_i_s").$filename;
                $link_file = "../uploads/comunicazioni/".$id_comunicazione."/".$filename;
            }
			move_uploaded_file($_FILES["files"]["tmp_name"], $link_file);
		}
		
		$comunicazioni = new Comunicazioni();
		$e_query_inserimento = $comunicazioni->inserisciAllegato($id_comunicazione, $target_path_salva.$filename, $descrizione, $filename);
		
		//LOG
		$log->inserisciLog("Inserimento allegato comunicazione :".$filename, $_SESSION['username'], "rosso");
		
		echo $e_query_inserimento;
		
	break;	
	
	case "modifica":
		$id = $_POST['id'];
		$dettagli_commessa = $_POST['dettagli_commessa'];
						
		$dati_commessa_esplosi = explode("-", $dettagli_commessa);
		$id_commessa = ($dati_commessa_esplosi[0] != "") ? $dati_commessa_esplosi[0] : -1;
		$descrizione_commessa = $dati_commessa_esplosi[1];
		
		
		$tipo_comunicazione = $_POST['tipo_comunicazione'];
		$testo = $_POST['testo'];
		$note = $_POST['note'];
		$data = $_POST['data'];
		$destinatario = $_POST['destinatario'];
		$destinatario_reale = $_POST['destinatario_reale'];
		$data = CapovolgiData($data);
		
		$testo = StringInputCleaner($testo);
		//$testo = str_replace("°", "&deg;", $testo);
		
		$note = StringInputCleaner($note);
		//$note = str_replace("°", "&deg;", $note);

		$destinatario = StringInputCleaner($destinatario);
		$destinatario_reale = StringInputCleaner($destinatario_reale);
		//$destinatario = str_replace("°", "&deg;", $destinatario);
		
		$comunicazioni = new Comunicazioni();
		$e_query_modifica = $comunicazioni->modifica($id, $data, $id_commessa, $descrizione_commessa, $tipo_comunicazione, $destinatario, $testo, $note, $destinatario_reale);
		
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