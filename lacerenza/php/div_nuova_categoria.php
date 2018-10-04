<?php
    include("controllaSessione.php");
	include("../databases/db_function.php");
	require_once("../lib/verificaConvertiData.php");
	require_once("../classi/class.Categorie.php");
	
	$id = isset($_GET['id']) ? $_GET['id'] : "";
	$id_commessa = isset($_GET['id_commessa']) ? $_GET['id_commessa'] : "";
	$id_verbale= isset($_GET['id_verbale']) ? $_GET['id_verbale'] : "";

	if($id != ""){
		$categoria = new Categorie();
		$e_query_categoria = $categoria->caricaCategoriaById($id);
		$row = $e_query_categoria->fetch_array();
	}

?>
<!--SCRIPT SITO-->
<script src="js/sito/div_nuova_categoria.js" type="text/javascript"></script>

<form class="form-horizontal" id="formNewCategoria" name="formNewCategoria" enctype="multipart/form-data" action='lib/operazioni_categoria.lib.php' method='POST'>

                        <div class="row">
                        
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Descrizione*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" value="<?=$row['descrizione']?>" id="descrizione" name="descrizione">
                                  <input type="hidden" id="id_da_modificare" name="id_da_modificare"  value="<?=$id?>"/>
                                <input type="hidden" id="tipo" name="tipo"  value="inserimento"/>
                                <input type="hidden" id="id_commessa" name="id_commessa"  value="<?=$id_commessa?>"/>
                                <input type="hidden" id="id_verbale" name="id_verbale"  value="<?=$id_verbale?>"/>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              	<label class="col-md-4 control-label">Importo*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Importo" id="importo" name="importo" value="<?=$row['importo']?>" />
                              </div>
                            </div>
                          </div>
                        
                        </div><!-- /.row this actually does not appear to be needed with the form-horizontal -->
                        <input type="hidden" id="id_categoria_modifica" value="<?=$id?>"/>
                      </form>
                      
                      