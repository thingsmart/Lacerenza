<?php
session_start();
class OrdiniCommessa
{  
   function __construct()
   {
		$this->numero = 0;   
	}
   
   public function carica($id_commessa)
   {
       $query_fatture = "SELECT * FROM tb_ordini_commessa WHERE id_commessa = $id_commessa;";
	  $e_query_fatture = EseguiQuery($query_fatture,"selezione");
	  $this->numero = $e_query_fatture->num_rows;
      return $e_query_fatture;
   }
   
   public function elimina($id)
   {
       $query_fatture = "DELETE FROM tb_ordini_commessa WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       return $e_query_fatture;
   }
   
   public function elimina_allegato($id)
   {
       $query_fatture = "DELETE FROM tb_allegati_ordini_commessa WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       return $e_query_fatture;
   }
   
   //inserisco un nuovo allegato
   public function inserisci_allegato($descrizione, $link_file, $filename, $id_ordine, $data, $tipologia)
   {
	  $query = "INSERT INTO tb_allegati_ordini_commessa SET tipologia='$tipologia', data='$data', id_ordine_commessa='$id_ordine', descrizione='$descrizione', link_file='$link_file', filename='$filename';";
	  $e_query = EseguiQuery($query,"inserimento");
      return $e_query;
   }
   
   public function inserisci($id_commessa, $cod_commessa, $descrizione_commessa, $fornitore)
   {
   	$utente = $_SESSION['username'];
       $query_fatture = "INSERT INTO tb_ordini_commessa SET utente='$utente', id_commessa = '$id_commessa', cod_commessa='$cod_commessa', descrizione_commessa='$descrizione_commessa', fornitore='$fornitore';";
	  $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
      return $e_query_fatture;
   }
   
   public function caricaById($id)
   {
       $query_fatture = "SELECT * FROM tb_ordini_commessa WHERE id='$id';";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       $this->numero = $e_query_fatture->num_rows;
       return $e_query_fatture;
   }
   
   public function filtra_allegati($filtro, $id_ordine)
   {
       $query_fatture = "SELECT * FROM tb_allegati_ordini_commessa WHERE id_ordine_commessa = '$id_ordine' AND (descrizione LIKE '%".$filtro."%' || tipologia LIKE '%".$filtro."%');";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       $this->numero = $e_query_fatture->num_rows;
       return $e_query_fatture;
   }
   
   public function filtra($filtro, $id_commessa)
   {
       $query_fatture = "SELECT * FROM tb_ordini_commessa WHERE id_commessa = '$id_commessa' AND (fornitore LIKE '%".$filtro."%');";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       $this->numero = $e_query_fatture->num_rows;
       return $e_query_fatture;
   }
   
   public function modifica($id, $fornitore)
   {
       $query_fatture = "UPDATE tb_ordini_commessa SET  fornitore='$fornitore' WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
       return $e_query_fatture;
   }
   
   public function caricaAllegati($id_ordine)
   {
	  $query = "SELECT * FROM tb_allegati_ordini_commessa WHERE id_ordine_commessa='$id_ordine';";
	  $e_query = EseguiQuery($query,"selezione");
	  $this->numero = $e_query->num_rows;
      return $e_query;
   }
   
   
  
   public function numero()
   {
      return $this->numero;
   }
   
}

?>
