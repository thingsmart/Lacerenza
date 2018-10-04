<?php
    include("lib/controllaSessione.php");

	
	include("header.php");

	$fade = ($browser == 0) ? "fade" : "";	

	$id=$_GET['id'];
	$id_commessa=$_GET['id_commessa'];

	$titolo = ($_GET['nome'] == "nuovo") ? "Nuovo Mezzo" : "Modifica Mezzo";
?>


<!--SCRIPT SITO-->
<script src="js/sito/nuovo_veicolo.js" type="text/javascript"></script>


<script>
$(document).ready(function() {
    $("#div_nuovo_veicolo").load("php/div_nuovo_veicolo.php?id=<?=$id?>&id_commessa=<?=$id_commessa?>");	
	
	<? if($titolo == "Nuovo Mezzo"){ ?>
		$("#btn_nuovo_veicolo").show();	
	<? } else {?>
        $("#btn_modifica_veicolo").show();
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
                                 <a class="btn btn-info" href="pagina_veicoli.php?id_commessa=<?=$id_commessa?>"><i class="fa fa-reply"></i> Indietro</a>
                                 <div class="btn btn-success" id="btn_nuovo_veicolo" style="display:none"><i class="fa fa-save"></i> Salva</div>
                                 <div class="btn btn-success" id="btn_modifica_veicolo" style="display:none"><i class="fa fa-save"></i> Salva</div>
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

               

                <div class="row">
                    <div class="col-lg-12 ">
                    	<div id="div_nuovo_veicolo">
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



<input type="hidden" id="id_commessa" value="<?=$id_commessa?>"/>
<!-- footer -->
<?php
	include("footer.php");
?>


</body>

</html>
