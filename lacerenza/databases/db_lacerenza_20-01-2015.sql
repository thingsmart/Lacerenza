# SQL Manager for MySQL 5.3.1.7
# ---------------------------------------
# Host     : localhost
# Port     : 3306
# Database : jetbit


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES latin1 */;

SET FOREIGN_KEY_CHECKS=0;

#
# Structure for the `tb_commesse` table : 
#

CREATE TABLE `tb_commesse` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `codice` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  `descrizione` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `localita` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data_inizio` DATE DEFAULT '0000-00-00',
  `data_fine` DATE DEFAULT '0000-00-00',
  `status` TINYINT(1) DEFAULT NULL,
  `annotazioni` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `cantiere` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `importo` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  `tipologia_lavori` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `referente` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `telefono` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  `fax` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  `cellulare` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  `utente` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `campo1` CHAR(5) COLLATE latin1_general_ci DEFAULT NULL,
  `campo2` CHAR(5) COLLATE latin1_general_ci DEFAULT NULL,
  `campo3` CHAR(5) COLLATE latin1_general_ci DEFAULT NULL,
  `campo4` CHAR(5) COLLATE latin1_general_ci DEFAULT NULL,
  `campo5` CHAR(5) COLLATE latin1_general_ci DEFAULT NULL,
  `email` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `indirizzo_referente` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `pi` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `pec` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`)
)ENGINE=InnoDB
AUTO_INCREMENT=7 AVG_ROW_LENGTH=16384 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_allegati` table : 
#

CREATE TABLE `tb_allegati` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `n_sospensioni` INTEGER(11) DEFAULT NULL,
  `descrizione` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `verbale_n` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  `link_allegato` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `id_commessa` INTEGER(11) DEFAULT NULL,
  `file_name` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data` DATE DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
   INDEX `id_commessa` USING BTREE (`id_commessa`),
  CONSTRAINT `tb_allegati_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE
)ENGINE=InnoDB
AUTO_INCREMENT=12 AVG_ROW_LENGTH=16384 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_attivita` table : 
#

CREATE TABLE `tb_attivita` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` INTEGER(11) DEFAULT NULL,
  `impresa_fornitrice` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `lavoro` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `importo` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  `data_del` DATE DEFAULT NULL,
  `registrato_a` VARCHAR(100) COLLATE latin1_general_ci DEFAULT NULL,
  `data_il` DATE DEFAULT NULL,
  `numero` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
   INDEX `id_commessa` USING BTREE (`id_commessa`),
  CONSTRAINT `tb_attivita_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE
)ENGINE=InnoDB
AUTO_INCREMENT=1 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_allegati_attivita` table : 
#

CREATE TABLE `tb_allegati_attivita` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_attivita` INTEGER(11) DEFAULT NULL,
  `descrizione` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data_ricevuto` DATE DEFAULT NULL,
  `data_inviato` DATE DEFAULT NULL,
  `inviato_a` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `link_allegato` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
   INDEX `id_attivita` USING BTREE (`id_attivita`),
  CONSTRAINT `tb_allegati_attivita_fk1` FOREIGN KEY (`id_attivita`) REFERENCES `tb_attivita` (`id`) ON DELETE CASCADE
)ENGINE=InnoDB
AUTO_INCREMENT=1 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_allegati_comunicazioni` table : 
#

CREATE TABLE `tb_allegati_comunicazioni` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_comunicazione` INTEGER(11) DEFAULT NULL,
  `link` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `descrizione` VARCHAR(512) COLLATE latin1_general_ci DEFAULT NULL,
  `utente` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `file_name` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  UNIQUE INDEX `id` USING BTREE (`id`)
)ENGINE=InnoDB
AUTO_INCREMENT=18 AVG_ROW_LENGTH=5461 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_dipendenti` table : 
#

CREATE TABLE `tb_dipendenti` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) COLLATE latin1_general_ci DEFAULT NULL,
  `cognome` VARCHAR(100) COLLATE latin1_general_ci DEFAULT NULL,
  `attivo` VARCHAR(256) COLLATE latin1_general_ci DEFAULT 'ATTIVO',
  PRIMARY KEY USING BTREE (`id`)
)ENGINE=InnoDB
AUTO_INCREMENT=11 AVG_ROW_LENGTH=2730 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_allegati_dipendenti` table : 
#

CREATE TABLE `tb_allegati_dipendenti` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_dipendente` INTEGER(11) DEFAULT NULL,
  `id_commessa` INTEGER(11) DEFAULT NULL,
  `data` DATE DEFAULT NULL,
  `scadenza` DATE DEFAULT NULL,
  `descrizione` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `link_allegato` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
   INDEX `id_dipendente` USING BTREE (`id_dipendente`),
  CONSTRAINT `tb_allegati_dipendenti_fk1` FOREIGN KEY (`id_dipendente`) REFERENCES `tb_dipendenti` (`id`) ON DELETE CASCADE
)ENGINE=InnoDB
AUTO_INCREMENT=3 AVG_ROW_LENGTH=8192 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_gara` table : 
#

CREATE TABLE `tb_gara` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `descrizione` TEXT COLLATE latin1_general_ci,
  `data_emissione` DATE DEFAULT NULL,
  `data_scadenza` DATE DEFAULT NULL,
  `polizze` VARCHAR(512) COLLATE latin1_general_ci DEFAULT NULL,
  `avcp` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `passoe` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `utente` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  UNIQUE INDEX `id` USING BTREE (`id`)
)ENGINE=InnoDB
AUTO_INCREMENT=8 AVG_ROW_LENGTH=16384 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_allegati_gare` table : 
#

CREATE TABLE `tb_allegati_gare` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `descrizione` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `link_file` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `filename` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `utente` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `id_gara` INTEGER(11) DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  UNIQUE INDEX `id` USING BTREE (`id`),
   INDEX `id_gara` USING BTREE (`id_gara`),
  CONSTRAINT `tb_allegati_gare_fk1` FOREIGN KEY (`id_gara`) REFERENCES `tb_gara` (`id`) ON DELETE CASCADE
)ENGINE=InnoDB
AUTO_INCREMENT=11 AVG_ROW_LENGTH=16384 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_noleggi` table : 
#

CREATE TABLE `tb_noleggi` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` INTEGER(11) DEFAULT NULL,
  `numero` VARCHAR(100) COLLATE latin1_general_ci DEFAULT NULL,
  `descrizione` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `importo` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  `fornitore` VARCHAR(100) COLLATE latin1_general_ci DEFAULT NULL,
  `data` DATE DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
   INDEX `id_commessa` USING BTREE (`id_commessa`),
  CONSTRAINT `tb_noleggi_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE
)ENGINE=InnoDB
AUTO_INCREMENT=10 AVG_ROW_LENGTH=16384 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_allegati_noleggi` table : 
#

CREATE TABLE `tb_allegati_noleggi` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_noleggio` INTEGER(11) DEFAULT NULL,
  `descrizione` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `link_allegato` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
   INDEX `id_noleggio` USING BTREE (`id_noleggio`),
  CONSTRAINT `tb_allegati_noleggi_fk1` FOREIGN KEY (`id_noleggio`) REFERENCES `tb_noleggi` (`id`) ON DELETE CASCADE
)ENGINE=InnoDB
AUTO_INCREMENT=20 AVG_ROW_LENGTH=16384 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_ordini_commessa` table : 
#

CREATE TABLE `tb_ordini_commessa` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` INTEGER(11) DEFAULT NULL,
  `cod_commessa` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `descrizione_commessa` VARCHAR(512) COLLATE latin1_general_ci DEFAULT NULL,
  `fornitore` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `utente` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  UNIQUE INDEX `id` USING BTREE (`id`)
)ENGINE=InnoDB
AUTO_INCREMENT=15 AVG_ROW_LENGTH=5461 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_allegati_ordini_commessa` table : 
#

CREATE TABLE `tb_allegati_ordini_commessa` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `descrizione` VARCHAR(512) COLLATE latin1_general_ci DEFAULT NULL,
  `data` DATE DEFAULT NULL,
  `id_ordine_commessa` INTEGER(11) DEFAULT NULL,
  `link_file` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `filename` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `tipologia` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  UNIQUE INDEX `id` USING BTREE (`id`),
   INDEX `id_ordine_commessa` USING BTREE (`id_ordine_commessa`),
  CONSTRAINT `tb_allegati_ordini_commessa_fk1` FOREIGN KEY (`id_ordine_commessa`) REFERENCES `tb_ordini_commessa` (`id`) ON DELETE CASCADE
)ENGINE=InnoDB
AUTO_INCREMENT=14 AVG_ROW_LENGTH=4096 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_mezzi` table : 
#

CREATE TABLE `tb_mezzi` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `mezzo` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `targa` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `km_percorsi` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data_ultimo_aggiornamento_km` DATE DEFAULT NULL,
  `tagliando_ogni` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `km_ultimo_tagliando` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `costo_totale` DOUBLE(15,2) DEFAULT 0.00,
  PRIMARY KEY USING BTREE (`id`)
)ENGINE=InnoDB
AUTO_INCREMENT=3 AVG_ROW_LENGTH=8192 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_benzina` table : 
#

CREATE TABLE `tb_benzina` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_mezzo` INTEGER(11) DEFAULT NULL,
  `n_ticket` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `localita` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `targa` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `codice_autista` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `km_veicolo` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `prodotto_servizio` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `quantita_litri` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  `importo_ticket` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `prezzo_pompa` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `sconto` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  `prezzo_escluso_iva` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `importo_netto` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `aliq_iva` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  `importo_iva` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  `totale_iva_inclusa` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  `numero_carta` VARCHAR(100) COLLATE latin1_general_ci DEFAULT NULL,
  `titolare_carta` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data` DATE DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
   INDEX `id_mezzo` USING BTREE (`id_mezzo`),
  CONSTRAINT `tb_benzina_fk1` FOREIGN KEY (`id_mezzo`) REFERENCES `tb_mezzi` (`id`) ON DELETE CASCADE
)ENGINE=InnoDB
AUTO_INCREMENT=9 AVG_ROW_LENGTH=16384 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_verbali` table : 
#

CREATE TABLE `tb_verbali` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` INTEGER(11) DEFAULT NULL,
  `descrizione` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data` DATE DEFAULT NULL,
  `importo` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  `link_allegato` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
   INDEX `id_commessa` USING BTREE (`id_commessa`),
  CONSTRAINT `tb_verbali_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE
)ENGINE=InnoDB
AUTO_INCREMENT=12 AVG_ROW_LENGTH=16384 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_categorie` table : 
#

CREATE TABLE `tb_categorie` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_verbale` INTEGER(11) DEFAULT NULL,
  `descrizione` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `importo` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
   INDEX `id_verbale` USING BTREE (`id_verbale`),
  CONSTRAINT `tb_categorie_fk1` FOREIGN KEY (`id_verbale`) REFERENCES `tb_verbali` (`id`) ON DELETE CASCADE
)ENGINE=InnoDB
AUTO_INCREMENT=8 AVG_ROW_LENGTH=8192 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_comunicazioni` table : 
#

CREATE TABLE `tb_comunicazioni` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `data` DATE DEFAULT NULL,
  `id_commessa` INTEGER(11) DEFAULT NULL,
  `descrizione_commessa` VARCHAR(512) COLLATE latin1_general_ci DEFAULT NULL,
  `tipo_comunicazione` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `destinatario` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `testo` TEXT COLLATE latin1_general_ci,
  `note` TEXT COLLATE latin1_general_ci,
  `utente` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  UNIQUE INDEX `id` USING BTREE (`id`)
)ENGINE=InnoDB
AUTO_INCREMENT=8 AVG_ROW_LENGTH=8192 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_costi` table : 
#

CREATE TABLE `tb_costi` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_dipendente` INTEGER(11) DEFAULT NULL,
  `data_inizio` DATE DEFAULT NULL,
  `data_fine` DATE DEFAULT NULL,
  `costo` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  `mese` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `anno` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  UNIQUE INDEX `id` USING BTREE (`id`),
  UNIQUE INDEX `tb_costi_idx1` USING BTREE (`mese`, `anno`, `id_dipendente`)
)ENGINE=InnoDB
AUTO_INCREMENT=8 AVG_ROW_LENGTH=2340 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_documentazione` table : 
#

CREATE TABLE `tb_documentazione` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` INTEGER(11) DEFAULT NULL,
  `data` DATE DEFAULT NULL,
  `descrizione` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `link_allegato` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
   INDEX `id_commessa` USING BTREE (`id_commessa`),
  CONSTRAINT `tb_documentazione_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE
)ENGINE=InnoDB
AUTO_INCREMENT=12 AVG_ROW_LENGTH=8192 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_documenti_cliente` table : 
#

CREATE TABLE `tb_documenti_cliente` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` INTEGER(11) DEFAULT NULL,
  `descrizione` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `ente_rilascio` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data` DATE DEFAULT NULL,
  `validita` DATE DEFAULT NULL,
  `scadenza` DATE DEFAULT NULL,
  `rinnovo` DATE DEFAULT NULL,
  `link_allegato` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
   INDEX `id_commessa` USING BTREE (`id_commessa`),
  CONSTRAINT `tb_documenti_cliente_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE
)ENGINE=InnoDB
AUTO_INCREMENT=2 AVG_ROW_LENGTH=16384 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_fattura` table : 
#

CREATE TABLE `tb_fattura` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` INTEGER(11) DEFAULT NULL,
  `tipo_documento` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `descrizione` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `importo_totale` DOUBLE(15,2) DEFAULT NULL,
  `data_pagamento` DATE DEFAULT NULL,
  `data_incasso` DATE DEFAULT NULL,
  `link_allegato` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
   INDEX `id_commessa` USING BTREE (`id_commessa`),
  CONSTRAINT `tb_fattura_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE
)ENGINE=InnoDB
AUTO_INCREMENT=3 AVG_ROW_LENGTH=8192 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_ral` table : 
#

CREATE TABLE `tb_ral` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` INTEGER(11) DEFAULT NULL,
  `ral` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  `totale_ral` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  `link_allegato` VARCHAR(100) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` VARCHAR(100) COLLATE latin1_general_ci DEFAULT NULL,
  `totale_fatture` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  `data` DATE DEFAULT NULL,
  `note` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `utente` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
   INDEX `id_commessa` USING BTREE (`id_commessa`),
  CONSTRAINT `tb_ral_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE
)ENGINE=InnoDB
AUTO_INCREMENT=9 AVG_ROW_LENGTH=16384 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_fatture_ral` table : 
#

CREATE TABLE `tb_fatture_ral` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_ral` INTEGER(11) DEFAULT NULL,
  `descrizione` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `importo` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  `link_allegato` VARCHAR(100) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` VARCHAR(100) COLLATE latin1_general_ci DEFAULT NULL,
  `note` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data` DATE DEFAULT NULL,
  `utente` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
   INDEX `id_ral` USING BTREE (`id_ral`),
  CONSTRAINT `tb_fatture_ral_fk1` FOREIGN KEY (`id_ral`) REFERENCES `tb_ral` (`id`) ON DELETE CASCADE
)ENGINE=InnoDB
AUTO_INCREMENT=18 AVG_ROW_LENGTH=8192 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_lavoro` table : 
#

CREATE TABLE `tb_lavoro` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `cod_lavoro` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  `descrizione` TEXT COLLATE latin1_general_ci,
  `attivita` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `lavorazione` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  UNIQUE INDEX `id` USING BTREE (`id`)
)ENGINE=InnoDB
AUTO_INCREMENT=9 AVG_ROW_LENGTH=8192 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_log` table : 
#

CREATE TABLE `tb_log` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `operazione` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `utente` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data_inserimento` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `colore` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`)
)ENGINE=InnoDB
AUTO_INCREMENT=2150 AVG_ROW_LENGTH=129 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_magazzino` table : 
#

CREATE TABLE `tb_magazzino` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `data` DATE DEFAULT NULL,
  `mezzo` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `id_mezzo` INTEGER(11) DEFAULT NULL,
  `id_commessa` INTEGER(11) DEFAULT NULL,
  `descrizione_commessa` VARCHAR(512) COLLATE latin1_general_ci DEFAULT NULL,
  `materiale` VARCHAR(512) COLLATE latin1_general_ci DEFAULT NULL,
  `quantita` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  `utente` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `firma` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `id_testata_magazzino` INTEGER(11) DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  UNIQUE INDEX `id` USING BTREE (`id`)
)ENGINE=InnoDB
AUTO_INCREMENT=23 AVG_ROW_LENGTH=3276 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_manutenzione` table : 
#

CREATE TABLE `tb_manutenzione` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `data` DATE DEFAULT NULL,
  `id_mezzo` INTEGER(11) DEFAULT NULL,
  `mezzo` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `utente` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `libretto` TINYINT(1) DEFAULT NULL,
  `assicurazione` TINYINT(1) DEFAULT NULL,
  `olio_cambio` TINYINT(1) DEFAULT NULL,
  `olio_motore` TINYINT(1) DEFAULT NULL,
  `estintori` TINYINT(1) DEFAULT NULL,
  `pneumatici` TINYINT(1) DEFAULT NULL,
  `elettrico` TINYINT(1) DEFAULT NULL,
  `triangolo` TINYINT(1) DEFAULT NULL,
  `giubbino` TINYINT(1) DEFAULT NULL,
  `vetri` TINYINT(1) DEFAULT NULL,
  `pronto_soccorso` TINYINT(1) DEFAULT NULL,
  `carrozzeria` TINYINT(1) DEFAULT NULL,
  `freni` TINYINT(1) DEFAULT NULL,
  `luci` TINYINT(1) DEFAULT NULL,
  `tergicristalli` TINYINT(1) DEFAULT NULL,
  `indicatori` TINYINT(1) DEFAULT NULL,
  `climatizzatore` TINYINT(1) DEFAULT NULL,
  `altro` TINYINT(1) DEFAULT NULL,
  `note` TEXT COLLATE latin1_general_ci,
  PRIMARY KEY USING BTREE (`id`),
  UNIQUE INDEX `id` USING BTREE (`id`)
)ENGINE=InnoDB
AUTO_INCREMENT=7 AVG_ROW_LENGTH=8192 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_materiale` table : 
#

CREATE TABLE `tb_materiale` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` INTEGER(11) DEFAULT NULL,
  `tipo_materiale` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `fornitore` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `costo` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  `quantita` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  `data` DATE DEFAULT NULL,
  `link_allegato` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `importo` VARCHAR(100) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
   INDEX `id_commessa` USING BTREE (`id_commessa`),
  CONSTRAINT `tb_materiale_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE
)ENGINE=InnoDB
AUTO_INCREMENT=11 AVG_ROW_LENGTH=8192 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_ordini` table : 
#

CREATE TABLE `tb_ordini` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` INTEGER(11) DEFAULT NULL,
  `descrizione` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `link_allegato` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
   INDEX `id_commessa` USING BTREE (`id_commessa`),
  CONSTRAINT `tb_ordini_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE
)ENGINE=InnoDB
AUTO_INCREMENT=7 AVG_ROW_LENGTH=16384 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_personale` table : 
#

CREATE TABLE `tb_personale` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` INTEGER(11) DEFAULT NULL,
  `id_dipendente` INTEGER(11) DEFAULT NULL,
  `nome` VARCHAR(100) COLLATE latin1_general_ci DEFAULT NULL,
  `cognome` VARCHAR(100) COLLATE latin1_general_ci DEFAULT NULL,
  `costo_h` VARCHAR(100) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  UNIQUE INDEX `tb_personale_idx1` USING BTREE (`id_commessa`, `id_dipendente`),
   INDEX `id_commessa` USING BTREE (`id_commessa`),
   INDEX `id_dipendente` USING BTREE (`id_dipendente`),
  CONSTRAINT `tb_personale_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE
)ENGINE=InnoDB
AUTO_INCREMENT=1 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_polizza` table : 
#

CREATE TABLE `tb_polizza` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` INTEGER(11) DEFAULT NULL,
  `descrizione` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data_stipula` DATE DEFAULT NULL,
  `scadenza` DATE DEFAULT NULL,
  `importo` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  `link_allegato` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `polizza_svincolata` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
   INDEX `id_commessa` USING BTREE (`id_commessa`),
  CONSTRAINT `tb_polizza_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE
)ENGINE=InnoDB
AUTO_INCREMENT=4 AVG_ROW_LENGTH=8192 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_presenze` table : 
#

CREATE TABLE `tb_presenze` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_dipendente` INTEGER(11) DEFAULT NULL,
  `data` DATE DEFAULT NULL,
  `dettagli` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `n_ore` VARCHAR(100) COLLATE latin1_general_ci DEFAULT NULL,
  `n_giorni` VARCHAR(100) COLLATE latin1_general_ci DEFAULT NULL,
  `id_commessa` INTEGER(11) DEFAULT NULL,
  `costo` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  UNIQUE INDEX `tb_presenze_idx1` USING BTREE (`id_dipendente`, `id_commessa`, `data`, `dettagli`),
   INDEX `id_dipendente` USING BTREE (`id_dipendente`),
   INDEX `id_commessa` USING BTREE (`id_commessa`),
  CONSTRAINT `tb_presenze_fk1` FOREIGN KEY (`id_dipendente`) REFERENCES `tb_dipendenti` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tb_presenze_fk2` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
)ENGINE=InnoDB
AUTO_INCREMENT=2 AVG_ROW_LENGTH=16384 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_programmazione_cantiere` table : 
#

CREATE TABLE `tb_programmazione_cantiere` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` INTEGER(11) DEFAULT NULL,
  `cod_commessa` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `descrizione_commessa` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `cod_lavoro` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  `descrizione_lavoro` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `id_dipendenti` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `addetti` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `id_mezzo` INTEGER(11) DEFAULT NULL,
  `mezzo` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `note` TEXT COLLATE latin1_general_ci,
  `data` DATE DEFAULT NULL,
  `utente` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `id_lavoro` INTEGER(11) DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  UNIQUE INDEX `id` USING BTREE (`id`)
)ENGINE=InnoDB
AUTO_INCREMENT=28 AVG_ROW_LENGTH=2730 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_regolarita` table : 
#

CREATE TABLE `tb_regolarita` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` INTEGER(11) DEFAULT NULL,
  `descrizione` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data` DATE DEFAULT NULL,
  `ente` VARCHAR(100) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `link_allegato` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `scadenza` DATE DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
   INDEX `id_commessa` USING BTREE (`id_commessa`),
  CONSTRAINT `tb_regolarita_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE
)ENGINE=InnoDB
AUTO_INCREMENT=6 AVG_ROW_LENGTH=8192 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_revisioni` table : 
#

CREATE TABLE `tb_revisioni` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` INTEGER(11) DEFAULT NULL,
  `tipo_documento` VARCHAR(100) COLLATE latin1_general_ci DEFAULT NULL,
  `numero_documento` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  `registrato_a` VARCHAR(100) COLLATE latin1_general_ci DEFAULT NULL,
  `data` DATE DEFAULT NULL,
  `link_allegato` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
   INDEX `tb_revisioni_fk1` USING BTREE (`id_commessa`),
  CONSTRAINT `tb_revisioni_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE
)ENGINE=InnoDB
AUTO_INCREMENT=1 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_riserve` table : 
#

CREATE TABLE `tb_riserve` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` INTEGER(11) DEFAULT NULL,
  `descrizione` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data` DATE DEFAULT NULL,
  `dettagli` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `link_allegato` VARCHAR(100) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` VARCHAR(100) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
   INDEX `id_commessa` USING BTREE (`id_commessa`),
  CONSTRAINT `tb_riserve_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE
)ENGINE=InnoDB
AUTO_INCREMENT=11 AVG_ROW_LENGTH=16384 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_ruolino` table : 
#

CREATE TABLE `tb_ruolino` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` INTEGER(11) DEFAULT NULL,
  `cod_commessa` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  `descrizione_commessa` TEXT COLLATE latin1_general_ci,
  `localizzazione_lavoro` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `quantita` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `addetti` VARCHAR(512) COLLATE latin1_general_ci DEFAULT NULL,
  `ore` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  `mezzo` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `km` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  `autista` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `terzi` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `ore_terzi` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  `note` TEXT COLLATE latin1_general_ci,
  `data` DATE DEFAULT NULL,
  `utente` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `cod_lavoro` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `descrizione_lavoro` VARCHAR(512) COLLATE latin1_general_ci DEFAULT NULL,
  `codizioni_climatiche` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `id_lavoro` INTEGER(11) DEFAULT NULL,
  `id_dipendenti` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `id_mezzo` INTEGER(11) DEFAULT NULL,
  `clima` VARCHAR(245) COLLATE latin1_general_ci DEFAULT NULL,
  `tipologia` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  UNIQUE INDEX `id` USING BTREE (`id`),
   INDEX `id_commessa` USING BTREE (`id_commessa`),
  CONSTRAINT `tb_ruolino_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`)
)ENGINE=InnoDB
AUTO_INCREMENT=42 AVG_ROW_LENGTH=2730 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_spese` table : 
#

CREATE TABLE `tb_spese` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_mezzo` INTEGER(11) DEFAULT NULL,
  `tipo` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'Bollo, Assicurazione, Revisioni, Altro',
  `data_ultimo_pagamento` DATE DEFAULT NULL,
  `data_scadenza` DATE DEFAULT NULL,
  `avviso_entro_giorni` INTEGER(11) DEFAULT NULL,
  `riferimento_fattura` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `costo` DOUBLE(15,2) DEFAULT 0.00,
  `eseguito` TINYINT(1) DEFAULT 0,
  PRIMARY KEY USING BTREE (`id`),
   INDEX `id_mezzo` USING BTREE (`id_mezzo`),
  CONSTRAINT `tb_spese_fk1` FOREIGN KEY (`id_mezzo`) REFERENCES `tb_mezzi` (`id`) ON DELETE CASCADE
)ENGINE=InnoDB
AUTO_INCREMENT=2 AVG_ROW_LENGTH=16384 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_tagliando` table : 
#

CREATE TABLE `tb_tagliando` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_mezzo` INTEGER(11) DEFAULT NULL,
  `tipo_tagliando` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data_tagliando` DATE DEFAULT NULL,
  `costo` DOUBLE(15,2) DEFAULT NULL,
  `riferimento_fattura` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `tagliando_ogni` VARCHAR(256) COLLATE latin1_general_ci DEFAULT '0',
  `eseguito` TINYINT(1) DEFAULT 0,
  PRIMARY KEY USING BTREE (`id`),
   INDEX `id_mezzo` USING BTREE (`id_mezzo`),
  CONSTRAINT `tb_tagliando_fk1` FOREIGN KEY (`id_mezzo`) REFERENCES `tb_mezzi` (`id`) ON DELETE CASCADE
)ENGINE=InnoDB
AUTO_INCREMENT=2 AVG_ROW_LENGTH=8192 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_tecnica` table : 
#

CREATE TABLE `tb_tecnica` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `num_preventivo` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  `cliente` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `sopraluogo` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data` DATE DEFAULT NULL,
  `offerta` VARCHAR(512) COLLATE latin1_general_ci DEFAULT NULL,
  `operatore` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `ricontatti` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `esito` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `tipo_cliente` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `tipo_sede` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `motivazione` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data_acquisizione` DATE DEFAULT NULL,
  `modalita` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `link_file` VARCHAR(512) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  UNIQUE INDEX `id` USING BTREE (`id`)
)ENGINE=InnoDB
AUTO_INCREMENT=15 AVG_ROW_LENGTH=16384 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_terzi` table : 
#

CREATE TABLE `tb_terzi` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` INTEGER(11) DEFAULT NULL,
  `data` DATE DEFAULT NULL,
  `descrizione` TEXT COLLATE latin1_general_ci,
  `ore` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  UNIQUE INDEX `id` USING BTREE (`id`)
)ENGINE=InnoDB
AUTO_INCREMENT=14 AVG_ROW_LENGTH=8192 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_testata_magazzino` table : 
#

CREATE TABLE `tb_testata_magazzino` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `mezzo` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `id_mezzo` INTEGER(11) DEFAULT NULL,
  `id_commessa` INTEGER(11) DEFAULT NULL,
  `descrizione_commessa` VARCHAR(512) COLLATE latin1_general_ci DEFAULT NULL,
  `data` DATE DEFAULT NULL,
  `utente` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  UNIQUE INDEX `id` USING BTREE (`id`)
)ENGINE=InnoDB
AUTO_INCREMENT=13 AVG_ROW_LENGTH=4096 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_users` table : 
#

CREATE TABLE `tb_users` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `password` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  `ruolo` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'ADMIN | USER',
  `email` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `mansione` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `nome` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `cognome` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  UNIQUE INDEX `username` USING BTREE (`username`)
)ENGINE=InnoDB
AUTO_INCREMENT=40 AVG_ROW_LENGTH=16384 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_veicoli` table : 
#

CREATE TABLE `tb_veicoli` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` INTEGER(11) DEFAULT NULL,
  `id_mezzo` INTEGER(11) DEFAULT NULL,
  `mezzo` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `targa` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `costo_h` VARCHAR(100) COLLATE latin1_general_ci DEFAULT NULL,
  `data` DATE DEFAULT NULL,
  `km` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  UNIQUE INDEX `tb_veicoli_idx1` USING BTREE (`id_commessa`, `id_mezzo`, `data`),
   INDEX `id_mezzo` USING BTREE (`id_mezzo`),
   INDEX `id_commessa` USING BTREE (`id_commessa`)
)ENGINE=InnoDB
AUTO_INCREMENT=12 AVG_ROW_LENGTH=8192 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_utilizzo` table : 
#

CREATE TABLE `tb_utilizzo` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_mezzo` INTEGER(11) DEFAULT NULL,
  `id_commessa` INTEGER(11) DEFAULT NULL,
  `data` DATE DEFAULT NULL,
  `dettagli` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `n_ore` VARCHAR(100) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
   INDEX `id_commessa` USING BTREE (`id_commessa`),
   INDEX `id_mezzo` USING BTREE (`id_mezzo`),
  CONSTRAINT `tb_utilizzo_fk1` FOREIGN KEY (`id_mezzo`) REFERENCES `tb_veicoli` (`id_mezzo`) ON DELETE CASCADE
)ENGINE=InnoDB
AUTO_INCREMENT=1 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Data for the `tb_commesse` table  (LIMIT -496,500)
#

INSERT INTO `tb_commesse` (`id`, `codice`, `descrizione`, `localita`, `data_inizio`, `data_fine`, `status`, `annotazioni`, `cantiere`, `importo`, `tipologia_lavori`, `referente`, `telefono`, `fax`, `cellulare`, `utente`, `campo1`, `campo2`, `campo3`, `campo4`, `campo5`, `email`, `indirizzo_referente`, `pi`, `pec`) VALUES

  (1,'12/01','prova commessa 1','Potenza','2014-10-07','0000-00-00',NULL,'asdfsd sdf asdf sdaf sdf sdf sdf asdf dsfa sdf','Potenza via Anzio1','10000,21','Ristrutturazione','Condiminio via anzio','no','no','no','admin','a','a','a','a','a','2222','1111','4444','3333'),
  (4,'123','prova commessa 2','Potenza','2014-12-10','0000-00-00',NULL,'','Via Rocco Scotellaro','12','12','12','12','12','12','admin',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
  (6,'001','Casa_Della_Salute','Avigliano','2014-12-29','0000-00-00',NULL,'','Casa_Della_Salute','111','Casa_Della_Salute','Casa_Della_Salute','1','11','1','admin',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
COMMIT;

#
# Data for the `tb_allegati` table  (LIMIT -495,500)
#

INSERT INTO `tb_allegati` (`id`, `n_sospensioni`, `descrizione`, `verbale_n`, `link_allegato`, `id_commessa`, `file_name`, `data`) VALUES

  (7,1,'Foto','','uploads/commesse/1/cantiere/collina.png',1,'collina.png','2015-01-08'),
  (9,1,'ddd','','uploads/commesse/1/cantiere/cappello.png',1,'cappello.png','2015-01-09'),
  (10,1,'AAA','','uploads/commesse/4/cantiere/ore_lavoro.xlsx',4,'ore_lavoro.xlsx','2015-01-15'),
  (11,1,'prova','','uploads/commesse/4/cantiere/prova.rtf',4,'prova.rtf','2015-01-15');
COMMIT;

#
# Data for the `tb_allegati_comunicazioni` table  (LIMIT -496,500)
#

INSERT INTO `tb_allegati_comunicazioni` (`id`, `id_comunicazione`, `link`, `descrizione`, `utente`, `file_name`) VALUES

  (15,5,'uploads/comunicazioni/5/cappello.png','cappello','admin','cappello.png'),
  (16,7,'uploads/comunicazioni/7/cappello - Copia.png','dasd','admin','cappello - Copia.png'),
  (17,7,'uploads/comunicazioni/7/collina - Copia.png','asdds','admin','collina - Copia.png');
COMMIT;

#
# Data for the `tb_dipendenti` table  (LIMIT -493,500)
#

INSERT INTO `tb_dipendenti` (`id`, `nome`, `cognome`, `attivo`) VALUES

  (5,'Mario','Rossi','ATTIVO'),
  (6,'Franco','Bianchi','ATTIVO'),
  (7,'Rocco','Verdi','ATTIVO'),
  (8,'Luca','Liscio','NON_ATTIVO'),
  (9,'Franca','Salvia','ATTIVO'),
  (10,'Maria ','Ianni','ATTIVO');
COMMIT;

#
# Data for the `tb_allegati_dipendenti` table  (LIMIT -497,500)
#

INSERT INTO `tb_allegati_dipendenti` (`id`, `id_dipendente`, `id_commessa`, `data`, `scadenza`, `descrizione`, `link_allegato`, `nome_allegato`) VALUES

  (1,5,NULL,'2014-10-31','2014-10-31','aa','uploads/dipendenti/5/','cappello - Copia.png'),
  (2,5,NULL,'2014-10-31','2014-10-31','aa','uploads/dipendenti/5/','31_10_2014_08_43_27cappello - Copia.png');
COMMIT;

#
# Data for the `tb_gara` table  (LIMIT -498,500)
#

INSERT INTO `tb_gara` (`id`, `descrizione`, `data_emissione`, `data_scadenza`, `polizze`, `avcp`, `passoe`, `utente`) VALUES

  (7,'2','2015-01-15','2015-01-15','2','2','2','admin');
COMMIT;

#
# Data for the `tb_allegati_gare` table  (LIMIT -498,500)
#

INSERT INTO `tb_allegati_gare` (`id`, `descrizione`, `link_file`, `filename`, `utente`, `id_gara`) VALUES

  (10,'fsdf','uploads/gare/7/','collina.png','admin',7);
COMMIT;

#
# Data for the `tb_noleggi` table  (LIMIT -498,500)
#

INSERT INTO `tb_noleggi` (`id`, `id_commessa`, `numero`, `descrizione`, `importo`, `fornitore`, `data`) VALUES

  (9,1,'123','AUTO','100','FIAT','2014-10-08');
COMMIT;

#
# Data for the `tb_allegati_noleggi` table  (LIMIT -498,500)
#

INSERT INTO `tb_allegati_noleggi` (`id`, `id_noleggio`, `descrizione`, `link_allegato`, `nome_allegato`) VALUES

  (19,9,'Contratto','uploads/commesse/1/noleggi/9/','cappello.png');
COMMIT;

#
# Data for the `tb_ordini_commessa` table  (LIMIT -496,500)
#

INSERT INTO `tb_ordini_commessa` (`id`, `id_commessa`, `cod_commessa`, `descrizione_commessa`, `fornitore`, `utente`) VALUES

  (12,1,'12/01','prova commessa 1','Jetbit',NULL),
  (13,1,'12/01','prova commessa 1','K2',NULL),
  (14,1,'12/01','prova commessa 1','prova',NULL);
COMMIT;

#
# Data for the `tb_allegati_ordini_commessa` table  (LIMIT -495,500)
#

INSERT INTO `tb_allegati_ordini_commessa` (`id`, `descrizione`, `data`, `id_ordine_commessa`, `link_file`, `filename`, `tipologia`) VALUES

  (10,'fattura','2015-01-16',14,'../uploads/commesse/1/ordini_commessa/14/cappello.png','cappello.png',NULL),
  (11,'DDT 123','2015-01-17',14,'../uploads/commesse/1/ordini_commessa/14/collina.png','collina.png',NULL),
  (12,'fds','2015-01-16',12,'../uploads/commesse/1/ordini_commessa/12/collina.png','collina.png','FATTURA'),
  (13,'ffff','2015-01-16',12,'../uploads/commesse/1/ordini_commessa/12/foto.png','foto.png','DDT');
COMMIT;

#
# Data for the `tb_mezzi` table  (LIMIT -497,500)
#

INSERT INTO `tb_mezzi` (`id`, `mezzo`, `targa`, `km_percorsi`, `data_ultimo_aggiornamento_km`, `tagliando_ogni`, `km_ultimo_tagliando`, `costo_totale`) VALUES

  (1,'Clio','AA123EE','12002','2014-12-10','3000',NULL,0.00),
  (2,'Altro','11234','123','2015-01-09','22312',NULL,0.00);
COMMIT;

#
# Data for the `tb_benzina` table  (LIMIT -498,500)
#

INSERT INTO `tb_benzina` (`id`, `id_mezzo`, `n_ticket`, `localita`, `targa`, `codice_autista`, `km_veicolo`, `prodotto_servizio`, `quantita_litri`, `importo_ticket`, `prezzo_pompa`, `sconto`, `prezzo_escluso_iva`, `importo_netto`, `aliq_iva`, `importo_iva`, `totale_iva_inclusa`, `numero_carta`, `titolare_carta`, `data`) VALUES

  (8,1,NULL,'POTENZA','AA123EE','','3181','Gasolio Autotrazione','60,84','96.01','157,81','3','126,89','77,20','22','16.98','94.18','7033161200630597','059 IANNIELLI G.R.','2014-09-15');
COMMIT;

#
# Data for the `tb_verbali` table  (LIMIT -498,500)
#

INSERT INTO `tb_verbali` (`id`, `id_commessa`, `descrizione`, `data`, `importo`, `link_allegato`, `nome_allegato`) VALUES

  (11,1,'Lorem Ipsum','2014-10-08','5.000','uploads/commesse/1/verbali/','prova.pdf');
COMMIT;

#
# Data for the `tb_categorie` table  (LIMIT -497,500)
#

INSERT INTO `tb_categorie` (`id`, `id_verbale`, `descrizione`, `importo`) VALUES

  (6,11,'Cat A','1000'),
  (7,11,'Cat B','3000');
COMMIT;

#
# Data for the `tb_comunicazioni` table  (LIMIT -497,500)
#

INSERT INTO `tb_comunicazioni` (`id`, `data`, `id_commessa`, `descrizione_commessa`, `tipo_comunicazione`, `destinatario`, `testo`, `note`, `utente`) VALUES

  (5,'2015-01-12',1,'prova commessa 1','EMAIL','A','aas','','admin'),
  (7,'2015-01-12',1,'prova commessa 1','FAX','sadas','dasdsd','asdasd','admin');
COMMIT;

#
# Data for the `tb_costi` table  (LIMIT -492,500)
#

INSERT INTO `tb_costi` (`id`, `id_dipendente`, `data_inizio`, `data_fine`, `costo`, `mese`, `anno`) VALUES

  (1,5,'2014-12-01','2014-12-31','20','DICEMBRE','2014'),
  (2,6,'2014-12-01','2014-12-31','20','DICEMBRE','2014'),
  (3,7,'2014-12-01','2014-12-31','20','DICEMBRE','2014'),
  (4,5,'2015-01-01','2015-01-31','15','GENNAIO','2015'),
  (5,10,'2015-01-01','2015-01-31','20','GENNAIO','2015'),
  (6,10,'2014-01-01','2014-01-31','20','GENNAIO','2014'),
  (7,9,'2014-12-01','2014-12-31','12','DICEMBRE','2014');
COMMIT;

#
# Data for the `tb_documentazione` table  (LIMIT -497,500)
#

INSERT INTO `tb_documentazione` (`id`, `id_commessa`, `data`, `descrizione`, `link_allegato`, `nome_allegato`) VALUES

  (10,1,'2014-10-08','Doc 1','uploads/commesse/1/documentazioni/','prova.pdf'),
  (11,1,'2014-10-06','Doc 2','uploads/commesse/1/documentazioni/','');
COMMIT;

#
# Data for the `tb_documenti_cliente` table  (LIMIT -498,500)
#

INSERT INTO `tb_documenti_cliente` (`id`, `id_commessa`, `descrizione`, `ente_rilascio`, `data`, `validita`, `scadenza`, `rinnovo`, `link_allegato`, `nome_allegato`) VALUES

  (1,1,'Lorem ipsum','Comune di Avigliano','2014-10-08','0000-00-00','0000-00-00','0000-00-00','uploads/commesse/1/documenti_cliente/','prova.pdf');
COMMIT;

#
# Data for the `tb_fattura` table  (LIMIT -497,500)
#

INSERT INTO `tb_fattura` (`id`, `id_commessa`, `tipo_documento`, `descrizione`, `importo_totale`, `data_pagamento`, `data_incasso`, `link_allegato`, `nome_allegato`) VALUES

  (1,1,'Fattura','Lorem Ipsum',5.00,'2014-10-06','2014-10-08','uploads/commesse/1/fatture/','prova.pdf'),
  (2,1,'1','1',1.00,'2014-10-23','0000-00-00','uploads/commesse/1/fatture/','');
COMMIT;

#
# Data for the `tb_lavoro` table  (LIMIT -497,500)
#

INSERT INTO `tb_lavoro` (`id`, `cod_lavoro`, `descrizione`, `attivita`, `lavorazione`) VALUES

  (5,'1','','verifica del massetto esistente','IMPERMEABILIZZAZIONI scheda n. 01'),
  (8,'1','','demolizione del pavimento esistente','PAVIMENTAZIONI TERRAZZI scheda n. 02');
COMMIT;

#
# Data for the `tb_log` table  (LIMIT 1,500)
#

INSERT INTO `tb_log` (`id`, `operazione`, `utente`, `data_inserimento`, `colore`) VALUES

  (1437,'Inserimento spesa','admin','2014-12-29 09:09:32','verde'),
  (1438,'Eliminazione spesa','admin','2014-12-29 09:09:50','rosso'),
  (1439,'Inserimento presenza','admin','2014-12-29 09:12:18','verde'),
  (1440,'Inserimento presenza','admin','2014-12-29 09:12:48','verde'),
  (1441,'Inserimento presenza','admin','2014-12-29 09:12:55','verde'),
  (1442,'Eliminazione presenza','admin','2014-12-29 09:12:59','rosso'),
  (1443,'Inserimento fattura SAL: aaa | Sal 1','admin','2014-12-29 09:16:30','verde'),
  (1444,'Eliminazione Fattura SAL: Sal 1','admin','2014-12-29 09:17:00','rosso'),
  (1445,'Eliminazione Fattura SAL: Sal 1','admin','2014-12-29 09:17:03','rosso'),
  (1446,'Inserimento presenza','admin','2014-12-29 11:53:54','verde'),
  (1447,'Inserimento presenza','admin','2014-12-29 11:54:03','verde'),
  (1448,'Inserimento presenza','admin','2014-12-29 11:54:07','verde'),
  (1449,'Eliminazione presenza','admin','2014-12-29 11:54:09','rosso'),
  (1450,'Inserimento presenza','admin','2014-12-29 11:54:51','verde'),
  (1451,'Eliminazione presenza','admin','2014-12-29 11:54:58','rosso'),
  (1452,'Inserimento commessa','admin','2014-12-29 11:57:42','verde'),
  (1453,'Eliminazione commessa','admin','2014-12-29 11:57:47','rosso'),
  (1454,'Eliminazione presenza','admin','2014-12-29 11:57:56','rosso'),
  (1455,'Inserimento presenza','admin','2014-12-29 11:57:59','verde'),
  (1456,'Eliminazione presenza','admin','2014-12-29 12:00:57','rosso'),
  (1457,'Inserimento presenza','admin','2014-12-29 12:01:01','verde'),
  (1458,'Eliminazione presenza','admin','2014-12-29 12:01:03','rosso'),
  (1459,'Inserimento commessa','admin','2014-12-29 12:03:01','verde'),
  (1460,'Modifica Cantiere','admin','2014-12-29 12:03:50','blu'),
  (1461,'Modifica commessa','admin','2014-12-29 12:03:58','blu'),
  (1462,'Inserimento presenza','admin','2014-12-29 12:04:06','verde'),
  (1463,'Eliminazione presenza','admin','2014-12-29 12:04:09','rosso'),
  (1464,'Inserimento presenza','admin','2014-12-29 12:07:05','verde'),
  (1465,'Eliminazione presenza','admin','2014-12-29 12:07:09','rosso'),
  (1466,'Inserimento presenza','admin','2014-12-29 12:17:46','verde'),
  (1467,'Eliminazione presenza','admin','2014-12-29 12:26:51','rosso'),
  (1468,'Eliminazione presenza','admin','2014-12-29 12:27:01','rosso'),
  (1469,'Inserimento presenza','admin','2014-12-29 17:02:09','verde'),
  (1470,'Inserimento presenza','admin','2014-12-29 17:07:01','verde'),
  (1471,'Inserimento presenza','admin','2014-12-29 17:07:10','verde'),
  (1472,'Inserimento presenza','admin','2014-12-29 17:07:21','verde'),
  (1473,'Inserimento presenza','admin','2014-12-29 17:08:12','verde'),
  (1474,'Inserimento presenza','admin','2014-12-29 17:08:25','verde'),
  (1475,'Inserimento presenza','admin','2014-12-29 17:10:47','verde'),
  (1476,'Inserimento presenza','admin','2014-12-29 17:17:19','verde'),
  (1477,'Inserimento presenza','admin','2014-12-29 17:17:57','verde'),
  (1478,'Eliminazione presenza','admin','2014-12-29 17:18:56','rosso'),
  (1479,'Inserimento presenza','admin','2014-12-29 17:19:40','verde'),
  (1480,'Eliminazione presenza','admin','2014-12-29 17:19:51','rosso'),
  (1481,'Eliminazione presenza','admin','2014-12-29 17:20:27','rosso'),
  (1482,'Inserimento veicolo','admin','2014-12-29 17:29:36','verde'),
  (1483,'Eliminazione presenza','admin','2014-12-29 17:34:02','rosso'),
  (1484,'Inserimento presenza','admin','2014-12-29 19:02:05','verde'),
  (1485,'Inserimento presenza','admin','2014-12-29 19:02:09','verde'),
  (1486,'Inserimento presenza','admin','2014-12-29 19:02:15','verde'),
  (1487,'Inserimento presenza','admin','2014-12-29 19:02:19','verde'),
  (1488,'Inserimento presenza','admin','2014-12-29 19:02:20','verde'),
  (1489,'Inserimento presenza','admin','2014-12-29 19:02:23','verde'),
  (1490,'Inserimento presenza','admin','2014-12-29 19:02:24','verde'),
  (1491,'Inserimento presenza','admin','2014-12-29 19:02:34','verde'),
  (1492,'Eliminazione presenza','admin','2014-12-29 19:02:38','rosso'),
  (1493,'Inserimento SAL: jj','admin','2015-01-07 11:42:12','verde'),
  (1494,'Inserimento utilizzo mezzo','admin','2015-01-07 12:48:05','verde'),
  (1495,'Eliminazione utilizzo mezzo','admin','2015-01-07 12:48:11','rosso'),
  (1496,'Eliminazione programmazione giornaliere cantiere','admin','2015-01-07 16:03:32','rosso'),
  (1497,'Eliminazione programmazione giornaliere cantiere','admin','2015-01-07 16:04:22','rosso'),
  (1498,'Inserimento programmazione giornaliera cantiere','admin','2015-01-07 16:42:47','verde'),
  (1499,'Inserimento programmazione giornaliera cantiere','admin','2015-01-07 16:43:21','verde'),
  (1500,'Inserimento programmazione giornaliera cantiere','admin','2015-01-07 16:43:39','verde'),
  (1501,'Inserimento programmazione giornaliera cantiere','admin','2015-01-07 16:44:00','verde'),
  (1502,'Inserimento programmazione giornaliera cantiere','admin','2015-01-07 16:44:16','verde'),
  (1503,'Inserimento programmazione giornaliera cantiere','admin','2015-01-07 16:44:38','verde'),
  (1504,'Inserimento programmazione giornaliera cantiere','admin','2015-01-07 16:45:56','verde'),
  (1505,'Inserimento programmazione giornaliera cantiere','admin','2015-01-07 16:47:13','verde'),
  (1506,'Inserimento programmazione giornaliera cantiere','admin','2015-01-07 16:47:51','verde'),
  (1507,'Inserimento programmazione giornaliera cantiere','admin','2015-01-07 16:48:40','verde'),
  (1508,'Inserimento programmazione giornaliera cantiere','admin','2015-01-07 16:50:22','verde'),
  (1509,'Inserimento programmazione giornaliera cantiere','admin','2015-01-07 16:51:16','verde'),
  (1510,'Inserimento programmazione giornaliera cantiere','admin','2015-01-07 16:52:12','verde'),
  (1511,'Inserimento programmazione giornaliera cantiere','admin','2015-01-07 16:53:43','verde'),
  (1512,'Inserimento programmazione giornaliera cantiere','admin','2015-01-07 16:54:52','verde'),
  (1513,'Eliminazione programmazione giornaliere cantiere','admin','2015-01-07 16:56:31','rosso'),
  (1514,'Eliminazione programmazione giornaliere cantiere','admin','2015-01-07 16:57:04','rosso'),
  (1515,'Eliminazione programmazione giornaliere cantiere','admin','2015-01-07 16:57:33','rosso'),
  (1516,'Eliminazione programmazione giornaliere cantiere','admin','2015-01-07 16:57:50','rosso'),
  (1517,'Eliminazione programmazione giornaliere cantiere','admin','2015-01-07 16:57:52','rosso'),
  (1518,'Eliminazione programmazione giornaliere cantiere','admin','2015-01-07 16:57:54','rosso'),
  (1519,'Inserimento programmazione giornaliera cantiere','admin','2015-01-07 16:58:06','verde'),
  (1520,'Eliminazione programmazione giornaliere cantiere','admin','2015-01-07 16:58:30','rosso'),
  (1521,'Inserimento programmazione giornaliera cantiere','admin','2015-01-07 16:58:59','verde'),
  (1522,'Inserimento programmazione giornaliera cantiere','admin','2015-01-07 17:01:21','verde'),
  (1523,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 17:08:35','verde'),
  (1524,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 17:10:44','verde'),
  (1525,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 17:10:54','verde'),
  (1526,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 17:11:03','verde'),
  (1527,'Inserimento programmazione giornaliera cantiere','admin','2015-01-07 17:15:58','verde'),
  (1528,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 17:18:56','verde'),
  (1529,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 17:21:09','verde'),
  (1530,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 17:21:52','verde'),
  (1531,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 17:21:58','verde'),
  (1532,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 17:49:58','verde'),
  (1533,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 17:50:03','verde'),
  (1534,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 17:50:17','verde'),
  (1535,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 17:50:59','verde'),
  (1536,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 17:51:14','verde'),
  (1537,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 17:54:18','verde'),
  (1538,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 17:56:11','verde'),
  (1539,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 17:56:49','verde'),
  (1540,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 17:56:59','verde'),
  (1541,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 17:57:04','verde'),
  (1542,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:04:35','verde'),
  (1543,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:04:38','verde'),
  (1544,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:04:40','verde'),
  (1545,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:04:47','verde'),
  (1546,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:04:59','verde'),
  (1547,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:05:15','verde'),
  (1548,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:05:21','verde'),
  (1549,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:05:26','verde'),
  (1550,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:05:38','verde'),
  (1551,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:06:44','verde'),
  (1552,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:06:48','verde'),
  (1553,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:07:09','verde'),
  (1554,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:07:11','verde'),
  (1555,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:07:12','verde'),
  (1556,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:07:14','verde'),
  (1557,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:07:14','verde'),
  (1558,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:07:15','verde'),
  (1559,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:07:21','verde'),
  (1560,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:07:25','verde'),
  (1561,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:07:26','verde'),
  (1562,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:21:08','verde'),
  (1563,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:21:21','verde'),
  (1564,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:21:30','verde'),
  (1565,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:21:38','verde'),
  (1566,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:29:31','verde'),
  (1567,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:30:24','verde'),
  (1568,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:32:12','verde'),
  (1569,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:33:41','verde'),
  (1570,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:33:46','verde'),
  (1571,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:33:58','verde'),
  (1572,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:35:28','verde'),
  (1573,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:35:54','verde'),
  (1574,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:36:45','verde'),
  (1575,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:36:53','verde'),
  (1576,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:37:58','verde'),
  (1577,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:40:55','verde'),
  (1578,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:41:47','verde'),
  (1579,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:41:53','verde'),
  (1580,'Inserimento programmazione giornaliera cantiere','admin','2015-01-07 18:42:04','verde'),
  (1581,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:43:07','verde'),
  (1582,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:44:12','verde'),
  (1583,'Inserimento programmazione giornaliera cantiere','admin','2015-01-07 18:46:52','verde'),
  (1584,'Eliminazione programmazione giornaliere cantiere','admin','2015-01-07 18:47:02','rosso'),
  (1585,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:47:09','verde'),
  (1586,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:47:30','verde'),
  (1587,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:49:46','verde'),
  (1588,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 18:50:09','verde'),
  (1589,'Eliminazione programmazione giornaliere cantiere','admin','2015-01-07 18:51:00','rosso'),
  (1590,'Inserimento programmazione giornaliera cantiere','admin','2015-01-07 18:51:13','verde'),
  (1591,'Eliminazione programmazione giornaliere cantiere','admin','2015-01-07 18:51:26','rosso'),
  (1592,'Inserimento programmazione giornaliera cantiere','admin','2015-01-07 18:51:38','verde'),
  (1593,'Eliminazione programmazione giornaliere cantiere','admin','2015-01-07 18:51:57','rosso'),
  (1594,'Inserimento programmazione giornaliera cantiere','admin','2015-01-07 18:52:25','verde'),
  (1595,'Eliminazione programmazione giornaliere cantiere','admin','2015-01-07 18:52:33','rosso'),
  (1596,'Inserimento programmazione giornaliera cantiere','admin','2015-01-07 18:53:07','verde'),
  (1597,'Eliminazione programmazione giornaliere cantiere','admin','2015-01-07 18:54:16','rosso'),
  (1598,'Eliminazione programmazione giornaliere cantiere','admin','2015-01-07 18:54:49','rosso'),
  (1599,'Inserimento programmazione giornaliera cantiere','admin','2015-01-07 19:01:42','verde'),
  (1600,'Inserimento programmazione giornaliera cantiere','admin','2015-01-07 19:29:22','verde'),
  (1601,'Modifica programmazione giornaliera cantiere','admin','2015-01-07 19:29:30','verde'),
  (1602,'Eliminazione programmazione giornaliere cantiere','admin','2015-01-07 19:29:34','rosso'),
  (1603,'Inserimento programmazione giornaliera cantiere','admin','2015-01-08 09:30:13','verde'),
  (1604,'Modifica programmazione giornaliera cantiere','admin','2015-01-08 10:43:46','verde'),
  (1605,'Inserimento programmazione giornaliera cantiere','admin','2015-01-08 10:47:02','verde'),
  (1606,'Eliminazione programmazione giornaliere cantiere','admin','2015-01-08 10:47:07','rosso'),
  (1607,'Eliminazione programmazione giornaliere cantiere','admin','2015-01-08 11:08:23','rosso'),
  (1608,'Eliminazione ruolino giornaliero','admin','2015-01-08 11:10:12','rosso'),
  (1609,'Inserimento ruolino giornaliero','admin','2015-01-08 11:31:15','verde'),
  (1610,'Inserimento ruolino giornaliero','admin','2015-01-08 11:31:46','verde'),
  (1611,'Inserimento ruolino giornaliero','admin','2015-01-08 11:32:03','verde'),
  (1612,'Inserimento ruolino giornaliero','admin','2015-01-08 11:32:15','verde'),
  (1613,'Eliminazione ruolino giornaliero','admin','2015-01-08 11:34:21','rosso'),
  (1614,'Eliminazione ruolino giornaliero','admin','2015-01-08 11:34:23','rosso'),
  (1615,'Inserimento ruolino giornaliero','admin','2015-01-08 11:35:48','verde'),
  (1616,'Eliminazione ruolino giornaliero','admin','2015-01-08 11:35:54','rosso'),
  (1617,'Inserimento ruolino giornaliero','admin','2015-01-08 11:39:41','verde'),
  (1618,'Inserimento ruolino giornaliero','admin','2015-01-08 11:39:46','verde'),
  (1619,'Inserimento ruolino giornaliero','admin','2015-01-08 11:40:21','verde'),
  (1620,'Inserimento ruolino giornaliero','admin','2015-01-08 11:40:35','verde'),
  (1621,'Inserimento ruolino giornaliero','admin','2015-01-08 11:41:47','verde'),
  (1622,'Eliminazione ruolino giornaliero','admin','2015-01-08 11:41:55','rosso'),
  (1623,'Eliminazione ruolino giornaliero','admin','2015-01-08 11:41:56','rosso'),
  (1624,'Inserimento ruolino giornaliero','admin','2015-01-08 11:42:23','verde'),
  (1625,'Modifica ruolino giornaliero','admin','2015-01-08 11:51:18','verde'),
  (1626,'Modifica ruolino giornaliero','admin','2015-01-08 11:51:26','verde'),
  (1627,'Modifica ruolino giornaliero','admin','2015-01-08 11:52:18','verde'),
  (1628,'Modifica ruolino giornaliero','admin','2015-01-08 11:52:44','verde'),
  (1629,'Modifica ruolino giornaliero','admin','2015-01-08 11:53:52','verde'),
  (1630,'Modifica ruolino giornaliero','admin','2015-01-08 12:06:02','verde'),
  (1631,'Modifica ruolino giornaliero','admin','2015-01-08 12:13:55','verde'),
  (1632,'Modifica ruolino giornaliero','admin','2015-01-08 12:15:52','verde'),
  (1633,'Modifica ruolino giornaliero','admin','2015-01-08 12:16:38','verde'),
  (1634,'Modifica programmazione giornaliera cantiere','admin','2015-01-08 12:19:33','verde'),
  (1635,'Modifica programmazione giornaliera cantiere','admin','2015-01-08 12:20:54','verde'),
  (1636,'Modifica programmazione giornaliera cantiere','admin','2015-01-08 12:23:51','verde'),
  (1637,'Modifica ruolino giornaliero','admin','2015-01-08 12:29:15','verde'),
  (1638,'Inserimento ruolino giornaliero','admin','2015-01-08 12:32:01','verde'),
  (1639,'Eliminazione personale','admin','2015-01-08 12:47:18','rosso'),
  (1640,'Eliminazione revisione contrattuale: id=1','admin','2015-01-08 15:59:16','rosso'),
  (1641,'Eliminazione tecnica: id=1','admin','2015-01-08 15:59:40','rosso'),
  (1642,'Inserimento preventivo:  | id=2','admin','2015-01-08 16:26:32','verde'),
  (1643,'Inserimento preventivo:  | id=3','admin','2015-01-08 16:27:36','verde'),
  (1644,'Eliminazione tecnica: id=3','admin','2015-01-08 16:27:58','rosso'),
  (1645,'Eliminazione tecnica: id=4','admin','2015-01-08 16:29:38','rosso'),
  (1646,'Inserimento preventivo:  | id=5','admin','2015-01-08 16:29:42','verde'),
  (1647,'Eliminazione tecnica: id=5','admin','2015-01-08 16:30:10','rosso'),
  (1648,'Inserimento preventivo:  | id=6','admin','2015-01-08 16:30:14','verde'),
  (1649,'Eliminazione tecnica: id=6','admin','2015-01-08 16:31:26','rosso'),
  (1650,'Inserimento preventivo:  | id=7','admin','2015-01-08 16:31:29','verde'),
  (1651,'Inserimento preventivo:  | id=8','admin','2015-01-08 16:34:29','verde'),
  (1652,'Eliminazione allegato preventivo: ','admin','2015-01-08 16:36:56','rosso'),
  (1653,'Eliminazione allegato preventivo: ../uploads/tecnica/7/','admin','2015-01-08 16:37:49','rosso'),
  (1654,'Inserimento preventivo:  | id=9','admin','2015-01-08 16:38:40','verde'),
  (1655,'Eliminazione tecnica: id=9','admin','2015-01-08 16:39:21','rosso'),
  (1656,'Eliminazione tecnica: id=8','admin','2015-01-08 16:39:24','rosso'),
  (1657,'Eliminazione tecnica: id=7','admin','2015-01-08 16:39:27','rosso'),
  (1658,'Inserimento preventivo:  | id=10','admin','2015-01-08 16:39:29','verde'),
  (1659,'Eliminazione tecnica: id=10','admin','2015-01-08 16:39:41','rosso'),
  (1660,'Inserimento preventivo:  | id=11','admin','2015-01-08 16:40:40','verde'),
  (1661,'Inserimento preventivo:  | id=12','admin','2015-01-08 16:41:02','verde'),
  (1662,'Eliminazione allegato preventivo: ../uploads/tecnica/11/','admin','2015-01-08 16:41:55','rosso'),
  (1663,'Eliminazione tecnica: id=11','admin','2015-01-08 16:42:02','rosso'),
  (1664,'Eliminazione allegato preventivo: ','admin','2015-01-08 16:45:05','rosso'),
  (1665,'Eliminazione tecnica: id=12','admin','2015-01-08 16:45:14','rosso'),
  (1666,'Inserimento preventivo:  | id=13','admin','2015-01-08 16:45:44','verde'),
  (1667,'Eliminazione tecnica: id=13','admin','2015-01-08 16:45:48','rosso'),
  (1668,'Inserimento preventivo:  | id=14','admin','2015-01-08 16:48:40','verde'),
  (1669,'Inserimento preventivo:  | id=15','admin','2015-01-08 16:49:04','verde'),
  (1670,'Eliminazione tecnica: id=15','admin','2015-01-08 16:49:07','rosso'),
  (1671,'Modifica preventivo','admin','2015-01-08 16:49:12','blu'),
  (1672,'Modifica preventivo','admin','2015-01-08 16:50:06','blu'),
  (1673,'Eliminazione allegato preventivo: ','admin','2015-01-08 16:50:15','rosso'),
  (1674,'Modifica preventivo','admin','2015-01-08 16:50:17','blu'),
  (1675,'Modifica preventivo','admin','2015-01-08 16:50:23','blu'),
  (1676,'Eliminazione allegato preventivo: ','admin','2015-01-08 16:50:37','rosso'),
  (1677,'Modifica preventivo','admin','2015-01-08 16:52:28','blu'),
  (1678,'Modifica preventivo','admin','2015-01-08 16:52:33','blu'),
  (1679,'Eliminazione allegato preventivo: ','admin','2015-01-08 16:53:02','rosso'),
  (1680,'Modifica preventivo','admin','2015-01-08 16:54:42','blu'),
  (1681,'Modifica preventivo','admin','2015-01-08 16:54:45','blu'),
  (1682,'Eliminazione allegato preventivo: ','admin','2015-01-08 16:54:49','rosso'),
  (1683,'Modifica preventivo','admin','2015-01-08 16:55:11','blu'),
  (1684,'Modifica preventivo','admin','2015-01-08 16:55:16','blu'),
  (1685,'Modifica preventivo','admin','2015-01-08 16:55:26','blu'),
  (1686,'Modifica preventivo','admin','2015-01-08 16:55:51','blu'),
  (1687,'Modifica preventivo','admin','2015-01-08 16:56:08','blu'),
  (1688,'Inserimento preventivo:  | id=16','admin','2015-01-08 16:56:38','verde'),
  (1689,'Modifica preventivo','admin','2015-01-08 16:57:35','blu'),
  (1690,'Modifica preventivo','admin','2015-01-08 17:31:58','blu'),
  (1691,'Modifica preventivo','admin','2015-01-08 17:32:04','blu'),
  (1692,'Modifica preventivo','admin','2015-01-08 17:32:55','blu'),
  (1693,'Modifica preventivo','admin','2015-01-08 17:33:47','blu'),
  (1694,'Modifica preventivo','admin','2015-01-08 17:34:46','blu'),
  (1695,'Eliminazione tecnica: id=16','admin','2015-01-08 17:34:52','rosso'),
  (1696,'Eliminazione ruolino giornaliero','admin','2015-01-08 17:40:59','rosso'),
  (1697,'Inserimento ruolino giornaliero','admin','2015-01-08 17:41:26','verde'),
  (1698,'Inserimento ruolino giornaliero','admin','2015-01-08 17:42:04','verde'),
  (1699,'Eliminazione tecnica: id=2','admin','2015-01-08 18:15:50','rosso'),
  (1700,'Eliminazione tecnica: id=1','admin','2015-01-08 18:17:43','rosso'),
  (1701,'Inserimento preventivo:  | id=17','admin','2015-01-08 18:18:51','verde'),
  (1702,'Inserimento attivita: ','admin','2015-01-08 18:30:10','verde'),
  (1703,'Inserimento attivita: ','admin','2015-01-08 18:30:53','verde'),
  (1704,'Inserimento attivita: ','admin','2015-01-08 18:31:20','verde'),
  (1705,'Eliminazione tecnica: id=4','admin','2015-01-08 18:31:23','rosso'),
  (1706,'Eliminazione tecnica: id=3','admin','2015-01-08 18:31:25','rosso'),
  (1707,'Modifica attivita','admin','2015-01-08 18:33:13','blu'),
  (1708,'Modifica attivita','admin','2015-01-08 18:33:17','blu'),
  (1709,'Modifica attivita','admin','2015-01-08 18:33:22','blu'),
  (1710,'Inserimento attivita: ','admin','2015-01-08 18:33:27','verde'),
  (1711,'Eliminazione attivita: id=6','admin','2015-01-08 18:33:50','rosso'),
  (1712,'Modifica attivita','admin','2015-01-08 18:37:43','blu'),
  (1713,'Modifica attivita','admin','2015-01-08 18:46:22','blu'),
  (1714,'Modifica attivita','admin','2015-01-08 18:46:50','blu'),
  (1715,'Modifica ruolino giornaliero','admin','2015-01-08 18:48:39','verde'),
  (1716,'Modifica ruolino giornaliero','admin','2015-01-08 18:49:20','verde'),
  (1717,'Inserimento attivita: ','admin','2015-01-08 18:52:13','verde'),
  (1718,'Eliminazione attivita: id=7','admin','2015-01-08 18:52:18','rosso'),
  (1719,'Modifica attivita','admin','2015-01-08 18:52:50','blu'),
  (1720,'Inserimento attivita: ','admin','2015-01-08 18:53:27','verde'),
  (1721,'Inserimento preventivo:  | id=18','admin','2015-01-09 09:17:00','verde'),
  (1722,'Eliminazione tecnica: id=18','admin','2015-01-09 09:17:08','rosso'),
  (1723,'Eliminazione tecnica: id=17','admin','2015-01-09 09:17:09','rosso'),
  (1724,'Inserimento preventivo:  | id=19','admin','2015-01-09 09:17:47','verde'),
  (1725,'Eliminazione tecnica: id=19','admin','2015-01-09 09:17:57','rosso'),
  (1726,'Inserimento preventivo:  | id=20','admin','2015-01-09 09:18:31','verde'),
  (1727,'Inserimento preventivo:  | id=21','admin','2015-01-09 09:18:50','verde'),
  (1728,'Inserimento preventivo:  | id=22','admin','2015-01-09 09:19:27','verde'),
  (1729,'Inserimento preventivo:  | id=23','admin','2015-01-09 09:19:56','verde'),
  (1730,'Inserimento preventivo:  | id=24','admin','2015-01-09 09:22:16','verde'),
  (1731,'Modifica preventivo','admin','2015-01-09 09:22:30','blu'),
  (1732,'Eliminazione tecnica: id=24','admin','2015-01-09 10:04:52','rosso'),
  (1733,'Eliminazione tecnica: id=23','admin','2015-01-09 10:04:55','rosso'),
  (1734,'Eliminazione tecnica: id=22','admin','2015-01-09 10:04:57','rosso'),
  (1735,'Eliminazione tecnica: id=21','admin','2015-01-09 10:04:59','rosso'),
  (1736,'Eliminazione tecnica: id=20','admin','2015-01-09 10:05:02','rosso'),
  (1737,'Inserimento presenza','admin','2015-01-09 10:57:09','verde'),
  (1738,'Inserimento ruolino giornaliero','admin','2015-01-09 12:19:13','verde'),
  (1739,'Modifica ruolino giornaliero','admin','2015-01-09 12:19:14','verde'),
  (1740,'Modifica ruolino giornaliero','admin','2015-01-09 12:19:26','verde'),
  (1741,'Inserimento ruolino giornaliero','admin','2015-01-09 12:25:36','verde'),
  (1742,'Inserimento mezzo','admin','2015-01-09 12:36:40','verde'),
  (1743,'Eliminazione ruolino giornaliero','admin','2015-01-09 15:32:02','rosso'),
  (1744,'Inserimento ruolino giornaliero','admin','2015-01-09 15:52:12','verde'),
  (1745,'Modifica ruolino giornaliero','admin','2015-01-09 15:59:29','verde'),
  (1746,'Modifica ruolino giornaliero','admin','2015-01-09 16:01:30','verde'),
  (1747,'Modifica ruolino giornaliero','admin','2015-01-09 16:12:34','verde'),
  (1748,'Modifica ruolino giornaliero','admin','2015-01-09 16:12:41','verde'),
  (1749,'Modifica ruolino giornaliero','admin','2015-01-09 16:12:53','verde'),
  (1750,'Eliminazione veicolo','admin','2015-01-09 17:12:45','rosso'),
  (1751,'Eliminazione veicolo','admin','2015-01-09 17:12:52','rosso'),
  (1752,'Eliminazione veicolo','admin','2015-01-09 17:13:12','rosso'),
  (1753,'Eliminazione veicolo','admin','2015-01-09 17:14:37','rosso'),
  (1754,'Inserimento ruolino giornaliero','admin','2015-01-09 17:16:30','verde'),
  (1755,'Eliminazione ruolino giornaliero','admin','2015-01-09 17:18:29','rosso'),
  (1756,'Inserimento ruolino giornaliero','admin','2015-01-09 17:19:05','verde'),
  (1757,'Eliminazione ruolino giornaliero','admin','2015-01-09 17:19:34','rosso'),
  (1758,'Eliminazione ruolino giornaliero','admin','2015-01-09 17:19:36','rosso'),
  (1759,'Inserimento ruolino giornaliero','admin','2015-01-09 17:20:18','verde'),
  (1760,'Inserimento ruolino giornaliero','admin','2015-01-09 17:50:00','verde'),
  (1761,'Inserimento ruolino giornaliero','admin','2015-01-09 18:01:44','verde'),
  (1762,'Modifica commessa','admin','2015-01-09 18:16:08','blu'),
  (1763,'Modifica commessa','admin','2015-01-09 18:16:21','blu'),
  (1764,'Eliminazione ruolino giornaliero','admin','2015-01-09 18:16:35','rosso'),
  (1765,'Inserimento ruolino giornaliero','admin','2015-01-09 18:18:37','verde'),
  (1766,'Eliminazione ruolino giornaliero','admin','2015-01-09 18:30:55','rosso'),
  (1767,'Eliminazione ruolino giornaliero','admin','2015-01-09 18:34:07','rosso'),
  (1768,'Eliminazione ruolino giornaliero','admin','2015-01-09 18:34:32','rosso'),
  (1769,'Eliminazione ruolino giornaliero','admin','2015-01-09 18:36:48','rosso'),
  (1770,'Eliminazione ruolino giornaliero','admin','2015-01-09 18:37:00','rosso'),
  (1771,'Eliminazione ruolino giornaliero','admin','2015-01-09 18:37:11','rosso'),
  (1772,'Eliminazione ruolino giornaliero','admin','2015-01-09 18:37:15','rosso'),
  (1773,'Eliminazione ruolino giornaliero','admin','2015-01-09 18:38:57','rosso'),
  (1774,'Eliminazione ruolino giornaliero','admin','2015-01-09 18:38:59','rosso'),
  (1775,'Eliminazione ruolino giornaliero','admin','2015-01-09 18:39:05','rosso'),
  (1776,'Inserimento ruolino giornaliero','admin','2015-01-09 18:39:55','verde'),
  (1777,'Eliminazione ruolino giornaliero','admin','2015-01-09 18:40:01','rosso'),
  (1778,'Inserimento ruolino giornaliero','admin','2015-01-09 18:49:41','verde'),
  (1779,'Eliminazione ruolino giornaliero','admin','2015-01-09 18:49:53','rosso'),
  (1780,'Eliminazione ruolino giornaliero','admin','2015-01-09 19:10:19','rosso'),
  (1781,'Inserimento ruolino giornaliero','admin','2015-01-09 19:16:24','verde'),
  (1782,'Inserimento programmazione giornaliera cantiere','admin','2015-01-12 09:10:48','verde'),
  (1783,'Eliminazione programmazione giornaliere cantiere','admin','2015-01-12 09:11:00','rosso'),
  (1784,'Eliminazione magazzino','admin','2015-01-12 09:39:03','rosso'),
  (1785,'Inserimento programmazione giornaliera cantiere','admin','2015-01-12 09:51:39','verde'),
  (1786,'Inserimento magazzino','admin','2015-01-12 09:56:57','verde'),
  (1787,'Modifica magazzino','admin','2015-01-12 10:01:31','verde'),
  (1788,'Modifica magazzino','admin','2015-01-12 10:01:40','verde'),
  (1789,'Inserimento magazzino','admin','2015-01-12 10:01:53','verde'),
  (1790,'Modifica magazzino','admin','2015-01-12 10:02:08','verde'),
  (1791,'Modifica magazzino','admin','2015-01-12 10:02:16','verde'),
  (1792,'Modifica magazzino','admin','2015-01-12 10:02:49','verde'),
  (1793,'Eliminazione magazzino','admin','2015-01-12 10:03:08','rosso'),
  (1794,'Eliminazione magazzino','admin','2015-01-12 10:03:12','rosso'),
  (1795,'Eliminazione comunicazione','admin','2015-01-12 11:19:36','rosso'),
  (1796,'Inserimento magazzino','admin','2015-01-12 11:34:33','verde'),
  (1797,'Inserimento magazzino','admin','2015-01-12 11:36:24','verde'),
  (1798,'Inserimento magazzino','admin','2015-01-12 11:41:09','verde'),
  (1799,'Eliminazione comunicazione','admin','2015-01-12 11:41:35','rosso'),
  (1800,'Inserimento magazzino','admin','2015-01-12 11:41:46','verde'),
  (1801,'Modifica magazzino','admin','2015-01-12 11:44:08','verde'),
  (1802,'Modifica magazzino','admin','2015-01-12 11:44:23','verde'),
  (1803,'Modifica magazzino','admin','2015-01-12 11:45:14','verde'),
  (1804,'Modifica magazzino','admin','2015-01-12 11:45:55','verde'),
  (1805,'Modifica magazzino','admin','2015-01-12 11:45:59','verde'),
  (1806,'Modifica magazzino','admin','2015-01-12 11:46:47','verde'),
  (1807,'Modifica magazzino','admin','2015-01-12 11:46:56','verde'),
  (1808,'Inserimento magazzino','admin','2015-01-12 11:47:10','verde'),
  (1809,'Eliminazione comunicazione','admin','2015-01-12 11:47:21','rosso'),
  (1810,'Eliminazione comunicazione','admin','2015-01-12 11:47:27','rosso'),
  (1811,'Inserimento magazzino','admin','2015-01-12 11:49:33','verde'),
  (1812,'Inserimento allegato comunicazione :collina.png','admin','2015-01-12 12:23:46','rosso'),
  (1813,'Inserimento allegato comunicazione :12_01_2015_12_24_21collina.png','admin','2015-01-12 12:24:21','rosso'),
  (1814,'Inserimento allegato comunicazione :','admin','2015-01-12 12:32:35','rosso'),
  (1815,'Eliminazione allegato comunicazione','admin','2015-01-12 12:37:16','rosso'),
  (1816,'Eliminazione allegato comunicazione','admin','2015-01-12 12:37:44','rosso'),
  (1817,'Eliminazione allegato comunicazione','admin','2015-01-12 12:38:55','rosso'),
  (1818,'Eliminazione allegato comunicazione','admin','2015-01-12 12:39:21','rosso'),
  (1819,'Eliminazione allegato comunicazione','admin','2015-01-12 12:39:39','rosso'),
  (1820,'Eliminazione allegato comunicazione','admin','2015-01-12 12:39:55','rosso'),
  (1821,'Eliminazione allegato comunicazione','admin','2015-01-12 12:39:58','rosso'),
  (1822,'Eliminazione allegato comunicazione','admin','2015-01-12 12:40:00','rosso'),
  (1823,'Eliminazione allegato comunicazione','admin','2015-01-12 12:40:01','rosso'),
  (1824,'Inserimento allegato comunicazione :cappello - Copia.png','admin','2015-01-12 12:40:21','rosso'),
  (1825,'Eliminazione allegato comunicazione','admin','2015-01-12 12:40:59','rosso'),
  (1826,'Inserimento allegato comunicazione :cappello.png','admin','2015-01-12 12:41:33','rosso'),
  (1827,'Eliminazione allegato comunicazione','admin','2015-01-12 12:41:36','rosso'),
  (1828,'Inserimento allegato comunicazione :collina.png','admin','2015-01-12 12:42:14','rosso'),
  (1829,'Eliminazione allegato comunicazione','admin','2015-01-12 12:42:16','rosso'),
  (1830,'Inserimento allegato comunicazione :12_01_2015_12_42_39collina.png','admin','2015-01-12 12:42:39','rosso'),
  (1831,'Eliminazione allegato comunicazione','admin','2015-01-12 12:42:42','rosso'),
  (1832,'Inserimento allegato comunicazione :cappello - Copia.png','admin','2015-01-12 12:43:19','rosso'),
  (1833,'Eliminazione allegato comunicazione','admin','2015-01-12 12:43:25','rosso'),
  (1834,'Inserimento magazzino','admin','2015-01-12 12:44:06','verde'),
  (1835,'Inserimento allegato comunicazione :cappello.png','admin','2015-01-12 12:44:13','rosso'),
  (1836,'Inserimento allegato comunicazione :collina.png','admin','2015-01-12 12:44:18','rosso'),
  (1837,'Eliminazione allegato comunicazione','admin','2015-01-12 12:44:33','rosso'),
  (1838,'Eliminazione allegato comunicazione','admin','2015-01-12 12:44:45','rosso'),
  (1839,'Eliminazione comunicazione','admin','2015-01-12 12:46:11','rosso'),
  (1840,'Inserimento allegato comunicazione :cappello.png','admin','2015-01-12 12:51:55','rosso'),
  (1841,'Inserimento ruolino giornaliero','admin','2015-01-12 12:56:16','verde'),
  (1842,'Eliminazione veicolo','admin','2015-01-12 12:59:14','rosso'),
  (1843,'Modifica magazzino','admin','2015-01-12 15:33:03','verde'),
  (1844,'Modifica magazzino','admin','2015-01-12 15:33:28','verde'),
  (1845,'Modifica magazzino','admin','2015-01-12 15:34:06','verde'),
  (1846,'Modifica magazzino','admin','2015-01-12 15:34:09','verde'),
  (1847,'Modifica magazzino','admin','2015-01-12 15:34:10','verde'),
  (1848,'Modifica magazzino','admin','2015-01-12 15:35:50','verde'),
  (1849,'Modifica magazzino','admin','2015-01-12 15:35:51','verde'),
  (1850,'Modifica magazzino','admin','2015-01-12 15:35:52','verde'),
  (1851,'Modifica magazzino','admin','2015-01-12 15:35:52','verde'),
  (1852,'Inserimento ruolino giornaliero','admin','2015-01-12 16:30:56','verde'),
  (1853,'Eliminazione ruolino giornaliero','admin','2015-01-12 16:33:23','rosso'),
  (1854,'Inserimento ruolino giornaliero','admin','2015-01-12 16:33:52','verde'),
  (1855,'Inserimento ruolino giornaliero','admin','2015-01-12 16:35:14','verde'),
  (1856,'Inserimento ruolino giornaliero','admin','2015-01-12 16:35:35','verde'),
  (1857,'Inserimento ruolino giornaliero','admin','2015-01-12 16:35:58','verde'),
  (1858,'Inserimento ruolino giornaliero','admin','2015-01-12 16:36:19','verde'),
  (1859,'Inserimento ruolino giornaliero','admin','2015-01-12 16:37:02','verde'),
  (1860,'Inserimento ruolino giornaliero','admin','2015-01-12 16:37:52','verde'),
  (1861,'Eliminazione ruolino giornaliero','admin','2015-01-12 16:38:43','rosso'),
  (1862,'Inserimento ruolino giornaliero','admin','2015-01-12 16:38:55','verde'),
  (1863,'Inserimento ruolino giornaliero','admin','2015-01-12 16:39:15','verde'),
  (1864,'Inserimento ruolino giornaliero','admin','2015-01-12 16:40:16','verde'),
  (1865,'Inserimento programmazione giornaliera cantiere','admin','2015-01-12 16:47:59','verde'),
  (1866,'Eliminazione veicolo','admin','2015-01-12 16:50:10','rosso'),
  (1867,'Inserimento ruolino giornaliero','admin','2015-01-12 16:50:12','verde'),
  (1868,'Modifica magazzino','admin','2015-01-12 16:52:26','verde'),
  (1869,'Inserimento magazzino','admin','2015-01-12 16:52:36','verde'),
  (1870,'Eliminazione magazzino','admin','2015-01-12 16:52:40','rosso'),
  (1871,'Inserimento magazzino','admin','2015-01-12 16:53:20','verde'),
  (1872,'Inserimento allegato comunicazione :cappello - Copia.png','admin','2015-01-12 16:53:26','rosso'),
  (1873,'Inserimento allegato comunicazione :collina - Copia.png','admin','2015-01-12 16:53:30','rosso'),
  (1874,'Modifica ruolino giornaliero','admin','2015-01-12 17:03:51','verde'),
  (1875,'Modifica ruolino giornaliero','admin','2015-01-12 17:04:58','verde'),
  (1876,'Inserimento ruolino giornaliero','admin','2015-01-12 17:10:05','verde'),
  (1877,'Inserimento manutenzione','admin','2015-01-12 19:17:01','verde'),
  (1878,'Inserimento manutenzione','admin','2015-01-12 19:17:38','verde'),
  (1879,'Inserimento manutenzione','admin','2015-01-12 19:18:30','verde'),
  (1880,'Inserimento manutenzione','admin','2015-01-12 19:19:05','verde'),
  (1881,'Inserimento manutenzione','admin','2015-01-12 19:19:56','verde'),
  (1882,'Inserimento manutenzione','admin','2015-01-12 19:21:27','verde'),
  (1883,'Inserimento manutenzione','admin','2015-01-12 19:21:43','verde'),
  (1884,'Inserimento manutenzione','admin','2015-01-12 19:22:10','verde'),
  (1885,'Inserimento manutenzione','admin','2015-01-12 19:22:15','verde'),
  (1886,'Inserimento manutenzione','admin','2015-01-12 19:22:43','verde'),
  (1887,'Inserimento manutenzione','admin','2015-01-12 19:23:04','verde'),
  (1888,'Inserimento manutenzione','admin','2015-01-12 19:26:18','verde'),
  (1889,'Inserimento manutenzione','admin','2015-01-12 19:27:29','verde'),
  (1890,'Inserimento manutenzione','admin','2015-01-13 11:16:09','verde'),
  (1891,'Modifica ruolino giornaliero','admin','2015-01-13 11:35:29','verde'),
  (1892,'Modifica ruolino giornaliero','admin','2015-01-13 11:37:47','verde'),
  (1893,'Modifica ruolino giornaliero','admin','2015-01-13 11:37:58','verde'),
  (1894,'Modifica ruolino giornaliero','admin','2015-01-13 11:38:57','verde'),
  (1895,'Modifica ruolino giornaliero','admin','2015-01-13 11:39:38','verde'),
  (1896,'Modifica manutenzione 2015-01-13','admin','2015-01-13 15:50:04','verde'),
  (1897,'Modifica manutenzione 2015-01-13','admin','2015-01-13 15:50:24','verde'),
  (1898,'Modifica manutenzione 2015-01-13','admin','2015-01-13 15:50:50','verde'),
  (1899,'Modifica manutenzione 2015-01-13','admin','2015-01-13 15:50:56','verde'),
  (1900,'Modifica manutenzione 2015-01-13','admin','2015-01-13 15:51:40','verde'),
  (1901,'Modifica manutenzione 2015-01-13','admin','2015-01-13 15:53:21','verde'),
  (1902,'Modifica manutenzione 2015-01-13','admin','2015-01-13 15:53:40','verde'),
  (1903,'Modifica manutenzione 2015-01-13','admin','2015-01-13 15:56:00','verde'),
  (1904,'Modifica manutenzione 2015-01-13','admin','2015-01-13 15:56:03','verde'),
  (1905,'Modifica manutenzione 2015-01-13','admin','2015-01-13 15:56:04','verde'),
  (1906,'Modifica manutenzione 2015-01-13','admin','2015-01-13 15:56:43','verde'),
  (1907,'Modifica manutenzione 2015-01-13','admin','2015-01-13 15:58:54','verde'),
  (1908,'Modifica manutenzione 2015-01-13','admin','2015-01-13 15:59:08','verde'),
  (1909,'Modifica manutenzione --','admin','2015-01-13 16:02:12','verde'),
  (1910,'Inserimento programmazione giornaliera cantiere','admin','2015-01-14 09:30:27','verde'),
  (1911,'Modifica manutenzione 2015-01-14','admin','2015-01-14 12:08:03','verde'),
  (1912,'Modifica manutenzione 2015-01-14','admin','2015-01-14 12:08:13','verde'),
  (1913,'Modifica manutenzione 2015-01-14','admin','2015-01-14 12:09:35','verde'),
  (1914,'Modifica manutenzione 2015-01-14','admin','2015-01-14 12:10:03','verde'),
  (1915,'Modifica manutenzione 2015-01-14','admin','2015-01-14 12:10:35','verde'),
  (1916,'Modifica manutenzione 2015-01-14','admin','2015-01-14 12:10:53','verde'),
  (1917,'Modifica manutenzione 2015-01-14','admin','2015-01-14 12:10:56','verde'),
  (1918,'Modifica manutenzione 2015-01-14','admin','2015-01-14 12:11:22','verde'),
  (1919,'Modifica manutenzione 2015-01-14','admin','2015-01-14 12:11:51','verde'),
  (1920,'Modifica manutenzione 2015-01-14','admin','2015-01-14 12:11:56','verde'),
  (1921,'Modifica manutenzione --','admin','2015-01-14 12:14:48','verde'),
  (1922,'Modifica manutenzione --','admin','2015-01-14 12:15:22','verde'),
  (1923,'Modifica manutenzione 2015-01-14','admin','2015-01-14 12:18:01','verde'),
  (1924,'Modifica manutenzione 2015-01-14','admin','2015-01-14 12:18:24','verde'),
  (1925,'Modifica manutenzione 2015-01-14','admin','2015-01-14 12:31:28','verde'),
  (1926,'Inserimento ruolino giornaliero','admin','2015-01-14 17:07:52','verde'),
  (1927,'Eliminazione ruolino giornaliero','admin','2015-01-14 17:08:44','rosso'),
  (1928,'Inserimento ruolino giornaliero','admin','2015-01-14 17:13:12','verde'),
  (1929,'Eliminazione ruolino giornaliero','admin','2015-01-14 17:14:43','rosso'),
  (1930,'Inserimento ruolino giornaliero','admin','2015-01-14 17:15:07','verde'),
  (1931,'Eliminazione veicolo','admin','2015-01-14 17:15:20','rosso'),
  (1932,'Eliminazione ruolino giornaliero','admin','2015-01-14 17:18:50','rosso'),
  (1933,'Eliminazione programmazione giornaliere cantiere','admin','2015-01-14 17:19:43','rosso'),
  (1934,'Inserimento programmazione giornaliera cantiere','admin','2015-01-14 17:20:00','verde'),
  (1935,'Modifica commessa','admin','2015-01-14 17:30:15','blu'),
  (1936,'Modifica ruolino giornaliero','admin','2015-01-14 17:36:55','verde');
COMMIT;

#
# Data for the `tb_log` table  (LIMIT 214,500)
#

INSERT INTO `tb_log` (`id`, `operazione`, `utente`, `data_inserimento`, `colore`) VALUES

  (1937,'Inserimento ruolino giornaliero','admin','2015-01-14 17:37:24','verde'),
  (1938,'Eliminazione ruolino giornaliero','admin','2015-01-14 17:37:49','rosso'),
  (1939,'Eliminazione ruolino giornaliero','admin','2015-01-14 17:37:52','rosso'),
  (1940,'Eliminazione ruolino giornaliero','admin','2015-01-14 17:37:55','rosso'),
  (1941,'Inserimento commessa','admin','2015-01-14 18:07:45','verde'),
  (1942,'Modifica commessa','admin','2015-01-14 18:08:07','blu'),
  (1943,'Modifica commessa','admin','2015-01-14 18:10:39','blu'),
  (1944,'Modifica commessa','admin','2015-01-14 18:11:00','blu'),
  (1945,'Modifica commessa','admin','2015-01-14 18:11:07','blu'),
  (1946,'Modifica commessa','admin','2015-01-14 18:13:20','blu'),
  (1947,'Inserimento commessa','admin','2015-01-14 18:13:34','verde'),
  (1948,'Eliminazione commessa','admin','2015-01-14 18:13:44','rosso'),
  (1949,'Eliminazione commessa','admin','2015-01-14 18:13:46','rosso'),
  (1950,'Eliminazione allegato fattura SAL. | Sal 1','admin','2015-01-14 18:19:31','rosso'),
  (1951,'Modifica fattura SAL. | Sal 1','admin','2015-01-14 18:19:43','blu'),
  (1952,'Eliminazione allegato fattura SAL. | Sal 1','admin','2015-01-14 18:20:24','rosso'),
  (1953,'Modifica fattura SAL. | Sal 1','admin','2015-01-14 18:20:28','blu'),
  (1954,'Modifica manutenzione 2015-01-14','admin','2015-01-14 18:22:40','verde'),
  (1955,'Modifica manutenzione 2015-01-14','prova','2015-01-14 18:23:30','verde'),
  (1956,'Modifica manutenzione 2015-01-14','admin','2015-01-14 18:24:03','verde'),
  (1957,'Inserimento ruolino giornaliero','admin','2015-01-14 18:27:32','verde'),
  (1958,'Modifica ruolino giornaliero','admin','2015-01-14 18:30:52','verde'),
  (1959,'Eliminazione veicolo','admin','2015-01-15 12:47:50','rosso'),
  (1960,'Eliminazione veicolo','admin','2015-01-15 12:48:11','rosso'),
  (1961,'Eliminazione terzi','admin','2015-01-15 12:48:37','rosso'),
  (1962,'Eliminazione veicolo','admin','2015-01-15 12:49:06','rosso'),
  (1963,'Eliminazione veicolo','admin','2015-01-15 12:49:44','rosso'),
  (1964,'Eliminazione terzi','admin','2015-01-15 12:50:00','rosso'),
  (1965,'Eliminazione terzi','admin','2015-01-15 12:50:05','rosso'),
  (1966,'Eliminazione terzi','admin','2015-01-15 12:50:15','rosso'),
  (1967,'Eliminazione terzi','admin','2015-01-15 12:50:28','rosso'),
  (1968,'Eliminazione terzi','admin','2015-01-15 12:50:32','rosso'),
  (1969,'Eliminazione veicolo','admin','2015-01-15 12:50:51','rosso'),
  (1970,'Eliminazione veicolo','admin','2015-01-15 12:50:56','rosso'),
  (1971,'Eliminazione veicolo','admin','2015-01-15 12:51:15','rosso'),
  (1972,'Eliminazione veicolo','admin','2015-01-15 12:51:18','rosso'),
  (1973,'Eliminazione terzi','admin','2015-01-15 12:51:32','rosso'),
  (1974,'Eliminazione terzi','admin','2015-01-15 12:51:36','rosso'),
  (1975,'Eliminazione terzi','admin','2015-01-15 12:51:48','rosso'),
  (1976,'Eliminazione terzi','admin','2015-01-15 12:51:57','rosso'),
  (1977,'Eliminazione terzi','admin','2015-01-15 12:52:10','rosso'),
  (1978,'Inserimento ruolino giornaliero','admin','2015-01-15 12:56:22','verde'),
  (1979,'Modifica ruolino giornaliero','admin','2015-01-15 12:56:42','verde'),
  (1980,'Eliminazione terzi','admin','2015-01-15 13:02:16','rosso'),
  (1981,'Inserimento magazzino','admin','2015-01-15 15:49:04','verde'),
  (1982,'Modifica magazzino','admin','2015-01-15 15:51:35','verde'),
  (1983,'Modifica magazzino','admin','2015-01-15 15:51:44','verde'),
  (1984,'Eliminazione magazzino','admin','2015-01-15 15:52:37','rosso'),
  (1985,'Inserimento magazzino','admin','2015-01-15 15:52:49','verde'),
  (1986,'Eliminazione magazzino','admin','2015-01-15 15:52:52','rosso'),
  (1987,'Inserimento magazzino','admin','2015-01-15 15:54:23','verde'),
  (1988,'Inserimento magazzino','admin','2015-01-15 15:54:35','verde'),
  (1989,'Eliminazione magazzino','admin','2015-01-15 15:55:26','rosso'),
  (1990,'Inserimento magazzino','admin','2015-01-15 15:56:40','verde'),
  (1991,'Eliminazione magazzino','admin','2015-01-15 15:56:44','rosso'),
  (1992,'Inserimento magazzino','admin','2015-01-15 15:57:19','verde'),
  (1993,'Eliminazione magazzino','admin','2015-01-15 15:57:24','rosso'),
  (1994,'Inserimento magazzino','admin','2015-01-15 15:57:38','verde'),
  (1995,'Eliminazione magazzino','admin','2015-01-15 15:57:48','rosso'),
  (1996,'Inserimento magazzino','admin','2015-01-15 15:57:53','verde'),
  (1997,'Modifica magazzino','admin','2015-01-15 15:58:28','verde'),
  (1998,'Inserimento magazzino','admin','2015-01-15 15:58:36','verde'),
  (1999,'Eliminazione magazzino','admin','2015-01-15 15:58:39','rosso'),
  (2000,'Eliminazione magazzino','admin','2015-01-15 15:58:41','rosso'),
  (2001,'Modifica magazzino','admin','2015-01-15 15:59:19','verde'),
  (2002,'Modifica magazzino','admin','2015-01-15 15:59:29','verde'),
  (2003,'Eliminazione merce magazzino','admin','2015-01-15 16:27:25','rosso'),
  (2004,'Inserimento merce magazzino','admin','2015-01-15 16:35:38','verde'),
  (2005,'Inserimento merce magazzino','admin','2015-01-15 16:35:42','verde'),
  (2006,'Inserimento merce magazzino','admin','2015-01-15 16:35:42','verde'),
  (2007,'Inserimento merce magazzino','admin','2015-01-15 16:36:27','verde'),
  (2008,'Inserimento merce magazzino','admin','2015-01-15 16:37:59','verde'),
  (2009,'Inserimento merce magazzino','admin','2015-01-15 16:38:54','verde'),
  (2010,'Inserimento merce magazzino','admin','2015-01-15 16:38:59','verde'),
  (2011,'Inserimento merce magazzino','admin','2015-01-15 16:39:10','verde'),
  (2012,'Eliminazione merce magazzino','admin','2015-01-15 16:39:13','rosso'),
  (2013,'Eliminazione merce magazzino','admin','2015-01-15 16:39:14','rosso'),
  (2014,'Eliminazione merce magazzino','admin','2015-01-15 16:39:16','rosso'),
  (2015,'Inserimento merce magazzino','admin','2015-01-15 16:40:41','verde'),
  (2016,'Inserimento merce magazzino','admin','2015-01-15 16:40:49','verde'),
  (2017,'Inserimento merce magazzino','admin','2015-01-15 16:42:15','verde'),
  (2018,'Eliminazione merce magazzino','admin','2015-01-15 16:42:21','rosso'),
  (2019,'Eliminazione merce magazzino','admin','2015-01-15 16:42:23','rosso'),
  (2020,'Inserimento magazzino','admin','2015-01-15 16:45:59','verde'),
  (2021,'Inserimento merce magazzino','admin','2015-01-15 16:46:08','verde'),
  (2022,'Inserimento merce magazzino','admin','2015-01-15 16:46:18','verde'),
  (2023,'Inserimento merce magazzino','admin','2015-01-15 16:51:59','verde'),
  (2024,'Eliminazione merce magazzino','admin','2015-01-15 16:52:01','rosso'),
  (2025,'Inserimento merce magazzino','admin','2015-01-15 17:05:47','verde'),
  (2026,'Inserimento ruolino giornaliero','admin','2015-01-15 17:14:50','verde'),
  (2027,'Modifica ruolino giornaliero','admin','2015-01-15 17:36:12','verde'),
  (2028,'Eliminazione ruolino giornaliero','admin','2015-01-15 18:54:36','rosso'),
  (2029,'Eliminazione gara: id=2','admin','2015-01-15 19:04:57','rosso'),
  (2030,'Eliminazione gara: id=1','admin','2015-01-15 19:05:56','rosso'),
  (2031,'Inserimento preventivo:  | id=3','admin','2015-01-15 19:16:17','verde'),
  (2032,'Inserimento preventivo:  | id=4','admin','2015-01-15 19:16:44','verde'),
  (2033,'Inserimento gara: | id=5','admin','2015-01-15 19:19:43','verde'),
  (2034,'Inserimento gara: | id=6','admin','2015-01-15 19:20:20','verde'),
  (2035,'Modifica preventivo','admin','2015-01-15 19:20:47','blu'),
  (2036,'Modifica gara','admin','2015-01-15 19:21:54','blu'),
  (2037,'Modifica gara','admin','2015-01-15 19:22:49','blu'),
  (2038,'Eliminazione attivita','admin','2015-01-15 19:27:06','rosso'),
  (2039,'Inserimento gara: | id=7','admin','2015-01-16 09:34:39','verde'),
  (2040,'Inserimento allegato gara: cappello - Copia.png','admin','2015-01-16 09:35:50','verde'),
  (2041,'Inserimento allegato gara: cappello - Copia.png','admin','2015-01-16 09:36:54','verde'),
  (2042,'Inserimento allegato gara: cappello - Copia.png','admin','2015-01-16 09:41:04','verde'),
  (2043,'Inserimento allegato gara: collina.png','admin','2015-01-16 09:42:35','verde'),
  (2044,'Inserimento allegato gara: cappello.png','admin','2015-01-16 09:51:43','verde'),
  (2045,'Inserimento allegato gara: fiore.png','admin','2015-01-16 09:52:37','verde'),
  (2046,'Eliminazione allegato gara: ../uploads/gare/2/fiore.png','admin','2015-01-16 10:09:40','rosso'),
  (2047,'Eliminazione allegato gara: ../uploads/gare/2/cappello.png','admin','2015-01-16 10:10:23','rosso'),
  (2048,'Eliminazione gara: id=2','admin','2015-01-16 10:10:54','rosso'),
  (2049,'Inserimento allegato gara: collina.png','admin','2015-01-16 10:11:12','verde'),
  (2050,'Inserimento allegato gara: cappello.png','admin','2015-01-16 10:11:18','verde'),
  (2051,'Eliminazione gara: id=6','admin','2015-01-16 10:12:16','rosso'),
  (2052,'Inserimento gara: | id=8','admin','2015-01-16 10:13:56','verde'),
  (2053,'Inserimento allegato gara: collina.png','admin','2015-01-16 10:14:04','verde'),
  (2054,'Eliminazione allegato gara: ../uploads/gare/8/collina.png','admin','2015-01-16 10:14:15','rosso'),
  (2055,'Eliminazione gara: id=8','admin','2015-01-16 10:14:18','rosso'),
  (2056,'Inserimento allegato gara: collina.png','admin','2015-01-16 10:14:23','verde'),
  (2057,'Eliminazione allegato gara: ../uploads/gare/7/collina.png','admin','2015-01-16 10:15:32','rosso'),
  (2058,'Inserimento allegato gara: cappello.png','admin','2015-01-16 10:15:46','verde'),
  (2059,'Inserimento allegato gara: collina.png','admin','2015-01-16 10:21:14','verde'),
  (2060,'Eliminazione allegato gara: ../uploads/gare/7/cappello.png','admin','2015-01-16 10:21:17','rosso'),
  (2061,'Modifica manutenzione 2015-01-16','admin','2015-01-16 10:22:19','verde'),
  (2062,'Modifica manutenzione 2015-01-16','admin','2015-01-16 10:22:25','verde'),
  (2063,'Modifica manutenzione 2015-01-16','admin','2015-01-16 10:22:30','verde'),
  (2064,'Inserimento revisione contrattuale: a | id=1','admin','2015-01-16 11:43:52','verde'),
  (2065,'Eliminazione revisione contrattuale: id=1','admin','2015-01-16 11:43:59','rosso'),
  (2066,'Eliminazione ordine','admin','2015-01-16 12:07:36','rosso'),
  (2067,'Eliminazione ordine','admin','2015-01-16 12:09:11','rosso'),
  (2068,'Inserimento ordine','admin','2015-01-16 12:15:37','verde'),
  (2069,'Inserimento ordine','admin','2015-01-16 12:18:19','verde'),
  (2070,'Inserimento ordine','admin','2015-01-16 12:18:26','verde'),
  (2071,'Inserimento ordine','admin','2015-01-16 12:19:00','verde'),
  (2072,'Eliminazione ordine nella commessa','admin','2015-01-16 12:19:05','rosso'),
  (2073,'Eliminazione ordine nella commessa','admin','2015-01-16 12:19:07','rosso'),
  (2074,'Eliminazione ordine nella commessa','admin','2015-01-16 12:19:08','rosso'),
  (2075,'Inserimento ordine','admin','2015-01-16 12:20:00','verde'),
  (2076,'Eliminazione ordine nella commessa','admin','2015-01-16 12:20:04','rosso'),
  (2077,'Inserimento ordine','admin','2015-01-16 12:20:07','verde'),
  (2078,'Modifica ordine','admin','2015-01-16 12:25:22','blu'),
  (2079,'Inserimento ordine','admin','2015-01-16 12:25:26','verde'),
  (2080,'Inserimento ordine','admin','2015-01-16 12:27:22','verde'),
  (2081,'Modifica ordine','admin','2015-01-16 12:27:29','blu'),
  (2082,'Modifica ordine','admin','2015-01-16 12:27:38','blu'),
  (2083,'Eliminazione ordine nella commessa','admin','2015-01-16 12:59:09','rosso'),
  (2084,'Eliminazione ordine nella commessa','admin','2015-01-16 13:00:00','rosso'),
  (2085,'Inserimento allegato gara: cappello.png','admin','2015-01-16 15:55:06','verde'),
  (2086,'Inserimento allegato gara: collina.png','admin','2015-01-16 15:55:17','verde'),
  (2087,'Inserimento allegato gara: collina.png','admin','2015-01-16 15:57:03','verde'),
  (2088,'Inserimento allegato gara: 16_01_2015_03_57_42collina.png','admin','2015-01-16 15:57:42','verde'),
  (2089,'Inserimento allegato gara: collina.png','admin','2015-01-16 15:58:14','verde'),
  (2090,'Inserimento allegato gara: 16_01_2015_04_00_11collina.png','admin','2015-01-16 16:00:11','verde'),
  (2091,'Inserimento allegato gara: 16_01_2015_04_00_23collina.png','admin','2015-01-16 16:00:23','verde'),
  (2092,'Inserimento allegato gara: cappello.png','admin','2015-01-16 16:00:53','verde'),
  (2093,'Eliminazione allegato ordine commessa: ../uploads/commesse/1/ordini_commessa/9/cappello.png','admin','2015-01-16 16:10:55','rosso'),
  (2094,'Eliminazione allegato ordine commessa: ../uploads/commesse/1/ordini_commessa/9/cappello.png','admin','2015-01-16 16:10:57','rosso'),
  (2095,'Inserimento allegato gara: cappello.png','admin','2015-01-16 16:11:49','verde'),
  (2096,'Inserimento allegato gara: collina.png','admin','2015-01-16 16:11:54','verde'),
  (2097,'Eliminazione allegato ordine commessa: ../uploads/commesse/1/ordini_commessa/9/cappello.png','admin','2015-01-16 16:12:00','rosso'),
  (2098,'Eliminazione allegato ordine commessa: ../uploads/commesse/1/ordini_commessa/9/cappello.png','admin','2015-01-16 16:12:00','rosso'),
  (2099,'Eliminazione allegato ordine commessa: ../uploads/commesse/1/ordini_commessa/9/cappello.png','admin','2015-01-16 16:12:00','rosso'),
  (2100,'Inserimento allegato gara: gelato.png','admin','2015-01-16 16:12:27','verde'),
  (2101,'Eliminazione allegato ordine commessa: ../uploads/commesse/1/ordini_commessa/11/gelato.png','admin','2015-01-16 16:12:33','rosso'),
  (2102,'Eliminazione allegato ordine commessa: ../uploads/commesse/1/ordini_commessa/11/gelato.png','admin','2015-01-16 16:12:33','rosso'),
  (2103,'Eliminazione ordine nella commessa','admin','2015-01-16 16:14:53','rosso'),
  (2104,'Eliminazione ordine nella commessa','admin','2015-01-16 16:15:25','rosso'),
  (2105,'Eliminazione ordine nella commessa','admin','2015-01-16 16:15:27','rosso'),
  (2106,'Inserimento ordine','admin','2015-01-16 16:15:34','verde'),
  (2107,'Inserimento allegato gara: gelato.png','admin','2015-01-16 16:15:59','verde'),
  (2108,'Inserimento ordine','admin','2015-01-16 16:24:03','verde'),
  (2109,'Inserimento ordine','admin','2015-01-16 16:25:27','verde'),
  (2110,'Inserimento allegato gara: cappello.png','admin','2015-01-16 16:25:44','verde'),
  (2111,'Inserimento allegato gara: collina.png','admin','2015-01-16 16:25:55','verde'),
  (2112,'Inserimento allegato gara: collina.png','admin','2015-01-16 16:31:29','verde'),
  (2113,'Inserimento allegato gara: foto.png','admin','2015-01-16 16:31:39','verde'),
  (2114,'Eliminazione allegato ordine commessa: ../uploads/commesse/1/ordini_commessa/12/gelato.png','admin','2015-01-16 16:33:01','rosso'),
  (2115,'Inserimento allegato gara: 16_01_2015_04_35_40foto.png','admin','2015-01-16 16:35:41','verde'),
  (2116,'Eliminazione allegato ordine commessa: ../uploads/commesse/1/ordini_commessa/12/16_01_2015_04_35_40foto.png','admin','2015-01-16 16:35:48','rosso'),
  (2117,'Eliminazione allegato ordine commessa: ../uploads/commesse/1/ordini_commessa/12/16_01_2015_04_35_40foto.png','admin','2015-01-16 16:35:48','rosso'),
  (2118,'Eliminazione allegato ordine commessa: ../uploads/commesse/1/ordini_commessa/12/16_01_2015_04_35_40foto.png','admin','2015-01-16 16:35:48','rosso'),
  (2119,'Eliminazione allegato ordine commessa: ../uploads/commesse/1/ordini_commessa/12/16_01_2015_04_35_40foto.png','admin','2015-01-16 16:35:48','rosso'),
  (2120,'Eliminazione allegato ordine commessa: ../uploads/commesse/1/ordini_commessa/12/16_01_2015_04_35_40foto.png','admin','2015-01-16 16:35:49','rosso'),
  (2121,'Eliminazione allegato ordine commessa: ../uploads/commesse/1/ordini_commessa/12/16_01_2015_04_35_40foto.png','admin','2015-01-16 16:35:49','rosso'),
  (2122,'Eliminazione allegato ordine commessa: ../uploads/commesse/1/ordini_commessa/12/16_01_2015_04_35_40foto.png','admin','2015-01-16 16:35:49','rosso'),
  (2123,'Eliminazione allegato ordine commessa: ../uploads/commesse/1/ordini_commessa/12/16_01_2015_04_35_40foto.png','admin','2015-01-16 16:35:49','rosso'),
  (2124,'Eliminazione allegato ordine commessa: ../uploads/commesse/1/ordini_commessa/12/16_01_2015_04_35_40foto.png','admin','2015-01-16 16:35:49','rosso'),
  (2125,'Eliminazione allegato ordine commessa: ../uploads/commesse/1/ordini_commessa/12/16_01_2015_04_35_40foto.png','admin','2015-01-16 16:35:49','rosso'),
  (2126,'Eliminazione allegato ordine commessa: ../uploads/commesse/1/ordini_commessa/12/16_01_2015_04_35_40foto.png','admin','2015-01-16 16:35:49','rosso'),
  (2127,'Eliminazione allegato ordine commessa: ../uploads/commesse/1/ordini_commessa/12/16_01_2015_04_35_40foto.png','admin','2015-01-16 16:35:49','rosso'),
  (2128,'Modifica SAL: jj','admin','2015-01-19 09:06:57','blu'),
  (2129,'Inserimento fattura SAL: aaa | jj','admin','2015-01-19 09:11:02','verde'),
  (2130,'Modifica fattura SAL. | jj','admin','2015-01-19 09:30:17','blu'),
  (2131,'Modifica fattura SAL. | jj','admin','2015-01-19 09:30:22','blu'),
  (2132,'Modifica fattura SAL. | jj','admin','2015-01-19 09:33:06','blu'),
  (2133,'Modifica fattura SAL. | jj','admin','2015-01-19 09:33:19','blu'),
  (2134,'Modifica Cantiere','admin','2015-01-19 09:46:43','blu'),
  (2135,'Modifica Cantiere','admin','2015-01-19 09:46:45','blu'),
  (2136,'Eliminazione SAL: jj','admin','2015-01-19 09:53:08','rosso'),
  (2137,'Eliminazione SAL: Sal 1','admin','2015-01-19 09:54:23','rosso'),
  (2138,'Inserimento SAL: sdad','admin','2015-01-19 09:54:31','verde'),
  (2139,'Inserimento SAL: eeeee','admin','2015-01-19 09:54:37','verde'),
  (2140,'Eliminazione SAL: eeeee','admin','2015-01-19 09:56:44','rosso'),
  (2141,'Eliminazione SAL: sdad','admin','2015-01-19 09:56:53','rosso'),
  (2142,'Inserimento magazzino','admin','2015-01-19 11:03:17','verde'),
  (2143,'Inserimento merce magazzino','admin','2015-01-19 11:03:35','verde'),
  (2144,'Inserimento merce magazzino','admin','2015-01-19 11:03:38','verde'),
  (2145,'Eliminazione merce magazzino','admin','2015-01-19 11:05:13','rosso'),
  (2146,'Eliminazione merce magazzino','admin','2015-01-19 11:05:15','rosso'),
  (2147,'Modifica Cantiere','admin','2015-01-19 12:40:39','blu'),
  (2148,'Modifica Cantiere','admin','2015-01-19 12:41:37','blu'),
  (2149,'Modifica ruolino giornaliero','admin','2015-01-19 15:50:23','verde');
COMMIT;

#
# Data for the `tb_magazzino` table  (LIMIT -494,500)
#

INSERT INTO `tb_magazzino` (`id`, `data`, `mezzo`, `id_mezzo`, `id_commessa`, `descrizione_commessa`, `materiale`, `quantita`, `utente`, `firma`, `id_testata_magazzino`) VALUES

  (10,NULL,NULL,NULL,NULL,NULL,'aaa','12','admin',NULL,1),
  (15,NULL,NULL,NULL,NULL,NULL,'21','12.12','admin',NULL,1),
  (17,NULL,NULL,NULL,NULL,NULL,'a','1','admin',NULL,11),
  (18,NULL,NULL,NULL,NULL,NULL,'cemento','3','admin',NULL,4),
  (20,NULL,NULL,NULL,NULL,NULL,'dfdfd','12','admin',NULL,1);
COMMIT;

#
# Data for the `tb_manutenzione` table  (LIMIT -497,500)
#

INSERT INTO `tb_manutenzione` (`id`, `data`, `id_mezzo`, `mezzo`, `utente`, `libretto`, `assicurazione`, `olio_cambio`, `olio_motore`, `estintori`, `pneumatici`, `elettrico`, `triangolo`, `giubbino`, `vetri`, `pronto_soccorso`, `carrozzeria`, `freni`, `luci`, `tergicristalli`, `indicatori`, `climatizzatore`, `altro`, `note`) VALUES

  (5,'2015-01-16',1,'Clio','admin',0,0,1,1,1,1,1,1,1,1,1,1,1,0,0,0,1,0,'prova NOTE'),
  (6,'2015-01-14',1,'clio','admin',0,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,'dsfa');
COMMIT;

#
# Data for the `tb_materiale` table  (LIMIT -497,500)
#

INSERT INTO `tb_materiale` (`id`, `id_commessa`, `tipo_materiale`, `fornitore`, `costo`, `quantita`, `data`, `link_allegato`, `nome_allegato`, `importo`) VALUES

  (9,1,'Cemento','Prova','100','2','2014-10-09','uploads/commesse/1/materiali/','cappello.png','200'),
  (10,1,'a','a','12.12','3','2014-12-10','uploads/commesse/1/materiali/','','36.36');
COMMIT;

#
# Data for the `tb_ordini` table  (LIMIT -498,500)
#

INSERT INTO `tb_ordini` (`id`, `id_commessa`, `descrizione`, `link_allegato`, `nome_allegato`) VALUES

  (6,1,'Ordine 1','uploads/commesse/1/ordini/','cappello.png');
COMMIT;

#
# Data for the `tb_polizza` table  (LIMIT -497,500)
#

INSERT INTO `tb_polizza` (`id`, `id_commessa`, `descrizione`, `data_stipula`, `scadenza`, `importo`, `link_allegato`, `nome_allegato`, `polizza_svincolata`) VALUES

  (2,1,'Lorem ipsum','2014-10-08','2014-10-08','5.000','uploads/commesse/1/polizze/','prova.pdf','SI'),
  (3,1,'Lorem ipsum','2014-10-08','2014-10-08','3.000','uploads/commesse/1/polizze/','','NO');
COMMIT;

#
# Data for the `tb_presenze` table  (LIMIT -498,500)
#

INSERT INTO `tb_presenze` (`id`, `id_dipendente`, `data`, `dettagli`, `n_ore`, `n_giorni`, `id_commessa`, `costo`) VALUES

  (1,5,'2015-01-09','','6',NULL,1,'');
COMMIT;

#
# Data for the `tb_programmazione_cantiere` table  (LIMIT -493,500)
#

INSERT INTO `tb_programmazione_cantiere` (`id`, `id_commessa`, `cod_commessa`, `descrizione_commessa`, `cod_lavoro`, `descrizione_lavoro`, `id_dipendenti`, `addetti`, `id_mezzo`, `mezzo`, `note`, `data`, `utente`, `id_lavoro`) VALUES

  (14,1,'12/12','prova','12/12','prova','5 ',' Mario Rossi',1,'Clio','adasffasdf','2015-01-07','admin',1),
  (21,6,'001','Casa_Della_Salute','12','21','5 ,8 ',' Mario Rossi, Luca Liscio',1,'Clio','2','2015-01-07','admin',12),
  (22,6,'001','Casa_Della_Salute','2','Rasatura','5 ,6 ',' Mario Rossi, Franco Bianchi',1,'Clio','prova note','2015-01-07','admin',2),
  (23,6,'001','Casa_Della_Salute','','','8 ',' Luca Liscio',1,'Clio','','2015-01-08','admin',0),
  (25,6,'001','Casa_Della_Salute','','','5 ,7 ',' Rossi Mario, Verdi Rocco',1,'Clio','qqqq','2015-01-12','admin',0),
  (27,6,'001','Casa_Della_Salute','','','6 ,10 ',' Bianchi Franco, Ianni Maria',1,'Clio','','2015-01-14','admin',-1);
COMMIT;

#
# Data for the `tb_regolarita` table  (LIMIT -497,500)
#

INSERT INTO `tb_regolarita` (`id`, `id_commessa`, `descrizione`, `data`, `ente`, `nome_allegato`, `link_allegato`, `scadenza`) VALUES

  (4,1,'Lorem ipsum','2014-10-09','Ente x','cappello.png','uploads/commesse/1/regolarita/','2014-10-25'),
  (5,1,'Lorem Ipsum','2014-10-07','Ente Y','','','2014-10-22');
COMMIT;

#
# Data for the `tb_riserve` table  (LIMIT -498,500)
#

INSERT INTO `tb_riserve` (`id`, `id_commessa`, `descrizione`, `data`, `dettagli`, `link_allegato`, `nome_allegato`) VALUES

  (10,1,'prova riserva','2014-10-06','riserva dettagli','uploads/commesse/1/riserve/','cappello.png');
COMMIT;

#
# Data for the `tb_ruolino` table  (LIMIT -493,500)
#

INSERT INTO `tb_ruolino` (`id`, `id_commessa`, `cod_commessa`, `descrizione_commessa`, `localizzazione_lavoro`, `quantita`, `addetti`, `ore`, `mezzo`, `km`, `autista`, `terzi`, `ore_terzi`, `note`, `data`, `utente`, `cod_lavoro`, `descrizione_lavoro`, `codizioni_climatiche`, `id_lavoro`, `id_dipendenti`, `id_mezzo`, `clima`, `tipologia`) VALUES

  (8,6,'001','Casa_Della_Salute',NULL,'',' Mario Rossi, Franco Bianchi','6','Clio','','5-Mario Rossi','','0','','2015-01-08','admin','1','verifica del massetto esistente (PAVIMENTAZIONI TERRAZZI scheda n. 02)',NULL,5,'5 ,6 ',1,'SERENO',NULL),
  (9,1,'12/01','',NULL,'',' Mario Rossi','5','','','5-Mario Rossi','','0','','2015-01-08','admin','1','Preparazione del supporto',NULL,1,'5 ',0,'SERENO',NULL),
  (21,1,'12/01','prova commessa 1',NULL,'',' Rossi Mario','1',NULL,NULL,'Rossi Mario','','','','2015-01-09','admin','1','verifica del massetto esistente (IMPERMEABILIZZAZIONI scheda n. 01)',NULL,5,'5 ',NULL,'SERENO','cap'),
  (34,6,'001','Casa_Della_Salute',NULL,'100',' Salvia Franca, Bianchi Franco, Verdi Rocco','9',NULL,NULL,'Rossi Mario,Bianchi Franco','','8','prova','2015-01-12','admin','-1','demolizione del pavimento esistente (PAVIMENTAZIONI TERRAZZI scheda n. 02)',NULL,-1,'9 ,6 ,7 ',NULL,'NUVOLOSO','cap'),
  (40,6,'001','Casa_Della_Salute',NULL,'qta',' Bianchi Franco, Ianni Maria','8',NULL,NULL,'Bianchi Franco','','','prova note','2015-01-14','admin','-1','prova lavoro',NULL,-1,'6 ,10 ',NULL,'SERENO','cg'),
  (41,6,'001','Casa Della Salute',NULL,'qta',' Rossi Mario','6',NULL,NULL,'Bianchi Franco','','','','2015-01-14','admin','-1','ppp',NULL,-1,'5 ',NULL,'SERENO','imp');
COMMIT;

#
# Data for the `tb_spese` table  (LIMIT -498,500)
#

INSERT INTO `tb_spese` (`id`, `id_mezzo`, `tipo`, `data_ultimo_pagamento`, `data_scadenza`, `avviso_entro_giorni`, `riferimento_fattura`, `costo`, `eseguito`) VALUES

  (1,1,'Bollo','2014-10-01','2014-12-17',NULL,'',200.00,0);
COMMIT;

#
# Data for the `tb_tagliando` table  (LIMIT -498,500)
#

INSERT INTO `tb_tagliando` (`id`, `id_mezzo`, `tipo_tagliando`, `data_tagliando`, `costo`, `riferimento_fattura`, `tagliando_ogni`, `eseguito`) VALUES

  (1,1,'Olio','2014-10-01',1000.00,'prova.pdf','10000',0);
COMMIT;

#
# Data for the `tb_tecnica` table  (LIMIT -498,500)
#

INSERT INTO `tb_tecnica` (`id`, `num_preventivo`, `cliente`, `sopraluogo`, `data`, `offerta`, `operatore`, `ricontatti`, `esito`, `tipo_cliente`, `tipo_sede`, `motivazione`, `data_acquisizione`, `modalita`, `link_file`) VALUES

  (14,'001','Evangelista','SI','2015-01-02','Controsoffitto','admin','','','NUOVO','SEDE','','2015-01-18','','uploads/tecnica/14/cappello.png');
COMMIT;

#
# Data for the `tb_terzi` table  (LIMIT -497,500)
#

INSERT INTO `tb_terzi` (`id`, `id_commessa`, `data`, `descrizione`, `ore`) VALUES

  (10,6,'2015-01-14','aaa','aaa'),
  (13,6,'2015-01-14','bbbb','bbb');
COMMIT;

#
# Data for the `tb_testata_magazzino` table  (LIMIT -495,500)
#

INSERT INTO `tb_testata_magazzino` (`id`, `mezzo`, `id_mezzo`, `id_commessa`, `descrizione_commessa`, `data`, `utente`) VALUES

  (1,'Clio',1,1,'prova commessa 1','2015-01-15','admin'),
  (4,'Clio',1,6,'Casa_Della_Salute','2015-01-15','admin'),
  (11,'Altro',2,4,'prova commessa 2','2015-01-15','admin'),
  (12,'Altro',2,1,'prova commessa 1','2015-01-19','admin');
COMMIT;

#
# Data for the `tb_users` table  (LIMIT -493,500)
#

INSERT INTO `tb_users` (`id`, `username`, `password`, `ruolo`, `email`, `mansione`, `nome`, `cognome`) VALUES

  (32,'admin','admin','ADMIN','prova@prova.it','amministratore','mario','rossi'),
  (33,'mezzo','mezzo','MEZZI','mezzo@m.it','mezzo','mezzo','mezzo'),
  (34,'commessa','commessa','COMMESSA','commessa@m.it','commessa','commessa','commessa'),
  (35,'ruolino','ruolino','RUOLINO','ruolino@m.it','impiegato','ruolino','ruolino'),
  (36,'user','user','PERSONALE_RUOLINO','user@m.it','Impiegato','user','user'),
  (39,'prova','prova','ADMIN','prova@prova.it','prova','prova','prova');
COMMIT;

#
# Data for the `tb_veicoli` table  (LIMIT -497,500)
#

INSERT INTO `tb_veicoli` (`id`, `id_commessa`, `id_mezzo`, `mezzo`, `targa`, `costo_h`, `data`, `km`) VALUES

  (1,6,1,'Clio','','10','2015-01-12',''),
  (11,6,0,'','','aaa','2015-01-14','');
COMMIT;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;