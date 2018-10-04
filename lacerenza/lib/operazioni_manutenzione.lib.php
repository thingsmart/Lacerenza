<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.Manutenzione.php");
require_once("../classi/class.Log.php");
session_start();

$tipo = $_POST['tipo'];
$log = new Log();

switch($tipo){
	case "inserimento":
		$dettagli_mezzo = $_POST['dettagli_mezzo'];
		$dati_mezzo_esplosi = explode("-", $dettagli_mezzo);
		$id_mezzo = $dati_mezzo_esplosi['0'];
		$mezzo = $dati_mezzo_esplosi['1'];
		$data = $_POST['data'];
		$data = CapovolgiData($data);
		$libretto = $_POST['libretto'];
		$assicurazione = $_POST['assicurazione'];
		$olio_cambio = $_POST['olio_cambio'];
		$olio_motore = $_POST['olio_motore'];
		$estintori = $_POST['estintori'];
		$pneumatici = $_POST['pneumatici'];
		$elettrico = $_POST['elettrico'];
		$triangolo = $_POST['triangolo'];
		$giubbino = $_POST['giubbino'];
		$vetri = $_POST['vetri'];
		$pronto_soccorso = $_POST['pronto_soccorso'];
		$carrozzeria = $_POST['carrozzeria'];
		$freni = $_POST['freni'];
		$luci = $_POST['luci'];
		$tergicristalli = $_POST['tergicristalli'];
		$indicatori = $_POST['indicatori'];
		$climatizzatore = $_POST['climatizzatore'];
		$altro = $_POST['altro'];
		$note = $_POST['note'];
		$mese = $_POST['mese'];
		$anno = $_POST['anno'];
		$data = date($anno."-".$mese."-1");
		
		$note = StringInputCleaner($note);
		
		

		
		$manutenzione = new Manutenzione();
		$e_query_inserimento = $manutenzione->inserisci($id_mezzo,$mezzo, $data,$libretto,$assicurazione,$olio_cambio,$olio_motore,$estintori,$pneumatici,$elettrico,$triangolo,$giubbino,$vetri,$pronto_soccorso,$carrozzeria,$freni,$luci,$tergicristalli,$indicatori,$climatizzatore,$altro,$note);
		
		//LOG
		$log->inserisciLog("Inserimento manutenzione ".$data, $_SESSION['username'], "verde");
		echo $e_query_inserimento;
	break;
	
case "clona":
		$mese = $_POST['mese'];
		$anno = $_POST['anno'];
		$id_mezzo = $_POST['id_mezzo'];
		$data = date($anno."-".$mese."-1");
		if($mese == "01"){
			$anno = $anno-1;
		}
		$mese = mese_precedente($mese);
		
		$manutenzione = new Manutenzione();
		$e_query = $manutenzione->caricaMese($mese, $anno, $id_mezzo);
		if($e_query->num_rows > 0){
			$row = $e_query->fetch_array();
			$e_query_inserimento = $manutenzione->inserisci($row['id_mezzo'],$row['mezzo'], $data,$row['libretto'],$row['assicurazione'],$row['olio_cambio'],$row['olio_motore'],$row['estintori'],$row['pneumatici'],$row['elettrico'],$row['triangolo'],$row['giubbino'],$row['vetri'],$row['pronto_soccorso'],$row['carrozzeria'],$row['freni'],$row['luci'],$row['tergicristalli'],$row['indicatori'],$row['climatizzatore'],$row['altro'],$row['note']);
			
			//LOG
			$log->inserisciLog("Inserimento manutenzione ".$data, $_SESSION['username'], "verde");
			echo $e_query_inserimento;
		} else {
			echo "ERRORE";
		}
	break;
	
	
	
	case "modifica":
		$id = $_POST['id'];
		$dettagli_mezzo = $_POST['dettagli_mezzo'];
		$dati_mezzo_esplosi = explode("-", $dettagli_mezzo);
		$id_mezzo = $dati_mezzo_esplosi['0'];
		$mezzo = $dati_mezzo_esplosi['1'];
		$data = $_POST['data'];
		$data = CapovolgiData($data);
		$libretto = $_POST['libretto'];
		$assicurazione = $_POST['assicurazione'];
		$olio_cambio = $_POST['olio_cambio'];
		$olio_motore = $_POST['olio_motore'];
		$estintori = $_POST['estintori'];
		$pneumatici = $_POST['pneumatici'];
		$elettrico = $_POST['elettrico'];
		$triangolo = $_POST['triangolo'];
		$giubbino = $_POST['giubbino'];
		$vetri = $_POST['vetri'];
		$pronto_soccorso = $_POST['pronto_soccorso'];
		$carrozzeria = $_POST['carrozzeria'];
		$freni = $_POST['freni'];
		$luci = $_POST['luci'];
		$tergicristalli = $_POST['tergicristalli'];
		$indicatori = $_POST['indicatori'];
		$climatizzatore = $_POST['climatizzatore'];
		$altro = $_POST['altro'];
		$note = $_POST['note'];

$note = StringInputCleaner($note);
		$manutenzione = new Manutenzione();
		$e_query_modifica = $manutenzione->modifica($id, $id_mezzo,$mezzo, $data,$libretto,$assicurazione,$olio_cambio,$olio_motore,$estintori,$pneumatici,$elettrico,$triangolo,$giubbino,$vetri,$pronto_soccorso,$carrozzeria,$freni,$luci,$tergicristalli,$indicatori,$climatizzatore,$altro,$note);
		
		//LOG
		$log->inserisciLog("Modifica manutenzione ".$data , $_SESSION['username'], "verde");
		echo $e_query_modifica;
	break;	
}	



function mese_precedente($mese) {
	$mese_precedente = 0;
	switch($mese){
		case "01":
			$mese_precedente = "12";
		break;
		case "02":
			$mese_precedente = "01";
		break;
		case "03":
			$mese_precedente = "02";
		break;
		case "04":
			$mese_precedente = "03";
		break;
		case "05":
			$mese_precedente = "04";
		break;
		case "06":
			$mese_precedente = "05";
		break;
		case "07":
			$mese_precedente = "06";
		break;
		case "08":
			$mese_precedente = "07";
		break;
		case "09":
			$mese_precedente = "08";
		break;
		case "10":
			$mese_precedente = "09";
		break;
		case "11":
			$mese_precedente = "10";
		break;
		case "12":
			$mese_precedente = "11";
		break;
	}
	return $mese_precedente;
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