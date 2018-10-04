<?php
	include("header.php");

	$fade = ($browser == 0) ? "fade" : "";	
	$id_commessa = $_GET['id'];
	$cartella = str_replace("_", " ",$_GET['cartella']);

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
<script src="js/sito/foto.js" type="text/javascript"></script>
<link rel="stylesheet" href="//frontend.reklamor.com/fancybox/jquery.fancybox.css" media="screen">
<script src="//frontend.reklamor.com/fancybox/jquery.fancybox.js"></script>
<script>
$(document).ready(function() {
    $("#elenco_foto").load("php/elenco_foto.php?id=<?=$id_commessa?>&cartella=<?=str_replace(" ", "_",$cartella)?>");	
    
    $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
    });
});
</script>
<script>
$(document).ready(function() {
	$("#titolo_page").html("Lacerenza | Foto");
});
</script>
<style>
	.gallery
{
    display: inline-block;
    margin-top: 20px;
}
</style>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                	<div class="col-lg-12">
                	<div class="page-title">
					<h1>Foto <small> inserimento foto</small> <a class="close pull-right" href="cartelle_foto.php?id=<?=$id_commessa?>"><i class="fa fa-backward"></i> Indietro</a> </h1>
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
	              
	              <div class="col-lg-3">
	               	<input title="Clicca per selezionare un file"   id="imgs" name="imgs[]" type="file" multiple>
	               	<input type="hidden" id="tipo" name="tipo" value="allega_foto">
	               	<input type="hidden" id="id_commessa" name="id_commessa" value="<?=$id_commessa?>">
	               	<input type="hidden" id="cartella" name="cartella" value="<?=$cartella?>">
	               	<br>
				  </div>	
	              
	               <div class="col-lg-3">  
	                    	<div class="btn btn-success btn-block" id="btn_allega"><i class="fa fa-plus-circle fa-lg"></i> Allega</div>
	                <br>        
	                </div> 
	                <div class="col-lg-3">  
	                    	<div data-toggle="modal" data-target=".bs-elimina"  class="btn btn-danger btn-block" id="btn_elimina_tutto"><i class="fa fa-trash fa-lg"></i> Elimina tutte le foto</div>
	                <br>        
	                </div>    
	                </div>
               </form>
               <div class="progress" style="height:20px;">
					<div class="progress-bar progress-bar-primary bar"  style="width: 0%; color:white;line-height:20px;"><strong>0%</strong></div>
				</div>
                <div id="elenco_foto"></div>
                
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
        <button type="submit" id="btn_elimina_conferma" style="display:none" class="btn btn-danger">Conferma</button>
        <button type="submit" id="btn_elimina_conferma_tutto" style="display:none"  class="btn btn-danger">Conferma</button>
      </div>
    </div>
  </div>
</div>
<!--FINE modal elimina-->



<input type="hidden" id="id_commessa" value="<?=$id_commessa?>" />
<!-- footer -->
<?php
	include("footer.php");
?>


</body>

</html>
