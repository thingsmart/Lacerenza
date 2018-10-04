<?php

class Mezzi
{  
   function __construct()
   {
		$this->num_mezzi =0;   
	}
   
   public function caricaMezzi()
   {
	  $query_mezzi = "SELECT * FROM tb_mezzi;";
	  $e_query_mezzi = EseguiQuery($query_mezzi,"selezione");
	  $this->num_mezzi = $e_query_mezzi->num_rows;
      return $e_query_mezzi;
   }
   
   
      public function caricaMezzoById($id)
   {
	  $query_mezzi = "SELECT * FROM tb_mezzi WHERE id='$id';";
	  $e_query_mezzi = EseguiQuery($query_mezzi,"selezione");
	  $this->num_mezzi = $e_query_mezzi->num_rows;
      return $e_query_mezzi;
   }
      
      public function estraiTargaMezzoById($id)
      {
          $query_mezzi = "SELECT targa FROM tb_mezzi WHERE id='$id';";
          $e_query_mezzi = EseguiQuery($query_mezzi,"selezione");
          $row = $e_query_mezzi->fetch_array();
          return $row['targa'];
      }
   
      
   public function filtraMezzi($filtro)
   {
	  $query_mezzi = "SELECT * FROM tb_mezzi WHERE mezzo LIKE '%".$filtro."%' OR targa LIKE '%".$filtro."%';";
	  $e_query_mezzi = EseguiQuery($query_mezzi,"selezione");
	  $this->num_mezzi = $e_query_mezzi->num_rows;
      return $e_query_mezzi;
   }
   

   public function eliminaMezzo($id)
   {
	  $query_mezzi = "DELETE FROM tb_mezzi WHERE id=$id;";
	  $e_query_mezzi = EseguiQuery($query_mezzi,"selezione");
      return $e_query_mezzi;
   }
   
   public function inserisciMezzo($mezzo, $targa, $km_percorsi, $data, $tagliando_ogni, $venduto="", $immatricolazione)
   {
       $query_mezzi = "INSERT INTO tb_mezzi SET venduto='$venduto', mezzo = '$mezzo', targa='$targa', km_percorsi='$km_percorsi', data_ultimo_aggiornamento_km='$data', tagliando_ogni='$tagliando_ogni', immatricolazione='$immatricolazione';";
	  $e_query_mezzi = EseguiQuery($query_mezzi,"inserimento");
      return $e_query_mezzi;
   }
   
   public function modificaMezzo($id, $mezzo, $targa, $km_percorsi, $data, $tagliando_ogni, $venduto="", $immatricolazione)
   {
	  $insert_data = ($data != "") ? ", data_ultimo_aggiornamento_km='$data'" : "";
	  $query_mezzi = "UPDATE tb_mezzi SET venduto='$venduto', mezzo = '$mezzo', targa='$targa', km_percorsi='$km_percorsi', tagliando_ogni='$tagliando_ogni', immatricolazione='$immatricolazione' $insert_data WHERE id=$id;";
	  $e_query_mezzi = EseguiQuery($query_mezzi,"inserimento");
      return $e_query_mezzi;
   }

   public function modificaKm($id, $km_percorsi)
   {
      $query_mezzi = "UPDATE tb_mezzi SET km_percorsi='$km_percorsi' WHERE id=$id;";
      $e_query_mezzi = EseguiQuery($query_mezzi,"inserimento");
      return $e_query_mezzi;
   }
   
    public function costoTotale($id, $data_inizio, $data_fine)
   {
      //costo tagliandi
	  $query_tagliandi = "SELECT SUM(costo) AS totale FROM tb_tagliando WHERE id_mezzo=$id AND data_tagliando >= '$data_inizio' AND data_tagliando <= '$data_fine';";
	  $e_query_tagliandi = EseguiQuery($query_tagliandi,"selezione");
	  if($e_query_tagliandi->num_rows > 0){
		  $row =  $e_query_tagliandi -> fetch_array();
		  $tagliandi =  ($row['totale'] != "") ? $row['totale'] : "0";
	  } else {
		  $tagliandi = "0";
	  }
      
      //costo spese
      $query_spese = "SELECT SUM(costo) AS totale FROM tb_spese WHERE id_mezzo=$id AND data_ultimo_pagamento >= '$data_inizio' AND data_ultimo_pagamento <= '$data_fine';";
	  $e_query_spese = EseguiQuery($query_spese,"selezione");
	  if($e_query_spese->num_rows > 0){
		  $row_spesa =  $e_query_spese -> fetch_array();
		  $spese =  ($row_spesa['totale'] != "") ? $row_spesa['totale'] : "0";
	  } else {
		  $spese = "0";
	  }
      
      //costo esso card
      $query_esso_card = "SELECT SUM(totale_iva_inclusa) AS totale FROM tb_benzina WHERE id_mezzo=$id AND data >= '$data_inizio' AND data <= '$data_fine';";
	  $e_query_esso_card = EseguiQuery($query_esso_card,"selezione");
	  if($e_query_esso_card->num_rows > 0){
		  $row_esso_card =  $e_query_esso_card -> fetch_array();
		  $esso_card =  ($row_esso_card['totale'] != "") ? $row_esso_card['totale'] : "0";
	  } else {
		  $esso_card = "0";
	  }
      
      $totale = $tagliandi + $spese + $esso_card;
      return $totale;
   }
   
   
   
   
   
   public function numeroMezzi()
   {
      return $this->num_mezzi;
   }
   
}

?>
