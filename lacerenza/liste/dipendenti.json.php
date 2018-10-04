<?php
    include("../php/controllaSessione.php");
	include("../databases/db_function.php");
	
	
$query = "SELECT * FROM tb_dipendenti WHERE attivo LIKE 'ATTIVO' OR attivo LIKE 'TERZI' OR attivo LIKE 'IMPIEGATO' ORDER BY cognome;";
$e_query_lista = EseguiQuery($query,"selezione");

?>
[ 
<?
$i = 0;
while($row = $e_query_lista->fetch_array()){
	$i++;
	if($i < $e_query_lista->num_rows){	
?>
{ "value": "<?=$row['id']?>-<?=$row['cognome']?> <?=$row['nome']?>", "text": "<?=$row['cognome']?> <?=$row['nome']?>", "continent": "<?=$row['id']?>-<?=$row['cognome']?> <?=$row['nome']?>" },
	<? } else { ?>
{ "value": "<?=$row['id']?>-<?=$row['cognome']?> <?=$row['nome']?>", "text": "<?=$row['cognome']?> <?=$row['nome']?>", "continent": "<?=$row['id']?>-<?=$row['cognome']?> <?=$row['nome']?>" }
	<? } ?>
<? } ?>

]

