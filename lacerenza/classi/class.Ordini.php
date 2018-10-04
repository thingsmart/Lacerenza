<?php

class Ordini
{  
   function __construct()
   {
		$this->num_ordini = 0;   
	}
   
   public function caricaOrdini($id_commessa)
   {
       $query_fatture = "SELECT * FROM tb_ordini WHERE id_commessa = $id_commessa;";
	  $e_query_fatture = EseguiQuery($query_fatture,"selezione");
	  $this->num_ordini = $e_query_fatture->num_rows;
      return $e_query_fatture;
   }
   
   public function eliminaOrdine($id)
   {
       $query_fatture = "DELETE FROM tb_ordini WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       return $e_query_fatture;
   }
   
   
   public function inserisciOrdine($id_commessa, $descrizione, $target_path_inserimento, $filename)
   {
       $query_fatture = "INSERT INTO tb_ordini SET id_commessa = '$id_commessa', descrizione='$descrizione', link_allegato='$target_path_inserimento', nome_allegato='$filename';";
	  $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
      return $e_query_fatture;
   }
   
   public function caricaOrdineById($id)
   {
       $query_fatture = "SELECT * FROM tb_ordini WHERE id='$id';";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       $this->num_ordini = $e_query_fatture->num_rows;
       return $e_query_fatture;
   }
   
   public function filtraOrdine($filtro, $id_commessa)
   {
       $query_fatture = "SELECT * FROM tb_ordini WHERE id_commessa LIKE '$id_commessa' AND (nome_allegato LIKE '%".$filtro."%' OR descrizione LIKE '%".$filtro."%');";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       $this->num_ordini = $e_query_fatture->num_rows;
       return $e_query_fatture;
   }
   
   public function modificaOrdine($id, $descrizione, $target_path_modifica, $filename)
   {
       $insert_filename = ($filename != "") ? ", nome_allegato='$filename', link_allegato='$target_path_modifica'" : "";
       $query_fatture = "UPDATE tb_ordini SET descrizione = '$descrizione' $insert_filename WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
       return $e_query_fatture;
   }
   
   public function eliminaAllegato($id)
   {
       $query_fatture = "UPDATE tb_ordini SET nome_allegato = '', link_allegato='' WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
       return $e_query_fatture;
   }
  
   public function numeroOrdini()
   {
      return $this->num_ordini;
   }
   
}

?>
