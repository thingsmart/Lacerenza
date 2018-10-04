<?php
session_start();
class Ral
{  
   function __construct()
   {
		$this->num_ral = 0;   
	}
   
   public function caricaRal($id_commessa)
   {
       $query_ral = "SELECT * FROM tb_ral WHERE id_commessa = $id_commessa ORDER BY data;";
	  $e_query_ral = EseguiQuery($query_ral,"selezione");
	  $this->num_ral = $e_query_ral->num_rows;
      return $e_query_ral;
   }

    public function caricaRalTl($id_commessa, $tl)
    {
        $query_ral = "SELECT * FROM tb_ral WHERE id_commessa = $id_commessa AND tipologia = '$tl' ORDER BY data;";
        $e_query_ral = EseguiQuery($query_ral,"selezione");
        $this->num_ral = $e_query_ral->num_rows;
        return $e_query_ral;
    }

    public function caricaRalDataTl($id_commessa, $da_data, $a_data, $tl)
    {
        $query_ral = "SELECT * FROM tb_ral WHERE id_commessa = $id_commessa AND data >= '$da_data' AND data <= '$a_data' AND tipologia = '$tl' ORDER BY data;";
        $e_query_ral = EseguiQuery($query_ral,"selezione");
        $this->num_ral = $e_query_ral->num_rows;
        return $e_query_ral;
    }

    public function caricaRalData($id_commessa, $da_data, $a_data)
    {
        $query_ral = "SELECT * FROM tb_ral WHERE id_commessa = $id_commessa AND data >= '$da_data' AND data <= '$a_data' ORDER BY data;";
        $e_query_ral = EseguiQuery($query_ral,"selezione");
        $this->num_ral = $e_query_ral->num_rows;
        return $e_query_ral;
    }

    public function filtraRalData($filtro, $id_commessa, $da_data, $a_data)
    {
        $query_ral = "SELECT * FROM tb_ral WHERE ral LIKE '%".$filtro."%' AND id_commessa LIKE $id_commessa AND data >= '$da_data' AND data <= '$a_data' ORDER BY data;";
        $e_query_ral = EseguiQuery($query_ral,"selezione");
        $this->num_ral = $e_query_ral->num_rows;
        return $e_query_ral;
    }

   public function filtraRal($filtro, $id_commessa)
   {
       $query_ral = "SELECT * FROM tb_ral WHERE ral LIKE '%".$filtro."%' AND id_commessa LIKE $id_commessa ORDER BY data;";
       $e_query_ral = EseguiQuery($query_ral,"selezione");
       $this->num_ral = $e_query_ral->num_rows;
       return $e_query_ral;
   }
   
   public function eliminaRal($id)
   {
       $query_ral = "DELETE FROM tb_ral WHERE id=$id;";
       $e_query_ral = EseguiQuery($query_ral,"selezione");
       return $e_query_ral;
   }
   
   
   public function inserisciRal($id_commessa, $campo_ral, $totale_ral, $filename, $link_file, $data, $note, $tipologia="cap")
   {
   	   $utente = $_SESSION['username'];
       $query_ral = "INSERT INTO tb_ral SET tipologia='$tipologia', utente='$utente', id_commessa = '$id_commessa', ral='$campo_ral', totale_ral='$totale_ral', note='$note', data='$data', nome_allegato='$filename', link_allegato = '$link_file';";
	  $e_query_ral = EseguiQuery($query_ral,"inserimento");
      return $e_query_ral;
   }
   
   public function caricaRalById($id)
   {
       $query_ral = "SELECT * FROM tb_ral WHERE id='$id';";
       $e_query_ral = EseguiQuery($query_ral,"selezione");
       $this->num_ral = $e_query_ral->num_rows;
       return $e_query_ral;
   }
   
   public function eliminaAllegato($id)
   {
       $query_ral = "UPDATE tb_ral SET nome_allegato = '', link_allegato = '' WHERE id=$id;";
       $e_query_ral = EseguiQuery($query_ral,"inserimento");
       return $e_query_ral;
   }
   
   public function modificaRal($id, $campo_ral, $totale_ral, $filename, $target_path_salva, $data, $note, $tipologia='cap')
   {
   	 $utente = $_SESSION['username'];
       $insert_filename = ($filename != "") ? ", nome_allegato='$filename', link_allegato='$target_path_salva'" : "";
       $query_ral = "UPDATE tb_ral SET tipologia='$tipologia', utente='$utente', totale_ral = '$totale_ral', ral = '$campo_ral', note='$note', data='$data' $insert_filename WHERE id=$id;";
       $e_query_ral = EseguiQuery($query_ral,"inserimento");
       return $e_query_ral;
   }
   
   public function totFatture($id_ral)
   {
       $query_ral = "SELECT SUM(importo) AS tot FROM tb_fatture_ral WHERE id_ral = $id_ral;";
       $e_query_ral = EseguiQuery($query_ral,"selezione");
       $row = $e_query_ral->fetch_array();
       if($row['tot'] != null){
        $totale = $row['tot'];
       } else {
        $totale = 0;
       }
       return $totale;
   }
   
   public function totRAL($id_commessa)
   {
       $query_ral = "SELECT SUM(totale_ral) AS tot FROM tb_ral WHERE id_commessa = $id_commessa;";
       $e_query_ral = EseguiQuery($query_ral,"selezione");
       $row = $e_query_ral->fetch_array();
       if($row['tot'] != null){
           $totale = $row['tot'];
       } else {
           $totale = 0;
       }
       return $totale;
   }
   
   public function estraiNome($id)
   {
       $query_ral = "SELECT ral FROM tb_ral WHERE id = $id;";
       $e_query_ral = EseguiQuery($query_ral,"selezione");
       $row = $e_query_ral->fetch_array();
       $nome = $row['ral'];
       return $nome;
   }
   
   public function ImportoRalById($id)
   {
       $query_ral = "SELECT totale_ral FROM tb_ral WHERE id='$id';";
       $e_query_ral = EseguiQuery($query_ral,"selezione");
       $row = $e_query_ral->fetch_array();
       if($row['totale_ral'] != null){
           $totale = $row['totale_ral'];
       } else {
           $totale = 0;
       }
       return $totale;
   }
  
   public function numeroRal()
   {
      return $this->num_ral;
   }
   
}

?>
