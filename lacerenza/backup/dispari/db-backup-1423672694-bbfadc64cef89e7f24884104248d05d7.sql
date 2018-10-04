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

INSERT INTO tb_allegati VALUES("7","1","Foto","","uploads/commesse/1/cantiere/collina.png","1","collina.png","2015-01-08");
INSERT INTO tb_allegati VALUES("9","1","ddd","","uploads/commesse/1/cantiere/cappello.png","1","cappello.png","2015-01-09");
INSERT INTO tb_allegati VALUES("10","1","AAA","","uploads/commesse/4/cantiere/ore_lavoro.xlsx","4","ore_lavoro.xlsx","2015-01-15");
INSERT INTO tb_allegati VALUES("11","1","prova","","uploads/commesse/4/cantiere/prova.rtf","4","prova.rtf","2015-01-15");



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

INSERT INTO tb_allegati_comunicazioni VALUES("16","7","uploads/comunicazioni/7/cappello - Copia.png","dasd","admin","cappello - Copia.png");
INSERT INTO tb_allegati_comunicazioni VALUES("18","8","uploads/comunicazioni/8/cappello.png","aaa","admin","cappello.png");
INSERT INTO tb_allegati_comunicazioni VALUES("19","5","uploads/comunicazioni/5/cappello.png","aa","admin","cappello.png");
INSERT INTO tb_allegati_comunicazioni VALUES("20","5","uploads/comunicazioni/5/fiore.png","bb","admin","fiore.png");



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

INSERT INTO tb_allegati_dipendenti VALUES("1","5","","2014-10-31","2014-10-31","aa","uploads/dipendenti/5/","cappello - Copia.png");
INSERT INTO tb_allegati_dipendenti VALUES("2","5","","2014-10-31","2014-10-31","aa","uploads/dipendenti/5/","31_10_2014_08_43_27cappello - Copia.png");



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

INSERT INTO tb_allegati_gare VALUES("10","fsdf","uploads/gare/7/","collina.png","admin","7");



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

INSERT INTO tb_allegati_noleggi VALUES("19","9","Contratto","uploads/commesse/1/noleggi/9/","cappello.png");



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

INSERT INTO tb_allegati_ordini_commessa VALUES("10","fattura","2015-01-16","14","../uploads/commesse/1/ordini_commessa/14/cappello.png","cappello.png","");
INSERT INTO tb_allegati_ordini_commessa VALUES("11","DDT 123","2015-01-17","14","../uploads/commesse/1/ordini_commessa/14/collina.png","collina.png","");
INSERT INTO tb_allegati_ordini_commessa VALUES("12","fds","2015-01-16","12","../uploads/commesse/1/ordini_commessa/12/collina.png","collina.png","FATTURA");
INSERT INTO tb_allegati_ordini_commessa VALUES("13","ffff","2015-01-16","12","../uploads/commesse/1/ordini_commessa/12/foto.png","foto.png","DDT");
INSERT INTO tb_allegati_ordini_commessa VALUES("14","aaa","2015-01-28","12","../uploads/commesse/1/ordini_commessa/12/intro.jpg","intro.jpg","FATTURA");



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

INSERT INTO tb_attivita VALUES("1","1","11","11","1111","2015-01-20","11","2015-01-20","11");



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

INSERT INTO tb_benzina VALUES("8","1","","POTENZA","AA123EE","","3181","Gasolio Autotrazione","60,84","96.01","157,81","3","126,89","77,20","22","16.98","94.18","7033161200630597","059 IANNIELLI G.R.","2014-09-15");
INSERT INTO tb_benzina VALUES("9","1","","","AA123EE","","1","","","","","","","","22","","10","","","2015-02-04");



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

INSERT INTO tb_categorie VALUES("6","11","Cat A","1000");
INSERT INTO tb_categorie VALUES("7","11","Cat B","3000");



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

INSERT INTO tb_commesse VALUES("1","12/01","prova commessa 1","Potenza","2014-10-07","0000-00-00","","asdfsd sdf asdf sdaf sdf sdf sdf asdf dsfa sdf","Potenza via Anzio1","10000,21","Ristrutturazione","Condiminio via anzio","no","no","no","admin","06","01","","","","2222","1111","4444","3333");
INSERT INTO tb_commesse VALUES("4","123","prova commessa 2","Potenza","2014-12-10","0000-00-00","","","Via Rocco Scotellaro","12","12","12","12","12","12","admin","","","","","","","","","");
INSERT INTO tb_commesse VALUES("6","001","Casa_Della_Salute","Avigliano","2014-12-29","0000-00-00","","","Casa_Della_Salute","111","Casa_Della_Salute","Casa_Della_Salute","1","11","1","admin","","","","","","","","","");



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

INSERT INTO tb_comunicazioni VALUES("5","2015-01-12","1","prova commessa 1","EMAIL","A","aas","","admin");
INSERT INTO tb_comunicazioni VALUES("7","2015-01-12","4","prova commessa 2","FAX","sadas","dasdsd","asdasd","admin");
INSERT INTO tb_comunicazioni VALUES("8","2015-01-27","1","prova commessa 1","EMAIL","aaa","aaa","sss","admin");
INSERT INTO tb_comunicazioni VALUES("9","2015-01-27","6","Casa_Della_Salute","EMAIL","a","a","a","admin");



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

INSERT INTO tb_costi VALUES("1","5","2014-12-01","2014-12-31","20","DICEMBRE","2014");
INSERT INTO tb_costi VALUES("3","7","2014-12-01","2014-12-31","20","DICEMBRE","2014");
INSERT INTO tb_costi VALUES("4","5","2015-01-01","2015-01-31","15","GENNAIO","2015");
INSERT INTO tb_costi VALUES("7","9","2014-12-01","2014-12-31","12","DICEMBRE","2014");
INSERT INTO tb_costi VALUES("27","6","2014-12-01","2014-12-31","10","DICEMBRE","2014");
INSERT INTO tb_costi VALUES("29","7","0000-00-00","0000-00-00","2","ANNUALE","2015");
INSERT INTO tb_costi VALUES("30","7","2015-01-01","2015-01-31","1","GENNAIO","2015");
INSERT INTO tb_costi VALUES("31","9","2015-01-01","2015-01-31","12","GENNAIO","2015");
INSERT INTO tb_costi VALUES("32","12","2015-01-01","2015-01-31","12","GENNAIO","2015");
INSERT INTO tb_costi VALUES("33","12","2015-06-01","2015-06-30","11","GIUGNO","2015");
INSERT INTO tb_costi VALUES("34","12","2015-02-01","2015-02-28","34","FEBBRAIO","2015");



DROP TABLE tb_dipendenti;

CREATE TABLE `tb_dipendenti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `cognome` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `attivo` varchar(256) COLLATE latin1_general_ci DEFAULT 'ATTIVO',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;

INSERT INTO tb_dipendenti VALUES("5","Mario","Rossi","ATTIVO");
INSERT INTO tb_dipendenti VALUES("6","Franco","Bianchi","ATTIVO");
INSERT INTO tb_dipendenti VALUES("7","Rocco","Verdi","ATTIVO");
INSERT INTO tb_dipendenti VALUES("8","Luca","Liscio","NON_ATTIVO");
INSERT INTO tb_dipendenti VALUES("9","Franca","Salvia","ATTIVO");
INSERT INTO tb_dipendenti VALUES("10","Maria","Ianni","IMPIEGATO");
INSERT INTO tb_dipendenti VALUES("11","prova terzo","terzo","TERZI");
INSERT INTO tb_dipendenti VALUES("12","1","1","ATTIVO");
INSERT INTO tb_dipendenti VALUES("13","2","2","ATTIVO");
INSERT INTO tb_dipendenti VALUES("14","3","3","ATTIVO");
INSERT INTO tb_dipendenti VALUES("15","4","4","ATTIVO");
INSERT INTO tb_dipendenti VALUES("16","5","5","ATTIVO");
INSERT INTO tb_dipendenti VALUES("17","6","6","ATTIVO");
INSERT INTO tb_dipendenti VALUES("18","7","7","ATTIVO");
INSERT INTO tb_dipendenti VALUES("19","8","8","ATTIVO");
INSERT INTO tb_dipendenti VALUES("20","9","9","ATTIVO");
INSERT INTO tb_dipendenti VALUES("21","10","10","ATTIVO");
INSERT INTO tb_dipendenti VALUES("22","11","11","ATTIVO");
INSERT INTO tb_dipendenti VALUES("23","12","12","ATTIVO");
INSERT INTO tb_dipendenti VALUES("24","13","13","ATTIVO");
INSERT INTO tb_dipendenti VALUES("25","14","14","ATTIVO");
INSERT INTO tb_dipendenti VALUES("26","15","15","ATTIVO");
INSERT INTO tb_dipendenti VALUES("27","16","16","ATTIVO");
INSERT INTO tb_dipendenti VALUES("28","17","17","ATTIVO");
INSERT INTO tb_dipendenti VALUES("29","18","18","ATTIVO");
INSERT INTO tb_dipendenti VALUES("30","19","19","ATTIVO");
INSERT INTO tb_dipendenti VALUES("31","20","20","ATTIVO");
INSERT INTO tb_dipendenti VALUES("32","21","21","ATTIVO");
INSERT INTO tb_dipendenti VALUES("33","22","22","ATTIVO");
INSERT INTO tb_dipendenti VALUES("34","23","23","ATTIVO");
INSERT INTO tb_dipendenti VALUES("35","24","24","ATTIVO");
INSERT INTO tb_dipendenti VALUES("36","25","25","ATTIVO");
INSERT INTO tb_dipendenti VALUES("37","26","26","ATTIVO");
INSERT INTO tb_dipendenti VALUES("38","27","27","ATTIVO");
INSERT INTO tb_dipendenti VALUES("39","28","28","ATTIVO");
INSERT INTO tb_dipendenti VALUES("40","29","29","ATTIVO");
INSERT INTO tb_dipendenti VALUES("41","30","30","ATTIVO");
INSERT INTO tb_dipendenti VALUES("42","31","31","ATTIVO");
INSERT INTO tb_dipendenti VALUES("44","32","32","ATTIVO");
INSERT INTO tb_dipendenti VALUES("45","33","33","ATTIVO");
INSERT INTO tb_dipendenti VALUES("46","34","34","ATTIVO");
INSERT INTO tb_dipendenti VALUES("47","35","35","ATTIVO");
INSERT INTO tb_dipendenti VALUES("48","36","36","ATTIVO");
INSERT INTO tb_dipendenti VALUES("49","37","37","ATTIVO");
INSERT INTO tb_dipendenti VALUES("50","38","38","ATTIVO");
INSERT INTO tb_dipendenti VALUES("51","39","39","ATTIVO");
INSERT INTO tb_dipendenti VALUES("52","40","40","ATTIVO");



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

INSERT INTO tb_documentazione VALUES("10","1","2014-10-08","Doc 1","uploads/commesse/1/documentazioni/","prova.pdf");
INSERT INTO tb_documentazione VALUES("11","1","2014-10-06","Doc 2","uploads/commesse/1/documentazioni/","");



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

INSERT INTO tb_documenti_cliente VALUES("1","1","Lorem ipsum","Comune di Avigliano","2014-10-08","0000-00-00","0000-00-00","0000-00-00","uploads/commesse/1/documenti_cliente/","prova.pdf");



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

INSERT INTO tb_fattura VALUES("1","1","Fattura","Lorem Ipsum","500.00","2014-10-06","2014-10-08","uploads/commesse/1/fatture/","prova.pdf");
INSERT INTO tb_fattura VALUES("2","1","1","1","100.00","2014-10-23","0000-00-00","uploads/commesse/1/fatture/","");



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

INSERT INTO tb_fatture_ral VALUES("1","1","1","1234","","","","2015-01-20","admin");



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

INSERT INTO tb_gara VALUES("7","2","2015-01-15","2015-01-15","2","2","2","admin");



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

INSERT INTO tb_lavoro VALUES("5","1","","verifica del massetto esistente","IMPERMEABILIZZAZIONI scheda n. 01");
INSERT INTO tb_lavoro VALUES("8","1","","demolizione del pavimento esistente","PAVIMENTAZIONI TERRAZZI scheda n. 02");



DROP TABLE tb_log;

CREATE TABLE `tb_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `operazione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `utente` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data_inserimento` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `colore` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2589 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci PACK_KEYS=0;

INSERT INTO tb_log VALUES("2524","Inserimento allegato gara: intro.jpg","admin","2015-01-28 11:59:24","verde");
INSERT INTO tb_log VALUES("2525","Inserimento ruolino giornaliero","admin","2015-01-28 19:08:40","verde");
INSERT INTO tb_log VALUES("2526","Inserimento costo","admin","2015-02-03 16:25:52","verde");
INSERT INTO tb_log VALUES("2527","Inserimento costo","admin","2015-02-03 16:26:27","verde");
INSERT INTO tb_log VALUES("2528","Eliminazione costo","admin","2015-02-03 16:27:21","rosso");
INSERT INTO tb_log VALUES("2529","Inserimento manutenzione 2015-02-03","admin","2015-02-03 17:07:05","verde");
INSERT INTO tb_log VALUES("2530","Modifica manutenzione 2015-02-04","admin","2015-02-04 09:32:16","verde");
INSERT INTO tb_log VALUES("2531","Modifica manutenzione 2015-02-04","admin","2015-02-04 09:33:23","verde");
INSERT INTO tb_log VALUES("2532","Modifica manutenzione 2015-02-04","admin","2015-02-04 09:33:28","verde");
INSERT INTO tb_log VALUES("2533","Modifica manutenzione 2015-02-04","admin","2015-02-04 09:33:52","verde");
INSERT INTO tb_log VALUES("2534","Modifica manutenzione 2015-02-04","admin","2015-02-04 09:33:54","verde");
INSERT INTO tb_log VALUES("2535","Modifica manutenzione 2015-02-04","admin","2015-02-04 09:34:56","verde");
INSERT INTO tb_log VALUES("2536","Modifica manutenzione 2015-02-04","admin","2015-02-04 09:37:22","verde");
INSERT INTO tb_log VALUES("2537","Modifica manutenzione 2015-02-04","admin","2015-02-04 09:38:03","verde");
INSERT INTO tb_log VALUES("2538","Inserimento manutenzione 2015-02-04","admin","2015-02-04 09:42:27","verde");
INSERT INTO tb_log VALUES("2539","Modifica manutenzione 2015-02-04","admin","2015-02-04 09:43:21","verde");
INSERT INTO tb_log VALUES("2540","Inserimento manutenzione 2015-02-04","admin","2015-02-04 09:43:47","verde");
INSERT INTO tb_log VALUES("2541","Inserimento manutenzione 2015-02-04","admin","2015-02-04 09:45:18","verde");
INSERT INTO tb_log VALUES("2542","Inserimento manutenzione 2015-01-1","admin","2015-02-04 09:51:30","verde");
INSERT INTO tb_log VALUES("2543","Inserimento manutenzione 2015-03-1","admin","2015-02-04 09:53:36","verde");
INSERT INTO tb_log VALUES("2544","Inserimento manutenzione 2015-02-1","admin","2015-02-04 10:03:19","verde");
INSERT INTO tb_log VALUES("2545","Inserimento esso card","admin","2015-02-04 10:16:03","verde");
INSERT INTO tb_log VALUES("2546","Modifica esso card","admin","2015-02-04 10:17:21","blu");
INSERT INTO tb_log VALUES("2547","Modifica esso card","admin","2015-02-04 10:17:24","blu");
INSERT INTO tb_log VALUES("2548","Inserimento esso card","admin","2015-02-04 10:18:47","verde");
INSERT INTO tb_log VALUES("2549","Modifica esso card","admin","2015-02-04 10:19:51","blu");
INSERT INTO tb_log VALUES("2550","Eliminazione esso card","admin","2015-02-04 10:21:41","rosso");
INSERT INTO tb_log VALUES("2551","Inserimento costo","admin","2015-02-04 11:54:22","verde");
INSERT INTO tb_log VALUES("2552","Modifica costo","admin","2015-02-04 12:02:42","verde");
INSERT INTO tb_log VALUES("2553","Modifica costo","admin","2015-02-04 12:02:58","verde");
INSERT INTO tb_log VALUES("2554","Modifica costo","admin","2015-02-04 12:03:22","verde");
INSERT INTO tb_log VALUES("2555","Modifica costo","admin","2015-02-04 12:03:27","verde");
INSERT INTO tb_log VALUES("2556","Modifica costo","admin","2015-02-04 12:03:43","verde");
INSERT INTO tb_log VALUES("2557","Modifica costo","admin","2015-02-04 12:04:09","verde");
INSERT INTO tb_log VALUES("2558","Modifica costo","admin","2015-02-04 12:04:23","verde");
INSERT INTO tb_log VALUES("2559","Modifica costo","admin","2015-02-04 12:04:51","verde");
INSERT INTO tb_log VALUES("2560","Modifica costo","admin","2015-02-04 12:05:25","verde");
INSERT INTO tb_log VALUES("2561","Inserimento costo","admin","2015-02-04 12:07:37","verde");
INSERT INTO tb_log VALUES("2562","Inserimento costo","admin","2015-02-04 12:07:42","verde");
INSERT INTO tb_log VALUES("2563","Inserimento noleggio","admin","2015-02-04 12:39:13","verde");
INSERT INTO tb_log VALUES("2564","Eliminazione noleggio","admin","2015-02-04 12:39:19","rosso");
INSERT INTO tb_log VALUES("2565","Inserimento SAL: 1","admin","2015-02-04 12:43:34","verde");
INSERT INTO tb_log VALUES("2566","Inserimento preventivo:  | id=15","admin","2015-02-04 16:59:45","verde");
INSERT INTO tb_log VALUES("2567","Eliminazione tecnica: id=15","admin","2015-02-04 16:59:56","rosso");
INSERT INTO tb_log VALUES("2568","Eliminazione tecnica: id=14","admin","2015-02-04 17:00:02","rosso");
INSERT INTO tb_log VALUES("2569","Inserimento ruolino giornaliero","admin","2015-02-04 17:00:41","verde");
INSERT INTO tb_log VALUES("2570","Inserimento ruolino giornaliero","admin","2015-02-04 17:03:27","verde");
INSERT INTO tb_log VALUES("2571","Modifica ruolino giornaliero","admin","2015-02-04 17:03:59","verde");
INSERT INTO tb_log VALUES("2572","Eliminazione ruolino giornaliero","admin","2015-02-04 17:04:04","rosso");
INSERT INTO tb_log VALUES("2573","Eliminazione ruolino giornaliero","admin","2015-02-04 17:04:07","rosso");
INSERT INTO tb_log VALUES("2574","Inserimento ruolino giornaliero","admin","2015-02-04 17:04:25","verde");
INSERT INTO tb_log VALUES("2575","Modifica ruolino giornaliero","admin","2015-02-05 12:02:53","verde");
INSERT INTO tb_log VALUES("2576","Inserimento manutenzione 2015-03-1","admin","2015-02-05 17:34:42","verde");
INSERT INTO tb_log VALUES("2577","Inserimento manutenzione 2015-03-1","admin","2015-02-05 17:35:51","verde");
INSERT INTO tb_log VALUES("2578","Inserimento manutenzione 2015-03-1","admin","2015-02-05 17:36:33","verde");
INSERT INTO tb_log VALUES("2579","Inserimento manutenzione 2015-04-1","admin","2015-02-05 17:36:54","verde");
INSERT INTO tb_log VALUES("2580","Inserimento manutenzione 2014-12-1","admin","2015-02-05 17:39:39","verde");
INSERT INTO tb_log VALUES("2581","Inserimento manutenzione 2015-01-1","admin","2015-02-05 17:39:58","verde");
INSERT INTO tb_log VALUES("2582","Inserimento ruolino giornaliero","admin","2015-02-06 10:35:39","verde");
INSERT INTO tb_log VALUES("2583","Inserimento preventivo:  | id=1","admin","2015-02-06 12:03:41","verde");
INSERT INTO tb_log VALUES("2584","Modifica ruolino giornaliero","admin","2015-02-06 12:17:52","verde");
INSERT INTO tb_log VALUES("2585","Inserimento ruolino giornaliero","admin","2015-02-06 12:23:59","verde");
INSERT INTO tb_log VALUES("2586","Modifica ruolino giornaliero","admin","2015-02-06 12:29:05","verde");
INSERT INTO tb_log VALUES("2587","Modifica ruolino giornaliero","admin","2015-02-06 19:27:05","verde");
INSERT INTO tb_log VALUES("2588","Modifica commessa","admin","2015-02-11 15:59:47","blu");



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

INSERT INTO tb_magazzino VALUES("10","","","","","","aaa","12","admin","","1");
INSERT INTO tb_magazzino VALUES("15","","","","","","21","12.12","admin","","1");
INSERT INTO tb_magazzino VALUES("17","","","","","","a","1","admin","","11");
INSERT INTO tb_magazzino VALUES("18","","","","","","cemento","3","admin","","4");
INSERT INTO tb_magazzino VALUES("20","","","","","","dfdfd","12","admin","","1");
INSERT INTO tb_magazzino VALUES("21","","","","","","prova","1","admin","","13");
INSERT INTO tb_magazzino VALUES("23","","","","","","wewq","12","mag","","13");



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

INSERT INTO tb_manutenzione VALUES("5","2015-02-04","1","Clio","admin","1","1","1","1","1","1","1","1","1","1","1","1","1","0","0","0","1","0","prova NOTE");
INSERT INTO tb_manutenzione VALUES("7","2015-02-04","2","Altro","admin","0","0","1","1","1","1","1","1","1","1","1","1","1","1","1","1","1","1","jj");
INSERT INTO tb_manutenzione VALUES("8","2015-02-04","1","Clio","admin","1","1","1","0","0","0","1","1","1","1","1","1","1","1","1","1","0","0","kjkhjkk");
INSERT INTO tb_manutenzione VALUES("9","2015-02-04","2","Altro","admin","1","1","1","1","0","0","0","0","0","0","0","0","1","0","0","0","1","1","");
INSERT INTO tb_manutenzione VALUES("10","2015-02-04","2","Altro","admin","1","1","1","1","1","1","1","1","1","1","1","1","1","1","1","0","0","0","");
INSERT INTO tb_manutenzione VALUES("11","2015-01-01","2","Altro","admin","1","1","1","1","1","1","1","1","1","1","1","1","1","1","1","1","1","1","rrr");
INSERT INTO tb_manutenzione VALUES("12","2015-03-01","2","Altro","admin","1","1","1","0","0","0","0","0","0","0","1","1","1","1","1","1","1","1","rtrte");
INSERT INTO tb_manutenzione VALUES("13","2015-02-01","3","a","admin","1","1","1","1","0","0","0","0","0","0","1","1","1","1","1","0","0","0","ok");
INSERT INTO tb_manutenzione VALUES("16","2015-03-01","1","Clio","admin","1","1","1","1","1","1","1","1","1","1","1","1","1","0","0","0","1","0","prova NOTE");
INSERT INTO tb_manutenzione VALUES("17","2015-04-01","1","Clio","admin","1","1","1","1","1","1","1","1","1","1","1","1","1","0","0","0","1","0","prova NOTE");
INSERT INTO tb_manutenzione VALUES("18","2014-12-01","1","Clio","admin","1","1","1","1","1","1","1","1","1","0","0","0","0","0","0","0","0","0","asas");
INSERT INTO tb_manutenzione VALUES("19","2015-01-01","1","Clio","admin","1","1","1","1","1","1","1","1","1","0","0","0","0","0","0","0","0","0","asas");



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

INSERT INTO tb_materiale VALUES("9","1","Cemento","Prova","100","2","2014-10-09","uploads/commesse/1/materiali/","cappello.png","200");
INSERT INTO tb_materiale VALUES("10","1","a","a","12.12","3","2014-12-10","uploads/commesse/1/materiali/","","36.36");



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

INSERT INTO tb_mezzi VALUES("1","Clio","AA123EE","28000","2015-01-21","0","","0.00","IN_POSSESSO");
INSERT INTO tb_mezzi VALUES("2","Altro","11234","123","2015-01-09","0","","0.00","IN_POSSESSO");
INSERT INTO tb_mezzi VALUES("3","a","a","1","2015-01-20","11","","0.00","IN_POSSESSO");
INSERT INTO tb_mezzi VALUES("4","furgone","AA123DD","1234","2015-01-20","123454","","0.00","IN_POSSESSO");
INSERT INTO tb_mezzi VALUES("5","furgone 2","aaa","1234","2015-01-21","0","","0.00","IN_POSSESSO");
INSERT INTO tb_mezzi VALUES("6","qqq","qqqq","123","2015-01-23","0","","0.00","VENDUTO");
INSERT INTO tb_mezzi VALUES("7","www","www","123","2015-01-23","0","","0.00","VENDUTO");



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

INSERT INTO tb_noleggi VALUES("9","1","123","AUTO","100","FIAT","2014-10-08");



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

INSERT INTO tb_ordini VALUES("6","1","Ordine 1","uploads/commesse/1/ordini/","cappello.png");



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

INSERT INTO tb_ordini_commessa VALUES("12","1","12/01","prova commessa 1","Jetbit","");
INSERT INTO tb_ordini_commessa VALUES("13","1","12/01","prova commessa 1","K2","");
INSERT INTO tb_ordini_commessa VALUES("14","1","12/01","prova commessa 1","prova","");
INSERT INTO tb_ordini_commessa VALUES("15","1","12/01","prova commessa 1","dasd","admin");



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

INSERT INTO tb_polizza VALUES("2","1","Lorem ipsum","2014-10-08","2014-10-08","5000","uploads/commesse/1/polizze/","prova.pdf","SI");
INSERT INTO tb_polizza VALUES("3","1","Lorem ipsum","2014-10-08","2014-10-08","3000","uploads/commesse/1/polizze/","","NO");



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

INSERT INTO tb_presenze VALUES("1","5","2015-01-09","","6","","1","");



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

INSERT INTO tb_programmazione_cantiere VALUES("14","1","12/12","prova","12/12","prova","5 "," Mario Rossi","1","Clio","adasffasdf","2015-01-07","admin","1");
INSERT INTO tb_programmazione_cantiere VALUES("21","6","001","Casa_Della_Salute","12","21","5 ,8 "," Mario Rossi, Luca Liscio","1","Clio","2","2015-01-07","admin","12");
INSERT INTO tb_programmazione_cantiere VALUES("22","6","001","Casa_Della_Salute","2","Rasatura","5 ,6 "," Mario Rossi, Franco Bianchi","1","Clio","prova note","2015-01-07","admin","2");
INSERT INTO tb_programmazione_cantiere VALUES("23","6","001","Casa_Della_Salute","","","8 "," Luca Liscio","1","Clio","","2015-01-08","admin","0");
INSERT INTO tb_programmazione_cantiere VALUES("25","6","001","Casa_Della_Salute","","","5 ,7 "," Rossi Mario, Verdi Rocco","1","Clio","qqqq","2015-01-12","admin","0");
INSERT INTO tb_programmazione_cantiere VALUES("27","6","001","Casa_Della_Salute","","","6 ,10 "," Bianchi Franco, Ianni Maria","1","Clio","","2015-01-14","admin","-1");
INSERT INTO tb_programmazione_cantiere VALUES("28","4","123","prova commessa 2","","","6 ,11 "," Bianchi Franco, terzo prova terzo","2","Altro","aa","2015-01-12","admin","0");
INSERT INTO tb_programmazione_cantiere VALUES("34","6","001","Casa_Della_Salute","","","5 ,7 "," Rossi Mario, Verdi Rocco","1","Clio","qqqq","2015-01-21","admin","0");
INSERT INTO tb_programmazione_cantiere VALUES("35","4","123","prova commessa 2","","","6 ,11 "," Bianchi Franco, terzo prova terzo","2","Altro","aa","2015-01-21","admin","0");
INSERT INTO tb_programmazione_cantiere VALUES("44","1","12/01","prova commessa 1","","","5","Rossi Mario","4","furgone","","2015-01-22","admin","0");
INSERT INTO tb_programmazione_cantiere VALUES("45","1","12/01","prova commessa 1","","","5,7","Rossi Mario,Verdi Rocco","1","Clio","","2015-01-26","admin","0");
INSERT INTO tb_programmazione_cantiere VALUES("47","6","001","Casa_Della_Salute","","","11,5","terzo prova terzo,Rossi Mario","4","furgone","","2015-01-26","admin","0");
INSERT INTO tb_programmazione_cantiere VALUES("48","1","12/01","prova commessa 1","","","5,7","Rossi Mario,Verdi Rocco","1","Clio","","2015-01-27","admin","0");
INSERT INTO tb_programmazione_cantiere VALUES("49","6","001","Casa_Della_Salute","","","11,5","terzo prova terzo,Rossi Mario","4","furgone","","2015-01-27","admin","0");



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

INSERT INTO tb_ral VALUES("1","1","1","1111","uploads/commesse/1/ral/","","","2015-01-20","","admin");
INSERT INTO tb_ral VALUES("2","6","1","1","uploads/commesse/6/ral/","","","2015-02-04","1","admin");



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

INSERT INTO tb_regolarita VALUES("4","1","Lorem ipsum","2014-10-09","Ente x","cappello.png","uploads/commesse/1/regolarita/","2014-10-25");
INSERT INTO tb_regolarita VALUES("5","1","Lorem Ipsum","2014-10-07","Ente Y","","","2014-10-22");



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

INSERT INTO tb_riserve VALUES("10","1","prova riserva","2014-10-06","riserva dettagli","uploads/commesse/1/riserve/","cappello.png");



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

INSERT INTO tb_ruolino VALUES("8","","6","001","Casa_Della_Salute","",""," Mario Rossi, Franco Bianchi","6","Clio","","5-Mario Rossi","","0","","2015-01-08","admin","-1","verifica del massetto esistente (PAVIMENTAZIONI TERRAZZI scheda n. 02)","","-1","5 ,6 ","1","SERENO","cap");
INSERT INTO tb_ruolino VALUES("9","","1","12/01","","",""," Mario Rossi","5","","","5-Mario Rossi","","0","","2015-01-08","admin","-1","Preparazione del supporto","","-1","5 ","0","SERENO","cap");
INSERT INTO tb_ruolino VALUES("21","","1","12/01","prova commessa 1","",""," Rossi Mario","1","","","Rossi Mario","","","","2015-01-09","admin","1","verifica del massetto esistente (IMPERMEABILIZZAZIONI scheda n. 01)","","5","5 ","","SERENO","cap");
INSERT INTO tb_ruolino VALUES("34","","6","001","Casa_Della_Salute","","100"," Salvia Franca, Bianchi Franco, Verdi Rocco, terzo prova terzo","9","","","Rossi Mario,Bianchi Franco","","8","prova","2015-01-12","admin","-1","demolizione del pavimento esistente (PAVIMENTAZIONI TERRAZZI scheda n. 02)","","-1","9 ,6 ,7 ,11 ","","ok_ok_ok","fv");
INSERT INTO tb_ruolino VALUES("40","","6","001","Casa_Della_Salute","","qta"," Bianchi Franco, Ianni Maria","8","","","Bianchi Franco","","","prova note","2015-01-14","admin","-1","prova lavoro","","-1","6 ,10 ","","SERENO","cg");
INSERT INTO tb_ruolino VALUES("41","","6","001","Casa Della Salute","","qta"," Rossi Mario","6","","","Bianchi Franco","","","","2015-01-14","admin","-1","ppp","","-1","5 ","","SERENO","imp");
INSERT INTO tb_ruolino VALUES("42","","1","12/01","prova commessa 1","",""," Bianchi Franco, terzo prova terzo","6","","","Bianchi Franco","dfsfasd","8","","2015-01-20","admin","-1","adasdasd&#39;","","-1","6 ,11 ","","SERENO","cap");
INSERT INTO tb_ruolino VALUES("54","","1","12/01","prova commessa 1","","","Rossi Mario","8","","","5-Rossi Mario","","","","2015-01-22","admin","-1","ff","","-1","5","","SERENO","cap");
INSERT INTO tb_ruolino VALUES("55","","1","12/01","prova commessa 1","","","Rossi Mario","8","","","7-Verdi Rocco","","","","2015-01-23","admin","-1","sasas","","-1","5","","SERENO","cap");
INSERT INTO tb_ruolino VALUES("56","","1","12/01","prova commessa 1","","","Rossi Mario,Verdi Rocco","8","","","7-Verdi Rocco","","","","2015-01-26","admin","-1","asdasdasds","","-1","5,7","","SERENO","cap");
INSERT INTO tb_ruolino VALUES("57","","1","12/01","prova commessa 1","","","Rossi Mario","5","","","7-Verdi Rocco","","","","2015-01-26","admin","-1","fdsfd","","-1","5","","SERENO","cap");
INSERT INTO tb_ruolino VALUES("58","","1","12/01","prova commessa 1","","","Ianni Maria","8","","","10-Ianni Maria","","","","2015-01-28","admin","-1","asas","","-1","10","","SERENO","cap");
INSERT INTO tb_ruolino VALUES("61","","6","001","Casa_Della_Salute","","","Rossi Mario","8","","","5-Rossi Mario","","","","2015-02-04","admin","-1","fsdf","","-1","5","","asd_asd","cap");
INSERT INTO tb_ruolino VALUES("62","2015-02-06 19:27:05","1","12/01","prova commessa 1","","","Rossi Mario","8","","","5-Rossi Mario","gfdgdd","6","","2015-01-12","admin","-1","5-1-verifica del massetto esistente (IMPERMEABILIZZAZIONI scheda n. 01)","","-1","5","","ok_ok_ok_1","cap");
INSERT INTO tb_ruolino VALUES("63","2015-02-06 12:23:59","1","12/01","prova commessa 1","","","Rossi Mario","8","","","5-Rossi Mario","","","","2015-01-09","admin","-1","rrr","","-1","5","","non_SERENO","cap");



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

INSERT INTO tb_spese VALUES("1","1","Bollo","2014-10-01","2015-01-01","","","3200.00","1");
INSERT INTO tb_spese VALUES("2","1","aa","2015-01-20","2015-01-01","","","11.00","0");



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

INSERT INTO tb_tagliando VALUES("1","1","Olio","2014-10-01","1000.00","","22000","0","53cc26","25000");
INSERT INTO tb_tagliando VALUES("2","1","Freni","2015-01-21","123.00","","20000","0","16466e","29000");



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

INSERT INTO tb_tecnica VALUES("1","1","","SI","2015-02-06","","admin","dasddsad","","NUOVO","SEDE","","","","");



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

INSERT INTO tb_terzi VALUES("10","6","2015-01-14","aaa","aaa");
INSERT INTO tb_terzi VALUES("13","6","2015-01-14","bbbb","bbb");



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

INSERT INTO tb_testata_magazzino VALUES("1","Clio","1","1","prova commessa 1","2015-01-15","admin");
INSERT INTO tb_testata_magazzino VALUES("4","Clio","1","6","Casa_Della_Salute","2015-01-15","admin");
INSERT INTO tb_testata_magazzino VALUES("11","Altro","2","4","prova commessa 2","2015-01-15","admin");
INSERT INTO tb_testata_magazzino VALUES("12","Altro","2","1","prova commessa 1","2015-01-19","admin");
INSERT INTO tb_testata_magazzino VALUES("29","Clio","1","4","prova commessa 2","2015-01-22","admin");



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

INSERT INTO tb_users VALUES("32","admin","admin","ADMIN","prova@prova.it","amministratore","mario","rossi");
INSERT INTO tb_users VALUES("33","mezzo","mezzo","MEZZI","mezzo@m.it","mezzo","mezzo","mezzo");
INSERT INTO tb_users VALUES("34","commessa","commessa","ADMIN","commessa@m.it","commessa","commessa","commessa");
INSERT INTO tb_users VALUES("35","ruolino","ruolino","RUOLINO","ruolino@m.it","impiegato","ruolino","ruolino");
INSERT INTO tb_users VALUES("36","user","user","PERSONALE_RUOLINO","user@m.it","Impiegato","user","user");
INSERT INTO tb_users VALUES("39","prova","prova","ADMIN","prova@prova.it","prova","prova","prova");
INSERT INTO tb_users VALUES("40","mag","mag","MAGAZZINIERE","mag@mag.it","mag","mag","mag");



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

INSERT INTO tb_veicoli VALUES("1","6","1","Clio","","10","2015-01-12","");
INSERT INTO tb_veicoli VALUES("11","6","0","","","aaa","2015-01-14","");



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

INSERT INTO tb_verbali VALUES("11","1","Lorem Ipsum","2014-10-08","5.000","uploads/commesse/1/verbali/","prova.pdf");



