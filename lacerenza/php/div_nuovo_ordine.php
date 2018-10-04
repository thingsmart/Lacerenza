<?php
    include("controllaSessione.php");
	include("../databases/db_function.php");
	require_once("../lib/verificaConvertiData.php");
	require_once("../classi/class.Ordini.php");
	
	$id = isset($_GET['id']) ? $_GET['id'] : "";
	$id_commessa = isset($_GET['id_commessa']) ? $_GET['id_commessa'] : "";
	
	if($id != ""){
		$ordine = new Ordini();
		$e_query_ordine = $ordine->caricaOrdineById($id);
		$row = $e_query_ordine->fetch_array();
	}

?>
<!--SCRIPT SITO-->
<script src="js/sito/div_nuovo_ordine.js" type="text/javascript"></script>

<form class="form-horizontal" id="formNewOrdine" name="formNewOrdine" enctype="multipart/form-data" action='lib/operazioni_ordine.lib.php' method='POST'>

                        <div class="row">
                          <div class="col-sm-12 col-lg-12">
                            <div class="form-group">
                              <label class="col-md-1 control-label">Descrizione*:</label>
                              <div class="col-md-11">
                                <input type="text" class="form-control" placeholder="Descrizione"  id="descrizione" name="descrizione"  value="<?=$row['descrizione']?>"/>
                                <input type="hidden" id="id_da_modificare" name="id_da_modificare"  value="<?=$id?>"/>
                                <input type="hidden" id="tipo" name="tipo"  value="inserimento"/>
                                <input type="hidden" id="id_commessa" name="id_commessa"  value="<?=$id_commessa?>"/>

                              </div>
                            </div>
                          </div>                  
                          
                                                          
                          <div class="col-sm-12 col-lg-12">
                            <div class="form-group">
							  <? if($row['nome_allegato'] == "") { ?>
                              <label class="col-md-4 control-label"></label>
                              <div class="col-md-8">
                                    <input  type="file" id="files" name="files"/>
                                    <input  type="hidden" name="tipo_cartella" id="tipo_cartella" value="ordini"/>
                                    <input  type="hidden" name="cartella" id="cartella" value="commesse"/>
                               </div>
                                <? } else { ?>
                              <label class="col-md-1 control-label">Allegato:</label>
                              <div class="col-md-11">
                              	<a href="<?=$row['link_allegato']?><?=$row['nome_allegato']?>" target="_blank" class="btn">
									<i class="fa fa-external-link"></i> <?=$row['nome_allegato']?>
                                </a>
                                <div class="btn" data-toggle="modal" data-target=".bs-elimina"  id_commessa="<?=$id_commessa?>" nome="<?=$row['nome_allegato']?>" id_ordine="<?=$row['id']?>" id="btn_elimina_ordine"><i class="fa fa-trash-o fa-lg"></i></div>
                              </div>
                                <? } ?>
                            </div>
                          </div>
                          
                        </div><!-- /.row this actually does not appear to be needed with the form-horizontal -->
                        <input type="hidden" id="id_ordine_modifica" value="<?=$id?>"/>
                      </form>
                      
                      