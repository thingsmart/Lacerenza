<?php

class Spese
{  
   function __construct()
   {
		$this->num_spese = 0;   
	}
   
   public function caricaSpese($id_mezzo)
   {
	  $query_spese = "SELECT * FROM tb_spese WHERE id_mezzo = $id_mezzo;";
	  $e_query_spese = EseguiQuery($query_spese,"selezione");
	  $this->num_spese = $e_query_spese->num_rows;
      return $e_query_spese;
   }

    public function caricaSpeseAnno($id_mezzo)
    {
        $query_spese = "SELECT YEAR(data_ultimo_pagamento) as anno FROM tb_spese WHERE id_mezzo = '$id_mezzo' GROUP BY DATE_FORMAT(data_ultimo_pagamento,'%Y');";
        $e_query_spese = EseguiQuery($query_spese,"selezione");
        $this->num_spese = $e_query_spese->num_rows;
        return $e_query_spese;
    }

    public function calcolaSpeseMezzo($id_mezzo)
    {
        $query_spese = "SELECT YEAR(data_ultimo_pagamento) as anno, SUM(costo) as costi_totali, SUM(IF( tipo = 'BOLLO' OR tipo = 'ASSICURAZIONE' OR tipo = 'REVISIONE', costo, 0)) AS costi_fissi, SUM(IF( tipo != 'BOLLO' AND tipo != 'ASSICURAZIONE' AND tipo != 'REVISIONE', costo, 0)) AS costi_variabili FROM tb_spese WHERE id_mezzo = '$id_mezzo' GROUP BY DATE_FORMAT(data_ultimo_pagamento,'%Y');";
        $e_query_spese = EseguiQuery($query_spese,"selezione");
        $this->num_spese = $e_query_spese->num_rows;
        return $e_query_spese;
    }

   public function caricaSpeseByData($id_mezzo, $data_inizio , $data_fine)
   {
	  $query_spese = "SELECT * FROM tb_spese WHERE id_mezzo = $id_mezzo AND data_ultimo_pagamento >= '$data_inizio' AND data_ultimo_pagamento <= '$data_fine';";
	  $e_query_spese = EseguiQuery($query_spese,"selezione");
	  $this->num_spese = $e_query_spese->num_rows;
      return $e_query_spese;
   }
   
   public function filtraSpeseByData($id_mezzo, $filtro, $data_inizio , $data_fine)
   {
       $query_spese = "SELECT * FROM tb_spese WHERE id_mezzo = $id_mezzo AND data_ultimo_pagamento >= '$data_inizio' AND data_ultimo_pagamento <= '$data_fine' AND tipo LIKE '%".$filtro."%';";
       $e_query_spese = EseguiQuery($query_spese,"selezione");
       $this->num_spese = $e_query_spese->num_rows;
       return $e_query_spese;
   }
   
   public function filtraSpese($filtro)
   {
       $query_spese = "SELECT * FROM tb_spese WHERE tipo LIKE '%".$filtro."%';";
       $e_query_spese = EseguiQuery($query_spese,"selezione");
       $this->num_spese = $e_query_spese->num_rows;
       return $e_query_spese;
   }
   
   public function eliminaSpesa($id)
   {
       $query_spese = "DELETE FROM tb_spese WHERE id=$id;";
       $e_query_spese = EseguiQuery($query_spese,"selezione");
       return $e_query_spese;
   }
   
   public function inserisciSpesa($id_mezzo, $tipo_spesa, $data_ultimo_pagamento, $costo, $file, $data_scadenza, $avviso)
   {
       $query_spese = "INSERT INTO tb_spese SET eseguito='$avviso', id_mezzo = '$id_mezzo', tipo='$tipo_spesa', data_ultimo_pagamento='$data_ultimo_pagamento', costo='$costo', riferimento_fattura = '$file', data_scadenza = '$data_scadenza';";
       $e_query_spese = EseguiQuery($query_spese,"inserimento");
       return $e_query_spese;
   }
   
   public function caricaSpesaById($id)
   {
       $query_spese = "SELECT * FROM tb_spese WHERE id='$id';";
       $e_query_spese = EseguiQuery($query_spese,"selezione");
       $this->num_spese = $e_query_spese->num_rows;
       return $e_query_spese;
   }
   
   public function eliminaAllegato($id)
   {
       $query_spese = "UPDATE tb_spese SET riferimento_fattura = '' WHERE id=$id;";
       $e_query_spese = EseguiQuery($query_spese,"inserimento");
       return $e_query_spese;
   }
   
   public function modificaSpesa($id, $id_mezzo, $tipo_spesa, $data_ultimo_pagamento, $costo, $filename, $data_scadenza, $avviso)
   {
	  $insert_filename = ($filename != "") ? ", riferimento_fattura='$filename'" : "";
      $insert_scadenza = ($data_scadenza != "") ? ", data_scadenza = '$data_scadenza'" : "";
	  $query_spese = "UPDATE tb_spese SET eseguito='$avviso', tipo = '$tipo_spesa', data_ultimo_pagamento='$data_ultimo_pagamento', costo='$costo' $insert_scadenza $insert_filename WHERE id=$id;";
	  $e_query_spese = EseguiQuery($query_spese,"inserimento");
      return $e_query_spese;
   }
   
   public function numeroSpese()
   {
      return $this->num_spese;
   }
   
}

?>
