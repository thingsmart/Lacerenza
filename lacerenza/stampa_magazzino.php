<?php
include ("lib/controllaSessione.php");
include ("lib/funzioni_sito.php");

include ("databases/db_function.php");
require_once ("classi/class.TestataMagazzino.php");
require_once ("classi/class.Magazzino.php");
require_once ("classi/class.Commesse.php");
require_once("lib/verificaConvertiData.php");

$data = isset($_GET['data']) ? $_GET['data'] : date("Y-m-d");
$id  = isset($_GET['id']) ? $_GET['id'] : "";

//estraggo elenco utenti
$magazzino = new TestataMagazzino();
$e_query_magazzino = $magazzino -> caricaById($id);
$row_magazzino = $e_query_magazzino->fetch_array();

$merce = new Magazzino();
$e_query_merce = $merce -> carica($id);

$commessa = new Commesse();	
$e_query_commessa = $commessa->caricaCommesseById($row_magazzino['id_commessa']);
$row_commessa = $e_query_commessa->fetch_array();
?>
<!DOCTYPE html>
<html lang="it">

<head>
	<title>Magazzino - <?=$data?></title>
<script>
	window.print();
</script>
</head>
<body>
<table style="width:100%">
<tr>
	<td style="width:100px; border:thin solid black;"></td>
	<td colspan="2" style="width:400px; text-align:center; border:thin solid black;"><b>MAGAZZINO</b></td>
	<td style="width:100px; border:thin solid black;"></td>
</tr>
<tr>
	<td style="width:100px; height:50px; border:thin solid black;"></td>
	<td colspan="2" style="width:400px; text-align:center; border:thin solid black;"></td>
	<td style="width:100px; border:thin solid black;"></td>
</tr>
<tr>
	<td colspan="2" style="width:300px;  border:thin solid black;"><b>DATA:</b> <?=CapovolgiData($row_magazzino['data'])?></td>
	<td colspan="2" style="width:300px; border:thin solid black;"><b>RESPONSABILE:</b> <?=$row_magazzino['utente']?></td>
</tr>
<tr>
	<td colspan="2" style="width:300px;  border:thin solid black;"><b>CANTIERE:</b> <?=$row_magazzino['descrizione_commessa']?> (<?=$row_commessa['localita']?>)</td>
	<td colspan="2" style="width:300px; border:thin solid black;"><b>MEZZO:</b> <?=$row_magazzino['mezzo']?></td>
</tr>

<tbody>
	<table style="width:100%">
		<tr>
			<td style="text-align:center; border:thin solid black;"><b>QUANTITA'</b></td>
			<td style="text-align:center; border:thin solid black;"><b>DESCRIZIONE DEL MATERIALE</b></td>
		</tr>
		<tbody>
			<? while($row = $e_query_merce->fetch_array()){?>
			<tr>
				<td style="text-align:center; border:thin solid black;"><?=$row['quantita']?></td>
				<td style="text-align:center; border:thin solid black;"><?=$row['materiale']?></td>
			</tr>
		<? } ?>
		<tbody>
	</table>
</tbody>
</table>
</body>
</html>