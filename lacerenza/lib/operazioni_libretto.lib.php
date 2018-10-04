<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.Libretto.php");
require_once("../classi/class.Log.php");
session_start();

$tipo = $_POST['tipo'];
$log = new Log();

switch($tipo){
	case "inserimento":
		$id_mezzo = $_POST['id_mezzo'];
		$descrizione = $_POST['descrizione'];
		$data = $_POST['data'];
		$data = Capovolgidata($data);
		$tipo_cartella = $_POST['tipo_cartella'];
		$cartella = $_POST['cartella'];


		$descrizione = StringInputCleaner($descrizione);

		//perorso dove fare upload file
		$target_path = "../uploads/".$cartella."/".$id_mezzo."/".$tipo_cartella."/";
		
		$costo = str_replace(",", ".", $costo);
		
		//nome del file
		$filename = $_FILES['files']['name'];
		
		if($filename != ""){
			//creo cartella se non esiste
			if (!is_dir($target_path)) { 
				$crea = mkdir($target_path, 0777, true);
			}
			
			//elimino file caricati prima
			 $link_file = "../uploads/".$cartella."/".$id_mezzo."/".$tipo_cartella."/".$filename;
		     if (file_exists($link_file)) { 
                 $filename = date("d_m_Y_h_i_s").$filename;
                 $link_file = "../uploads/".$cartella."/".$id_mezzo."/".$tipo_cartella."/".$filename;
             }
			move_uploaded_file($_FILES["files"]["tmp_name"], $link_file);
		}
		
		$libretto = new Libretto();
		$e_query_inserimento = $libretto->inserisci($id_mezzo, $descrizione, $data, $filename);
		
		//LOG
		$log->inserisciLog("Inserimento libretto", $_SESSION['username'], "verde");
		echo $e_query_inserimento;
	break;
	
	case "elimina":
		$libretto = new Libretto();
		$id = $_POST['id'];
		$id_mezzo = $_POST['id_mezzo'];
		$nome = $_POST['nome'];
		$e_query_elimina = $libretto->elimina($id);
		if($e_query_elimina > 0){
			if($nome != ""){
				$target_path = "../uploads/mezzi/".$id_mezzo."/libretto/".$nome;
				if (file_exists($target_path)) { 
					unlink($target_path);
				}
			}

		}
		//LOG
		$log->inserisciLog("Eliminazione libretto", $_SESSION['username'], "rosso");
		echo $e_query_elimina;
		
	break;	
	
	case "elimina_allegato":
		$libretto = new Libretto();
		$id = $_POST['id'];
		$id_mezzo = $_POST['id_mezzo'];
		$nome = $_POST['nome'];
		$e_query_elimina = $libretto->eliminaAllegato($id);
		if($e_query_elimina >= 0){
			//elimino fisicamente l'allegato
			$target_path = "../uploads/mezzi/".$id_mezzo."/libretto/".$nome;
			if (file_exists($target_path)) { 
				unlink($target_path);
			}
		}
		
		echo $e_query_elimina;
	break;
	
	case "modifica":
		$id = $_POST['id_da_modificare'];
		$id_mezzo = $_POST['id_mezzo'];
		$descrizione = $_POST['descrizione'];
		$data = $_POST['data'];
		$data = Capovolgidata($data);
		$tipo_cartella = $_POST['tipo_cartella'];
		$cartella = $_POST['cartella'];

		$descrizione = StringInputCleaner($descrizione);

		//perorso dove fare upload file
		$target_path = "../uploads/".$cartella."/".$id_mezzo."/".$tipo_cartella."/";
		
		//nome del file
		$filename = $_FILES['files']['name'];
		
		if($filename != ""){
			//creo cartella se non esiste
			if (!is_dir($target_path)) { 
				$crea = mkdir($target_path, 0777, true);
			}
			
			//elimino file caricati prima
			 $link_file = "../uploads/".$cartella."/".$id_mezzo."/".$tipo_cartella."/".$filename;
		     if (file_exists($link_file)) { 
                 $filename = date("d_m_Y_h_i_s").$filename;
                 $link_file = "../uploads/".$cartella."/".$id_mezzo."/".$tipo_cartella."/".$filename;
             }
			move_uploaded_file($_FILES["files"]["tmp_name"], $link_file);
		}
		
		$libretto = new Libretto();
		$e_query_inserimento = $libretto->modifica($id, $descrizione, $data, $filename);
		
		$log->inserisciLog("Modifica libretto", $_SESSION['username'], "blu");
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