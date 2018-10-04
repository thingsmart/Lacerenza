<?php

class Utilizzo
{  
   function __construct()
   {
		$this->num_utilizzo = 0;   
	}
   
   public function caricaUtilizzo($id_mezzo, $id_commessa)
   {
       $query_fatture = "SELECT * FROM tb_utilizzo WHERE id_mezzo = '$id_mezzo' AND id_commessa='$id_commessa' ORDER BY data;";
	  $e_query_fatture = EseguiQuery($query_fatture,"selezione");
	  $this->num_utilizzo = $e_query_fatture->num_rows;
      return $e_query_fatture;
   }
   
   public function eliminaUtilizzo($id)
   {
       $query_fatture = "DELETE FROM tb_utilizzo WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       return $e_query_fatture;
   }
   
   
   public function inserisciUtilizzo($id_commessa, $id_mezzo, $data, $dettagli, $n_ore)
   {
       $query_fatture = "INSERT INTO tb_utilizzo SET id_commessa='$id_commessa', id_mezzo = '$id_mezzo', data='$data', dettagli='$dettagli', n_ore='$n_ore';";
	  $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
      return $e_query_fatture;
   }
   
   public function caricaUtilizzoById($id)
   {
       $query_fatture = "SELECT * FROM tb_utilizzo WHERE id='$id';";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       $this->num_utilizzo = $e_query_fatture->num_rows;
       return $e_query_fatture;
   }
   
   /*public function filtraPresenze($filtro, $id_mezzo)
   {
       $query_fatture = "SELECT * FROM tb_utilizzo WHERE id_mezzo LIKE '$id_mezzo' AND (tipo_documento LIKE '%".$filtro."%' OR descrizione LIKE '%".$filtro."%');";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       $this->num_utilizzo = $e_query_fatture->num_rows;
       return $e_query_fatture;
   }*/
   
   public function modificaUtilizzo($id, $id_mezzo, $data, $dettagli, $n_ore, $n_giorni)
   {
       $query_fatture = "UPDATE tb_utilizzo SET data = '$data', dettagli = '$dettagli', n_ore = '$n_ore', n_giorni = '$n_giorni' WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
       return $e_query_fatture;
   }
   
  
   public function numeroUtilizzo()
   {
      return $this->num_utilizzo;
   }
   
}

?>
