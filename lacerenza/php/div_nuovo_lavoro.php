<?php
    include("controllaSessione.php");
	include("../databases/db_function.php");
	require_once("../lib/verificaConvertiData.php");
	require_once("../classi/class.Lavori.php");
	
	$id = isset($_GET['id']) ? $_GET['id'] : "";
	
	if($id != ""){
		$lavori = new Lavori();
		$e_query = $lavori->caricaById($id);
		$row = $e_query->fetch_array();
			
	} 
$query_lavori = "SELECT * FROM tb_lavoro;";
    $e_query_lista_lavori = EseguiQuery($query_lavori,"selezione");	
?>
<!--SCRIPT SITO-->
<script src="js/sito/div_nuovo_lavoro.js" type="text/javascript"></script>
<link href="css/demo.css" rel="stylesheet">

<script src="js/jquery-ui.js" ></script>

<script>
	
	$(function () {

        var availableTagsLavori= [
            <?while($row_lista_lavori = $e_query_lista_lavori->fetch_array()){?>
          "<?=$row_lista_lavori['lavorazione']?>",
          <? } ?>
          
        ];


        $("#lavorazione").autocomplete({
            source: availableTagsLavori,
            appendTo: $("form:first")
        });

        $("#lavorazione").data("ui-autocomplete")._renderMenu = function (ul, items) {
            var that = this;
            ul.attr("class", "nav nav-pills nav-stacked");
            $.each(items, function (index, item) {
                that._renderItemData(ul, item);
            });
        };

    });
</script>
<form class="form-horizontal" id="formNewLavori" name="formNewLavori" enctype="multipart/form-data" action='lib/operazioni_lavori.lib.php' method='POST'>

                        <div class="row">
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Lavorazione:</label>
                              <div class="col-md-8">
                              <input type="text" class="form-control" placeholder="Lavorazione"  id="lavorazione" name="lavorazione"  value="<?=$row['lavorazione']?>"/>
                                <!-- <select class="form-control" id="lavorazione" name="lavorazione">
                                	<option <? if($row['lavorazione'] == 'IMPERMEABILIZZAZIONI_scheda_n._01') {echo "selected";} ?> value="IMPERMEABILIZZAZIONI_scheda_n._01">
                                		IMPERMEABILIZZAZIONI scheda n. 01
                                	</option>
                                	<option <? if($row['lavorazione'] == 'PAVIMENTAZIONI_TERRAZZI_scheda_n._02') {echo "selected";} ?> value="PAVIMENTAZIONI_TERRAZZI_scheda_n._02">
                                		PAVIMENTAZIONI TERRAZZI scheda n. 02
                                	</option>
                                	<option <? if($row['lavorazione'] == 'TETTI_VENTILATI_scheda_n._03') {echo "selected";} ?> value="TETTI_VENTILATI_scheda_n._03">
                                		TETTI VENTILATI scheda n. 03
                                	</option>
                                	<option <? if($row['lavorazione'] == 'CONTROSOFFITTATURA_scheda_n._04') {echo "selected";} ?> value="CONTROSOFFITTATURA_scheda_n._04">
                                		TETTI VENTILATI scheda n. 05
                                	</option>
                                	<option <? if($row['lavorazione'] == 'CONTROPARETI_scheda_n._05') {echo "selected";} ?> value="CONTROPARETI_scheda_n._05">
                                		CONTROPARETI scheda n. 05
                                	</option>
                                	<option <? if($row['lavorazione'] == 'FAMENTO_A_CAPPOTTO_scheda_n._06') {echo "selected";} ?> value="FAMENTO_A_CAPPOTTO_scheda_n._06">
                                		FAMENTO A CAPPOTTO scheda n. 06
                                	</option>
                                	<option <? if($row['lavorazione'] == 'FACCIATE_VENTILATE_scheda_n._07') {echo "selected";} ?> value="FACCIATE_VENTILATE_scheda_n._07">
                                		FACCIATE VENTILATE scheda n. 07
                                	</option>
                                	<option <? if($row['lavorazione'] == 'PITTURAZIONI_scheda_n._08') {echo "selected";} ?> value="PITTURAZIONI_scheda_n._08">
                                		PITTURAZIONI scheda n. 08
                                	</option>
                                	<option <? if($row['lavorazione'] == 'TRAMEZZI_scheda_n._09') {echo "selected";} ?> value="TRAMEZZI_scheda_n._09">
                                		TRAMEZZI scheda n. 09
                                	</option>
                                	<option <? if($row['lavorazione'] == 'IMPERMEABILIZZAZIONE_IN_PVC_TASSELLATA_scheda_n._10') {echo "selected";} ?> value="IMPERMEABILIZZAZIONE_IN_PVC_TASSELLATA_scheda_n._10">
                                		IMPERMEABILIZZAZIONE IN PVC TASSELLATA scheda n. 10
                                	</option>
                                	<option <? if($row['lavorazione'] == 'IMPERMEABILIZZAZIONE_IN_PVC_SALDATA_scheda_n._11') {echo "selected";} ?> value="IMPERMEABILIZZAZIONE_IN_PVC_SALDATA_scheda_n._11">
                                		IMPERMEABILIZZAZIONE IN PVC SALDATA scheda n. 11
                                	</option>
                                	<option <? if($row['lavorazione'] == 'IMPERMEABILIZZAZIONE_IN_PVC_SALDATA_scheda_n._11') {echo "selected";} ?> value="IMPERMEABILIZZAZIONE_IN_PVC_SALDATA_scheda_n._11">
                                		IMPERMEABILIZZAZIONE IN PVC SALDATA scheda n. 11
                                	</option>
                                </select> -->
                                <input type="hidden" id="id_da_modificare" name="id_da_modificare"  value="<?=$id?>"/>
                                <input type="hidden" id="tipo" name="tipo"  value="inserimento"/>

                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Codice attivit&agrave;:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control"  placeholder="Codice attivit&agrave;" id="cod_lavoro" name="cod_lavoro" value="<?=$row['cod_lavoro']?>">
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Attivit&agrave;:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control"  placeholder="Attivit&agrave;" id="attivita" name="attivita" value="<?=$row['attivita']?>">
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Modalit&agrave; operative:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Modalit&agrave; operative" value="<?=$row['descrizione']?>" id="descrizione" name="descrizione">
                              </div>
                            </div>
                          </div>
                          
                          
                                                          
                          
                        </div><!-- /.row this actually does not appear to be needed with the form-horizontal -->
                        <input type="hidden" id="id_modifica" value="<?=$id?>"/>
                      </form>
                      
                      