<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.Ruolino.php");
require_once("../classi/class.Veicoli.php");
require_once("../classi/class.Terzi.php");
require_once("../classi/class.Log.php");
session_start();

$tipo = $_POST['tipo'];
$log = new Log();

switch($tipo){
	case "inserimento":
		$dettagli_commessa = $_POST['dettagli_commessa'];
		$dettagli_lavoro = $_POST['dettagli_lavoro'];
		$note = $_POST['note'];
		$ore = $_POST['ore'];
		$ore = str_replace(",", ".", $ore);
		$autista = $_POST['autista'];
		$quantita = $_POST['quantita'];
		$terzi = $_POST['terzi'];
		$ore_terzi = $_POST['ore_terzi'];
		$ore_terzi = str_replace(",", ".", $ore_terzi);
		$km = $_POST['km'];
		$tipologia = $_POST['tipologia'];
		$data = $_POST['data'];
		$data = CapovolgiData($data);
		$clima = $_POST['clima'];
		$clima = str_replace(" ", "_", $clima);
		$note = StringInputCleaner($note);
		//$note = str_replace("°", "&deg;", $note);
		
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
			// /////PROVA
// 			
// 			
		// $id_dipendente = $dati[0];
		// $dettagli_commessa = $dettagli_commessa;
		// $dati_esplosi = explode("-", $dettagli_commessa);
		// $id_commessa = $dati_esplosi[0];
// 		
		// $costo = "0";
		// $costo = str_replace(",", ".", $costo);
// 		
		// $dettagli = "";
		// $n_ore = $ore;
        // $n_ore = str_replace(",", ".", $n_ore);
//         
		// $presenze = new Presenze();
		// $e_query_inserimento = $presenze->inserisciPresenza($id_commessa, $id_dipendente, $data, $dettagli, $n_ore, $costo);
			// /////FINE PROVA
		}
		
		
		$dettagli_mezzo = $_POST['mezzo'];
		$dati_mezzo_esplosi = explode("-", $dettagli_mezzo);
		$id_mezzo = $dati_mezzo_esplosi[0];
		$mezzo = $dati_mezzo_esplosi[1];

		//INSERIRE VERIFICA ESISTENZA MEZZO
		//INSERIRE VERIFICA ESISTENZA LAVORO
		//INSERIRE VERIFICA ESISTENZA COMMESSA
		$id_lavoro="";
		$dati_commessa_esplosi = explode("-", $dettagli_commessa);
		$id_commessa = $dati_commessa_esplosi[0];
		$cod_commessa = $dati_commessa_esplosi[1];
		$descrizione_commessa = $dati_commessa_esplosi[2];
		
		$descrizione_commessa = StringInputCleaner($descrizione_commessa);
		//$descrizione_commessa = str_replace("°", "&deg;", $descrizione_commessa);
		// $dati_lavoro_esplosi = explode("-", $dettagli_lavoro);
		// $id_lavoro = $dati_lavoro_esplosi[0];
		// $cod_lavoro = $dati_lavoro_esplosi[1];
		// $descrizione_lavoro = $dati_lavoro_esplosi[2];
		$id_lavoro = -1;
		$cod_lavoro = -1;
		$descrizione_lavoro = $dettagli_lavoro;
		$descrizione_lavoro = StringInputCleaner($descrizione_lavoro);
		//$descrizione_lavoro = str_replace("°", "&deg;", $descrizione_lavoro);
		$terzi = StringInputCleaner($terzi);
		//$terzi = str_replace("°", "&deg;", $terzi);
		$ruolino = new Ruolino();
		$e_query_inserimento = $ruolino->inserisci($id_commessa, $cod_commessa, $descrizione_commessa, $id_lavoro, $cod_lavoro, $descrizione_lavoro, $id_dipendenti, $addetti, $note, $data, $ore, $autista, $terzi, $ore_terzi, $quantita, $clima, $tipologia);
		
		//LOG
		$log->inserisciLog("Inserimento ruolino giornaliero", $_SESSION['username'], "verde");
		echo $e_query_inserimento;
	break;
	
case "inserimento_mezzo":
	$dettagli_commessa = $_POST['dettagli_commessa'];
	$dettagli_mezzo = $_POST['mezzo'];
	$costo = $_POST['costo'];
	$km = $_POST['km'];
	$data = $_POST['data'];
	$data = CapovolgiData($data);
	
	$dati_commessa = explode("-", $dettagli_commessa);
	$id_commessa = $dati_commessa[0];
	
	$dati_mezzo = explode("-", $dettagli_mezzo);
	$id_mezzo = $dati_mezzo[0];
	$mezzo = $dati_mezzo[1];
	
	$veicolo = new Veicoli();
	$e_query_inserimento = $veicolo->inserisciVeicolo($id_commessa, $id_mezzo, $mezzo, '', $costo, $data, $km);
	echo $e_query_inserimento;
break;

case "inserimento_terzi":
	$dettagli_commessa = $_POST['dettagli_commessa'];
	$dettagli_mezzo = $_POST['mezzo'];
	$descrizione = $_POST['descrizione'];
	$ore = $_POST['ore'];
	$data = $_POST['data'];
	$data = CapovolgiData($data);
	$ore = str_replace(",", ".", $ore);
	$dati_commessa = explode("-", $dettagli_commessa);
	$id_commessa = $dati_commessa[0];
	$descrizione = StringInputCleaner($descrizione);	
	$terzi = new Terzi();
	$e_query_inserimento = $terzi->inserisci($id_commessa, $data, $descrizione, $ore);
	echo $e_query_inserimento;
break;

case "elimina_terzi":
		$terzi = new Terzi();
		$id = $_POST['id'];
		$e_query_elimina = $terzi->elimina($id);
		
		//LOG
		$log->inserisciLog("Eliminazione terzi", $_SESSION['username'], "rosso");
		echo $e_query_elimina;
		
        break;	
	
	case "elimina":
		$ruolino = new Ruolino();
		$id = $_POST['id'];
		$id_commessa = $_POST['id_commessa'];
		$data = $_POST['data'];
		$data = CapovolgiData($data);
		$e_query_elimina = $ruolino->elimina($id);
		
		//verifico se non ho alcun dato su questa commessa elimino anche i mezzi
		
		$numero_commesse = $ruolino->conta_commesse($id_commessa, $data);
		if($numero_commesse == 0){
			$veicolo = new Veicoli();
			$e_query_elimina_veicoli = $veicolo->elimina_veicoli($id_commessa, $data);
		
			$terzi = new Terzi();
			$e_query_elimina_terzi = $terzi->elimina_terzi($id_commessa, $data);
		}
		
		
		//LOG
		$log->inserisciLog("Eliminazione ruolino giornaliero", $_SESSION['username'], "rosso");
		echo $e_query_elimina;
		
	break;	
	
	case "modifica":
		$id = $_POST['id'];
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
		$ore = $_POST['ore'];
		$ore = str_replace(",", ".", $ore);
		$autista = $_POST['autista'];
		$quantita = $_POST['quantita'];
		$terzi = $_POST['terzi'];
		$ore_terzi = $_POST['ore_terzi'];
		$ore_terzi = str_replace(",", ".", $ore_terzi);
		$km = $_POST['km'];
		$tipologia = $_POST['tipologia'];
		$clima = $_POST['clima'];
		$clima = str_replace(" ", "_", $clima);
		$note = StringInputCleaner($note);
		//$note = str_replace("°", "&deg;", $note);
		
		$dettagli_mezzo = $_POST['mezzo'];
		$dati_mezzo_esplosi = explode("-", $dettagli_mezzo);
		$id_mezzo = $dati_mezzo_esplosi[0];
		$mezzo = $dati_mezzo_esplosi[1];
		$data = $_POST['data'];
		$data = CapovolgiData($data);
		$id_lavoro="";
		$dati_commessa_esplosi = explode("-", $dettagli_commessa);
		$id_commessa = $dati_commessa_esplosi[0];
		$cod_commessa = $dati_commessa_esplosi[1];
		$descrizione_commessa = $dati_commessa_esplosi[2];
		
		$descrizione_commessa = StringInputCleaner($descrizione_commessa);
		//$descrizione_commessa = str_replace("°", "&deg;", $descrizione_commessa);
		// $dati_lavoro_esplosi = explode("-", $dettagli_lavoro);
		// $id_lavoro = $dati_lavoro_esplosi[0];
		// $cod_lavoro = $dati_lavoro_esplosi[1];
		// $descrizione_lavoro = $dati_lavoro_esplosi[2];
		
		$id_lavoro = -1;
		$cod_lavoro = -1;
		$descrizione_lavoro = $dettagli_lavoro;
		$descrizione_lavoro = StringInputCleaner($descrizione_lavoro);
		//$descrizione_lavoro = str_replace("°", "&deg;", $descrizione_lavoro);
		$terzi = StringInputCleaner($terzi);
		//$terzi = str_replace("°", "&deg;", $terzi);
		$ruolino = new Ruolino();
		$e_query_modifica = $ruolino->modifica($id, $id_commessa, $cod_commessa, $descrizione_commessa, $id_lavoro, $cod_lavoro, $descrizione_lavoro, $id_dipendenti, $addetti, $note, $data, $ore, $autista, $terzi, $ore_terzi, $quantita,  $clima, $tipologia);
		
		//LOG
		$log->inserisciLog("Modifica ruolino giornaliero", $_SESSION['username'], "verde");
		echo $e_query_modifica;
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