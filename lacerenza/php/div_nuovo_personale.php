<?php
    include("controllaSessione.php");
	include("../databases/db_function.php");
	require_once("../lib/verificaConvertiData.php");
	require_once("../classi/class.Personale.php");
	include("../liste/listaDipendenti.js.php");

	$id = isset($_GET['id']) ? $_GET['id'] : "";
	$id_commessa = isset($_GET['id_commessa']) ? $_GET['id_commessa'] : "";
	
	if($id != ""){
		$personale = new Personale();
		$e_query_personale = $personale->caricaPersonaleById($id);
		$row = $e_query_personale->fetch_array();
        $personale_dati = $row['id_dipendente']."-".$row['nome']."-".$row['cognome'];
	}
    
    $query = "SELECT * FROM tb_dipendenti;";
    $e_query_lista = EseguiQuery($query,"selezione");
    
?>
<!--SCRIPT SITO-->
<link href="css/demo.css" rel="stylesheet">
    <script src="js/jquery-ui.js" ></script>

<script>
    $(function () {

        var availableTags = [
            <?while($row_lista = $e_query_lista->fetch_array()){?>
          "<?=$row_lista['id']?>-<?=$row_lista['nome']?>-<?=$row_lista['cognome']?>",
          <? } ?>
          
        ];


        $("#personale_dati").autocomplete({
            source: availableTags,
            appendTo: $("form:first")
        });

        $("#personale_dati").data("ui-autocomplete")._renderMenu = function (ul, items) {
            var that = this;
            ul.attr("class", "nav nav-pills nav-stacked");
            $.each(items, function (index, item) {
                that._renderItemData(ul, item);
            });
        };

    });
</script>
<script src="js/sito/div_nuovo_personale.js" type="text/javascript"></script>

<form class="form-horizontal" id="formNewPersonale" name="formNewPersonale" enctype="multipart/form-data" action='lib/operazioni_personale.lib.php' method='POST'>

                        <div class="row">
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Personale*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Personale"  id="personale_dati" name="personale_dati"  value="<?=$personale_dati?>"/>
                                <input type="hidden" id="nome" name="nome"  value="<?=$row['nome']?>"/>
                                <input type="hidden" id="cognome" name="cognome"  value="<?=$row['cognome']?>"/>
                                <input type="hidden" id="id_dipendente" name="id_dipendente"  value="<?=$row['id_dipendente']?>"/>
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
                        <input type="hidden" id="id_personale_modifica" value="<?=$id?>"/>
                      </form>
                      
                      