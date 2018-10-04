<?php
    include("controllaSessione.php");
	include("../databases/db_function.php");
	require_once("../lib/verificaConvertiData.php");
	require_once("../classi/class.Ral.php");
	
	$id = isset($_GET['id']) ? $_GET['id'] : "";
	$id_commessa = isset($_GET['id_commessa']) ? $_GET['id_commessa'] : "";
	
	if($id != ""){
		$ral = new Ral();
		$e_query_ral = $ral->caricaRalById($id);
		$row = $e_query_ral->fetch_array();
        $data = CapovolgiData($row['data']);	

	} else {
		$data = date('d-m-Y');	
	}

?>
<!--SCRIPT SITO-->
<script src="js/sito/div_nuova_ral.js" type="text/javascript"></script>

<form class="form-horizontal" id="formNewRal" name="formNewRal" enctype="multipart/form-data" action='lib/operazioni_ral.lib.php' method='POST'>

                        <div class="row">
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">SAL*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="SAL"  id="ral" name="ral"  value="<?=$row['ral']?>"/>
                                <input type="hidden" id="id_da_modificare" name="id_da_modificare"  value="<?=$id?>"/>
                                <input type="hidden" id="tipo" name="tipo"  value="inserimento"/>
                                <input type="hidden" id="id_commessa" name="id_commessa"  value="<?=$id_commessa?>"/>
                              </div>
                            </div>
                          </div>

                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Importo SAL*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" value="<?=$row['totale_ral']?>" id="totale_ral" name="totale_ral">
                              </div>
                            </div>
                          </div>
                            <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Data:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control data_picker" value="<?=$data?>" id="data" name="data" readonly />
                              </div>
                            </div>
                            </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Note:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" value="<?=$row['note']?>" id="note" name="note">
                              </div>
                            </div>
                          </div>
                                                      <div class="col-sm-6 col-lg-6">
                                                          <div class="form-group">
                                                              <label class="col-md-4 control-label">Tipologia*:</label>
                                                              <div class="col-md-8">
                                                                  <select class="form-control" id="tipologia" name="tipologia">
                                                                      <option  value="">Tipologia</option>
                                                                      <option <? if($row['tipologia'] == "cap"){ echo "selected"; } ?> value="cap">cap</option>
                                                                      <option <? if($row['tipologia'] == "fv"){ echo "selected"; } ?> value="fv">fv</option>
                                                                      <option <? if($row['tipologia'] == "cg"){ echo "selected"; } ?> value="cg">cg</option>
                                                                      <option <? if($row['tipologia'] == "imp"){ echo "selected"; } ?> value="imp">imp</option>
                                                                      <option <? if($row['tipologia'] == "om"){ echo "selected"; } ?> value="om">om</option>
                                                                  </select>
                                                              </div>
                                                          </div>
                                                      </div>
                          <div class="col-sm-12 col-lg-12">
                              <div class="form-group">
							  <? if($row['nome_allegato'] == "") { ?>
                              <label class="col-md-4 control-label"></label>
                              <div class="col-md-8">
                                    <input  type="file" id="files" name="files"/>
                                    <input  type="hidden" name="tipo_cartella" id="tipo_cartella" value="ral"/>
                                    <input  type="hidden" name="cartella" id="cartella" value="commesse"/>
                               </div>
                                <? } else { ?>
                              <label class="col-md-4 control-label">Allegato:</label>
                              <div class="col-md-8">
                              	<a href="<?=$row['link_allegato']?><?=$row['nome_allegato']?>" target="_blank" class="btn">
									<i class="fa fa-external-link"></i> <?=$row['nome_allegato']?>
                                </a>
                                <div class="btn" data-toggle="modal" data-target=".bs-elimina"  id_commessa="<?=$id_commessa?>" nome="<?=$row['nome_allegato']?>" id_ral="<?=$row['id']?>" id="btn_elimina_ral"><i class="fa fa-trash-o fa-lg"></i></div>
                              </div>
                                <? } ?>
                            </div>
                            
                          </div>


                                                         
                          <div class="col-sm-12 col-lg-12">
                           
                          </div>
                        </div><!-- /.row this actually does not appear to be needed with the form-horizontal -->
                        <input type="hidden" id="id_ral_modifica" value="<?=$id?>"/>
                      </form>
                      
                      