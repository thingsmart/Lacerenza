<?php
require_once ("lib/verificaConvertiData.php");
include ("databases/db_function.php");
require_once("classi/class.ProgrammazioneCantiere.php");


$data = isset($_GET['data']) ? $_GET['data'] : "";
$data = CapovolgiData($data);

$cantiere = new ProgrammazioneCantiere();

$e_query = $cantiere->carica($data);

$numero = $cantiere->numero();

if($numero > 0){
	$query_operatore = "SELECT utente FROM tb_programmazione_cantiere WHERE data = '$data' GROUP BY data;";
	$e_query_operatore = EseguiQuery($query_operatore, 'selezione');
	$row_operatore = $e_query_operatore->fetch_array();
	$operatore = $row_operatore['utente'];
	
	
}


?>

<title>Programmazione_<?=date("d_m_Y")?></title>
<!--Style-->
<style>
	.titolo{
		border:solid black;
	
	}
</style>
<? if($numero > 0){ ?>
<script>
	window.print();
</script>
<? } ?>
<!--TABELLE-->
<? if($e_query->num_rows > 0){ ?>
<section id="no-more-tables">
<h1>Programmazione giornaliera del <?=CapovolgiData($data)?></h1>

	
	
	<!--TABELLE SINGOLA COMMESSA-->
	 <table class="table-striped table-condensed cf" style="width:100%" border="1">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">N.</th>
                <th style="text-align:center">Cantiere di destinazione</th>
                <th style="text-align:center">Personale</th>
                <th style="text-align:center">Mezzo di trasporto</th>
                <th style="text-align:center">N. addetti</th>
                <th style="text-align:center">Note</th>
           </tr>
        </thead>
        <tbody>
           <?php
           $i =0;
				while($row = $e_query->fetch_array()){
					$i++;
					
					$dati_addetti = $row['addetti'];
					$dati_esplosi = explode(",", $dati_addetti);
					$num_addetti = count($dati_esplosi);
			?>
			<tr>
				<td class="centra" style="text-align:center" data-title="N."><?=$i?></td>
				<td class="centra" style="text-align:center" data-title="Cantiere di destinazione"><?=$row['cod_commessa']?> - <?=$row['descrizione_commessa']?></td>
				<!-- <td class="centra" style="text-align:center" data-title="Cod. Lavoro"><?=$row['cod_lavoro']?></td>
				<td class="centra" style="text-align:center" data-title="Descrizione Lavoro"><?=$row['descrizione_lavoro']?></td> -->
                <td class="centra" style="text-align:center" data-title="Personale"><?=$row['addetti']?></td>
				<td class="centra" style="text-align:center" data-title="Mezzo di trasporto"><?=$row['mezzo']?></td>
				<td class="centra" style="text-align:center" data-title="N. Addetti"><?=$num_addetti?></td>
				<td class="centra" style="text-align:center" data-title="Note"><?=$row['note']?></td>
			</tr>
			<?php } //END WHILE ?>
          </tbody>
       </table> 
       
       
       
       
       
       
       <br><br>
	
</section>
<? } else { ?>
	Nessun dato trovato
<? } ?>