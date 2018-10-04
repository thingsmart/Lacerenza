<?php
session_start();
include ("lib/controllaSessione.php");
require_once("lib/funzioni_sito.php");

$iphone = (bool) strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$ipad = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPad');
$ipod = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPod');
$android = (bool) strpos($_SERVER['HTTP_USER_AGENT'],"Android");
$webos = (bool) strpos($_SERVER['HTTP_USER_AGENT'],"WebOS");

$verifica = "-1";
//if(!$ipad && !$iphone && !$android && !$webos && !$ipod){
if($ipad || $iphone || $android || $webos || $ipod){
 $verifica = "-1";
}else{

$verifica = "1";

}


$browser = preg_match('/(?i)msie/', $_SERVER['HTTP_USER_AGENT']);
//0 firefox, 1 ie

$ruolo = $_SESSION['ruolo'];

$idutente = $_SESSION['id_utente'];

//if($ruolo == "SUPERADMIN") {
////if($ruolo == "ADMIN" AND $idutente == "32") {
//	$esito_ip = "OK";
//} else {
//	$ip_navigazione = get_client_ip();
//	//$esito_ip = ip_in_range($ip_navigazione, "95.226.185.0", "95.226.185.254");
//	$esito_ip = ip_in_range($ip_navigazione, "192.168.0.0", "192.168.0.255");
//}


if($ruolo == "SUPERADMIN") {
	$esito_ip = "OK";
} else {
	$ip_navigazione = get_client_ip();
	//$esito_ip = ip_in_range($ip_navigazione, "95.226.185.0", "95.226.185.254");
	$esito_ip = ip_in_range($ip_navigazione, "127.0.0.1", "127.0.0.255");
}

//echo $verifica. " : ".$ip_navigazione. " ".$esito_ip; exit;

?>
<!DOCTYPE html>
<html lang="it">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title id="titolo_page">Lacerenza</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="css/no-more-tables.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <link href="css/aggiornamenti/jquery-ui/jquery-ui.css" type="text/css" rel="stylesheet" media="all">

    <!--SELECT TAG-->
    <!-- <link href="css/select/chosen.css" rel="stylesheet"> -->

    <!--Select tags-->
    <link href="css/plugins/chosen/chosen.css" rel="stylesheet">

    <!-- Editor Testo -->
    <link href="css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="css/plugins/summernote/summernote-bs3.css" rel="stylesheet">


    <!-- Morris Charts JavaScript
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>
    -->
    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>
    <!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script> -->

    <script type="text/javascript" src="css/aggiornamenti/jquery-ui/jquery-ui.js"></script>

<!--COLOR PICKER-->
	<link rel="stylesheet" href="css/colorpicker.css" type="text/css" />
    <link rel="stylesheet" media="screen" type="text/css" href="css/layout.css" />
	<!-- <script type="text/javascript" src="js/jquery_picker.js"></script> -->
	<script type="text/javascript" src="js/colorpicker.js"></script>
    <script type="text/javascript" src="js/eye.js"></script>
    <script type="text/javascript" src="js/utils.js"></script>
    <script type="text/javascript" src="js/layout.js?ver=1.0.2"></script>
<!--FINE COLOR PICKER-->

<!--TAG INPUT-->
<script type="text/javascript" src="js/tags/bootstrap-tagsinput.js"></script>
<!-- <script type="text/javascript" src="js/tags/bootstrap-tagsinput-angular.js"></script> -->
<script type="text/javascript" src="js/tags/tags.js"></script>
<link rel="stylesheet" type="text/css" href="css/tags/bootstrap-tagsinput.css" />
<!--TAG INPUT-->
    <!-- Javascript -->
	<script src="js/md5.min.js" type="text/javascript" ></script>
    <script src="js/JQuery/jquery.form.js" type="text/javascript"></script>
	<script src="js/JQuery/jquery.validate.min.js" type="text/javascript"></script>
    <script src="js/JQuery/jquery.cookie.min.js" type="text/javascript" ></script>
	<script src="js/isNumber.js" type="text/javascript"></script>
    <script src="js/bootstrap/bootstrap-datepicker.min.js"></script>
    <script src="js/bootstrap/locales/bootstrap-datepicker.it.js"></script>

    <script src="js/bootstrap.min.js"></script>

	<link href="css/datepicker.css" rel="stylesheet">
    <link href="less/datepicker.less" rel="stylesheet" type="text/css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Chosen -->
    <script src="js/plugins/chosen/chosen.jquery.js"></script>
	<script src="js/plugins/jasny/jasny-bootstrap.min.js"></script>

    <!-- Editor Testo -->
    <script src="js/plugins/summernote/summernote.min.js"></script>
    <script src="js/plugins/summernote/lang/summernote-it-IT.js"></script>


<script>
	$(document).ready(function() {
		$("#ul_log").load("php/ul_log.php");

		//barra_sinistra
		document.getElementById("barra_sinistra").style.height=$(window).height()-40+"px";
	});
</script>

<style>
	.navbar-header{
		height:55px;
	}
</style>
</head>

<body>
<!--Messaggio di successo | errore-->
       <div id="messaggi_errore" style="z-index:10">
                              <div class="alert alert-success" id="messaggio" style="display:none; font-size:10px; text-align:center; background:#65e86e; color:black; border-radius:0; opacity:0.7">
                                <strong id="contenuto_messaggio"></strong>
                              </div>
                              <div class="alert alert-danger" id="messaggio_errore" style="display:none;  text-align:center; background:red; color:white; border-radius:0; opacity:0.6">
                                Salvataggio effettuato
                              </div>
                            </div>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand"><i class="fa fa-building-o fa-lg"></i><i class="fa fa-building-o fa-2x"></i><i class="fa fa-building-o"></i> <font style="font-size: 25px;">Lacerenza</font>
                	<small id="nome_commessa"></small>
                </a>
            </div>

            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
            	 <? if($ruolo  == "ADMIN"){ ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown" id="ul_log">

                    </ul>
                </li>
                <? } ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?=$_SESSION['username'] ?> </a>
                </li>
                <!--MENU CANTIERE-->
                <?php if(basename($_SERVER['PHP_SELF']) == "pagina_fatture.php" || basename($_SERVER['PHP_SELF']) == "pagina_documenti_cliente.php" || basename($_SERVER['PHP_SELF']) == "pagina_contratti.php" || basename($_SERVER['PHP_SELF']) == "pagina_revisioni_contrattuali.php" || basename($_SERVER['PHP_SELF']) == "pagina_polizze.php" || basename($_SERVER['PHP_SELF']) == "pagina_verbali.php" || basename($_SERVER['PHP_SELF']) == "pagina_documentazioni.php" || basename($_SERVER['PHP_SELF']) == "pagina_noleggi.php" || basename($_SERVER['PHP_SELF']) == "pagina_ordini.php" || basename($_SERVER['PHP_SELF']) == "pagina_riserve.php" || basename($_SERVER['PHP_SELF']) == "pagina_attivita.php"  || basename($_SERVER['PHP_SELF']) == "pagina_regolarita.php"){?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-book"></i> Contratto <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_revisioni_contrattuali.php?id=<?=$_SESSION['id_commessa'] ?>"><i class="fa fa-fw fa-check" style="z-index:10"></i> Rev. Contratto</a>
                            <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_polizze.php?id=<?=$_SESSION['id_commessa'] ?>"><i class="fa fa-fw fa-check" style="z-index:10"></i> Ges. Polizze</a>
                            <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_verbali.php?id=<?=$_SESSION['id_commessa'] ?>"><i class="fa fa-fw fa-check" style="z-index:10"></i> Verbali lavori</a>
                            <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_fatture.php?id=<?=$_SESSION['id_commessa'] ?>"><i class="fa fa-fw fa-check" style="z-index:10"></i> Fatture</a>
                            <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_documenti_cliente.php?id=<?=$_SESSION['id_commessa'] ?>"><i class="fa fa-fw fa-check" style="z-index:10"></i> Doc. cliente</a>
                            <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_documentazioni.php?id=<?=$_SESSION['id_commessa'] ?>"><i class="fa fa-fw fa-check" style="z-index:10"></i> Doc. cantiere</a>
                            <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_noleggi.php?id=<?=$_SESSION['id_commessa'] ?>"><i class="fa fa-fw fa-check" style="z-index:10"></i> Noleggi</a>
                            <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_ordini.php?id=<?=$_SESSION['id_commessa'] ?>"><i class="fa fa-fw fa-check" style="z-index:10"></i> Ordini Lavori</a>
                            <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_riserve.php?id=<?=$_SESSION['id_commessa'] ?>"><i class="fa fa-fw fa-check" style="z-index:10"></i> Riserve</a>
                            <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_attivita.php?id=<?=$_SESSION['id_commessa'] ?>"><i class="fa fa-fw fa-check" style="z-index:10"></i>Att. a Terzi</a>
                            <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_regolarita.php?id=<?=$_SESSION['id_commessa'] ?>"><i class="fa fa-fw fa-check" style="z-index:10"></i>Reg. Contrib.</a>
                        </li>
                    </ul>
                </li>
                <? } ?>
                <!--FINE MENU CANTIERE-->
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->

            <? if($esito_ip == "OK") { ?>

	            <div class="collapse navbar-collapse navbar-ex1-collapse">
	                <ul id="barra_sinistra" class="nav navbar-nav side-nav" style="overflow:auto;">

	                    <li <?php if (basename($_SERVER['PHP_SELF']) == "home.php") { echo 'class="active"'; } ?>>
	                        <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="home.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
	                    </li>

						<? if($ruolo == "SUPERADMIN" || $ruolo == "ADMIN" ){?>

		                    <li <?php if (basename($_SERVER['PHP_SELF']) == "utenti.php") {echo 'class="active"'; } ?>>
		                        <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="utenti.php"><i class="fa fa-fw fa-users"></i> Utenti</a>
		                    </li>

						<? } ?>

						<? if($ruolo == "SUPERADMIN" || $ruolo == "ADMIN" || $ruolo  == "COMMESSA"){ ?>

		                    <li <?php if (basename($_SERVER['PHP_SELF']) == "commesse.php" || basename($_SERVER['PHP_SELF']) == "nuova_commessa.php") { echo 'class="active"'; } ?>>
		                        <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="commesse.php"><i class="fa fa-fw fa-tasks"></i> Commesse</a>
		                    </li>

		                    <?php if(basename($_SERVER['PHP_SELF']) != "home.php" && basename($_SERVER['PHP_SELF']) != "commesse.php" && basename($_SERVER['PHP_SELF']) != "utenti.php" && basename($_SERVER['PHP_SELF']) != "nuova_commessa.php" && basename($_SERVER['PHP_SELF']) != "pagina_log.php" && basename($_SERVER['PHP_SELF']) != "pagina_mezzi.php" && basename($_SERVER['PHP_SELF']) != "nuovo_mezzo.php" && basename($_SERVER['PHP_SELF']) != "modifica_utente.php" && basename($_SERVER['PHP_SELF']) != "pagina_tagliandi.php" && basename($_SERVER['PHP_SELF']) != "nuovo_tagliando.php" && basename($_SERVER['PHP_SELF']) != "pagina_spese.php" && basename($_SERVER['PHP_SELF']) != "nuova_spesa.php" && basename($_SERVER['PHP_SELF']) != "pagina_cerca_allegato.php" && basename($_SERVER['PHP_SELF']) != "pagina_benzina.php" && basename($_SERVER['PHP_SELF']) != "nuova_benzina.php" && basename($_SERVER['PHP_SELF']) != "pagina_dipendenti.php" && basename($_SERVER['PHP_SELF']) != "nuovo_dipendente.php" && basename($_SERVER['PHP_SELF']) != "ruolino.php" && basename($_SERVER['PHP_SELF']) != "pagina_presenze.php" && basename($_SERVER['PHP_SELF']) != "costo_dipendenti.php" && basename($_SERVER['PHP_SELF']) != "stampa.php" && basename($_SERVER['PHP_SELF']) != "pagina_programmazione_cantiere.php" && basename($_SERVER['PHP_SELF']) != "ruolino_giornaliero.php" && basename($_SERVER['PHP_SELF']) != "pagina_tecnica.php" && basename($_SERVER['PHP_SELF']) != "nuovo_ruolino_giornaliero.php" && basename($_SERVER['PHP_SELF']) != "pagina_lavori.php" && basename($_SERVER['PHP_SELF']) != "nuovo_lavoro.php" && basename($_SERVER['PHP_SELF']) != "nuova_programmazione_cantiere.php" && basename($_SERVER['PHP_SELF']) != "magazzino.php" && basename($_SERVER['PHP_SELF']) != "nuovo_magazzino.php" && basename($_SERVER['PHP_SELF']) != "comunicazioni.php" && basename($_SERVER['PHP_SELF']) != "nuova_comunicazione.php" && basename($_SERVER['PHP_SELF']) != "manutenzione.php" && basename($_SERVER['PHP_SELF']) != "nuova_merce.php" && basename($_SERVER['PHP_SELF']) != "pagina_tecnica_prima.php" && basename($_SERVER['PHP_SELF']) != "pagina_gare.php"  && basename($_SERVER['PHP_SELF']) != "nuova_gara.php"  && basename($_SERVER['PHP_SELF']) != "nuova_tecnica.php" && basename($_SERVER['PHP_SELF']) != "stampa_ruolino_data.php" && basename($_SERVER['PHP_SELF']) != "pagina_manutenzione.php"  && basename($_SERVER['PHP_SELF']) != "pagina_preventivi.php" && basename($_SERVER['PHP_SELF']) != "pagina_modelli.php" && basename($_SERVER['PHP_SELF']) != "pagina_sezioni.php" && basename($_SERVER['PHP_SELF']) != "pagina_riepilogo_preventivi.php" && basename($_SERVER['PHP_SELF']) != "nuova_sezione.php" && basename($_SERVER['PHP_SELF']) != "nuovo_modello.php" && basename($_SERVER['PHP_SELF']) != "dettagli_modello.php" && basename($_SERVER['PHP_SELF']) != "nuovo_preventivo.php" && basename($_SERVER['PHP_SELF']) != "dettagli_preventivo.php" && basename($_SERVER['PHP_SELF']) != "edit_testo.php"){?>

		                    <li class="active">

		                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Commessa<i class="fa fa-fw fa-caret-down"></i></a>

		                        <ul id="demo" class="collapse in">

		                            <li <?php if (basename($_SERVER['PHP_SELF']) == "dettaglio_commessa.php" || basename($_SERVER['PHP_SELF']) == "apertura_cantiere.php" || basename($_SERVER['PHP_SELF']) == "nuova_commessa.php") {echo 'class="attivo"'; } ?>>
		                                <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="dettaglio_commessa.php?id=<?=$_SESSION['id_commessa'] ?>"> Dati Cantiere</a>
		                            </li>

                                    <li <?php if (basename($_SERVER['PHP_SELF']) == "dettaglio_commessa.php" || basename($_SERVER['PHP_SELF']) == "nuova_commessa.php") {echo 'class="attivo"'; } ?>>
                                        <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="apertura_cantiere.php?id=<?=$_SESSION['id_commessa'] ?>"> Apertura Cantiere</a>
                                    </li>

		                            <li <?php if (basename($_SERVER['PHP_SELF']) == "pagina_contratti.php") {echo 'class="attivo"'; } ?>>
		                                <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_contratti.php?id=<?=$_SESSION['id_commessa'] ?>"> Tecnica</a>
		                            </li>

		                            <li <?php if (basename($_SERVER['PHP_SELF']) == "costo.php") {echo 'class="attivo"'; } ?>>
		                                <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="costo.php?id=<?=$_SESSION['id_commessa'] ?>"> Costo Materiale</a>
		                            </li>

		                            <li <?php if (basename($_SERVER['PHP_SELF']) == "pagina_materiali_esterni.php") {echo 'class="attivo"'; } ?>>
		                                <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_materiali_esterni.php?id=<?=$_SESSION['id_commessa'] ?>"> Costo Forniture Esterne</a>
		                            </li>

		                            <li <?php if (basename($_SERVER['PHP_SELF']) == "costo_operai.php") {echo 'class="attivo"'; } ?>>
		                                <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="costo_operai.php?id=<?=$_SESSION['id_commessa'] ?>"> Costo Manodopera</a>
		                            </li>

		                            <li>
		                                <a <?php if (basename($_SERVER['PHP_SELF']) == "pagina_contabilita.php") {echo 'class="attivo"'; } ?>
		                                	<? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_contabilita.php?id=<?=$_SESSION['id_commessa'] ?>"> Amministrazione Contabilit&agrave;</a>
		                            </li>

		                            <li>
		                                <a <?php if (basename($_SERVER['PHP_SELF']) == "pagina_ordini_commessa.php") {echo 'class="attivo"'; } ?>
		                                	<? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_ordini_commessa.php?id=<?=$_SESSION['id_commessa'] ?>"> Ordini e Preventivi</a>
		                            </li>

		                            <li>
		                                <a <?php if (basename($_SERVER['PHP_SELF']) == "cartelle_foto.php") {echo 'class="attivo"'; } ?>
		                                	<? if($verifica == -1){ echo 'target="_blank"'; } ?> href="cartelle_foto.php?id=<?=$_SESSION['id_commessa'] ?>"> Foto</a>
		                            </li>

		                            <li>
		                                <a <?php if (basename($_SERVER['PHP_SELF']) == "pagina_comunicazioni.php") {echo 'class="attivo"'; } ?>
		                                	<? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_comunicazioni.php?id=<?=$_SESSION['id_commessa'] ?>"> Comunicazioni</a>
		                            </li>

		                            <li>
		                                <a <?php if (basename($_SERVER['PHP_SELF']) == "ruolino_commessa.php") {echo 'class="attivo"'; } ?>
		                                	<? if($verifica == -1){ echo 'target="_blank"'; } ?> href="ruolino_commessa.php?id=<?=$_SESSION['id_commessa'] ?>"> Ruolino</a>
		                            </li>

		                            <li>
		                                <a <?php if (basename($_SERVER['PHP_SELF']) == "riepilogo_commessa.php") {echo 'class="attivo"'; } ?>
		                                	<? if($verifica == -1){ echo 'target="_blank"'; } ?> href="riepilogo_commessa.php?id=<?=$_SESSION['id_commessa'] ?>"> Monitoraggio costi commessa</a>
		                            </li>

		                            <!--<li <?php if(basename($_SERVER['PHP_SELF']) == "pagina_personale.php"){echo 'class="attivo"';}?>>
		                                <a href="pagina_personale.php?id_commessa=<?=$_SESSION['id_commessa']?>">Personale</a>
		                            </li>-->
		                            <!-- <li <?php
										if (basename($_SERVER['PHP_SELF']) == "pagina_veicoli.php") {echo 'class="attivo"';
										}
									?>>
		                                <a href="pagina_veicoli.php?id_commessa=<?=$_SESSION['id_commessa'] ?>">Mezzi</a>
		                            </li> -->
		                        </ul>
		                    </li>
		                    <? } ?>

	                    <? } ?>

	                    <? if($ruolo == "SUPERADMIN" || $ruolo  == "ADMIN" || $ruolo  == "MEZZI"){ ?>

		                    <li <?php if (basename($_SERVER['PHP_SELF']) == "pagina_mezzi.php") {echo 'class="active"'; } ?>>
		                        <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_mezzi.php"><i class="fa fa-fw fa-truck"></i> Anagrafica Mezzi</a>
		                    </li>

	                    <? } ?>

	                    <? if($ruolo == "SUPERADMIN" || $ruolo  == "ADMIN" || $ruolo == "PERSONALE_RUOLINO"){ ?>

		                    <li <?php if (basename($_SERVER['PHP_SELF']) == "pagina_dipendenti.php") {echo 'class="active"'; } ?>>
		                        <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_dipendenti.php"><i class="fa fa-fw fa-user"></i> Dipendenti</a>
		                    </li>

	                    <? } ?>

	                    <li <?php if (basename($_SERVER['PHP_SELF']) == "pagina_programmazione_cantiere.php") {echo 'class="active"'; } ?>>
	                        <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_programmazione_cantiere.php"><i class="fa fa-fw fa-clock-o"></i> Programmazione</a>
	                    </li>

	                    <li <?php if (basename($_SERVER['PHP_SELF']) == "ruolino_giornaliero.php") {echo 'class="active"'; } ?>>
	                        <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="ruolino_giornaliero.php"><i class="fa fa-fw fa-cubes"></i> Ruolino giornaliero</a>
	                    </li>

	                    <li <?php if (basename($_SERVER['PHP_SELF']) == "pagina_preventivi.php" || basename($_SERVER['PHP_SELF']) == "pagina_modelli.php" || basename($_SERVER['PHP_SELF']) == "pagina_sezioni.php" || basename($_SERVER['PHP_SELF']) == "pagina_riepilogo_preventivi.php") {echo 'class="active"'; } ?>>
	                        <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_preventivi.php"><i class="fa fa-fw fa-file-pdf-o"></i> Preventivi</a>
	                    </li>

	                     <? if($ruolo != "MAGAZZINIERE"){?>

		                    <li <?php if (basename($_SERVER['PHP_SELF']) == "pagina_tecnica_prima.php") {echo 'class="active"'; } ?>>
		                        <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_tecnica_prima.php"><i class="fa fa-fw fa-suitcase"></i> Tecnica</a>
		                    </li>

	                    <? } ?>

	                     <? if($ruolo != "MAGAZZINIERE"){?>

		                    <li <?php if (basename($_SERVER['PHP_SELF']) == "pagina_lavori.php") {echo 'class="active"'; } ?>>
		                        <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_lavori.php"><i class="fa fa-fw fa-wrench"></i> Scheda di montaggio</a>
		                    </li>

	                    <? } ?>

	                    <!-- <li <?php
							if (basename($_SERVER['PHP_SELF']) == "pagina_cerca_allegato.php") {echo 'class="active"';
							}
						?>>
	                        <a href="pagina_cerca_allegato.php"><i class="fa fa-fw fa-search"></i> Cerca allegati</a>
	                    </li> -->

	                    <li <?php if (basename($_SERVER['PHP_SELF']) == "magazzino.php") {echo 'class="active"'; } ?>>
	                        <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="magazzino.php"><i class="fa fa-fw fa-building"></i> Carico Giornaliero</a>
	                    </li>

	                     <? if($ruolo != "MAGAZZINIERE"){ ?>

		                    <li <?php if (basename($_SERVER['PHP_SELF']) == "comunicazioni.php") {echo 'class="active"'; } ?>>
		                        <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="comunicazioni.php"><i class="fa fa-fw fa-envelope"></i> Comunicazioni</a>
		                    </li>

	                    <? } ?>

	                    <? if($ruolo  != "ADMIN") {?>

		                    <li <?php if (basename($_SERVER['PHP_SELF']) == "utenti.php") {echo 'class="active"'; } ?>>
		                        <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="utenti.php"><i class="fa fa-fw fa-user"></i> Profilo</a>
		                    </li>

	                    <? } ?>

	                     <!-- <? if($ruolo == "SUPERADMIN" || $ruolo  == "ADMIN"){ ?>
	                    <li <?php
							if (basename($_SERVER['PHP_SELF']) == "pagina_log.php") {echo 'class="active"';
							}
						?>>
	                        <a href="pagina_log.php"><i class="fa fa-fw fa-list"></i> Log</a>
	                    </li>
	                    <? } ?> -->
	                     <? if($ruolo != "MAGAZZINIERE"){ ?>

		                    <li <?php if (basename($_SERVER['PHP_SELF']) == "ruolino.php") {echo 'class="active"'; } ?>>
		                        <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="ruolino.php"><i class="fa fa-fw fa-check-square"></i> Presenze</a>
		                    </li>

	                    <? } ?>

	                     <? if($ruolo != "MAGAZZINIERE"){ ?>

		                     <li <?php if (basename($_SERVER['PHP_SELF']) == "stampa.php") {echo 'class="active"'; } ?>>
		                        <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="stampa.php"><i class="fa fa-fw fa-print"></i> Costi manodopera</a>
		                    </li>

	                    <? } ?>

	                     <? if($ruolo != "MAGAZZINIERE"){ ?>

		                    <li <?php if (basename($_SERVER['PHP_SELF']) == "stampa_ruolino.php") {echo 'class="active"'; } ?>>
		                        <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="stampa_ruolino_data.php"><i class="fa fa-fw fa-print"></i> Stampa Ruolino</a>
		                    </li>

	                    <? } ?>

						<? if($ruolo != "MAGAZZINIERE"){?>

		                    <li <?php if (basename($_SERVER['PHP_SELF']) == "pagina_manutenzione.php") {echo 'class="active"'; } ?>>
		                        <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_manutenzione.php"><i class="fa fa-fw fa-gears"></i> Manutenzione</a>
		                    </li>

	                    <? } ?>

	                    <li >
	                        <a  href="lib/logout.lib.php"><i class="fa fa-fw fa-power-off"></i> Esci</a>
	                    </li>

	                </ul>

	            </div>

            <? } else {?>

	            <div class="collapse navbar-collapse navbar-ex1-collapse">

	                <ul id="barra_sinistra" class="nav navbar-nav side-nav" style="overflow:auto;">

	                    <li <?php if (basename($_SERVER['PHP_SELF']) == "home.php") {echo 'class="active"'; } ?>>
	                        <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="home.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
	                    </li>

	                    <li <?php if (basename($_SERVER['PHP_SELF']) == "pagina_programmazione_cantiere.php") {echo 'class="active"'; } ?>>
	                        <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_programmazione_cantiere.php"><i class="fa fa-fw fa-clock-o"></i> Programmazione</a>
	                    </li>

	                    <li <?php if (basename($_SERVER['PHP_SELF']) == "ruolino_giornaliero.php") {echo 'class="active"'; } ?>>
	                        <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="ruolino_giornaliero.php"><i class="fa fa-fw fa-cubes"></i> Ruolino giornaliero</a>
	                    </li>

	                    <li <?php if (basename($_SERVER['PHP_SELF']) == "pagina_preventivi.php" || basename($_SERVER['PHP_SELF']) == "pagina_modelli.php" || basename($_SERVER['PHP_SELF']) == "pagina_sezioni.php" || basename($_SERVER['PHP_SELF']) == "pagina_riepilogo_preventivi.php") {echo 'class="active"'; } ?>>
	                        <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_preventivi.php"><i class="fa fa-fw fa-file-pdf-o"></i> Preventivi</a>
	                    </li>

	                    <li >
	                        <a  href="lib/logout.lib.php"><i class="fa fa-fw fa-power-off"></i> Esci</a>
	                    </li>

	                </ul>

	            </div>

            <? } ?>

        </nav>



