<?php
    include("controllaSessione.php");
	include("../databases/db_function.php");
	require_once("../lib/verificaConvertiData.php");
	require_once("../classi/class.Libretto.php");
	
	$id = isset($_GET['id']) ? $_GET['id'] : "";
	$id_mezzo = isset($_GET['id_mezzo']) ? $_GET['id_mezzo'] : "";
	
	if($id != ""){
		$libretto = new Libretto();
		$e_query_spesa = $libretto->caricaById($id);
		$row = $e_query_spesa->fetch_array();
		$data = CapovolgiData($row['data']);
        if($row['data'] != "0000-00-00"){
            $data_scadenza = CapovolgiData($row['data']);
        } else {
            $data_scadenza = "";
        }
	} else {
		$data = date('d-m-Y');	
	}

?>
<!--SCRIPT SITO-->
<script src="js/sito/div_nuovo_libretto.js" type="text/javascript"></script>

<form class="form-horizontal" id="formNewSpesa" name="formNewSpesa" enctype="multipart/form-data" action='lib/operazioni_libretto.lib.php' method='POST'>

                        <div class="row">
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Descrizione*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Descrizione"  id="descrizione" name="descrizione"  value="<?=$row['descrizione']?>"/>
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
                                <input type="text" class="form-control data_picker" value="<?=$data?>" id="data" name="data" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-12 col-lg-12">

                             <div class="form-group">
							  <? if($row['allegato'] == "") { ?>
                              <label class="col-md-4 control-label"></label>
                              <div class="col-md-8">
                                    <input  type="file" id="files" name="files"/>
                                    <input  type="hidden" name="tipo_cartella" id="tipo_cartella" value="libretto"/>
                                    <input  type="hidden" name="cartella" id="cartella" value="mezzi"/>
                               </div>
                                <? } else { ?>
                              <label class="col-md-4 control-label">Allegato:</label>
                              <div class="col-md-8">
                              	<a href="uploads/mezzi/<?=$id_mezzo?>/libretto/<?=$row['allegato']?>" target="_blank" class="btn btn-info">
									<?=$row['allegato']?>
                                </a>
                                <div class="btn btn-danger" data-toggle="modal" data-target=".bs-elimina" id_mezzo="<?=$id_mezzo?>" nome="<?=$row['allegato']?>" id_tagliando="<?=$row['id']?>" id="btn_elimina_spesa">Elimina Allegato</div>
                              </div>
                                <? } ?>
                            </div>
                          </div>

                                                          
                         
                        </div><!-- /.row this actually does not appear to be needed with the form-horizontal -->
                        <input type="hidden" id="id_tagliando_modifica" value="<?=$id?>"/>
                      </form>
                      
                      