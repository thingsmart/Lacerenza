<?php

class Tagliandi
{  
   function __construct()
   {
		$this->num_tagliandi = 0;   
	}
   
   public function caricaTagliandi($id_mezzo)
   {
	  $query_tagliandi = "SELECT * FROM tb_tagliando WHERE id_mezzo = $id_mezzo;";
	  $e_query_tagliandi = EseguiQuery($query_tagliandi,"selezione");
	  $this->num_tagliandi = $e_query_tagliandi->num_rows;
      return $e_query_tagliandi;
   }

   public function caricaUltimi5Tagliandi($id_mezzo)
   {
      $query_tagliandi = "SELECT * FROM tb_tagliando WHERE id_mezzo = $id_mezzo ORDER BY data_tagliando DESC LIMIT 5;";
      $e_query_tagliandi = EseguiQuery($query_tagliandi,"selezione");
      $this->num_tagliandi = $e_query_tagliandi->num_rows;
      return $e_query_tagliandi;
   }

   public function caricaTagliandiByData($id_mezzo, $data_inizio , $data_fine)
   {
	  $query_tagliandi = "SELECT * FROM tb_tagliando WHERE id_mezzo = $id_mezzo AND data_tagliando >= '$data_inizio' AND data_tagliando <= '$data_fine';";
	  $e_query_tagliandi = EseguiQuery($query_tagliandi,"selezione");
	  $this->num_tagliandi = $e_query_tagliandi->num_rows;
      return $e_query_tagliandi;
   }
   
   public function filtraTagliandiByData($id_mezzo, $filtro, $data_inizio , $data_fine)
   {
	  $query_tagliandi = "SELECT * FROM tb_tagliando WHERE id_mezzo = $id_mezzo AND data_tagliando >= '$data_inizio' AND data_tagliando <= '$data_fine' AND (tipo_tagliando LIKE '%".$filtro."%');";
	  $e_query_tagliandi = EseguiQuery($query_tagliandi,"selezione");
	  $this->num_tagliandi = $e_query_tagliandi->num_rows;
      return $e_query_tagliandi;
   }
   
   public function eliminaTagliando($id)
   {
	  $query_tagliandi = "DELETE FROM tb_tagliando WHERE id=$id;";
	  $e_query_tagliandi = EseguiQuery($query_tagliandi,"selezione");
      return $e_query_tagliandi;
   }
   
   
   public function inserisciTagliando($id_mezzo, $tipo_tagliando, $data_tagliando, $costo, $file, $tagliando_ogni, $colore, $tagliando_prossimo)
   {
	  $query_tagliandi = "INSERT INTO tb_tagliando SET tagliando_prossimo='$tagliando_prossimo', colore='$colore', id_mezzo = '$id_mezzo', tipo_tagliando='$tipo_tagliando', data_tagliando='$data_tagliando', costo='$costo', riferimento_fattura = '$file', tagliando_ogni = '$tagliando_ogni';";
	  $e_query_tagliandi = EseguiQuery($query_tagliandi,"inserimento");
      return $e_query_tagliandi;
   }
   
    public function caricaTagliandoById($id)
   {
	  $query_tagliandi = "SELECT * FROM tb_tagliando WHERE id='$id';";
	  $e_query_tagliandi = EseguiQuery($query_tagliandi,"selezione");
	  $this->num_tagliandi = $e_query_tagliandi->num_rows;
      return $e_query_tagliandi;
   }
   
    public function eliminaAllegato($id)
   {
	  $query_tagliandi = "UPDATE tb_tagliando SET riferimento_fattura = '' WHERE id=$id;";
	  $e_query_tagliandi = EseguiQuery($query_tagliandi,"inserimento");
      return $e_query_tagliandi;
   }
   
   
   public function modificaTagliando($id, $tipo_tagliando, $data_tagliando, $costo, $filename, $tagliando_ogni, $colore, $tagliando_prossimo)
   {
	  $insert_filename = ($filename != "") ? ", riferimento_fattura='$filename'" : "";
	  $query_tagliandi = "UPDATE tb_tagliando SET tagliando_prossimo='$tagliando_prossimo', colore='$colore', tipo_tagliando = '$tipo_tagliando', data_tagliando='$data_tagliando', costo='$costo', tagliando_ogni = '$tagliando_ogni' $insert_filename WHERE id=$id;";
	  $e_query_tagliandi = EseguiQuery($query_tagliandi,"inserimento");
      return $e_query_tagliandi;
   }
   
    public function filtraTagliandi($filtro)
   {
	  $query_tagliandi = "SELECT * FROM tb_tagliando WHERE tipo_tagliando LIKE '%".$filtro."%';";
	  $e_query_tagliandi = EseguiQuery($query_tagliandi,"selezione");
	  $this->num_tagliandi = $e_query_tagliandi->num_rows;
      return $e_query_tagliandi;
   }
  
   public function numeroTagliandi()
   {
      return $this->num_tagliandi;
   }
   
}

?>
