<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.Benzine.php");


$id_mezzo = $_GET['id'];

//estraggo elenco esso card
$benzine = new Benzine();


$e_query_benzina = $benzine->CaricaBenzina($id_mezzo);

$numeroBenzina = $benzine->numeroBenzina();
?>

<!--SCRIPT SITO-->
<link href="css/plugins/morris.css" rel="stylesheet">

   <!--[if lte IE 8]><script src="js/excanvas.min.js"></script><![endif]-->
    <script src="js/plugins/flot/jquery.flot.js"></script>
    <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="js/plugins/flot/jquery.flot.pie.js"></script>
<script>
    $(document).ready(function () {
        console.log("document ready");
        var offset = 0;
        plot();

        function plot() {
            var anno_2012 = [],
                anno_2013 = [];
            for (var i = 0; i < 12; i += 0.2) {
                anno_2012.push([i, Math.sin(i + offset)]);
                anno_2013.push([i, Math.cos(i + offset)]);
            }

            var options = {
                series: {
                    lines: {
                        show: true
                    },
                    points: {
                        show: false
                    }
                },
                grid: {
                    hoverable: true //IMPORTANT! this is needed for tooltip to work
                },
                yaxis: {
                    min: -1.2,
                    max: 1.2
                },
                tooltip: true,
                tooltipOpts: {
                    content: "'%s' of %x.1 is %y.4",
                    shifts: {
                        x: -60,
                        y: 25
                    }
                }
            };

            var plotObj = $.plot($("#flot-line-chart"), [{
                data: anno_2012,
                label: "2012"
            }, {
                data: anno_2013,
                label: "2013"
            }],
                options);
        }
    });
    
</script>
<? if($numeroBenzina > 0){ ?>
<div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Grafico costi</h3>
                            </div>
                            <div class="panel-body">
                                <div class="flot-chart">
                                    <div class="flot-chart-content" id="flot-line-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<? } else {?>
Nessun dato trovato
<? } ?>

<input type="hidden" value="<?=$id_mezzo?>" id="id_mezzo"/>