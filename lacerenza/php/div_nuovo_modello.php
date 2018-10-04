<?php
    include("controllaSessione.php");
	include("../databases/db_function.php");
	require_once("../lib/verificaConvertiData.php");
	require_once("../classi/class.ModelloMaster.php");
	require_once("../classi/class.Sezione.php");
	
	$id = isset($_GET['id']) ? $_GET['id'] : "";
	
	if($id != ""){
		
		$modello = new ModelloMaster();
		$dati_modello = $modello->getById($id);
		
		$id = $dati_modello->id;
		$titolosezione = $dati_modello->titolo;
		$idsezioni = $dati_modello->idsezioni;
		
	} else {

	}
	
?>

<!--SCRIPT SITO-->
<script src="js/sito/div_nuovo_modello.js" type="text/javascript"></script>

<form class="form-horizontal" id="formNewModello" name="formNewModello" method="post" role="form" action="lib/operazioni_modello_master.lib.php">
    
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

	</div>
	
</form>
        

                      
                      