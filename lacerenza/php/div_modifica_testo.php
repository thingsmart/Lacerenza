<?php
    include("controllaSessione.php");
	include("../databases/db_function.php");
	require_once("../lib/verificaConvertiData.php");
	require_once("../classi/class.Modello.php");
	require_once("../classi/class.Preventivo.php");
	

	$id_preventivo = $_GET['id'];
	$id_modello = $_GET['model'];
	$id_preventivo_master = $_GET['prev'];
	
	$preventivo_obj = new Preventivo();
	$dati_preventivo = $preventivo_obj->getById($id_preventivo);
		
	if($dati_preventivo->descrizioneaggiornata == '') {
		
		$modello_obj = new Modello();
		$dati_modello = $modello_obj->getModelloOrderJoin($id_modello);
			
		$testo_da_modificare = $dati_modello['testo']; 
		
	} else {
		$testo_da_modificare = $dati_preventivo->descrizioneaggiornata;
	}
	
	$testo_da_modificare = str_replace('"', "'", $testo_da_modificare);
	
?>
<style>
span {
    color: #000;
}
.note-editor {
	padding: 20px;
    overflow: auto;
    outline: 0;
    color: #000;
	height: auto;
	min-height: 250px;
}
.note-editable {
    min-height: 250px!important;
    border: 0.5px solid lightgray;
}
    .note-insert, .note-fontname {
        display: none !important;
    }

</style>

<!--SCRIPT SITO-->
<script src="js/sito/edit/edit_testo.js" type="text/javascript"></script>

<form class="form-horizontal" id="formNewModifica" name="formNewModifica" method="post" role="form" action="lib/operazioni_sezione.lib.php">
    
    <input id="idpreventivo" name="idpreventivo" type="hidden" size="75" value="<?=$id_preventivo ?>" />
    <input id="idmodello" name="idmodello" type="hidden" size="75" value="<?=$id_modello ?>" />
    <input id="idpreventivomaster" name="idpreventivomaster" type="hidden" size="75" value="<?=$id_preventivo_master ?>" />
    <input id="tipo" name="tipo" type="hidden" size="75" value="update_testo" />
    
	<div class="row">

		<div class="col-sm-12 col-lg-12">
			<div class="col-md-12">
				<div id="summernote"><?= $testo_da_modificare ?></div>
				<textarea style="display: none" class="form-control" id="testosezione" name="testosezione"><?= $testo_da_modificare ?></textarea>
			</div>
		</div>
		
	</div>
	
</form>

<script>
	$(document).ready(function() {
		
		$('#summernote').summernote({
			'lang': 'it-IT'
		});
		
	});
</script>



                      
                      