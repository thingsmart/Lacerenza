<?php

class Polizze
{  
   function __construct()
   {
		$this->num_polizze = 0;   
	}
   
   public function caricaPolizze($id_commessa)
   {
       $query_fatture = "SELECT * FROM tb_polizza WHERE id_commessa = $id_commessa;";
	  $e_query_fatture = EseguiQuery($query_fatture,"selezione");
	  $this->num_polizze = $e_query_fatture->num_rows;
      return $e_query_fatture;
   }
   
   public function eliminaPolizza($id)
   {
       $query_fatture = "DELETE FROM tb_polizza WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       return $e_query_fatture;
   }
   
   
   public function caricaPolizzaById($id)
   {
       $query_fatture = "SELECT * FROM tb_polizza WHERE id='$id';";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       $this->num_polizze = $e_query_fatture->num_rows;
       return $e_query_fatture;
   }
   
   public function filtraPolizza($filtro, $id_commessa)
   {
       $query_fatture = "SELECT * FROM tb_polizza WHERE descrizione LIKE '%".$filtro."%' AND id_commessa LIKE '$id_commessa';";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       $this->num_polizze = $e_query_fatture->num_rows;
       return $e_query_fatture;
   }
   
   
   public function inserisciPolizza($id_commessa, $descrizione, $importo, $polizza_svincolata, $data_stipula, $scadenza, $target_path_inserimento, $filename)
   {
       $query_fatture = "INSERT INTO tb_polizza SET id_commessa = '$id_commessa', polizza_svincolata='$polizza_svincolata', descrizione='$descrizione', data_stipula='$data_stipula', scadenza = '$scadenza', importo = '$importo', link_allegato='$target_path_inserimento', nome_allegato='$filename';";
	  $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
      return $e_query_fatture;
   }
   
   
   public function eliminaAllegato($id)
   {
       $query_fatture = "UPDATE tb_polizza SET nome_allegato = '', link_allegato='' WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
       return $e_query_fatture;
   }
   public function modificaPolizza($id, $id_commessa, $descrizione, $importo, $polizza_svincolata, $data_stipula, $scadenza, $target_path_modifica, $filename)
   {
       $insert_filename = ($filename != "") ? ", nome_allegato='$filename', link_allegato='$target_path_modifica'" : "";
       $query_fatture = "UPDATE tb_polizza SET importo = '$importo', descrizione = '$descrizione', polizza_svincolata = '$polizza_svincolata', data_stipula = '$data_stipula', scadenza='$scadenza' $insert_filename WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
       return $e_query_fatture;
   }
   
  
   public function numeroPolizze()
   {
      return $this->num_polizze;
   }
   
}

?>
