<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.Ral.php");
require_once("../classi/class.Log.php");
session_start();

$tipo = $_POST['tipo'];
$log = new Log();

switch($tipo){
	case "inserimento":
        
		$id_commessa = $_POST['id_commessa'];
		$campo_ral = $_POST['ral'];
		$totale_ral = $_POST['totale_ral'];
		$data = $_POST['data'];
		$note = $_POST['note'];
        $data = CapovolgiData($data);
		$tipo_cartella = $_POST['tipo_cartella'];
		$cartella = $_POST['cartella'];
		$tipologia = $_POST['tipologia'];

		$note = StringInputCleaner($note);
		$campo_ral = StringInputCleaner($campo_ral);
		//$note = str_replace("°", "&deg;", $note);
		$totale_ral = str_replace(",", ".", $totale_ral);
		
		//perorso dove fare upload file
		$target_path = "../uploads/".$cartella."/".$id_commessa."/".$tipo_cartella."/";
		$target_path_salva = "uploads/".$cartella."/".$id_commessa."/".$tipo_cartella."/";
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
		
		$ral = new Ral();
		$e_query_inserimento = $ral->inserisciRal($id_commessa, $campo_ral, $totale_ral, $filename, $target_path_salva, $data, $note, $tipologia);
		
		//LOG
		$log->inserisciLog("Inserimento SAL: ".$campo_ral, $_SESSION['username'], "verde");
		echo $e_query_inserimento;
	break;
	
	case "elimina":
		$ral = new Ral();
		$id = $_POST['id'];
		$nome_ral = $ral->estraiNome($id);
		$id_commessa = $_POST['id_commessa'];
		$nome = $_POST['nome'];
		$nome_ral = $ral->estraiNome($id);
		$e_query_elimina = $ral->eliminaRal($id);
		if($e_query_elimina > 0){
			if($nome != ""){
				$target_path = "../uploads/commesse/".$id_commessa."/ral/".$nome;
				if (file_exists($target_path)) { 
					unlink($target_path);
				}
			}

		}
        $dir = "../uploads/commesse/".$id_commessa."/ral/".$id;
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
		//LOG
		$log->inserisciLog("Eliminazione SAL: ".$nome_ral, $_SESSION['username'], "rosso");
		echo $e_query_elimina;
		
	break;	
	
	case "elimina_allegato":
		$ral = new Ral();
		$id = $_POST['id'];
		$id_commessa = $_POST['id_commessa'];
		$nome = $_POST['nome'];
		$e_query_elimina = $ral->eliminaAllegato($id);
		if($e_query_elimina >= 0){
			//elimino fisicamente l'allegato
			$target_path = "../uploads/commesse/".$id_commessa."/ral/".$nome;
			if (file_exists($target_path)) { 
				unlink($target_path);
			}
		}
		//LOG
		$log->inserisciLog("eliminazione allegato SAL: ".$nome, $_SESSION['username'], "rosso");
		echo $e_query_elimina;
	break;
	
	case "modifica":
		$id = $_POST['id_da_modificare'];
		$id_commessa = $_POST['id_commessa'];
		$campo_ral = $_POST['ral'];
		$totale_ral = $_POST['totale_ral'];
		$tipo_cartella = $_POST['tipo_cartella'];
        $data = $_POST['data'];
		$note = $_POST['note'];
        $data = CapovolgiData($data);
		$cartella = $_POST['cartella'];
		$tagliando_ogni = $_POST['tagliando_ogni'];
		$tipologia = $_POST['tipologia'];
		$note = StringInputCleaner($note);
		$campo_ral = StringInputCleaner($campo_ral);
		//$note = str_replace("°", "&deg;", $note);
		$totale_ral = str_replace(",", ".", $totale_ral);
		
		//perorso dove fare upload file
		$target_path = "../uploads/".$cartella."/".$id_commessa."/".$tipo_cartella."/";
		$target_path_salva = "uploads/".$cartella."/".$id_commessa."/".$tipo_cartella."/";
		
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
		
		$ral = new Ral();
		$e_query_inserimento = $ral->modificaRal($id, $campo_ral, $totale_ral, $filename, $target_path_salva, $data, $note, $tipologia);
		
		$log->inserisciLog("Modifica SAL: ".$campo_ral, $_SESSION['username'], "blu");
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