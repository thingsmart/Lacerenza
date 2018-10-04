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
<script src="js/sito/cartelle_foto.js" type="text/javascript"></script>

<script>
$(document).ready(function() {
    $("#elenco_cartelle_foto").load("php/elenco_cartelle_foto.php?id=<?=$id_commessa?>");	

});
</script>
<script>
$(document).ready(function() {
	$("#titolo_page").html("Lacerenza | Foto");
});
</script>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                	<div class="col-lg-12">
                	<div class="page-title">
					<h1>Cartelle Foto <small> inserimento foto</small>  </h1>
					<div class="clearfix"></div>
					<ol class="breadcrumb">
						<li class="active">
							<i class="fa fa-photo fa-lg"></i> foto
						</li>
						<li class="pull-right">

						</li>
					</ol>
					</div>
					</div>                               
                </div>         
                 
                <!-- /.row -->
                <form class="form-horizontal" id="formAllega" name="formAllega" enctype="multipart/form-data" action='lib/operazioni_foto.lib.php' method='POST'>
	 			 <div class="row">
	              
	              <div class="col-lg-9">
	               	<input type="text" class="form-control" id="cartella" name="cartella" placeholder="Nome cartella">
	               	<input type="hidden" id="tipo" name="tipo" value="crea_cartella">
	               	<input type="hidden" id="id_commessa" name="id_commessa" value="<?=$id_commessa?>">
	               	<br>
				  </div>	
	              
	               <div class="col-lg-3">  
	                    	<div class="btn btn-success btn-block" id="btn_allega"><i class="fa fa-plus-circle fa-lg"></i> Crea</div>
	                <br>        
	                </div> 
	                  
	                </div>
               </form>
              
                <div id="elenco_cartelle_foto"></div>
                
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
      <div class="modal-body" id="modal_body" > Sei sicuro di voler eliminare i dati? </div>
      <div class="modal-footer">
        <input id="cancella" type="hidden" />
        <input id="id_da_eliminare" type="hidden" />
        <input id="nome_da_eliminare" type="hidden" />
        <button type="button" class="btn btn-success" id="btn_elimina_annulla" data-dismiss="modal">Annulla</button>
        <button type="submit" id="btn_elimina_conferma" class="btn btn-danger">Conferma</button>
      </div>
    </div>
  </div>
</div>
<!--FINE modal elimina-->


<!--Modal modifica-->
<div class="modal <?=$fade?> bs-modifica" tabindex="-1" role="dialog" id="dialog_modifica" style="display:none" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Modifica</h4>
            </div>
            <div class="modal-body" id="modal_body" >
                <input class="form-control" type="text" id="nuovo_nome_modifica" />
            </div>
            <div class="modal-footer">
                <input id="percorso_modifica" type="hidden" />
                <input id="nome_modifica" type="hidden" />
                <input id="id_commessa_modifica" type="hidden" />
                <button type="button" class="btn btn-success" id="btn_modifica_annulla" data-dismiss="modal">Annulla</button>
                <button type="submit" id="btn_modifica_conferma" class="btn btn-danger">Conferma</button>
            </div>
        </div>
    </div>
</div>
<!--FINE modal modifica-->


<input type="hidden" id="id_commessa" value="<?=$id_commessa?>" />
<!-- footer -->
<?php
	include("footer.php");
?>


</body>

</html>
