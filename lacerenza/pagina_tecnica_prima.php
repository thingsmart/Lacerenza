<?php
	include("header.php");
?>

<script>
$(document).ready(function() {
	$("#titolo_page").html("Lacerenza | Tecnica");
});
</script>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <!-- TITOLO -->
        	<div class="col-lg-12">
				<div class="page-title">
					<h1>Tecnica <small> preventivi e gare</small></h1>
					<ol class="breadcrumb">
						<li class="active">
							<i class="fa fa-suitcase fa-lg"></i> Tecnica
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
                    
                    <!--PANEL-->
                    <div class="col-lg-6 col-sm-6">
                        <div class="circle-tile">
                            <a href="pagina_tecnica.php">
                                <div class="circle-tile-heading default">
                                    <i class="fa fa-arrow-circle-right fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content default">
                                <div class="circle-tile-description text-faded">
                                    Preventivi
                                </div>
                                <div class="circle-tile-number text-faded">
                                                                    
                                </div>
                                <a href="pagina_tecnica.php" class="circle-tile-footer"><i class="fa fa-play fa-lg fa-inverse"></i></a>
                            </div>
                        </div>
                    </div>                  
                    
                    <!--PANEL-->
                    <div class="col-lg-6 col-sm-6">
                        <div class="circle-tile">
                            <a href="pagina_gare.php">
                                <div class="circle-tile-heading default">
                                    <i class="fa fa-arrow-circle-right fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content default">
                                <div class="circle-tile-description text-faded">
                                    Gare
                                </div>
                                <div class="circle-tile-number text-faded">
                                                                      
                                </div>
                                <a href="pagina_gare.php" class="circle-tile-footer"><i class="fa fa-play fa-lg fa-inverse"></i></a>
                            </div>
                        </div>
                    </div>       
                   
                    
                    
                    <!-- / END: PANELS -->
                    
                </div>
                <!-- /.row -->
				<br><br>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<input type="hidden" value="<?=$id?>" id="id"/>

<!-- footer -->
<?php
	include("footer.php");
?>


</body>

</html>
