<?php
	include("header.php");

	$fade = ($browser == 0) ? "fade" : "";	
	$id_commessa = $_GET['id'];
	$mese = date('m');
	$anno = date('Y');
?>

<!--SCRIPT SITO-->
<script src="js/sito/pagina_tecnica.js" type="text/javascript"></script>

<script>
$(document).ready(function() {
    $("#tabella_tecnica").load("php/tabella_tecnica.php?mese=<?=$mese?>&anno=<?=$anno?>");	
});
</script>

<script>
$(document).ready(function() {
	$("#titolo_page").html("Lacerenza | Preventivi");
});
</script>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                  
		            <!-- TITOLO -->
		        	<div class="col-lg-12">
						<div class="page-title">
							<h1>Preventivi <small>scheda preventivi </small> <a class="close pull-right" href="pagina_tecnica_prima.php"><i class="fa fa-backward"></i> Indietro</a></h1>
							<ol class="breadcrumb">
								<li class="active">
									<i class="fa fa-suitcase fa-lg"></i> Preventivi
								</li>
								<li class="pull-right">
		
								</li>
							</ol>
						</div>
					</div>
		            <!-- / END: TITOLO  -->      
                         
                </div>
                <!-- /.row -->

               

                <div class="row">
                	<div class="col-lg-3">
                		<a class="btn btn-success btn-block" href="nuova_tecnica.php?nome=nuovo"><i class="fa fa-plus-circle fa-lg"></i> Aggiungi Preventivo</a>
                		<br>
                	</div>
                	<div class="col-lg-3">
                		<select class="form-control" id="mese">
							<option <? if(date('m') == "01"){ echo "selected";} ?> value="01"> Gennaio </option>
							<option <? if(date('m') == "02"){ echo "selected";} ?> value="02"> Febbraio </option>
							<option <? if(date('m') == "03"){ echo "selected";} ?> value="03"> Marzo </option>
							<option <? if(date('m') == "04"){ echo "selected";} ?> value="04"> Aprile </option>
							<option <? if(date('m') == "05"){ echo "selected";} ?> value="05"> Maggio </option>
							<option <? if(date('m') == "06"){ echo "selected";} ?> value="06"> Giugno </option>
							<option <? if(date('m') == "07"){ echo "selected";} ?> value="07"> Luglio </option>
							<option <? if(date('m') == "08"){ echo "selected";} ?> value="08"> Agosto </option>
							<option <? if(date('m') == "09"){ echo "selected";} ?> value="09"> Settembre </option>
							<option <? if(date('m') == "10"){ echo "selected";} ?> value="10"> Ottobre </option>
							<option <? if(date('m') == "11"){ echo "selected";} ?> value="11"> Novembre </option>
							<option <? if(date('m') == "12"){ echo "selected";} ?> value="12"> Dicembre </option>
						</select>
						<br>
                	</div>
                	<div class="col-lg-4">
                		<select class="form-control" id="anno">
                			<? for($val = 2014; $val <2050; $val++){?>
                				<option <? if(date('Y') == "$val"){ echo "selected";} ?> value="<?=$val?>"> <?=$val?> </option>
                			<? } ?>
						</select>
						<br>
                	</div>
                	<div class="col-lg-2">
                        		<button class="btn btn-default btn-block" id="cerca" type="button">cerca</button>
                        		<br>
                	</div>
                	
                    <div class="col-lg-12 ">                    	
                        <br>
                    	<div id="tabella_tecnica" style="overflow: auto">
                        	<div style="text-align:center"><img src="img/load.gif"/></div>
                        </div>
                    </div>
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
      <div class="modal-body" id="modal_body" > Sei sicuro di voler eliminare la revisione? </div>
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


<!-- footer -->
<?php
	include("footer.php");
?>


</body>

</html>
