<?php
    include("controllaSessione.php");
	include("../databases/db_function.php");
	require_once("../lib/verificaConvertiData.php");
	require_once("../classi/class.Gare.php");
	
	$id = isset($_GET['id']) ? $_GET['id'] : "";
	
	if($id != ""){
		$gara = new Gare();
		$e_query = $gara->caricaById($id);
		$row = $e_query->fetch_array();
		$data_emissione = CapovolgiData($row['data_emissione']);	
		$data_scadenza = CapovolgiData($row['data_scadenza']);	
	} else {
		$data_emissione = date('d-m-Y');	
		$data_scadenza = date('d-m-Y');	
	}

?>
<!--SCRIPT SITO-->
<script src="js/sito/div_nuova_gara.js" type="text/javascript"></script>

<? if($id != ""){?>
	<script>
    $(document).ready(function () {
        $("#tabella_allegati_gara").load("php/tabella_allegati_gara.php?id=<?=$id?>");
	});
</script>
<? } ?>
<form class="form-horizontal" id="formNewGara" name="formNewGara" enctype="multipart/form-data" action='lib/operazioni_gara.lib.php' method='POST'>

                        <div class="row">
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Descrizione*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Descrizione"  id="descrizione" name="descrizione"  value="<?=$row['descrizione']?>"/>
                                <input type="hidden" id="id_da_modificare" name="id_da_modificare"  value="<?=$id?>"/>
                                <input type="hidden" id="tipo" name="tipo"  value="inserimento"/>

                              </div>
                            </div>
                          </div>
                          
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Polizze*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control"  placeholder="Polizze" id="polizze" name="polizze" value="<?=$row['polizze']?>">
                              </div>
                            </div>
                          </div>
                          
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Data emissione*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control data_picker" value="<?=$data_emissione?>" id="data_emissione" name="data_emissione" readonly>
                              </div>
                            </div>
                          </div>
                          
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Data scadenza*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control data_picker" value="<?=$data_scadenza?>" id="data_scadenza" name="data_scadenza" readonly>
                              </div>
                            </div>
                          </div>
                          
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">AVCP:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control"  placeholder="AVCP" id="avcp" name="avcp" value="<?=$row['avcp']?>">
                              </div>
                            </div>
                          </div>
                          
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">PASSOE:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control"  placeholder="PASSOE" id="passoe" name="passoe" value="<?=$row['passoe']?>">
                              </div>
                            </div>
                          </div>
                          
                          
                          
                          
                          
                          
                                                          
                          <!-- <div class="col-sm-12 col-lg-12">
                            <div class="form-group">
							  <? if($row['link_file'] == "") { ?>
                              <label class="col-md-4 control-label"></label>
                              <div class="col-md-8">
                                    <input class="btn btn-info"  type="file" id="files" name="files" value="<?=$row['link_file']?>"/>
                               </div>
                                <? } else { ?>
                              <label class="col-md-4 control-label">Allegato:</label>
                              <div class="col-md-8">
                              	<a href="<?=$row['link_file']?>" target="_blank" class="btn btn-info">
									Apri file
                                </a>
                                <div class="btn btn-danger" data-toggle="modal" data-target=".bs-elimina"   id_preventivo="<?=$row['id']?>" id="btn_elimina_allegato">Elimina Allegato</div>
                              </div>
                                <? } ?>
                            </div>
                          </div> -->
                        </div><!-- /.row this actually does not appear to be needed with the form-horizontal -->
                        <input type="hidden" id="id_modifica" value="<?=$id?>"/>
                      </form>
                        <br>
                        <!--ALLEGO FILE-->
                        <? if($id != ""){ ?>
                        <div class="row">
                          <div class="col-sm-12 col-lg-12 text-center">
                          	<h1>Allega file</h1>
                          	<br>
                          	<form class="form-horizontal" id="formAllega" name="formAllega" enctype="multipart/form-data" action='lib/operazioni_allegati_gara.lib.php' method='POST'>
                          	<div class="row">
                          		<div class="col-sm-4 col-lg-4 text-center">
                          			<input style="margin:auto" class="btn btn-info"  type="file" id="files" name="files"/>
                                	<input type="hidden" id="tipo_allegato" name="tipo_allegato"  value="allega_file"/>
                                	<input type="hidden" id="id_gara" name="id_gara"  value="<?=$id?>"/>
                          		</div>
                          		<div class="col-sm-6 col-lg-6 text-center">
                                <input type="text" class="form-control"  placeholder="Descrizione file" id="descrizione_file" name="descrizione_file">
                          		</div>
                          		<div class="col-sm-2 col-lg-2 text-center">
                          			<div id="btn_allega" class="btn btn-success" style="width:100%">Allega</div>
                          			
                          		</div>
                          	</div>
                          	</form>
                          	<br>
                          	<div class="row">
                          	<div class="col-sm-12 col-lg-12 text-center">
                          		<div id="tabella_allegati_gara"></div>
                          	</div>
                          	</div>
                          </div>
                          </div>
                          <? } ?>
                         <!--FINE ALLEGO FILE-->
                      
                      