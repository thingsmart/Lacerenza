<?php
    include("controllaSessione.php");
	include("../databases/db_function.php");
	require_once("../lib/verificaConvertiData.php");
	require_once("../classi/class.Commesse.php");
	
	$id = isset($_GET['id']) ? $_GET['id'] : "";
	
	if($id != ""){
		$commessa = new Commesse();
		$e_query_commessa = $commessa->caricaCommesseById($id);
		$row = $e_query_commessa->fetch_array();
		$data_inizio = CapovolgiData($row['data_inizio']);
		$data_fine = ($row['data_fine'] == "0000-00-00") ? "" : CapovolgiData($row['data_fine']);
        $data_fine = ($data_fine == "--") ? "" : $data_fine;
	} else {
		$data_inizio = date("d-m-Y");
	}

?>
<!--SCRIPT SITO-->
<script src="js/sito/div_nuova_commessa.js" type="text/javascript"></script>

<form class="form-horizontal" id="formNewCommessa"  name="formNewCommessa" method="post" role="form">
                        <div class="row">
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Codice*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Codice Commessa"  id="codice" name="codice"  value="<?=$row['codice']?>"/>
                                <input type="hidden" id="id_da_modificare" name="id_da_modificare"  value="<?=$id?>"/>
                                <input type="hidden" id="id_commessa_da_modificare" name="id_commessa_da_modificare"  value="<?=$row['id']?>"/>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Localit&agrave;*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Localit&agrave;" id="localita" name="localita" value="<?=$row['localita']?>" />
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              	<label class="col-md-4 control-label">Data Inizio*:</label>
                              <div class="col-md-8">
                              	<input type="text" class="form-control data_picker" value="<?=$data_inizio?>"  id="data_inizio" name="data_inizio" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Data Fine:</label>
                              <div class="col-md-8">
                              	<input type="text" class="form-control data_picker" value="<?=$data_fine?>" id="data_fine" name="data_fine" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Descrizione:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Descrizione" id="descrizione" name="descrizione" value="<?=$row['descrizione']?>" />
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Azzera data fine:</label>
                              <div class="col-md-8">
                                <div class="btn btn-default btn-block" id="clear_data">Cancella data fine</div>
                              </div>
                            </div>
                          </div>

                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label  class="col-md-4 control-label">Annotazioni:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Annotazioni" id="annotazioni" name="annotazioni" value="<?=$row['annotazioni']?>" />
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label  class="col-md-4 control-label">Ad hoc generale:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" maxlength="5" placeholder="Magazzino ad hoc generale" id="campo1" name="campo1" value="<?=$row['campo1']?>" />
                              </div>
                            </div>
                          </div>
                         <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label  class="col-md-4 control-label">Ad hoc cap:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" maxlength="5" placeholder="Magazzino ad hoc cap" id="campo2" name="campo2" value="<?=$row['campo2']?>" />
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label  class="col-md-4 control-label">Ad hoc imp:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" maxlength="5" placeholder="Magazzino ad hoc imp" id="campo3" name="campo3" value="<?=$row['campo3']?>" />
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label  class="col-md-4 control-label">Ad hoc cg:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" maxlength="5" placeholder="Magazzino ad hoc cg" id="campo4" name="campo4" value="<?=$row['campo4']?>" />
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label  class="col-md-4 control-label">Ad hoc fv:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" maxlength="5" placeholder="Magazzino ad hoc fv" id="campo5" name="campo5" value="<?=$row['campo5']?>" />
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label  class="col-md-4 control-label">Ad hoc om:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" maxlength="5" placeholder="Magazzino ad hoc om" id="campo6" name="campo6" value="<?=$row['campo6']?>" />
                              </div>
                            </div>
                          </div>

                        </div><!-- /.row this actually does not appear to be needed with the form-horizontal -->
                      </form>