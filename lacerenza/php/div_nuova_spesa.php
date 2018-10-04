<?php
    include("controllaSessione.php");
	include("../databases/db_function.php");
	require_once("../lib/verificaConvertiData.php");
	require_once("../classi/class.Spese.php");
	
	$id = isset($_GET['id']) ? $_GET['id'] : "";
	$id_mezzo = isset($_GET['id_mezzo']) ? $_GET['id_mezzo'] : "";
	
	if($id != ""){
		$spesa = new Spese();
		$e_query_spesa = $spesa->caricaSpesaById($id);
		$row = $e_query_spesa->fetch_array();
		$data = CapovolgiData($row['data_ultimo_pagamento']);
        if($row['data_scadenza'] != "0000-00-00"){
            $data_scadenza = CapovolgiData($row['data_scadenza']);
        } else {
            $data_scadenza = "";
        }
	} else {
		$data = date('d-m-Y');	
	}

?>
<!--SCRIPT SITO-->
<script src="js/sito/div_nuova_spesa.js" type="text/javascript"></script>

<form class="form-horizontal" id="formNewSpesa" name="formNewSpesa" enctype="multipart/form-data" action='lib/operazioni_spesa.lib.php' method='POST'>

                        <div class="row">
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Tipo*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Tipo"  id="tipo_spesa" name="tipo_spesa"  value="<?=$row['tipo']?>"/>
                                <input type="hidden" id="id_da_modificare" name="id_da_modificare"  value="<?=$id?>"/>
                                <input type="hidden" id="tipo" name="tipo"  value="inserimento"/>
                                <input type="hidden" id="id_mezzo" name="id_mezzo"  value="<?=$id_mezzo?>"/>

                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Data*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control data_picker" value="<?=$data?>" id="data_ultimo_pagamento" name="data_ultimo_pagamento" readonly>
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
							  <? if($row['riferimento_fattura'] == "") { ?>
                              <label class="col-md-4 control-label"></label>
                              <div class="col-md-8">
                                    <input  type="file" id="files" name="files"/>
                                    <input  type="hidden" name="tipo_cartella" id="tipo_cartella" value="spese"/>
                                    <input  type="hidden" name="cartella" id="cartella" value="mezzi"/>
                               </div>
                                <? } else { ?>
                              <label class="col-md-4 control-label">Allegato:</label>
                              <div class="col-md-8">
                              	<a href="uploads/mezzi/<?=$id_mezzo?>/spese/<?=$row['riferimento_fattura']?>" target="_blank" class="btn btn-info">
									<?=$row['riferimento_fattura']?>
                                </a>
                                <div class="btn btn-danger" data-toggle="modal" data-target=".bs-elimina" id_mezzo="<?=$id_mezzo?>" nome="<?=$row['riferimento_fattura']?>" id_tagliando="<?=$row['id']?>" id="btn_elimina_spesa">Elimina Allegato</div>
                              </div>
                                <? } ?>
                            </div>
                          </div>
                            <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              	<label class="col-md-4 control-label">Data Scadenza:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control data_picker" placeholder="Data Scadenza" id="data_scadenza" name="data_scadenza" value="<?=$data_scadenza?>" readonly/>
                              	<bR>
                              	<div id="elimina_scadenza" class="btn btn-default" style="width:100%">Elimina data scadenza</div>
                              </div>
                            </div>
                          </div>
                            <div class="col-sm-6 col-lg-6">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Disabilita avviso:</label>
                                    <div class="col-md-8">
                                        <input type="checkbox" <? if($row['eseguito'] == 1){ echo "checked"; }?>  id="avviso" name="avviso" />
                                    </div>
                                </div>
                            </div>

                                                          
                         
                        </div><!-- /.row this actually does not appear to be needed with the form-horizontal -->
                        <input type="hidden" id="id_tagliando_modifica" value="<?=$id?>"/>
                      </form>
                      
                      