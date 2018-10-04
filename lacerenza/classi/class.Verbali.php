<?php

class Verbali
{  
   function __construct()
   {
		$this->num_verbali = 0;   
	}
   
   public function caricaVerbali($id_commessa)
   {
       $query_fatture = "SELECT * FROM tb_verbali WHERE id_commessa = $id_commessa;";
	  $e_query_fatture = EseguiQuery($query_fatture,"selezione");
	  $this->num_verbali = $e_query_fatture->num_rows;
      return $e_query_fatture;
   }
   
   public function eliminaVerbale($id)
   {
       $query_fatture = "DELETE FROM tb_verbali WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       return $e_query_fatture;
   }
   
   
   public function inserisciVerbale($id_commessa, $descrizione, $importo, $data,  $target_path_inserimento, $filename)
   {
       $query_fatture = "INSERT INTO tb_verbali SET id_commessa = '$id_commessa', descrizione='$descrizione', importo='$importo', data = '$data', link_allegato='$target_path_inserimento', nome_allegato='$filename';";
	  $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
      return $e_query_fatture;
   }
   
   public function caricaVerbaleById($id)
   {
       $query_fatture = "SELECT * FROM tb_verbali WHERE id='$id';";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       $this->num_verbali = $e_query_fatture->num_rows;
       return $e_query_fatture;
   }
   
   public function filtraVerbali($filtro, $id_commessa)
   {
       $query_fatture = "SELECT * FROM tb_verbali WHERE descrizione LIKE '%".$filtro."%' AND id_commessa LIKE '$id_commessa';";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       $this->num_verbali = $e_query_fatture->num_rows;
       return $e_query_fatture;
   }
   
   public function modificaVerbale($id, $id_commessa, $descrizione, $importo, $data,  $target_path_modifica, $filename)
   {
       $insert_filename = ($filename != "") ? ", nome_allegato='$filename', link_allegato='$target_path_modifica'" : "";
       $query_fatture = "UPDATE tb_verbali SET descrizione = '$descrizione', importo = '$importo', data = '$data' $insert_filename WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
       return $e_query_fatture;
   }
   
   public function eliminaAllegato($id)
   {
       $query_fatture = "UPDATE tb_verbali SET nome_allegato = '', link_allegato='' WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
       return $e_query_fatture;
   }
  
   public function numeroVerbali()
   {
      return $this->num_verbali;
   }
   
}

?>
