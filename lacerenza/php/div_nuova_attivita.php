<?php
    include("controllaSessione.php");
	include("../databases/db_function.php");
	require_once("../lib/verificaConvertiData.php");
	require_once("../classi/class.Attivita.php");
	
	$id = isset($_GET['id']) ? $_GET['id'] : "";
	$id_commessa = isset($_GET['id_commessa']) ? $_GET['id_commessa'] : "";
	
	if($id != ""){
		$attivita = new Attivita();
		$e_query_attivita = $attivita->caricaAttivitaById($id);
		$row = $e_query_attivita->fetch_array();
		$data_del = CapovolgiData($row['data_del']);	
		$data_il = CapovolgiData($row['data_il']);	
	} else {
		$data_del = date('d-m-Y');	
		$data_il = date('d-m-Y');	
	}

?>
<!--SCRIPT SITO-->
<script src="js/sito/div_nuova_attivita.js" type="text/javascript"></script>

<form class="form-horizontal" id="formNewAttivita" name="formNewAttivita" enctype="multipart/form-data" action='lib/operazioni_attivita.lib.php' method='POST'>

                        <div class="row">
                            <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Impresa fornitrice*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Impresa fornitrice"  id="impresa_fornitrice" name="impresa_fornitrice"  value="<?=$row['impresa_fornitrice']?>"/>
                                <input type="hidden" id="id_da_modificare" name="id_da_modificare"  value="<?=$id?>"/>
                                <input type="hidden" id="tipo" name="tipo"  value="inserimento"/>
                                <input type="hidden" id="id_commessa" name="id_commessa"  value="<?=$id_commessa?>"/>
                              </div>
                            </div>
                          </div>
                            <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Lavoro*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Lavoro"  id="lavoro" name="lavoro"  value="<?=$row['lavoro']?>"/>
                              </div>
                            </div>
                          </div>
                            <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Importo*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Importo"  id="importo" name="importo"  value="<?=$row['importo']?>"/>
                              </div>
                            </div>
                          </div>
                            <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Contratto del*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control data_picker" value="<?=$data_del?>" id="data_del" name="data_del" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Registrato a*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Registrato a"  id="registrato_a" name="registrato_a"  value="<?=$row['registrato_a']?>"/>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">il*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control data_picker" value="<?=$data_il?>" id="data_il" name="data_il" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              	<label class="col-md-4 control-label">Numero*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Numero" id="numero" name="numero" value="<?=$row['numero']?>" />
                              </div>
                            </div>
                          </div>
                                                                                                                
                          
                        </div><!-- /.row this actually does not appear to be needed with the form-horizontal -->
                        <input type="hidden" id="id_attivita_modifica" value="<?=$id?>"/>
                      </form>
                      
                      