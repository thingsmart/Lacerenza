<?php
    include("controllaSessione.php");
	include("../databases/db_function.php");
	require_once("../lib/verificaConvertiData.php");
	require_once("../classi/class.Ruolino.php");
	require_once("../classi/class.Veicoli.php");
	require_once("../classi/class.Terzi.php");
	
	$id = isset($_GET['id']) ? $_GET['id'] : "";
		$clona = isset($_GET['clona']) ? $_GET['clona'] : "";
		$data = isset($_GET['data']) ? $_GET['data'] : date("Y-m-d");
		$data = ($data != "") ? capovolgiData($data) : date("d-m-Y");
		$clima = isset($_GET['clima']) ? $_GET['clima'] : "";
		$clima = str_replace("_", " ", $clima);
	if($id != ""){
		$ruolino = new Ruolino();
		$e_query = $ruolino->caricaById($id);
		$row = $e_query->fetch_array();
		$data = $row['data'];
		$ore = $row['ore'];
		$autista = $row['autista'];
		$quantita = $row['quantita'];
		$note = $row['note'];
		$km = $row['km'];
		$terzi = $row['terzi'];
		$ore_terzi = $row['ore_terzi'];
		$tipologia = $row['tipologia'];
        $clima = $row['clima'];
		$data = capovolgiData($data);
		$dettagli_commessa = $row['id_commessa']."-".$row['cod_commessa']."-".$row['descrizione_commessa'];
		// $dettagli_lavoro = $row['id_lavoro']."-".$row['cod_lavoro']."-".$row['descrizione_lavoro'];
		$dettagli_lavoro = $row['descrizione_lavoro'];
		$dettagli_mezzo = $row['id_mezzo']."-".$row['mezzo'];
		
		$dati_addetti_esplosi = explode(",", $row['addetti']);
		$dati_id_esplosi = explode(",", $row['id_dipendenti']);
		for($i = 0; $i<count($dati_addetti_esplosi); $i++){
			if($i == count($dati_addetti_esplosi)-1){
				$addetti .= $dati_id_esplosi[$i]."-".$dati_addetti_esplosi[$i];
			} else {
				$addetti .= $dati_id_esplosi[$i]."-".$dati_addetti_esplosi[$i].",";
			}
		}
		
		$veicoli = new Veicoli();
		$data_veicoli = capovolgiData($data);
		$id_commessa = $row['id_commessa'];
		$e_query_veicoli = $veicoli->caricaVeicoli($id_commessa, $data_veicoli);
		$numero_veicoli = $veicoli->numeroVeicoli();
		
		$terzi_ruolino = new Terzi();
		$e_query_terzi = $terzi_ruolino->carica($id_commessa, $data_veicoli);
		$numero_terzi = $terzi_ruolino->numero();
	}

	if($clona != ""){
		$dettagli_commessa = isset($_GET['dettagli_commessa']) ? $_GET['dettagli_commessa'] : "";
		$dettagli_commessa = str_replace("_", " ", $dettagli_commessa);
		$dati_esplosi_commessa = explode("-", $dettagli_commessa);
		$id_commessa = $dati_esplosi_commessa['0'];
		$autista = isset($_GET['autista']) ? $_GET['autista'] : "";
		$autista = str_replace("_", " ", $autista);
        $autista = str_replace("[accento]", "'", $autista);
		$tipologia = isset($_GET['tipologia']) ? $_GET['tipologia'] : "";
		$tipologia = str_replace("_", " ", $tipologia);
		
		$dettagli_lavoro = isset($_GET['dettagli_lavoro']) ? $_GET['dettagli_lavoro'] : "";
		$dettagli_lavoro = str_replace("_", " ", $dettagli_lavoro);
		
		$quantita = isset($_GET['quantita']) ? $_GET['quantita'] : "";
		$quantita = str_replace("_", " ", $quantita);
		
		$terzi = isset($_GET['terzi']) ? $_GET['terzi'] : "";
		$terzi = str_replace("_", " ", $terzi);
		
		$ore_terzi = isset($_GET['ore_terzi']) ? $_GET['ore_terzi'] : "";
		$ore_terzi = str_replace("_", " ", $ore_terzi);
		
		$note = isset($_GET['note']) ? $_GET['note'] : "";
		$note = str_replace("_", " ", $note);
		
		$veicoli = new Veicoli();
		$data_veicoli = capovolgiData($data);
		$e_query_veicoli = $veicoli->caricaVeicoli($id_commessa, $data_veicoli);
		$numero_veicoli = $veicoli->numeroVeicoli();
		
		$terzi_ruolino = new Terzi();
		$e_query_terzi = $terzi_ruolino->carica($id_commessa, $data_veicoli);
		$numero_terzi = $terzi_ruolino->numero();
		
	}
$query = "SELECT * FROM tb_commesse;";
    $e_query_lista = EseguiQuery($query,"selezione");
	
	$query_mezzi = "SELECT * FROM tb_mezzi WHERE venduto != 'VENDUTO';";
    $e_query_lista_mezzi = EseguiQuery($query_mezzi,"selezione");
	
	$query_lavori = "SELECT * FROM tb_lavoro;";
    $e_query_lista_lavori = EseguiQuery($query_lavori,"selezione");	
	
	$query_tipologia = "SELECT * FROM tb_ruolino GROUP BY tipologia;";
    $e_query_lista_tipologia = EseguiQuery($query_tipologia,"selezione");	

?>

<!--SCRIPT SITO-->
<link href="css/demo.css" rel="stylesheet">
<script src="js/jquery-ui.min.js" ></script>
<script src="js/bootstrap/bootstrap-datepicker.min.js"></script>
<script src="js/bootstrap/locales/bootstrap-datepicker.it.js"></script>

<link href="css/datepicker.css" rel="stylesheet">
<script src="js/sito/div_nuovo_ruolino_giornaliero.js" type="text/javascript"></script>

    <script>
    $(function () {

        var availableTags = [
            <?while($row_lista = $e_query_lista->fetch_array()){?>
          "<?=$row_lista['id']?>-<?=$row_lista['codice']?>-<?=$row_lista['descrizione']?>-<?=$row_lista['localita']?>",
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
   
   $(function () {

        var availableTagsLavori= [
            <?while($row_lista_lavori = $e_query_lista_lavori->fetch_array()){?>
          "<?=$row_lista_lavori['id']?>-<?=$row_lista_lavori['cod_lavoro']?>-<?=$row_lista_lavori['attivita']." (".$row_lista_lavori['lavorazione'].")"?>",
          <? } ?>
          
        ];


        $("#dettagli_lavoro").autocomplete({
            source: availableTagsLavori,
            appendTo: $("form:first")
        });

        $("#dettagli_lavoro").data("ui-autocomplete")._renderMenu = function (ul, items) {
            var that = this;
            ul.attr("class", "nav nav-pills nav-stacked");
            $.each(items, function (index, item) {
                that._renderItemData(ul, item);
            });
        };

    });
    
    $(function () {

        var availableTagsTipologia= [
            <?while($row_lista_tipologia = $e_query_lista_tipologia->fetch_array()){?>
          "<?=$row_lista_tipologia['tipologia']?>",
          <? } ?>
          
        ];


        $("#tipologia").autocomplete({
            source: availableTagsTipologia,
            appendTo: $("form:first")
        });

        $("#tipologia").data("ui-autocomplete")._renderMenu = function (ul, items) {
            var that = this;
            ul.attr("class", "nav nav-pills nav-stacked");
            $.each(items, function (index, item) {
                that._renderItemData(ul, item);
            });
        };

    });
    
    
    
    $(function () {

        var availableTagsClima= ['SERENO', 'NUVOLOSO', 'PIOGGIA', 'VENTO', 'NEVE'];


        $("#clima").autocomplete({
            source: availableTagsClima,
            appendTo: $("form:first")
        });

        $("#clima").data("ui-autocomplete")._renderMenu = function (ul, items) {
            var that = this;
            ul.attr("class", "nav nav-pills nav-stacked");
            $.each(items, function (index, item) {
                that._renderItemData(ul, item);
            });
        };

    });
</script>

<!--Lista dipendenti e autisti con il tag autocomplete-->
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
	elt.tagsinput('add', { "value": "<?=$dati_id_esplosi[$i]?>-<?=$dati_addetti_esplosi[$i]?>" , "text": "<?=$dati_addetti_esplosi[$i]?>"   , "continent": "<?=$dati_addetti_esplosi[$i]?>"    });
	
<?
			
		}
?>

var autista = $('#autista');
autista.tagsinput({
  itemValue: 'value',
  itemText: 'text',
  typeaheadjs: {
    name: 'cities',
    displayKey: 'text',
    source: cities.ttAdapter()
  }
});
<? if($autista != ""){?>
	autista.tagsinput('add', { "value": "<?=$autista?>" , "text": "<?=$autista?>"   , "continent": "<?=$autista?>"    });
<? } ?>

</script>
<!--//END:Lista dipendenti e autisti con il tag autocomplete-->
	
	<!--Visualizzo veicoli se presenti-->
	<? if($numero_veicoli > 0){ ?>
		<script>
			$(document).ready(function() {
				$("#tabella_mezzi_ruolino").load("php/tabella_mezzi_ruolino.php?id_commessa=<?=$id_commessa?>&data=<?=$data?>");	
			});
		</script>
	<? } ?>
	
	<? if($numero_terzi > 0){ ?>
		<script>
			$(document).ready(function() {
				$("#tabella_terzi_ruolino").load("php/tabella_terzi_ruolino.php?id_commessa=<?=$id_commessa?>&data=<?=$data?>");	
			});
		</script>
	<? } ?>

<form class="form-horizontal" id="formNewRuolino"  name="formNewRuolino" method="post" role="form">
						<!--GENERALI-->						
							
				        	<div class="">
								<div class="page-title">
									<h4>Dati Generali</h4>									
								</div>
							<hr/>		
							</div>
						            
                         
                        <div class="row">
                        	<div class="col-sm-6 col-lg-6" style="margin-top:20px;">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Data:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control data_picker" id="data" name="data" value="<?=$data?>" />
                              </div>
                            </div>
                          </div>
                           <div class="col-sm-6 col-lg-6" style="margin-top:20px;">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Condizioni climatiche*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Condizioni climatiche"  id="clima" name="clima"  value="<?=$clima?>"/>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Commessa*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Commessa"  id="dettagli_commessa" name="dettagli_commessa"  value="<?=$dettagli_commessa?>"/>
                                <input type="hidden" id="id_da_modificare" name="id_da_modificare"  value="<?=$id?>"/>
                              </div>
                            </div>
                          </div>
                         <!--GENERALI-->
                         <!--PERSONALE-->
                          <div class="col-lg-12">
								<div class="page-title">
									<h4>Personale</h4>									
								</div>
								  <hr/>
							</div>
								
                          <div class="col-sm-6 col-lg-6" style="margin-top:20px;">
                            <div class="form-group">
                              	<label class="col-md-4 control-label">Personale*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Addetti" id="addetti" name="addetti" value="<?=$addetti?>" />
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6" style="margin-top:20px;">
                            <div class="form-group">
                              	<label class="col-md-4 control-label">Ore*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Ore" id="ore" name="ore" value="<?=$ore?>" />
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              	<label class="col-md-4 control-label">Autista*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Autista" id="autista" name="autista" value="<?=$autista?>" />
                              </div>
                            </div>
                          </div>
                          <!--PERSONALE-->
                          
                          <!--LAVORO-->
                          <div class="col-sm-12 col-lg-12">
                          	<div class="page-title">
									<h4>Lavoro</h4>									
								</div>
                          	<hr>
                          </div>
                          <div class="col-sm-6 col-lg-6" style="margin-top:20px;">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Tipologia lavoro*:</label>
                              <div class="col-md-8">
                                <!-- <input type="text" class="form-control" placeholder="Tipologia lavoro" id="tipologia" name="tipologia" value="<?=$tipologia?>" /> -->
                              	<select class="form-control" id="tipologia" name="tipologia">
                              		<option <? if($tipologia == "cap" || $tipologia == "CAP"){ echo "selected";}?> value="cap">cap</option>
                              		<option <? if($tipologia == "fv" || $tipologia == "FV"){ echo "selected";}?> value="fv">fv</option>
                              		<option <? if($tipologia == "cg" || $tipologia == "CG"){ echo "selected";}?> value="cg">cg</option>
                              		<option <? if($tipologia == "imp" || $tipologia == "IMP"){ echo "selected";}?> value="imp">imp</option>
                              		<option <? if($tipologia == "om" || $tipologia == "OM"){ echo "selected";}?> value="om">om</option>
                              	</select>
                              </div>
                            </div>
                          </div>
                           <div class="col-sm-6 col-lg-6" style="margin-top:20px;" >
                            <div class="form-group">
                              <label class="col-md-4 control-label">Descrizione lavoro*:</label>
                              <div class="col-md-8">
                                <textarea rows="6" class="form-control" placeholder="Lavoro" id="dettagli_lavoro" name="dettagli_lavoro"><?=$dettagli_lavoro?></textarea>
                              </div>
                            </div>
                          </div>
                           <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              	<label class="col-md-4 control-label">Quantit&agrave;:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Quantita" id="quantita" name="quantita" value="<?=$quantita?>" />
                              </div>
                            </div>
                          </div>                    
                      
                        
                           <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              	<label class="col-md-4 control-label">Note:</label>
                              <div class="col-md-8">
                                <textarea class="form-control" placeholder="Note" id="note" name="note"><?=$note?></textarea>
                              </div>
                            </div>
                          </div>                           
                          
                            <!--LAVORAZIONE ECONOMIA-->
                          <div class="col-sm-12 col-lg-12">
                          		<div class="page-title">
									<h4>Lavorazione economia:</h4>									
								</div>
                          	<hr>
                          </div>
                          
                           <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              	<label class="col-md-4 control-label">Lavorazione economia:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Lavorazione economia" id="terzi" name="terzi" value="<?=$terzi?>" />
                              </div>
                            </div>
                          </div>
                             <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              	<label class="col-md-4 control-label">Ore:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Ore" id="ore_terzi" name="ore_terzi" value="<?=$ore_terzi?>" />
                              </div>
                            </div>
                          </div>
                          <!--FINE ECONOMIA-->
                          
                          <!--MEZZI-->
                          <div class="col-sm-12 col-lg-12">
                          		<div class="page-title">
									<h4>Lavorazioni terzi</h4>									
								</div>
                          	<hr>
                          </div>
                          
                          <div class="col-sm-12 col-lg-12" style="margin-top:20px;">
                            <div class="form-group">
                              <div class="col-md-7">
                                <!-- <input type="text" class="form-control" placeholder="Lavorazione Terzi" id="descrizione_tb_terzi" name="descrizione_tb_terzi"  /> -->
                              	<textarea class="form-control" placeholder="Lavorazione Terzi" id="descrizione_tb_terzi" name="descrizione_tb_terzi"></textarea>
                              	<br>
                              </div>
                              
                              <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="Ore" id="ore_tb_terzi" name="ore_tb_terzi"  />
                                <br>
                              </div>
                              
                              <div class="col-md-2">
                                <div class="btn btn-info"  id="inserisci_terzi" style="width:100%"><i class="fa fa-plus"></i> Aggiungi</div>
                              </div>
                            </div>
                            
                            <!--tabella terzi-->
                          	<div id="tabella_terzi_ruolino">
                          		
                         	</div>
                          <!--FINE tabella terzi-->
                          
                          </div>
                          <!--FINE TERZI-->
                          
                          <!--MEZZI-->
                          <div class="col-sm-12 col-lg-12">
                          		<div class="page-title">
									<h4>Mezzi</h4>									
								</div>
                          	<hr>
                          </div>
                          
                          <div class="col-sm-12 col-lg-12" style="margin-top:20px; margin-bottom:100px">
                            <div class="form-group">
                              <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Mezzo" id="mezzo" name="mezzo"  />
                                <br>
                              </div>
                              
                              <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="Costo" id="costo" name="costo"  />
                                <br>
                              </div>
                              
                              <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="KM" id="km" name="km"  />
                                <br>
                              </div>
                              
                              <div class="col-md-2">
                                <div class="btn btn-info"  id="inserisci_mezzo" style="width:100%"><i class="fa fa-plus"></i> Aggiungi</div>
                              </div>
                            </div>
                            
                            <!--tabella mezzi-->
                          	<div id="tabella_mezzi_ruolino">
                          		
                         	</div>
                          <!--FINE tabella mezzi-->
                          
                          </div>
                          <!--FINE MEZZI-->
                          
                          
                          
                        </div><!-- /.row this actually does not appear to be needed with the form-horizontal -->
                      </form>
                      

<!--Modal elimina-->
<div class="modal <?=$fade?> bs-elimina" tabindex="-1" role="dialog" id="dialog_elimina" style="display:none" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Elimina</h4>
      </div>
      <div class="modal-body" id="modal_body" > Sei sicuro di voler eliminare questo dato? </div>
      <div class="modal-footer">
        <input id="id_da_eliminare" type="hidden" />
        <input id="nome_da_eliminare" type="hidden" />
        <button type="button" class="btn btn-default" id="btn_elimina_annulla" data-dismiss="modal">Annulla</button>
        <button type="submit" id="btn_elimina_conferma" class="btn btn-primary">Conferma</button>
      </div>
    </div>
  </div>
</div>
<!--FINE modal elimina-->


