<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.Contabilita.php");

//$filtro = isset($_GET['filtro_revisioni_contrattuali']) ? $_GET['filtro_revisioni_contrattuali'] : "";

$id_commessa = $_GET['id'];
$id_contabilita = $_GET['id_contabilita'];
//estraggo elenco commesse
$contabilita = new Contabilita();

//if($filtro == ""){
$e_query = $contabilita->carica($id_commessa);
//} else {
//    $e_query = $contabilita->filtraContabilita($filtro, $id_commessa);
//}
$numero = $contabilita->numero();
?>

<!--SCRIPT SITO-->
<script src="js/sito/tabella_contabilita_new.js" type="text/javascript"></script>

<? if($numero > 0){ ?>
<section id="no-more-tables">
	<table class=" table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">N.</th>
                <th style="text-align:center">Descrizione lavori</th>
                <th style="text-align:center">P =</th>
                <th style="text-align:center">B</th>
                <th style="text-align:center">L</th>
                <th style="text-align:center">A</th>
                <th style="text-align:center">P</th>
                <th style="text-align:center">Prodotto</th>
                <th style="text-align:center">Prezzo</th>
                <th style="text-align:center">Importo</th>
                <th style="text-align:center">Allegato</th>
                <th style="text-align:center">Modifica</th>
                <th style="text-align:center">Elimina</th>
           </tr>
        </thead>
        <tbody>
           <?php
            $i=0;
				while($row = $e_query->fetch_array()){
                    $i++;
                    $val1 = ($row['p1'] != "" && $row['p1'] != null) ? $row['p1'] : 1;
                    $val2 = ($row['b'] != "" && $row['b'] != null) ? $row['b'] : 1;
                    $val3 = ($row['l'] != "" && $row['l'] != null) ? $row['l'] : 1;
                    $val4 = ($row['a'] != "" && $row['a'] != null) ? $row['a'] : 1;
                    $val5 = ($row['p'] != "" && $row['p'] != null) ? $row['p'] : 1;
                    $prodotto = $val1*$val2*$val3*$val4*$val5;
                    if(($row['p1'] == 0 || $row['p1'] == $row['p1'] || $val1 == "") && ($row['b'] == 0 || $row['b'] == null || $row['b'] == "") && ($row['l'] == 0 || $row['l'] == null || $row['l'] == "") && ($row['a'] == 0 || $row['a'] == null || $row['a'] == "") && ($row['p'] == 0 || $row['p'] == null || $row['p'] == "")){
                        $prodotto = 0;
                    }
			?>
			<tr <? if($id_contabilita == $row['id']){ echo "style='background:#DEE0E0'";}?>>
				<td style="text-align:center" data-title="N."><?=$i?></td>
				<td style="text-align:center" data-title="Descrizione lavori"><?=$row['descrizione_lavori']?></td>
				<td style="text-align:center" data-title="P ="><?=$row['p1']?></td>
				<td style="text-align:center" data-title="B"><?=$row['b']?></td>
                <td style="text-align:center" data-title="L"><?=$row['l']?></td>
                <td style="text-align:center" data-title="A"><?=$row['a']?></td>
                <td style="text-align:center" data-title="P"><?=$row['p']?></td>
                <td style="text-align:center" data-title="Prodotto"><?=$prodotto?></td>
                <td style="text-align:center" data-title="Prezzo">
                    <? if($row['prezzo'] != ""){ ?>
                    &euro; <?=number_format($row['prezzo'], 2, ',', '.');?>
                    <? } ?>
                </td>
                <td style="text-align:center" data-title="Importo">
                    <? if($row['importo'] != ""){ ?>
                    &euro; <?=number_format($row['importo'], 2, ',', '.');?>
                    <? } ?>
                </td>
				<td style="text-align:center" data-title="Allegato">
                	<? if($row['nome_allegato'] != "") { ?>
                        <a href="<?=$row['link_allegato'].$row['nome_allegato']?>" target="_blank">
                            Apri allegato
                        </a>
                    <? } else { ?>
                    	Nessun allegato
                    <? } ?>
                </td>
                <td data-title="Modifica" style="text-align:center">
                 	<a style="width:100%" class="btn" href="nuova_contabilita.php?id=<?=$row['id']?>&id_commessa=<?=$id_commessa?>"><i class="fa fa-edit fa-lg"></i></a>
				</td>
                <td data-title="Elimina" style="text-align:center">
                 	<a style="width:100%" class="btn btn_elimina" nome="<?=$row['nome_allegato']?>" id="<?=$row['id']?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash-o fa-lg"></i></a>
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

<input type="hidden" value="<?=$id_commessa?>" id="id_commessa"/>