<?php
    include("controllaSessione.php");
	include("../databases/db_function.php");
	require_once("../lib/verificaConvertiData.php");
	require_once("../classi/class.Tecnica.php");
	
	$id = isset($_GET['id']) ? $_GET['id'] : "";
	
	if($id != ""){
		$tecnica = new Tecnica();
		$e_query = $tecnica->caricaById($id);
		$row = $e_query->fetch_array();
		$data = CapovolgiData($row['data']);	
		$data_acquisizione = CapovolgiData($row['data_acquisizione']);	
	} else {
		$data = date('d-m-Y');	
	}

?>
<!--SCRIPT SITO-->
<script src="js/sito/div_nuova_tecnica.js" type="text/javascript"></script>

<form class="form-horizontal" id="formNewTecnica" name="formNewTecnica" enctype="multipart/form-data" action='lib/operazioni_tecnica.lib.php' method='POST'>

                        <div class="row">
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Numero preventivo:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Numero preventivo"  id="num_preventivo" name="num_preventivo"  value="<?=$row['num_preventivo']?>"/>
                                <input type="hidden" id="id_da_modificare" name="id_da_modificare"  value="<?=$id?>"/>
                                <input type="hidden" id="tipo" name="tipo"  value="inserimento"/>

                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Cliente:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control"  placeholder="Cliente" id="cliente" name="cliente" value="<?=$row['cliente']?>">
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Sopraluogo:</label>
                              <div class="col-md-8">
                              	<select class="form-control"  id="sopraluogo" name="sopraluogo">
                              		<option <? if($row['sopraluogo'] == "SI"){ echo "selected";} ?> value="SI">SI</option>
                              		<option <? if($row['sopraluogo'] == "NO"){ echo "selected";} ?> value="NO">NO</option>
                              	</select>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Data emissione offerta:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control data_picker" value="<?=$data?>" id="data" name="data" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Oggetto offerta:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control"  placeholder="Oggetto offerta" id="offerta" name="offerta" value="<?=$row['offerta']?>">
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Operatore:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control"  placeholder="Operatore" id="operatore" name="operatore" value="<?=$row['operatore']?>">
                              </div>
                            </div>
                          </div>
                           <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Ricontatti:</label>
                              <div class="col-md-8">
                                <!-- <input type="text" class="form-control"  placeholder="Ricontatti" id="ricontatti" name="ricontatti" value="<?=$row['ricontatti']?>"> -->
                              	<textarea class="form-control"  placeholder="Ricontatti" id="ricontatti" name="ricontatti"><?=$row['ricontatti']?></textarea>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Esito Preventivo:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control"  placeholder="Esito Preventivo" id="esito" name="esito" value="<?=$row['esito']?>">
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Nuovo/Vecchio cliente:</label>
                              <div class="col-md-8">
                              	<select class="form-control"  id="tipo_cliente" name="tipo_cliente">
                              		<option <? if($row['tipo_cliente'] == "NUOVO"){ echo "selected";} ?> value="NUOVO">NUOVO</option>
                              		<option <? if($row['tipo_cliente'] == "VECCHIO"){ echo "selected";} ?> value="VECCHIO">VECCHIO</option>
                              	</select>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Sede/Fuori sede:</label>
                              <div class="col-md-8">
                              	<select class="form-control"  id="tipo_sede" name="tipo_sede">
                              		<option <? if($row['tipo_sede'] == "SEDE"){ echo "selected";} ?> value="SEDE">SEDE</option>
                              		<option <? if($row['tipo_sede'] == "FUORI SEDE"){ echo "selected";} ?> value="FUORI SEDE">FUORI SEDE</option>
                              	</select>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Motivazione esito negativo:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control"  placeholder="Motivazione esito negativo" id="motivazione" name="motivazione" value="<?=$row['motivazione']?>">
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Data acquisizione:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control data_picker" value="<?=$data_acquisizione?>" id="data_acquisizione" name="data_acquisizione" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Modalit&agrave; contrattuale:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control"  placeholder="Modalit&agrave; contrattuale" id="modalita" name="modalita" value="<?=$row['modalita']?>">
                              </div>
                            </div>
                          </div>
                          
                                                          
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
							  <? if($row['link_file'] == "") { ?>
                              <label class="col-md-4 control-label"></label>
                              <div class="col-md-8">
                                    <input class="btn"  type="file" id="files" name="files" value="<?=$row['link_file']?>"/>
                               </div>
                                <? } else { ?>
                              <label class="col-md-4 control-label">Allegato:</label>
                              <div class="col-md-8">
                              	<a href="<?=$row['link_file']?>" target="_blank" class="btn">
									Apri file
                                </a>
                                <div class="btn" data-toggle="modal" data-target=".bs-elimina"   id_preventivo="<?=$row['id']?>" id="btn_elimina_allegato"><i class="fa fa-trash fa-lg"></i></div>
                              </div>
                                <? } ?>
                            </div>
                          </div>
                        </div><!-- /.row this actually does not appear to be needed with the form-horizontal -->
                        <input type="hidden" id="id_modifica" value="<?=$id?>"/>
                      </form>
                      
                      