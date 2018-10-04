<?php
    include("controllaSessione.php");
	include("../databases/db_function.php");
	require_once("../lib/verificaConvertiData.php");
	require_once("../classi/class.RevisioniContrattuali.php");
	
	$id = isset($_GET['id']) ? $_GET['id'] : "";
	$id_commessa = isset($_GET['id_commessa']) ? $_GET['id_commessa'] : "";
	
	if($id != ""){
		$revisioneContrattuale = new RevisioniContrattuali();
		$e_query_revisione_contrattuale = $revisioneContrattuale->caricaRevisioneContrattualeById($id);
		$row = $e_query_revisione_contrattuale->fetch_array();
		$data = CapovolgiData($row['data']);	
	} else {
		$data = date('d-m-Y');	
	}

?>
<!--SCRIPT SITO-->
<script src="js/sito/div_nuova_revisione_contrattuale.js" type="text/javascript"></script>

<form class="form-horizontal" id="formNewRevisioneContrattuale" name="formNewRevisioneContrattuale" enctype="multipart/form-data" action='lib/operazioni_revisione_contrattuale.lib.php' method='POST'>

                        <div class="row">
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Tipo Documento*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Tipo documento"  id="tipo_documento" name="tipo_documento"  value="<?=$row['tipo_documento']?>"/>
                                <input type="hidden" id="id_da_modificare" name="id_da_modificare"  value="<?=$id?>"/>
                                <input type="hidden" id="tipo" name="tipo"  value="inserimento"/>
                                <input type="hidden" id="id_commessa" name="id_commessa"  value="<?=$id_commessa?>"/>

                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Data Documento:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control data_picker" value="<?=$data?>" id="data" name="data" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              	<label class="col-md-4 control-label">Numero Documento*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Numero Documento" id="numero_documento" name="numero_documento" value="<?=$row['numero_documento']?>" />
                              </div>
                            </div>
                            <div class="form-group">
							  <? if($row['nome_allegato'] == "") { ?>
                              <label class="col-md-4 control-label"></label>
                              <div class="col-md-8">
                                    <input  type="file" id="files" name="files"/>
                                    <input  type="hidden" name="tipo_cartella" id="tipo_cartella" value="revisioni"/>
                                    <input  type="hidden" name="cartella" id="cartella" value="commesse"/>
                               </div>
                                <? } else { ?>
                              <label class="col-md-4 control-label">Allegato:</label>
                              <div class="col-md-8">
                              	<a href="<?=$row['link_allegato']?><?=$row['nome_allegato']?>" target="_blank" class="btn btn-info">
									<?=$row['nome_allegato']?>
                                </a>
                                <div class="btn btn-danger" data-toggle="modal" data-target=".bs-elimina"  id_commessa="<?=$id_commessa?>" nome="<?=$row['nome_allegato']?>" id_revisione_contrattuale="<?=$row['id']?>" id="btn_elimina_revisione_contrattuale">Elimina Allegato</div>
                              </div>
                                <? } ?>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Registrato a:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Registrato a" value="<?=$row['registrato_a']?>" id="registrato_a" name="registrato_a">
                              </div>
                            </div>
                          </div>
                          
                        </div><!-- /.row this actually does not appear to be needed with the form-horizontal -->
                        <input type="hidden" id="id_revisione_contrattuale_modifica" value="<?=$id?>"/>
                      </form>
                      
                      