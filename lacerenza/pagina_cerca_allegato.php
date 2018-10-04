<?php

	include("header.php");
	
?>
<!--SCRIPT SITO-->
<script src="js/sito/pagina_cerca_allegati.js" type="text/javascript"></script>

<script>
$(document).ready(function() {
	$("#tabella_allegati").load("php/tabella_allegati.php");	
});
</script>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Cerca Allegati
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

               

                <div class="row">
                    <div class="col-lg-12 ">
                    	<div>
                        	<div class="input-group">
                      		<input type="text" id="testo_cerca_allegato" placeholder="Cerca per nome allegato" class="form-control">
                      		<span class="input-group-btn">
                        		<button class="btn btn-default" id="cerca_allegato" type="button">cerca</button>
                      		</span>
                    	</div><!-- /input-group -->
                        <br>
						<div id="tabella_allegati">
                        	
                        </div>
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



<!-- footer -->
<?php
	include("footer.php");
?>


</body>

</html>
