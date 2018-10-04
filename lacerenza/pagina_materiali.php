<?php
	include("header.php");

	$fade = ($browser == 0) ? "fade" : "";	
	$id_commessa = $_GET['id'];

include ("classi/class.Commesse.php");
include ("databases/db_function.php");
$c = new Commesse();
$e_query_c = $c->caricaCommesseById($_SESSION['id_commessa']);
$row_c = $e_query_c->fetch_array();
?>
<script>
$(document).ready(function() {
	$("#nome_commessa").html("<?=$row_c['descrizione']?>");
});
</script>
<!--SCRIPT SITO-->
<script src="js/sito/pagina_materiali.js" type="text/javascript"></script>

<script>
$(document).ready(function() {
    $("#tabella_materiali").load("php/tabella_materiali.php?id=<?=$id_commessa?>");	
});
</script>

<script>
$(document).ready(function() {
	$("#titolo_page").html("Lacerenza | Materiale");
});
</script>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                	<div class="col-lg-12">
                	<div class="page-title">
					<h1>Materiale <small> inserimento materiali</small>  <a class="close pull-right" href="commesse.php?id=<?=$id_commessa?>"><i class="fa fa-backward"></i> Indietro</a>  </h1>
					<div class="clearfix"></div>
					<ol class="breadcrumb">
						<li class="active">
							<i class="fa fa-tint fa-lg"></i> materiale
						</li>
						<li class="pull-right">

						</li>
					</ol>
					</div>
					</div>                               
                </div>         
                 
                <!-- /.row -->
 			 <div class="row">
              
              <div class="col-lg-2">
               	<a class="btn btn-success btn-block" href="nuovo_materiale.php?nome=nuovo&id_commessa=<?=$id_commessa?>"><i class="fa fa-plus-circle fa-lg"></i> Materiale</a>
               	<br>
			  </div>	
              
               <div class="col-lg-10">  
                    	<div class="input-group">
                      		<input type="text" id="testo_cerca_materiale" placeholder="Cerca per tipo materiale, fornitore o nome allegato" class="form-control">
                      		<span class="input-group-btn">
                        		<button class="btn btn-default" id="cerca_materiale" type="button">cerca</button>
                      		</span>                      		
                    	</div><!-- /input-group -->
                <br>        
                </div>    
                </div>
                <!-- /.row -->
				<div id="tabella_materiali">
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
      <div class="modal-body" id="modal_body" > Sei sicuro di voler eliminare il materiale? </div>
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