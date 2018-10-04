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
AUTO_INCREMENT=10 AVG_ROW_LENGTH=16384 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
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
AUTO_INCREMENT=7 AVG_ROW_LENGTH=16384 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
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
AUTO_INCREMENT=10 AVG_ROW_LENGTH=16384 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
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
AUTO_INCREMENT=7 AVG_ROW_LENGTH=16384 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
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
AUTO_INCREMENT=17 AVG_ROW_LENGTH=8192 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
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
AUTO_INCREMENT=1782 AVG_ROW_LENGTH=212 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
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
AUTO_INCREMENT=24 AVG_ROW_LENGTH=4096 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
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
  UNIQUE INDEX `id` USING BTREE (`id`)
)ENGINE=InnoDB
AUTO_INCREMENT=22 AVG_ROW_LENGTH=5461 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
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
AUTO_INCREMENT=25 AVG_ROW_LENGTH=16384 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
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
AUTO_INCREMENT=37 AVG_ROW_LENGTH=16384 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
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
  UNIQUE INDEX `tb_veicoli_idx1` USING BTREE (`id_commessa`, `id_mezzo`),
   INDEX `id_mezzo` USING BTREE (`id_mezzo`),
   INDEX `id_commessa` USING BTREE (`id_commessa`)
)ENGINE=InnoDB
AUTO_INCREMENT=20 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
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

INSERT INTO `tb_commesse` (`id`, `codice`, `descrizione`, `localita`, `data_inizio`, `data_fine`, `status`, `annotazioni`, `cantiere`, `importo`, `tipologia_lavori`, `referente`, `telefono`, `fax`, `cellulare`, `utente`) VALUES

  (1,'12/01','prova commessa 1','Potenza','2014-10-07','0000-00-00',NULL,'','Potenza via Anzio','10000,21','Ristrutturazione','Condiminio via anzio','no','no','no','admin'),
  (4,'123','prova commessa 2','Potenza','2014-12-10','0000-00-00',NULL,'','Via Rocco Scotellaro','12','12','12','12','12','12','admin'),
  (6,'001','Casa_Della_Salute','Avigliano','2014-12-29','0000-00-00',NULL,'','Casa_Della_Salute','111','Casa_Della_Salute','Casa_Della_Salute','1','11','1','admin');
COMMIT;

#
# Data for the `tb_allegati` table  (LIMIT -497,500)
#

INSERT INTO `tb_allegati` (`id`, `n_sospensioni`, `descrizione`, `verbale_n`, `link_allegato`, `id_commessa`, `file_name`, `data`) VALUES

  (7,1,'Foto','','uploads/commesse/1/cantiere/collina.png',1,'collina.png','2015-01-08'),
  (9,1,'ddd','','uploads/commesse/1/cantiere/cappello.png',1,'cappello.png','2015-01-09');
COMMIT;

#
# Data for the `tb_attivita` table  (LIMIT -498,500)
#

INSERT INTO `tb_attivita` (`id`, `id_commessa`, `impresa_fornitrice`, `lavoro`, `importo`, `data_del`, `registrato_a`, `data_il`, `numero`) VALUES

  (6,1,'Prova','Prova','1000','2014-10-09','Potenza','2014-10-18','12/01');
COMMIT;

#
# Data for the `tb_allegati_attivita` table  (LIMIT -498,500)
#

INSERT INTO `tb_allegati_attivita` (`id`, `id_attivita`, `descrizione`, `data_ricevuto`, `data_inviato`, `inviato_a`, `link_allegato`, `nome_allegato`) VALUES

  (9,6,'prova allegato','2014-10-09','2014-10-10','prova','uploads/commesse/1/attivita/6/','cappello.png');
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
# Data for the `tb_ral` table  (LIMIT -497,500)
#

INSERT INTO `tb_ral` (`id`, `id_commessa`, `ral`, `totale_ral`, `link_allegato`, `nome_allegato`, `totale_fatture`, `data`, `note`, `utente`) VALUES

  (5,1,'Sal 1','220','uploads/commesse/1/ral/','cappello.png',NULL,'2014-10-07','nota 1','admin'),
  (6,1,'jj','1234','uploads/commesse/1/ral/','collina - Copia.png',NULL,'2015-01-07','','admin');
COMMIT;

#
# Data for the `tb_fatture_ral` table  (LIMIT -497,500)
#

INSERT INTO `tb_fatture_ral` (`id`, `id_ral`, `descrizione`, `importo`, `link_allegato`, `nome_allegato`, `note`, `data`, `utente`) VALUES

  (15,5,'Fattura 1','40','uploads/commesse/1/ral/5/','prova.pdf','ok fattura 1','2014-10-06',NULL),
  (16,5,'Fattura 2','30','uploads/commesse/1/ral/5/','08_10_2014_12_58_03prova.pdf','','2014-10-08','admin');
COMMIT;

#
# Data for the `tb_lavoro` table  (LIMIT -497,500)
#

INSERT INTO `tb_lavoro` (`id`, `cod_lavoro`, `descrizione`, `attivita`, `lavorazione`) VALUES

  (5,'1','','verifica del massetto esistente','IMPERMEABILIZZAZIONI scheda n. 01'),
  (8,'1','','demolizione del pavimento esistente','PAVIMENTAZIONI TERRAZZI scheda n. 02');
COMMIT;

#
# Data for the `tb_log` table  (LIMIT -154,500)
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
  (1781,'Inserimento ruolino giornaliero','admin','2015-01-09 19:16:24','verde');
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
# Data for the `tb_programmazione_cantiere` table  (LIMIT -495,500)
#

INSERT INTO `tb_programmazione_cantiere` (`id`, `id_commessa`, `cod_commessa`, `descrizione_commessa`, `cod_lavoro`, `descrizione_lavoro`, `id_dipendenti`, `addetti`, `id_mezzo`, `mezzo`, `note`, `data`, `utente`, `id_lavoro`) VALUES

  (14,1,'12/12','prova','12/12','prova','5 ',' Mario Rossi',1,'Clio','adasffasdf','2015-01-07','admin',1),
  (21,6,'001','Casa_Della_Salute','12','21','5 ,8 ',' Mario Rossi, Luca Liscio',1,'Clio','2','2015-01-07','admin',12),
  (22,6,'001','Casa_Della_Salute','2','Rasatura','5 ,6 ',' Mario Rossi, Franco Bianchi',1,'Clio','prova note','2015-01-07','admin',2),
  (23,6,'001','Casa_Della_Salute','','','8 ',' Luca Liscio',1,'Clio','','2015-01-08','admin',0);
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
# Data for the `tb_ruolino` table  (LIMIT -496,500)
#

INSERT INTO `tb_ruolino` (`id`, `id_commessa`, `cod_commessa`, `descrizione_commessa`, `localizzazione_lavoro`, `quantita`, `addetti`, `ore`, `mezzo`, `km`, `autista`, `terzi`, `ore_terzi`, `note`, `data`, `utente`, `cod_lavoro`, `descrizione_lavoro`, `codizioni_climatiche`, `id_lavoro`, `id_dipendenti`, `id_mezzo`, `clima`, `tipologia`) VALUES

  (8,6,'001','Casa_Della_Salute',NULL,'',' Mario Rossi, Franco Bianchi','6','Clio','','5-Mario Rossi','','0','','2015-01-08','admin','1','verifica del massetto esistente (PAVIMENTAZIONI TERRAZZI scheda n. 02)',NULL,5,'5 ,6 ',1,'SERENO',NULL),
  (9,1,'12/01','',NULL,'',' Mario Rossi','5','','','5-Mario Rossi','','0','','2015-01-08','admin','1','Preparazione del supporto',NULL,1,'5 ',0,'SERENO',NULL),
  (21,1,'12/01','prova commessa 1',NULL,'',' Rossi Mario','1',NULL,NULL,'Rossi Mario','','','','2015-01-09','admin','1','verifica del massetto esistente (IMPERMEABILIZZAZIONI scheda n. 01)',NULL,5,'5 ',NULL,'SERENO','cap');
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
# Data for the `tb_users` table  (LIMIT -494,500)
#

INSERT INTO `tb_users` (`id`, `username`, `password`, `ruolo`, `email`, `mansione`, `nome`, `cognome`) VALUES

  (32,'admin','admin','ADMIN','prova@prova.it','amministratore','mario','rossi'),
  (33,'mezzo','mezzo','MEZZI','mezzo@m.it','mezzo','mezzo','mezzo'),
  (34,'commessa','commessa','COMMESSA','commessa@m.it','commessa','commessa','commessa'),
  (35,'ruolino','ruolino','RUOLINO','ruolino@m.it','impiegato','ruolino','ruolino'),
  (36,'user','user','PERSONALE_RUOLINO','user@m.it','Impiegato','user','user');
COMMIT;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;