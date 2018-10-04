<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.Polizze.php");
require_once("../classi/class.Log.php");
session_start();

$tipo = $_POST['tipo'];
$log = new Log();

switch($tipo){
	case "inserimento":
		$id_commessa = $_POST['id_commessa'];
		$descrizione = $_POST['descrizione'];
		$importo = $_POST['importo'];
		$polizza_svincolata = $_POST['polizza_svincolata'];
		$data_stipula = $_POST['data_stipula'];
		$data_stipula = Capovolgidata($data_stipula);
		$scadenza = $_POST['scadenza'];
		$scadenza = Capovolgidata($scadenza);        
        
		$descrizione = StringInputCleaner($descrizione);
		//$descrizione = str_replace("°", "&deg;", $descrizione);
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
		
		$polizze = new Polizze();
		$e_query_inserimento = $polizze->inserisciPolizza($id_commessa, $descrizione, $importo, $polizza_svincolata, $data_stipula, $scadenza, $target_path_inserimento, $filename);
		
		//LOG
		$log->inserisciLog("Inserimento polizza", $_SESSION['username'], "verde");
		echo $e_query_inserimento;
	break;
	
	case "elimina":
		$polizze = new Polizze();
		$id = $_POST['id'];
		$id_commessa = $_POST['id_commessa'];
		$nome = $_POST['nome'];
		$e_query_elimina = $polizze->eliminaPolizza($id);
		if($e_query_elimina > 0){
			if($nome != ""){
				$target_path = "../uploads/commesse/".$id_commessa."/polizze/".$nome;
				if (file_exists($target_path)) { 
					unlink($target_path);
				}
			}

		}
		//LOG
		$log->inserisciLog("Eliminazione polizza", $_SESSION['username'], "rosso");
		echo $e_query_elimina;
		
	break;	
	
	case "elimina_allegato":
		$polizze = new Polizze();
		$id = $_POST['id'];
		$id_commessa = $_POST['id_commessa'];
		$nome = $_POST['nome'];
		$e_query_elimina = $polizze->eliminaAllegato($id);
		if($e_query_elimina >= 0){
			//elimino fisicamente l'allegato
			$target_path = "../uploads/commesse/".$id_commessa."/polizze/".$nome;
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
		$importo = $_POST['importo'];
		$polizza_svincolata = $_POST['polizza_svincolata'];
		$data_stipula = $_POST['data_stipula'];
		$data_stipula = Capovolgidata($data_stipula);
		$scadenza = $_POST['scadenza'];
		$scadenza = Capovolgidata($scadenza);      
		
		$descrizione = StringInputCleaner($descrizione);
		//$descrizione = str_replace("°", "&deg;", $descrizione);
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
		
		$polizze = new Polizze();
		$e_query_inserimento = $polizze->modificaPolizza($id, $id_commessa, $descrizione, $importo, $polizza_svincolata, $data_stipula, $scadenza, $target_path_modifica, $filename);
		
		$log->inserisciLog("Modifica polizza", $_SESSION['username'], "blu");
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