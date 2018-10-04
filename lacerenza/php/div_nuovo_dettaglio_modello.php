<?php
    include("controllaSessione.php");
	include("../databases/db_function.php");
	require_once("../lib/verificaConvertiData.php");
	require_once("../classi/class.Modello.php");
	require_once("../classi/class.Sezione.php");
	
	$id = isset($_GET['id']) ? $_GET['id'] : "";
	$id_modello = $_GET['model'];
	
	// if($id != ""){
// 		
		// $modello = new ModelloMaster();
		// $dati_modello = $modello->getById($id);
// 		
		// $id = $dati_modello->id;
		// $titolosezione = $dati_modello->titolo;
		// $idsezioni = $dati_modello->idsezioni;
// 		
	// } else {
// 
	// }
	
	$sezione = new Sezione();
	$lista_sezioni = $sezione->getAll();
	
?>

<!--SCRIPT SITO-->
<script src="js/sito/modelli/dettagli_modello.js" type="text/javascript"></script>

<form class="form-horizontal" id="formDettaglio" name="formDettaglio" method="post" role="form" action="lib/operazioni_modello.lib.php">
    
    <input id="idmodellomaster" name="idmodellomaster" type="hidden" size="75" value="<?=$id_modello ?>" />
    <input id="tipo" name="tipo" type="hidden" size="75" value="save" />
    
	<div class="row">
		
		<div>
			
			<div class="col-sm-12 col-lg-6 col-lg-offset-3">
				<label>Aggiungi Sezione:</label>
			</div>
			
			<div class="col-sm-12 col-lg-6 col-lg-offset-3">
				<div class="form-group">
					<div class="col-md-12 col-sm-12">
						<input type="hidden" class="form-control" style="width: 100%;" value="<?= $idsezioni ?>" id="idsezioni" name="idsezioni"/>
	                    <select id="idsezioni2" name="idsezioni2" class="chosen-select" style="width: 100% !important;" >
	                   <option value="" disabled selected style="color: #cdcbcb;">Scegli una Sezione...</option>
	                    <?  foreach ($lista_sezioni as $sez) {
	                        $esplodo_id = explode(",", $idsezioni);
	                        for ($i = 0; $i < count($esplodo_id); $i++) {
	                            if (strpos($esplodo_id[$i], $sez->id) !== false) {
	                                $sel = "selected";
	                                break;
	                            } else {
	                                $sel = "";
	                            }
	                        } ?>
	                        <option <?= $sel ?> value="<?= $sez->id?>"><?= $sez->titolo ?></option>
	        			<? } ?>
	                    </select>
					</div>
				</div>
			</div>
			
			<div class="col-sm-12 col-lg-6 col-lg-offset-3">
				<a class="btn btn-default" id="btn_save" style="width: 100%"><i class="fa fa-plus"></i> Aggiungi Sezione</a>
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
                      
                      