<?php
<?php
/**
 * HTML2PDF Librairy - example
 *
 * HTML => PDF convertor
 * distributed under the LGPL License
 *
 * @author      Laurent MINGUET <webmaster@html2pdf.fr>
 *
 * isset($_GET['vuehtml']) is not mandatory
 * it allow to display the result in the HTML format
 */
require_once('pdf/html2pdf.class.php');

$id = $_GET['id'];
$page = $_GET['page'];

// get the HTML
ob_start();
include($page . ".php");
$content = ob_get_clean();

try {
	// init HTML2PDF
	$html2pdf = new HTML2PDF('P', 'A4', 'it', true, 'UTF-8', array(1, 0, 0, -5));

	// display the full page
	$html2pdf->pdf->SetDisplayMode('fullpage');
	$html2pdf->AddFont('times', 'normal', 'times.php');
	$html2pdf->setDefaultFont('times');
	// convert
	$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
	//$html2pdf->setDefaultFont("Times New Roman");

	// add the automatic index
	//$html2pdf->createIndex('Sommaire', 30, 12, false, true, 2);
	//$html2pdf->createIndex('', 25, 12, false, false, 1);

	// send the PDF
	$html2pdf->Output($page.'.pdf');
	/*Salvo documento su server*/
//	$html2pdf->Output('../download/' . $a . '.pdf', 'F');
} catch (HTML2PDF_exception $e) {
	echo $e;
	exit;
}



