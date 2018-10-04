<?php

class Fatture
{  
   function __construct()
   {
		$this->num_fatture = 0;   
	}
   
   public function caricaFatture($id_commessa)
   {
       $query_fatture = "SELECT * FROM tb_fattura WHERE id_commessa = $id_commessa;";
	  $e_query_fatture = EseguiQuery($query_fatture,"selezione");
	  $this->num_fatture = $e_query_fatture->num_rows;
      return $e_query_fatture;
   }
   
   public function eliminaFattura($id)
   {
       $query_fatture = "DELETE FROM tb_fattura WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       return $e_query_fatture;
   }
   
   
   public function inserisciFattura($id_commessa, $tipo_documento, $descrizione, $importo_totale, $data_pagamento, $data_incasso, $target_path_inserimento, $filename)
   {
       $query_fatture = "INSERT INTO tb_fattura SET id_commessa = '$id_commessa', tipo_documento='$tipo_documento', descrizione='$descrizione', importo_totale='$importo_totale', data_pagamento = '$data_pagamento', data_incasso = '$data_incasso', link_allegato='$target_path_inserimento', nome_allegato='$filename';";
	  $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
      return $e_query_fatture;
   }
   
   public function caricaFatturaById($id)
   {
       $query_fatture = "SELECT * FROM tb_fattura WHERE id='$id';";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       $this->num_fatture = $e_query_fatture->num_rows;
       return $e_query_fatture;
   }
   
   public function filtraFatture($filtro, $id_commessa)
   {
       $query_fatture = "SELECT * FROM tb_fattura WHERE id_commessa LIKE '$id_commessa' AND (tipo_documento LIKE '%".$filtro."%' OR descrizione LIKE '%".$filtro."%');";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       $this->num_fatture = $e_query_fatture->num_rows;
       return $e_query_fatture;
   }
   
   public function modificaFattura($id, $tipo_documento, $descrizione, $importo_totale, $data_pagamento, $data_incasso, $target_path_modifica, $filename)
   {
       $insert_filename = ($filename != "") ? ", nome_allegato='$filename', link_allegato='$target_path_modifica'" : "";
       $insert_data_incasso = ($data_incasso != "") ? ", data_incasso='$data_incasso'" : "";
       $query_fatture = "UPDATE tb_fattura SET tipo_documento = '$tipo_documento', descrizione = '$descrizione', importo_totale = '$importo_totale', data_pagamento = '$data_pagamento' $insert_data_incasso $insert_filename WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
       return $e_query_fatture;
   }
   
   public function eliminaAllegato($id)
   {
       $query_fatture = "UPDATE tb_fattura SET nome_allegato = '', link_allegato='' WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
       return $e_query_fatture;
   }
  
   public function numeroFatture()
   {
      return $this->num_fatture;
   }
   
}

?>
