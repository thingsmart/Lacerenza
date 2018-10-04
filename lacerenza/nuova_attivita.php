<?php
    include("lib/controllaSessione.php");

	
	include("header.php");

	$fade = ($browser == 0) ? "fade" : "";	

	$id=$_GET['id'];
	$id_commessa=$_GET['id_commessa'];

	$titolo = ($_GET['nome'] == "nuovo") ? "Nuova Attivit&agrave;" : "Modifica Attivit&agrave;";
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
<script src="js/sito/nuova_attivita.js" type="text/javascript"></script>


<script>
$(document).ready(function() {
    $("#div_nuova_attivita").load("php/div_nuova_attivita.php?id=<?=$id?>&id_commessa=<?=$id_commessa?>");	
	
	<? if($titolo == "Nuova Attivit&agrave;"){ ?>
		$("#btn_nuova_attivita").show();	
	<? } else {?>
        $("#btn_modifica_attivita").show();
	<? } ?>
});
</script>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                	
                	<!-- TITOLO -->
					<div class="col-lg-12">
						<div class="page-title">
							<h1><?=$titolo?> <small></small><a class="close pull-right" href="pagina_attivita.php?id=<?=$id_commessa?>"><i class="fa fa-backward"></i> Indietro</a></h1>
							<div class="clearfix"></div>
							<ol class="breadcrumb">
							<li class="active">
								
							</li>
								<li class="pull-right">
							</li>
							</ol>
						</div>
					</div>
					<!-- / TITOLO -->
                
                </div>
                <!-- /.row -->

               

                <div class="row">
                    <div class="col-lg-12 ">
                    	<div id="div_nuova_attivita">
                        	<div style="text-align:center"><img src="img/load.gif" style="width:100px"/></div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
				<br>
				 <div class="btn btn-success btn-block" id="btn_nuova_attivita" style="display:none"><i class="fa fa-save"></i> Salva</div>
                                 <div class="btn btn-success btn-block" id="btn_modifica_attivita" style="display:none"><i class="fa fa-save"></i> Salva</div>
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
