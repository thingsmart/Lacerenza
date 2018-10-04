<?php

function get_client_ip() {
	
    $ipaddress = '';
	
    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	} else if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else if(isset($_SERVER['HTTP_X_FORWARDED'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    } else if(isset($_SERVER['HTTP_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    } else if(isset($_SERVER['HTTP_FORWARDED'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    } else if(isset($_SERVER['REMOTE_ADDR'])) {
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    } else {
        $ipaddress = 'UNKNOWN';
	}
	
    return $ipaddress;
	
}

function ip_in_range($indirizzo_ip, $range_min, $range_max) {
	
    $esito = '';
	
	$indirizzo_ip = ip2long($indirizzo_ip);
	$range_min = ip2long($range_min);
	$range_max = ip2long($range_max);
	
	if ($indirizzo_ip <= $range_max && $range_min <= $indirizzo_ip) {
		$esito = "OK";
	} else {
		$esito = "NO";
	}
	
    return $esito;
	
}

function delta_tempo ($data_iniziale,$data_finale,$unita) {
	 
	$data1 = strtotime($data_iniziale);
	$data2 = strtotime($data_finale);
	 
	switch($unita) {
		case "m": $unita = 1/60; break; //MINUTI
		case "h": $unita = 1; break;	//ORE
		case "g": $unita = 24; break;	//GIORNI
		case "a": $unita = 8760; break; //ANNI
	}
	 
	$differenza = (($data2-$data1)/3600)/$unita;
	return $differenza;
}

function avverti($id) {
	 
	$query_allarme = "SELECT (`tb_mezzi`.`km_percorsi` - `tb_tagliando`.`tagliando_ogni`) AS `FIELD_1`, `tb_mezzi`.`tagliando_ogni` AS limite_mezzo, mezzo, targa, id_mezzo, km_percorsi, `tb_tagliando`.id, `tb_tagliando`.tagliando_ogni, `tb_tagliando`.tagliando_prossimo, `tb_tagliando`.costo, `tb_tagliando`.tipo_tagliando, `tb_tagliando`.colore FROM `tb_tagliando` INNER JOIN `tb_mezzi` ON (`tb_tagliando`.`id_mezzo` = `tb_mezzi`.`id`) WHERE `id_mezzo` = $id AND `tb_tagliando`.eseguito = 0;";
	  $e_query_allarme = EseguiQuery($query_allarme,"selezione");
	return $e_query_allarme;
}

function avverti_spesa($id) {
    
	$query_allarme = "SELECT `tb_spese`.data_scadenza, `tb_spese`.data_ultimo_pagamento, `tb_spese`.id, mezzo, targa, id_mezzo, `tb_spese`.tipo, `tb_spese`.costo FROM `tb_spese` INNER JOIN `tb_mezzi` ON (`tb_spese`.`id_mezzo` = `tb_mezzi`.`id`) WHERE `id_mezzo` = $id AND `tb_spese`.eseguito = 0;";
    $e_query_allarme = EseguiQuery($query_allarme,"selezione");
	return $e_query_allarme;
}

function num_da_mese($mese) {
    
	switch($mese){
		case "GENNAIO":
			$numero = "01";	
		break;
		case "DICEMBRE":
			$numero = "12";	
		break;
		case "FEBBRAIO":
			$numero = "02";	
		break;
		case "MARZO":
			$numero = "03";	
		break;
		case "APRILE":
			$numero = "04";	
		break;
		case "MAGGIO":
			$numero = "05";	
		break;
		case "GIUGNO":
			$numero = "06";	
		break;
		case "LUGLIO":
			$numero = "07";	
		break;
		case "AGOSTO":
			$numero = "08";	
		break;
		case "SETTEMBRE":
			$numero = "09";	
		break;
		case "OTTOBRE":
			$numero = "10";	
		break;
		case "NOVEMBRE":
			$numero = "11";	
		break;
	}
	return $numero;
}

?>