<?php

class Terzi
{  
    function __construct()
    {
		$this->numero = 0;   
	}
    
    public function carica($id_commessa, $data)
    {
        $query_fatture = "SELECT * FROM tb_terzi WHERE id_commessa = $id_commessa AND data = '$data';";
        $e_query_fatture = EseguiQuery($query_fatture,"selezione");
        $this->numero = $e_query_fatture->num_rows;
        return $e_query_fatture;
    }
    
    public function elimina($id)
    {
        $query_fatture = "DELETE FROM tb_terzi WHERE id=$id;";
        $e_query_fatture = EseguiQuery($query_fatture,"selezione");
        return $e_query_fatture;
    }
	
	 public function elimina_terzi($id_commessa, $data)
    {
        $query_fatture = "DELETE FROM tb_terzi WHERE id_commessa=$id_commessa AND data='$data';";
        $e_query_fatture = EseguiQuery($query_fatture,"selezione");
        return $e_query_fatture;
    }
	
    
    
    public function inserisci($id_commessa, $data, $descrizione, $ore)
    {
        $query_fatture = "INSERT INTO tb_terzi SET id_commessa = '$id_commessa', data='$data', descrizione='$descrizione', ore = '$ore';";
        $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
        return $e_query_fatture;
    }
    
    public function caricaById($id)
    {
        $query_fatture = "SELECT * FROM tb_terzi WHERE id='$id';";
        $e_query_fatture = EseguiQuery($query_fatture,"selezione");
        $this->numero = $e_query_fatture->num_rows;
        return $e_query_fatture;
    }
    
    
    
    
    
    public function totale_ore($id_mezzo, $id_commessa)
    {
        $query_fatture = "SELECT SUM(n_ore) AS tot FROM tb_utilizzo WHERE id_commessa = '$id_commessa' AND id_mezzo = '$id_mezzo';";
        $e_query_fatture = EseguiQuery($query_fatture,"selezione");
        $row = $e_query_fatture->fetch_array();
        if($row['tot'] != null){
            $ris = $row['tot'];
        } else {
            $ris = 0;
        }
        return $ris;
    }
    
    
    
    public function numero()
    {
        return $this->numero;
    }
    
}

?>
