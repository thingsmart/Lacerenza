<?php

class Materiali
{  
   function __construct()
   {
		$this->num_materiali = 0;   
	}
   
   public function caricaMateriale($id_commessa)
   {
       $query_fatture = "SELECT * FROM tb_materiale WHERE id_commessa = $id_commessa;";
	  $e_query_fatture = EseguiQuery($query_fatture,"selezione");
	  $this->num_materiali = $e_query_fatture->num_rows;
      return $e_query_fatture;
   }
   
   public function eliminaMateriale($id)
   {
       $query_fatture = "DELETE FROM tb_materiale WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       return $e_query_fatture;
   }
   
   
   public function inserisciMateriale($id_commessa, $tipo_materiale, $fornitore, $costo, $quantita, $importo, $data, $target_path_inserimento, $filename)
   {
       $query_fatture = "INSERT INTO tb_materiale SET tipo_materiale='$tipo_materiale',id_commessa = '$id_commessa', fornitore='$fornitore', costo='$costo', quantita='$quantita', importo='$importo', data = '$data', link_allegato='$target_path_inserimento', nome_allegato='$filename';";
	  $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
      return $e_query_fatture;
   }
   
   public function caricaMaterialeById($id)
   {
       $query_fatture = "SELECT * FROM tb_materiale WHERE id='$id';";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       $this->num_materiali = $e_query_fatture->num_rows;
       return $e_query_fatture;
   }
   
   public function filtraMateriale($filtro, $id_commessa)
   {
       $query_fatture = "SELECT * FROM tb_materiale WHERE id_commessa LIKE '$id_commessa' AND (nome_allegato LIKE '%".$filtro."%' OR fornitore LIKE '%".$filtro."%' OR tipo_materiale LIKE '%".$filtro."%');";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       $this->num_materiali = $e_query_fatture->num_rows;
       return $e_query_fatture;
   }
   
   public function modificaMateriale($id, $id_commessa, $tipo_materiale, $fornitore, $costo, $quantita, $importo, $data, $target_path_modifica, $filename)
   {
       $insert_filename = ($filename != "") ? ", nome_allegato='$filename', link_allegato='$target_path_modifica'" : "";
       $query_fatture = "UPDATE tb_materiale SET  tipo_materiale='$tipo_materiale', fornitore='$fornitore', costo='$costo', quantita='$quantita', importo='$importo', data = '$data' $insert_filename WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
       return $e_query_fatture;
   }
   
   public function eliminaAllegato($id)
   {
       $query_fatture = "UPDATE tb_materiale SET nome_allegato = '', link_allegato='' WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
       return $e_query_fatture;
   }
  
   public function numeroMateriali()
   {
      return $this->num_materiali;
   }
   
}

?>
