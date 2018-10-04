<?php
    include("controllaSessione.php");
	include("../databases/db_function.php");
	require_once("../lib/verificaConvertiData.php");
	require_once("../classi/class.DocumentiCliente.php");
	
	$id = isset($_GET['id']) ? $_GET['id'] : "";
	$id_commessa = isset($_GET['id_commessa']) ? $_GET['id_commessa'] : "";
	
	if($id != ""){
		$documentoCliente = new DocumentiCliente();
		$e_query_documento_cliente = $documentoCliente->caricaDocumentoById($id);
		$row = $e_query_documento_cliente->fetch_array();
		$data = CapovolgiData($row['data']);
        //VALIDITA
        if($row['validita'] != "0000-00-00"){
            $data_validita = CapovolgiData($row['validita']);	
        } else {
            $row['validita'];
        }
        
        //Scadenza
        if($row['scadenza'] != "0000-00-00"){
            $data_scadenza = CapovolgiData($row['scadenza']);	
        } else {
            $row['scadenza'];
        }
        
        //Rinnovo
        if($row['rinnovo'] != "0000-00-00"){
            $data_rinnovo = CapovolgiData($row['rinnovo']);	
        } else {
            $row['rinnovo'];
        }
	} else {
		$data = date('d-m-Y');	
        $data_validita = "";
        $data_scadenza = "";
        $data_rinnovo = "";
	}

?>
<!--SCRIPT SITO-->
<script src="js/sito/div_nuovo_documento_cliente.js" type="text/javascript"></script>

<form class="form-horizontal" id="formNewDocumento" name="formNewDocumento" enctype="multipart/form-data" action='lib/operazioni_documento_cliente.lib.php' method='POST'>

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
                              <label class="col-md-4 control-label">Ente rilascio*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control"  placeholder="Ente rilascio" value="<?=$row['ente_rilascio']?>" id="ente_rilascio" name="ente_rilascio">
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Data*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control data_picker" value="<?=$data?>" id="datao" name="data" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Validit&agrave;:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control data_picker" value="<?=$data_validita?>" id="validita" name="validita" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Scadenza:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control data_picker" value="<?=$data_scadenza?>" id="scadenza" name="scadenza" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Rinnovo:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control data_picker" value="<?=$data_rinnovo?>" id="rinnovo" name="rinnovo" readonly>
                              </div>
                            </div>
                          </div>                          
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
							  <? if($row['nome_allegato'] == "") { ?>
                              <label class="col-md-4 control-label"></label>
                              <div class="col-md-8">
                                    <input  type="file" id="files" name="files"/>
                                    <input  type="hidden" name="tipo_cartella" id="tipo_cartella" value="documenti_cliente"/>
                                    <input  type="hidden" name="cartella" id="cartella" value="commesse"/>
                               </div>
                                <? } else { ?>
                              <label class="col-md-4 control-label">Allegato:</label>
                              <div class="col-md-8">
                              	<a href="<?=$row['link_allegato']?><?=$row['nome_allegato']?>" target="_blank">
									<i class="fa fa-external-link"></i> <?=$row['nome_allegato']?>
                                </a>
                                <div class="btn" data-toggle="modal" data-target=".bs-elimina"  id_commessa="<?=$id_commessa?>" nome="<?=$row['nome_allegato']?>" id_documento_cliente="<?=$row['id']?>" id="btn_elimina_documento_cliente"><i class="fa fa-trash-o fa-lg"></i></div>
                              </div>
                                <? } ?>
                            </div>
                          </div>
                        </div><!-- /.row this actually does not appear to be needed with the form-horizontal -->
                        <input type="hidden" id="id_documento_cliente_modifica" value="<?=$id?>"/>
                      </form>
                      
                      