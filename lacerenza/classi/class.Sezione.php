<?php 	class Sezione {

		public $id;
		public $titolo;
		public $oscuratitolo;
		public $tipologia;
		public $testo;
		public $costo;
		public $tipologiacosto;
		public $link_file;
		public $filename;

		//ESTRAI TUTTI I DATI
		public static function getAll() {
			$query_dati = "SELECT * FROM tb_sezione ORDER BY titolo;";
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
			$query_dati = "SELECT * FROM tb_sezione WHERE titolo LIKE '%".$filtro."%' OR tipologia LIKE '%".$filtro."%' OR testo LIKE '%".$filtro."%' OR costo LIKE '%".$filtro."%';";
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
			$query_dati = "SELECT * FROM tb_sezione WHERE id=$id;";
			$e_query_dati = EseguiQuery($query_dati, "selezione");
			if($e_query_dati -> num_rows > 0){
				$row = $e_query_dati->fetch_array();
					$obj = $row;
			}
			$object = new self;
			$object->id = $obj["id"];
			$object->titolo = $obj["titolo"];
			$object->oscuratitolo = $obj["oscura_titolo"];
			$object->tipologia = $obj["tipologia"];
			$object->testo = $obj["testo"];
			$object->tipologiacosto = $obj["tipologia_costo"];
			$object->costo = $obj["costo"];
			$object->link_file = $obj["link_file"];
			$object->filename = $obj["filename"];
			return $object;
		}

		//ELIMINA
		public function delete() {
			$query_dati = "DELETE FROM tb_sezione WHERE id=$this->id;";
			$e_query_dati = EseguiQuery($query_dati, "selezione");
			return $e_query_dati;
		}


		//MODIFICO IMMAGINE
		public function insert_img() {
			$query_dati = "UPDATE tb_sezione SET link_file='$this->link_file', filename = '$this->filename' WHERE id=$this->id;";
			$e_query_dati = EseguiQuery($query_dati, "selezione");
			return $e_query_dati;
		}

		//INSERISCI (CONTROLLA I CAMPI DI INSERIMENTO)
		public function insert() {
	        $query_dati = "INSERT INTO tb_sezione SET titolo = '$this->titolo', oscura_titolo = '$this->oscuratitolo', tipologia = '$this->tipologia', testo = '$this->testo', costo = '$this->costo', tipologia_costo = '$this->tipologiacosto';";
            $e_query_dati = EseguiQuery($query_dati, "inserimento");
            return $e_query_dati;
        }

		//MODIFICA (CONTROLLA I CAMPI DI MODIFICA)
        public function update() {
            $query_dati = "UPDATE tb_sezione SET titolo = '$this->titolo', oscura_titolo = '$this->oscuratitolo', tipologia = '$this->tipologia', testo = '$this->testo', costo = '$this->costo', tipologia_costo = '$this->tipologiacosto' WHERE id=$this->id;";
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
		