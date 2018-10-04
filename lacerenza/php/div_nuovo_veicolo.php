<?php
    include("controllaSessione.php");
	include("../databases/db_function.php");
	require_once("../lib/verificaConvertiData.php");
	require_once("../classi/class.Veicoli.php");
	include("../liste/listaDipendenti.js.php");

	$id = isset($_GET['id']) ? $_GET['id'] : "";
	$id_commessa = isset($_GET['id_commessa']) ? $_GET['id_commessa'] : "";
	
	if($id != ""){
		$veicolo = new Veicoli();
		$e_query_veicolo = $veicolo->caricaVeicoloById($id);
		$row = $e_query_veicolo->fetch_array();
        $veicolo_dati = $row['id_mezzo']."-".$row['mezzo']."-".$row['targa'];
	}
    
    $query = "SELECT * FROM tb_mezzi WHERE venduto != 'VENDUTO';";
    $e_query_lista = EseguiQuery($query,"selezione");
    
?>
<!--SCRIPT SITO-->
<link href="css/demo.css" rel="stylesheet">
    <script src="js/jquery-ui.js" ></script>

<script>
    $(function () {

        var availableTags = [
            <?while($row_lista = $e_query_lista->fetch_array()){?>
          "<?=$row_lista['id']?>-<?=$row_lista['mezzo']?>-<?=$row_lista['targa']?>",
          <? } ?>
          
        ];


        $("#veicolo_dati").autocomplete({
            source: availableTags,
            appendTo: $("form:first")
        });

        $("#veicolo_dati").data("ui-autocomplete")._renderMenu = function (ul, items) {
            var that = this;
            ul.attr("class", "nav nav-pills nav-stacked");
            $.each(items, function (index, item) {
                that._renderItemData(ul, item);
            });
        };

    });
</script>
<script src="js/sito/div_nuovo_veicolo.js" type="text/javascript"></script>

<form class="form-horizontal" id="formNewVeicolo" name="formNewVeicolo" enctype="multipart/form-data" action='lib/operazioni_veicolo.lib.php' method='POST'>

                        <div class="row">
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Mezzo*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Mezzo"  id="veicolo_dati" name="veicolo_dati"  value="<?=$veicolo_dati?>"/>
                                <input type="hidden" id="mezzo" name="mezzo"  value="<?=$row['mezzo']?>"/>
                                <input type="hidden" id="targa" name="targa"  value="<?=$row['targa']?>"/>
                                <input type="hidden" id="id_mezzo" name="id_mezzo"  value="<?=$row['id_mezzo']?>"/>
                                <input type="hidden" id="id_da_modificare" name="id_da_modificare"  value="<?=$id?>"/>
                                <input type="hidden" id="tipo" name="tipo"  value="inserimento"/>
                                <input type="hidden" id="id_commessa" name="id_commessa"  value="<?=$id_commessa?>"/>

                              </div>
                            </div>
                          </div>
                          
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              	<label class="col-md-4 control-label">Costo h*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Costo per ora" id="costo_h" name="costo_h" value="<?=$row['costo_h']?>" />
                              </div>
                            </div>
                          </div>
                          
                                                          
                          
                        </div><!-- /.row this actually does not appear to be needed with the form-horizontal -->
                        <input type="hidden" id="id_veicolo_modifica" value="<?=$id?>"/>
                      </form>
                      
                      