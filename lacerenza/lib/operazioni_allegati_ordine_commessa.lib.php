<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.OrdiniCommessa.php");
require_once("../classi/class.Log.php");
session_start();

$tipo = $_POST['tipo_allegato'];
$log = new Log();

switch($tipo){
	
	
	case "allega_file":
		$id_ordine = $_POST['id_ordine'];
		$id_commessa = $_POST['id_commessa'];
		$descrizione = $_POST['descrizione_file'];
		$tipologia = $_POST['tipologia'];
		$data = $_POST['data'];
		$data = CapovolgiData($data);
		
		$descrizione = StringInputCleaner($descrizione);
		// $descrizione = str_replace("°", "&deg;", $descrizione);
        //perorso dove fare upload file
		$target_path = "../uploads/commesse/".$id_commessa."/ordini_commessa/".$id_ordine."/";
		$target_path_inserimento = "uploads/commesse/".$id_commessa."/ordini_commessa/".$id_ordine."/";
		
		//nome del file
		$filename = $_FILES['files']['name'];
		
		if($filename != ""){
			//creo cartella se non esiste
			if (!is_dir($target_path)) { 
				$crea = mkdir($target_path, 0777, true);
			}
			
			//elimino file caricati prima
            $link_file = "../uploads/commesse/".$id_commessa."/ordini_commessa/".$id_ordine."/".$filename;
            if (file_exists($link_file)) { 
                $filename = date("d_m_Y_h_i_s").$filename;
                $link_file = "../uploads/commesse/".$id_commessa."/ordini_commessa/".$id_ordine."/".$filename;
            }
		
			move_uploaded_file($_FILES["files"]["tmp_name"], $link_file);
		}
		
		 $ordini = new OrdiniCommessa();
		$e_query_inserimento = $ordini->inserisci_allegato($descrizione, $link_file, $filename, $id_ordine, $data, $tipologia);
		
		//LOG
		$log->inserisciLog("Inserimento allegato gara: ".$filename, $_SESSION['username'], "verde");
		echo $e_query_inserimento;
	break;
	
	
	
	case "elimina_allegato":
		$ordini = new OrdiniCommessa();
		$id = $_POST['id'];
		$id_ordine = $_POST['id_ordine'];
		$id_commessa = $_POST['id_commessa'];
		$nome = $_POST['nome'];
		$e_query_elimina = $ordini->elimina_allegato($id);
		
		if($e_query_elimina >= 0){
			//elimino fisicamente l'allegato
			$target_path = "../uploads/commesse/".$id_commessa."/ordini_commessa/".$id_ordine."/".$nome;
			if (file_exists($target_path)) { 
				unlink($target_path);
			}
		}
		
		//LOG
		$log->inserisciLog("Eliminazione allegato ordine commessa: ".$target_path, $_SESSION['username'], "rosso");
		echo $e_query_elimina;
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