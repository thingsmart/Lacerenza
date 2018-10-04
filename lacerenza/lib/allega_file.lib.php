<?php
	require_once("../classi/class.Allegati.php");
	require_once("../databases/db_function.php");
	require_once("../lib/verificaConvertiData.php");
	
	//id del file da allegare
	$id = $_POST["id"];
	$descrizione = $_POST["descrizione"];
	$verbale_n = $_POST["verbale_n"];
	$tipo = $_POST["tipo"];
	$cartella = $_POST["cartella"];
	$data = $_POST["data"];
	$data = CapovolgiData($data);
	//perorso dove fare upload file
	$target_path = "../uploads/".$cartella."/".$id."/".$tipo."/";
	
	//nome del file
	$filename = $_FILES['files']['name'];
	$filename_allegato = $filename;
    
	$link_allegato = "uploads/".$cartella."/".$id."/".$tipo."/".$filename;
    
		if($filename != ""){
            if (file_exists("../".$link_allegato)) { 
                $filename_allegato = date("d_m_Y_h_i_s").$filename_allegato;
                $link_allegato = "uploads/".$cartella."/".$id."/".$tipo."/".$filename_allegato;
            }
$allegato = new Allegati();
$res = $allegato->inserisciAllegato(1, $descrizione, $verbale_n, $link_allegato, $id, $filename_allegato, $data);
	

		//creo cartella se non esiste
		if (!is_dir($target_path)) { 
			$crea = mkdir($target_path, 0777, true);
		}
		
		//elimino file caricati prima
		  $link_file = "../uploads/".$cartella."/".$id."/".$tipo."/".$filename;
          if (file_exists($link_file)) { 
              $filename = date("d_m_Y_h_i_s").$filename;
              $link_file = "../uploads/".$cartella."/".$id."/".$tipo."/".$filename;
          }
		move_uploaded_file($_FILES["files"]["tmp_name"], $link_file);
	}
	echo $filename;
	
?>