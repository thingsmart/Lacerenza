<?php
    include("controllaSessione.php");
	include("../databases/db_function.php");
	require_once("../lib/verificaConvertiData.php");
	require_once("../classi/class.Fatture.php");
	
	$id = isset($_GET['id']) ? $_GET['id'] : "";
	$id_commessa = isset($_GET['id_commessa']) ? $_GET['id_commessa'] : "";
	
	if($id != ""){
		$fattura = new Fatture();
		$e_query_fattura = $fattura->caricaFatturaById($id);
		$row = $e_query_fattura->fetch_array();
		$data = CapovolgiData($row['data_pagamento']);	
        if($row['data_incasso'] != "0000-00-00"){
            $data_incasso = CapovolgiData($row['data_incasso']);	
        } else {
            $row['data_incasso'];
        }
	} else {
		$data = date('d-m-Y');	
        $data_incasso = "";
	}

?>
<!--SCRIPT SITO-->
<script src="js/sito/div_nuova_fattura.js" type="text/javascript"></script>

<form class="form-horizontal" id="formNewFattura" name="formNewFattura" enctype="multipart/form-data" action='lib/operazioni_fattura.lib.php' method='POST'>

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
                              <label class="col-md-4 control-label">Descrizione:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" value="<?=$row['descrizione']?>" id="descrizione" name="descrizione">
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              	<label class="col-md-4 control-label">Importo totale*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Importo totale" id="importo_totale" name="importo_totale" value="<?=$row['importo_totale']?>" />
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Data Pagamento*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control data_picker" value="<?=$data?>" id="data_pagamento" name="data_pagamento" readonly>
                              </div>
                            </div>
                          </div>
                            <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Data Incasso:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control data_picker" value="<?=$data_incasso?>" id="data_incasso" name="data_incasso" readonly>
                              </div>
                            </div>
                          </div>
                          
                                                          
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
							  <? if($row['nome_allegato'] == "") { ?>
                              <label class="col-md-4 control-label"></label>
                              <div class="col-md-8">
                                    <input  class="btn" type="file" id="files" name="files"/>
                                    <input  type="hidden" name="tipo_cartella" id="tipo_cartella" value="fatture"/>
                                    <input  type="hidden" name="cartella" id="cartella" value="commesse"/>
                               </div>
                                <? } else { ?>
                              <label class="col-md-4 control-label">Allegato:</label>
                              <div class="col-md-8">
                              	<a href="<?=$row['link_allegato']?><?=$row['nome_allegato']?>" target="_blank" class="btn">
									<i class="fa fa-external-link"></i> <?=$row['nome_allegato']?>
                                </a>
                                <div class="btn" data-toggle="modal" data-target=".bs-elimina"  id_commessa="<?=$id_commessa?>" nome="<?=$row['nome_allegato']?>" id_fattura="<?=$row['id']?>" id="btn_elimina_fattura"><i class="fa fa-trash-o fa-lg"></i></div>
                              </div>
                                <? } ?>
                            </div>
                          </div>
                        </div><!-- /.row this actually does not appear to be needed with the form-horizontal -->
                        <input type="hidden" id="id_fattura_modifica" value="<?=$id?>"/>
                      </form>
                      
                      