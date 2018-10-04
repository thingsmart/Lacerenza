<?php

class RevisioniContrattuali
{  
   function __construct()
   {
		$this->num_revisioni_contrattuali = 0;   
	}
   
   public function caricaRevisioniContrattuali($id_commessa)
   {
       $query_fatture = "SELECT * FROM tb_revisioni WHERE id_commessa = $id_commessa;";
	  $e_query_fatture = EseguiQuery($query_fatture,"selezione");
	  $this->num_revisioni_contrattuali = $e_query_fatture->num_rows;
      return $e_query_fatture;
   }
   
   public function eliminaRevisioneContrattuale($id)
   {
       $query_fatture = "DELETE FROM tb_revisioni WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       return $e_query_fatture;
   }
   
   
   public function filtraRevisioniContrattuali($filtro, $id_commessa)
   {
       $query_fatture = "SELECT * FROM tb_revisioni WHERE id_commessa LIKE '$id_commessa' AND (tipo_documento LIKE '%".$filtro."%' OR numero_documento LIKE '%".$filtro."%'  OR registrato_a LIKE '%".$filtro."%');";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       $this->num_revisioni_contrattuali = $e_query_fatture->num_rows;
       return $e_query_fatture;
   }
   
   public function inserisciRevisioneContrattuale($id_commessa, $tipo_documento, $numero_documento, $registrato_a, $data, $target_path_inserimento, $filename)
   {
       $query_fatture = "INSERT INTO tb_revisioni SET id_commessa = '$id_commessa', tipo_documento='$tipo_documento', numero_documento='$numero_documento', registrato_a='$registrato_a', data = '$data', link_allegato='$target_path_inserimento', nome_allegato='$filename';";
	  $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
      return $e_query_fatture;
   }
   
   public function caricaRevisioneContrattualeById($id)
   {
       $query_fatture = "SELECT * FROM tb_revisioni WHERE id='$id';";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       $this->num_revisioni_contrattuali = $e_query_fatture->num_rows;
       return $e_query_fatture;
   }
   
   
   public function eliminaAllegato($id)
   {
       $query_fatture = "UPDATE tb_revisioni SET nome_allegato = '', link_allegato='' WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
       return $e_query_fatture;
   }
   
   public function modificaRevisioneContrattuale($id, $id_commessa, $tipo_documento, $numero_documento, $registrato_a, $data, $target_path_modifica, $filename)
   {
       $insert_filename = ($filename != "") ? ", nome_allegato='$filename', link_allegato='$target_path_modifica'" : "";
       $query_fatture = "UPDATE tb_revisioni SET tipo_documento = '$tipo_documento', numero_documento = '$numero_documento', registrato_a = '$registrato_a', data = '$data' $insert_filename WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
       return $e_query_fatture;
   }
   
  
   public function numeroRevisioniContrattuali()
   {
      return $this->num_revisioni_contrattuali;
   }
   
}

?>
