<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.Veicoli.php");
require_once("../classi/class.Log.php");
session_start();

$tipo = $_POST['tipo'];
$log = new Log();

switch($tipo){
	case "inserimento":
		$id_commessa = $_POST['id_commessa'];
		$veicolo = $_POST['veicolo_dati'];
        $dati_esplosi = explode("-", $veicolo);

		$id_veicolo = $dati_esplosi[0];
		$mezzo = $dati_esplosi[1];
		$targa = $dati_esplosi[2];
		$costo_h = $_POST['costo_h'];
        $costo_h = str_replace(",", ".", $costo_h);
		//controllo se il dipendente immesso � presente in anagrafica
		$query = "SELECT * FROM tb_mezzi WHERE id=$id_veicolo;";
        $e_query_veicolo = EseguiQuery($query,"selezione");
        if($e_query_veicolo->num_rows > 0){
            
            $veicolo = new Veicoli();
            $e_query_inserimento = $veicolo->inserisciVeicolo($id_commessa, $id_veicolo, $mezzo, $targa, $costo_h);
            
            //LOG
            $log->inserisciLog("Inserimento veicolo", $_SESSION['username'], "verde");
            echo $e_query_inserimento;
        } else {
            echo "errore_veicolo";
        }
        break;
	
	case "elimina":
		$veicolo = new Veicoli();
		$id = $_POST['id'];
		$e_query_elimina = $veicolo->eliminaVeicolo($id);
		
		//LOG
		$log->inserisciLog("Eliminazione veicolo", $_SESSION['username'], "rosso");
		echo $e_query_elimina;
		
        break;	
	
	
	
	case "modifica":
		$id = $_POST['id_da_modificare'];
		$id_commessa = $_POST['id_commessa'];
		$veicolo = $_POST['veicolo_dati'];
        $dati_esplosi = explode("-", $veicolo);

		$id_veicolo = $dati_esplosi[0];
		$mezzo = $dati_esplosi[1];
		$targa = $dati_esplosi[2];
		$costo_h = $_POST['costo_h'];
        $costo_h = str_replace(",", ".", $costo_h);
		
		
		$veicolo = new Veicoli();
		$e_query_inserimento = $veicolo->modificaVeicolo($id, $id_commessa, $id_veicolo, $mezzo, $targa, $costo_h);
		
		$log->inserisciLog("Modifica veicolo", $_SESSION['username'], "blu");
		echo $e_query_inserimento;
        break;	
}	



?>