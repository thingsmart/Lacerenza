<?php
    include("lib/controllaSessione.php");

	
	include("header.php");

	$fade = ($browser == 0) ? "fade" : "";	

	$id=$_GET['id'];

	$titolo = ($_GET['nome'] == "nuovo") ? "Nuova Attivit&agrave;" : "Modifica Attivit&agrave;";
?>


<!--SCRIPT SITO-->
<script src="js/sito/nuovo_lavoro.js" type="text/javascript"></script>


<script>
$(document).ready(function() {
    $("#div_nuovo_lavoro").load("php/div_nuovo_lavoro.php?id=<?=$id?>");	
	
	<? if($titolo == "Nuova Attivit&agrave;"){ ?>
		$("#btn_nuovo").show();	
	<? } else {?>
    $("#btn_modifica").show();
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
							<h1><?=$titolo?>  <small></small> <a class="close pull-right" href="pagina_lavori.php"><i class="fa fa-backward"></i> Indietro</a></h1>
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
                    	<div id="div_nuovo_lavoro">
                        	<div style="text-align:center"><img src="img/load.gif" style="width:100px"/></div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
				<br>
				 <div class="btn btn-success btn-block" id="btn_nuovo" style="display:none"><i class="fa fa-save"></i> Salva</div>
                                 <div class="btn btn-success btn-block" id="btn_modifica" style="display:none"><i class="fa fa-save"></i> Salva</div>

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
