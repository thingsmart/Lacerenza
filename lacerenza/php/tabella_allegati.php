<?php
include("controllaSessione.php");

include("../databases/db_function.php");


$filtro = isset($_GET['filtro_allegato']) ? $_GET['filtro_allegato'] : "";



if($filtro != ""){
    $query_allegati = 'SELECT 
  `tb_allegati`.`link_allegato`
FROM
  `tb_allegati`
  WHERE `tb_allegati`.`link_allegato` LIKE "%'.$filtro.'%"
UNION

SELECT 
  CONCAT(`tb_fattura`.`link_allegato`, `tb_fattura`.`nome_allegato`) AS `link_allegato`
FROM
  `tb_fattura`
WHERE
  `tb_fattura`.`nome_allegato` != "" AND (`tb_fattura`.`link_allegato` LIKE "%'.$filtro.'%" OR `tb_fattura`.`nome_allegato` LIKE "%'.$filtro.'%")
UNION

SELECT 
  CONCAT(`tb_allegati_noleggi`.`link_allegato`, `tb_allegati_noleggi`.`nome_allegato`) AS `link_allegato`
FROM
  `tb_allegati_noleggi`
WHERE
  `tb_allegati_noleggi`.`nome_allegato` != "" AND (`tb_allegati_noleggi`.`link_allegato` LIKE "%'.$filtro.'%" OR `tb_allegati_noleggi`.`nome_allegato` LIKE "%'.$filtro.'%")
UNION

SELECT 
  CONCAT(`tb_documentazione`.`link_allegato`, `tb_documentazione`.`nome_allegato`) AS `link_allegato`
FROM
  `tb_documentazione`
WHERE
  `tb_documentazione`.`nome_allegato` != "" AND (`tb_documentazione`.`link_allegato` LIKE "%'.$filtro.'%" OR `tb_documentazione`.`nome_allegato` LIKE "%'.$filtro.'%")
UNION

SELECT 
  CONCAT(`tb_fattura`.`link_allegato`, `tb_fattura`.`nome_allegato`) AS `link_allegato`
FROM
  `tb_fattura`
WHERE
  `tb_fattura`.`nome_allegato` != "" AND (`tb_fattura`.`link_allegato` LIKE "%'.$filtro.'%" OR `tb_fattura`.`nome_allegato` LIKE "%'.$filtro.'%")
UNION

SELECT 
  CONCAT(`tb_fatture_ral`.`link_allegato`, `tb_fatture_ral`.`nome_allegato`) AS `link_allegato`
FROM
  `tb_fatture_ral`
WHERE
  `tb_fatture_ral`.`nome_allegato` != "" AND (`tb_fatture_ral`.`link_allegato` LIKE "%'.$filtro.'%" OR `tb_fatture_ral`.`nome_allegato` LIKE "%'.$filtro.'%")
UNION

SELECT 
  CONCAT(`tb_ordini`.`link_allegato`, `tb_ordini`.`nome_allegato`) AS `link_allegato`
FROM
  `tb_ordini`
WHERE
  `tb_ordini`.`nome_allegato` != "" AND (`tb_ordini`.`link_allegato` LIKE "%'.$filtro.'%" OR `tb_ordini`.`nome_allegato` LIKE "%'.$filtro.'%")
UNION

SELECT 
  CONCAT(`tb_polizza`.`link_allegato`, `tb_polizza`.`nome_allegato`) AS `link_allegato`
FROM
  `tb_polizza`
WHERE
  `tb_polizza`.`nome_allegato` != "" AND (`tb_polizza`.`link_allegato` LIKE "%'.$filtro.'%" OR `tb_polizza`.`nome_allegato` LIKE "%'.$filtro.'%")
UNION

SELECT 
  CONCAT(`tb_ral`.`link_allegato`, `tb_ral`.`nome_allegato`) AS `link_allegato`
FROM
  `tb_ral`
WHERE
  `tb_ral`.`nome_allegato` != "" AND (`tb_ral`.`link_allegato` LIKE "%'.$filtro.'%" OR `tb_ral`.`nome_allegato` LIKE "%'.$filtro.'%")
UNION

SELECT 
  CONCAT(`tb_revisioni`.`link_allegato`, `tb_revisioni`.`nome_allegato`) AS `link_allegato`
FROM
  `tb_revisioni`
WHERE
  `tb_revisioni`.`nome_allegato` != "" AND (`tb_revisioni`.`link_allegato` LIKE "%'.$filtro.'%" OR `tb_revisioni`.`nome_allegato` LIKE "%'.$filtro.'%")
UNION

SELECT 
  CONCAT(`tb_verbali`.`link_allegato`, `tb_verbali`.`nome_allegato`) AS `link_allegato`
FROM
  `tb_verbali`
WHERE
  `tb_verbali`.`nome_allegato` != "" AND (`tb_verbali`.`link_allegato` LIKE "%'.$filtro.'%" OR `tb_verbali`.`nome_allegato` LIKE "%'.$filtro.'%")
UNION

SELECT 
  CONCAT(`tb_riserve`.`link_allegato`, `tb_riserve`.`nome_allegato`) AS `link_allegato`
FROM
  `tb_riserve`
WHERE
  `tb_riserve`.`nome_allegato` != "" AND (`tb_riserve`.`link_allegato` LIKE "%'.$filtro.'%" OR `tb_riserve`.`nome_allegato` LIKE "%'.$filtro.'%")
UNION

SELECT 
  CONCAT(`tb_regolarita`.`link_allegato`, `tb_regolarita`.`nome_allegato`) AS `link_allegato`
FROM
  `tb_regolarita`
WHERE
  `tb_regolarita`.`nome_allegato` != "" AND (`tb_regolarita`.`link_allegato` LIKE "%'.$filtro.'%" OR `tb_regolarita`.`nome_allegato` LIKE "%'.$filtro.'%")
UNION

SELECT 
  CONCAT(`tb_allegati_attivita`.`link_allegato`, `tb_allegati_attivita`.`nome_allegato`) AS `link_allegato`
FROM
  `tb_allegati_attivita`
WHERE
  `tb_allegati_attivita`.`nome_allegato` != "" AND (`tb_allegati_attivita`.`link_allegato` LIKE "%'.$filtro.'%" OR `tb_allegati_attivita`.`nome_allegato` LIKE "%'.$filtro.'%")
UNION

SELECT 
  CONCAT(`tb_allegati_dipendenti`.`link_allegato`, `tb_allegati_dipendenti`.`nome_allegato`) AS `link_allegato`
FROM
  `tb_allegati_dipendenti`
WHERE
  `tb_allegati_dipendenti`.`nome_allegato` != "" AND (`tb_allegati_dipendenti`.`link_allegato` LIKE "%'.$filtro.'%" OR `tb_allegati_dipendenti`.`nome_allegato` LIKE "%'.$filtro.'%")
UNION

SELECT 
  CONCAT(`tb_materiale`.`link_allegato`, `tb_materiale`.`nome_allegato`) AS `link_allegato`
FROM
  `tb_materiale`
WHERE
  `tb_materiale`.`nome_allegato` != "" AND (`tb_materiale`.`link_allegato` LIKE "%'.$filtro.'%" OR `tb_materiale`.`nome_allegato` LIKE "%'.$filtro.'%")
UNION


SELECT 
  CONCAT(`tb_documenti_cliente`.`link_allegato`, `tb_documenti_cliente`.`nome_allegato`) AS `link_allegato`
FROM
  `tb_documenti_cliente`
WHERE
  `tb_documenti_cliente`.`nome_allegato` != "" AND (`tb_documenti_cliente`.`link_allegato` LIKE "%'.$filtro.'%" OR `tb_documenti_cliente`.`nome_allegato` LIKE "%'.$filtro.'%")';
    $e_query_allegati = EseguiQuery($query_allegati,"selezione");
    $numeroAllegati = $e_query_allegati->num_rows;
} else {
  $numeroAllegati = 0;
}
?>

<? if($numeroAllegati > 0){ ?>
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">Allegato</th>
           </tr>
        </thead>
        <tbody>
           <?php
       while($row = $e_query_allegati->fetch_array()){

			?>
			<tr>
				<td style="text-align:center" data-title="Utente"><a href="<?=$row['link_allegato']?>" target="_blank"><?=$row['link_allegato']?></a></td>
				
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