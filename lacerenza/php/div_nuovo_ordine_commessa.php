<?php
    include("controllaSessione.php");
	include("../databases/db_function.php");
	require_once("../lib/verificaConvertiData.php");
	require_once("../classi/class.OrdiniCommessa.php");
	
	$id = isset($_GET['id']) ? $_GET['id'] : "";
	$id_commessa = isset($_GET['id_commessa']) ? $_GET['id_commessa'] : "";
	
	if($id != ""){
		$ordine = new OrdiniCommessa();
		$e_query_ordine = $ordine->caricaById($id);
		$row = $e_query_ordine->fetch_array();
	}

?>
<!--SCRIPT SITO-->
<script src="js/sito/div_nuovo_ordine_commessa.js" type="text/javascript"></script>

<form class="form-horizontal" id="formNewOrdine" name="formNewOrdine" enctype="multipart/form-data" action='lib/operazioni_ordine_commessa.lib.php' method='POST'>

                        <div class="row">
                          <div class="col-sm-12 col-lg-12">
                            <div class="form-group">
                              <label class="col-md-1 control-label">Fornitore*:</label>
                              <div class="col-md-11">
                                <input type="text" class="form-control" placeholder="Fornitore"  id="fornitore" name="fornitore"  value="<?=$row['fornitore']?>"/>
                                <input type="hidden" id="id_da_modificare" name="id_da_modificare"  value="<?=$id?>"/>
                                <input type="hidden" id="tipo" name="tipo"  value="inserimento"/>
                                <input type="hidden" id="id_commessa" name="id_commessa"  value="<?=$id_commessa?>"/>

                              </div>
                            </div>
                          </div>  
                                         
                          
                                                          
                          
                          
                        </div><!-- /.row this actually does not appear to be needed with the form-horizontal -->
                        <input type="hidden" id="id_ordine_modifica" value="<?=$id?>"/>
                      </form>
                      
                      