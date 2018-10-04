<?php
    include("controllaSessione.php");
	include("../databases/db_function.php");
	require_once("../lib/verificaConvertiData.php");
	require_once("../classi/class.Tagliandi.php");
	
	$id = isset($_GET['id']) ? $_GET['id'] : "";
	$id_mezzo = isset($_GET['id_mezzo']) ? $_GET['id_mezzo'] : "";
	
	if($id != ""){
		$tagliando = new Tagliandi();
		$e_query_tagliando = $tagliando->caricaTagliandoById($id);
		$row = $e_query_tagliando->fetch_array();
		$data = CapovolgiData($row['data_tagliando']);	
	} else {
		$data = date('d-m-Y');	
	}

?>
<!--SCRIPT SITO-->
<script src="js/sito/div_nuovo_tagliando.js" type="text/javascript"></script>
<script>
$('#colorSelector').ColorPicker({
	color: '#<?=$row['colore']?>',
	onShow: function (colpkr) {
		$(colpkr).fadeIn(500);
		return false;
	},
	onHide: function (colpkr) {
		$(colpkr).fadeOut(500);
		return false;
	},
	onChange: function (hsb, hex, rgb) {
		$('#colorSelector div').css('backgroundColor', '#' + hex);
		$("#colore").val(hex);
	}
});
</script>


			
				
<form class="form-horizontal" id="formNewTagliando" name="formNewTagliando" enctype="multipart/form-data" action='lib/operazioni_tagliando.lib.php' method='POST'>

                        <div class="row">
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Tipo*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Tipo"  id="tipo_tagliando" name="tipo_tagliando"  value="<?=$row['tipo_tagliando']?>"/>
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
                                <input type="text" class="form-control data_picker" value="<?=$data?>" id="data_tagliando" name="data_tagliando" readonly>
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
                          </div>
                          
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              	<label class="col-md-4 control-label">Km veicolo*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Km del veicolo al momento del tagliando" id="tagliando_ogni" name="tagliando_ogni" value="<?=$row['tagliando_ogni']?>" />
                              </div>
                            </div>
                          </div>
                          
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              	<label class="col-md-4 control-label">Km tagliando*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Km del prossimo taglaindo" id="tagliando_prossimo" name="tagliando_prossimo" value="<?=$row['tagliando_prossimo']?>" />
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              	<label class="col-md-4 control-label">Colore avviso:</label>
                              <div class="col-md-8">
                                <div id="colorSelector"><div style="background-color: #<?=$row['colore']?>"></div></div>
                                <input  type="hidden" name="colore" id="colore" value="<?=$row['colore']?>"/>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                             <div class="form-group">
							  <? if($row['riferimento_fattura'] == "") { ?>
                              <label class="col-md-4 control-label"></label>
                              <div class="col-md-8">
                                    <input  type="file" id="files" name="files"/>
                                    <input  type="hidden" name="tipo_cartella" id="tipo_cartella" value="tagliandi"/>
                                    <input  type="hidden" name="cartella" id="cartella" value="mezzi"/>
                               </div>
                                <? } else { ?>
                              <label class="col-md-4 control-label">Allegato:</label>
                              <div class="col-md-8">
                              	<a href="uploads/mezzi/<?=$id_mezzo?>/tagliandi/<?=$row['riferimento_fattura']?>" target="_blank" class="btn btn-info">
									<?=$row['riferimento_fattura']?>
                                </a>
                                <div class="btn btn-danger" data-toggle="modal" data-target=".bs-elimina" id_mezzo="<?=$id_mezzo?>" nome="<?=$row['riferimento_fattura']?>" id_tagliando="<?=$row['id']?>" id="btn_elimina_tagliando">Elimina Allegato</div>
                              </div>
                                <? } ?>
                            </div>
                          </div>
                                                          
                          <div class="col-sm-12 col-lg-12">
                           
                          </div>
                        </div><!-- /.row this actually does not appear to be needed with the form-horizontal -->
                        <input type="hidden" id="id_tagliando_modifica" value="<?=$id?>"/>
                      </form>
                      
                      