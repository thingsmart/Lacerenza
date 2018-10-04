<?php

class Costi
{  
   function __construct()
   {
		$this->num_costi =0;   
	}
   
   public function caricaCosti($id_dipendente)
   {
	  $query_utenti = "SELECT * FROM tb_costi WHERE id_dipendente = $id_dipendente ORDER BY data_inizio;";
	  $e_query_utenti = EseguiQuery($query_utenti,"selezione");
	  $this->num_costi = $e_query_utenti->num_rows;
      return $e_query_utenti;
   }

   public function caricaCostiTutti($id_dipendente)
   {
      $query_utenti = "SELECT * FROM tb_costi WHERE id_dipendente = $id_dipendente AND (id_commessa IS NULL OR id_commessa = '-1') ORDER BY data_inizio;";
      $e_query_utenti = EseguiQuery($query_utenti,"selezione");
      $this->num_costi = $e_query_utenti->num_rows;
      return $e_query_utenti;
   }

   public function caricaCostiCommessa($id_dipendente, $id_commessa)
   {
      $query_utenti = "SELECT * FROM tb_costi WHERE id_dipendente = $id_dipendente AND id_commessa= $id_commessa ORDER BY data_inizio;";
      $e_query_utenti = EseguiQuery($query_utenti,"selezione");
      $this->num_costi = $e_query_utenti->num_rows;
      return $e_query_utenti;
   }
   
   public function costoAttuale($id_dipendente, $oggi)
   {
   	  //$oggi = date("Y-m-d");
	  $query_utenti = "SELECT * FROM tb_costi WHERE id_dipendente = $id_dipendente AND data_inizio <= '$oggi' AND data_fine >= '$oggi';";
	  $e_query_utenti = EseguiQuery($query_utenti,"selezione");
	  if($e_query_utenti->num_rows > 0){
	  	$row = $e_query_utenti->fetch_array();
		  $val=$row['costo'];
	  } else {
	  	//$query_utenti = "SELECT * FROM tb_costi WHERE id_dipendente = $id_dipendente AND data_inizio <= '$oggi' ORDER BY data_inizio DESC;";
	  	$query_utenti = "SELECT * FROM tb_costi WHERE id_dipendente = $id_dipendente AND mese LIKE 'ANNUALE';";
		$e_query_utenti = EseguiQuery($query_utenti,"selezione");
		if($e_query_utenti->num_rows > 0){
			$row = $e_query_utenti->fetch_array();
			$val=$row['costo'];
		}else{
	  	$val = 0;
		}
	  }
      return $val;
   }

   public function costoAttualeNuovo($id_dipendente, $oggi)
   {
      //$oggi = date("Y-m-d");
      $query_utenti = "SELECT * FROM tb_costi WHERE id_dipendente = $id_dipendente AND data_inizio <= '$oggi' AND data_fine >= '$oggi' AND (id_commessa IS NULL  OR id_commessa = '-1');";
      $e_query_utenti = EseguiQuery($query_utenti,"selezione");
      if($e_query_utenti->num_rows > 0){
         $row = $e_query_utenti->fetch_array();
         $val=$row['costo'];
      } else {
         //$query_utenti = "SELECT * FROM tb_costi WHERE id_dipendente = $id_dipendente AND data_inizio <= '$oggi' ORDER BY data_inizio DESC;";
         $query_utenti = "SELECT * FROM tb_costi WHERE id_dipendente = $id_dipendente AND mese LIKE 'ANNUALE' AND (id_commessa IS NULL OR id_commessa = '-1');";
         $e_query_utenti = EseguiQuery($query_utenti,"selezione");
         if($e_query_utenti->num_rows > 0){
            $row = $e_query_utenti->fetch_array();
            $val=$row['costo'];
         }else{
            $val = 0;
         }
      }
      return $val;
   }

   public function costoAttualeCommessa($id_dipendente, $oggi, $id_commessa)
   {
      //$oggi = date("Y-m-d");
      $query_utenti = "SELECT * FROM tb_costi WHERE id_dipendente = $id_dipendente AND data_inizio <= '$oggi' AND data_fine >= '$oggi' AND id_commessa = '$id_commessa';";
      $e_query_utenti = EseguiQuery($query_utenti,"selezione");
      if($e_query_utenti->num_rows > 0){
         $row = $e_query_utenti->fetch_array();
         $val=$row['costo'];
      } else {
         //$query_utenti = "SELECT * FROM tb_costi WHERE id_dipendente = $id_dipendente AND data_inizio <= '$oggi' ORDER BY data_inizio DESC;";
         $query_utenti = "SELECT * FROM tb_costi WHERE id_dipendente = $id_dipendente AND mese LIKE 'ANNUALE' AND id_commessa = '$id_commessa';";
         $e_query_utenti = EseguiQuery($query_utenti,"selezione");
         if($e_query_utenti->num_rows > 0){
            $row = $e_query_utenti->fetch_array();
            $val=$row['costo'];
         }else{
            $val = 0;
         }
      }
      return $val;
   }

   public function costoAttualeMedia($id_dipendente, $oggi)
   {
      //$oggi = date("Y-m-d");
      $query_utenti = "SELECT * FROM tb_costi WHERE id_dipendente = $id_dipendente AND ((data_inizio <= '$oggi' AND data_fine >= '$oggi') OR mese LIKE 'ANNUALE') GROUP BY anno, id_commessa;";
      $e_query_utenti = EseguiQuery($query_utenti,"selezione");
      if($e_query_utenti->num_rows > 0){
         $tot = 0;
         while($row = $e_query_utenti->fetch_array()){
            $tot += $row['costo'];
         }
         $tot = $tot/$e_query_utenti->num_rows;
         $val=$tot;
      } else {
        $val = 0;
      }
      return $val;
   }


   
   
   public function caricaCostoById($id)
   {
	  $query_utenti = "SELECT * FROM tb_costi WHERE id=$id;";
	  $e_query_utenti = EseguiQuery($query_utenti,"selezione");
	  $this->num_costi = $e_query_utenti->num_rows;
      return $e_query_utenti;
   }
   
   public function filtraCosto($filtro)
   {
	  $query_utenti = "SELECT * FROM tb_costi WHERE mese LIKE '%".$filtro."%' OR anno LIKE '%".$filtro."%';";
	  $e_query_utenti = EseguiQuery($query_utenti,"selezione");
	  $this->num_costi = $e_query_utenti->num_rows;
      return $e_query_utenti;
   }
   
   public function inserisciCosto($id_dipendente, $costo, $mese, $anno, $data_inizio, $data_fine, $id_commessa)
   {
      $id_commessa = ($id_commessa == "") ? -1 : $id_commessa;
	  $query_utenti = "INSERT INTO tb_costi SET id_commessa='$id_commessa', costo='$costo', id_dipendente='$id_dipendente', mese='$mese', anno='$anno' , data_inizio='$data_inizio' , data_fine='$data_fine';";
	  $e_query_utenti = EseguiQuery($query_utenti,"inserimento");
      return $e_query_utenti;
   }
   
   public function modificaCosto($id, $costo)
   {
	  $query_utenti = "UPDATE tb_costi SET costo='$costo' WHERE id = '$id';";
	  $e_query_utenti = EseguiQuery($query_utenti,"inserimento");
      return $e_query_utenti;
   }
   
   public function eliminaCosto($id)
   {
	  $query_utenti = "DELETE FROM tb_costi WHERE id=$id;";
	  $e_query_utenti = EseguiQuery($query_utenti,"selezione");
      return $e_query_utenti;
   }
   
   
   public function numeroCosti()
   {
      return $this->num_costi;
   }
   
}

?>
