<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.Tecnica.php");
require_once("../classi/class.Log.php");
session_start();

$tipo = $_POST['tipo'];
$log = new Log();

switch($tipo){
	case "inserimento":
		$data = $_POST['data'];
		$data = Capovolgidata($data);
        $num_preventivo = $_POST['num_preventivo'];
        $cliente = $_POST['cliente'];
		
        $sopraluogo = $_POST['sopraluogo'];
        $offerta = $_POST['offerta'];
        $operatore = $_POST['operatore'];
        $ricontatti = $_POST['ricontatti'];
        $esito = $_POST['esito'];
        $tipo_cliente = $_POST['tipo_cliente'];
        $tipo_sede = $_POST['tipo_sede'];
        $motivazione = $_POST['motivazione'];
        $data_acquisizione = $_POST['data_acquisizione'];
		if($data_acquisizione != ""){
		$data_acquisizione = Capovolgidata($data_acquisizione);
		} 
        $modalita = $_POST['modalita'];
		
		$cliente = StringInputCleaner($cliente);
		//$cliente = str_replace("°", "&deg;", $cliente);
		
		$sopraluogo = StringInputCleaner($sopraluogo);
		//$sopraluogo = str_replace("°", "&deg;", $sopraluogo);
		
		$motivazione = StringInputCleaner($motivazione);
		//$motivazione = str_replace("°", "&deg;", $motivazione);
        //perorso dove fare upload file
		
		
		//nome del file
		$filename = $_FILES['files']['name'];
		
		$tecnica = new Tecnica();
		$e_query_inserimento = $tecnica->inserisci($num_preventivo, $cliente, $sopraluogo, $data, $offerta, $operatore, $ricontatti, $esito, $tipo_cliente, $tipo_sede, $motivazione, $data_acquisizione, $modalita, $link_file);
		
		if($e_query_inserimento > 0){
			$target_path = "../uploads/tecnica/".$e_query_inserimento."/";
			$target_path_inserimento = "uploads/tecnica/".$e_query_inserimento."/".$filename;
			if($filename != ""){
				//creo cartella se non esiste
				if (!is_dir($target_path)) { 
					$crea = mkdir($target_path, 0777, true);
				}
				
				//elimino file caricati prima
	            $link_file = "../uploads/tecnica/".$e_query_inserimento."/".$filename;
	            if (file_exists($link_file)) { 
	                $filename = date("d_m_Y_h_i_s").$filename;
	                $link_file = "../uploads/tecnica/".$e_query_inserimento."/".$filename;
	            }
			
				move_uploaded_file($_FILES["files"]["tmp_name"], $link_file);
				$tecnica->modificaLink($e_query_inserimento, $target_path_inserimento);
			}
			
		}
		
		
		//LOG
		$log->inserisciLog("Inserimento preventivo: ".$tipo_documento." | id=".$e_query_inserimento, $_SESSION['username'], "verde");
		echo $e_query_inserimento;
	break;
	
	case "elimina":
		$tecnica = new Tecnica();
		$id = $_POST['id'];
		$nome = $_POST['nome'];
		$e_query_elimina = $tecnica->elimina($id);
		if($e_query_elimina > 0){
			$dir = "../uploads/tecnica/".$id."/".$nome;
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
		$log->inserisciLog("Eliminazione tecnica: id=".$id, $_SESSION['username'], "rosso");
		echo $e_query_elimina;
		
	break;	
	
	case "elimina_allegato":
		$tecnica = new Tecnica();
		$id = $_POST['id'];
		$nome = $_POST['nome'];
		$e_query_elimina = $tecnica->eliminaAllegato($id);
		if($e_query_elimina >= 0){
			//elimino fisicamente l'allegato
			$dir = "../uploads/tecnica/".$id."/".$nome;
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
		$log->inserisciLog("Eliminazione allegato preventivo: ".$target_path, $_SESSION['username'], "rosso");
		echo $e_query_elimina;
	break;
	
	case "modifica":
		$id = $_POST['id_da_modificare'];
		$data = $_POST['data'];
		$data = Capovolgidata($data);
        $num_preventivo = $_POST['num_preventivo'];
        $cliente = $_POST['cliente'];
        $sopraluogo = $_POST['sopraluogo'];
        $offerta = $_POST['offerta'];
        $operatore = $_POST['operatore'];
        $ricontatti = $_POST['ricontatti'];
        $esito = $_POST['esito'];
        $tipo_cliente = $_POST['tipo_cliente'];
        $tipo_sede = $_POST['tipo_sede'];
        $motivazione = $_POST['motivazione'];
        $data_acquisizione = $_POST['data_acquisizione'];
		$data_acquisizione = Capovolgidata($data_acquisizione);
        $modalita = $_POST['modalita'];

		
		$cliente = StringInputCleaner($cliente);
		//$cliente = str_replace("°", "&deg;", $cliente);
		
		$sopraluogo = StringInputCleaner($sopraluogo);
		//$sopraluogo = str_replace("°", "&deg;", $sopraluogo);
		
		$motivazione = StringInputCleaner($motivazione);
		//$motivazione = str_replace("°", "&deg;", $motivazione);
		
		//nome del file
		$filename = $_FILES['files']['name'];
		//perorso dove fare upload file
		
		
		if($filename != ""){
			$target_path = "../uploads/tecnica/".$id."/";
		$target_path_inserimento = "uploads/tecnica/".$id."/".$filename;
			//creo cartella se non esiste
			if (!is_dir($target_path)) { 
				$crea = mkdir($target_path, 0777, true);
			}
			
			
            $link_file = "../uploads/tecnica/".$id."/".$filename;
		    if (file_exists($link_file)) { 
                $filename = date("d_m_Y_h_i_s").$filename;
                $link_file = "../uploads/tecnica/".$id."/".$filename;
            }
			move_uploaded_file($_FILES["files"]["tmp_name"], $link_file);
		}
		
		$tecnica = new Tecnica();
		$e_query_inserimento = $tecnica->modifica($id, $num_preventivo, $cliente, $sopraluogo, $data, $offerta, $operatore, $ricontatti, $esito, $tipo_cliente, $tipo_sede, $motivazione, $data_acquisizione, $modalita, $target_path_inserimento);
		
		$log->inserisciLog("Modifica preventivo", $_SESSION['username'], "blu");
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