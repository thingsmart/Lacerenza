<?php
    include("controllaSessione.php");
	include("../databases/db_function.php");
	require_once("../lib/verificaConvertiData.php");
	require_once("../classi/class.ProgrammazioneCantiere.php");
	
	$id = isset($_GET['id']) ? $_GET['id'] : "";
		$data = isset($_GET['data']) ? $_GET['data'] : date("Y-m-d");
		$data = ($data != "") ? capovolgiData($data) : date("d-m-Y");
		
	if($id != ""){
		$cantiere = new ProgrammazioneCantiere();
		$e_query = $cantiere->caricaById($id);
		$row = $e_query->fetch_array();
		$data = $row['data'];
		$note = $row['note'];
        $tipologia = $row['tipologia_lavoro'];
		$data = capovolgiData($data);
		$dettagli_commessa = $row['id_commessa']."-".$row['cod_commessa']."-".$row['descrizione_commessa'];
		// $dettagli_lavoro = $row['id_lavoro']."-".$row['cod_lavoro']."-".$row['descrizione_lavoro'];
        if($row['id_mezzo'] != -1) {
            $dettagli_mezzo = $row['id_mezzo'] . "-" . $row['mezzo'];
        } else {
            $dettagli_mezzo = "";
        }
		
		$dati_addetti_esplosi = explode(",", $row['addetti']);
		$dati_id_esplosi = explode(",", $row['id_dipendenti']);
		for($i = 0; $i<count($dati_addetti_esplosi); $i++){
			if($i == count($dati_addetti_esplosi)-1){
				$addetti .= $dati_id_esplosi[$i]."-".$dati_addetti_esplosi[$i];
			} else {
				$addetti .= $dati_id_esplosi[$i]."-".$dati_addetti_esplosi[$i].",";
			}
		}
		
	}
$query = "SELECT * FROM tb_commesse;";
    $e_query_lista = EseguiQuery($query,"selezione");
	
	$query_mezzi = "SELECT * FROM tb_mezzi WHERE venduto != 'VENDUTO';";
    $e_query_lista_mezzi = EseguiQuery($query_mezzi,"selezione");
	
	
	
	$query = "SELECT * FROM tb_dipendenti;";
$e_query_lista_dipendenti = EseguiQuery($query,"selezione");
?>

<!--SCRIPT SITO-->
<link href="css/demo.css" rel="stylesheet">
<script src="js/jquery-ui.min.js" ></script>
<script src="js/bootstrap/bootstrap-datepicker.min.js"></script>
    <script src="js/bootstrap/locales/bootstrap-datepicker.it.js"></script>

    <script src="js/bootstrap.min.js"></script>
<link href="css/datepicker.css" rel="stylesheet">

<script src="js/sito/div_nuova_programmazione_mezzo.js" type="text/javascript"></script>

    <script>
    $(function () {

        var availableTags = [
            <?while($row_lista = $e_query_lista->fetch_array()){?>
          "<?=$row_lista['id']?>-<?=$row_lista['codice']?>-<?=$row_lista['descrizione']?>",
          <? } ?>
          
        ];


        $("#dettagli_commessa").autocomplete({
            source: availableTags,
            appendTo: $("form:first")
        });

        $("#dettagli_commessa").data("ui-autocomplete")._renderMenu = function (ul, items) {
            var that = this;
            ul.attr("class", "nav nav-pills nav-stacked");
            $.each(items, function (index, item) {
                that._renderItemData(ul, item);
            });
        };

    });
    
    $(function () {

        var availableTagsMezzi= [
            <?while($row_lista_mezzi = $e_query_lista_mezzi->fetch_array()){?>
          "<?=$row_lista_mezzi['id']?>-<?=$row_lista_mezzi['mezzo']?>",
          <? } ?>
          
        ];


        $("#mezzo").autocomplete({
            source: availableTagsMezzi,
            appendTo: $("form:first")
        });

        $("#mezzo").data("ui-autocomplete")._renderMenu = function (ul, items) {
            var that = this;
            ul.attr("class", "nav nav-pills nav-stacked");
            $.each(items, function (index, item) {
                that._renderItemData(ul, item);
            });
        };
        
      

    });
   
</script>



	<!-- <script type="text/javascript">
		
		$(function() {

			
			$('#addetti').tagsInput({
				width: 'auto',

				autocomplete_url:'liste/fake_json_endpoint.php' // jquery ui autocomplete requires a json endpoint
			});

		});
	
	</script> -->
	
	<!--FINALE-->
	<script>
var cities = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('text'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  prefetch: 'liste/dipendenti.json.php'
});
cities.initialize();

var elt = $('#addetti');
elt.tagsinput({
  itemValue: 'value',
  itemText: 'text',
  typeaheadjs: {
    name: 'cities',
    displayKey: 'text',
    source: cities.ttAdapter()
  }
});
<?
for($i = 0; $i<count($dati_addetti_esplosi); $i++){
?>
	elt.tagsinput('add', {"value": "<?=$dati_id_esplosi[$i]?>-<?=$dati_addetti_esplosi[$i]?>" , "text": "<?=str_replace("&#39;","'", $dati_addetti_esplosi[$i] )?>"   , "continent": "<?=str_replace("&#39;","'", $dati_addetti_esplosi[$i] )?>"    });
	
<?
			
		}
?>

</script>
<!--FINALE-->
<form class="form-horizontal" id="formNewProgrammazione"  name="formNewProgrammazione" method="post" role="form">
    <div class="row">
        <div class="col-lg-12">
                        	<div class="col-lg-6">
                                <div class="col-lg-12 ">
                                <div class="form-group">
                              <label>Data:</label>
                              <div>
                                <input type="text" class="form-control data_picker" id="data" name="data" value="<?=$data?>" />
                              </div>
                                </div>
                                </div>
                          </div>

                          <div class=" col-lg-6">
                              <div class="col-lg-12 ">
                            <div class="form-group">
                              <label>Commessa*:</label>
                              <div>
                                <input type="text" class="form-control" placeholder="Commessa"  id="dettagli_commessa" name="dettagli_commessa"  value="<?=$dettagli_commessa?>"/>
                                <input type="hidden" id="id_da_modificare" name="id_da_modificare"  value="<?=$id?>"/>
                              </div>
                            </div>
                              </div>
                          </div>
                          <!-- <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Lavoro*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Lavoro" id="dettagli_lavoro" name="dettagli_lavoro" value="<?=$dettagli_lavoro?>" />
                              </div>
                            </div>
                          </div> -->
                          
                            <div class=" col-lg-6">
                                <div class="col-lg-12 ">
                            <div class="form-group">
                              	<label>Mezzo:</label>
                              <div>
                                <input type="text" class="form-control" placeholder="Mezzo" id="mezzo" name="mezzo" value="<?=$dettagli_mezzo?>" />
                              </div>
                            </div>
                                </div>
                          </div>

            <div class=" col-lg-6">
                <div class="col-lg-12 ">
                    <div class="form-group">
                        <label>Tipologia:</label>
                        <div>
                            <select class="form-control" id="tipologia_lavoro" name="tipologia_lavoro">
                                <option <? if($tipologia == "cap" || $tipologia == "CAP"){ echo "selected";}?> value="cap">cap</option>
                                <option <? if($tipologia == "fv" || $tipologia == "FV"){ echo "selected";}?> value="fv">fv</option>
                                <option <? if($tipologia == "cg" || $tipologia == "CG"){ echo "selected";}?> value="cg">cg</option>
                                <option <? if($tipologia == "imp" || $tipologia == "IMP"){ echo "selected";}?> value="imp">imp</option>
                                <option <? if($tipologia == "om" || $tipologia == "OM"){ echo "selected";}?> value="om">om</option>
                                <option <? if($tipologia == "pitt" || $tipologia == "PITT"){ echo "selected";}?> value="pitt">pitt</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

                          <div class="col-lg-6">
                              <div class="col-lg-12 ">
                            <div class="form-group">
                              	<label>Addetti*:</label>
                              <div>
                                <textarea rows="10" class="form-control" placeholder="Addetti" id="addetti" name="addetti" ><?=$addetti?></textarea>
                              </div>
                            </div>
                              </div>
                          </div>
                            <div class="col-lg-6">
                                <div class="col-lg-12 ">
                            <div class="form-group">
                              	<label>Note:</label>
                              <div>
                                <textarea rows="8" class="form-control" placeholder="Note" id="note" name="note"><?=$note?></textarea>
                              </div>
                            </div>
                            </div>
        </div>


    </div><!-- /.row this actually does not appear to be needed with the form-horizontal -->
                      </form>