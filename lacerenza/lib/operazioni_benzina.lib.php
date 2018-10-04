<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.Benzine.php");
require_once("../classi/class.Log.php");
require_once("../classi/class.Mezzi.php");

session_start();

$tipo = $_POST['tipo'];
$log = new Log();

switch($tipo){
	case "inserimento":
		$id_mezzo = $_POST['id_mezzo'];
		$numero_carta = $_POST['numero_carta'];
		$titolare_carta = $_POST['titolare_carta'];
		$localita = $_POST['localita'];
		$codice_autista = $_POST['codice_autista'];
		$km_veicolo = $_POST['km_veicolo'];
		$quantita_litri = $_POST['quantita_litri'];
		$prezzo_pompa = $_POST['prezzo_pompa'];
		$aliq_iva = $_POST['aliq_iva'];
		$importo_ticket = $_POST['importo_ticket'];
		$sconto = $_POST['sconto'];
		$prezzo_escluso_iva = $_POST['prezzo_escluso_iva'];
		$importo_netto = $_POST['importo_netto'];
		$importo_iva = $_POST['importo_iva'];
		$totale_iva_inclusa = $_POST['totale_iva_inclusa'];
		$prodotto_servizio = $_POST['prodotto_servizio'];
		$targa = $_POST['targa'];
		$data = $_POST['data'];
        $data = CapovolgiData($data);
        
        $prezzo_pompa = str_replace(",", ".", $prezzo_pompa);
        $quantita_litri = str_replace(",", ".", $quantita_litri);
        $sconto = str_replace(",", ".", $sconto);
        $importo_ticket = str_replace(",", ".", $importo_ticket);
        $prezzo_escluso_iva = str_replace(",", ".", $prezzo_escluso_iva);
        $importo_netto = str_replace(",", ".", $importo_netto);
        $importo_iva = str_replace(",", ".", $importo_iva);
        $totale_iva_inclusa = str_replace(",", ".", $totale_iva_inclusa);
        $aliq_iva = str_replace(",", ".", $aliq_iva);

        $benzina = new Benzine();
		$e_query_inserimento = $benzina->inserisciBenzina($id_mezzo, $data, $targa, $prodotto_servizio, $totale_iva_inclusa, $importo_iva, $importo_netto, $prezzo_escluso_iva, $numero_carta, $titolare_carta, $localita, $codice_autista, $km_veicolo, $quantita_litri, $prezzo_pompa, $aliq_iva, $importo_ticket, $sconto);
        if($e_query_inserimento >= 0){
			$mezzo = new Mezzi();
			$mezzo->modificaKm($id_mezzo, $km_veicolo);
		}
            //LOG
		$log->inserisciLog("Inserimento esso card", $_SESSION['username'], "verde");
		echo $e_query_inserimento;
	break;
	
	case "elimina":
		$benzina = new Benzine();
		$id = $_POST['id'];
		$e_query_elimina = $benzina->eliminaBenzina($id);
		$log->inserisciLog("Eliminazione esso card", $_SESSION['username'], "rosso");
		echo $e_query_elimina;
		
	break;	
	
	
	
	case "modifica":
		$id = $_POST['id_da_modificare'];
		$id_mezzo = $_POST['id_mezzo'];
		$numero_carta = $_POST['numero_carta'];
		$titolare_carta = $_POST['titolare_carta'];
		$localita = $_POST['localita'];
		$codice_autista = $_POST['codice_autista'];
		$km_veicolo = $_POST['km_veicolo'];
		$quantita_litri = $_POST['quantita_litri'];
		$prezzo_pompa = $_POST['prezzo_pompa'];
		$aliq_iva = $_POST['aliq_iva'];
		$importo_ticket = $_POST['importo_ticket'];
		$sconto = $_POST['sconto'];
		$prezzo_escluso_iva = $_POST['prezzo_escluso_iva'];
		$importo_netto = $_POST['importo_netto'];
		$importo_iva = $_POST['importo_iva'];
		$totale_iva_inclusa = $_POST['totale_iva_inclusa'];
		$prodotto_servizio = $_POST['prodotto_servizio'];
		$targa = $_POST['targa'];
		$data = $_POST['data'];
        $data = CapovolgiData($data);
		
		$prezzo_pompa = str_replace(",", ".", $prezzo_pompa);
        $quantita_litri = str_replace(",", ".", $quantita_litri);
        $sconto = str_replace(",", ".", $sconto);
        $importo_ticket = str_replace(",", ".", $importo_ticket);
        $prezzo_escluso_iva = str_replace(",", ".", $prezzo_escluso_iva);
        $importo_netto = str_replace(",", ".", $importo_netto);
        $importo_iva = str_replace(",", ".", $importo_iva);
        $totale_iva_inclusa = str_replace(",", ".", $totale_iva_inclusa);
        $aliq_iva = str_replace(",", ".", $aliq_iva);
		
        $benzina = new Benzine();
		$e_query_inserimento = $benzina->modificaBenzina($id, $id_mezzo, $data, $targa, $prodotto_servizio, $totale_iva_inclusa, $importo_iva, $importo_netto, $prezzo_escluso_iva, $numero_carta, $titolare_carta, $localita, $codice_autista, $km_veicolo, $quantita_litri, $prezzo_pompa, $aliq_iva, $importo_ticket, $sconto);
		if($e_query_inserimento >= 0){
			$mezzo = new Mezzi();
			$mezzo->modificaKm($id_mezzo, $km_veicolo);
		}
        //LOG
		$log->inserisciLog("Modifica esso card", $_SESSION['username'], "blu");
		echo $e_query_inserimento;
	break;	
}	

?>