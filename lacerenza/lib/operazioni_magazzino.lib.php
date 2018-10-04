<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.Magazzino.php");
require_once("../classi/class.TestataMagazzino.php");
require_once("../classi/class.ProgrammazioneCantiere.php");

require_once("../classi/class.Log.php");
session_start();

$tipo = $_POST['tipo'];
$log = new Log();

switch($tipo){
	case "inserimento":
		$dettagli_commessa = $_POST['dettagli_commessa'];
		$dettagli_mezzo = $_POST['dettagli_mezzo'];
				
		$dati_mezzo_esplosi = explode("-", $dettagli_mezzo);
		$id_mezzo = $dati_mezzo_esplosi[0];
		$mezzo = $dati_mezzo_esplosi[1];
				
		$dati_commessa_esplosi = explode("-", $dettagli_commessa);
		$id_commessa = $dati_commessa_esplosi[0];
		$descrizione_commessa = $dati_commessa_esplosi[1];

		$data = $_POST['data'];
		$data = CapovolgiData($data);

		$descrizione_commessa = StringInputCleaner($descrizione_commessa);
		//$descrizione_commessa = str_replace("°", "&deg;", $descrizione_commessa);
		
		$magazzino = new TestataMagazzino();
		$e_query_inserimento = $magazzino->inserisci($data, $mezzo, $id_mezzo, $id_commessa, $descrizione_commessa);
		
		$verifica_mezzo = new ProgrammazioneCantiere();
		$e_query_verifica_mezzo = $verifica_mezzo->carica($data);
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
		$log->inserisciLog("Inserimento magazzino", $_SESSION['username'], "verde");
		if($controllo_mezzo == -1 || $controllo_mezzo > 0){
		echo $e_query_inserimento;
		} else {
			echo $e_query_inserimento."-MEZZO";
		}
	break;
	
	case "elimina":
		$magazzino = new TestataMagazzino();
		$id = $_POST['id'];
		$e_query_elimina = $magazzino->elimina($id);
		
		//LOG
		$log->inserisciLog("Eliminazione magazzino", $_SESSION['username'], "rosso");
		echo $e_query_elimina;
		
	break;	
	
	case "modifica":
		$id = $_POST['id'];
		$dettagli_commessa = $_POST['dettagli_commessa'];
		$dettagli_mezzo = $_POST['dettagli_mezzo'];
				
		$dati_mezzo_esplosi = explode("-", $dettagli_mezzo);
		$id_mezzo = $dati_mezzo_esplosi[0];
		$mezzo = $dati_mezzo_esplosi[1];
		
		$dati_commessa_esplosi = explode("-", $dettagli_commessa);
		$id_commessa = $dati_commessa_esplosi[0];
		$descrizione_commessa = $dati_commessa_esplosi[1];

		$data = $_POST['data'];
		$data = CapovolgiData($data);

		$descrizione_commessa = StringInputCleaner($descrizione_commessa);
		//$descrizione_commessa = str_replace("°", "&deg;", $descrizione_commessa);
		
		$magazzino = new TestataMagazzino();
		$e_query_modifica = $magazzino->modifica($id, $data, $mezzo, $id_mezzo, $id_commessa, $descrizione_commessa);
		
		$verifica_mezzo = new ProgrammazioneCantiere();
		$e_query_verifica_mezzo = $verifica_mezzo->carica($data);
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
		$log->inserisciLog("Modifica magazzino", $_SESSION['username'], "verde");
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