<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.Attivita.php");
require_once("../classi/class.AllegatiAttivita.php");
require_once("../classi/class.Log.php");
session_start();

$tipo = $_POST['tipo'];
$log = new Log();

switch($tipo){
	case "inserimento":
		$id_commessa = $_POST['id_commessa'];
		$impresa_fornitrice = $_POST['impresa_fornitrice'];
		$lavoro = $_POST['lavoro'];
		$importo = $_POST['importo'];
		$registrato_a = $_POST['registrato_a'];
		$numero = $_POST['numero'];
        $data_del = $_POST['data_del'];
		$data_del = Capovolgidata($data_del);
        $data_il = $_POST['data_il'];
		$data_il = Capovolgidata($data_il);
        
		$importo = str_replace(",", ".", $importo);
		$lavoro = StringInputCleaner($lavoro);
		//$lavoro = str_replace("°", "&deg;", $lavoro);
		$attivita = new Attivita();
		$e_query_inserimento = $attivita->inserisciAttivita($id_commessa,$importo, $impresa_fornitrice, $lavoro, $registrato_a, $numero, $data_del, $data_il);
		
		//LOG
		$log->inserisciLog("Inserimento attivita", $_SESSION['username'], "verde");
		echo $e_query_inserimento;
	break;
	
	case "elimina":
		$attivita = new Attivita();
		$id = $_POST['id'];
		$id_commessa = $_POST['id_commessa'];
		$nome = $_POST['nome'];
		$e_query_elimina = $attivita->eliminaAttivita($id);
		if($e_query_elimina > 0){
			$dir = "../uploads/commesse/".$id_commessa."/attivita/".$id."/";
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
		$log->inserisciLog("Eliminazione attivita", $_SESSION['username'], "rosso");
		echo $e_query_elimina;
		
	break;	
    
    case "inserisci_allegato":
		$allegato = new AllegatiAttivita();
		$id_commessa = $_POST['id_commessa'];
		$id_attivita = $_POST['id_attivita'];
		$descrizione = $_POST['descrizione'];
		$inviato_a = $_POST['inviato_a'];
		$data_ricevuto = $_POST['data_ricevuto'];
        $data_ricevuto = CapovolgiData($data_ricevuto);
		$data_inviato = $_POST['data_inviato'];
        $data_inviato = CapovolgiData($data_inviato);

		//perorso dove fare upload file
		$target_path = "../uploads/commesse/".$id_commessa."/attivita/".$id_attivita."/";
		$target_path_inserimento = "uploads/commesse/".$id_commessa."/attivita/".$id_attivita."/";
		
		//nome del file
		$filename = $_FILES['files']['name'];
		
		if($filename != ""){
			//creo cartella se non esiste
			if (!is_dir($target_path)) { 
				$crea = mkdir($target_path, 0777, true);
			}
			
			//elimino file caricati prima
            $link_file = "../uploads/commesse/".$id_commessa."/attivita/".$id_attivita."/".$filename;
            if (file_exists($link_file)) { 
                $filename = date("d_m_Y_h_i_s").$filename;
                $link_file = "../uploads/commesse/".$id_commessa."/attivita/".$id_attivita."/".$filename;
            }
            
			move_uploaded_file($_FILES["files"]["tmp_name"], $link_file);
		}
        
        $e_query_insert_allegato = $allegato->inserisciAllegato($id_attivita, $descrizione, $data_ricevuto, $data_inviato, $inviato_a, $target_path_inserimento, $filename);

        
		//LOG
		$log->inserisciLog("Inserimento allegato attivita", $_SESSION['username'], "rosso");
		echo $e_query_insert_allegato;
		
        break;	
        
    case "elimina_allegato":
		$allegato = new AllegatiAttivita();
		$id = $_POST['id'];
		$id_commessa = $_POST['id_commessa'];
		$id_attivita = $_POST['id_attivita'];
		$nome = $_POST['nome'];
		$e_query_elimina = $allegato->eliminaAllegato($id);
		if($e_query_elimina > 0){
			if($nome != ""){
				$target_path = "../uploads/commesse/".$id_commessa."/attivita/".$id_attivita."/".$nome;
				if (file_exists($target_path)) { 
					unlink($target_path);
				}
			}

		}
		//LOG
		$log->inserisciLog("Eliminazione allegato attivita", $_SESSION['username'], "rosso");
		echo $e_query_elimina;
		
        break;	
		
	case "modifica":
		$id = $_POST['id_da_modificare'];
		$id_commessa = $_POST['id_commessa'];
		$impresa_fornitrice = $_POST['impresa_fornitrice'];
		$lavoro = $_POST['lavoro'];
		$importo = $_POST['importo'];
		$registrato_a = $_POST['registrato_a'];
		$numero = $_POST['numero'];
        $data_del = $_POST['data_del'];
		$data_del = Capovolgidata($data_del);
        $data_il = $_POST['data_il'];
		$data_il = Capovolgidata($data_il);
        
		$importo = str_replace(",", ".", $importo);
		$lavoro = StringInputCleaner($lavoro);
		//$lavoro = str_replace("°", "&deg;", $lavoro);
		
		$attivita = new Attivita();
		$e_query_inserimento = $attivita->modificaAttivita($id, $id_commessa,$importo, $impresa_fornitrice, $lavoro, $registrato_a, $numero, $data_del, $data_il);
		
		$log->inserisciLog("Modifica attivita", $_SESSION['username'], "blu");
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