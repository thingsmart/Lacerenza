<?php

class Personale
{  
    function __construct()
    {
		$this->num_personale = 0;   
	}
    
    public function caricaPersonale($id_commessa)
    {
        $query_fatture = "SELECT * FROM tb_personale WHERE id_commessa = $id_commessa;";
        $e_query_fatture = EseguiQuery($query_fatture,"selezione");
        $this->num_personale = $e_query_fatture->num_rows;
        return $e_query_fatture;
    }
    
    public function eliminaPersonale($id)
    {
        $query_fatture = "DELETE FROM tb_personale WHERE id=$id;";
        $e_query_fatture = EseguiQuery($query_fatture,"selezione");
        return $e_query_fatture;
    }
    
    
    public function inserisciPersonale($id_commessa, $id_dipendente, $nome, $cognome, $costo_h)
    {
        $query_fatture = "INSERT INTO tb_personale SET id_commessa = '$id_commessa', id_dipendente='$id_dipendente', nome = '$nome', cognome = '$cognome', costo_h = '$costo_h';";
        $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
        return $e_query_fatture;
    }
    
    public function caricaPersonaleById($id)
    {
        $query_fatture = "SELECT * FROM tb_personale WHERE id='$id';";
        $e_query_fatture = EseguiQuery($query_fatture,"selezione");
        $this->num_personale = $e_query_fatture->num_rows;
        return $e_query_fatture;
    }
    
    public function filtraPersonale($filtro, $id_commessa)
    {
        $query_fatture = "SELECT * FROM tb_personale WHERE id_commessa LIKE '$id_commessa' AND (nome LIKE '%".$filtro."%' OR cognome LIKE '%".$filtro."%');";
        $e_query_fatture = EseguiQuery($query_fatture,"selezione");
        $this->num_personale = $e_query_fatture->num_rows;
        return $e_query_fatture;
    }
    
    public function modificaPersonale($id, $id_commessa, $id_dipendente, $nome, $cognome, $costo_h)
    {
        $query_fatture = "UPDATE tb_personale SET  id_dipendente = '$id_dipendente', nome = '$nome', cognome = '$cognome', costo_h = '$costo_h' WHERE id=$id;";
        $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
        return $e_query_fatture;
    }
    
    public function eliminaAllegato($id)
    {
        $query_fatture = "UPDATE tb_personale SET nome_allegato = '', link_allegato='' WHERE id=$id;";
        $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
        return $e_query_fatture;
    }
    
    public function totale_ore($id_dipendente, $id_commessa)
    {
        $query_fatture = "SELECT SUM(n_ore) AS tot FROM tb_presenze WHERE id_commessa = '$id_commessa' AND id_dipendente = '$id_dipendente';";
        $e_query_fatture = EseguiQuery($query_fatture,"selezione");
        $row = $e_query_fatture->fetch_array();
        if($row['tot'] != null){
            $ris = $row['tot'];
        } else {
            $ris = 0;
        }
        return $ris;
    }
    
    public function totale_giorni($id_dipendente, $id_commessa)
    {
        $query_fatture = "SELECT Count(*) AS num FROM tb_presenze WHERE id_commessa = '$id_commessa' AND id_dipendente = '$id_dipendente';";
        $e_query_fatture = EseguiQuery($query_fatture,"selezione");
        $row = $e_query_fatture->fetch_array();
        if($row['num'] != null){
            $ris = $row['num'];
        } else {
            $ris = 0;
        }
        return $ris;
    }
    
    public function numeroPersonale()
    {
        return $this->num_personale;
    }
    
}

?>
