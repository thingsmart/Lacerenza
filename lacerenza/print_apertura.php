<?php

require_once('dompdf/autoload.inc.php');

include("databases/db_function.php");
require_once("classi/class.Commesse.php");

$idcommessa = $_GET['id'];

$commesse = new Commesse();
$e_query_commessa = $commesse->caricaCommesseById( $idcommessa );
$datiCommessa = $e_query_commessa->fetch_array();

$datifiscali = "";
if($datiCommessa['pi'] != '') { $datifiscali .= "<br>".$datiCommessa['pi']; }

ob_start();

?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset='utf-8'>
        <title>Apertura Cantiere</title>
        <link type="text/css" rel="stylesheet"href="css/style-pdf.css"/>
    </head>

    <body>

    <table class="head container">
        <tr>
            <td class="header">
<!--                <img src="content/backend/img/user-8.jpg">-->
            </td>
            <td class="shop-info">
                <div class="shop-name">
                    <h1>Lacerenza Isolanti s.r.l</h1>
                    <h2>Apertura Cantiere</h2>
                    <h3>Committente</h3>
                    <?php echo $datiCommessa['referente']."<br>".$datiCommessa['indirizzo_referente'].$datifiscali;?>
                    <br><br>
                    <h3>Cantiere</h3>
                    <?php echo $datiCommessa['cantiere']."<br>".$datiCommessa['localita']?>
                    <br><br>
                    <h3>Durata Lavori</h3>
                    <?php echo "dal ".$datiCommessa['data_inizio']." al ".$datiCommessa['datafine'];?>
                    <br><br>
                    <h3>Lavori di</h3>
                    <?php echo $datiCommessa['tipologia_lavori'];?>
                    <br><br>
                    <h3>Importo Lavori</h3>
                    <?php echo $datiCommessa['importo']." €";?>
                    <br><br>
                    <h3>Numero Operai</h3>
                    <?php echo $datiCommessa['numero_dipendenti'];?>
                    <br><br>
                </div>

            </td>
        </tr>
    </table>

    </body>

    </html>

<?php



?>

<?php

use Dompdf\Dompdf;
use Dompdf\Options;

$dompdf = new Dompdf();

$html = ob_get_clean();

$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'portrait');

$options = new Options();
$options->setIsRemoteEnabled(true);

$dompdf->setOptions($options);

$dompdf->render();

$dompdf->stream("apertura_cantiere.pdf");

?>