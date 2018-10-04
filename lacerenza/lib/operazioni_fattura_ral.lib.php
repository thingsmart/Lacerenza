<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.FattureRal.php");
require_once("../classi/class.Ral.php");
require_once("../classi/class.Log.php");
session_start();

$tipo = $_POST['tipo'];
$log = new Log();

switch($tipo){
	case "inserimento":
        
		$id_commessa = $_POST['id_commessa'];
		$id_ral = $_POST['id_ral'];
		$ral_nome = new Ral();
		$nome_ral = $ral_nome->estraiNome($id_ral);
		$descrizione = $_POST['descrizione'];
		$importo = $_POST['importo'];
        $data = $_POST['data'];
        $note = $_POST['note'];
        $data = CapovolgiData($data);
		$tipo_cartella = $_POST['tipo_cartella'];
		$cartella = $_POST['cartella'];
		
		$descrizione = StringInputCleaner($descrizione);
		//$descrizione = str_replace("°", "&deg;", $descrizione);
		
		$importo = str_replace(",", ".", $importo);
		
		//perorso dove fare upload file
		$target_path = "../uploads/".$cartella."/".$id_commessa."/".$tipo_cartella."/".$id_ral."/";
		$target_path_salva = "uploads/".$cartella."/".$id_commessa."/".$tipo_cartella."/".$id_ral."/";
		//nome del file
		$filename = $_FILES['files']['name'];
		
		if($filename != ""){
			//creo cartella se non esiste
			if (!is_dir($target_path)) { 
				$crea = mkdir($target_path, 0777, true);
			}
            $link_file = "../uploads/".$cartella."/".$id_commessa."/".$tipo_cartella."/".$id_ral."/".$filename;
            if (file_exists($link_file)) { 
                $filename = date("d_m_Y_h_i_s").$filename;
                $link_file = "../uploads/".$cartella."/".$id_commessa."/".$tipo_cartella."/".$id_ral."/".$filename;
            }
			move_uploaded_file($_FILES["files"]["tmp_name"], $link_file);
		}
		
		$ral = new FattureRal();
		$e_query_inserimento = $ral->inserisciRal($id_ral, $descrizione, $importo, $filename, $target_path_salva, $note, $data);
		
		//LOG
		$log->inserisciLog("Inserimento fattura SAL: ".$descrizione. " | " .$nome_ral, $_SESSION['username'], "verde");
		echo $e_query_inserimento;
	break;
	
	case "elimina":
		$ral = new FattureRal();
		$ral_nome = new Ral();
		$id = $_POST['id'];
		$id_ral = $_POST['id_ral'];
		$nome_ral = $ral_nome->estraiNome($id_ral);
		$id_commessa = $_POST['id_commessa'];
		$nome = $_POST['nome'];
		$e_query_elimina = $ral->eliminaRal($id);
		if($e_query_elimina > 0){
			if($nome != ""){
				$target_path = "../uploads/commesse/".$id_commessa."/ral/".$id_ral."/".$nome;
				if (file_exists($target_path)) { 
					unlink($target_path);
				}
			}

		}
		//LOG
		$log->inserisciLog("Eliminazione Fattura SAL: ". $nome_ral, $_SESSION['username'], "rosso");
		echo $e_query_elimina;
		
	break;	
	
	case "elimina_allegato":
		$ral = new FattureRal();
		$id = $_POST['id'];
		$id_commessa = $_POST['id_commessa'];
		$id_ral = $_POST['id_ral'];
		$ral_nome = new Ral();
		$nome_ral = $ral_nome->estraiNome($id_ral);
		$nome = $_POST['nome'];
		$e_query_elimina = $ral->eliminaAllegato($id);
		if($e_query_elimina >= 0){
			//elimino fisicamente l'allegato
			$target_path = "../uploads/commesse/".$id_commessa."/ral/".$id_ral."/".$nome;
			if (file_exists($target_path)) { 
				unlink($target_path);
			}
		}
		//LOG
		$log->inserisciLog("Eliminazione allegato fattura SAL. | ".$nome_ral, $_SESSION['username'], "rosso");
		echo $e_query_elimina;
	break;
	
	case "modifica":
		$id = $_POST['id_da_modificare'];
		$id_commessa = $_POST['id_commessa'];
		$id_ral = $_POST['id_ral'];
		$ral_nome = new Ral();
		$nome_ral = $ral_nome->estraiNome($id_ral);
		$descrizione = $_POST['descrizione'];
		$importo = $_POST['importo'];
        $data = $_POST['data'];
        $note = $_POST['note'];
        $data = CapovolgiData($data);
		$tipo_cartella = $_POST['tipo_cartella'];
		$cartella = $_POST['cartella'];
		
		$descrizione = StringInputCleaner($descrizione);
		//$descrizione = str_replace("°", "&deg;", $descrizione);
		$importo = str_replace(",", ".", $importo);
        
		//perorso dove fare upload file
		$target_path = "../uploads/".$cartella."/".$id_commessa."/".$tipo_cartella."/".$id_ral."/";
		$target_path_salva = "uploads/".$cartella."/".$id_commessa."/".$tipo_cartella."/".$id_ral."/";
		
		//nome del file
		$filename = $_FILES['files']['name'];
		
		if($filename != ""){
			//creo cartella se non esiste
			if (!is_dir($target_path)) { 
				$crea = mkdir($target_path, 0777, true);
			}
			
            $link_file = "../uploads/".$cartella."/".$id_commessa."/".$tipo_cartella."/".$id_ral."/".$filename;
		     if (file_exists($link_file)) { 
                 $filename = date("d_m_Y_h_i_s").$filename;
                 $link_file = "../uploads/".$cartella."/".$id_commessa."/".$tipo_cartella."/".$id_ral."/".$filename;
             }
			move_uploaded_file($_FILES["files"]["tmp_name"], $link_file);
		}
		
		$ral = new FattureRal();
		$e_query_inserimento = $ral->modificaRal($id, $descrizione, $importo, $filename, $target_path_salva, $note, $data);
		
		$log->inserisciLog("Modifica fattura SAL. | ".$nome_ral, $_SESSION['username'], "blu");
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