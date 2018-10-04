<?php
include("header.php");

$fade = ($browser == 0) ? "fade" : "";
$id_commessa = $_GET['id'];

require_once ("lib/verificaConvertiData.php");
require_once ("classi/class.Dipendenti.php");
require_once ("classi/class.Presenze.php");
require_once ("classi/class.Commesse.php");
require_once ("classi/class.Costi.php");
include ("databases/db_function.php");

$da_data = isset($_GET['da_data']) ? $_GET['da_data'] : "";
$a_data = isset($_GET['a_data']) ? $_GET['a_data'] : "";
$tl = isset($_GET['tl']) ? $_GET['tl'] : "";
$c = new Commesse();
$e_query_c = $c->caricaCommesseById($id_commessa);
$row_c = $e_query_c->fetch_array();
$da_data_search = ($da_data != "") ? CapovolgiData($da_data) : "";
$a_data_search = ($a_data != "") ? CapovolgiData($a_data) : "";

$ruolino = new Dipendenti();
//$e_query_ruolino = $ruolino -> caricaDipendentiRuolinoAll();
$e_query_ruolino = $ruolino -> caricaDipendentiRuolinoAllCosti();

?>
<script>
    $(document).ready(function() {
        //inizializzo datepicker
        $('.data_picker').datepicker({
            language: 'it',
            autoclose: true
        });
        $("#nome_commessa").html("<?=$row_c['descrizione']?>");


        $(".show").click(function(){
            var nome = $(this).attr("id");
            var valore = $(this).attr("valore");
            if(valore == "mostra") {
                $("." + nome).show();

                $(this).removeClass("fa-plus").addClass("fa-minus");
                $(this).attr("valore", "nascondi")
            } else {
                $("." + nome).hide();
                $(this).removeClass("fa-minus").addClass("fa-plus");
                $(this).attr("valore", "mostra")
            }
        });
        $("#filtra").click(function() {
            var tl = $("#tipologia").val();
            if(($("#da_data").val() == "" && $("#a_data").val() != "") || ($("#a_data").val() == "" && $("#da_data").val() != "") ){
                alert("Seleziona entrambe le date");
                return false;
            }
            if($("#da_data").val() != "") {
                var split_da_data = $("#da_data").val().split("-");
                da_data = split_da_data[2] + "-" + split_da_data[1] + "-" + split_da_data[0];
                var split_a_data = $("#a_data").val().split("-");
                a_data = split_a_data[2] + "-" + split_a_data[1] + "-" + split_a_data[0];
            } else {
                da_data = "";
                a_data = "";
            }
            window.location = "costo_operai.php?id=<?=$id_commessa?>&da_data="+da_data+"&a_data="+a_data+"&tl="+tl;
        });
    });
</script>

<script>
    $(document).ready(function() {
        $("#titolo_page").html("Lacerenza | Riepilogo");
    });
</script>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title">
                    <h1>Costo manodopera <small> <?=$row_c['descrizione']?>
                        <? if($da_data != ""){ ?>
                            periodo: <?= CapovolgiData($da_data)?> <?=CapovolgiData($a_data)?>
                        <? } ?>
                        </small>  <!--<a class="close pull-right" href="riepilogo_commessa.php?id=<?=$id_commessa?>"><i class="fa fa-backward"></i> Indietro</a>--></h1>
                    <div class="clearfix"></div>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-desktop fa-lg"></i> riepilogo
                        </li>
                        <li class="pull-right">

                        </li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-5">

                    <select class="form-control" id="tipologia">
                        <option <? if($tl == ""){ echo "selected"; } ?> value="">Tutti</option>
                        <option <? if($tl == "cap"){ echo "selected"; } ?> value="cap">cap</option>
                        <option <? if($tl == "fv"){ echo "selected"; } ?> value="fv">fv</option>
                        <option <? if($tl == "cg"){ echo "selected"; } ?> value="cg">cg</option>
                        <option <? if($tl == "imp"){ echo "selected"; } ?> value="imp">imp</option>
                        <option <? if($tl == "om"){ echo "selected"; } ?> value="om">om</option>
                    </select>
            </div>
            <div class="col-lg-3">
                <input type="text" class="form-control data_picker" id="da_data" value="<?=$da_data_search?>"/>
                </div>
            <div class="col-lg-3">
                <input type="text" class="form-control data_picker" id="a_data" value="<?=$a_data_search?>"/>
                </div>
            <div class="col-lg-1">
                <div id="filtra" class="btn btn-default">Cerca</div>
                </div>
                <br><br>


        </div>
        <!-- /.row -->
        <section id="no-more-tables">

                        <div style="width:100%; ">
                            <table class="table-stripeda table-condensed cf" style="width:100%;">
                                <thead class="cf">
                                <tr>
                                    <th style="text-align:center;">Operaio</th>
                                    <th style="text-align:center">Ore </th>
                                    <th style="text-align:center">Costo Medio</th>
                                    <th style="text-align:center">Totale </th>
                                    <th style="text-align:center">Dettagli </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?
                                $totale_operai_finale = 0;
                                $totale_ore_operai_finale = 0;

                                $totale_ore_benzina = 0;
                                $totale_benzina = 0;

                                while($row = $e_query_ruolino->fetch_array()){
                                    $presenza = new Presenze();
                                    if($da_data == ""){
                                        if($tl == ""){
                                            $e_totale = $presenza->oreLavoroCommessa($id_commessa);
                                        } else {
                                            $e_totale = $presenza->oreLavoroCommessaTl($id_commessa, $tl);
                                        }
                                    } else {
                                        if($tl == ""){
                                            $e_totale = $presenza->oreLavoroCommessaData($id_commessa, $da_data, $a_data);
                                        } else {
                                            $e_totale = $presenza->oreLavoroCommessaDataTl($id_commessa, $da_data, $a_data, $tl);
                                        }
                                    }
                                    $tot_per_mese = 0;
                                    $tot_costo = 0;

                                    $costo = new Costi();
                                    $costo_orario_medio_totale = 0;
                                    $numero_giorni = 0;
                                    //Calcolo ore totali per la commessa
                                    $array_date = null;
                                    while($row_totale = $e_totale->fetch_array()){
                                        $dipendenti_oggi = explode(",", $row_totale['id_dipendenti']);
                                        for($l=0; $l<count($dipendenti_oggi); $l++){
                                            if($row['id'] == intval($dipendenti_oggi[$l])){
                                                $tot_per_mese += $row_totale['ore'];
                                                $costo_esploso = explode("-", $row_totale['data']);

                                                $costo_paretnza = $costo_esploso[0]."-".$costo_esploso[1]."-1";
                                                $costo_h = $costo->costoAttualeCommessa($row['id'], $costo_paretnza, $id_commessa);
                                                if($costo_h == 0){
                                                    $costo_h = $costo->costoAttualeNuovo($row['id'], $costo_paretnza);
                                                }
                                                $costo_tmp = $costo_h * $row_totale['ore'];
                                                $tot_costo += $costo_tmp;
                                                $costo_orario_medio_totale += $costo_h;
                                                $numero_giorni += 1;
//                                                echo $row_totale['data']." ".$row['cognome']."<br>";
                                                $array_date[$numero_giorni] = $row_totale['data'];
                                                $array_ore[$numero_giorni] = $row_totale['ore'];
                                                $array_costo[$numero_giorni] = $costo_h;

                                                if($row['id'] == 61 || $row['id'] == 62 || $row['id'] == 60 || $row['id'] == 59 || $row['id'] == 58 || $row['id'] == 56) {

                                                    $totale_ore_benzina += $row_totale['ore'];

                                                    $totale_benzina += $costo_tmp;

                                                }
                                            }
                                        }
                                    }

                                    $totale_operai_finale += $tot_costo;
                                    $class_name = str_replace(" ", "_", $row['nome'].$row['cognome']);
                                    $class_name = str_replace(".", "_", $class_name);
                                    $class_name = str_replace("%", "", $class_name);
                                    $class_name = str_replace("&#39;", "", $class_name);
                                    $totale_ore_operai_finale += $tot_per_mese;

                                    ?>
                                    <? if($tot_per_mese > 0){
                                        ?>
                                        <tr>
                                            <td data-title="Operaio" style="text-align:center;"><?=$row['nome'] ?> <?=$row['cognome'] ?>
<!--                                                <div class="--><?//=str_replace(" ", "_", $row['nome'].$row['cognome'])?><!--" style="display:none">-->
<!--                                                    <br><br>-->
<!--                                                    <ul>-->
<!--                                            --><?// for($f=1; $f<=count($array_date); $f++){
//                                                ?>
<!--                                                    <li>--><?//=CapovolgiData($array_date[$f])?><!--</li>-->
<!--                                                --><?//
//                                                }?>
<!--                                                    </ul>-->
<!--                                                </div>-->
                                            </td>
                                            <td data-title="Ore" style="text-align:center;"><?=$tot_per_mese?></td>
                                            <td data-title="Costo medio" style="text-align:center;"><?=number_format($costo_orario_medio_totale/$numero_giorni, 2, ',', '.');?></td>
                                            <td data-title="Totale" style="text-align:center;"><?=number_format($tot_costo, 2, ',', '.');?></td>
                                            <td data-title="Dettagli"><i valore="mostra" id="<?=$class_name?>" class="btn fa fa-plus show"></i></td>
                                        </tr>
                                        <? for($f=1; $f<=count($array_date); $f++){

                                            ?>
                                            <tr style="display:none; background: #E4E8D8" class="<?=$class_name?>">
                                                <td  data-title="Data" style="text-align:center;"><?=CapovolgiData($array_date[$f])?></td>
                                                <td  data-title="Ore" style="text-align:center;"><?=$array_ore[$f]?></td>
                                                <td  data-title="Costo" style="text-align:center;"><?=$array_costo[$f]?></td>
                                                <td  data-title="Totale" style="text-align:center;"><?=$array_ore[$f]*$array_costo[$f]?></td>
                                            </tr>
                                        <?
                                        }?>
                                <tr style="display:none" class="<?=$class_name?>">
                                    <td colspan="5" style="background: #185a7a"></td>
                                    </tr>
                                    <? } ?>
                                <? } ?>
                                <tr>
                                    <td style="text-align: right"><b>Totale Ore</b></td>
                                    <td style="text-align:center; background:lightgreen"><b><?=$totale_ore_operai_finale?></b></td>
                                    <td style="text-align: right"><b>Totale</b></td>
                                    <td style="text-align:center; background:lightgreen"><b><?=number_format($totale_operai_finale, 2, ',', '.');?> &euro;</b></td>
                                </tr>
                                <tr>
                                    <td style="text-align: right"><b>Totale Ore Gasolio</b></td>
                                    <td style="text-align:center; background:#ff0000; color: #fff" title="Totale Ore Gasolio"><b><?=$totale_ore_benzina;?></b></td>
                                    <td style="text-align: right"><b>Totale Gasolio</b></td>
                                    <td style="text-align:center; background:#ff0000; color: #fff" title="Totale Gasolio"><b><?=number_format($totale_benzina, 2, ',', '.');?> &euro;</b></td>
                                </tr>
                                <tr>
                                    <td style="text-align: right"><b>Totale Ore Senza Gasolio</b></td>
                                    <td style="text-align:center; background:#fff000; color: #000" title="Totale Ore Senza Gasolio"><b><?=($totale_ore_operai_finale-$totale_ore_benzina);?></b></td>
                                    <td style="text-align: right"><b>Totale Senza Gasolio</b></td>
                                    <td style="text-align:center; background:#fff000; color: #000" title="Totale Senza Gasolio"><b><?=number_format(($totale_operai_finale-$totale_benzina), 2, ',', '.');?> &euro;</b></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>


        </section>

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
