<?php
require_once("../classi/class.Allegati.php");
require_once("../databases/db_function.php");



	$id = $_POST["id"];
	$id_allegato = $_POST["id_allegato"];
	$nome = $_POST["nome"];
	$tipo = $_POST["tipo"];
	$cartella = $_POST["cartella"];
	
	//elimino allegato da db
	$allegato = new Allegati();
	$res = $allegato->eliminaAllegato($id_allegato);
	
	if($res == 1){
		//elimino fisicamente l'allegato
		$target_path = "../uploads/".$cartella."/".$id."/".$tipo."/".$nome;
		unlink($target_path);
	}
	
	echo $res;
?>