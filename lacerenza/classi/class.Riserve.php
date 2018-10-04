<?php

class Riserve
{  
   function __construct()
   {
		$this->num_riserve = 0;   
	}
   
   public function caricaRiserve($id_commessa)
   {
       $query_fatture = "SELECT * FROM tb_riserve WHERE id_commessa = $id_commessa;";
	  $e_query_fatture = EseguiQuery($query_fatture,"selezione");
	  $this->num_riserve = $e_query_fatture->num_rows;
      return $e_query_fatture;
   }
   
   public function eliminaRiserva($id)
   {
       $query_fatture = "DELETE FROM tb_riserve WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       return $e_query_fatture;
   }
   
   
   public function inserisciRiserva($id_commessa, $descrizione, $dettagli, $data, $target_path_inserimento, $filename)
   {
       $query_fatture = "INSERT INTO tb_riserve SET dettagli='$dettagli',id_commessa = '$id_commessa', descrizione='$descrizione', data = '$data', link_allegato='$target_path_inserimento', nome_allegato='$filename';";
	  $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
      return $e_query_fatture;
   }
   
   public function caricaRiservaById($id)
   {
       $query_fatture = "SELECT * FROM tb_riserve WHERE id='$id';";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       $this->num_riserve = $e_query_fatture->num_rows;
       return $e_query_fatture;
   }
   
   public function filtraRiserva($filtro, $id_commessa)
   {
       $query_fatture = "SELECT * FROM tb_riserve WHERE id_commessa LIKE '$id_commessa' AND (nome_allegato LIKE '%".$filtro."%' OR descrizione LIKE '%".$filtro."%' OR dettagli LIKE '%".$filtro."%');";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       $this->num_riserve = $e_query_fatture->num_rows;
       return $e_query_fatture;
   }
   
   public function modificaRiserva($id, $id_commessa, $descrizione, $dettagli, $data, $target_path_modifica, $filename)
   {
       $insert_filename = ($filename != "") ? ", nome_allegato='$filename', link_allegato='$target_path_modifica'" : "";
       $query_fatture = "UPDATE tb_riserve SET  descrizione = '$descrizione', data = '$data', dettagli = '$dettagli' $insert_filename WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
       return $e_query_fatture;
   }
   
   public function eliminaAllegato($id)
   {
       $query_fatture = "UPDATE tb_riserve SET nome_allegato = '', link_allegato='' WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
       return $e_query_fatture;
   }
  
   public function numeroRiserve()
   {
      return $this->num_riserve;
   }
   
}

?>
