<?php
include ("controllaSessione.php");
require_once ("../lib/verificaConvertiData.php");
include ("../databases/db_function.php");
require_once ("../classi/class.Ruolino.php");
require_once ("../classi/class.Commesse.php");
require_once ("../classi/class.Veicoli.php");
require_once ("../classi/class.Terzi.php");
require_once ("../classi/class.Dipendenti.php");

$filtro = isset($_GET['filtro_mezzo']) ? $_GET['filtro_mezzo'] : "";
$data = isset($_GET['data']) ? $_GET['data'] : "";
$data_select = CapovolgiData($data);
$id_della_commessa = isset($_GET['id']) ? $_GET['id'] : "";

$ruolino = new Ruolino();
//$e_query_titoli = $ruolino -> carica_titoli_commessa($data_select, $id_della_commessa);
$e_query_titoli = $ruolino -> carica_titoli_commessa_new($id_della_commessa);

if ($e_query_titoli -> num_rows > 0) {
	$data_query = CapovolgiData($data);
	$query_clima = "SELECT clima, utente FROM tb_ruolino WHERE data = '$data_query' GROUP BY data ORDER BY data;";
	$e_query_clima = EseguiQuery($query_clima, 'selezione');
	$row_clima = $e_query_clima -> fetch_array();
	$clima_giorno = $row_clima['clima'];
	$operatore = $row_clima['utente'];

}
?>

<!--SCRIPT SITO-->
<script src="js/sito/tabella_ruolino_giornaliero_commessa.js" type="text/javascript"></script>

<!--CLIMA E OPERATORE-->
<div class="row">
	 <? if($_SESSION['ruolo'] == "ADMIN" || $_SESSION['ruolo'] == "SUPERADMIN"){?>
	<!-- <div class="col-lg-2">
		<a class="btn btn-success btn-block" href="nuovo_ruolino_giornaliero.php?nome=nuovo&data=<?=$data ?>&clima=<?=$clima_giorno?>"><i class="fa fa-plus-circle fa-lg"></i> Nuovo</a>
		<br>
	</div> -->
	<? } ?>
	<!-- <div class="col-lg-2">
		<input id="data" class="data_picker form-control" value="<?=$data ?>" readonly>
		<br>
	</div> -->
	<?if($clima_giorno != "" || $operatore != ""){?>
	<!-- <div class="col-lg-3">
		<input id="data" class="form-control" value="Condizioni climatiche: <?=$clima_giorno?>" readonly>
		<br>
	</div>
	<div class="col-lg-3">
		<input id="data" class="form-control" value="Operatore: <?=$operatore?>" readonly>	
	</div> -->
	<? } ?>
</div>
<br>

<!--TABELLE-->
<? if($e_query_titoli->num_rows > 0){ ?>
<section id="no-more-tables">
	<? while($row_titoli = $e_query_titoli->fetch_array()){
		$e_query = $ruolino -> carica_commessa_giornaliero_new($row_titoli['id_commessa'], $row_titoli['data']);
		$titolo = str_replace("_", " ", $row_titoli['descrizione_commessa']);
		$commessa = new Commesse();
		$query_localita = $commessa->caricaCommesseById($row_titoli['id_commessa']);
		$row_localita = $query_localita->fetch_array();
	?>
	<!--NOME COMMESSA-->
	
	<!-- TITOLO -->
        	
				<div>
					<ol class="breadcrumb">
						<li class="active">
							<i class="fa fa-calendar fa-lg"></i> <?=CapovolgiData($row_titoli['data'])?> (<?=$row_titoli['clima']?>)
						</li>
					</ol>
				</div>	 			
	
            <!-- / END: TITOLO -->
	
	<!-- <h1 class="text-center titolo"><?=$row_titoli['cod_commessa']?> - <?=$titolo?> - <?=$row_localita['localita']?></h1> -->
	<!--END: NOME COMMESSA-->
	<br>
	
	<!--TABELLE SINGOLA COMMESSA-->
	<table class="table-bordered table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">N.</th>
                <th style="text-align:center">Data</th>
                <th style="text-align:center">TL</th>
                <th style="text-align:center">Descrizione Lavoro</th>
                <th style="text-align:center">Qt&agrave;</th>
                <th style="text-align:center">Personale</th>
                <th style="text-align:center">Ore</th>
                <th style="text-align:center">Autista</th>
                <th style="text-align:center">N. addetti</th>
                <th style="text-align:center">Lavorazioni economia</th>
                <th style="text-align:center">Ore</th>
                <th style="text-align:center">Note</th>
                 <? if($_SESSION['ruolo'] == "ADMIN" || $_SESSION['ruolo'] == "SUPERADMIN"){?>
                <!-- <th style="text-align:center">Modifica</th>
                <th style="text-align:center">Elimina</th> -->
                <? } ?>
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
				<td class="centra" style="text-align:center" data-title="Data"><?=CapovolgiData($row_titoli['data'])?></td>
				
				<td class="centra" style="text-align:center" data-title="TL"><?=$row['tipologia'] ?></td> 
				<td class="centra" style="text-align:center" data-title="Descrizione Lavoro"><?=$row['descrizione_lavoro'] ?></td> 
				<td class="centra" style="text-align:center" data-title="Quantit&agrave;"><?=$row['quantita'] ?></td> 
                <td class="centra" style="text-align:center" data-title="Personale">
                	<?
	                	$dati_addetti_terzi = $row['addetti'];
						$dati_esplosi_terzi = explode(",", $dati_addetti_terzi);
						$id_addetti_terzi = $row['id_dipendenti'];
						$id_esplosi_terzi = explode(",", $id_addetti_terzi);
						for($l = 0; $l < count($dati_esplosi_terzi); $l++){
							 $dipendenti = new Dipendenti();
							 $e_query_dipendenti_terzi = $dipendenti->caricaDipendenteById($id_esplosi_terzi[$l]);
							 $row_terzi = $e_query_dipendenti_terzi->fetch_array();
                	?>
	                	<? if($row_terzi['attivo'] == "TERZI"){?>
	                		<b style="color:red"><?=$dati_esplosi_terzi[$l]?></b>,
	                	<? } else { ?>
	                	 <?=$dati_esplosi_terzi[$l]?>,
	                	<? } ?>
                	<? } ?>
                </td>
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
				 <? if($_SESSION['ruolo'] == "ADMIN" || $_SESSION['ruolo'] == "SUPERADMIN"){?>
                <!-- <td class="centra" data-title="Modifica" style="text-align:center">
                 	<a target="_blank" style="width:100%" class="btn" href="nuovo_ruolino_giornaliero.php?id=<?=$row['id'] ?>&data=<?=$data ?>&clima=<?=$clima_giorno?>"><i class="fa fa-edit fa-lg"></i></a>
				</td>
                <td class="centra" data-title="Elimina" style="text-align:center">
                 	<a style="width:100%" class="btn btn_elimina" id_commessa="<?=$row_titoli['id_commessa']?>" id="<?=$row['id'] ?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash-o fa-lg"></i></a>
				</td> -->
				<? } ?>
			</tr>
			<?php } //END WHILE ?>
          </tbody>
       </table>
       
       <!--Elenco mezzi per commessa-->
       <? $veicolo = new Veicoli();
		  $e_query_veicolo = $veicolo -> caricaVeicoli($row_titoli['id_commessa'], $data_select);
		  $numeroVeicoli = $veicolo -> numeroVeicoli();
       ?>
       
       <? if($numeroVeicoli > 0){ ?>
       <br>
       <h3>Mezzi</h3>
		<section id="no-more-tables">
			<table class="table-bordered table-striped table-condensed cf" style="width:100%">
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
		  $e_query_terzi = $terzi_select -> carica($row_titoli['id_commessa'], $data_select);
		  $numero = $terzi_select -> numero();
       ?>
       
       <? if($numero > 0){ ?>
       <br>
       <h3>Lavorazione terzi</h3>
		<section id="no-more-tables">
			<table class="table-bordered table-striped table-condensed cf" style="width:100%">
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
</section>
<? } else { ?>
	<p style="padding-bottom: 5px;">Nessun dato trovato</p>
<? } ?>