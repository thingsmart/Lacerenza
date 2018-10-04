<?php


$query = "SELECT * FROM tb_dipendenti;";
//echo $query;
$results = EseguiQuery($query,"selezione");
$stringa_dipendenti = "";
while($row = $results -> fetch_array()){
	$stringa_dipendenti .= $row['cod_interno']."-".str_replace(" ", "_", str_replace(", ", "_", $row['descrizione']))."#".$row['capienza']."#".$row['logistic_reference']."@";
}
$stringa_dipendenti = substr($stringa_dipendenti,0,-1);
?>
<script>
    var listaDipendenti = ('<?= $stringa_dipendenti ?>').split('@');
    </script>