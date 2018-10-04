<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.Noleggi.php");
require_once("../classi/class.AllegatiNoleggio.php");
require_once("../classi/class.Log.php");
session_start();

$tipo = $_POST['tipo'];
$log = new Log();

switch($tipo){
	case "inserimento":
		$id_commessa = $_POST['id_commessa'];
		$numero = $_POST['numero'];
		$descrizione = $_POST['descrizione'];
		$importo = $_POST['importo'];
		$fornitore = $_POST['fornitore'];
		$data = $_POST['data'];
		$data = Capovolgidata($data);
        
		$descrizione = StringInputCleaner($descrizione);
		//$descrizione = str_replace("°", "&deg;", $descrizione);
		$importo = str_replace(",", ".", $importo);
				
		$noleggi = new Noleggi();
		$e_query_inserimento = $noleggi->inserisciNoleggio($id_commessa, $numero, $descrizione, $importo, $fornitore, $data);
		
		//LOG
		$log->inserisciLog("Inserimento noleggio", $_SESSION['username'], "verde");
		echo $e_query_inserimento;
	break;
	
	case "elimina":
		$noleggi = new Noleggi();
		$id = $_POST['id'];
		$id_commessa = $_POST['id_commessa'];
		$nome = $_POST['nome'];
		$e_query_elimina = $noleggi->eliminaNoleggio($id);
		if($e_query_elimina > 0){
			$dir = "../uploads/commesse/".$id_commessa."/noleggi/".$id."/";
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

		}
		//LOG
		$log->inserisciLog("Eliminazione noleggio", $_SESSION['username'], "rosso");
		echo $e_query_elimina;
		
	break;	
    
    case "inserisci_allegato":
		$allegato = new AllegatiNoleggio();
		$id_commessa = $_POST['id_commessa'];
		$id_noleggio = $_POST['id_noleggio'];
		$descrizione = $_POST['descrizione'];

		//perorso dove fare upload file
		$target_path = "../uploads/commesse/".$id_commessa."/noleggi/".$id_noleggio."/";
		$target_path_inserimento = "uploads/commesse/".$id_commessa."/noleggi/".$id_noleggio."/";
		
		//nome del file
		$filename = $_FILES['files']['name'];
		
		if($filename != ""){
			//creo cartella se non esiste
			if (!is_dir($target_path)) { 
				$crea = mkdir($target_path, 0777, true);
			}
			
			//elimino file caricati prima
            $link_file = "../uploads/commesse/".$id_commessa."/noleggi/".$id_noleggio."/".$filename;
            if (file_exists($link_file)) { 
                $filename = date("d_m_Y_h_i_s").$filename;
                $link_file = "../uploads/commesse/".$id_commessa."/noleggi/".$id_noleggio."/".$filename;
            }
            
			move_uploaded_file($_FILES["files"]["tmp_name"], $link_file);
		}
        
        $e_query_insert_allegato = $allegato->inserisciAllegato($id_noleggio, $descrizione, $target_path_inserimento, $filename);

        
		//LOG
		$log->inserisciLog("Inserimento allegato noleggio", $_SESSION['username'], "rosso");
		echo $e_query_insert_allegato;
		
        break;	
        
    case "elimina_allegato":
		$allegato = new AllegatiNoleggio();
		$id = $_POST['id'];
		$id_commessa = $_POST['id_commessa'];
		$id_noleggio = $_POST['id_noleggio'];
		$nome = $_POST['nome'];
		$e_query_elimina = $allegato->eliminaAllegato($id);
		if($e_query_elimina > 0){
			if($nome != ""){
				$target_path = "../uploads/commesse/".$id_commessa."/noleggi/".$id_noleggio."/".$nome;
				if (file_exists($target_path)) { 
					unlink($target_path);
				}
			}

		}
		//LOG
		$log->inserisciLog("Eliminazione allegato noleggio", $_SESSION['username'], "rosso");
		echo $e_query_elimina;
		
        break;	
		
	case "modifica":
		$id = $_POST['id_da_modificare'];
		$id_commessa = $_POST['id_commessa'];
		$numero = $_POST['numero'];
		$descrizione = $_POST['descrizione'];
		$importo = $_POST['importo'];
		$fornitore = $_POST['fornitore'];
		$data = $_POST['data'];
		$data = Capovolgidata($data);
		
		$descrizione = StringInputCleaner($descrizione);
		//$descrizione = str_replace("°", "&deg;", $descrizione);
		$importo = str_replace(",", ".", $importo);
		
		$noleggi = new Noleggi();
		$e_query_inserimento = $noleggi->modificaNoleggio($id, $id_commessa, $numero, $descrizione, $importo, $fornitore, $data);
		
		$log->inserisciLog("Modifica noleggio", $_SESSION['username'], "blu");
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