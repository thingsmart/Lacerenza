<?php 
session_start();
if ($_SESSION['ruolo'] != "ADMIN" && $_SESSION['ruolo'] != "PERSONALE_RUOLINO" && $_SESSION['ruolo'] != "SUPERADMIN") {
header('Location: index.php'); 
exit();
}
$operazione = $_GET["op"];?>
<?php
    include("lib/controllaSessione.php");
	//include("lib/controllaAutorizzazioni.php");
	
	include("header.php");
	
	$fade = ($browser == 0) ? "fade" : "";
?>

<!--SCRIPT SITO-->
<script src="js/sito/pagina_dipendenti.js" type="text/javascript"></script>

<script>
$(document).ready(function() {
    <? if($operazione == '') { ?>
	    $("#tabella_dipendenti").load("php/tabella_dipendenti.php");
    <? } else { ?>
        $("#tabella_dipendenti").load("php/tabella_dipendenti.php?op=<?=$operazione?>");
    <? } ?>
});
</script>

<script>
$(document).ready(function() {
	$("#titolo_page").html("Lacerenza | Dipendenti");
});
</script>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                   <div class="col-lg-12">
                        <div class="page-title">
                            <h1>Dipendenti
                                <small>anagrafica dipendenti</small>
                            </h1>
                            <ol class="breadcrumb">
                                <li class="active"><i class="fa fa-users fa-lg"></i> Personale</li>
                                <li class="pull-right">
                                    
                                </li>
                            </ol>
                        </div>
                    </div>   
                </div>
                <!-- /.row -->

               

                <div class="row">
                	<div class="col-lg-3">
                    		<a class="btn btn-success btn-block" href="nuovo_dipendente.php?nome=nuovo"><i class="fa fa-plus-circle fa-lg"></i> Aggiungi Dipendente</a>
                    		<br>
                    	</div>
                    <div class="col-lg-9">
                    	<div class="input-group">
                      		<input type="text" id="testo_cerca_dipendente" placeholder="Cerca per nome o cognome" class="form-control">
                      		<span class="input-group-btn">
                        		<button class="btn btn-default" id="cerca_dipendente" type="button">cerca</button>
                      		</span>
                    	</div><!-- /input-group -->
                        <br>
                    	
                    </div>
                </div>
                <!-- /.row -->
				<br>
				<div id="tabella_dipendenti">
                        	<div style="text-align:center"><img src="img/load.gif"/></div>
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
      <div class="modal-body" id="modal_body" > Sei sicuro di voler eliminare il dipendente? </div>
      <div class="modal-footer">
        <div id="id_da_eliminare" style="display:none"></div>
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


</body>

</html>
