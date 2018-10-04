<?php
    include("controllaSessione.php");
	include("../databases/db_function.php");
	require_once("../lib/verificaConvertiData.php");
	require_once("../classi/class.Regolarita.php");
	
	$id = isset($_GET['id']) ? $_GET['id'] : "";
	$id_commessa = isset($_GET['id_commessa']) ? $_GET['id_commessa'] : "";
	
	if($id != ""){
		$regolarita = new Regolarita();
		$e_query_regolarita = $regolarita->caricaRegolaritaById($id);
		$row = $e_query_regolarita->fetch_array();
		$data = CapovolgiData($row['data']);	
		$scadenza = CapovolgiData($row['scadenza']);	
	} else {
		$data = date('d-m-Y');	
		$scadenza = date('d-m-Y');	
	}

?>
<!--SCRIPT SITO-->
<script src="js/sito/div_nuova_regolarita.js" type="text/javascript"></script>

<form class="form-horizontal" id="formNewRegolarita" name="formNewRegolarita" enctype="multipart/form-data" action='lib/operazioni_regolarita.lib.php' method='POST'>

                        <div class="row">
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Descrizione*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Descrizione"  id="descrizione" name="descrizione"  value="<?=$row['descrizione']?>"/>
                                <input type="hidden" id="id_da_modificare" name="id_da_modificare"  value="<?=$id?>"/>
                                <input type="hidden" id="tipo" name="tipo"  value="inserimento"/>
                                <input type="hidden" id="id_commessa" name="id_commessa"  value="<?=$id_commessa?>"/>

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
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              	<label class="col-md-4 control-label">Ente*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Ente" id="ente" name="ente" value="<?=$row['ente']?>" />
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Scadenza*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control data_picker" value="<?=$scadenza?>" id="scadenza" name="scadenza" readonly>
                              </div>
                            </div>
                          </div>
                                                          
                          <div class="col-sm-6 col-lg-6">
                            <div class="">
							  <? if($row['nome_allegato'] == "") { ?>
                              <label class="col-md-4 control-label"></label>
                              <div class="col-md-8">
                                    <input  class="btn"  type="file" id="files" name="files"/>
                                    <input  type="hidden" name="tipo_cartella" id="tipo_cartella" value="regolarita"/>
                                    <input  type="hidden" name="cartella" id="cartella" value="commesse"/>
                               </div>
                                <? } else { ?>
                              <label class="col-md-4 control-label">Allegato:</label>
                              <div class="col-md-8">
                              	<a href="<?=$row['link_allegato']?><?=$row['nome_allegato']?>" target="_blank" class="btn">
									<i class="fa fa-external-link"></i> <?=$row['nome_allegato']?>
                                </a>
                                <div class="btn" data-toggle="modal" data-target=".bs-elimina"  id_commessa="<?=$id_commessa?>" nome="<?=$row['nome_allegato']?>" id_regolarita="<?=$row['id']?>" id="btn_elimina_regolarita"><i class="fa fa-trash-o fa-lg"></i></div>
                              </div>
                                <? } ?>
                            </div>
                          </div>
                        </div><!-- /.row this actually does not appear to be needed with the form-horizontal -->
                        <input type="hidden" id="id_regolarita_modifica" value="<?=$id?>"/>
                      </form>
                      
                      