DROP TABLE tb_allegati;

CREATE TABLE `tb_allegati` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `n_sospensioni` int(11) DEFAULT NULL,
  `descrizione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `verbale_n` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `link_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `id_commessa` int(11) DEFAULT NULL,
  `file_name` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_commessa` (`id_commessa`),
  CONSTRAINT `tb_allegati_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=16384 PACK_KEYS=0;

INSERT INTO tb_allegati VALUES("","","","","","","","");
INSERT INTO tb_allegati VALUES("","","","","","","","");
INSERT INTO tb_allegati VALUES("","","","","","","","");
INSERT INTO tb_allegati VALUES("","","","","","","","");



DROP TABLE tb_allegati_attivita;

CREATE TABLE `tb_allegati_attivita` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_attivita` int(11) DEFAULT NULL,
  `descrizione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data_ricevuto` date DEFAULT NULL,
  `data_inviato` date DEFAULT NULL,
  `inviato_a` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `link_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_attivita` (`id_attivita`),
  CONSTRAINT `tb_allegati_attivita_fk1` FOREIGN KEY (`id_attivita`) REFERENCES `tb_attivita` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;




DROP TABLE tb_allegati_comunicazioni;

CREATE TABLE `tb_allegati_comunicazioni` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_comunicazione` int(11) DEFAULT NULL,
  `link` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `descrizione` varchar(512) COLLATE latin1_general_ci DEFAULT NULL,
  `utente` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `file_name` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;

INSERT INTO tb_allegati_comunicazioni VALUES("","","","","","");
INSERT INTO tb_allegati_comunicazioni VALUES("","","","","","");
INSERT INTO tb_allegati_comunicazioni VALUES("","","","","","");
INSERT INTO tb_allegati_comunicazioni VALUES("","","","","","");



DROP TABLE tb_allegati_dipendenti;

CREATE TABLE `tb_allegati_dipendenti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_dipendente` int(11) DEFAULT NULL,
  `id_commessa` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `scadenza` date DEFAULT NULL,
  `descrizione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `link_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_dipendente` (`id_dipendente`),
  CONSTRAINT `tb_allegati_dipendenti_fk1` FOREIGN KEY (`id_dipendente`) REFERENCES `tb_dipendenti` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;

INSERT INTO tb_allegati_dipendenti VALUES("","","","","","","","");
INSERT INTO tb_allegati_dipendenti VALUES("","","","","","","","");



DROP TABLE tb_allegati_gare;

CREATE TABLE `tb_allegati_gare` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descrizione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `link_file` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `filename` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `utente` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `id_gara` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_gara` (`id_gara`),
  CONSTRAINT `tb_allegati_gare_fk1` FOREIGN KEY (`id_gara`) REFERENCES `tb_gara` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;

INSERT INTO tb_allegati_gare VALUES("","","","","","");



DROP TABLE tb_allegati_noleggi;

CREATE TABLE `tb_allegati_noleggi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_noleggio` int(11) DEFAULT NULL,
  `descrizione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `link_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_noleggio` (`id_noleggio`),
  CONSTRAINT `tb_allegati_noleggi_fk1` FOREIGN KEY (`id_noleggio`) REFERENCES `tb_noleggi` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;

INSERT INTO tb_allegati_noleggi VALUES("","","","","");



DROP TABLE tb_allegati_ordini_commessa;

CREATE TABLE `tb_allegati_ordini_commessa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descrizione` varchar(512) COLLATE latin1_general_ci DEFAULT NULL,
  `data` date DEFAULT NULL,
  `id_ordine_commessa` int(11) DEFAULT NULL,
  `link_file` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `filename` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `tipologia` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_ordine_commessa` (`id_ordine_commessa`),
  CONSTRAINT `tb_allegati_ordini_commessa_fk1` FOREIGN KEY (`id_ordine_commessa`) REFERENCES `tb_ordini_commessa` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;

INSERT INTO tb_allegati_ordini_commessa VALUES("","","","","","","");
INSERT INTO tb_allegati_ordini_commessa VALUES("","","","","","","");
INSERT INTO tb_allegati_ordini_commessa VALUES("","","","","","","");
INSERT INTO tb_allegati_ordini_commessa VALUES("","","","","","","");
INSERT INTO tb_allegati_ordini_commessa VALUES("","","","","","","");



DROP TABLE tb_attivita;

CREATE TABLE `tb_attivita` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` int(11) DEFAULT NULL,
  `impresa_fornitrice` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `lavoro` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `importo` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `data_del` date DEFAULT NULL,
  `registrato_a` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `data_il` date DEFAULT NULL,
  `numero` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_commessa` (`id_commessa`),
  CONSTRAINT `tb_attivita_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;

INSERT INTO tb_attivita VALUES("","","","","","","","","");



DROP TABLE tb_benzina;

CREATE TABLE `tb_benzina` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_mezzo` int(11) DEFAULT NULL,
  `n_ticket` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `localita` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `targa` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `codice_autista` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `km_veicolo` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `prodotto_servizio` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `quantita_litri` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `importo_ticket` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `prezzo_pompa` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `sconto` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `prezzo_escluso_iva` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `importo_netto` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `aliq_iva` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `importo_iva` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `totale_iva_inclusa` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `numero_carta` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `titolare_carta` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_mezzo` (`id_mezzo`),
  CONSTRAINT `tb_benzina_fk1` FOREIGN KEY (`id_mezzo`) REFERENCES `tb_mezzi` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;

INSERT INTO tb_benzina VALUES("","","","","","","","","","","","","","","","","","","","");
INSERT INTO tb_benzina VALUES("","","","","","","","","","","","","","","","","","","","");



DROP TABLE tb_categorie;

CREATE TABLE `tb_categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_verbale` int(11) DEFAULT NULL,
  `descrizione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `importo` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_verbale` (`id_verbale`),
  CONSTRAINT `tb_categorie_fk1` FOREIGN KEY (`id_verbale`) REFERENCES `tb_verbali` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;

INSERT INTO tb_categorie VALUES("","","","");
INSERT INTO tb_categorie VALUES("","","","");



DROP TABLE tb_commesse;

CREATE TABLE `tb_commesse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codice` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `descrizione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `localita` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data_inizio` date DEFAULT '0000-00-00',
  `data_fine` date DEFAULT '0000-00-00',
  `status` tinyint(1) DEFAULT NULL,
  `annotazioni` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `cantiere` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `importo` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `tipologia_lavori` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `referente` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `fax` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `cellulare` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `utente` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `campo1` char(5) COLLATE latin1_general_ci DEFAULT NULL,
  `campo2` char(5) COLLATE latin1_general_ci DEFAULT NULL,
  `campo3` char(5) COLLATE latin1_general_ci DEFAULT NULL,
  `campo4` char(5) COLLATE latin1_general_ci DEFAULT NULL,
  `campo5` char(5) COLLATE latin1_general_ci DEFAULT NULL,
  `email` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `indirizzo_referente` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `pi` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `pec` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=16384 PACK_KEYS=0;

INSERT INTO tb_commesse VALUES("","","","","","","","","","","","","","","","","","","","","","","","","");
INSERT INTO tb_commesse VALUES("","","","","","","","","","","","","","","","","","","","","","","","","");
INSERT INTO tb_commesse VALUES("","","","","","","","","","","","","","","","","","","","","","","","","");



DROP TABLE tb_comunicazioni;

CREATE TABLE `tb_comunicazioni` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` date DEFAULT NULL,
  `id_commessa` int(11) DEFAULT NULL,
  `descrizione_commessa` varchar(512) COLLATE latin1_general_ci DEFAULT NULL,
  `tipo_comunicazione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `destinatario` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `testo` text COLLATE latin1_general_ci,
  `note` text COLLATE latin1_general_ci,
  `utente` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;

INSERT INTO tb_comunicazioni VALUES("","","","","","","","","");
INSERT INTO tb_comunicazioni VALUES("","","","","","","","","");
INSERT INTO tb_comunicazioni VALUES("","","","","","","","","");
INSERT INTO tb_comunicazioni VALUES("","","","","","","","","");



DROP TABLE tb_costi;

CREATE TABLE `tb_costi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_dipendente` int(11) DEFAULT NULL,
  `data_inizio` date DEFAULT NULL,
  `data_fine` date DEFAULT NULL,
  `costo` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `mese` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `anno` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `tb_costi_idx1` (`mese`,`anno`,`id_dipendente`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;

INSERT INTO tb_costi VALUES("","","","","","","");
INSERT INTO tb_costi VALUES("","","","","","","");
INSERT INTO tb_costi VALUES("","","","","","","");
INSERT INTO tb_costi VALUES("","","","","","","");
INSERT INTO tb_costi VALUES("","","","","","","");
INSERT INTO tb_costi VALUES("","","","","","","");
INSERT INTO tb_costi VALUES("","","","","","","");
INSERT INTO tb_costi VALUES("","","","","","","");
INSERT INTO tb_costi VALUES("","","","","","","");
INSERT INTO tb_costi VALUES("","","","","","","");
INSERT INTO tb_costi VALUES("","","","","","","");



DROP TABLE tb_dipendenti;

CREATE TABLE `tb_dipendenti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `cognome` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `attivo` varchar(256) COLLATE latin1_general_ci DEFAULT 'ATTIVO',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;

INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");
INSERT INTO tb_dipendenti VALUES("","","","");



DROP TABLE tb_documentazione;

CREATE TABLE `tb_documentazione` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `descrizione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `link_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_commessa` (`id_commessa`),
  CONSTRAINT `tb_documentazione_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;

INSERT INTO tb_documentazione VALUES("","","","","","");
INSERT INTO tb_documentazione VALUES("","","","","","");



DROP TABLE tb_documenti_cliente;

CREATE TABLE `tb_documenti_cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` int(11) DEFAULT NULL,
  `descrizione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `ente_rilascio` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data` date DEFAULT NULL,
  `validita` date DEFAULT NULL,
  `scadenza` date DEFAULT NULL,
  `rinnovo` date DEFAULT NULL,
  `link_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_commessa` (`id_commessa`),
  CONSTRAINT `tb_documenti_cliente_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;

INSERT INTO tb_documenti_cliente VALUES("","","","","","","","","","");



DROP TABLE tb_fattura;

CREATE TABLE `tb_fattura` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` int(11) DEFAULT NULL,
  `tipo_documento` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `descrizione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `importo_totale` double(15,2) DEFAULT NULL,
  `data_pagamento` date DEFAULT NULL,
  `data_incasso` date DEFAULT NULL,
  `link_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_commessa` (`id_commessa`),
  CONSTRAINT `tb_fattura_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;

INSERT INTO tb_fattura VALUES("","","","","","","","","");
INSERT INTO tb_fattura VALUES("","","","","","","","","");



DROP TABLE tb_fatture_ral;

CREATE TABLE `tb_fatture_ral` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ral` int(11) DEFAULT NULL,
  `descrizione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `importo` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `link_allegato` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `note` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data` date DEFAULT NULL,
  `utente` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ral` (`id_ral`),
  CONSTRAINT `tb_fatture_ral_fk1` FOREIGN KEY (`id_ral`) REFERENCES `tb_ral` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=8192 PACK_KEYS=0;

INSERT INTO tb_fatture_ral VALUES("","","","","","","","","");



DROP TABLE tb_gara;

CREATE TABLE `tb_gara` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descrizione` text COLLATE latin1_general_ci,
  `data_emissione` date DEFAULT NULL,
  `data_scadenza` date DEFAULT NULL,
  `polizze` varchar(512) COLLATE latin1_general_ci DEFAULT NULL,
  `avcp` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `passoe` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `utente` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;

INSERT INTO tb_gara VALUES("","","","","","","","");



DROP TABLE tb_lavoro;

CREATE TABLE `tb_lavoro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cod_lavoro` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `descrizione` text COLLATE latin1_general_ci,
  `attivita` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `lavorazione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;

INSERT INTO tb_lavoro VALUES("","","","","");
INSERT INTO tb_lavoro VALUES("","","","","");



DROP TABLE tb_log;

CREATE TABLE `tb_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `operazione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `utente` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data_inserimento` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `colore` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2589 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;

INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");
INSERT INTO tb_log VALUES("","","","","");



DROP TABLE tb_magazzino;

CREATE TABLE `tb_magazzino` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` date DEFAULT NULL,
  `mezzo` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `id_mezzo` int(11) DEFAULT NULL,
  `id_commessa` int(11) DEFAULT NULL,
  `descrizione_commessa` varchar(512) COLLATE latin1_general_ci DEFAULT NULL,
  `materiale` varchar(512) COLLATE latin1_general_ci DEFAULT NULL,
  `quantita` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `utente` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `firma` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `id_testata_magazzino` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;

INSERT INTO tb_magazzino VALUES("","","","","","","","","","","");
INSERT INTO tb_magazzino VALUES("","","","","","","","","","","");
INSERT INTO tb_magazzino VALUES("","","","","","","","","","","");
INSERT INTO tb_magazzino VALUES("","","","","","","","","","","");
INSERT INTO tb_magazzino VALUES("","","","","","","","","","","");
INSERT INTO tb_magazzino VALUES("","","","","","","","","","","");
INSERT INTO tb_magazzino VALUES("","","","","","","","","","","");



DROP TABLE tb_manutenzione;

CREATE TABLE `tb_manutenzione` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` date DEFAULT NULL,
  `id_mezzo` int(11) DEFAULT NULL,
  `mezzo` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `utente` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `libretto` tinyint(1) DEFAULT NULL,
  `assicurazione` tinyint(1) DEFAULT NULL,
  `olio_cambio` tinyint(1) DEFAULT NULL,
  `olio_motore` tinyint(1) DEFAULT NULL,
  `estintori` tinyint(1) DEFAULT NULL,
  `pneumatici` tinyint(1) DEFAULT NULL,
  `elettrico` tinyint(1) DEFAULT NULL,
  `triangolo` tinyint(1) DEFAULT NULL,
  `giubbino` tinyint(1) DEFAULT NULL,
  `vetri` tinyint(1) DEFAULT NULL,
  `pronto_soccorso` tinyint(1) DEFAULT NULL,
  `carrozzeria` tinyint(1) DEFAULT NULL,
  `freni` tinyint(1) DEFAULT NULL,
  `luci` tinyint(1) DEFAULT NULL,
  `tergicristalli` tinyint(1) DEFAULT NULL,
  `indicatori` tinyint(1) DEFAULT NULL,
  `climatizzatore` tinyint(1) DEFAULT NULL,
  `altro` tinyint(1) DEFAULT NULL,
  `note` text COLLATE latin1_general_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;

INSERT INTO tb_manutenzione VALUES("","","","","","","","","","","","","","","","","","","","","","","","");
INSERT INTO tb_manutenzione VALUES("","","","","","","","","","","","","","","","","","","","","","","","");
INSERT INTO tb_manutenzione VALUES("","","","","","","","","","","","","","","","","","","","","","","","");
INSERT INTO tb_manutenzione VALUES("","","","","","","","","","","","","","","","","","","","","","","","");
INSERT INTO tb_manutenzione VALUES("","","","","","","","","","","","","","","","","","","","","","","","");
INSERT INTO tb_manutenzione VALUES("","","","","","","","","","","","","","","","","","","","","","","","");
INSERT INTO tb_manutenzione VALUES("","","","","","","","","","","","","","","","","","","","","","","","");
INSERT INTO tb_manutenzione VALUES("","","","","","","","","","","","","","","","","","","","","","","","");
INSERT INTO tb_manutenzione VALUES("","","","","","","","","","","","","","","","","","","","","","","","");
INSERT INTO tb_manutenzione VALUES("","","","","","","","","","","","","","","","","","","","","","","","");
INSERT INTO tb_manutenzione VALUES("","","","","","","","","","","","","","","","","","","","","","","","");
INSERT INTO tb_manutenzione VALUES("","","","","","","","","","","","","","","","","","","","","","","","");



DROP TABLE tb_materiale;

CREATE TABLE `tb_materiale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` int(11) DEFAULT NULL,
  `tipo_materiale` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `fornitore` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `costo` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `quantita` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `data` date DEFAULT NULL,
  `link_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `importo` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_commessa` (`id_commessa`),
  CONSTRAINT `tb_materiale_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;

INSERT INTO tb_materiale VALUES("","","","","","","","","","");
INSERT INTO tb_materiale VALUES("","","","","","","","","","");



DROP TABLE tb_mezzi;

CREATE TABLE `tb_mezzi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mezzo` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `targa` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `km_percorsi` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data_ultimo_aggiornamento_km` date DEFAULT NULL,
  `tagliando_ogni` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `km_ultimo_tagliando` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `costo_totale` double(15,2) DEFAULT '0.00',
  `venduto` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;

INSERT INTO tb_mezzi VALUES("","","","","","","","","");
INSERT INTO tb_mezzi VALUES("","","","","","","","","");
INSERT INTO tb_mezzi VALUES("","","","","","","","","");
INSERT INTO tb_mezzi VALUES("","","","","","","","","");
INSERT INTO tb_mezzi VALUES("","","","","","","","","");
INSERT INTO tb_mezzi VALUES("","","","","","","","","");
INSERT INTO tb_mezzi VALUES("","","","","","","","","");



DROP TABLE tb_noleggi;

CREATE TABLE `tb_noleggi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` int(11) DEFAULT NULL,
  `numero` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `descrizione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `importo` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `fornitore` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `data` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_commessa` (`id_commessa`),
  CONSTRAINT `tb_noleggi_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;

INSERT INTO tb_noleggi VALUES("","","","","","","");



DROP TABLE tb_ordini;

CREATE TABLE `tb_ordini` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` int(11) DEFAULT NULL,
  `descrizione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `link_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_commessa` (`id_commessa`),
  CONSTRAINT `tb_ordini_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;

INSERT INTO tb_ordini VALUES("","","","","");



DROP TABLE tb_ordini_commessa;

CREATE TABLE `tb_ordini_commessa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` int(11) DEFAULT NULL,
  `cod_commessa` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `descrizione_commessa` varchar(512) COLLATE latin1_general_ci DEFAULT NULL,
  `fornitore` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `utente` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;

INSERT INTO tb_ordini_commessa VALUES("","","","","","");
INSERT INTO tb_ordini_commessa VALUES("","","","","","");
INSERT INTO tb_ordini_commessa VALUES("","","","","","");
INSERT INTO tb_ordini_commessa VALUES("","","","","","");



DROP TABLE tb_personale;

CREATE TABLE `tb_personale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` int(11) DEFAULT NULL,
  `id_dipendente` int(11) DEFAULT NULL,
  `nome` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `cognome` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `costo_h` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tb_personale_idx1` (`id_commessa`,`id_dipendente`),
  KEY `id_commessa` (`id_commessa`),
  KEY `id_dipendente` (`id_dipendente`),
  CONSTRAINT `tb_personale_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;




DROP TABLE tb_polizza;

CREATE TABLE `tb_polizza` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` int(11) DEFAULT NULL,
  `descrizione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data_stipula` date DEFAULT NULL,
  `scadenza` date DEFAULT NULL,
  `importo` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `link_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `polizza_svincolata` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_commessa` (`id_commessa`),
  CONSTRAINT `tb_polizza_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;

INSERT INTO tb_polizza VALUES("","","","","","","","","");
INSERT INTO tb_polizza VALUES("","","","","","","","","");



DROP TABLE tb_presenze;

CREATE TABLE `tb_presenze` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_dipendente` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `dettagli` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `n_ore` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `n_giorni` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `id_commessa` int(11) DEFAULT NULL,
  `costo` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tb_presenze_idx1` (`id_dipendente`,`id_commessa`,`data`,`dettagli`) USING BTREE,
  KEY `id_dipendente` (`id_dipendente`),
  KEY `id_commessa` (`id_commessa`),
  CONSTRAINT `tb_presenze_fk1` FOREIGN KEY (`id_dipendente`) REFERENCES `tb_dipendenti` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tb_presenze_fk2` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;

INSERT INTO tb_presenze VALUES("","","","","","","","");



DROP TABLE tb_programmazione_cantiere;

CREATE TABLE `tb_programmazione_cantiere` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` int(11) DEFAULT NULL,
  `cod_commessa` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `descrizione_commessa` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `cod_lavoro` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `descrizione_lavoro` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `id_dipendenti` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `addetti` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `id_mezzo` int(11) DEFAULT NULL,
  `mezzo` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `note` text COLLATE latin1_general_ci,
  `data` date DEFAULT NULL,
  `utente` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `id_lavoro` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;

INSERT INTO tb_programmazione_cantiere VALUES("","","","","","","","","","","","","","");
INSERT INTO tb_programmazione_cantiere VALUES("","","","","","","","","","","","","","");
INSERT INTO tb_programmazione_cantiere VALUES("","","","","","","","","","","","","","");
INSERT INTO tb_programmazione_cantiere VALUES("","","","","","","","","","","","","","");
INSERT INTO tb_programmazione_cantiere VALUES("","","","","","","","","","","","","","");
INSERT INTO tb_programmazione_cantiere VALUES("","","","","","","","","","","","","","");
INSERT INTO tb_programmazione_cantiere VALUES("","","","","","","","","","","","","","");
INSERT INTO tb_programmazione_cantiere VALUES("","","","","","","","","","","","","","");
INSERT INTO tb_programmazione_cantiere VALUES("","","","","","","","","","","","","","");
INSERT INTO tb_programmazione_cantiere VALUES("","","","","","","","","","","","","","");
INSERT INTO tb_programmazione_cantiere VALUES("","","","","","","","","","","","","","");
INSERT INTO tb_programmazione_cantiere VALUES("","","","","","","","","","","","","","");
INSERT INTO tb_programmazione_cantiere VALUES("","","","","","","","","","","","","","");
INSERT INTO tb_programmazione_cantiere VALUES("","","","","","","","","","","","","","");



DROP TABLE tb_ral;

CREATE TABLE `tb_ral` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` int(11) DEFAULT NULL,
  `ral` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `totale_ral` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `link_allegato` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `totale_fatture` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `data` date DEFAULT NULL,
  `note` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `utente` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_commessa` (`id_commessa`),
  CONSTRAINT `tb_ral_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=16384 PACK_KEYS=0;

INSERT INTO tb_ral VALUES("","","","","","","","","","");
INSERT INTO tb_ral VALUES("","","","","","","","","","");



DROP TABLE tb_regolarita;

CREATE TABLE `tb_regolarita` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` int(11) DEFAULT NULL,
  `descrizione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data` date DEFAULT NULL,
  `ente` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `link_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `scadenza` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_commessa` (`id_commessa`),
  CONSTRAINT `tb_regolarita_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;

INSERT INTO tb_regolarita VALUES("","","","","","","","");
INSERT INTO tb_regolarita VALUES("","","","","","","","");



DROP TABLE tb_revisioni;

CREATE TABLE `tb_revisioni` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` int(11) DEFAULT NULL,
  `tipo_documento` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `numero_documento` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `registrato_a` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `data` date DEFAULT NULL,
  `link_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tb_revisioni_fk1` (`id_commessa`),
  CONSTRAINT `tb_revisioni_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;




DROP TABLE tb_riserve;

CREATE TABLE `tb_riserve` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` int(11) DEFAULT NULL,
  `descrizione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data` date DEFAULT NULL,
  `dettagli` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `link_allegato` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_commessa` (`id_commessa`),
  CONSTRAINT `tb_riserve_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;

INSERT INTO tb_riserve VALUES("","","","","","","");



DROP TABLE tb_ruolino;

CREATE TABLE `tb_ruolino` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ultima_modifica` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_commessa` int(11) DEFAULT NULL,
  `cod_commessa` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `descrizione_commessa` text COLLATE latin1_general_ci,
  `localizzazione_lavoro` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `quantita` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `addetti` varchar(512) COLLATE latin1_general_ci DEFAULT NULL,
  `ore` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `mezzo` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `km` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `autista` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `terzi` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `ore_terzi` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `note` text COLLATE latin1_general_ci,
  `data` date DEFAULT NULL,
  `utente` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `cod_lavoro` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `descrizione_lavoro` text COLLATE latin1_general_ci,
  `codizioni_climatiche` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `id_lavoro` int(11) DEFAULT NULL,
  `id_dipendenti` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `id_mezzo` int(11) DEFAULT NULL,
  `clima` varchar(245) COLLATE latin1_general_ci DEFAULT NULL,
  `tipologia` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_commessa` (`id_commessa`),
  CONSTRAINT `tb_ruolino_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;

INSERT INTO tb_ruolino VALUES("","","","","","","","","","","","","","","","","","","","","","","","","");
INSERT INTO tb_ruolino VALUES("","","","","","","","","","","","","","","","","","","","","","","","","");
INSERT INTO tb_ruolino VALUES("","","","","","","","","","","","","","","","","","","","","","","","","");
INSERT INTO tb_ruolino VALUES("","","","","","","","","","","","","","","","","","","","","","","","","");
INSERT INTO tb_ruolino VALUES("","","","","","","","","","","","","","","","","","","","","","","","","");
INSERT INTO tb_ruolino VALUES("","","","","","","","","","","","","","","","","","","","","","","","","");
INSERT INTO tb_ruolino VALUES("","","","","","","","","","","","","","","","","","","","","","","","","");
INSERT INTO tb_ruolino VALUES("","","","","","","","","","","","","","","","","","","","","","","","","");
INSERT INTO tb_ruolino VALUES("","","","","","","","","","","","","","","","","","","","","","","","","");
INSERT INTO tb_ruolino VALUES("","","","","","","","","","","","","","","","","","","","","","","","","");
INSERT INTO tb_ruolino VALUES("","","","","","","","","","","","","","","","","","","","","","","","","");
INSERT INTO tb_ruolino VALUES("","","","","","","","","","","","","","","","","","","","","","","","","");
INSERT INTO tb_ruolino VALUES("","","","","","","","","","","","","","","","","","","","","","","","","");
INSERT INTO tb_ruolino VALUES("","","","","","","","","","","","","","","","","","","","","","","","","");
INSERT INTO tb_ruolino VALUES("","","","","","","","","","","","","","","","","","","","","","","","","");



DROP TABLE tb_spese;

CREATE TABLE `tb_spese` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_mezzo` int(11) DEFAULT NULL,
  `tipo` varchar(256) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'Bollo, Assicurazione, Revisioni, Altro',
  `data_ultimo_pagamento` date DEFAULT NULL,
  `data_scadenza` date DEFAULT NULL,
  `avviso_entro_giorni` int(11) DEFAULT NULL,
  `riferimento_fattura` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `costo` double(15,2) DEFAULT '0.00',
  `eseguito` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_mezzo` (`id_mezzo`),
  CONSTRAINT `tb_spese_fk1` FOREIGN KEY (`id_mezzo`) REFERENCES `tb_mezzi` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;

INSERT INTO tb_spese VALUES("","","","","","","","","");
INSERT INTO tb_spese VALUES("","","","","","","","","");



DROP TABLE tb_tagliando;

CREATE TABLE `tb_tagliando` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_mezzo` int(11) DEFAULT NULL,
  `tipo_tagliando` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data_tagliando` date DEFAULT NULL,
  `costo` double(15,2) DEFAULT NULL,
  `riferimento_fattura` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `tagliando_ogni` varchar(256) COLLATE latin1_general_ci DEFAULT '0',
  `eseguito` tinyint(1) DEFAULT '0',
  `colore` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `tagliando_prossimo` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_mezzo` (`id_mezzo`),
  CONSTRAINT `tb_tagliando_fk1` FOREIGN KEY (`id_mezzo`) REFERENCES `tb_mezzi` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=8192 PACK_KEYS=0;

INSERT INTO tb_tagliando VALUES("","","","","","","","","","");
INSERT INTO tb_tagliando VALUES("","","","","","","","","","");



DROP TABLE tb_tecnica;

CREATE TABLE `tb_tecnica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num_preventivo` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `cliente` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `sopraluogo` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data` date DEFAULT NULL,
  `offerta` varchar(512) COLLATE latin1_general_ci DEFAULT NULL,
  `operatore` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `ricontatti` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `esito` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `tipo_cliente` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `tipo_sede` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `motivazione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data_acquisizione` date DEFAULT NULL,
  `modalita` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `link_file` varchar(512) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;

INSERT INTO tb_tecnica VALUES("","","","","","","","","","","","","","","");



DROP TABLE tb_terzi;

CREATE TABLE `tb_terzi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `descrizione` text COLLATE latin1_general_ci,
  `ore` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;

INSERT INTO tb_terzi VALUES("","","","","");
INSERT INTO tb_terzi VALUES("","","","","");



DROP TABLE tb_testata_magazzino;

CREATE TABLE `tb_testata_magazzino` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mezzo` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `id_mezzo` int(11) DEFAULT NULL,
  `id_commessa` int(11) DEFAULT NULL,
  `descrizione_commessa` varchar(512) COLLATE latin1_general_ci DEFAULT NULL,
  `data` date DEFAULT NULL,
  `utente` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;

INSERT INTO tb_testata_magazzino VALUES("","","","","","","");
INSERT INTO tb_testata_magazzino VALUES("","","","","","","");
INSERT INTO tb_testata_magazzino VALUES("","","","","","","");
INSERT INTO tb_testata_magazzino VALUES("","","","","","","");
INSERT INTO tb_testata_magazzino VALUES("","","","","","","");



DROP TABLE tb_users;

CREATE TABLE `tb_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `password` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `ruolo` varchar(256) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'ADMIN | USER',
  `email` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `mansione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `nome` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `cognome` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=16384;

INSERT INTO tb_users VALUES("","","","","","","","");
INSERT INTO tb_users VALUES("","","","","","","","");
INSERT INTO tb_users VALUES("","","","","","","","");
INSERT INTO tb_users VALUES("","","","","","","","");
INSERT INTO tb_users VALUES("","","","","","","","");
INSERT INTO tb_users VALUES("","","","","","","","");
INSERT INTO tb_users VALUES("","","","","","","","");



DROP TABLE tb_utilizzo;

CREATE TABLE `tb_utilizzo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_mezzo` int(11) DEFAULT NULL,
  `id_commessa` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `dettagli` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `n_ore` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_commessa` (`id_commessa`),
  KEY `id_mezzo` (`id_mezzo`),
  CONSTRAINT `tb_utilizzo_fk1` FOREIGN KEY (`id_mezzo`) REFERENCES `tb_veicoli` (`id_mezzo`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;




DROP TABLE tb_veicoli;

CREATE TABLE `tb_veicoli` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` int(11) DEFAULT NULL,
  `id_mezzo` int(11) DEFAULT NULL,
  `mezzo` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `targa` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `costo_h` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `data` date DEFAULT NULL,
  `km` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tb_veicoli_idx1` (`id_commessa`,`id_mezzo`,`data`) USING BTREE,
  KEY `id_mezzo` (`id_mezzo`),
  KEY `id_commessa` (`id_commessa`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;

INSERT INTO tb_veicoli VALUES("","","","","","","","");
INSERT INTO tb_veicoli VALUES("","","","","","","","");



DROP TABLE tb_verbali;

CREATE TABLE `tb_verbali` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` int(11) DEFAULT NULL,
  `descrizione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data` date DEFAULT NULL,
  `importo` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `link_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_commessa` (`id_commessa`),
  CONSTRAINT `tb_verbali_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;

INSERT INTO tb_verbali VALUES("","","","","","","");



