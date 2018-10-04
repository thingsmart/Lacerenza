<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.Personale.php");
require_once("../classi/class.Log.php");
session_start();

$tipo = $_POST['tipo'];
$log = new Log();

switch($tipo){
	case "inserimento":
		$id_commessa = $_POST['id_commessa'];
		$personale = $_POST['personale_dati'];
        $dati_esplosi = explode("-", $personale);

		$id_dipendente = $dati_esplosi[0];
		$nome = $dati_esplosi[1];
		$cognome = $dati_esplosi[2];
		$costo_h = $_POST['costo_h'];
        $costo_h = str_replace(",", ".", $costo_h);
		
		$nome = StringInputCleaner($nome);
		//$nome = str_replace("°", "&deg;", $nome);
		
		$cognome = StringInputCleaner($cognome);
		//$cognome = str_replace("°", "&deg;", $cognome);
		
		//controllo se il dipendente immesso � presente in anagrafica
		$query = "SELECT * FROM tb_dipendenti WHERE id=$id_dipendente;";
        $e_query_dipendente = EseguiQuery($query,"selezione");
        if($e_query_dipendente->num_rows > 0){
            
            $personale = new Personale();
            $e_query_inserimento = $personale->inserisciPersonale($id_commessa, $id_dipendente, $nome, $cognome, $costo_h);
            
            //LOG
            $log->inserisciLog("Inserimento personale", $_SESSION['username'], "verde");
            echo $e_query_inserimento;
        } else {
            echo "errore_dipendente";
        }
        break;
	
	case "elimina":
		$personale = new Personale();
		$id = $_POST['id'];
		$e_query_elimina = $personale->eliminaPersonale($id);
		
		//LOG
		$log->inserisciLog("Eliminazione personale", $_SESSION['username'], "rosso");
		echo $e_query_elimina;
		
        break;	
	
	
	
	case "modifica":
		$id = $_POST['id_da_modificare'];
		$id_commessa = $_POST['id_commessa'];
		$personale = $_POST['personale_dati'];
        $dati_esplosi = explode("-", $personale);

		$id_dipendente = $dati_esplosi[0];
		$nome = $dati_esplosi[1];
		$cognome = $dati_esplosi[2];
		$costo_h = $_POST['costo_h'];
        $costo_h = str_replace(",", ".", $costo_h);
		
		$nome = StringInputCleaner($nome);
		//$nome = str_replace("°", "&deg;", $nome);
		
		$cognome = StringInputCleaner($cognome);
		//$cognome = str_replace("°", "&deg;", $cognome);
		
		$personale = new Personale();
		$e_query_inserimento = $personale->modificaPersonale($id, $id_commessa, $id_dipendente, $nome, $cognome, $costo_h);
		
		$log->inserisciLog("Modifica personale", $_SESSION['username'], "blu");
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