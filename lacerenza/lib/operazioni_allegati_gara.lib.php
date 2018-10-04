<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.Gare.php");
require_once("../classi/class.Log.php");
session_start();

$tipo = $_POST['tipo_allegato'];
$log = new Log();

switch($tipo){
	
	
	case "allega_file":
		$id_gara = $_POST['id_gara'];
		$descrizione = $_POST['descrizione_file'];
		
		$descrizione = StringInputCleaner($descrizione);
		//$descrizione = str_replace("°", "&deg;", $descrizione);
		
        //perorso dove fare upload file
		$target_path = "../uploads/gare/".$id_gara."/";
		$target_path_inserimento = "uploads/gare/".$id_gara."/";
		
		//nome del file
		$filename = $_FILES['files']['name'];
		
		if($filename != ""){
			//creo cartella se non esiste
			if (!is_dir($target_path)) { 
				$crea = mkdir($target_path, 0777, true);
			}
			
			//elimino file caricati prima
            $link_file = "../uploads/gare/".$id_gara."/".$filename;
            if (file_exists($link_file)) { 
                $filename = date("d_m_Y_h_i_s").$filename;
                $link_file = "../uploads/gare/".$id_gara."/".$filename;
            }
		
			move_uploaded_file($_FILES["files"]["tmp_name"], $link_file);
		}
		
		 $gare = new Gare();
		$e_query_inserimento = $gare->inserisci_allegato($descrizione, $target_path_inserimento, $filename, $id_gara);
		
		//LOG
		$log->inserisciLog("Inserimento allegato gara: ".$filename, $_SESSION['username'], "verde");
		echo $e_query_inserimento;
	break;
	
	case "elimina":
		$gare = new Gare();
		$id = $_POST['id'];
		$e_query_elimina = $gare->elimina_allegato($id);
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
	
	case "elimina_allegato":
		$gare = new Gare();
		$id = $_POST['id'];
		$id_gara = $_POST['id_gara'];
		$nome = $_POST['nome'];
		$e_query_elimina = $gare->eliminaAllegati($id);
		// if($e_query_elimina >= 0){
			// //elimino fisicamente l'allegato
			// $dir = "../uploads/gare/".$id_gara."/".$nome;
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
		
		if($e_query_elimina >= 0){
			//elimino fisicamente l'allegato
			$target_path = "../uploads/gare/".$id_gara."/".$nome;
			if (file_exists($target_path)) { 
				unlink($target_path);
			}
		}
		
		//LOG
		$log->inserisciLog("Eliminazione allegato gara: ".$target_path, $_SESSION['username'], "rosso");
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