<?php
/****
 *** Tabella contenente la lista degli utenti mostrata nella pagina home
 ****/
ini_set('max_execution_time', 0);
include ("lib/controllaSessione.php");
include ("lib/funzioni_sito.php");

include ("databases/db_function.php");
require_once ("classi/class.Dipendenti.php");
require_once ("classi/class.Presenze.php");
require_once ("classi/class.Commesse.php");
require_once ("classi/class.Costi.php");
require_once ("lib/verificaConvertiData.php");

//estraggo elenco utenti
$ruolino = new Dipendenti();

$anno = $_GET['anno'];
$mese_nome = $_GET['mese'];
$dettagli_commessa = $_GET['commessa'];
$tl = $_GET['tl'];
$dati_esplosi = explode("_", $dettagli_commessa);
// $nome_commessa = $_GET['nome_commessa'];
// $id_commessa = $_GET['id_commessa'];

$id_commessa = $dati_esplosi[0];
$nome_commessa  =" ";
for($l=1; $l<count($dati_esplosi); $l++) {
	$nome_commessa .= $dati_esplosi[$l]." ";
}

$totale_ore_stampa_complessivo = 0;
$totale_costo_stampa_complessivo = 0;

$dal = ($_GET['dal'] != "") ? $_GET['dal'] : "01";
$al = ($_GET['al'] != "") ? $_GET['al'] : "";
?>
<!DOCTYPE html>
<html lang="it">

<head>
	<title>Personale_<?=$mese?>_<?=$anno?></title>
<script>
//	window.print();
</script>
<style type="text/css" media="print">
  @page { size: landscape; }
</style>
</head>
<body style="width:1000px">
Commessa: <strong><?=$nome_commessa?></strong> - Tipologia: <b><?=$tl?></b>
<?
$mesi = explode(",", $mese_nome);



for($m=0; $m<count($mesi); $m++){
	$totale_costo_stampa = 0;
	$totale_ore_stampa = 0;
	?>
<table>
<tr>
	<td style="color:red; border:thin solid black;"><?=$mesi[$m] ?>/<?=$anno ?></td>
	<?
	$mese = num_da_mese($mesi[$m]);
	$giorni = date("t", strtotime($anno . "-" . $mese . "-01"));
	$al = ($al == "") ? $giorni : $al;
	?>
	<?
		for($i=1; $i<=$giorni; $i++){
		$giorno_settimana = date("w",strtotime($anno."-".$mese."-".$i));
			if($i>= $dal && $i <= $al){
	?>
		<td style='text-align:center; width:20px; border:thin solid black; <?
		if ($giorno_settimana == 6) { echo "color:gray";
		} else if ($giorno_settimana == 0) { echo "color:red";
		}
	?>'>
		<?if($i < 10){?>
		<?="0".$i?>
		<? } else {?>
		<?=$i?>
		<? } ?>
	</td>
			<? } ?>
		<? } ?>
	<td style="border:thin solid black; text-align:center;">Totale Ore</td>
	<td style="border:thin solid black; text-align:center; max-width:100px !important;">Costo h.</td>
	<td style="border:thin solid black; width:100px; text-align:center;"><strong>Importo</strong></td>
</tr>
<tbody>
<?
//$e_query_ruolino = $ruolino -> caricaDipendentiRuolinoAll();
$e_query_ruolino = $ruolino -> caricaDipendentiRuolinoAllNEW();

while($row = $e_query_ruolino->fetch_array()){
					$presenza = new Presenze();

					$costo = new Costi();
//					if($id_commessa != -1) {
//						$costo_h = $costo->costoAttualeCommessa($row['id'], date($anno . "-" . $mese . "-01"), $id_commessa);
//					} else {
//						$costo_h = $costo->costoAttualeMedia($row['id'], date($anno . "-" . $mese . "-01"));
//					}
					$tot_ore = 0;
	$costo_n = 0;
					if($id_commessa != "" && $id_commessa != "-1"){
							$e_totale = $presenza->oreLavoroMensileCommessaTl($mese, $anno, $id_commessa, $tl, $dal, $al);
					 } else {
							$e_totale = $presenza->oreLavoroMensileTl($mese, $anno, $tl, $dal, $al);
							//oreLavoroMensileTl
					 }
					$tot_per_mese = 0;
					while($row_totale = $e_totale->fetch_array()){
						$dipendenti_oggi = explode(",", $row_totale['id_dipendenti']);
						for($l=0; $l<count($dipendenti_oggi); $l++){
							if($row['id'] == intval($dipendenti_oggi[$l])){
								 $tot_per_mese += $row_totale['ore'];

							}
						}
					}
					if($tot_per_mese > 0){

			?>
			<tr>
				<td style="border:thin solid black;"><?=$row['nome'] ?> <?=$row['cognome'] ?></td>
				<? for($i=1; $i<=$giorni; $i++){
							if($i>=$dal && $i<= $al){
					$data = date($anno."-".$mese."-".$i);
					 if($id_commessa != "" && $id_commessa != "-1"){
						$e_query_presenze_oggi = $presenza->oreLavoroGiornalieroCommessaTl($data, $id_commessa, $tl, $dal, $al);
					 } else {
						$e_query_presenze_oggi = $presenza->oreLavoroGiornalieroTl($data, $tl, $dal, $al);
						//oreLavoroGiornalieroTl($data);
					 }

					$ore = 0;
					while($row_presenze_oggi = $e_query_presenze_oggi->fetch_array()){

						$dipendenti_oggi = explode(",", $row_presenze_oggi['id_dipendenti']);
						for($l=0; $l<count($dipendenti_oggi); $l++){
							if($row['id'] == intval($dipendenti_oggi[$l])){
								 $tot_ore += $row_presenze_oggi['ore'];
								 $costo_v = $costo->costoAttualeCommessa($dipendenti_oggi[$l], date($anno . "-" . $mese . "-01"), $row_presenze_oggi['id_commessa']);
								if($costo_v == 0){
									$costo_v = $costo->costoAttualeNuovo($dipendenti_oggi[$l], date($anno . "-" . $mese . "-01"));
								}

								 $costo_n += $costo_v * $row_presenze_oggi['ore'];
								$ore += $row_presenze_oggi['ore'];
							}
						}
					}

					//$tot_ore += $ore;
				?>
					<td style="border:thin solid black;" >
						<? if($ore != 0){ ?>
						<?=$ore?>
						<? } else {?>
						&nbsp;
						<? } ?>
					</td>
				<? } ?>
					<? } ?>
				<td style="text-align:center; border:thin solid black;"><?=$tot_ore ?></td>
				<td style="text-align:center; border:thin solid black;  max-width:100px !important;">
					<? if($tot_ore != 0){ ?>
					<?=number_format($costo_n / $tot_ore, 2, ',', '.'); ?>
							<? } else { ?>
						<?=number_format($costo_n / 1, 2, ',', '.'); ?>
					<? } ?>
				</td>
				<td style="text-align:center; border:thin solid black;"><?=number_format($costo_n, 2, ',', '.');?></td>
			</tr>
<?
$totale_ore_stampa += $tot_ore;
$totale_costo_stampa += $costo_n;

 } ?>
<? } ?>
</tbody>
</table>

	<div><b>Totale Ore: </b><?=$totale_ore_stampa?></div>
	<div><b>Totale Importo: </b> &euro; <?=number_format($totale_costo_stampa, 2, ',', '.');?></div>
	<br>
<?
	$totale_ore_stampa_complessivo += 		$totale_ore_stampa;
	$totale_costo_stampa_complessivo += 		$totale_costo_stampa;
} ?>

<div><b>Totale Ore Complessivo: </b><?=$totale_ore_stampa_complessivo?></div>
<div><b>Totale Importo Complessivo: </b> &euro; <?=number_format($totale_costo_stampa_complessivo, 2, ',', '.');?></div>
</body>
</html>