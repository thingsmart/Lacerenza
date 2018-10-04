<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.RevisioniContrattuali.php");
require_once("../classi/class.Log.php");
session_start();

$tipo = $_POST['tipo'];
$log = new Log();

switch($tipo){
	case "inserimento":
		$id_commessa = $_POST['id_commessa'];
		$tipo_documento = $_POST['tipo_documento'];
		$numero_documento = $_POST['numero_documento'];
		$registrato_a = $_POST['registrato_a'];
		$data = $_POST['data'];
		$data = Capovolgidata($data);
        
		$tipo_cartella = $_POST['tipo_cartella'];
		$cartella = $_POST['cartella'];

        //perorso dove fare upload file
		$target_path = "../uploads/".$cartella."/".$id_commessa."/".$tipo_cartella."/";
		$target_path_inserimento = "uploads/".$cartella."/".$id_commessa."/".$tipo_cartella."/";
		
		//nome del file
		$filename = $_FILES['files']['name'];
		
		if($filename != ""){
			//creo cartella se non esiste
			if (!is_dir($target_path)) { 
				$crea = mkdir($target_path, 0777, true);
			}
			
			//elimino file caricati prima
            $link_file = "../uploads/".$cartella."/".$id_commessa."/".$tipo_cartella."/".$filename;
            if (file_exists($link_file)) { 
                $filename = date("d_m_Y_h_i_s").$filename;
                $link_file = "../uploads/".$cartella."/".$id_commessa."/".$tipo_cartella."/".$filename;
            }
		
			move_uploaded_file($_FILES["files"]["tmp_name"], $link_file);
		}
		
		$revisioneContrattuale = new RevisioniContrattuali();
		$e_query_inserimento = $revisioneContrattuale->inserisciRevisioneContrattuale($id_commessa, $tipo_documento, $numero_documento, $registrato_a, $data, $target_path_inserimento, $filename);
		
		//LOG
		$log->inserisciLog("Inserimento revisione contrattuale: ".$tipo_documento." | id=".$e_query_inserimento, $_SESSION['username'], "verde");
		echo $e_query_inserimento;
	break;
	
	case "elimina":
		$revisioneContrattuale = new RevisioniContrattuali();
		$id = $_POST['id'];
		$id_commessa = $_POST['id_commessa'];
		$nome = $_POST['nome'];
		$e_query_elimina = $revisioneContrattuale->eliminaRevisioneContrattuale($id);
		if($e_query_elimina > 0){
			if($nome != ""){
				$target_path = "../uploads/commesse/".$id_commessa."/revisioni/".$nome;
				if (file_exists($target_path)) { 
					unlink($target_path);
				}
			}

		}
		//LOG
		$log->inserisciLog("Eliminazione revisione contrattuale: id=".$id, $_SESSION['username'], "rosso");
		echo $e_query_elimina;
		
	break;	
	
	case "elimina_allegato":
		$revisioneContrattuale = new RevisioniContrattuali();
		$id = $_POST['id'];
		$id_commessa = $_POST['id_commessa'];
		$nome = $_POST['nome'];
		$e_query_elimina = $revisioneContrattuale->eliminaAllegato($id);
		if($e_query_elimina >= 0){
			//elimino fisicamente l'allegato
			$target_path = "../uploads/commesse/".$id_commessa."/revisioni/".$nome;
			if (file_exists($target_path)) { 
				unlink($target_path);
			}
		}
		//LOG
		$log->inserisciLog("Eliminazione allegato revisione contrattuale: ".$nome, $_SESSION['username'], "rosso");
		echo $e_query_elimina;
	break;
	
	case "modifica":
		$id = $_POST['id_da_modificare'];
		$id_commessa = $_POST['id_commessa'];
		$tipo_documento = $_POST['tipo_documento'];
		$numero_documento = $_POST['numero_documento'];
		$registrato_a = $_POST['registrato_a'];
		$data = $_POST['data'];
		$data = Capovolgidata($data);
		$tipo_cartella = $_POST['tipo_cartella'];
		$cartella = $_POST['cartella'];
		//perorso dove fare upload file
		$target_path = "../uploads/".$cartella."/".$id_commessa."/".$tipo_cartella."/";
		$target_path_modifica = "uploads/".$cartella."/".$id_commessa."/".$tipo_cartella."/";
		
		//nome del file
		$filename = $_FILES['files']['name'];
		
		if($filename != ""){
			//creo cartella se non esiste
			if (!is_dir($target_path)) { 
				$crea = mkdir($target_path, 0777, true);
			}
			
			
            $link_file = "../uploads/".$cartella."/".$id_commessa."/".$tipo_cartella."/".$filename;
		    if (file_exists($link_file)) { 
                $filename = date("d_m_Y_h_i_s").$filename;
                $link_file = "../uploads/".$cartella."/".$id_commessa."/".$tipo_cartella."/".$filename;
            }
			move_uploaded_file($_FILES["files"]["tmp_name"], $link_file);
		}
		
		$revisioneContrattuale = new RevisioniContrattuali();
		$e_query_inserimento = $revisioneContrattuale->modificaRevisioneContrattuale($id, $id_commessa, $tipo_documento, $numero_documento, $registrato_a, $data, $target_path_modifica, $filename);
		
		$log->inserisciLog("Modifica revisione contrattuale", $_SESSION['username'], "blu");
		echo $e_query_inserimento;
	break;	
}	

?>