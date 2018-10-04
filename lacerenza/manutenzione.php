<?php
	include("header.php");
include("lib/verificaConvertiData.php");
	include("databases/db_function.php");
require_once("classi/class.Manutenzione.php");

	$fade = ($browser == 0) ? "fade" : "";	
	$data = isset($_GET['data']) ? $_GET['data'] : date("Y-m-d");
	$data = ($data != "") ? capovolgiData($data) : date("d-m-Y");

// $data_select = CapovolgiData($data);
// $manutenzione = new Manutenzione();
// $e_query = $manutenzione->carica($data_select);

$mese = date("m");
$anno = date("Y");

$id = isset($_GET['id']) ? $_GET['id'] : "";
$targa = isset($_GET['targa']) ? $_GET['targa'] : "";


?>

<!--SCRIPT SITO-->
<script src="js/sito/manutenzione.js" type="text/javascript"></script>

<script>
$(document).ready(function() {
	$("#tabella_manutenzione").load("php/tabella_manutenzione.php?mese=<?=$mese?>&anno=<?=$anno?>&id=<?=$id?>");	
});
</script>

<script>
$(document).ready(function() {
	$("#titolo_page").html("Lacerenza | Manutenzione");
});
</script>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                   <!-- TITOLO -->
        	<div class="col-lg-12">
				<div class="page-title">
					<h1>Manutenzione <small> targa <?=$targa?></small> <a class="close pull-right" href="pagina_manutenzione.php"><i class="fa fa-backward"></i> Indietro</a></h1>
					<ol class="breadcrumb">
						<li class="active">
							<i class="fa fa-gears fa-lg"></i> Manutenzione
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
                    <div class="col-lg-12">
                    	<div class="row">
  						
                            <input type="hidden" id="data" class="data_picker form-control" value="<?=$data?>" readonly>
                            
                          <div class="col-lg-4">
                            <!-- <input id="data" class="data_picker form-control" value="<?=$data?>" readonly> -->
                            <select class="form-control" id="mese">
                            	<option <? if($mese == "01"){ echo "selected";} ?> value="01">GENNAIO</option>
                            	<option <? if($mese == "02"){ echo "selected";} ?>  value="02">FEBBRAIO</option>
                            	<option <? if($mese == "03"){ echo "selected";} ?>  value="03">MARZO</option>
                            	<option <? if($mese == "04"){ echo "selected";} ?>  value="04">APRILE</option>
                            	<option <? if($mese == "05"){ echo "selected";} ?>  value="05">MAGGIO</option>
                            	<option <? if($mese == "06"){ echo "selected";} ?>  value="06">GIUGNO</option>
                            	<option <? if($mese == "07"){ echo "selected";} ?>  value="07">LUGLIO</option>
                            	<option <? if($mese == "08"){ echo "selected";} ?>  value="08">AGOSTO</option>
                            	<option <? if($mese == "09"){ echo "selected";} ?>  value="09">SETTEMBRE</option>
                            	<option <? if($mese == "10"){ echo "selected";} ?>  value="10">OTTOBRE</option>
                            	<option <? if($mese == "11"){ echo "selected";} ?>  value="11">NOVEMBRE</option>
                            	<option <? if($mese == "12"){ echo "selected";} ?>  value="12">DICEMBRE</option>
                            </select>
                            <br>
                          </div>
                          <div class="col-lg-4">
                            <!-- <input id="data" class="data_picker form-control" value="<?=$data?>" readonly> -->
                            <select class="form-control" id="anno">
                            	<? for($i = 2010; $i < 2050; $i++){?>
                            		<option <? if($anno == $i){ echo "selected";} ?> value="<?=$i?>"><?=$i?></option>
                            	<? } ?>
                            	<option value="2015">2015</option>
                            </select>
                            <br>
                          </div>  
                          <div id="div_clona" style="display:none" class="col-lg-4">
                          	<div class="btn btn-warning"id="btn_clona"><i class="fa fa-external-link"></i> Clona mese precedente</div>
                          	</div>                        
                       </div>
                       
                       <div id="tabella_manutenzione" style="overflow:auto">
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
      <div class="modal-body" id="modal_body" > Sei sicuro di voler eliminare questo dato? </div>
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

<input type="hidden" id="id_mezzo_cerca" value="<?=$id?>"/>
<!-- footer -->
<?php
	include("footer.php");
?>


</body>

</html>
