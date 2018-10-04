<?php
    include("controllaSessione.php");
	include("../databases/db_function.php");
	require_once("../lib/verificaConvertiData.php");
	require_once("../classi/class.TestataMagazzino.php");
	
	$id = isset($_GET['id']) ? $_GET['id'] : "";
		$data = isset($_GET['data']) ? $_GET['data'] : date("Y-m-d");
		$data = ($data != "") ? capovolgiData($data) : date("d-m-Y");
		
	if($id != ""){
		$magazzino = new TestataMagazzino();
		$e_query = $magazzino->caricaById($id);
		$row = $e_query->fetch_array();
		$data = $row['data'];
		$data = capovolgiData($data);
		$dettagli_commessa = $row['id_commessa']."-".$row['descrizione_commessa'];
		$dettagli_mezzo = $row['id_mezzo']."-".$row['mezzo'];
		
		
		
	}

	
	$query_mezzi = "SELECT * FROM tb_mezzi WHERE venduto != 'VENDUTO';";
    $e_query_lista_mezzi = EseguiQuery($query_mezzi,"selezione");
	
	
	
	$query = "SELECT * FROM tb_commesse;";
$e_query_lista = EseguiQuery($query,"selezione");
?>
<!--SCRIPT SITO-->

<link href="css/demo.css" rel="stylesheet">
<script src="js/jquery-ui.min.js" ></script>
<script src="js/bootstrap/bootstrap-datepicker.min.js"></script>
    <script src="js/bootstrap/locales/bootstrap-datepicker.it.js"></script>

    <script src="js/bootstrap.min.js"></script>
<link href="css/datepicker.css" rel="stylesheet">
    <link href="less/datepicker.less" rel="stylesheet" type="text/css" />
<script src="js/sito/div_nuovo_magazzino.js" type="text/javascript"></script>

    <script>
    $(function () {

        var availableTags = [
            <?while($row_lista = $e_query_lista->fetch_array()){?>
          "<?=$row_lista['id']?>-<?=$row_lista['descrizione']?>-<?=$row_lista['codice']?>",
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


        $("#dettagli_mezzo").autocomplete({
            source: availableTagsMezzi,
            appendTo: $("form:first")
        });

        $("#dettagli_mezzo").data("ui-autocomplete")._renderMenu = function (ul, items) {
            var that = this;
            ul.attr("class", "nav nav-pills nav-stacked");
            $.each(items, function (index, item) {
                that._renderItemData(ul, item);
            });
        };
        
      

    });
   
</script>


	
<form class="form-horizontal" id="formNewMagazzino"  name="formNewMagazzino" method="post" role="form">
                        <div class="row">
                        	<div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Data:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control data_picker" id="data" name="data" value="<?=$data?>" />
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              	<label class="col-md-4 control-label">Automezzo*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Automezzo" id="dettagli_mezzo" name="dettagli_mezzo" value="<?=$dettagli_mezzo?>" />
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Cantiere*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Cantiere"  id="dettagli_commessa" name="dettagli_commessa"  value="<?=$dettagli_commessa?>"/>
                                <input type="hidden" id="id_da_modificare" name="id_da_modificare"  value="<?=$id?>"/>
                              </div>
                            </div>
                          </div>                          
                                                    
                          
                        </div><!-- /.row this actually does not appear to be needed with the form-horizontal -->
                      </form>