<?php 
session_start();
if ($_SESSION['ruolo'] != "ADMIN" && $_SESSION['ruolo'] != "SUPERADMIN" && $_SESSION['ruolo'] != "PERSONALE_RUOLINO") {
header('Location: index.php'); 
exit();
} ?>
<?php
    include("lib/controllaSessione.php");
	//include("lib/controllaAutorizzazioni.php");

	
	include("header.php");
	
	$id=$_GET['id'];

	$titolo = ($_GET['nome'] == "nuovo") ? "Nuovo Dipendente" : "Modifica Dipendente";
?>


<!--SCRIPT SITO-->
<script src="js/sito/nuovo_dipendenti.js" type="text/javascript"></script>


<script>
$(document).ready(function() {
	$("#div_nuovo_dipendente").load("php/div_nuovo_dipendente.php?id=<?=$id?>");	
	
	<? if($titolo == "Nuovo Dipendente"){ ?>
		$("#btn_nuovo_dipendente").show();	
	<? } else {?>
		$("#btn_modifica_dipendente").show();	
	<? } ?>
});
</script>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                    	
                    	<div class="page-title">
							<h1><?=$titolo?> <small></small> <a class="close pull-right" href="pagina_dipendenti.php"><i class="fa fa-backward"></i> Indietro</a></h1>
							<div class="clearfix"></div>
							<ol class="breadcrumb">
								<li class="active">
									
								</li>
								<li class="pull-right">
		
								</li>
							</ol>
						</div>            
                                 
                           
                    </div>
                </div>
                <!-- /.row -->

               

                <div class="row">
                    <div class="col-lg-12 ">
                    	<div id="div_nuovo_dipendente">
                        	<div style="text-align:center"><img src="img/load.gif" style="width:100px"/></div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
				<br>
				<div class="btn btn-success btn-block" id="btn_nuovo_dipendente" style="display:none"><i class="fa fa-save"></i> Salva</div>
                <div class="btn btn-success btn-block" id="btn_modifica_dipendente" style="display:none"><i class="fa fa-save"></i> Salva</div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->



<!-- footer -->
<?php
	include("footer.php");
?>


</body>

</html>
