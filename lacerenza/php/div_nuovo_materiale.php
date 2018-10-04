<?php
    include("controllaSessione.php");
	include("../databases/db_function.php");
	require_once("../lib/verificaConvertiData.php");
	require_once("../classi/class.Materiali.php");
	
	$id = isset($_GET['id']) ? $_GET['id'] : "";
	$id_commessa = isset($_GET['id_commessa']) ? $_GET['id_commessa'] : "";
	
	if($id != ""){
		$materiale = new Materiali();
		$e_query_materiali = $materiale->caricaMaterialeById($id);
		$row = $e_query_materiali->fetch_array();
		$data = CapovolgiData($row['data']);	
	} else {
		$data = date('d-m-Y');	
	}

?>
<!--SCRIPT SITO-->
<script src="js/sito/div_nuovo_materiale.js" type="text/javascript"></script>

<form class="form-horizontal" id="formNewMateriale" name="formNewMateriale" enctype="multipart/form-data" action='lib/operazioni_materiale.lib.php' method='POST'>

                        <div class="row">
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Tipo materiale*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Tipo materiale"  id="tipo_materiale" name="tipo_materiale"  value="<?=$row['tipo_materiale']?>"/>
                                <input type="hidden" id="id_da_modificare" name="id_da_modificare"  value="<?=$id?>"/>
                                <input type="hidden" id="tipo" name="tipo"  value="inserimento"/>
                                <input type="hidden" id="id_commessa" name="id_commessa"  value="<?=$id_commessa?>"/>
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
                            <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              	<label class="col-md-4 control-label">Costo*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Costo" id="costo" name="costo" value="<?=$row['costo']?>" />
                              </div>
                            </div>
                            <div class="form-group">
							  <? if($row['nome_allegato'] == "") { ?>
                              <label class="col-md-4 control-label"></label>
                              <div class="col-md-8">
                                    <input  type="file" id="files" name="files"/>
                                    <input  type="hidden" name="tipo_cartella" id="tipo_cartella" value="materiali"/>
                                    <input  type="hidden" name="cartella" id="cartella" value="commesse"/>
                               </div>
                                <? } else { ?>
                              <label class="col-md-4 control-label">Allegato:</label>
                              <div class="col-md-8">
                              	<a href="<?=$row['link_allegato']?><?=$row['nome_allegato']?>" target="_blank">
									<i class="fa fa-external-link"></i> <?=$row['nome_allegato']?>
                                </a>
                                <div class="btn" data-toggle="modal" data-target=".bs-elimina"  id_commessa="<?=$id_commessa?>" nome="<?=$row['nome_allegato']?>" id_materiale="<?=$row['id']?>" id="btn_elimina_materiale"><i class="fa fa-trash-o fa-lg"></i></div>
                              </div>
                                <? } ?>
                            </div>
                          </div>
                            <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              	<label class="col-md-4 control-label">Quantit&agrave;*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Quantit&agrave;" id="quantita" name="quantita" value="<?=$row['quantita']?>" />
                              </div>
                            </div>
                          </div>
                            <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              	<label class="col-md-4 control-label">Importo*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Importo" id="importo" name="importo" value="<?=$row['importo']?>" />
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Data*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control data_picker" value="<?=$data?>" id="data" name="data" readonly>
                              </div>
                            </div>
                          </div>
                         
                        </div><!-- /.row this actually does not appear to be needed with the form-horizontal -->
                        <input type="hidden" id="id_materiale_modifica" value="<?=$id?>"/>
                      </form>
                      
                      