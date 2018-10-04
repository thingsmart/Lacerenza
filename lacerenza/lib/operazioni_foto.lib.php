<?php

$tipo = $_POST['tipo'];

switch($tipo){

	case "elimina_foto":
		$id_commessa = $_POST['id_commessa'];
		$nome = $_POST['nome_file'];
		$cartella = $_POST['cartella'];
			$target_path = "../uploads/commesse/".$id_commessa."/foto/".$cartella."/".$nome;
			if (file_exists($target_path)) { 
				unlink($target_path);
			}
		
		
		echo "OK";
	break;

	case "rinomina_cartella":
		$percorso = $_POST['percorso'];
		$nome = $_POST['nome'];
		$nome_nuovo = $_POST['nome_nuovo'];

		rename($percorso.$nome, $percorso.$nome_nuovo);


		echo "OK";
		break;
	
	case "elimina_tutte_foto":
		$id_commessa = $_POST['id_commessa'];
		$cartella = $_POST['cartella'];
			$dir = "../uploads/commesse/".$id_commessa."/foto/".$cartella."/";
			function rrmdir($dir) {
		   if (is_dir($dir)) {
			 $objects = scandir($dir);
			 foreach ($objects as $object) {
			   if ($object != "." && $object != "..") {
				 if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
			   }
			 }
			 reset($objects);
			 rmdir($dir);
		   }
		 } 
		 rrmdir($dir);
		
		
		echo "OK";
	break;
	
	
	case "allega_foto":
		
			$id_commessa = $_POST['id_commessa'];
			$cartella = $_POST['cartella'];
			for($i=0;$i<count($_FILES["imgs"]["name"]);$i++) 
			{
				$target_path = "../uploads/commesse/".$id_commessa."/foto/".$cartella."/";
				

				//creo cartella se non esiste
				if (!is_dir($target_path)) { 
					$crea = mkdir($target_path, 0777, true);
				}
				
				
					//I think loop goes here 
					move_uploaded_file($_FILES["imgs"]["tmp_name"][$i], "../uploads/commesse/".$id_commessa."/foto/".$cartella."/" . $_FILES["imgs"]["name"][$i]);

					// comprimo immagine
					$img = imagecreatefromjpeg("../uploads/commesse/".$id_commessa."/foto/".$cartella."/" . $_FILES["imgs"]["name"][$i]);
					imagejpeg($img, "../uploads/commesse/".$id_commessa."/foto/".$cartella."/" . $_FILES["imgs"]["name"][$i], 50);


			}
			
			echo $id_commessa;
			break;	
		
		case "crea_cartella":
		
			$id_commessa = $_POST['id_commessa'];
			$cartella = $_POST['cartella'];

			
				$target_path = "../uploads/commesse/".$id_commessa."/foto/".$cartella."/";
				

				//creo cartella se non esiste
				if (!is_dir($target_path)) { 
					$crea = mkdir($target_path, 0777, true);
				}
				
				
				
			
			
			
			
			
			echo "12";
			break;	
		
	
	
}	


?>