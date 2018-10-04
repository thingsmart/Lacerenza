<?php
    include("controllaSessione.php");
	include("../databases/db_function.php");
	require_once("../lib/verificaConvertiData.php");
	require_once("../classi/class.Sezione.php");
	
	$id = isset($_GET['id']) ? $_GET['id'] : "";
	
	if($id != ""){
		
		$sezione = new Sezione();
		$dati_sezione = $sezione->getById($id);
		
		$id = $dati_sezione->id;
		$titolosezione = $dati_sezione->titolo;
		$oscuratitolo = $dati_sezione->oscuratitolo;
		$testosezione = $dati_sezione->testo;
		$tipologiasezione = $dati_sezione->tipologia;
		$costosezione = $dati_sezione->costo;
		$tipologiacosto = $dati_sezione->tipologiacosto;
		$filename = $dati_sezione->filename;
		$link_file = $dati_sezione->link_file;
		
		$testosezione = str_replace('"', "'", $testosezione);
		
	} 
	
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
/*.note-editor{
    border:1px solid lightgray;
}*/

.note-insert, .note-fontname {
    display: none !important;
}
</style>

<!--SCRIPT SITO-->
<script src="js/sito/div_nuova_sezione.js" type="text/javascript"></script>

<form class="form-horizontal" id="formNewSezione" name="formNewSezione" method="post" role="form" action="lib/operazioni_sezione.lib.php">
    
    <input id="id" name="id" type="hidden" size="75" value="<?=$id ?>" />
    <input id="tipo" name="tipo" type="hidden" size="75" value="save" />
    
	<div class="row">
		
		<div class="col-sm-12 col-lg-12">
			<div class="form-group">
				<label class="col-md-2 control-label">Titolo:</label>
				<div class="col-md-10">
					<input type="text" class="form-control" id="titolosezione" name="titolosezione"  value="<?=$titolosezione ?>"/>
				</div>
			</div>
		</div>
		
		<div class="col-sm-12 col-lg-12"  id="box_immagine">
			
			<div class="form-group">
				
				<? if($link_file == "") { ?>
					
					<label class="col-md-2 control-label">Immagine:</label>
					<div class="col-md-10" >
						<input style="margin:auto" type="file" id="files" name="files" value=""/>
					</div>
					
				<? } else { ?>
					
					<label class="col-md-2 control-label">Immagine Allegata:</label>
					<div class="col-md-10">
						<a style="margin:auto" class="btn btn-default" target="_blank" href="<?=$link_file?><?=$filename?>"><i class="fa fa-file-image-o"></i> Visaulizza Immagine</a>
						<div class="btn btn_elimina_allegato" data-toggle="modal" data-target=".bs-elimina" id="<?=$id?>"><i class="fa fa-trash fa-lg"></i></div>
					</div>
					
				<? } ?>
				
			</div>
		</div> 
		
		<div class="col-sm-12 col-lg-12">
			<div class="form-group">
				<label class="col-md-2 control-label">Testo:</label>
				<div class="col-md-10">
					<div id="summernote"><?= $testosezione ?></div>
					<textarea style="display: none" class="form-control" id="testosezione" name="testosezione"><?= $testosezione ?></textarea>
				</div>
			</div>
		</div>
		<!-- 
		<div class="col-sm-12 col-lg-12">
			<div class="form-group">
				<label class="col-md-2 control-label">Tipologia:</label>
				<div class="col-md-10">
			        ARTICOLO <input <? if($tipologiasezione == 1 ){ echo "checked";}?> type="radio" id="tipologiasezione" name="tipologiasezione" value="1" style="margin-right:30px"/>
			        DESCRIZIONE <input <? if($tipologiasezione == 0 ){ echo "checked";}?> type="radio" id="tipologiasezione" name="tipologiasezione" value="0"/> 
				</div>
			</div>
		</div> -->
		
		<div class="col-sm-12 col-lg-12" id="box_costo">
			<div class="form-group">
				<label class="col-md-2 control-label">Costo:</label>
				<div class="col-md-10">
					<input type="text" class="form-control" id="costosezione" name="costosezione"  value="<?=$costosezione ?>"/>
				</div>
			</div>
		</div>
		
		<div class="col-sm-12 col-lg-12">
			<div class="form-group">
				<label class="col-md-2 control-label">Tipologia Costo:</label>
				<div class="col-md-10">
                    <select id="tipologiacosto" name="tipologiacosto">
                    	<option value="" disabled selected style="color: #cdcbcb;">Scegli una Tipologia Costo...</option>
                        <option <?if($tipologiacosto == "unitario"){ echo "selected";} ?> value="unitario">Prezzo Unitario</option>
                        <option <?if($tipologiacosto == "mq"){ echo "selected";} ?> value="mq">Prezzo al Metro Quadro</option>
                        <option <?if($tipologiacosto == "ml"){ echo "selected";} ?> value="mq">Prezzo al Metro Lineare</option>
                    </select>
				</div>
			</div>
		</div>
		
		<div class="col-sm-12 col-lg-12">
			<div class="form-group">
				<label class="col-md-2 control-label">Oscura Titolo:</label>
				<div class="col-md-10">
                    <select id="oscuratitolo" name="oscuratitolo">
                    	<option value="" disabled selected style="color: #cdcbcb;">Scegli una modalit&agrave;...</option>
                        <option <?if($oscuratitolo == "1"){ echo "selected";} ?> value="1">Oscurare Titolo</option>
                        <option <?if($oscuratitolo == "0"){ echo "selected";} ?> value="0">Non Oscurare Titolo</option>
                    </select>
				</div>
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



                      
                      