<?php
    include("lib/controllaSessione.php");

	
	include("header.php");

	$fade = ($browser == 0) ? "fade" : "";	

	$id=$_GET['id'];
	$id_commessa=$_GET['id_commessa'];
	$id_verbale=$_GET['id_verbale'];

	$titolo = ($_GET['nome'] == "nuovo") ? "Nuova Categoria" : "Modifica Categoria";
?>


<!--SCRIPT SITO-->
<script src="js/sito/nuova_categoria.js" type="text/javascript"></script>


<script>
$(document).ready(function() {
    $("#div_nuova_categoria").load("php/div_nuova_categoria.php?id=<?=$id?>&id_commessa=<?=$id_commessa?>&id_verbale=<?=$id_verbale?>");	
	
	<? if($titolo == "Nuova Categoria"){ ?>
		$("#btn_nuova_categoria").show();	
	<? } else {?>
    $("#btn_modifica_categoria").show();
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
							<h1><?=$titolo?> <small></small><a class="close pull-right" href="pagina_categorie.php?id_commessa=<?=$id_commessa?>&id_verbale=<?=$id_verbale?>"><i class="fa fa-backward"></i> Indietro</a></h1>
							<div class="clearfix"></div>
							<ol class="breadcrumb">
								<li class="active">
									
								</li>
								<li class="pull-right">
		
								</li>
							</ol>
						</div>
					</div>
		            <!-- / END: TITOLO  -->                 	
                   
                </div>
                <!-- /.row -->              

                <div class="row">
                    <div class="col-lg-12 ">
                    	<div id="div_nuova_categoria">
                        	<div style="text-align:center"><img src="img/load.gif" style="width:100px"/></div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
				<br>
				<div class="btn btn-success btn-block" id="btn_nuova_categoria" style="display:none"><i class="fa fa-save"></i> Salva e allega</div>
                <div class="btn btn-success btn-block" id="btn_modifica_categoria" style="display:none"><i class="fa fa-save"></i> Salva e allega</div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->



<input type="hidden" id="id_commessa" value="<?=$id_commessa?>"/>
<input type="hidden" id="id_verbale" value="<?=$id_verbale?>"/>
<!-- footer -->
<?php
	include("footer.php");
?>


</body>

</html>
