<?php

class AllegatiDipendente
{  
   function __construct()
   {
		$this->num_allegati = 0;   
	}
   
   public function caricaAllegati($id_dipendente)
   {
       $query_fatture = "SELECT * FROM tb_allegati_dipendenti WHERE id_dipendente = $id_dipendente;";
	  $e_query_fatture = EseguiQuery($query_fatture,"selezione");
	  $this->num_allegati = $e_query_fatture->num_rows;
      return $e_query_fatture;
   }

    public function caricaAllegatiScadenza($id_dipendente, $datainizio, $datafine)
    {
        $query_fatture = "SELECT * FROM tb_allegati_dipendenti WHERE id_dipendente = $id_dipendente AND controlla_scadenza = '1' AND scadenza BETWEEN '$datainizio' AND '$datafine' ORDER BY SCADENZA DESC;";
        $e_query_fatture = EseguiQuery($query_fatture,"selezione");
        $this->num_allegati = $e_query_fatture->num_rows;
        return $e_query_fatture;
    }

   public function caricaAllegatiCommessa($id_dipendente, $id_commessa)
   {
       $query_fatture = "SELECT * FROM tb_allegati_dipendenti WHERE id_dipendente = $id_dipendente AND id_commessa='$id_commessa';";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       $this->num_allegati = $e_query_fatture->num_rows;
       return $e_query_fatture;
   }
   
   public function eliminaAllegato($id)
   {
       $query_fatture = "DELETE FROM tb_allegati_dipendenti WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       return $e_query_fatture;
   }
   
   
   public function inserisciAllegato($id_dipendente, $descrizione, $data, $scadenza, $inviato_a, $target_path_inserimento, $filename, $controlla)
   {
       $query_fatture = "INSERT INTO tb_allegati_dipendenti SET id_dipendente = '$id_dipendente', descrizione='$descrizione', data='$data', scadenza='$scadenza', link_allegato='$target_path_inserimento', nome_allegato='$filename', controlla_scadenza='$controlla';";
	  $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
      return $e_query_fatture;
   }

    public function aggiornaAllegato($id, $descrizione, $controlla, $dataInizio, $dataFine)
    {
        $query_fatture = "UPDATE tb_allegati_dipendenti SET descrizione='$descrizione', controlla_scadenza='$controlla', data='$dataInizio', scadenza='$dataFine' WHERE id = '$id';";
        $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
        return $e_query_fatture;
    }

   public function caricaAllegatoById($id)
   {
       $query_fatture = "SELECT * FROM tb_allegati_dipendenti WHERE id='$id';";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       $this->num_allegati = $e_query_fatture->num_rows;
       return $e_query_fatture;
   }
   
   public function filtraAllegati($filtro, $id_dipendente)
   {
       $query_fatture = "SELECT * FROM tb_allegati_dipendenti WHERE id_dipendente LIKE '$id_dipendente' AND (nome_allegato LIKE '%".$filtro."%' OR descrizione LIKE '%".$filtro."%' OR inviato_a LIKE '%".$filtro."%');";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       $this->num_allegati = $e_query_fatture->num_rows;
       return $e_query_fatture;
   }
   
   public function filtraAllegatiCommessa($filtro, $id_dipendente, $id_commessa)
   {
       $query_fatture = "SELECT * FROM tb_allegati_dipendenti WHERE id_commessa LIKE '$id_commessa' AND id_dipendente LIKE '$id_dipendente' AND (nome_allegato LIKE '%".$filtro."%' OR descrizione LIKE '%".$filtro."%' OR inviato_a LIKE '%".$filtro."%');";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       $this->num_allegati = $e_query_fatture->num_rows;
       return $e_query_fatture;
   }
   
   
  
   public function numeroAllegati()
   {
      return $this->num_allegati;
   }
   
}

?>
