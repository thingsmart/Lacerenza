<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.Tagliandi.php");
require_once("../classi/class.Log.php");
//require_once("../classi/class.Mezzi.php");
session_start();

$tipo = $_POST['tipo'];
$log = new Log();

switch($tipo){
	case "inserimento":
		$id_mezzo = $_POST['id_mezzo'];
		$tipo_tagliando = $_POST['tipo_tagliando'];
		$data_tagliando = $_POST['data_tagliando'];
		$costo = $_POST['costo'];
		$data_tagliando = Capovolgidata($data_tagliando);
		$tipo_cartella = $_POST['tipo_cartella'];
		$cartella = $_POST['cartella'];
		$tagliando_ogni = $_POST['tagliando_ogni'];
		$tagliando_prossimo = $_POST['tagliando_prossimo'];
		$colore = $_POST['colore'];
		
		$tipo_tagliando = StringInputCleaner($tipo_tagliando);
		//$tipo_tagliando = str_replace("°", "&deg;", $tipo_tagliando);
		$costo = str_replace(",", ".", $costo);
		
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
		
		$tagliando = new Tagliandi();
		$e_query_inserimento = $tagliando->inserisciTagliando($id_mezzo, $tipo_tagliando, $data_tagliando, $costo, $filename, $tagliando_ogni, $colore, $tagliando_prossimo);
//		if($e_query_inserimento >= 0){
//			$mezzo = new Mezzi();
//			$mezzo->modificaKm($id_mezzo, $tagliando_ogni);
//		}
		//LOG
		$log->inserisciLog("Inserimento tagliando", $_SESSION['username'], "verde");
		echo $e_query_inserimento;
	break;
	
	case "elimina":
		$tagliando = new Tagliandi();
		$id = $_POST['id'];
		$id_mezzo = $_POST['id_mezzo'];
		$nome = $_POST['nome'];
		$e_query_elimina = $tagliando->eliminaTagliando($id);
		if($e_query_elimina > 0){
			if($nome != ""){
				$target_path = "../uploads/mezzi/".$id_mezzo."/tagliandi/".$nome;
				if (file_exists($target_path)) { 
					unlink($target_path);
				}
			}

		}
		//LOG
		$log->inserisciLog("Eliminazione tagliando", $_SESSION['username'], "rosso");
		echo $e_query_elimina;
		
	break;	
	
	case "elimina_allegato":
		$tagliando = new Tagliandi();
		$id = $_POST['id'];
		$id_mezzo = $_POST['id_mezzo'];
		$nome = $_POST['nome'];
		$e_query_elimina = $tagliando->eliminaAllegato($id);
		if($e_query_elimina >= 0){
			//elimino fisicamente l'allegato
			$target_path = "../uploads/mezzi/".$id_mezzo."/tagliandi/".$nome;
			if (file_exists($target_path)) { 
				unlink($target_path);
			}
		}
		
		echo $e_query_elimina;
	break;
	
	case "modifica":
		$id = $_POST['id_da_modificare'];
		$id_mezzo = $_POST['id_mezzo'];
		$tipo_tagliando = $_POST['tipo_tagliando'];
		$data_tagliando = $_POST['data_tagliando'];
		$costo = $_POST['costo'];
		$data_tagliando = Capovolgidata($data_tagliando);
		$tipo_cartella = $_POST['tipo_cartella'];
		$cartella = $_POST['cartella'];
		$tagliando_ogni = $_POST['tagliando_ogni'];
		$colore = $_POST['colore'];
		
		$tipo_tagliando = StringInputCleaner($tipo_tagliando);
		//$tipo_tagliando = str_replace("°", "&deg;", $tipo_tagliando);
		$costo = str_replace(",", ".", $costo);
		$tagliando_prossimo = $_POST['tagliando_prossimo'];
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
		
		$tagliando = new Tagliandi();
		$e_query_inserimento = $tagliando->modificaTagliando($id, $tipo_tagliando, $data_tagliando, $costo, $filename, $tagliando_ogni, $colore, $tagliando_prossimo);
//		if($e_query_inserimento >= 0){
//			$mezzo = new Mezzi();
//			$mezzo->modificaKm($id_mezzo, $tagliando_ogni);
//		}
		$log->inserisciLog("Modifica tagliando", $_SESSION['username'], "blu");
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