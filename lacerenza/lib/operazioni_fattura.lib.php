<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.Fatture.php");
require_once("../classi/class.Log.php");
session_start();

$tipo = $_POST['tipo'];
$log = new Log();

switch($tipo){
	case "inserimento":
		$id_commessa = $_POST['id_commessa'];
		$tipo_documento = $_POST['tipo_documento'];
		$descrizione = $_POST['descrizione'];
		$importo_totale = $_POST['importo_totale'];
		$data_pagamento = $_POST['data_pagamento'];
		$data_pagamento = Capovolgidata($data_pagamento);
		$data_incasso = $_POST['data_incasso'];
		$data_incasso = Capovolgidata($data_incasso);        
        
		$descrizione = StringInputCleaner($descrizione);
		//$descrizione = str_replace("°", "&deg;", $descrizione);
		$importo_totale = str_replace(",", ".", $importo_totale);
		
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
		
		$fattura = new Fatture();
		$e_query_inserimento = $fattura->inserisciFattura($id_commessa, $tipo_documento, $descrizione, $importo_totale, $data_pagamento, $data_incasso, $target_path_inserimento, $filename);
		
		//LOG
		$log->inserisciLog("Inserimento fattura", $_SESSION['username'], "verde");
		echo $e_query_inserimento;
	break;
	
	case "elimina":
		$fattura = new Fatture();
		$id = $_POST['id'];
		$id_commessa = $_POST['id_commessa'];
		$nome = $_POST['nome'];
		$e_query_elimina = $fattura->eliminaFattura($id);
		if($e_query_elimina > 0){
			if($nome != ""){
				$target_path = "../uploads/commesse/".$id_commessa."/fatture/".$nome;
				if (file_exists($target_path)) { 
					unlink($target_path);
				}
			}

		}
		//LOG
		$log->inserisciLog("Eliminazione fattura", $_SESSION['username'], "rosso");
		echo $e_query_elimina;
		
	break;	
	
	case "elimina_allegato":
		$fattura = new Fatture();
		$id = $_POST['id'];
		$id_commessa = $_POST['id_commessa'];
		$nome = $_POST['nome'];
		$e_query_elimina = $fattura->eliminaAllegato($id);
		if($e_query_elimina >= 0){
			//elimino fisicamente l'allegato
			$target_path = "../uploads/commesse/".$id_commessa."/fatture/".$nome;
			if (file_exists($target_path)) { 
				unlink($target_path);
			}
		}
		
		echo $e_query_elimina;
	break;
	
	case "modifica":
		$id = $_POST['id_da_modificare'];
		$id_commessa = $_POST['id_commessa'];
		$tipo_documento = $_POST['tipo_documento'];
		$descrizione = $_POST['descrizione'];
		$importo_totale = $_POST['importo_totale'];
		$data_pagamento = $_POST['data_pagamento'];
		$data_pagamento = Capovolgidata($data_pagamento);
        $data_incasso = $_POST['data_incasso'];
		$data_incasso = Capovolgidata($data_incasso);
		$tipo_cartella = $_POST['tipo_cartella'];
		$cartella = $_POST['cartella'];
		//perorso dove fare upload file
		$target_path = "../uploads/".$cartella."/".$id_commessa."/".$tipo_cartella."/";
		$target_path_modifica = "uploads/".$cartella."/".$id_commessa."/".$tipo_cartella."/";
		
		
		$descrizione = StringInputCleaner($descrizione);
		//$descrizione = str_replace("°", "&deg;", $descrizione);
		$importo_totale = str_replace(",", ".", $importo_totale);
		
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
		
		$fattura = new Fatture();
		$e_query_inserimento = $fattura->modificaFattura($id, $tipo_documento, $descrizione, $importo_totale, $data_pagamento, $data_incasso, $target_path_modifica, $filename);
		
		$log->inserisciLog("Modifica fattura", $_SESSION['username'], "blu");
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