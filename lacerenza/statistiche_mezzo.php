<?php
	include("header.php");
    include("lib/verificaConvertiData.php");

	$fade = ($browser == 0) ? "fade" : "";

    $id = $_GET['id'];

    include ("classi/class.Benzine.php");
    include ("classi/class.Mezzi.php");
    include ("classi/class.Spese.php");
    include ("databases/db_function.php");

    $mezzo = new Mezzi();
    $e_query_mezzo = $mezzo->caricaMezzoById($id);
    $row_mezzo = $e_query_mezzo->fetch_array();

    $targa = $row_mezzo['targa'];

    $arrayAnno = array();

    $datainizio = "2013-01-01";
    $years = round((time()-strtotime($datainizio))/(3600*24*365.25));
    for($i=0; $i <= $years; $i++) {
        $anno = 2013 + $i;
        array_push($arrayAnno, $anno);
    }

    $benzina = new Benzine();

    $e_query_spese_benzina = $benzina->calcolaCostiBenzina($id);

    $arrayCostiBenzina = array();

    $posizioneBenzina = 0;
    while($row = $e_query_spese_benzina->fetch_array()) {
        $posizioneBenzina++;
        if($posizioneBenzina == 1) {
            if($row['anno'] == '2013') {
                array_push($arrayCostiBenzina, $row['totale_con_iva']);
            } else if($row['anno'] == '2014') {
                array_push($arrayCostiBenzina, 0);
                array_push($arrayCostiBenzina, $row['totale_con_iva']);
            } else if($row['anno'] == '2015') {
                array_push($arrayCostiBenzina, 0);
                array_push($arrayCostiBenzina, 0);
                array_push($arrayCostiBenzina, $row['totale_con_iva']);
            } else if($row['anno'] == '2016') {
                array_push($arrayCostiBenzina, 0);
                array_push($arrayCostiBenzina, 0);
                array_push($arrayCostiBenzina, 0);
                array_push($arrayCostiBenzina, $row['totale_con_iva']);
            } else if($row['anno'] == '2017') {
                array_push($arrayCostiBenzina, 0);
                array_push($arrayCostiBenzina, 0);
                array_push($arrayCostiBenzina, 0);
                array_push($arrayCostiBenzina, 0);
                array_push($arrayCostiBenzina, $row['totale_con_iva']);
            } else if($row['anno'] == '2018') {
                array_push($arrayCostiBenzina, 0);
                array_push($arrayCostiBenzina, 0);
                array_push($arrayCostiBenzina, 0);
                array_push($arrayCostiBenzina, 0);
                array_push($arrayCostiBenzina, 0);
                array_push($arrayCostiBenzina, $row['totale_con_iva']);
            } else if($row['anno'] == '2019') {
                array_push($arrayCostiBenzina, 0);
                array_push($arrayCostiBenzina, 0);
                array_push($arrayCostiBenzina, 0);
                array_push($arrayCostiBenzina, 0);
                array_push($arrayCostiBenzina, 0);
                array_push($arrayCostiBenzina, 0);
                array_push($arrayCostiBenzina, $row['totale_con_iva']);
            } else if($row['anno'] == '2020') {
                array_push($arrayCostiBenzina, 0);
                array_push($arrayCostiBenzina, 0);
                array_push($arrayCostiBenzina, 0);
                array_push($arrayCostiBenzina, 0);
                array_push($arrayCostiBenzina, 0);
                array_push($arrayCostiBenzina, 0);
                array_push($arrayCostiBenzina, 0);
                array_push($arrayCostiBenzina, $row['totale_con_iva']);
            } else if($row['anno'] == '2021') {
                array_push($arrayCostiBenzina, 0);
                array_push($arrayCostiBenzina, 0);
                array_push($arrayCostiBenzina, 0);
                array_push($arrayCostiBenzina, 0);
                array_push($arrayCostiBenzina, 0);
                array_push($arrayCostiBenzina, 0);
                array_push($arrayCostiBenzina, 0);
                array_push($arrayCostiBenzina, 0);
                array_push($arrayCostiBenzina, $row['totale_con_iva']);
            }
        }  else {
            array_push($arrayCostiBenzina, $row['totale_con_iva']);
        }
    }

    $spese = new Spese();

    $e_query_spese_mezzo = $spese->calcolaSpeseMezzo($id);

    $arrayCostiTotali = array();
    $arrayCostiFissi = array();
    $arrayCostiVariabili = array();

    $posizioneSpese = 0;
    while($row = $e_query_spese_mezzo->fetch_array()) {
        $posizioneSpese++;
        if($posizioneSpese == 1) {
            if($row['anno'] == '2013') {
                array_push($arrayCostiTotali, $row['costi_totali']);
                array_push($arrayCostiFissi, $row['costi_fissi']);
                array_push($arrayCostiVariabili, $row['costi_variabili']);
            } else if($row['anno'] == '2014') {
                array_push($arrayCostiTotali, 0);
                array_push($arrayCostiFissi, 0);
                array_push($arrayCostiVariabili, 0);
                array_push($arrayCostiTotali, $row['costi_totali']);
                array_push($arrayCostiFissi, $row['costi_fissi']);
                array_push($arrayCostiVariabili, $row['costi_variabili']);
            } else if($row['anno'] == '2015') {
                array_push($arrayCostiTotali, 0);
                array_push($arrayCostiFissi, 0);
                array_push($arrayCostiVariabili, 0);
                array_push($arrayCostiTotali, 0);
                array_push($arrayCostiFissi, 0);
                array_push($arrayCostiVariabili, 0);
                array_push($arrayCostiTotali, $row['costi_totali']);
                array_push($arrayCostiFissi, $row['costi_fissi']);
                array_push($arrayCostiVariabili, $row['costi_variabili']);
            } else if($row['anno'] == '2016') {
                array_push($arrayCostiTotali, 0);
                array_push($arrayCostiFissi, 0);
                array_push($arrayCostiVariabili, 0);
                array_push($arrayCostiTotali, 0);
                array_push($arrayCostiFissi, 0);
                array_push($arrayCostiVariabili, 0);
                array_push($arrayCostiTotali, 0);
                array_push($arrayCostiFissi, 0);
                array_push($arrayCostiVariabili, 0);
                array_push($arrayCostiTotali, $row['costi_totali']);
                array_push($arrayCostiFissi, $row['costi_fissi']);
                array_push($arrayCostiVariabili, $row['costi_variabili']);
            } else if($row['anno'] == '2017') {
                array_push($arrayCostiTotali, 0);
                array_push($arrayCostiFissi, 0);
                array_push($arrayCostiVariabili, 0);
                array_push($arrayCostiTotali, 0);
                array_push($arrayCostiFissi, 0);
                array_push($arrayCostiVariabili, 0);
                array_push($arrayCostiTotali, 0);
                array_push($arrayCostiFissi, 0);
                array_push($arrayCostiVariabili, 0);
                array_push($arrayCostiTotali, 0);
                array_push($arrayCostiFissi, 0);
                array_push($arrayCostiVariabili, 0);
                array_push($arrayCostiTotali, $row['costi_totali']);
                array_push($arrayCostiFissi, $row['costi_fissi']);
                array_push($arrayCostiVariabili, $row['costi_variabili']);
            } else if($row['anno'] == '2018') {
                array_push($arrayCostiTotali, 0);
                array_push($arrayCostiFissi, 0);
                array_push($arrayCostiVariabili, 0);
                array_push($arrayCostiTotali, 0);
                array_push($arrayCostiFissi, 0);
                array_push($arrayCostiVariabili, 0);
                array_push($arrayCostiTotali, 0);
                array_push($arrayCostiFissi, 0);
                array_push($arrayCostiVariabili, 0);
                array_push($arrayCostiTotali, 0);
                array_push($arrayCostiFissi, 0);
                array_push($arrayCostiVariabili, 0);
                array_push($arrayCostiTotali, 0);
                array_push($arrayCostiFissi, 0);
                array_push($arrayCostiVariabili, 0);
                array_push($arrayCostiTotali, $row['costi_totali']);
                array_push($arrayCostiFissi, $row['costi_fissi']);
                array_push($arrayCostiVariabili, $row['costi_variabili']);
            } else if($row['anno'] == '2019') {
                array_push($arrayCostiTotali, 0);
                array_push($arrayCostiFissi, 0);
                array_push($arrayCostiVariabili, 0);
                array_push($arrayCostiTotali, 0);
                array_push($arrayCostiFissi, 0);
                array_push($arrayCostiVariabili, 0);
                array_push($arrayCostiTotali, 0);
                array_push($arrayCostiFissi, 0);
                array_push($arrayCostiVariabili, 0);
                array_push($arrayCostiTotali, 0);
                array_push($arrayCostiFissi, 0);
                array_push($arrayCostiVariabili, 0);
                array_push($arrayCostiTotali, 0);
                array_push($arrayCostiFissi, 0);
                array_push($arrayCostiVariabili, 0);
                array_push($arrayCostiTotali, 0);
                array_push($arrayCostiFissi, 0);
                array_push($arrayCostiVariabili, 0);
                array_push($arrayCostiTotali, $row['costi_totali']);
                array_push($arrayCostiFissi, $row['costi_fissi']);
                array_push($arrayCostiVariabili, $row['costi_variabili']);
            } else if($row['anno'] == '2020') {
                array_push($arrayCostiTotali, 0);
                array_push($arrayCostiFissi, 0);
                array_push($arrayCostiVariabili, 0);
                array_push($arrayCostiTotali, 0);
                array_push($arrayCostiFissi, 0);
                array_push($arrayCostiVariabili, 0);
                array_push($arrayCostiTotali, 0);
                array_push($arrayCostiFissi, 0);
                array_push($arrayCostiVariabili, 0);
                array_push($arrayCostiTotali, 0);
                array_push($arrayCostiFissi, 0);
                array_push($arrayCostiVariabili, 0);
                array_push($arrayCostiTotali, 0);
                array_push($arrayCostiFissi, 0);
                array_push($arrayCostiVariabili, 0);
                array_push($arrayCostiTotali, 0);
                array_push($arrayCostiFissi, 0);
                array_push($arrayCostiVariabili, 0);
                array_push($arrayCostiTotali, 0);
                array_push($arrayCostiFissi, 0);
                array_push($arrayCostiVariabili, 0);
                array_push($arrayCostiTotali, $row['costi_totali']);
                array_push($arrayCostiFissi, $row['costi_fissi']);
                array_push($arrayCostiVariabili, $row['costi_variabili']);
            } else if($row['anno'] == '2021') {
                array_push($arrayCostiTotali, 0);
                array_push($arrayCostiFissi, 0);
                array_push($arrayCostiVariabili, 0);
                array_push($arrayCostiTotali, 0);
                array_push($arrayCostiFissi, 0);
                array_push($arrayCostiVariabili, 0);
                array_push($arrayCostiTotali, 0);
                array_push($arrayCostiFissi, 0);
                array_push($arrayCostiVariabili, 0);
                array_push($arrayCostiTotali, 0);
                array_push($arrayCostiFissi, 0);
                array_push($arrayCostiVariabili, 0);
                array_push($arrayCostiTotali, 0);
                array_push($arrayCostiFissi, 0);
                array_push($arrayCostiVariabili, 0);
                array_push($arrayCostiTotali, 0);
                array_push($arrayCostiFissi, 0);
                array_push($arrayCostiVariabili, 0);
                array_push($arrayCostiTotali, 0);
                array_push($arrayCostiFissi, 0);
                array_push($arrayCostiVariabili, 0);
                array_push($arrayCostiTotali, 0);
                array_push($arrayCostiFissi, 0);
                array_push($arrayCostiVariabili, 0);
                array_push($arrayCostiTotali, $row['costi_totali']);
                array_push($arrayCostiFissi, $row['costi_fissi']);
                array_push($arrayCostiVariabili, $row['costi_variabili']);
            }

        } else {
            array_push($arrayCostiTotali, $row['costi_totali']);
            array_push($arrayCostiFissi, $row['costi_fissi']);
            array_push($arrayCostiVariabili, $row['costi_variabili']);
        }
    }

?>

<!--SCRIPT SITO
<script src="js/sito/pagina_mezzi.js" type="text/javascript"></script>

<script>
$(document).ready(function() {
	$("#tabella_mezzi").load("php/tabella_mezzi.php?data_inizio=<?=$data_inizio?>&data_fine=<?=$data_fine?>");	
});
</script>

<script>
$(document).ready(function() {
	$("#titolo_page").html("Lacerenza | Anagrafica Mezzi");
});
</script>-->

        <div id="page-wrapper">

            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">

                    <!-- TITOLO -->
                    <div class="col-lg-12">
                        <div class="page-title">
                            <h1>Statistiche <small> <?php echo $targa;?></small> <a class="close pull-right" href="pagina_mezzi.php"><i class="fa fa-backward"></i> Indietro</a></h1>
                            <div class="clearfix"></div>
                            <ol class="breadcrumb">
                                <li class="active">
                                    <i class="fa fa-automobile fa-lg"></i> Statistiche mezzo
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
                    <div class="col-lg-12">

                        <br>
                        <canvas id="myChart" width="200" height="200"></canvas>
                    </div>
                </div>

				<br><br>

            </div>

        </div>

    </div>


<!-- footer -->
<?php
	include("footer.php");
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script>
    var chartColors = {
        red: 'rgb(255, 99, 132)',
        orange: 'rgb(255, 159, 64)',
        yellow: 'rgb(255, 205, 86)',
        green: 'rgb(75, 192, 192)',
        blue: 'rgb(54, 162, 235)',
        purple: 'rgb(153, 102, 255)',
        grey: 'rgb(231,233,237)'
    };
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?=json_encode(array_values($arrayAnno));?>,
            datasets: [{
                label: 'Totale costi fissi',
                fill: false,
                data: <?=json_encode(array_values($arrayCostiFissi));?>,
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                ],
                borderColor: [
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255,99,132,1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                ],
                borderWidth: 1
            },
            {
                label: 'Totale costi variabili',
                fill: false,
                data: <?=json_encode(array_values($arrayCostiVariabili));?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                ],
                    borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
            ],
                borderWidth: 1
            },
            {
                label: 'Totale costi spese',
                fill: false,
                data: <?=json_encode(array_values($arrayCostiTotali));?>,
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                ],
                borderWidth: 1
            },
                {
                    label: 'Totale costi Benzina',
                    fill: false,
                    data: <?=json_encode(array_values($arrayCostiBenzina));?>,
                    backgroundColor: [
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                    ],
                    borderColor: [
                        'rgba(153, 102, 255, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                    ],
                    borderWidth: 1
                }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
</script>

</body>

</html>
