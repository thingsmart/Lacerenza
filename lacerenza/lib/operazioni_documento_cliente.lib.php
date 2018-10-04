<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.DocumentiCliente.php");
require_once("../classi/class.Log.php");
session_start();

$tipo = $_POST['tipo'];
$log = new Log();

switch($tipo){
	case "inserimento":
		$id_commessa = $_POST['id_commessa'];
		$descrizione = $_POST['descrizione'];
		$ente_rilascio = $_POST['ente_rilascio'];
		$data = $_POST['data'];
		$data = Capovolgidata($data);
		$validita = $_POST['validita'];
		$validita = Capovolgidata($validita);        
        $scadenza = $_POST['scadenza'];
		$scadenza = Capovolgidata($scadenza);
        $rinnovo = $_POST['rinnovo'];
		$rinnovo = Capovolgidata($rinnovo);
        
		$descrizione = StringInputCleaner($descrizione);
		//$descrizione = str_replace("°", "&deg;", $descrizione);
		
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
		
		$documentoCliente = new DocumentiCliente();
		$e_query_inserimento = $documentoCliente->inserisciDocumentoCliente($id_commessa, $ente_rilascio, $descrizione, $data, $validita, $scadenza, $rinnovo, $target_path_inserimento, $filename);
		
		//LOG
		$log->inserisciLog("Inserimento documento cliente", $_SESSION['username'], "verde");
		echo $e_query_inserimento;
	break;
	
	case "elimina":
		$documentoCliente = new DocumentiCliente();
		$id = $_POST['id'];
		$id_commessa = $_POST['id_commessa'];
		$nome = $_POST['nome'];
		$e_query_elimina = $documentoCliente->eliminaDocumentoCliente($id);
		if($e_query_elimina > 0){
			if($nome != ""){
				$target_path = "../uploads/commesse/".$id_commessa."/documenti_cliente/".$nome;
				if (file_exists($target_path)) { 
					unlink($target_path);
				}
			}

		}
		//LOG
		$log->inserisciLog("Eliminazione documento cliente", $_SESSION['username'], "rosso");
		echo $e_query_elimina;
		
	break;	
	
	case "elimina_allegato":
		$documentoCliente = new DocumentiCliente();
		$id = $_POST['id'];
		$id_commessa = $_POST['id_commessa'];
		$nome = $_POST['nome'];
		$e_query_elimina = $documentoCliente->eliminaAllegato($id);
		if($e_query_elimina >= 0){
			//elimino fisicamente l'allegato
			$target_path = "../uploads/commesse/".$id_commessa."/documenti_cliente/".$nome;
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
		$ente_rilascio = $_POST['ente_rilascio'];
		$data = $_POST['data'];
		$data = Capovolgidata($data);
		$validita = $_POST['validita'];
		$validita = Capovolgidata($validita);        
        $scadenza = $_POST['scadenza'];
		$scadenza = Capovolgidata($scadenza);
        $rinnovo = $_POST['rinnovo'];
		$rinnovo = Capovolgidata($rinnovo);
		$tipo_cartella = $_POST['tipo_cartella'];
		$cartella = $_POST['cartella'];
		//perorso dove fare upload file
		$target_path = "../uploads/".$cartella."/".$id_commessa."/".$tipo_cartella."/";
		$target_path_modifica = "uploads/".$cartella."/".$id_commessa."/".$tipo_cartella."/";
		
		$descrizione = StringInputCleaner($descrizione);
		//$descrizione = str_replace("°", "&deg;", $descrizione);
		
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
		
		$documentoCliente = new DocumentiCliente();
		$e_query_inserimento = $documentoCliente->modificaDocumnetoCliente($id, $id_commessa, $ente_rilascio, $descrizione, $data, $validita, $scadenza, $rinnovo, $target_path_modifica, $filename);
		
		$log->inserisciLog("Modifica documento cliente", $_SESSION['username'], "blu");
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