<?php
session_start();
    include("lib/controllaSessione.php");
	
	
	include("header.php");
	
	$fade = ($browser == 0) ? "fade" : "";
?>

<!--SCRIPT SITO-->
<script src="js/sito/utenti.js" type="text/javascript"></script>

<script>
$(document).ready(function() {
	$("#tabella_utenti").load("php/tabella_utenti.php");	
});
</script>

<script>
$(document).ready(function() {
	$("#titolo_page").html("Lacerenza | Utenti");
});
</script>

        <div id="page-wrapper">

            <div class="container-fluid">
            	
            	<div class="row">
            		<div class="col-lg-12">
                        <div class="page-title">
                            <h1><? if($_SESSION['ruolo'] == "ADMIN" || $_SESSION['ruolo'] == "SUPERADMIN"){ ?>
                            Utenti
                            <? } else { ?>
                            Profilo
                            <? } ?>
                                <small>gestione utenti</small>
                            </h1>
                            <ol class="breadcrumb">
                                <li class="active"><i class="fa fa-users fa-lg"></i> Utenti</li>
                                <li class="pull-right">
                                	                                    
                                </li>
                            </ol>
                        </div>
                    </div>      
            	</div>

                <!-- Page Heading -->
                <!-- <h1 class="page-header">
                        	<? if($_SESSION['ruolo'] == "ADMIN" || $_SESSION['ruolo'] == "SUPERADMIN"){ ?>
                            Utenti
                            <? } else { ?>
                            Profilo
                            <? } ?>
                        </h1> -->
                <div class="row">
                    <div class="col-lg-3">                        
                        <? if($_SESSION['ruolo'] == "ADMIN" || $_SESSION['ruolo'] == "SUPERADMIN"){ ?>
                               <a class="btn btn-success btn-block" href="modifica_utente.php?nome=nuovo"><i class="fa fa-plus-circle fa-lg"></i> Nuovo Utente</a>
                               <br>                        
                        <? } ?>
                    </div>
               
                    <div class="col-lg-9">
                    	<? if($_SESSION['ruolo'] == "ADMIN" || $_SESSION['ruolo'] == "SUPERADMIN"){ ?>
                    	<div class="input-group">
                      		<input type="text" id="testo_cerca_utente" placeholder="Cerca" class="form-control">
                      		<span class="input-group-btn">
                        		<button class="btn btn-default" id="cerca_utente" type="button">cerca</button>
                      		</span>
                    	</div><!-- /input-group -->
                        <br>
                        <? } ?>
                    	
                    </div>
                </div>
                <!-- /.row -->
                <div id="tabella_utenti">
                        	<div style="text-align:center"><img src="img/load.gif"/></div>
                        </div>
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
      <div class="modal-body" id="modal_body" > Sei sicuro di voler eliminare l'utente? </div>
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
