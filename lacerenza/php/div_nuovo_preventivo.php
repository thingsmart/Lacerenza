<?php
    include("controllaSessione.php");
	include("../databases/db_function.php");
	require_once("../lib/verificaConvertiData.php");
	require_once("../classi/class.PreventivoMaster.php");
	require_once("../classi/class.ModelloMaster.php");
	
	$id = isset($_GET['id']) ? $_GET['id'] : "";
	
	if($id != ""){
		
		$preventivo_master = new PreventivoMaster();
		$dati_preventivo = $preventivo_master->getById($id);
		
		$id = $dati_preventivo->id;
		$idmodellomaster = $dati_preventivo->idmodellomaster;
		$numpreventivo = $dati_preventivo->numpreventivo;
		$cliente = $dati_preventivo->cliente;
		$indirizzo = $dati_preventivo->indirizzo;
		$datapreventivo = CapovolgiData($dati_preventivo->datapreventivo);
		$descrizione = $dati_preventivo->descrizione;
		$titololavoro = $dati_preventivo->titololavoro;
		$iniziolavori = $dati_preventivo->iniziolavori;
		$finelavori = $dati_preventivo->finelavori;
		$condizionipagamento = $dati_preventivo->condizionipagamento;
		$link_file = $dati_preventivo->link_file;
		$filename = $dati_preventivo->filename;
		
	} else {
		
		$datapreventivo = date("d-m-Y");
		$descrizione = "A seguito della Vs gentile richiesta e di un ns sopralluogo preventivo, Vi rimettiamo la ns migliore offerta relativa ai lavori di _________________________ presso il Vs cantiere sito in _________________________. Tali lavori potranno essere eseguiti dalla ns ditta la quale è in grado di offrire la fornitura e posa in opera del materiale occorrente.";
		
	}
	
	$modello_master = new ModelloMaster();
	$lista_modelli_master = $modello_master->getAll();
	
?>
<style>
span{
	color: #000;
}
</style>
<!--SCRIPT SITO-->
<script src="js/sito/preventivi/div_nuovo_preventivo.js" type="text/javascript"></script>

<form class="form-horizontal" id="formNewPreventivo" name="formNewPreventivo" method="post" role="form" action="lib/operazioni_preventivo_master.lib.php">
    
    <input id="id" name="id" type="hidden" size="75" value="<?=$id ?>" />
    <input id="tipo" name="tipo" type="hidden" size="75" value="save" />
    
	<div class="row">
		
        <div class="col-lg-12">
        	
		     <div class="col-lg-12">
				
				<div class="col-lg-12 ">
					
					<? if($link_file == "") { ?>
					
						<div class="form-group">
							<label>PDF Preventivo:</label>
							<div>
								<input style="margin:auto" type="file" id="files" name="files" value=""/>
							</div>
						</div>
					
					<? } else { ?>
					
						<div class="form-group">
							<label>PDF Preventivo Allegato:</label>
							<div>
								<a style="margin:auto" class="btn btn-default" target="_blank" href="<?=$link_file?><?=$filename?>"><i class="fa fa-file-image-o"></i> Visaulizza PDF</a>
								<div class="btn btn_elimina_allegato" data-toggle="modal" data-target=".bs-elimina" id="<?=$id?>"><i class="fa fa-trash fa-lg"></i></div>
							</div>
						</div>
						
					<? } ?>
					
				</div>
			
		   </div>
		
           <div class="col-lg-6">
				
				<div class="col-lg-12 ">
					
					<div class="form-group">
						<label>Preventivo N°:</label>
						<div>
							<input type="text" class="form-control" id="numpreventivo" name="numpreventivo"  value="<?=$numpreventivo ?>"/>
						</div>
					</div>
				
				</div>
			
		   </div>
			
           <div class="col-lg-6">
           	
           		<div class="col-lg-12 ">
	
					<div class="form-group">
						<label>Data:</label>
						<div>
							<input type="text" class="form-control data_picker" id="datapreventivo" name="datapreventivo"  value="<?=$datapreventivo ?>"/>
						</div>
					</div>
				
				</div>
			
		   </div>
		   
           <div class="col-lg-6">
           	
           		<div class="col-lg-12 ">
	
					<div class="form-group">
						<label>Cliente:</label>
						<div>
							<input type="text" class="form-control" id="cliente" name="cliente"  value="<?=$cliente ?>"/>
						</div>
					</div>
				
				</div>
			
			</div>
			
           <div class="col-lg-6">
           	
           		<div class="col-lg-12 ">
	
					<div class="form-group">
						<label>Modello Preventivo:</label>
						<div>
							<input type="hidden" class="form-control" id="idmodellomaster" name="idmodellomaster"  value="<?=$idmodellomaster ?>"/>
		                    <select id="idmodellomaster2" name="idmodellomaster2" class="chosen-select" style="width: 100% !important;" >
		                    <?  foreach ($lista_modelli_master as $mdl) {
		                        $esplodo_id = explode(",", $idmodellomaster);
		                        for ($i = 0; $i < count($esplodo_id); $i++) {
		                            if (strpos($esplodo_id[$i], $mdl->id) !== false) {
		                                $sel = "selected";
		                                break;
		                            } else {
		                                $sel = "";
		                            }
		                        } ?>
		                        <option <?= $sel ?> value="<?= $mdl->id?>"><?= $mdl->titolo ?></option>
		        			<? } ?>
		                    </select>
						</div>
					</div>
				
				</div>
			
			</div>
		   
           <div class="col-lg-12">
           	
           		<div class="col-lg-12 ">
	
					<div class="form-group">
						<label>Indirizzo:</label>
						<div>
							<input type="text" class="form-control" id="indirizzo" name="indirizzo"  value="<?=$indirizzo ?>"/>
						</div>
					</div>
				
				</div>
			
			</div>
			
           <div class="col-lg-12">
           	
           		<div class="col-lg-12 ">
	
					<div class="form-group">
						<label>Descrizione Introduttiva:</label>
						<div>
							<textarea type="text" class="form-control" id="descrizione" name="descrizione" rows="5"><?=$descrizione ?></textarea>
						</div>
					</div>
				
				</div>
			
			</div>
			
           <div class="col-lg-12">
           	
           		<div class="col-lg-12 ">
	
					<div class="form-group">
						<label>Titolo Lavoro:</label>
						<div>
							<input type="text" class="form-control" id="titololavoro" name="titololavoro"  value="<?=$titololavoro ?>"/>
						</div>
					</div>
				
				</div>
			
			</div>
			
           <div class="col-lg-6">
				
				<div class="col-lg-12 ">
					
					<div class="form-group">
						<label>Inizio Lavori:</label>
						<div>
							<input type="text" class="form-control" id="iniziolavori" name="iniziolavori"  value="<?=$iniziolavori ?>"/>
						</div>
					</div>
				
				</div>
			
		   </div>
			
           <div class="col-lg-6">
				
				<div class="col-lg-12 ">
					
					<div class="form-group">
						<label>Fine Lavori:</label>
						<div>
							<input type="text" class="form-control" id="finelavori" name="finelavori"  value="<?=$finelavori ?>"/>
						</div>
					</div>
				
				</div>
			
		   </div>
			
           <div class="col-lg-12">
				
				<div class="col-lg-12 ">
					
					<div class="form-group">
						<label>Condizioni di Pagamento:</label>
						<div>
							<input type="text" class="form-control" id="condizionipagamento" name="condizionipagamento"  value="<?=$condizionipagamento ?>"/>
						</div>
					</div>
				
				</div>
			
		   </div>
			
		</div>

	</div>
	
</form>
        
<script>
$(document).ready(function() {

});

	var config = {
	    '.chosen-select': { width: "100%"},
	    '.chosen-select-deselect': {allow_single_deselect: true},
	    '.chosen-select-no-single': {disable_search_threshold: 10},
	    '.chosen-select-no-results': {no_results_text: 'Oops, nessun risultato..!'},
	    '.chosen-select-width': {width: "95%"}
	}
	for (var selector in config) {
	    $(selector).chosen(config[selector]);
	}
	
</script>
                      
                      