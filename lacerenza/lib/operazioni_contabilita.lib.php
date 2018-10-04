<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.Contabilita.php");
require_once("../classi/class.Log.php");
session_start();

$tipo = $_POST['tipo'];
$log = new Log();

switch($tipo){
	case "inserimento":
		$id_commessa = $_POST['id_commessa'];
		$descrizione_lavori = $_POST['descrizione_lavori'];
		$p1 = $_POST['p1'];
		$b = $_POST['b'];
		$l = $_POST['l'];
		$a = $_POST['a'];
		$p = $_POST['p'];
		$prezzo = $_POST['prezzo'];
		$importo = $_POST['importo'];

		$prezzo = str_replace(",", ".", $prezzo);
		$importo = str_replace(",", ".", $importo);

        //perorso dove fare upload file
		$target_path = "../uploads/commesse/".$id_commessa."/contabilita/";
		$target_path_inserimento = "uploads/commesse/".$id_commessa."/contabilita/";
		
		//nome del file
		$filename = $_FILES['files']['name'];
		
		if($filename != ""){
			//creo cartella se non esiste
			if (!is_dir($target_path)) { 
				$crea = mkdir($target_path, 0777, true);
			}
			
			//elimino file caricati prima
            $link_file = "../uploads/commesse/".$id_commessa."/contabilita/".$filename;
            if (file_exists($link_file)) { 
                $filename = date("d_m_Y_h_i_s").$filename;
                $link_file = "../uploads/commesse/".$id_commessa."/contabilita/".$filename;
            }
		
			move_uploaded_file($_FILES["files"]["tmp_name"], $link_file);
		}
		
		$contabilita = new Contabilita();
		$e_query_inserimento = $contabilita->inserisci($id_commessa, $descrizione_lavori, $p1, $b, $l, $a, $p, $target_path_inserimento, $filename, $prezzo, $importo);
		
		//LOG
		$log->inserisciLog("Inserimento contabilita per commessa ".$id_commessa." | id inserito=".$e_query_inserimento, $_SESSION['username'], "verde");
		echo $e_query_inserimento;
	break;
	
	case "elimina":
		$contabilita = new Contabilita();
		$id = $_POST['id'];
		$id_commessa = $_POST['id_commessa'];
		$nome = $_POST['nome'];
		$e_query_elimina = $contabilita->elimina($id);
		if($e_query_elimina > 0){
			if($nome != ""){
				$target_path = "../uploads/commesse/".$id_commessa."/contabilita/".$nome;
				if (file_exists($target_path)) { 
					unlink($target_path);
				}
			}

		}
		//LOG
		$log->inserisciLog("Eliminazione contabilit&agrave;: id=".$id, $_SESSION['username'], "rosso");
		echo $e_query_elimina;
		
	break;	
	
	case "elimina_allegato":
		$contabilita = new Contabilita();
		$id = $_POST['id'];
		$id_commessa = $_POST['id_commessa'];
		$nome = $_POST['nome'];
		$e_query_elimina = $contabilita->eliminaAllegato($id);
		if($e_query_elimina >= 0){
			//elimino fisicamente l'allegato
			$target_path = "../uploads/commesse/".$id_commessa."/contabilita/".$nome;
			if (file_exists($target_path)) { 
				unlink($target_path);
			}
		}
		//LOG
		$log->inserisciLog("Eliminazione allegato contabilita: ".$nome, $_SESSION['username'], "rosso");
		echo $e_query_elimina;
	break;
	
	case "modifica":
		$id = $_POST['id_da_modificare'];
		$id_commessa = $_POST['id_commessa'];
		$descrizione_lavori = $_POST['descrizione_lavori'];
		$p1 = $_POST['p1'];
		$b = $_POST['b'];
		$l = $_POST['l'];
		$a = $_POST['a'];
		$p = $_POST['p'];
		$prezzo = $_POST['prezzo'];
		$importo = $_POST['importo'];

		$prezzo = str_replace(",", ".", $prezzo);
		$importo = str_replace(",", ".", $importo);

		//perorso dove fare upload file
		$target_path = "../uploads/commesse/".$id_commessa."/contabilita/";
		$target_path_inserimento = "uploads/commesse/".$id_commessa."/contabilita/";
		
		//nome del file
		$filename = $_FILES['files']['name'];

		if($filename != ""){
			//creo cartella se non esiste
			if (!is_dir($target_path)) { 
				$crea = mkdir($target_path, 0777, true);
			}
			
			
            $link_file = "../uploads/commesse/".$id_commessa."/contabilita/".$filename;
		    if (file_exists($link_file)) { 
                $filename = date("d_m_Y_h_i_s").$filename;
                $link_file = "../uploads/commesse/".$id_commessa."/contabilita/".$filename;
            }
			move_uploaded_file($_FILES["files"]["tmp_name"], $link_file);
		}
		
		$contabilita = new Contabilita();
		$e_query_inserimento = $contabilita->modifica($id, $id_commessa, $descrizione_lavori, $p1, $b, $l, $a, $p, $target_path_inserimento, $filename, $prezzo, $importo);
		
		$log->inserisciLog("Modifica contabilita per commessa ".$id_commessa, $_SESSION['username'], "blu");
		echo $e_query_inserimento;
	break;	
}	

?>