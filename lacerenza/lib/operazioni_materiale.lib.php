<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.Materiali.php");
require_once("../classi/class.Log.php");
session_start();

$tipo = $_POST['tipo'];
$log = new Log();

switch($tipo){
	case "inserimento":
		$id_commessa = $_POST['id_commessa'];
		$tipo_materiale = $_POST['tipo_materiale'];
		$fornitore = $_POST['fornitore'];
		$costo = $_POST['costo'];
		$quantita = $_POST['quantita'];
		$importo = $_POST['importo'];
		$data = $_POST['data'];
		$data = Capovolgidata($data);        
        
		$costo = str_replace(",", ".", $costo);
		$quantita = str_replace(",", ".", $quantita);
		$importo = str_replace(",", ".", $importo);
		
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
		
		$materiale = new Materiali();
		$e_query_inserimento = $materiale->inserisciMateriale($id_commessa, $tipo_materiale, $fornitore, $costo, $quantita, $importo, $data, $target_path_inserimento, $filename);
		
		//LOG
		$log->inserisciLog("Inserimento materiale", $_SESSION['username'], "verde");
		echo $e_query_inserimento;
	break;
	
	case "elimina":
		$materiale = new Materiali();
		$id = $_POST['id'];
		$id_commessa = $_POST['id_commessa'];
		$nome = $_POST['nome'];
		$e_query_elimina = $materiale->eliminaMateriale($id);
		if($e_query_elimina > 0){
			if($nome != ""){
				$target_path = "../uploads/commesse/".$id_commessa."/materiali/".$nome;
				if (file_exists($target_path)) { 
					unlink($target_path);
				}
			}

		}
		//LOG
		$log->inserisciLog("Eliminazione materiale", $_SESSION['username'], "rosso");
		echo $e_query_elimina;
		
	break;	
	
	case "elimina_allegato":
		$materiale = new Materiali();
		$id = $_POST['id'];
		$id_commessa = $_POST['id_commessa'];
		$nome = $_POST['nome'];
		$e_query_elimina = $materiale->eliminaAllegato($id);
		if($e_query_elimina >= 0){
			//elimino fisicamente l'allegato
			$target_path = "../uploads/commesse/".$id_commessa."/materiali/".$nome;
			if (file_exists($target_path)) { 
				unlink($target_path);
			}
		}
		
		echo $e_query_elimina;
	break;
	
	case "modifica":
		$id = $_POST['id_da_modificare'];
		$id_commessa = $_POST['id_commessa'];
		$tipo_materiale = $_POST['tipo_materiale'];
		$fornitore = $_POST['fornitore'];
		$costo = $_POST['costo'];
		$quantita = $_POST['quantita'];
		$importo = $_POST['importo'];
		$data = $_POST['data'];
		$data = Capovolgidata($data);    
        
		$costo = str_replace(",", ".", $costo);
		$quantita = str_replace(",", ".", $quantita);
		$importo = str_replace(",", ".", $importo);
		
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
		
		$materiale = new Materiali();
		$e_query_inserimento = $materiale->modificaMateriale($id, $id_commessa, $tipo_materiale, $fornitore, $costo, $quantita, $importo, $data, $target_path_modifica, $filename);
		
		$log->inserisciLog("Modifica materiale", $_SESSION['username'], "blu");
		echo $e_query_inserimento;
	break;	
}	

?>