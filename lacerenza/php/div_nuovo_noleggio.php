<?php
    include("controllaSessione.php");
	include("../databases/db_function.php");
	require_once("../lib/verificaConvertiData.php");
	require_once("../classi/class.Noleggi.php");
	
	$id = isset($_GET['id']) ? $_GET['id'] : "";
	$id_commessa = isset($_GET['id_commessa']) ? $_GET['id_commessa'] : "";
	
	if($id != ""){
		$noleggio = new Noleggi();
		$e_query_noleggio = $noleggio->caricaNoleggioById($id);
		$row = $e_query_noleggio->fetch_array();
		$data = CapovolgiData($row['data']);	
	} else {
		$data = date('d-m-Y');	
	}

?>
<!--SCRIPT SITO-->
<script src="js/sito/div_nuovo_noleggio.js" type="text/javascript"></script>

<form class="form-horizontal" id="formNewNoleggio" name="formNewNoleggio" enctype="multipart/form-data" action='lib/operazioni_noleggio.lib.php' method='POST'>

                        <div class="row">
                            <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Data*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control data_picker" value="<?=$data?>" id="data" name="data" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Numero*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Numero contratto"  id="numero" name="numero"  value="<?=$row['numero']?>"/>
                                <input type="hidden" id="id_da_modificare" name="id_da_modificare"  value="<?=$id?>"/>
                                <input type="hidden" id="tipo" name="tipo"  value="inserimento"/>
                                <input type="hidden" id="id_commessa" name="id_commessa"  value="<?=$id_commessa?>"/>

                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Descrizione*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Descrizione contratto noleggio" value="<?=$row['descrizione']?>" id="descrizione" name="descrizione">
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              	<label class="col-md-4 control-label">Importo contratto*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Importo contratto" id="importo" name="importo" value="<?=$row['importo']?>" />
                              </div>
                            </div>
                          </div>
                            <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              	<label class="col-md-4 control-label">Fornitore*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Fornitore" id="fornitore" name="fornitore" value="<?=$row['fornitore']?>" />
                              </div>
                            </div>
                          </div>
                          
                            
                          
                                                          
                          
                        </div><!-- /.row this actually does not appear to be needed with the form-horizontal -->
                        <input type="hidden" id="id_noleggio_modifica" value="<?=$id?>"/>
                      </form>
                      
                      