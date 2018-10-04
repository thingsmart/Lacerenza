<?php

session_start();
$id=$_GET['id'];
$_SESSION['id_commessa'] = $id;
include("header.php");
include ("classi/class.Commesse.php");
include ("databases/db_function.php");
$c = new Commesse();
$e_query_c = $c->caricaCommesseById($_SESSION['id_commessa']);
$row_c = $e_query_c->fetch_array();
?>

<!--SCRIPT SITO-->
<script src="js/sito/dettaglio_commessa.js" type="text/javascript"></script>

<script>
    $(document).ready(function () {
        $("#tabella_commessa").load("php/tabella_commessa.php?id=<?=$id?>");
    $("#tabella_allegati_commessa").load("php/tabella_allegati_commessa.php?id=<?=$id?>");
});
</script>

<script>
$(document).ready(function() {
	$("#titolo_page").html("Lacerenza | Dettaglio commessa");
	$("#nome_commessa").html("<?=$row_c['descrizione']?>");
});
</script>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
          <!-- TITOLO -->
        	<div class="col-lg-12">
				<div class="page-title">
					<h1>Commessa <small> dettaglio della commessa</small>  <a class="close pull-right" href="commesse.php?id=<?=$id_commessa?>"><i class="fa fa-backward"></i> Indietro</a>  </h1>
					<div class="clearfix"></div>
					<ol class="breadcrumb">
						<li class="active">
							<i class="fa fa-arrows-v fa-lg"></i> Commessa
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

            <div class="container-fluid">
                <div id="tabella_commessa">
                    <div style="text-align: center">
                        <img src="img/load.gif" style="width: 100px" /></div>
                </div>                
                <div id="tabella_allegati_commessa"></div>
                <div class="pull-right">
                    <a class="btn" href="allegaFile.php?id=<?=$id?>"><i class="fa fa-paperclip fa-lg"></i> Allega un file</a>
                    <div class="btn btn-info" id="btn_salva_cantiere"><i class="fa fa-save"></i> Salva</div>
                </div>
            </div>
            <!-- /.container -->
        </div>
        <!-- /.row -->
        <br>
        <br>
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

<div id="id_commessa" style="display: none"><?=$id?></div>
</body>

</html>
