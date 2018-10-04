<?php

class Documentazioni
{  
   function __construct()
   {
		$this->num_documentazioni = 0;   
	}
   
   public function caricaDocumentazioni($id_commessa)
   {
       $query_fatture = "SELECT * FROM tb_documentazione WHERE id_commessa = $id_commessa;";
	  $e_query_fatture = EseguiQuery($query_fatture,"selezione");
	  $this->num_documentazioni = $e_query_fatture->num_rows;
      return $e_query_fatture;
   }
   
   public function eliminaDocumentazione($id)
   {
       $query_fatture = "DELETE FROM tb_documentazione WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       return $e_query_fatture;
   }
   
   
   public function inserisciDocumentazione($id_commessa, $descrizione, $data, $target_path_inserimento, $filename)
   {
       $query_fatture = "INSERT INTO tb_documentazione SET id_commessa = '$id_commessa', descrizione='$descrizione', data='$data', link_allegato='$target_path_inserimento', nome_allegato='$filename';";
	  $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
      return $e_query_fatture;
   }
   
   public function caricaDocumentazioneById($id)
   {
       $query_fatture = "SELECT * FROM tb_documentazione WHERE id='$id';";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       $this->num_documentazioni = $e_query_fatture->num_rows;
       return $e_query_fatture;
   }
   
   public function filtraDocumentazione($filtro, $id_commessa)
   {
       $query_fatture = "SELECT * FROM tb_documentazione WHERE id_commessa LIKE '$id_commessa' AND descrizione LIKE '%".$filtro."%';";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       $this->num_documentazioni = $e_query_fatture->num_rows;
       return $e_query_fatture;
   }
   
   public function modificaDocumentazione($id, $id_commessa, $descrizione, $data, $target_path_modifica, $filename)
   {
       $insert_filename = ($filename != "") ? ", nome_allegato='$filename', link_allegato='$target_path_modifica'" : "";
       $query_fatture = "UPDATE tb_documentazione SET descrizione = '$descrizione', data = '$data' $insert_filename WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
       return $e_query_fatture;
   }
   
   public function eliminaAllegato($id)
   {
       $query_fatture = "UPDATE tb_documentazione SET nome_allegato = '', link_allegato='' WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
       return $e_query_fatture;
   }
  
   public function numeroDocumentazioni()
   {
      return $this->num_documentazioni;
   }
   
}

?>
