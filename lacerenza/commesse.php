<?php
	include("header.php");
include("databases/db_function.php");
require_once("lib/verificaConvertiData.php");
require_once("classi/class.Commesse.php");

$fade = ($browser == 0) ? "fade" : "";
$commesse_data = new Commesse();
$e_query_data= $commesse_data->caricaData();
if($e_query_data != ""){
    $da_data = CapovolgiData($e_query_data);
} else {
    $da_data = date("01-01-Y");
}

//$da_data = date("01-01-Y");
$da_data = date("01-01-2013");
$a_data = date("31-12-Y");
	
$e_query_anno = $commesse_data->selezionaAnni();
//print_r($e_query_anno); exit;
?>

<!--SCRIPT SITO-->
<script src="js/sito/commesse.js" type="text/javascript"></script>

<script>
$(document).ready(function() {
	$("#tabella_commesse").load("php/tabella_commesse.php?da_data=<?=$da_data?>&a_data=<?=$a_data?>&archivitato=0");
});
</script>

<script>
$(document).ready(function() {
	$("#titolo_page").html("Lacerenza | Commesse");
});
</script>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                   	<div class="col-lg-12">
                        <div class="page-title">
                            <h1>Commesse
                                <small>sommario commesse</small>
                            </h1>
                            <ol class="breadcrumb">
                                <li class="active"><i class="fa fa-tasks fa-lg"></i> Commesse</li>
                                <li class="pull-right">

                                </li>
                            </ol>
                        </div>
                    </div>      
                </div>
                <!-- /.row -->
				
				<div class="row" style="margin-bottom: 15px">
					<div class="col-lg-12">
						<? while($row = $e_query_anno->fetch_array()){ ?>
                            <a class="btn btn-default scegli_anno" anno="<?=$row['anno'];?>"><?=$row['anno'];?></a>
						<? } ?>
					</div>
				</div>

                <div class="row">
                	<div class="col-lg-2">
                    	<a class="btn btn-success btn-block" href="nuova_commessa.php?nome=nuovo"><i class="fa fa-plus-circle fa-lg"></i> Aggiungi Commessa</a>
                    	<br>
                    </div>
                    <div class="col-lg-2">
                        <input value="<?=$da_data?>" placeholder="Da data" class="form-control data_picker" id="da_data"/>
                    </div>
                    <div class="col-lg-2">
                        <input placeholder="A data" class="form-control data_picker" id="a_data" value="<?=$a_data?>"/>
                    </div>
                    <div class="col-lg-2">
                        <select class="form-control" id="mostra">
                            <option value="">Tutte</option>
                            <option value="attive">Solo attive</option>
                            <option value="chiuse">Solo chiuse</option>
                        </select>
                    </div>
                    <div class="col-lg-4">
                    	<div class="input-group">
                      		<input type="text" id="testo_cerca_commessa" placeholder="Cerca" class="form-control">
                      		<span class="input-group-btn">
                        		<button class="btn btn-default" id="cerca_commessa" type="button">cerca</button>
                      		</span>
                    	</div><!-- /input-group -->
                        <br>
                    	
                    </div>
                </div>
                <!-- /.row -->
				<br>
                <div>

				<div id="tabella_commesse">
                        	<div style="text-align:center"><img src="img/load.gif" style="width:100px"/></div>
                        </div>
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
      <div class="modal-body" id="modal_body" > Sei sicuro di voler eliminare la commessa e tutti i file allegati? </div>
      <div class="modal-footer">
        <input id="id_da_eliminare" type="hidden" />
        <div id="username_da_eliminare" style="display:none"></div>
        <button type="button" class="btn btn-success" id="btn_elimina_annulla" data-dismiss="modal">Annulla</button>
        <button type="submit" id="btn_elimina_conferma" class="btn btn-danger">Conferma</button>
      </div>
    </div>
  </div>
</div>
<!--FINE modal elimina-->

<!-- footer -->
<?php
	include("footer.php");
?>

<script>
    $(document).ready(function() {

        $(".scegli_anno").unbind("click");
        $(".scegli_anno").click(function() {

            var anno = $(this).attr("anno");
            var da_data = "01-01-"+anno;
            var a_data = "31-12-"+anno;

            var mostra = $("#mostra").val();

//            $("#da_data").val(da_data);
//            $("#a_data").val(a_data);

            $("#tabella_commesse").load("php/tabella_commesse.php?da_data="+da_data+"&a_data="+a_data+"&mostra="+mostra+"&op=anno&archiviato=1");

        });

    });
</script>
</body>

</html>
