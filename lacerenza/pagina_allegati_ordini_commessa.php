<?php
	include("header.php");

	$fade = ($browser == 0) ? "fade" : "";	
	$id_commessa = $_GET['id_commessa'];
	$id = $_GET['id'];
	$fornitore = $_GET['fornitore'];
	$data = date('d-m-Y');
?>

<!--SCRIPT SITO-->
<script src="js/sito/pagina_allegati_ordini_commessa.js" type="text/javascript"></script>

<script>
$(document).ready(function() {
    $("#tabella_allegati_ordini_commessa").load("php/tabella_allegati_ordini_commessa.php?id_commessa=<?=$id_commessa?>&id_ordine=<?=$id?>");	
});
</script>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                	<div class="col-lg-12">
                	<div class="page-title">
					<h1>Allegati Ordine <small> per il fornitore "<?=$fornitore?>"</small>  <a class="close pull-right" href="pagina_ordini_commessa.php?id=<?=$id_commessa?>"><i class="fa fa-backward"></i> Indietro</a></h1>
					<div class="clearfix"></div>
					<ol class="breadcrumb">
						<li class="active">
							<i class="fa fa-tint fa-lg"></i> allegati ordine
						</li>
						<li class="pull-right">

						</li>
					</ol>
					</div>
					</div>                               
                </div>         
                  <!-- /.row -->
 			 <div class="row">
                          <div class="col-sm-12 col-lg-12 text-center">
                          	<form class="form-horizontal" id="formAllega" name="formAllega" enctype="multipart/form-data" action='lib/operazioni_allegati_ordine_commessa.lib.php' method='POST'>
                          	<div class="row">
                          		<div class="col-sm-3 col-lg-3 text-center">
                          			<input style="margin:auto" class="btn btn-info"  type="file" id="files" name="files"/>
                                	<input type="hidden" id="tipo_allegato" name="tipo_allegato"  value="allega_file"/>
                                	<input type="hidden" id="id_ordine" name="id_ordine"  value="<?=$id?>"/>
                                	<input type="hidden" id="id_commessa" name="id_commessa"  value="<?=$id_commessa?>"/>
                          		</div>
                          		<div class="col-sm-2 col-lg-2 text-center">
                                <input type="text" class="form-control data_picker" value="<?=$data?>" placeholder="Data" id="data" name="data" readonly>
                          		</div>
                          		<div class="col-sm-2 col-lg-2 text-center">
                          			<select class="form-control" id="tipologia" name="tipologia">
                          				<option value="FATTURA">FATTURA</option>
                          				<option value="DDT">DDT</option>
                          				<option value="PREVENTIVO">PREVENTIVO</option>
                          				<option value="ORDINE">ORDINE</option>
                          				<option value="ALTRO">ALTRO</option>
                          			</select>
                          		</div>
                          		<div class="col-sm-3 col-lg-3 text-center">
                                <input type="text" class="form-control"  placeholder="Descrizione file" id="descrizione_file" name="descrizione_file">
                          		</div>
                          		<div class="col-sm-2 col-lg-2 text-center">
                          			<div id="btn_allega" class="btn btn-success" style="width:100%">Allega</div>
                          			
                          		</div>
                          	</div>
                          	</form>
                          	<br>
                          	
                          </div>
                          </div>
                <!-- /.row -->
                
                <!-- /.row -->
 			 <div class="row">
              
              	
              
                <div class="col-lg-12">  
                    	<div class="input-group">
                      		<input type="text" id="testo_cerca" placeholder="Cerca per descrizione o tipologia" class="form-control">
                      		<span class="input-group-btn">
                        		<button class="btn btn-default" id="cerca" type="button">cerca</button>
                      		</span>                      		
                    	</div>
                <br>        
                </div>    
                </div>
                <!-- /.row -->
				<div id="tabella_allegati_ordini_commessa">
                       
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
      <div class="modal-body" id="modal_body" > Sei sicuro di voler eliminare l'allegato? </div>
      <div class="modal-footer">
        <input id="id_allegato_da_eliminare" type="hidden" />
        <input id="id_ordine_da_eliminare" type="hidden" />
        <input id="id_commessa_da_eliminare" type="hidden" />
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
