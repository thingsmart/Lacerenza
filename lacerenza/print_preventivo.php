<?php
session_start();
// ini_set('memory_limit', '-1');
// ini_set('max_execution_time', 300);

include("lib/controllaSessione.php");
include("databases/db_function.php");
require_once("lib/verificaConvertiData.php");
require_once("classi/class.Modello.php");
require_once("classi/class.Preventivo.php");
require_once("classi/class.PreventivoMaster.php");

$id = $_GET['id'];

$preventivo_master = new PreventivoMaster();
$dati_preventivo = $preventivo_master->getById($id);

$id_modello_master = $dati_preventivo->idmodellomaster;

$modello = new Modello();
$lista_modelli = $modello->getAllModelloMasterOrderJoin($id_modello_master);

$numero = count($lista_modelli);

$lista_modelli_contabili = $modello->getAllModelloMasterOrderJoinContabili($id_modello_master);
$numero_contabili = count($lista_modelli_contabili);
?>

<style>
div {
	font-size: 14px;
}
/*li {
    list-style: none;
    font-size: 14px;
}

li:before {

    line-height:14px;
}*/
table {
    border-collapse: collapse;
}

table, th, td {
    border: 1px solid #c6c6c6;
}
td {
	padding-top: 2px; padding-bottom: 2px;
}
</style>

<page backtop="34mm" backbottom="28mm" backleft="15mm" backright="10mm" style="font-size: 12pt">

	<page_header>

		<div style="text-align: center; padding-top:10px;">

			<div style="width: 794px; position: absolute; top:10px; ">
				<img src="img/header_preventivo.jpg" style="width: 794px; position: absolute; top:-10px;"/>
			</div>

		</div>
		
	</page_header>

	<page_footer>
	
		<div style="text-align: right; margin-bottom: 5px; margin-right: 4px;">
        	[[page_cu]]/[[page_nb]]
        </div>
		<div style="text-align: center">
			<img src="img/footer_preventivo.jpg" style="width: 880px; margin-left: -40px"/>
		</div>

	</page_footer>
	
	<div style="margin-top: 10px">
		OFFERTA / PREVENTIVO N° <?=$dati_preventivo->numpreventivo?>
	</div>
	
	<div style="margin-top: 5px; margin-left: 30px">
		<p>Avigliano, <?=CapovolgiData($dati_preventivo->datapreventivo);?></p>
	</div>
	
	<div style="width: 300px; margin-left: 380px">
		<p>
			<b>Spett.le</b><br>
			<font style="margin-top: 7px;"><?=$dati_preventivo->cliente?></font>
			<br>
			<!-- <b  style="margin-top: 14px;">Via</b>
			<br>
			<font style="margin-top: 7px;"><?=$dati_preventivo->indirizzo?></font> -->
		</p>
	</div>
	<font style="margin-top: 60px; font-size: 14px">Alla c.a. <?=$dati_preventivo->cliente?></font>
	<div style="width: 680px; margin-top: 60px">
		<p style="text-align: justify; line-height: 30px; font-size: 14px">
			<?=$dati_preventivo->descrizione?>
		</p>
	</div>
	
	<div style="margin-top: 30px;">
		
		<div style="border: 1px solid #000000; padding-bottom: 5px; background: #D3F1FF; font-size: 16px">
			<p style="text-align: center;"><b><?=$dati_preventivo->titololavoro?></b></p>
		</div>
		<? if($numero > 0) { ?>
			
			<? foreach($lista_modelli as $modello) { ?>		

				<? if($modello->oscura_titolo == 0) { ?>
					<div style="padding-bottom: 5px;">
						<p style="text-align: center; font-size: 16px"><b><?=strtoupper($modello->titolo)?></b></p>
					</div>
				<? } ?>
				
				<? if($modello->link_file != '') { ?>
					<div style="text-align: center; padding-top: 30px; ">						
						<img src="<?=$modello->link_file?><?=$modello->filename?>" style="width: 80%; text-align: center"/>
					</div>
				<? } ?>
				
				<? $dati_prev = Preventivo::getByPreventivo($id, $modello->id); $costo_prev = $dati_prev->costo; $descrizione_prev = $dati_prev->descrizioneaggiornata; $quantita_prev = $dati_prev->quantita; $tipologia_costo_prev = $prev_master->tipologia_costo; ?>

				<? if($modello->link_file != '') { ?>
					<p style="width: 95%;">
				<? } else { ?>
					<p style="width: 95%;" style="padding-top: -20px; ">
				<? } ?> 
					<? if($descrizione_prev != '') { ?>
						<? $str = str_replace('"', "'", $descrizione_prev); ?>
						<?=$str?>
					<? } else { ?>	
						<? $str = str_replace('"', "'", $modello->testo); ?>
						<?=$str?>		
					<? } ?>
					<? if($dati_prev->costo != '') {?>
						<div style="text-align: right; font-size: 12px"><b><?=$dati_prev->costo?> €<? if($modello->tipologia_costo != 'unitario') { echo "/".$modello->tipologia_costo; }?> IVA esclusa</b></div>
					<? } else if($modello->costo != '') { ?>
						<div style="text-align: right; font-size: 12px"><b><?=$modello->costo?> €<? if($modello->tipologia_costo != 'unitario') { echo "/".$modello->tipologia_costo; }?> IVA esclusa</b></div>
					<? }?>
				</p>
					
			<? } ?>

		<? } ?>
		
		<? if($numero_contabili > 0) { ?>
			
			<div style="width:680px; text-align: left; font-size: 12px">
				
				<b>Quadro riepilogativo presunto delle lavorazioni (*)</b>
				
				<table style="width:680px; font-size: 12px; text-align: center; margin-top: 15px;">
					
			    	<thead>
			        	<tr style="background: #D3F1FF; vertical-align:middle">
			                <th style="text-align:center; width: 55%">LAVORAZIONE</th>
			                <th style="text-align:center; width: 15%">Q.T&Agrave;</th>
			                <th style="text-align:center; width: 15%">PREZZO UNITARIO</th>
			                <th style="text-align:center; width: 15%">TOTALE</th>
			           </tr>
		        	</thead>
		        	
		        	<tbody>
						
						<? $totale = 0; ?>
						
						<? foreach($lista_modelli_contabili as $modello_contabile) { ?>	
							
							<? $dati_modificati_preventivo = Preventivo::getByPreventivo($id, $modello_contabile->id); $costo_prev_modificato = $dati_modificati_preventivo->costo; $quantita_prevista = $dati_modificati_preventivo->quantita; $tipologia_costo = $modello_contabile->tipologia_costo;?>
							
							<? if($costo_prev_modificato != '') { ?>
								
								<tr style="padding-top: 10px; padding-bottom:10px">
									<td style="text-align:left !important"><?=$modello_contabile->titolo?></td>
									<td style="text-align:center"><? if($tipologia_costo == 'mq' || $tipologia_costo == 'ml') { echo number_format($quantita_prevista,2,",","."); }?> <?=$tipologia_costo?></td>
									<td style="text-align:center"><?=number_format($costo_prev_modificato,2,",","."); ?> €<? if($tipologia_costo == 'mq' || $tipologia_costo == 'ml') { echo "/".$tipologia_costo; }?></td>
									<? 
										if($tipologia_costo == 'mq' || $tipologia_costo == 'ml') {
											$totale_parziale = $quantita_prevista * $costo_prev_modificato; $totale += $totale_parziale;
										} else {
											$totale_parziale = $costo_prev_modificato; $totale += $totale_parziale;
										} 
									?>
									<td style="text-align:center"><?=number_format($totale_parziale,2,",","."); ?> €</td>
								</tr>
								
							<? } else { ?>
								
								<tr style="padding-top: 10px; padding-bottom:10px">
									<td style="text-align:left !important;"><?=$modello_contabile->titolo?></td>
									<td style="text-align:center"><? if($tipologia_costo == 'mq' || $tipologia_costo == 'ml') { echo number_format($quantita_prevista,2,",","."); }?> <?=$tipologia_costo?></td>
									<td style="text-align:center"><?=number_format($modello_contabile->costo,2,",","."); ?> €<? if($tipologia_costo == 'mq' || $tipologia_costo == 'ml') { echo "/".$tipologia_costo; }?></td>
									<? 
										if($tipologia_costo == 'mq' || $tipologia_costo == 'ml') {
											$totale_parziale = $quantita_prevista * $modello_contabile->costo; $totale += $totale_parziale;
										} else {
											$totale_parziale = $modello_contabile->costo; $totale += $totale_parziale;
										} 
									?>
									<td style="text-align:center"><?=number_format($totale_parziale,2,",","."); ?> €</td>
								</tr>
								
							<? } ?>
							
						<? } ?>
						
						<tr style="font-size: 15px">
							<td colspan="3" style="text-align: right; padding-right: 15px; padding-top: 3px; padding-bottom: 3px"><b>TOTALE IVA esclusa</b></td>
							<td style="text-align:center; padding-top: 3px; padding-bottom: 3px"><b><?=number_format($totale,2,",","."); ?> €</b></td>
						</tr>
						
		        	</tbody>
		        	
		        </table>
		        
		        <font style="margin-top: 15px;">(*) Il quadro economico riepilogativo presunto di cui sopra è solo indicativo, le misurazioni effettive delle lavorazioni saranno rilevate in contraddittorio con un Vs. tecnico di fiducia a lavori finiti.</font> 
		        
	        </div>
        
        <? } ?>

		<div style="text-align: justify; line-height: 24px; padding-top: 35px">
			INZIO LAVORI: <?=$dati_preventivo->iniziolavori?>
			<br>
			FINE LAVORI: <?=$dati_preventivo->finelavori?>
			<br>
			CONDIZIONI DI PAGAMENTO: <?=$dati_preventivo->condizionipagamento?>
		</div>


		<div style="text-align: center; margin-top: 40px">

			<img src="img/firme.jpg" style="width:690px;"/>
		        
		</div>
		
	</div>

	
</page>
    
	


