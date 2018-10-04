<?php
    include("controllaSessione.php");
	include("../databases/db_function.php");
	require_once("../lib/verificaConvertiData.php");
	require_once("../classi/class.Mezzi.php");
	
	$id = isset($_GET['id']) ? $_GET['id'] : "";
	
	if($id != ""){
		$mezzo = new Mezzi();
		$e_query_mezzo = $mezzo->caricaMezzoById($id);
		$row = $e_query_mezzo->fetch_array();
	}

?>
    <!--SCRIPT SITO-->
    <script src="js/sito/div_nuovo_mezzo.js" type="text/javascript"></script>

    <form class="form-horizontal" id="formNewMezzo"  name="formNewMezzo" method="post" role="form">
                        <div class="row">
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Mezzo*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Mezzo"  id="mezzo" name="mezzo"  value="<?=$row['mezzo']?>"/>
                                <input type="hidden" id="id_da_modificare" name="id_da_modificare"  value="<?=$id?>"/>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Targa*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Targa" id="targa" name="targa" value="<?=$row['targa']?>" />
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              	<label class="col-md-4 control-label">Km percorsi*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Km percorsi" id="km_percorsi" name="km_percorsi" value="<?=$row['km_percorsi']?>" />
                                <input type="hidden" class="form-control"  id="km_percorsi_vecchi" name="km_percorsi_vecchi" value="<?=$row['km_percorsi']?>" />
                              </div>
                            </div>
                          </div>
                            <div class="col-sm-6 col-lg-6" style="display:none">
                            <div class="form-group">
                              	<label class="col-md-4 control-label">Tagliando ogni*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Tagliando ogni...in KM" id="tagliando_ogni" name="tagliando_ogni" value="0" />
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Immatricolazione*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Anno Immatricolazione" id="immatricolazione" name="immatricolazione" value="<?=$row['immatricolazione']?>" />
                              </div>
                            </div>
                          </div>
                           <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              	<label class="col-md-4 control-label">Possesso*:</label>
                              <div class="col-md-8">
                              	<select class="form-control" id="venduto" name="venduto">
                              		<option <? if($row['venduto'] != "VENDUTO"){ echo "selected"; } ?> value="IN_POSSESSO">IN POSSESSO</option>
                              		<option <? if($row['venduto'] == "VENDUTO"){ echo "selected"; } ?> value="VENDUTO">VENDUTO</option>
                              	</select>
                              </div>
                            </div>
                          </div>
                                                         
                          
                        </div><!-- /.row this actually does not appear to be needed with the form-horizontal -->
                      </form>