<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.ProgrammazioneCantiere.php");
require_once("../classi/class.Log.php");
require_once("../classi/class.TestataMagazzino.php");

session_start();

$tipo = $_POST['tipo'];
$log = new Log();

switch($tipo){
	case "inserimento":
		$tipologia_lavoro = $_POST['tipologia_lavoro'];
		$dettagli_commessa = $_POST['dettagli_commessa'];
		$dettagli_lavoro = $_POST['dettagli_lavoro'];
		 $addetti_dati = $_POST['addetti'];
		$dati_addetti_esplosi = explode(",", $addetti_dati);
		for($i = 0; $i<count($dati_addetti_esplosi); $i++){
			$dati = explode("-", $dati_addetti_esplosi[$i]);
			if($i == count($dati_addetti_esplosi)-1){
				$addetti .= $dati[1];
				$id_dipendenti .= $dati[0];
			} else {
				$addetti .= $dati[1].",";
				$id_dipendenti .= $dati[0].",";
			}
		}
		$note = $_POST['note'];
		
		$dettagli_mezzo = $_POST['mezzo'];
		if($dettagli_mezzo != "") {
			$dati_mezzo_esplosi = explode("-", $dettagli_mezzo);
			$id_mezzo = $dati_mezzo_esplosi[0];
			$mezzo = $dati_mezzo_esplosi[1];
		} else {
			$id_mezzo = -1;
			$mezzo = "nessuno";
		}
		// $mezzo = $_POST['mezzo'];
		$data = $_POST['data'];
		$data = CapovolgiData($data);
		$id_lavoro="";
		$dati_commessa_esplosi = explode("-", $dettagli_commessa);
		$id_commessa = $dati_commessa_esplosi[0];
		$cod_commessa = $dati_commessa_esplosi[1];
		$descrizione_commessa = $dati_commessa_esplosi[2];
		
		$descrizione_commessa = StringInputCleaner($descrizione_commessa);
		//$descrizione_commessa = str_replace("°", "&deg;", $descrizione_commessa);
		
		$dati_lavoro_esplosi = explode("-", $dettagli_lavoro);
		// $id_lavoro = $dati_lavoro_esplosi[0];
		// $cod_lavoro = $dati_lavoro_esplosi[1];
		// $descrizione_lavoro = $dati_lavoro_esplosi[2];
		
		$id_lavoro = 0;
		$cod_lavoro = "";
		$descrizione_lavoro = "";
		
		$cantiere = new ProgrammazioneCantiere();
		$e_query_inserimento = $cantiere->inserisci($id_commessa, $cod_commessa, $descrizione_commessa, $id_lavoro, $cod_lavoro, $descrizione_lavoro, $id_dipendenti, $addetti, $id_mezzo, $mezzo, $note, $data, $tipologia_lavoro);
		
		
		$verifica_mezzo = new TestataMagazzino();
		$e_query_verifica_mezzo = $verifica_mezzo->caricaNew($data);
		$controllo_mezzo = 0;
		if($e_query_verifica_mezzo->num_rows > 0){
			while($row_mezzo = $e_query_verifica_mezzo->fetch_array()){
				if($id_mezzo == $row_mezzo['id_mezzo'] && $id_commessa == $row_mezzo['id_commessa']){
					$controllo_mezzo += 1;
				}
			}
		} else {
			$controllo_mezzo = -1;
		}
		
		//LOG
		$log->inserisciLog("Inserimento programmazione giornaliera cantiere", $_SESSION['username'], "verde");
		if($controllo_mezzo == -1 || $controllo_mezzo > 0){
		echo $e_query_inserimento;
		} else {
			echo $e_query_inserimento."-MEZZO";
		}
	break;
	
	case "elimina":
		$cantiere = new ProgrammazioneCantiere();
		$id = $_POST['id'];
		$e_query_elimina = $cantiere->elimina($id);
		
		//LOG
		$log->inserisciLog("Eliminazione programmazione giornaliere cantiere", $_SESSION['username'], "rosso");
		echo $e_query_elimina;
		
	break;	
	
	case "clona_ieri":
		$data = $_POST['data'];
		$data = CapovolgiData($data);
		$data_nuova = $_POST['data_oggi'];
		$data_nuova = CapovolgiData($data_nuova);
		$cantiere = new ProgrammazioneCantiere();
		$e_query = $cantiere->carica($data);
		
		if($cantiere->numero() > 0){
			
		while($row = $e_query->fetch_array()){
			$e_query_inserimento = $cantiere->inserisci($row['id_commessa'], $row['cod_commessa'], StringInputCleaner($row['descrizione_commessa']), $row['id_lavoro'], $row['cod_lavoro'], $row['descrizione_lavoro'], $row['id_dipendenti'], $row['addetti'], $row['id_mezzo'], $row['mezzo'], StringInputCleaner($row['note']), $data_nuova, $row['tipologia_lavoro']);
		}	
		//LOG
		$log->inserisciLog("Clonazione programmazione giornaliere cantiere", $_SESSION['username'], "rosso");
		echo $cantiere->numero();
		} else {
			echo "NO";
		}
		
	break;	
	
	case "modifica":
		$id = $_POST['id'];
		$tipologia_lavoro = $_POST['tipologia_lavoro'];
		$dettagli_commessa = $_POST['dettagli_commessa'];
		$dettagli_lavoro = $_POST['dettagli_lavoro'];
		$addetti_dati = $_POST['addetti'];
		
		$dati_addetti_esplosi = explode(",", $addetti_dati);
		for($i = 0; $i<count($dati_addetti_esplosi); $i++){
			$dati = explode("-", $dati_addetti_esplosi[$i]);
			if($i == count($dati_addetti_esplosi)-1){
				$addetti .= $dati[1];
				$id_dipendenti .= $dati[0];
			} else {
				$addetti .= $dati[1].",";
				$id_dipendenti .= $dati[0].",";
			}
		}
		
		
		$note = $_POST['note'];
		$dettagli_mezzo = $_POST['mezzo'];

		if($dettagli_mezzo != "") {
			$dati_mezzo_esplosi = explode("-", $dettagli_mezzo);
			$id_mezzo = $dati_mezzo_esplosi[0];
			$mezzo = $dati_mezzo_esplosi[1];
		} else {
			$id_mezzo = -1;
			$mezzo = "nessuno";
		}

		$data = $_POST['data'];
		$data = CapovolgiData($data);
		$id_lavoro="";
		$dati_commessa_esplosi = explode("-", $dettagli_commessa);
		$id_commessa = $dati_commessa_esplosi[0];
		$cod_commessa = $dati_commessa_esplosi[1];
		$descrizione_commessa = $dati_commessa_esplosi[2];
		
		$descrizione_commessa = StringInputCleaner($descrizione_commessa);
		//$descrizione_commessa = str_replace("°", "&deg;", $descrizione_commessa);
		
		$dati_lavoro_esplosi = explode("-", $dettagli_lavoro);
		$id_lavoro = 0;
		$cod_lavoro = '';
		$descrizione_lavoro = "";

		$cantiere = new ProgrammazioneCantiere();
		$e_query_modifica = $cantiere->modifica($id, $id_commessa, $cod_commessa, $descrizione_commessa, $id_lavoro, $cod_lavoro, $descrizione_lavoro, $id_dipendenti, $addetti, $id_mezzo, $mezzo, $note, $data, $tipologia_lavoro);
		
		$verifica_mezzo = new TestataMagazzino();
		$e_query_verifica_mezzo = $verifica_mezzo->caricaNew($data);
		$controllo_mezzo = 0;
		if($e_query_verifica_mezzo->num_rows > 0){
			while($row_mezzo = $e_query_verifica_mezzo->fetch_array()){
				if($id_mezzo == $row_mezzo['id_mezzo'] && $id_commessa == $row_mezzo['id_commessa']){
					$controllo_mezzo += 1;
				}
			}
		} else {
			$controllo_mezzo = -1;
		}
		//LOG
		$log->inserisciLog("Modifica programmazione giornaliera cantiere", $_SESSION['username'], "verde");
		if($controllo_mezzo == -1 || $controllo_mezzo > 0){
		echo $e_query_modifica;
		} else {
			echo $e_query_modifica."-MEZZO";;
		}
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