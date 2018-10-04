<?php

class Veicoli
{  
    function __construct()
    {
		$this->num_veicoli = 0;   
	}
    
    public function caricaVeicoli($id_commessa, $data)
    {
        $query_fatture = "SELECT * FROM tb_veicoli WHERE id_commessa = $id_commessa AND data = '$data';";
        $e_query_fatture = EseguiQuery($query_fatture,"selezione");
        $this->num_veicoli = $e_query_fatture->num_rows;
        return $e_query_fatture;
    }
    
    public function eliminaVeicolo($id)
    {
        $query_fatture = "DELETE FROM tb_veicoli WHERE id=$id;";
        $e_query_fatture = EseguiQuery($query_fatture,"selezione");
        return $e_query_fatture;
    }
	
	 public function elimina_veicoli($id_commessa, $data)
    {
        $query_fatture = "DELETE FROM tb_veicoli WHERE id_commessa=$id_commessa AND data='$data';";
        $e_query_fatture = EseguiQuery($query_fatture,"selezione");
        return $e_query_fatture;
    }
	
    
    
    public function inserisciVeicolo($id_commessa, $id_mezzo, $mezzo, $targa, $costo_h, $data, $km)
    {
        $query_fatture = "INSERT INTO tb_veicoli SET id_commessa = '$id_commessa', km='$km', data='$data', id_mezzo='$id_mezzo', mezzo = '$mezzo', targa = '$targa', costo_h = '$costo_h';";
        $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
        return $e_query_fatture;
    }
    
    public function caricaVeicoloById($id)
    {
        $query_fatture = "SELECT * FROM tb_veicoli WHERE id='$id';";
        $e_query_fatture = EseguiQuery($query_fatture,"selezione");
        $this->num_veicoli = $e_query_fatture->num_rows;
        return $e_query_fatture;
    }
    
    public function filtraVeicolo($filtro, $id_commessa)
    {
        $query_fatture = "SELECT * FROM tb_veicoli WHERE id_commessa LIKE '$id_commessa' AND (mezzo LIKE '%".$filtro."%' OR targa LIKE '%".$filtro."%');";
        $e_query_fatture = EseguiQuery($query_fatture,"selezione");
        $this->num_veicoli = $e_query_fatture->num_rows;
        return $e_query_fatture;
    }
    
    public function modificaVeicolo($id, $id_commessa, $id_mezzo, $mezzo, $targa, $costo_h)
    {
        $query_fatture = "UPDATE tb_veicoli SET  id_mezzo = '$id_mezzo', mezzo = '$mezzo', targa = '$targa', costo_h = '$costo_h' WHERE id=$id;";
        $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
        return $e_query_fatture;
    }
    
    public function eliminaAllegato($id)
    {
        $query_fatture = "UPDATE tb_veicoli SET nome_allegato = '', link_allegato='' WHERE id=$id;";
        $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
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
    
    public function totale_giorni($id_mezzo, $id_commessa)
    {
        $query_fatture = "SELECT Count(*) AS num FROM tb_utilizzo WHERE id_commessa = '$id_commessa' AND id_mezzo = '$id_mezzo';";
        $e_query_fatture = EseguiQuery($query_fatture,"selezione");
        $row = $e_query_fatture->fetch_array();
        if($row['num'] != null){
            $ris = $row['num'];
        } else {
            $ris = 0;
        }
        return $ris;
    }
    
    public function numeroVeicoli()
    {
        return $this->num_veicoli;
    }
    
}

?>
