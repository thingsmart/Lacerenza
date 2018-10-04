<?php
	require_once("../databases/db_function.php");
	include("controllaSessione.php");
	require_once("../classi/class.Log.php");
	
	//Numero commesse
	$log = new Log();
	$e_query_log = $log->caricaLogLimit();
	$num_log = $log->numeroLog();
	
	?>
    
<?php while($row = $e_query_log->fetch_array()) {
	$colore ="";
	switch($row['colore']){
		case "rosso":
			$colore ="label-danger";
		break;	
		case "verde":
			$colore ="label-success";
		break;	
		case "blu":
			$colore ="label-info";
		break;	
		case "arancione":
			$colore ="label-warning";
		break;	
		
	}
?>

<style>
	.label{font-size:75%;}	
</style>

                        <li style="text-align:center">
                            <span  class="label <?=$colore?>"><?=substr($row['operazione'],0,30)?></span>
                        </li>
                        <?php } ?>
                       <!--<li>
                            <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                        </li>-->
                        <li class="divider"></li>
                        <li>
                            <a href="pagina_log.php">Vedi Tutti</a>
                        </li>