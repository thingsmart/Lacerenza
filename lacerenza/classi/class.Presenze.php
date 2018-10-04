<?php

class Presenze
{  
   function __construct()
   {
		$this->num_presenze = 0;   
	}
   
   public function caricaPresenza($id_dipendente, $data)
   {
       $query_fatture = "SELECT * FROM tb_ruolino WHERE id_dipendenti LIKE '%{$id_dipendente}%' AND data='$data' ORDER BY data;";
	  $e_query_fatture = EseguiQuery($query_fatture,"selezione");
	  $this->num_presenze = $e_query_fatture->num_rows;
      return $e_query_fatture;
   }
   
   public function caricaPresenzaPerCommessa($id_dipendente, $data, $id_commessa)
   {
       $query_fatture = "SELECT * FROM tb_ruolino WHERE id_dipendenti LIKE '%{$id_dipendente}%' AND data='$data' AND id_commessa='$id_commessa' ORDER BY data;";
	  $e_query_fatture = EseguiQuery($query_fatture,"selezione");
	  $this->num_presenze = $e_query_fatture->num_rows;
      return $e_query_fatture;
   }
   
   public function oreLavoroGiornalieroPerCommessa($id_dipendente, $data, $id_commessa)
   {
       $query_fatture = "SELECT SUM(ore) AS ore FROM tb_ruolino WHERE data='$data' AND id_commessa='$id_commessa';";
	  $e_query_fatture = EseguiQuery($query_fatture,"selezione");
	  $row = $e_query_fatture->fetch_array();
	  if($row['ore'] != null){
	  	$valore = $row['ore'];
	  }else{
	  	$valore = 0;
	  }
      return $valore;
   }

    public function oreLavoroCommessa($id_commessa)
{
    $query_fatture = "SELECT * FROM tb_ruolino WHERE id_commessa='$id_commessa' ORDER BY data;";
    $e_query_fatture = EseguiQuery($query_fatture,"selezione");

    return $e_query_fatture;
}


    public function oreLavoroCommessaTl($id_commessa, $tl)
    {
        $query_fatture = "SELECT * FROM tb_ruolino WHERE tipologia = '$tl' AND id_commessa='$id_commessa' ORDER BY data;";
        $e_query_fatture = EseguiQuery($query_fatture,"selezione");

        return $e_query_fatture;
    }

    public function oreLavoroCommessaData($id_commessa, $da_data, $a_data)
    {
        $query_fatture = "SELECT * FROM tb_ruolino WHERE id_commessa='$id_commessa' AND data >= '$da_data' && data <= '$a_data' ORDER BY data;";
        $e_query_fatture = EseguiQuery($query_fatture,"selezione");

        return $e_query_fatture;
    }

    public function oreLavoroCommessaDataTl($id_commessa, $da_data, $a_data, $tl)
    {
        $query_fatture = "SELECT * FROM tb_ruolino WHERE tipologia = '$tl' AND id_commessa='$id_commessa' AND data >= '$da_data' && data <= '$a_data' ORDER BY data;";
        $e_query_fatture = EseguiQuery($query_fatture,"selezione");

        return $e_query_fatture;
    }

   public function oreLavoroGiornaliero($data)
   {
       $query_fatture = "SELECT * FROM tb_ruolino WHERE data='$data';";
	  $e_query_fatture = EseguiQuery($query_fatture,"selezione");
	  
      return $e_query_fatture;
   }

    public function oreLavoroGiornalieroDate($data, $a_data)
    {
        $query_fatture = "SELECT * FROM tb_ruolino WHERE data>='$data' AND data <= '$a_data';";
        $e_query_fatture = EseguiQuery($query_fatture,"selezione");

        return $e_query_fatture;
    }
   
   public function oreLavoroGiornalieroTl($data, $tl)
   {
   	$select_tl = ($tl != "tutti") ? "AND tipologia LIKE '$tl'" : "";
       $query_fatture = "SELECT * FROM tb_ruolino WHERE data='$data' $select_tl;";
	  $e_query_fatture = EseguiQuery($query_fatture,"selezione");
	  
      return $e_query_fatture;
   }
   
   public function oreLavoroMensile($mese, $anno)
   {
   		$da_data = date($anno."-".$mese."-01");
   		$giorno = date("t",$mese);
   		$a_data = date($anno."-".$mese."-".$giorno);
   		$query_fatture = "SELECT * FROM tb_ruolino WHERE data>='$da_data' AND data<='$a_data' ;";
	  $e_query_fatture = EseguiQuery($query_fatture,"selezione");
      return $e_query_fatture;
   }
   
   public function oreLavoroMensileTl($mese, $anno, $tl, $dal="", $al="")
   {
   	$select_tl = ($tl != "tutti") ? "AND tipologia LIKE '$tl'" : "";
       if($dal == "") {
           $da_data = date($anno . "-" . $mese . "-01");
       } else {
           $da_data = date($anno . "-" . $mese . "-".$dal);
       }

       if($al == "") {
           $giorno = date("t", $mese);
           $a_data = date($anno . "-" . $mese . "-" . $giorno);
       } else {
           $a_data = date($anno . "-" . $mese . "-" . $al);
       }
   		$query_fatture = "SELECT * FROM tb_ruolino WHERE data>='$da_data' AND data<='$a_data' $select_tl;";
	  $e_query_fatture = EseguiQuery($query_fatture,"selezione");
      return $e_query_fatture;
   }
   
   public function oreLavoroMensileCommessa($mese, $anno, $id_commessa)
   {
   		$da_data = date($anno."-".$mese."-01");
   		$giorno = date("t",$mese);
   		$a_data = date($anno."-".$mese."-".$giorno);
   		$query_fatture = "SELECT * FROM tb_ruolino WHERE id_commessa ='$id_commessa' AND data>='$da_data' AND data<='$a_data';";
	  $e_query_fatture = EseguiQuery($query_fatture,"selezione");
      return $e_query_fatture;
   }
   
   public function oreLavoroMensileCommessaTl($mese, $anno, $id_commessa, $tl, $dal="", $al="")
   {
   	$select_tl = ($tl != "tutti") ? "AND tipologia LIKE '$tl'" : "";
       if($dal == "") {
           $da_data = date($anno . "-" . $mese . "-01");
       } else {
           $da_data = date($anno . "-" . $mese . "-".$dal);
       }
       if($al == "") {
           $giorno = date("t", $mese);
           $a_data = date($anno . "-" . $mese . "-" . $giorno);
       } else {
           $a_data = date($anno . "-" . $mese . "-" . $al);
       }
   		$query_fatture = "SELECT * FROM tb_ruolino WHERE id_commessa ='$id_commessa' AND data>='$da_data' AND data<='$a_data' $select_tl;";
	  $e_query_fatture = EseguiQuery($query_fatture,"selezione");
      return $e_query_fatture;
   }
   
   public function oreLavoroGiornalieroCommessa($data, $id_commessa)
   {
       $query_fatture = "SELECT * FROM tb_ruolino WHERE id_commessa='$id_commessa' AND data='$data';";
	  $e_query_fatture = EseguiQuery($query_fatture,"selezione");
	  
      return $e_query_fatture;
   }
   
   public function oreLavoroGiornalieroCommessaTl($data, $id_commessa, $tl)
   {
   		$select_tl = ($tl != "tutti") ? "AND tipologia LIKE '$tl'" : "";
       $query_fatture = "SELECT * FROM tb_ruolino WHERE id_commessa='$id_commessa' AND data='$data' $select_tl;";
	  $e_query_fatture = EseguiQuery($query_fatture,"selezione");
	  
      return $e_query_fatture;
   }
   
   
   
   public function ferieMalattieGiornaliero($id_dipendente, $data)
   {
       $query_fatture = "SELECT count(*) AS ore FROM tb_presenze WHERE (dettagli = 'Ferie' || dettagli = 'Malattia') AND id_dipendente = '$id_dipendente' AND data='$data';";
	  $e_query_fatture = EseguiQuery($query_fatture,"selezione");
	  $row = $e_query_fatture->fetch_array();
	  if($row['ore'] != null){
	  	$valore = $row['ore'];
	  }else{
	  	$valore = 0;
	  }
      return $valore;
   }
   
   
   
   public function eliminaPresenza($id)
   {
       $query_fatture = "DELETE FROM tb_presenze WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       return $e_query_fatture;
   }
   
   
   public function inserisciPresenza($id_commessa, $id_dipendente, $data, $dettagli, $n_ore, $costo)
   {
       $query_fatture = "INSERT INTO tb_presenze SET costo='$costo', id_commessa='$id_commessa', id_dipendente = '$id_dipendente', data='$data', dettagli='$dettagli', n_ore='$n_ore';";
	  $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
      return $e_query_fatture;
   }
   
   public function caricaPresenzaById($id)
   {
       $query_fatture = "SELECT * FROM tb_presenze WHERE id='$id';";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       $this->num_presenze = $e_query_fatture->num_rows;
       return $e_query_fatture;
   }
   
   /*public function filtraPresenze($filtro, $id_dipendente)
   {
       $query_fatture = "SELECT * FROM tb_presenze WHERE id_dipendente LIKE '$id_dipendente' AND (tipo_documento LIKE '%".$filtro."%' OR descrizione LIKE '%".$filtro."%');";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       $this->num_presenze = $e_query_fatture->num_rows;
       return $e_query_fatture;
   }*/
   
   public function modificaPresenza($id, $id_dipendente, $data, $dettagli, $n_ore, $n_giorni)
   {
       $query_fatture = "UPDATE tb_presenze SET data = '$data', dettagli = '$dettagli', n_ore = '$n_ore', n_giorni = '$n_giorni' WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
       return $e_query_fatture;
   }
   
  
   public function numeroPresenze()
   {
      return $this->num_presenze;
   }
   
}

?>
