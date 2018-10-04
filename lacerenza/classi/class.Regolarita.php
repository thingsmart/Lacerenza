<?php

class Regolarita
{  
   function __construct()
   {
		$this->num_regolarita = 0;   
	}
   
   public function caricaRegolarita($id_commessa)
   {
       $query_fatture = "SELECT * FROM tb_regolarita WHERE id_commessa = $id_commessa;";
	  $e_query_fatture = EseguiQuery($query_fatture,"selezione");
	  $this->num_regolarita = $e_query_fatture->num_rows;
      return $e_query_fatture;
   }
   
   public function eliminaRegolarita($id)
   {
       $query_fatture = "DELETE FROM tb_regolarita WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       return $e_query_fatture;
   }
   
   
   public function inserisciRegolarita($id_commessa, $descrizione, $data, $ente, $scadenza, $target_path_inserimento, $filename)
   {
       $query_fatture = "INSERT INTO tb_regolarita SET ente='$ente',id_commessa = '$id_commessa', descrizione='$descrizione', data = '$data', scadenza = '$scadenza', link_allegato='$target_path_inserimento', nome_allegato='$filename';";
	  $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
      return $e_query_fatture;
   }
   
   public function caricaRegolaritaById($id)
   {
       $query_fatture = "SELECT * FROM tb_regolarita WHERE id='$id';";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       $this->num_regolarita = $e_query_fatture->num_rows;
       return $e_query_fatture;
   }
   
   public function filtraRegolarita($filtro, $id_commessa)
   {
       $query_fatture = "SELECT * FROM tb_regolarita WHERE id_commessa LIKE '$id_commessa' AND (nome_allegato LIKE '%".$filtro."%' OR descrizione LIKE '%".$filtro."%' OR ente LIKE '%".$filtro."%');";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       $this->num_regolarita = $e_query_fatture->num_rows;
       return $e_query_fatture;
   }
   
   public function modificaRegolarita($id, $id_commessa, $descrizione, $ente, $data, $scadenza, $target_path_modifica, $filename)
   {
       $insert_filename = ($filename != "") ? ", nome_allegato='$filename', link_allegato='$target_path_modifica'" : "";
       $query_fatture = "UPDATE tb_regolarita SET  descrizione = '$descrizione', data = '$data', scadenza = '$scadenza', ente = '$ente' $insert_filename WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
       return $e_query_fatture;
   }
   
   public function eliminaAllegato($id)
   {
       $query_fatture = "UPDATE tb_regolarita SET nome_allegato = '', link_allegato='' WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
       return $e_query_fatture;
   }
  
   public function numeroRegolarita()
   {
      return $this->num_regolarita;
   }
   
}

?>
