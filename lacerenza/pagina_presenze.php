<?php
	include("header.php");
	include("databases/db_function.php");
	include("lib/verificaConvertiData.php");
	include("classi/class.Costi.php");
	$fade = ($browser == 0) ? "fade" : "";	
	$id_dipendente = $_GET['id_dipendente'];
	$nome_personale = $_GET['nome_personale'];
	$data = isset($_GET['data']) ? $_GET['data'] : date("Y-m-d");
	$costo = new Costi();
	$costo_h = $costo->costoAttuale($id_dipendente, $data);
	$filtro_commessa = isset($_GET['id_commessa']) ? $_GET['id_commessa'] : "-1";
	
	
$query = "SELECT * FROM tb_commesse WHERE status IS NULL;";
    $e_query_lista = EseguiQuery($query,"selezione");
	

?>

<!--SCRIPT SITO-->
<script src="js/sito/pagina_presenze.js" type="text/javascript"></script>


<link href="css/demo.css" rel="stylesheet">
<script src="js/jquery-ui.js" ></script>


<script>
$(document).ready(function() {
    $("#tabella_presenze").load("php/tabella_presenze.php?id_dipendente=<?=$id_dipendente?>&data=<?=$data?>");	
});
</script>

<script>
    $(function () {

        var availableTags = [
            <?while($row_lista = $e_query_lista->fetch_array()){?>
          "<?=$row_lista['id']?>-<?=$row_lista['cantiere']?>-<?=$row_lista['codice']?>",
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
</script>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Presenze per <?=$nome_personale?> del <?=CapovolgiData($data)?>
                   
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                 <a class="btn btn-info" href="ruolino.php?data=<?=$data?>&id_commessa=<?=$filtro_commessa?>"><i class="fa fa-reply"></i> Indietro</a>
                            </li>
                            <li id="slelct_presenze">
                            	<select id="tipo_presenza" class="form-control" style="padding-top:3px">
                            		<option>Presenza</option>
                            		<option>Malattia</option>
                            		<option>Ferie</option>
                            	</select>
                            </li>
                           <!-- <li>
                           	 <div style="margin-left: 10px; margin-top: 2px;" class="btn btn-success" id="btn_nuova_presenza" type="button">
                           	 	<i class="fa fa-plus"></i> Inserisci presenza
                           	 </div>
                           </li> -->
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

               

                <div class="row">
                    <form class="form-horizontal" id="formNewPresenza" name="formNewPresenza" enctype="multipart/form-data" action='lib/operazioni_presenze.lib.php' method='POST'>
                      
                <div class="col-sm-3 col-lg-3">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Commessa.*:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" placeholder="Commessa"  id="dettagli_commessa" name="dettagli_commessa">
                            <input type="hidden" class="form-control" value="<?=$data?>" id="data_giorno" name="data_giorno">
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-lg-3">
                    <div class="form-group">
                        <label class="col-md-4 control-label">N. Ore.*:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" placeholder="N. Ore."  id="n_ore" name="n_ore">
                            <!-- <select class="form-control" id="n_ore" name="n_ore">
                            	<? for($i=0; $i<=15; $i++){ ?>
                            	<option value="<?=$i?>"><?=$i?></option>
                            	<? } ?>
                            	<option value="0_m">Malattia</option>
                            	<option value="0_f">Ferie</option>
                            </select> -->
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-3 col-lg-3">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Costo h*:</label>
                        <div class="col-md-8">
                            <input disabled type="text" class="form-control" placeholder="Costo h" id="costo" name="costo" value="<?=$costo_h?>">
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-3 col-lg-3">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Dettagli:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" placeholder="Dettagli" id="dettagli" name="dettagli">
                            <input type="hidden" id="tipo" name="tipo" value="inserimento" />
                            <input type="hidden" id="id_dipendente" name="id_dipendente"  value="<?=$id_dipendente?>"/>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-12" style="margin-bottom:10px">
                    <div style="text-align: center">
                        <div style="margin: auto; text-align: center">
                            <div style="margin-left: 10px; margin-top: 2px;" class="btn btn-success" id="btn_nuova_presenza" type="button">Inserisci presenza</div>
                        </div>
                    </div>
                </div>
                
            </form>
            <br><br />
            <hr />
                    <div class="col-lg-12 ">
                    	<div id="tabella_presenze">
                        	<div style="text-align:center"><img src="img/load.gif"/></div>
                        </div>
                    </div>
                    <!-- &ensp;
                    <div class="col-lg-12" style="margin-bottom:10px">
	                    <div style="text-align: center">
	                        <div style="margin: auto; text-align: center">
	                        	<div class="col-lg-6" style="margin-bottom:10px">
	                            	<input type="text" class="form-control " />
	                           	</div>
	                            <div style="margin-left: 10px; margin-top: 2px;" class="btn btn-warning" type="button">Aggiungi personale</div>
	                        </div>
	                    </div>
	                </div> -->
                </div>
                <!-- /.row -->
				<br><br>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->


<!--Modal elimina-->
<div class="modal <?=$fade?> bs-elimina" tabindex="-1" role="dialog" id="dialog_elimina" style="display:none" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Elimina</h4>
      </div>
      <div class="modal-body" id="modal_body" > Sei sicuro di voler eliminare la presenza? </div>
      <div class="modal-footer">
        <input id="id_da_eliminare" type="hidden" />
        <input id="nome_da_eliminare" type="hidden" />
        <button type="button" class="btn btn-success" id="btn_elimina_annulla" data-dismiss="modal">Annulla</button>
        <button type="submit" id="btn_elimina_conferma" class="btn btn-danger">Conferma</button>
      </div>
    </div>
  </div>
</div>
<!--FINE modal elimina-->

<input type="hidden" id="costo_orario_lavoratore" value="<?=$costo_h?>"/>
<input type="hidden" id="data_reload" value="<?=$data?>"/>
<!-- footer -->
<?php
	include("footer.php");
?>


</body>

</html>
