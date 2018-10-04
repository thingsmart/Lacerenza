<?php

class Categorie
{  
   function __construct()
   {
		$this->num_categorie = 0;   
	}
   
   public function caricaCategorie($id_verbale)
   {
       $query_categorie = "SELECT * FROM tb_categorie WHERE id_verbale = $id_verbale;";
	  $e_query_categorie = EseguiQuery($query_categorie,"selezione");
	  $this->num_categorie = $e_query_categorie->num_rows;
      return $e_query_categorie;
   }
   
   public function eliminaCategoria($id)
   {
       $query_categorie = "DELETE FROM tb_categorie WHERE id=$id;";
       $e_query_categorie = EseguiQuery($query_categorie,"selezione");
       return $e_query_categorie;
   }
   
   
   public function inserisciCategoria($id_verbale, $descrizione, $importo)
   {
       $query_categorie = "INSERT INTO tb_categorie SET id_verbale = '$id_verbale', importo='$importo', descrizione='$descrizione';";
	  $e_query_categorie = EseguiQuery($query_categorie,"inserimento");
      return $e_query_categorie;
   }
   
   public function caricaCategoriaById($id)
   {
       $query_categorie = "SELECT * FROM tb_categorie WHERE id='$id';";
       $e_query_categorie = EseguiQuery($query_categorie,"selezione");
       $this->num_categorie = $e_query_categorie->num_rows;
       return $e_query_categorie;
   }
   
   public function filtraCategorie($filtro, $id_verbale)
   {
       $query_categorie = "SELECT * FROM tb_categorie WHERE id_verbale LIKE '$id_verbale' AND descrizione LIKE '%".$filtro."%';";
       $e_query_categorie = EseguiQuery($query_categorie,"selezione");
       $this->num_categorie = $e_query_categorie->num_rows;
       return $e_query_categorie;
   }
   
   public function modificaFattura($id, $descrizione, $importo)
   {
       $query_categorie = "UPDATE tb_categorie SET importo = '$importo', descrizione = '$descrizione' WHERE id=$id;";
       $e_query_categorie = EseguiQuery($query_categorie,"inserimento");
       return $e_query_categorie;
   }
   
  
   public function numeroCategorie()
   {
      return $this->num_categorie;
   }
   
}

?>
