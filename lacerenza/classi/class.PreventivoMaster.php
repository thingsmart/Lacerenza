<?php 	class PreventivoMaster {

		public $id;
		public $idmodellomaster;
		public $numpreventivo;
		public $cliente;
		public $indirizzo;
		public $datapreventivo;
		public $descrizione;
		public $titololavoro;
		public $iniziolavori;
		public $finelavori;
		public $condizionipagamento;
		public $link_file;
		public $filename;

		//ESTRAI TUTTI I DATI
		public static function getAll() {
			$query_dati = "SELECT * FROM tb_preventivo_master;";
			$e_query_dati = EseguiQuery($query_dati, "selezione");
			$obj = array();
			if($e_query_dati -> num_rows > 0){
				while($row = $e_query_dati->fetch_object()){
					$obj[] = $row;
				}
			}
			return $obj;
		}

		//ESTRAI TUTTI I DATI
		public static function getAllData($da_data, $a_data) {
			$da = $da_data. " 00:00:00";
			$a = $a_data. " 23:59:59";
			$query_dati = "SELECT * FROM tb_preventivo_master WHERE data_preventivo BETWEEN '$da' AND '$a' ORDER BY data_preventivo;";
			$e_query_dati = EseguiQuery($query_dati, "selezione");
			$obj = array();
			if($e_query_dati -> num_rows > 0){
				while($row = $e_query_dati->fetch_object()){
					$obj[] = $row;
				}
			}
			return $obj;
		}
		
		//PERSONALIZZA I CAMPI DI RICERCA
		public static function getFilter($filtro) {
			$query_dati = "SELECT * FROM tb_preventivo_master WHERE id_modello_master LIKE '%".$filtro."%' OR num_preventivo LIKE '%".$filtro."%' OR cliente LIKE '%".$filtro."%' OR data_preventivo LIKE '%".$filtro."%' OR descrizione LIKE '%".$filtro."%';";
			$e_query_dati = EseguiQuery($query_dati, "selezione");
			$obj = array();
			if($e_query_dati -> num_rows > 0){
				while($row = $e_query_dati->fetch_object()){
					$obj[] = $row;
				}
			}
			return $obj;
		}

		//ESTRAI BY ID
		public static function getById($id) {
			$query_dati = "SELECT * FROM tb_preventivo_master WHERE id=$id;";
			$e_query_dati = EseguiQuery($query_dati, "selezione");
			if($e_query_dati -> num_rows > 0){
				$row = $e_query_dati->fetch_array();
					$obj = $row;
			}
			$object = new self;
			$object->id = $obj["id"];
			$object->idmodellomaster = $obj["id_modello_master"];
			$object->numpreventivo = $obj["num_preventivo"];
			$object->cliente = $obj["cliente"];
			$object->indirizzo = $obj["indirizzo"];
			$object->datapreventivo = $obj["data_preventivo"];
			$object->descrizione = $obj["descrizione"];
			$object->titololavoro = $obj["titolo_lavoro"];
			$object->iniziolavori = $obj["inizio_lavori"];
			$object->finelavori = $obj["fine_lavori"];
			$object->condizionipagamento = $obj["condizioni_pagamento"];
			$object->link_file = $obj["link_file"];
			$object->filename = $obj["filename"];
			return $object;
		}

		//ESTRAI BY ID
		public static function getByIdJoin($id) {
			$query_dati = "SELECT tb_preventivo_master.id, tb_preventivo_master.id_modello_master, tb_preventivo_master.num_preventivo, tb_preventivo_master.cliente, tb_preventivo_master.indirizzo, tb_preventivo_master.data_preventivo, tb_preventivo_master.descrizione, tb_preventivo_master.titolo_lavoro, tb_preventivo_master.inizio_lavori, tb_preventivo_master.fine_lavori, tb_preventivo_master.condizioni_pagamento, tb_modello_master.id as newId, tb_modello_master.titolo FROM tb_preventivo_master LEFT JOIN tb_modello_master ON tb_preventivo_master.id_modello_master = tb_modello_master.id WHERE tb_preventivo_master.id=$id;";
			$e_query_dati = EseguiQuery($query_dati, "selezione");
			if($e_query_dati -> num_rows > 0){
				$row = $e_query_dati->fetch_array();
			}

			return $row;
		}
		//ELIMINA
		public function delete() {
			$query_dati = "DELETE FROM tb_preventivo_master WHERE id=$this->id;";
			$e_query_dati = EseguiQuery($query_dati, "selezione");
			return $e_query_dati;
		}
		
		//MODIFICO IMMAGINE
		public function insert_img() {
			$query_dati = "UPDATE tb_preventivo_master SET link_file='$this->link_file', filename = '$this->filename' WHERE id=$this->id;";
			$e_query_dati = EseguiQuery($query_dati, "selezione");
			return $e_query_dati;
		}
		
		//INSERISCI (CONTROLLA I CAMPI DI INSERIMENTO)
		public function insert() {
	        $query_dati = "INSERT INTO tb_preventivo_master SET id_modello_master = '$this->idmodellomaster', num_preventivo = '$this->numpreventivo', cliente = '$this->cliente', indirizzo = '$this->indirizzo', data_preventivo = '$this->datapreventivo', descrizione = '$this->descrizione', titolo_lavoro = '$this->titololavoro', inizio_lavori = '$this->iniziolavori', fine_lavori = '$this->finelavori', condizioni_pagamento = '$this->condizionipagamento';";
            $e_query_dati = EseguiQuery($query_dati, "inserimento");
            return $e_query_dati;
        }

		//MODIFICA (CONTROLLA I CAMPI DI MODIFICA)
        public function update() {
            $query_dati = "UPDATE tb_preventivo_master SET id_modello_master = '$this->idmodellomaster', num_preventivo = '$this->numpreventivo', cliente = '$this->cliente', indirizzo = '$this->indirizzo', data_preventivo = '$this->datapreventivo', descrizione = '$this->descrizione', titolo_lavoro = '$this->titololavoro', inizio_lavori = '$this->iniziolavori', fine_lavori = '$this->finelavori', condizioni_pagamento = '$this->condizionipagamento' WHERE id=$this->id;";
            $e_query_dati = EseguiQuery($query_dati, "selezione");
            return $e_query_dati;
        }
		
		//SALVA
        public function save() {
			// Check object for id
			if (isset($this->id) && $this->id != "") {
				// Return update when id exists
				return $this->update();
			} else {
				// Return insert when id does not exists
				return $this->insert();
			}
		}
	}

?>
		