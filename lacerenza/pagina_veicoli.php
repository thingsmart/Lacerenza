<?php
	include("header.php");

	$fade = ($browser == 0) ? "fade" : "";	
	$id_commessa = $_GET['id_commessa'];

?>

<!--SCRIPT SITO-->
<script src="js/sito/pagina_veicoli.js" type="text/javascript"></script>

<script>
$(document).ready(function() {
    $("#tabella_veicoli").load("php/tabella_veicoli.php?id_commessa=<?=$id_commessa?>");	
});
</script>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Mezzi
                   
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                 <a class="btn btn-success" href="nuovo_veicolo.php?nome=nuovo&id_commessa=<?=$id_commessa?>"><i class="fa fa-plus"></i> Aggiungi Mezzo</a>
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

               

                <div class="row">
                    <div class="col-lg-12 ">
                    	<div class="input-group">
                      		<input type="text" id="testo_cerca_veicolo" placeholder="Cerca per mezzo o targa" class="form-control">
                      		<span class="input-group-btn">
                        		<button class="btn btn-default" id="cerca_veicolo" type="button">cerca</button>
                      		</span>
                    	</div><!-- /input-group -->
                        <br>
                    	<div id="tabella_veicoli">
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
      <div class="modal-body" id="modal_body" > Sei sicuro di voler eliminare il mezzo? </div>
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
