<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.ModelloMaster.php");
require_once("../classi/class.Modello.php");
require_once("../classi/class.Sezione.php");

$filtro = $_GET['q'];


$modello = new ModelloMaster();

if($filtro == ""){
	$lista_modelli = $modello->getAll();
} else {
    $lista_modelli = $modello->getFilter($filtro);
}

$numero = count($lista_modelli);

?>

<!--SCRIPT SITO-->
<script src="js/sito/tabella_modelli.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function(){
       $('.ricontatti_tooltip').tooltip();
    });
</script>
<? if($numero > 0){ ?>
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">Titolo</th>
                <th style="text-align:center">Riepilogo Sezioni</th>
                <th style="text-align:center">Sezioni</th>
                <th style="text-align:center">Modifica</th>
                <th style="text-align:center">Elimina</th>
           </tr>
        </thead>
        <tbody>
           <?php foreach ($lista_modelli as $new_modello) {
               
			?>
			<tr>
				<td style="text-align:center" data-title="Titolo"><?=$new_modello->titolo?></td>
				<td style="text-align:center" data-title="Riepilogo">
					
					<?  
						$testo_passato = "";
						$lista_modelli = Modello::getAllModelloMasterOrder($new_modello->id); 
						$idsezionilsita = ''; 
						$numItems = count($lista_modelli); 
						$i = 0;
						$b = 0;
						
						foreach($lista_modelli as $new_model) {
							 
							if(++$i === $numItems) {
								
								$idsezionilsita.= $new_model->id_sezione;
								
							} else {
								
								$idsezionilsita.= $new_model->id_sezione.",";
								
							}
							
						} 

						$esplodo_id = explode(",", $idsezionilsita);
	  					$dimensione = count($esplodo_id);
	  					
	  					for ($i = 0; $i < count($esplodo_id); $i++) {
	  						
	  						$b = $i + 1;
	  							
		  					$dati_sezione = Sezione::getById($esplodo_id[$i]);
							$testo_passato .= $b.". ".$dati_sezione->titolo."<br>";

	  					}
					
					?>
					<a style="width:100%" class="btn btn_riepilogo" id="<?=$new_modello->id?>" testodescrittivo="<?=$testo_passato?>" data-toggle="modal" data-target=".bs-descrizione"><i class="fa fa-search fa-lg"></i></a>
				</td>
                <td data-title="Sezioni" style="text-align:center">
                 	<a style="width:100%" class="btn" href="dettagli_modello.php?model=<?=$new_modello->id?>"><i class="fa fa-bars fa-lg"></i></a>
				</td>
                <td data-title="Modifica" style="text-align:center">
                 	<a style="width:100%" class="btn" href="nuovo_modello.php?id=<?=$new_modello->id?>"><i class="fa fa-edit fa-lg"></i></a>
				</td>
                <td data-title="Elimina" style="text-align:center">
                 	<a style="width:100%" class="btn btn_elimina" nome="<?=$row['nome_allegato']?>" id="<?=$new_modello->id?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash-o fa-lg"></i></a>
				</td>
			</tr>
			<?php
				} //END WHILE
			?>
          </tbody>
       </table>
</section>
<? } else {?>
	Nessun dato trovato
<? } ?>

