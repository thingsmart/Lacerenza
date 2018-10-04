<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.Regolarita.php");
require_once("../classi/class.Log.php");
session_start();

$tipo = $_POST['tipo'];
$log = new Log();

switch($tipo){
	case "inserimento":
		$id_commessa = $_POST['id_commessa'];
		$descrizione = $_POST['descrizione'];
		$ente = $_POST['ente'];
		$data = $_POST['data'];
		$data = Capovolgidata($data);        
        $scadenza = $_POST['scadenza'];
		$scadenza = Capovolgidata($scadenza);  
		$tipo_cartella = $_POST['tipo_cartella'];
		$cartella = $_POST['cartella'];
		
		$descrizione = StringInputCleaner($descrizione);
		//$descrizione = str_replace("°", "&deg;", $descrizione);
		
		$ente = StringInputCleaner($ente);
		//$ente = str_replace("°", "&deg;", $ente);
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
		
		$regolarita = new Regolarita();
		$e_query_inserimento = $regolarita->inserisciRegolarita($id_commessa, $descrizione, $data, $ente, $scadenza, $target_path_inserimento, $filename);
		
		//LOG
		$log->inserisciLog("Inserimento regolarita", $_SESSION['username'], "verde");
		echo $e_query_inserimento;
	break;
	
	case "elimina":
		$regolarita = new Regolarita();
		$id = $_POST['id'];
		$id_commessa = $_POST['id_commessa'];
		$nome = $_POST['nome'];
		$e_query_elimina = $regolarita->eliminaRegolarita($id);
		if($e_query_elimina > 0){
			if($nome != ""){
				$target_path = "../uploads/commesse/".$id_commessa."/regolarita/".$nome;
				if (file_exists($target_path)) { 
					unlink($target_path);
				}
			}

		}
		//LOG
		$log->inserisciLog("Eliminazione regolarita", $_SESSION['username'], "rosso");
		echo $e_query_elimina;
		
	break;	
	
	case "elimina_allegato":
		$regolarita = new Regolarita();
		$id = $_POST['id'];
		$id_commessa = $_POST['id_commessa'];
		$nome = $_POST['nome'];
		$e_query_elimina = $regolarita->eliminaAllegato($id);
		if($e_query_elimina >= 0){
			//elimino fisicamente l'allegato
			$target_path = "../uploads/commesse/".$id_commessa."/regolarita/".$nome;
			if (file_exists($target_path)) { 
				unlink($target_path);
			}
		}
		
		echo $e_query_elimina;
	break;
	
	case "modifica":
		$id = $_POST['id_da_modificare'];
		$id_commessa = $_POST['id_commessa'];
		$descrizione = $_POST['descrizione'];
		$ente = $_POST['ente'];
		$data = $_POST['data'];
		$data = Capovolgidata($data);        
        $scadenza = $_POST['scadenza'];
		$scadenza = Capovolgidata($scadenza);    
        
		$descrizione = StringInputCleaner($descrizione);
		//$descrizione = str_replace("°", "&deg;", $descrizione);
		
		$ente = StringInputCleaner($ente);
		//$ente = str_replace("°", "&deg;", $ente);
		
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
		
		$regolarita = new Regolarita();
		$e_query_inserimento = $regolarita->modificaRegolarita($id, $id_commessa, $descrizione, $ente, $data, $scadenza, $target_path_modifica, $filename);
		
		$log->inserisciLog("Modifica regolarita", $_SESSION['username'], "blu");
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