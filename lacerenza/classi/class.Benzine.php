<?php

class Benzine
{  
   function __construct()
   {
		$this->num_benzine = 0;   
	}
   
   public function caricaBenzina($id_mezzo)
   {
	  $query_benzina = "SELECT * FROM tb_benzina WHERE id_mezzo = $id_mezzo;";
	  $e_query_benzina = EseguiQuery($query_benzina,"selezione");
	  $this->num_benzine = $e_query_benzina->num_rows;
      return $e_query_benzina;
   }

    public function caricaSpeseAnno($id_mezzo)
    {
        $query_spese = "SELECT YEAR(data) as anno FROM tb_benzina WHERE id_mezzo = '$id_mezzo' GROUP BY DATE_FORMAT(data,'%Y');";
        $e_query_spese = EseguiQuery($query_spese,"selezione");
        $this->num_spese = $e_query_spese->num_rows;
        return $e_query_spese;
    }

    public function calcolaCostiBenzina($id_mezzo)
    {
        $query_benzina = "SELECT YEAR(data) as anno, SUM(totale_iva_inclusa) as totale_con_iva FROM tb_benzina WHERE id_mezzo = '$id_mezzo' GROUP BY DATE_FORMAT(data,'%Y');";
        $e_query_benzina = EseguiQuery($query_benzina,"selezione");
        $this->num_benzine = $e_query_benzina->num_rows;
        return $e_query_benzina;
    }

    public function caricaBenzinaAggiornamento($id_mezzo)
    {
        $query_benzina = "SELECT * FROM tb_benzina WHERE id_mezzo = $id_mezzo ORDER BY data DESC LIMIT 1;";
        $e_query_benzina = EseguiQuery($query_benzina,"selezione");
        $this->num_benzine = $e_query_benzina->num_rows;
        return $e_query_benzina;
    }

   
   public function caricaBenzinaByData($id_mezzo, $data_inizio , $data_fine)
   {
	  $query_benzina = "SELECT * FROM tb_benzina WHERE id_mezzo = $id_mezzo AND data >= '$data_inizio' AND data <= '$data_fine';";
	  $e_query_benzina = EseguiQuery($query_benzina,"selezione");
	  $this->num_benzine = $e_query_benzina->num_rows;
      return $e_query_benzina;
   }
   
   public function filtraBenzinaByData($id_mezzo, $filtro, $data_inizio , $data_fine)
   {
       $query_benzina = "SELECT * FROM tb_benzina WHERE id_mezzo = $id_mezzo AND data >= '$data_inizio' AND data <= '$data_fine' AND (codice_autista LIKE '%".$filtro."%' OR targa LIKE '%".$filtro."%' OR prodotto_servizio LIKE '%".$filtro."%' OR localita LIKE '%".$filtro."%');";
       $e_query_benzina = EseguiQuery($query_benzina,"selezione");
       $this->num_benzine = $e_query_benzina->num_rows;
       return $e_query_benzina;
   }
   
   public function eliminaBenzina($id)
   {
	  $query_benzina = "DELETE FROM tb_benzina WHERE id=$id;";
	  $e_query_benzina = EseguiQuery($query_benzina,"selezione");
      return $e_query_benzina;
   }
   
   public function filtraBenzina($filtro)
   {
       $query_benzina = "SELECT * FROM tb_benzina WHERE codice_autista LIKE '%".$filtro."%' OR targa LIKE '%".$filtro."%' OR prodotto_servizio LIKE '%".$filtro."%' OR localita LIKE '%".$filtro."%';";
       $e_query_benzina = EseguiQuery($query_benzina,"selezione");
       $this->num_benzine = $e_query_benzina->num_rows;
       return $e_query_benzina;
   }
   
   
   public function inserisciBenzina($id_mezzo, $data, $targa, $prodotto_servizio, $totale_iva_inclusa, $importo_iva, $importo_netto, $prezzo_escluso_iva, $numero_carta, $titolare_carta, $localita, $codice_autista, $km_veicolo, $quantita_litri, $prezzo_pompa, $aliq_iva, $importo_ticket, $sconto)
   {
       $query_benzina = "INSERT INTO tb_benzina SET id_mezzo = '$id_mezzo', data='$data', targa='$targa', prodotto_servizio='$prodotto_servizio', totale_iva_inclusa = '$totale_iva_inclusa', importo_iva = '$importo_iva', importo_netto = '$importo_netto', prezzo_escluso_iva = '$prezzo_escluso_iva', numero_carta = '$numero_carta', titolare_carta = '$titolare_carta', localita = '$localita', codice_autista = '$codice_autista', km_veicolo = '$km_veicolo', quantita_litri = '$quantita_litri', prezzo_pompa = '$prezzo_pompa', aliq_iva = '$aliq_iva', importo_ticket = '$importo_ticket', sconto = '$sconto';";
	  $e_query_benzina = EseguiQuery($query_benzina,"inserimento");
      return $e_query_benzina;
   }
   
   public function modificaBenzina($id, $id_mezzo, $data, $targa, $prodotto_servizio, $totale_iva_inclusa, $importo_iva, $importo_netto, $prezzo_escluso_iva, $numero_carta, $titolare_carta, $localita, $codice_autista, $km_veicolo, $quantita_litri, $prezzo_pompa, $aliq_iva, $importo_ticket, $sconto){
       $query_benzina = "UPDATE tb_benzina SET id_mezzo = '$id_mezzo', data='$data', targa='$targa', prodotto_servizio='$prodotto_servizio', totale_iva_inclusa = '$totale_iva_inclusa', importo_iva = '$importo_iva', importo_netto = '$importo_netto', prezzo_escluso_iva = '$prezzo_escluso_iva', numero_carta = '$numero_carta', titolare_carta = '$titolare_carta', localita = '$localita', codice_autista = '$codice_autista', km_veicolo = '$km_veicolo', quantita_litri = '$quantita_litri', prezzo_pompa = '$prezzo_pompa', aliq_iva = '$aliq_iva', importo_ticket = '$importo_ticket', sconto = '$sconto' WHERE id='$id';";
       $e_query_benzina = EseguiQuery($query_benzina,"inserimento");
       return $e_query_benzina;
   }
   
   public function caricaBenzinaById($id)
   {
       $query_benzina = "SELECT * FROM tb_benzina WHERE id='$id';";
       $e_query_benzina = EseguiQuery($query_benzina,"selezione");
       $this->num_benzine = $e_query_benzina->num_rows;
       return $e_query_benzina;
   }
   
   
   
   
    
   /*
    public function caricaTagliandoById($id)
   {
	  $query_benzina = "SELECT * FROM tb_benzina WHERE id='$id';";
	  $e_query_benzina = EseguiQuery($query_benzina,"selezione");
	  $this->num_benzine = $e_query_benzina->num_rows;
      return $e_query_benzina;
   }
   
    public function eliminaAllegato($id)
   {
	  $query_benzina = "UPDATE tb_benzina SET riferimento_fattura = '' WHERE id=$id;";
	  $e_query_benzina = EseguiQuery($query_benzina,"inserimento");
      return $e_query_benzina;
   }
   
   
   public function modificaTagliando($id, $tipo_tagliando, $data_tagliando, $costo, $filename, $tagliando_ogni)
   {
	  $insert_filename = ($filename != "") ? ", riferimento_fattura='$filename'" : "";
	  $query_benzina = "UPDATE tb_benzina SET tipo_tagliando = '$tipo_tagliando', data_tagliando='$data_tagliando', costo='$costo', tagliando_ogni = '$tagliando_ogni' $insert_filename WHERE id=$id;";
	  $e_query_benzina = EseguiQuery($query_benzina,"inserimento");
      return $e_query_benzina;
   }
   
*/
  
   public function numeroBenzina()
   {
      return $this->num_benzine;
   }
   
}

?>
