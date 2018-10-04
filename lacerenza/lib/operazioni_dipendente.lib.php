<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.Log.php");
require_once("../classi/class.Dipendenti.php");
require_once("../classi/class.AllegatiDipendente.php");

session_start();

$tipo = $_POST['tipo'];
$log = new Log();

switch($tipo){
	case "inserimento":
		$nome = $_POST['nome'];
		$cognome = $_POST['cognome'];
		$attivo = $_POST['attivo'];
		$dipendenti = new Dipendenti();
		$nome = StringInputCleaner($nome);
		$cognome = StringInputCleaner($cognome);
		
		// $cognome = str_replace("°", "&deg;", $cognome);
		// $nome = str_replace("°", "&deg;", $nome);
		
		$e_query_inserimento = $dipendenti->inserisciDipendente($nome, $cognome, $attivo);
		echo $e_query_inserimento;
        break;
	
	case "elimina":
		$dipendenti = new Dipendenti();
		$id = $_POST['id'];
        $e_query_elimina = $dipendenti->eliminaDipendente($id);
        if($e_query_elimina > 0){
            $dir = "../uploads/dipendenti/".$id;
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
        echo $e_query_elimina;
		
        break;	
    
    case "inserisci_allegato":
		$allegato = new AllegatiDipendente();
		$id_commessa = $_POST['id_commessa'];
		$id_dipendente = $_POST['id_dipendente'];
		$descrizione = $_POST['descrizione'];
		$data = $_POST['data'];
        $data = CapovolgiData($data);
		$scadenza = $_POST['scadenza'];
        $scadenza = CapovolgiData($scadenza);
		$controlla = $_POST['controlla'];

		//perorso dove fare upload file
		$target_path = "../uploads/dipendenti/".$id_dipendente."/";
		$target_path_inserimento = "uploads/dipendenti/".$id_dipendente."/";
		
		//nome del file
		$filename = $_FILES['files']['name'];
		
		if($filename != ""){
			//creo cartella se non esiste
			if (!is_dir($target_path)) { 
				$crea = mkdir($target_path, 0777, true);
			}
			
			//elimino file caricati prima
            $link_file = "../uploads/dipendenti/".$id_dipendente."/".$filename;
            if (file_exists($link_file)) { 
                $filename = date("d_m_Y_h_i_s").$filename;
                $link_file = "../uploads/dipendenti/".$id_dipendente."/".$filename;
            }
            
			move_uploaded_file($_FILES["files"]["tmp_name"], $link_file);
		}
        
        $e_query_insert_allegato = $allegato->inserisciAllegato($id_dipendente, $descrizione, $data, $scadenza, $inviato_a, $target_path_inserimento, $filename, $controlla);

        
		//LOG
		$log->inserisciLog("Inserimento allegato dipendente", $_SESSION['username'], "verde");
		echo $e_query_insert_allegato;
		
        break;	
    
    case "elimina_allegato":
		$allegato = new AllegatiDipendente();
		$id = $_POST['id'];
		$id_commessa = $_POST['id_commessa'];
		$id_dipendente = $_POST['id_dipendente'];
		$nome = $_POST['nome'];
		$e_query_elimina = $allegato->eliminaAllegato($id);
		if($e_query_elimina > 0){
			if($nome != ""){
				$target_path = "../uploads/dipendenti/".$id_dipendente."/".$nome;
				if (file_exists($target_path)) { 
					unlink($target_path);
				}
			}

		}
		//LOG
		$log->inserisciLog("Eliminazione allegato dipendente", $_SESSION['username'], "rosso");
		echo $e_query_elimina;
		
        break;	
	
	case "modifica":
		$dipendenti = new Dipendenti();
		$id = $_POST['id'];
		$nome = $_POST['nome'];
		$attivo = $_POST['attivo'];
		$cognome = $_POST['cognome'];
		
		$nome = StringInputCleaner($nome);
		$cognome = StringInputCleaner($cognome);
		
		// $cognome = str_replace("°", "&deg;", $cognome);
		// $nome = str_replace("°", "&deg;", $nome);
		
		$e_query_modifica = $dipendenti->modificaDipendente($id, $nome, $cognome, $attivo);
		echo $e_query_modifica;
        break;


	case "salva_modifiche":

		$allegato = new AllegatiDipendente();

		$id = $_POST['id'];
		$desc = $_POST['desc'];
		$controlla = $_POST['controlla'];

		$dInizio = CapovolgiData($_POST['iniziomodale']);
		$dFine = CapovolgiData($_POST['finemodale']);

		$e_query_aggiorna = $allegato->aggiornaAllegato( $id, $desc, $controlla, $dInizio, $dFine );

		echo $e_query_aggiorna;

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