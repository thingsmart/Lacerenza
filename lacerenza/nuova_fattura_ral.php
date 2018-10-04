<?php
    include("lib/controllaSessione.php");

	
	include("header.php");

	$fade = ($browser == 0) ? "fade" : "";	

	$id=$_GET['id'];
	$id_commessa=$_GET['id_commessa'];
	$id_ral=$_GET['id_ral'];

	$titolo = ($_GET['nome'] == "nuovo") ? "Nuova Fattura SAL" : "Modifica Fattura SAL";
?>


<!--SCRIPT SITO-->
<script src="js/sito/nuova_fattura_ral.js" type="text/javascript"></script>


<script>
$(document).ready(function() {
    $("#div_nuova_fattura_ral").load("php/div_nuova_fattura_ral.php?id=<?=$id?>&id_commessa=<?=$id_commessa?>&id_ral=<?=$id_ral?>");	
	
	<? if($titolo == "Nuova Fattura SAL"){ ?>
		$("#btn_nuova_ral").show();	
	<? } else {?>
    $("#btn_modifica_ral").show();
	<? } ?>
});
</script>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header" id="titolo_h1">
                            <?=$titolo?>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                 <a class="btn btn-info" href="pagina_fatture_ral.php?id_commessa=<?=$id_commessa?>&id_ral=<?=$id_ral?>"><i class="fa fa-reply"></i> Indietro</a>
                                 <div class="btn btn-success" id="btn_nuova_ral" style="display:none"><i class="fa fa-save"></i> Salva e allega</div>
                                 <div class="btn btn-success" id="btn_modifica_ral" style="display:none"><i class="fa fa-save"></i> Salva e allega</div>
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

               

                <div class="row">
                    <div class="col-lg-12 ">
                    	<div id="div_nuova_fattura_ral">
                        	<div style="text-align:center"><img src="img/load.gif" style="width:100px"/></div>
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
      <div class="modal-body" id="modal_body" > Sei sicuro di voler eliminare l'allegato? </div>
      <div class="modal-footer">
        <input id="id_da_eliminare" type="hidden" value="<?=$id?>"/>
        <input id="id_commessa_da_eliminare" type="hidden" value="<?=$id_commessa?>"/>
        <input id="id_ral_da_eliminare" type="hidden" value="<?=$id_commessa?>"/>
        <input id="nome_da_eliminare" type="hidden" />
        <button type="button" class="btn btn-success" id="btn_elimina_annulla" data-dismiss="modal">Annulla</button>
        <button type="submit" id="btn_elimina_conferma" class="btn btn-danger">Conferma</button>
      </div>
    </div>
  </div>
</div>
<!--FINE modal elimina-->

<input type="hidden" id="id_commessa" value="<?=$id_commessa?>"/>
<input type="hidden" id="id_ral" value="<?=$id_ral?>"/>
<!-- footer -->
<?php
	include("footer.php");
?>


</body>

</html>
