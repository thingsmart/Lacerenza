<?php
require_once ("lib/verificaConvertiData.php");
include ("databases/db_function.php");
require_once ("classi/class.Ruolino.php");
require_once ("classi/class.Commesse.php");
require_once ("classi/class.Veicoli.php");
require_once ("classi/class.Terzi.php");

$da_data = isset($_GET['da_data']) ? $_GET['da_data'] : "";
$da_data = CapovolgiData($da_data);

$a_data = isset($_GET['a_data']) ? $_GET['a_data'] : "";
$a_data = CapovolgiData($a_data);

$cerca_commessa = isset($_GET['cerca_commessa']) ? $_GET['cerca_commessa'] : "";
$dati_commessa = explode("_", $cerca_commessa);
$id_commessa = $dati_commessa[0];

$tl = isset($_GET['tl']) ? $_GET['tl'] : "tutti";

$ruolino = new Ruolino();
if($id_commessa == "" || $id_commessa == "-1"){
$e_query_titoli = $ruolino -> carica_titoli_per_dataTl($da_data, $a_data, $tl);
} else {
$e_query_titoli = $ruolino -> carica_titoli_per_data_commessaTl($id_commessa, $da_data, $a_data, $tl);	
}


?>
<title>Ruolino_<?=date("d_m_Y")?></title>
<!--Style-->
<style>
	.titolo{
		border-bottom:1px solid black;
	
	}
</style>
<script>
	window.print();
</script>
<!--TABELLE-->
<? if($e_query_titoli->num_rows > 0){ ?>
<section id="no-more-tables">
	<? while($row_titoli = $e_query_titoli->fetch_array()){
		$e_query = $ruolino -> carica_commessaTl($row_titoli['id_commessa'], $row_titoli['data'], $tl);	
		$titolo = str_replace("_", " ", $row_titoli['descrizione_commessa']);
		$commessa = new Commesse();
		$query_localita = $commessa->caricaCommesseById($row_titoli['id_commessa']);
		$row_localita = $query_localita->fetch_array();
	?>
	<!--NOME COMMESSA-->
	<? if($row_titoli['ore_terzi'] != ""){?>
	<h1 class="text-center titolo"><?=CapovolgiData($row_titoli['data'])?> <?=$row_titoli['cod_commessa']?> - <?=$titolo?> - <?=$row_localita['localita']?></h1>
	<br>
	<? } ?>
	<!--END: NOME COMMESSA-->
	
	
	<? if($row_titoli['ore_terzi'] != ""){?>
	<!--TABELLE SINGOLA COMMESSA-->
	 <table class="table-striped cf" style="width:1000px" border="1">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">N.</th>
                <th style="text-align:center">TL</th>
                <th style="text-align:center; width:450px;">Descrizione Lavoro</th>
                <th style="text-align:center;  width:50px;" >Quantit&agrave;</th>
                <th style="text-align:center;  width:100px;">Personale</th>
                <th style="text-align:center;  width:20px;">Ore</th>
                <th style="text-align:center;  width:100px;">Autista</th>
                <th style="text-align:center;  width:40px;">N. addetti</th>
                <th style="text-align:center;  width:130px;">Lavorazioni economia</th>
                <th style="text-align:center;  width:20px;">Ore</th>
                <th style="text-align:center;  width:100px;">Note</th>
           </tr>
        </thead>
        <tbody>
           <?php
           $i =0;
				while($row = $e_query->fetch_array()){
					$i++;
					$autista = $row['autista'];
					
					$dati_addetti = $row['addetti'];
					$dati_esplosi = explode(",", $dati_addetti);
					$num_addetti = count($dati_esplosi);
			?>
			<tr>
				<td class="centra" style="text-align:center" data-title="N."><?=$i ?></td>
				<td class="centra" style="text-align:center" data-title="TL"><?=$row['tipologia'] ?></td> 
				<td class="centra" style="text-align:center;" data-title="Descrizione Lavoro"><?=$row['descrizione_lavoro'] ?></td> 
				<td class="centra" style="text-align:center" data-title="Quantit&agrave;"><?=$row['quantita'] ?></td> 
                <td class="centra" style="text-align:center; font-size:10px" data-title="Personale"><?=$row['addetti'] ?></td>
                <td class="centra" style="text-align:center" data-title="Ore"><?=$row['ore'] ?></td>
                <td class="centra" style="text-align:center" data-title="Autista">
                	<?
                		$esplodo_autista = explode(" ", $autista);
						$estrai_nome = explode("-", $esplodo_autista[0]);
						$nome = (count($estrai_nome) == 1) ? $estrai_nome[0] : $estrai_nome[1];
                	?>
                	<?=substr($nome, 0,1) ?>. <?=substr($esplodo_autista[1], 0,1) ?>.
                </td>
                <td class="centra" style="text-align:center" data-title="N. addetti"><?=$num_addetti ?></td>
				<td class="centra" style="text-align:center; color:#fe772d;" data-title="Lavorazioni economia"><?=$row['terzi'] ?></td>
				<td class="centra" style="text-align:center; color:#fe772d;" data-title="Ore "><?=$row['ore_terzi'] ?></td>
				<td class="centra" style="text-align:center; color:#fe772d;" data-title="Note"><?=$row['note'] ?></td>
               
			</tr>
			<?php } //END WHILE ?>
          </tbody>
       </table> 
       
       <!--Elenco mezzi per commessa-->
       <? $veicolo = new Veicoli();
		  $e_query_veicolo = $veicolo -> caricaVeicoli($row_titoli['id_commessa'], $row_titoli['data']);
		  $numeroVeicoli = $veicolo -> numeroVeicoli();
       ?>
       
       <? if($numeroVeicoli > 0){ ?>
       <br>
       <h3>Mezzi</h3>
		<section id="no-more-tables">
			<table class="table-bordered table-striped table-condensed cf" style="width:1000px"  border="0">
		    	<thead class="cf">
		        	<tr>
		            	<th style="text-align:center">N.</th>
		                <th style="text-align:center">Mezzo</th>
		                <th style="text-align:center">Costo</th>
		                <th style="text-align:center">KM</th>
		           </tr>
		        </thead>
		        <tbody>
		           <?php
		           		$i=0;
						while($row = $e_query_veicolo->fetch_array()){
		                    $i++;
		                    $nome_veicolo = $row['mezzo']." ".$row['targa'];
		           ?>
					<tr>
						<td style="text-align:center" data-title="N."><?=$i?></td>
						<td style="text-align:center" data-title="Mezzo"><?=$row['mezzo']?></td>
						<td style="text-align:center" data-title="Costo"><?=$row['costo_h']?> &euro;</td>
						<td style="text-align:center" data-title="KM"><?=$row['km']?></td>
					</tr>
					<?php
					} //END WHILE
					?>
		          </tbody>
		       </table>
		</section>

		<? } ?><!--END IF MEZZI-->
       <!--FINE elenco mezzi-->
       
       <!--Elenco terzi per commessa-->
       <? $terzi_select = new Terzi();
		  $e_query_terzi = $terzi_select -> carica($row_titoli['id_commessa'], $row_titoli['data']);
		  $numero = $terzi_select -> numero();
       ?>
       
       <? if($numero > 0){ ?>
       <br>
       <h3>Lavorazione terzi</h3>
		<section id="no-more-tables">
			<table class="table-bordered table-striped table-condensed cf" style="width:1000px"  border="0">
		    	<thead class="cf">
		        	<tr>
		            	<th style="text-align:center">N.</th>
		                <th style="text-align:center">Lavorazione terzi</th>
		                <th style="text-align:center">Ore</th>
		           </tr>
		        </thead>
		        <tbody>
		           <?php
		           		$i=0;
						while($row = $e_query_terzi->fetch_array()){
		                    $i++;
		           ?>
					<tr>
						<td style="text-align:center" data-title="N."><?=$i?></td>
						<td style="text-align:center" data-title="Lavorazione terzi"><?=$row['descrizione']?></td>
						<td style="text-align:center" data-title="Ore"><?=$row['ore']?></td>
					</tr>
					<?php
					} //END WHILE
					?>
		          </tbody>
		       </table>
		</section>

		<? } ?><!--END IF terzi-->
       <!--FINE elenco terzi-->
       <br><br>
       <? } ?>
       
       
	<? } ?>
</section>
<? } else { ?>
	Nessun dato trovato
<? } ?>