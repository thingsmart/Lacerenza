# SQL Manager for MySQL 5.3.1.7
# ---------------------------------------
# Host     : localhost
# Port     : 3306
# Database : ispe


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES latin1 */;

SET FOREIGN_KEY_CHECKS=0;

#
# Structure for the `tb_carrello` table : 
#

CREATE TABLE `tb_carrello` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_circuito1` INTEGER(11) DEFAULT NULL,
  `id_circuito2` INTEGER(11) DEFAULT NULL,
  `id_circuito3` INTEGER(11) DEFAULT NULL,
  `id_serie` INTEGER(11) DEFAULT NULL,
  `id_impianto` INTEGER(11) DEFAULT NULL,
  `da_data` DATE DEFAULT NULL,
  `a_data` DATE DEFAULT NULL,
  `id_utente` INTEGER(11) DEFAULT NULL,
  `prezzo` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  `data` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_ordine` INTEGER(11) DEFAULT NULL,
  `cliente` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `id_cliente` INTEGER(11) DEFAULT NULL,
  `id_utente_secondo` INTEGER(11) DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  UNIQUE INDEX `id_new_new` USING BTREE (`id`)
)ENGINE=InnoDB
AUTO_INCREMENT=1 AVG_ROW_LENGTH=16384 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_circuito1` table : 
#

CREATE TABLE `tb_circuito1` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `codice` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  `descrizione` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `note` VARCHAR(512) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  UNIQUE INDEX `id` USING BTREE (`id`)
)ENGINE=InnoDB
AUTO_INCREMENT=12 AVG_ROW_LENGTH=5461 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_circuito2` table : 
#

CREATE TABLE `tb_circuito2` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `codice` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  `descrizione` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `note` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `id_circuito1` INTEGER(11) DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  UNIQUE INDEX `id` USING BTREE (`id`),
   INDEX `id_circuito1` USING BTREE (`id_circuito1`),
  CONSTRAINT `tb_circuito2_fk1` FOREIGN KEY (`id_circuito1`) REFERENCES `tb_circuito1` (`id`) ON DELETE CASCADE
)ENGINE=InnoDB
AUTO_INCREMENT=16 AVG_ROW_LENGTH=5461 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_circuito3` table : 
#

CREATE TABLE `tb_circuito3` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_circuito1` INTEGER(11) DEFAULT NULL,
  `id_circuito2` INTEGER(11) DEFAULT NULL,
  `codice` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  `descrizione` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `note` VARCHAR(512) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  UNIQUE INDEX `id` USING BTREE (`id`),
   INDEX `id_circuito1` USING BTREE (`id_circuito1`),
   INDEX `id_circuito2` USING BTREE (`id_circuito2`),
  CONSTRAINT `tb_circuito3_fk1` FOREIGN KEY (`id_circuito1`) REFERENCES `tb_circuito1` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tb_circuito3_fk2` FOREIGN KEY (`id_circuito2`) REFERENCES `tb_circuito2` (`id`) ON DELETE CASCADE
)ENGINE=InnoDB
AUTO_INCREMENT=11 AVG_ROW_LENGTH=3276 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_clienti` table : 
#

CREATE TABLE `tb_clienti` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `cognome` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `note` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `ragione_sociale` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `partita_iva` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `email` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `telefono` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `ad_hoc` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `indirizzo` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  UNIQUE INDEX `id` USING BTREE (`id`)
)ENGINE=InnoDB
AUTO_INCREMENT=827 AVG_ROW_LENGTH=196 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_impianto` table : 
#

CREATE TABLE `tb_impianto` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_circuito1` INTEGER(11) DEFAULT NULL,
  `id_circuito2` INTEGER(11) DEFAULT NULL,
  `id_circuito3` INTEGER(11) DEFAULT NULL,
  `id_serie` INTEGER(11) DEFAULT NULL,
  `comune` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `tipo` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `formato` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `facce` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `ubicazione` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `note_ubicazione` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `cimasa` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `provenienza` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `cespite` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `note` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `proprieta` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `prezzo` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  `data_scadenza` DATE DEFAULT NULL,
  `stato` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data_inizio` DATE DEFAULT NULL,
  `link_immagine` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `addetto_manutenzione` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  UNIQUE INDEX `id` USING BTREE (`id`)
)ENGINE=InnoDB
AUTO_INCREMENT=63 AVG_ROW_LENGTH=910 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_note_carrello` table : 
#

CREATE TABLE `tb_note_carrello` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `tipologia` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `note` VARCHAR(512) COLLATE latin1_general_ci DEFAULT NULL,
  `id_utente` INTEGER(11) DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  UNIQUE INDEX `id` USING BTREE (`id`)
)ENGINE=InnoDB
AUTO_INCREMENT=1 AVG_ROW_LENGTH=8192 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_note_opzionato` table : 
#

CREATE TABLE `tb_note_opzionato` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `tipologia` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `note` VARCHAR(512) COLLATE latin1_general_ci DEFAULT NULL,
  `id_utente` INTEGER(11) DEFAULT NULL,
  `id_ordine` INTEGER(11) DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  UNIQUE INDEX `id_new` USING BTREE (`id`)
)ENGINE=InnoDB
AUTO_INCREMENT=1 AVG_ROW_LENGTH=5461 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_note_vendita` table : 
#

CREATE TABLE `tb_note_vendita` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `tipologia` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `note` VARCHAR(512) COLLATE latin1_general_ci DEFAULT NULL,
  `id_utente` INTEGER(11) DEFAULT NULL,
  `id_ordine` INTEGER(11) DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  UNIQUE INDEX `id` USING BTREE (`id`)
)ENGINE=InnoDB
AUTO_INCREMENT=1 AVG_ROW_LENGTH=5461 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_opzionato` table : 
#

CREATE TABLE `tb_opzionato` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_circuito1` INTEGER(11) DEFAULT NULL,
  `id_circuito2` INTEGER(11) DEFAULT NULL,
  `id_circuito3` INTEGER(11) DEFAULT NULL,
  `id_serie` INTEGER(11) DEFAULT NULL,
  `id_impianto` INTEGER(11) DEFAULT NULL,
  `da_data` DATE DEFAULT NULL,
  `a_data` DATE DEFAULT NULL,
  `cliente` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `id_utente` INTEGER(11) DEFAULT NULL,
  `id_cliente` INTEGER(11) DEFAULT NULL,
  `data_scadenza` DATE DEFAULT NULL,
  `prezzo` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  `id_ordine` INTEGER(11) DEFAULT NULL,
  `data` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY USING BTREE (`id`),
  UNIQUE INDEX `id_new` USING BTREE (`id`),
   INDEX `id_cliente` USING BTREE (`id_cliente`),
  CONSTRAINT `tb_opzionato_fk1` FOREIGN KEY (`id_cliente`) REFERENCES `tb_clienti` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
)ENGINE=InnoDB
AUTO_INCREMENT=39 AVG_ROW_LENGTH=16384 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_serie` table : 
#

CREATE TABLE `tb_serie` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_circuito1` INTEGER(11) DEFAULT NULL,
  `id_circuito2` INTEGER(11) DEFAULT NULL,
  `id_circuito3` INTEGER(11) DEFAULT NULL,
  `codice` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  `descrizione` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `note` VARCHAR(512) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  UNIQUE INDEX `id` USING BTREE (`id`),
   INDEX `id_circuito1` USING BTREE (`id_circuito1`),
   INDEX `id_circuito2` USING BTREE (`id_circuito2`),
   INDEX `id_circuito3` USING BTREE (`id_circuito3`),
  CONSTRAINT `tb_serie_fk1` FOREIGN KEY (`id_circuito1`) REFERENCES `tb_circuito1` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tb_serie_fk2` FOREIGN KEY (`id_circuito2`) REFERENCES `tb_circuito2` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tb_serie_fk3` FOREIGN KEY (`id_circuito3`) REFERENCES `tb_circuito3` (`id`) ON UPDATE CASCADE
)ENGINE=InnoDB
AUTO_INCREMENT=11 AVG_ROW_LENGTH=2048 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_uscite` table : 
#

CREATE TABLE `tb_uscite` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `da_data` DATE DEFAULT NULL,
  `a_data` DATE DEFAULT NULL,
  `note` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  UNIQUE INDEX `id` USING BTREE (`id`)
)ENGINE=InnoDB
AUTO_INCREMENT=11 AVG_ROW_LENGTH=2340 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_utenti` table : 
#

CREATE TABLE `tb_utenti` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `password` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `ruolo` VARCHAR(256) COLLATE latin1_general_ci DEFAULT 'USER',
  `nome` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `cognome` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  UNIQUE INDEX `id` USING BTREE (`id`),
  UNIQUE INDEX `username` USING BTREE (`username`)
)ENGINE=InnoDB
AUTO_INCREMENT=13 AVG_ROW_LENGTH=5461 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Structure for the `tb_venduto` table : 
#

CREATE TABLE `tb_venduto` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_circuito1` INTEGER(11) DEFAULT NULL,
  `id_circuito2` INTEGER(11) DEFAULT NULL,
  `id_circuito3` INTEGER(11) DEFAULT NULL,
  `id_serie` INTEGER(11) DEFAULT NULL,
  `id_impianto` INTEGER(11) DEFAULT NULL,
  `da_data` DATE DEFAULT NULL,
  `a_data` DATE DEFAULT NULL,
  `cliente` VARCHAR(256) COLLATE latin1_general_ci DEFAULT NULL,
  `id_cliente` INTEGER(11) DEFAULT NULL,
  `id_utente` INTEGER(11) DEFAULT NULL,
  `prezzo` VARCHAR(20) COLLATE latin1_general_ci DEFAULT NULL,
  `id_ordine` INTEGER(11) DEFAULT NULL,
  `data` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY USING BTREE (`id`),
  UNIQUE INDEX `id` USING BTREE (`id`),
   INDEX `id_cliente` USING BTREE (`id_cliente`),
  CONSTRAINT `tb_venduto_fk1` FOREIGN KEY (`id_cliente`) REFERENCES `tb_clienti` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
)ENGINE=InnoDB
AUTO_INCREMENT=188 AVG_ROW_LENGTH=963 CHARACTER SET 'latin1' COLLATE 'latin1_general_ci'
COMMENT=''
;

#
# Data for the `tb_circuito1` table  (LIMIT -496,500)
#

INSERT INTO `tb_circuito1` (`id`, `codice`, `descrizione`, `note`) VALUES

  (7,'1','Circuito 1 A',''),
  (10,'2','Circuito 1 B','prova note'),
  (11,'3','Circuito 1 C','');
COMMIT;

#
# Data for the `tb_circuito2` table  (LIMIT -496,500)
#

INSERT INTO `tb_circuito2` (`id`, `codice`, `descrizione`, `note`, `id_circuito1`) VALUES

  (13,'1','Circuito 2 A','prova note',NULL),
  (14,'2','Circuito 2 B','',7),
  (15,'34','Circuito 2 C','',10);
COMMIT;

#
# Data for the `tb_circuito3` table  (LIMIT -494,500)
#

INSERT INTO `tb_circuito3` (`id`, `id_circuito1`, `id_circuito2`, `codice`, `descrizione`, `note`) VALUES

  (6,7,14,'1','Circuito 3 A',''),
  (7,NULL,13,'2','Circuito 3 B',''),
  (8,NULL,NULL,'3','Circuito 3 C',''),
  (9,10,NULL,'4','Circuito 3 D',''),
  (10,7,NULL,'5','Circuito 3 E','');
COMMIT;

#
# Data for the `tb_clienti` table  (LIMIT 1,500)
#

INSERT INTO `tb_clienti` (`id`, `nome`, `cognome`, `note`, `ragione_sociale`, `partita_iva`, `email`, `telefono`, `ad_hoc`, `indirizzo`) VALUES

  (6,'Jetbit&#34;?&.&#34;&#34;&#34;&#34;&#34;&#34;-&#39;','Srls','','Jetbit','','','','',''),
  (7,'IPER','FUTURA','','IPER FUTURA','','','','',''),
  (8,'','','','K2','','','','',''),
  (9,'prova','prova','','Prova','','','','',''),
  (10,'a','a','','s','','prova2@a.it','','',''),
  (11,'aa1','aa1','aewew','aa1','aa1','prova@prova.it','aa1','aa1','111'),
  (12,'FIALS POTENZA','FIALS POTENZA','','s','','','','',''),
  (13,'SCA CITROEN SRL','SCA CITROEN SRL','','s','','','','',''),
  (14,'GIRALDI S.a.s. di Giraldi Federico & C.','GIRALDI S.a.s. di Giraldi Federico & C.','','GIRALDI S.a.s. di Giraldi Federico & C.','00254830763','federico.giraldi@gmail.com','0971 50050','','Complanari Costa della Gaveta - 85100 POTENZA'),
  (15,'Pace','Arredamenti','','PACE ARREDAMENTI S.a.s. di Pace Anna & C.','01099700765','info@pacearredamenti.it','097159200','','Viale del Basento, 7 - 85100 POTENZA'),
  (16,'AUTO R S.r.l.','AUTO R S.r.l.','','AUTO R S.r.l.','01688050762','','0971 53999','','Via del Gallitello, 97/99 - POTENZA(PZ) - 85100'),
  (20,'','','','ADV SERVICE di IACCARINI GIUSEPPE','5073460726','info@advservicebari.it','','ADV SERVICE','Via Paradiso, 33/H - MODUGNO(BA) - 70026'),
  (21,'','','','ASSOCIAZIONE PROVINCIALE ALLEVATORI','233580760','','971470000','APA','Via dell''Edilizia , sn - POTENZA(PZ) - 85100'),
  (22,'','','','GRUPPO CONSILIARE ALLEANZA PER L''ITALIA','','alessandro.singetta@regione.basilicata.it  gruppoapi@yahoo.it','971447225','API GRUPP CONS','P.le V. Verrastro, 6 - POTENZA(PZ) - 85100'),
  (23,'','','','ATA di LUIGI MANCINO & C. S.A.S.','1209800760','info@centroicaro.it  luigimancino@gmail.com   luigi@mancino.it  ','0971 420420','ATA','C.da Pantano - Pignola(PZ) - 85101'),
  (24,'','','','ATHENA SAS di Santangelo Carmine & c.','3546850656','','97576456','ATHENA SAS','Via Indipendenza, 32 - Atena Lucana(SA) - 84030'),
  (25,'','','','AUTOPRESTIGE S.r.l.','1684680760','info@prestigeauto.it','97237373','AUTO PRESTIGE','Via Roma, 229 - VENOSA(PZ) - 85029'),
  (26,'','','','AUTO R S.r.l.','1688050762','amministrazione@autor.volkswagengroup.it  commerciale@autor.volkswagengroup.it','0971 53999','AUTO R Srl','Via del Gallitello, 97/99 - POTENZA(PZ) - 85100'),
  (27,'','','','VESCE VINCENZO','1505200764','v.vesce@retebarclays.com v.vesce@alice.it','97126481','BARCLAYS','Via Roma, 35/A - POTENZA(PZ) - 85100'),
  (28,'','','','BASILE ARREDA S.r.l.','571370766','info@basilearreda.com  piero@basilearreda.com','0971 52064','BASILE ARREDA','Via del Gallitello, 70 - POTENZA(PZ) - 85100'),
  (29,'','','','C''ERA UNA VOLTA S.r.l.','1653750768','','971601217','C''ERA UNA VOLTA','C.da Valle Paradiso - POTENZA(PZ) - 85100'),
  (30,'','','','C.I.S.F. S.n.c.','1607920764','ivanafezzuoglio@virgilio.it','971601158','C.I.S.F. s.n.c.','Largo Sacra Famiglia di Nazareth, 2 - Potenza(PZ) - 85100'),
  (31,'','','','C.S.D. ALGHIERI SRL','1836410769','maurizio.gambardella@hotmail.it  potenza@nissolinocorsi.it','971594082','C.S.D. Alighier','VIALE DANTE, 158 - POTENZA(PZ) - 85100'),
  (32,'','','','CACHAREL di VALENTE CARMELA','1556450763','','0971 21731','CACHAREL','Via Portasalza, 31/35 - POTENZA(PZ) - 85100'),
  (33,'','','','CHEMIMETTO di TRIVIGNO FRANCESCA','1652040765','','97151875','CHEMIMETTO','Via Isca del Pioppo, 1 - POTENZA(PZ) - 85100'),
  (34,'','','','CHILI ADVERTISING DI SPORTIELLO GERARDO','265560763','chiliadv@virgilio.it','0972 236502','CHILI ADVERTIS','Via Venezia, 10 - Melfi(PZ) - 85025'),
  (35,'','','','COLUZZI OFFICE DESING di AMALIA COLUZZI','1536580762','','971441405','COLUZZI OFFICE','Via Parigi, 41 - POTENZA(PZ) - 85100'),
  (36,'','','','COMPAR S.p.a.','362520280','agiacometti@compar.it','0823 56137','COMPAR SPA','Via A. Volta, 6 - LIMENA(PD) - 35010'),
  (37,'','','','COMPUTER ASSISTANCE S.a.s.','1470290766','info@comp-assistance.it amministrazione@comp-assistance.it','0971 489973','COMPUTER ASSIST','I? Traversa via del Gallitello - POTENZA(PZ) - 85100'),
  (38,'','','','COMPUTER POINT DI VITTORIO ONORATO','1455980761','amministrazione@computerpointpotenza.com','0971 51588','COMPUTER POINT','Via Isca del Pioppo sn - Potenza(PZ) - 85100'),
  (39,'','','','KABLA SERVICE S.r.l.','1698510763','','','LA LOCANDA','C.da Rossellino, snc - POTENZA(PZ) - 85100'),
  (40,'','','','LG RESTAURANT S.A.S. DI LUIGI MANCINO','1851320760','mancinoluigi@hotmail.it','','LA LOCANDA 2','Via della Tecnica, snc - pOTENZA(PZ) - 85100'),
  (41,'','','','DARKO S.r.l.','4293950756','marco@darkosrl.it info@darkosrl.it','832261182','DARKO','VIA SAN MAURILIO, 3 - MILANO(MI) - 20123'),
  (42,'','','','DATCH STORE DI MASSIMO MORELLO','535690762','morellom1@massimomorello.191.it','','DATCH','Contrada S. Aloia - Tito Scalo(PZ) - 85050'),
  (43,'','','','DAVID ABBIGLIAMENTO DI FURONE DAVIDE','1704170768','davidefurone@hotmail.it','','DAVID ABBIGLI','Via Appia,208 - Potenza(PZ) - 85100'),
  (44,'','','','FUCCELLA PALMAROSA','1574500763','palmarosa.fuccella@virgilio.it','','FUCCELLA','Via Roma, 2 - Tito(PZ) - 85050'),
  (45,'','','','FUMETTO S.n.c. di P.L. LAMORGESE & C.','186370763','info@fumettolamorgese.com','971411278','FUMETTO SNC','Via Pretoria, 248 - POTENZA(PZ) - 85100'),
  (46,'','','','DE BONIS MARIA','1442950760','','','OVALE','Via di Giura, 205 - Potenza(PZ) - 85100'),
  (47,'','','','P&C COMUNICATION TELEFONIA E ACCESSORI','1711890762','pec.comunication@hotmail.it','','P&C COMUNICATI','Via del Gallitello, 89 - Potenza(PZ) - 85100'),
  (48,'','','','WORLDPHONE S.R.L.','1462350768','josedigrazia@me.com','0971 34626','WORLDPHONE S.R.','Via Pretoria, 150/152 - Potenza(PZ) - 85100'),
  (49,'','','','YO! di ALOISE ALESSIA','1821870761','yopotenza@live.it','','YO! ALOISE','Via Orazio Flacco, 13 - POTENZA(PZ) - 85100'),
  (50,'','','','YOLK & ASSOCIATI S.r.l.','6258820726','info@yolk.it','809904905','YOLK & ASSOCIAT','Via Calefati, 158 - BARI(BA) - 70122'),
  (51,'','','','STILE LIBERO S.R.L.','3942011218','stileliberopotenza@hotmail.it','817808963','STILE LIBERO','Via Giovanni De Matha, 37 - NAPOLI(NA) - 80143'),
  (52,'','','','STILE LIBERO S.R.L.','5858711210','francescafusco@stileliberoadv.it','8119708686','STILE LIBERO A.','Piazza Castello,1 - MILANO(MI) - 20121'),
  (53,'','','','DE GRAZIA G. & R. S.N.C.','861350767','','0971 52062','DE GRAZIA','Via del Gallitello,95 - Potenza(PZ) - 85100'),
  (54,'','','','DE PIERRO RAFFAELE','1768910760','','','DE PIERRO RAFFA','Via P. Grippo, 27/29 - POTENZA(PZ) - 85100'),
  (55,'','','','DE ROSA ROCCO','','derosarocco73@gmail.com','','DE ROSA ROCCO','VIA ANZIO, 33 - POTENZA(PZ) - 85100'),
  (56,'','','','MIBI FASHION SHOES','1507590766','','','MIBI','Via Pretoria,184 - Potenza(PZ) - 85100'),
  (57,'','','','MICROTEL DI DONATO ROMANO','1178810766','microtel2@gmail.com','0971 472456','MICROTEL','Via del Gallitello - Potenza(PZ) - 85100'),
  (58,'','','','MIGLIONICO & DELLA MONICA S.n.c.','1728030766','revisioni@miglionicoservice.it','0971 53930','MIGLIONICO DELL','Via Pasquale Grippo, 9/11 - POTENZA(PZ) - 85100'),
  (59,'','','','FAVILLE di CASTELLETTO ALDO','1600320764','','97155086','FAVILLE','Viale del Basento, snc - POTENZA(PZ) - 85100'),
  (60,'','','','FEEM SERVIZI S.R.L.','13336530152','claudia.richichi@feem.it','02 52036934','FEEM SERVIZI S.','C.so Magenta,63 - Milano(MI) - 20123'),
  (61,'','','','FV DISTRIBUZIONE  di  VINCENZO FEOLA','997890769','','','feola','VIA TOMMASO MORLINO, 85 - SANT''ANGELO DI AVIGLIANO(PZ) - 85020'),
  (62,'','','','MOTTA ARREDAMENTI S.a.s.','1581810767','mottaarredamenti@libero.it','0971 485097','MOTTA ARRED SAS','C.da Sant''Aloia - zona industriale - TITO(PZ) - 85050'),
  (63,'','','','MOTTA RACING di MOTTA LUCIANO','1363100767','','97157583','MOTTA RACING','Via Vaccaro, 71 - POTENZA(PZ) - 85100'),
  (64,'','','','MA.PS S.R.L.','1737340768','','','MOVIDA BAR','Via dell'' Edilizia, 25 Z. I. - Potenza(PZ) - 85100'),
  (65,'','','','MPA Movimento per le Autonomie di Basilicata','','','','MPA','Via Isca del Pioppo, snc - POTENZA(PZ) - 85100'),
  (66,'','','','ANAS S.p.a.','2133681003','','','ANAS','Via Nazario Sauro - POTENZA(PZ) - 85100'),
  (67,'','','','ANDROMEDA S.r.l.','1094990767','','971773867','ANDROMEDA','C.so Umberto I?, 19 - ACERENZA(PZ) - 85011'),
  (68,'','','','ASSOCIAZIONE ANGELS FOR CHILDREN','','ericasergiano@gmail.com','','ANGELS FOR CHIL','Via Baracca,85 - Potenza(PZ) - 85100'),
  (69,'','','','MOBILIFICIO FALEGNAMERIA DI CAIVANO FRANCESCO','111770764','mobilicaivano@virgilio.it','0971 991233','CAIVANO MOBILI','Via Portanova,71 - Picerno(PZ) - 85055'),
  (70,'','','','CAIVANO SERRAMENTI S.R.L.','1661300762','info@serramenticaivano.it','0971 995287','CAIVANO SERRAME','Ctr. Campo Di Donei snc - Picerno(PZ) - 85055'),
  (71,'','','','Avv. Raffaella Calciano Curatore del fallimento 1/98 R.F.','875860769','raffaella.calciano@tin.it','0971 48864','CALCIANO RAFFAE','Via M. Volini, 3 - CASTELMEZZANO(PZ) - 85010'),
  (72,'','','','ABBIGLIAMENTO CALICE DI CALICE ALBERTO','91220764','','971470042','CALICE','Via Pretoria, 38/40 - Potenza(PZ) - 85100'),
  (73,'','','','HOTEL RISTORANTE LO ZODIACO','1006800765','info@ristorantelozodiaco.net','971748142','LO ZODIACO RIST','Via Appia - OPPIDO LUCANO(PZ) - 85015'),
  (74,'','','','LOOK & LOOK di SCAVONE ELISA','1407990769','antonydiscavonelisa@alice.it','0971 651075','LOOK & LOOK','Via Sandro Pertini, 13 - TITO SCALO(PZ) - 85050'),
  (75,'','','','LOOK SYSTEM S.r.l.','3790610756','info@looksystem.net','0833 555951','LOOK SYSTEM','Via Mare, 346 - UGENTO(LE) - 73059'),
  (76,'','','','ZARRIELLO S.r.l.','514560762','michele@zarriello.it','971485156','ZARRIELLO SRL','C.da S. Loja, 71 - TITO SCALO(PZ) - 85050'),
  (77,'','','','ZOCCOLAN S.r.l.','1751970763','info@zoccolan.com','0971 50040','ZOCCOLAN SRL','C.da Costa della Gaveta, 48 - POTENZA(PZ) - 85100'),
  (78,'','','','ZOOFARMA DI BRIENZA GIOVANNI','237870761','annagiacummo@tiscali.it','','ZOOFARMA','Via dell''Edilizia, snc - Potenza(PZ) - 85100'),
  (79,'','','','EUROLA'' S.R.L.','1621950763','vincenzo.mancusi@email.it','0971 993093','Eurola'' S.R.L.','Via Appia Sud - Baragiano(PZ) - 85050'),
  (80,'','','','EUROPA 2006 S.r.l.','5528831216','','','EUROPA 2006','C.so Europa, 68/70 - NAPOLI(NA) - 80126'),
  (81,'','','','EUROPA CASH S.R.L.','1510490764','','','EUROPA CASH','C.da Bucaletto, 97A - Potenza(PZ) - 85100'),
  (82,'','','','EVENTI S.a.s. di VACCARO MARIA TERESA & C.','1675310765','','','EVENTI','P.zza Don Bosco, 15 - POTENZA(PZ) - 85100'),
  (83,'','','','PIXEL S.r.l.','1708920762','davide@pixel''srl.com','','PIXEL','Via Santa Caterina, 47 - POTENZA(PZ) - 85100'),
  (84,'','','','PIZZA HOUSE DI CORVINO ANTONIO','1308600764','antonellocorvino@alice.it','0971 36649','PIZZA HOUSE','Gradinata manhes,3/5 - Potenza(PZ) - 85100'),
  (85,'','','','INERTI CALCESTRUZZI S.r.l.','1605800760','','0971 485450','INERTI CALCESTR','C.da Macchia - TITO SCALO(PZ) - 85050'),
  (86,'','','','R2L  srl','1782470767','roccotortora@libero.it','','SAMANA''','VIA SAN VINCENZO DE PAOLI, 34 - POTENZA(PZ) - 85100'),
  (87,'','','','PRIMA VISIONE di SAMBATARO FRANCESCO','1592850760','sambataro.francesco@tiscali.it','','SAMBATARO','VIALE UNITA'' D''ITALIA, - POTENZA(PZ) - 85100'),
  (88,'','','','SAMINAILS S.r.l.','1860710761','lilianamartoccia@yahoo.it','','SAMINAILS','Via delle Mattine, 161 - POTENZA(PZ) - 85100'),
  (89,'','','','SANITASERVICE SOC. COOP.','1749950760','sanitaservice@virgilio.it','0971 443664','SANITASERVIcoop','Via Messina, 213 - POTENZA(PZ) - 85100'),
  (90,'','','','PAVESE & C. sas','884900762','faidate.potenza@bricofer.it','971594101',' BRICOFE PAVESE','VIA DELLA SIDERURGICA, 6 - POTENZA(PZ) - 85100'),
  (91,'','','','GIOIELLERIA 18 KARATI','934410762','gioielleria18kt@libero.it','97122870','18 KARATI','VIA ANGILLA VECCHIA, 113 - POTENZA(PZ) - 85100'),
  (92,'','','','GIOIELLERIA 18 KARATI di CERULLO GROUP S.R.L.','1702750769','gioielleria18kt@libero.it','97122870','18 KARATI SRL','VIA ANGILLA VECCHIA, 113 - POTENZA(PZ) - 85100'),
  (93,'','','','2PSERVICE S.R.L.','1783710765','2pservice@gigapec.it','0971 441557','2PSERVICE S.R..','Via Pienza,94 - Potenza(PZ) - 85100'),
  (94,'','','','AGENZIA LUCANA di SVILUPPO','627370778','posta@alsia.it','8352441','ALSIA','Viale Carlo Levi, sn - Matera(MT) - 75100'),
  (95,'','','','AMATI ANTONIO S.n.c. di Giuseppe & Valentino G. AMATI','651040776','giuamati@gmail.com','835758476','AMATI ANTONIO','Via S.S.N.7 Km 538 - GROTTOLE(PZ) - 75010'),
  (96,'','','','AMBIENTE Srls','1881730764','ambientepz@yahoo.it ambientepz@lamiapec.it','0971 650557','AMBIENTE','Via Anna Maria Ortense, 7 - POTENZA(PZ) - 85100'),
  (97,'','','','ASSOCIAZIONE CULTURALE  CENTRO RICERCHE','96044010765','mt.deluca@tiscali.it    info@nicolamanfredelli.it ','0975 381158','ASS. CULTURALE','L.go San Rocco,3 - Brienza(PZ) - 85050'),
  (98,'','','','ASSISERVICE S.R.L.','1693560763','','','ASSISERVICE','Via di Giura sn - Potenza(PZ) - 85100'),
  (99,'','','','ASSOAVVIM','1748640768','','','ASSOAVVIM','Via Isca del Pioppo, 29 - POTENZA(PZ) - 85100'),
  (100,'','','','AUTO ELITE S.r.l.','962090767','patrone@autoelite.it','97154577','AUTOELITE','Viale del Basento - POTENZA(PZ) - 85100'),
  (101,'','','','AUTOFFICINA DOLCE VINCENZO','182330761','autofficinadolce@tiscali.it','0971 58243','AUTOFFICINA DO','C/da Bucaletto, 61/C - Potenza(PZ) - 85100'),
  (102,'','','','AUTOSALA S.p.A.','4216480659','enricamaggioletti@autosala.com','','Autosala S.p.A.','Via Maglianiello, snc - Atena Lucana(SA) - 84030'),
  (103,'','','','BIGGIE BEST DI ALESSANDRA LAPOLLA','1494690769','alelapo@katamail.com','0971 445422','BIGGIE BEST','Viale Firenze,12 - Potenza(PZ) - 85100'),
  (104,'','','','BIOAGRITEST S.R.L.','1294330764','info@bioagritest.it','0971 421450','Bioagritest','Zona PIP lotto E2 - Pignola(PZ) - 85010'),
  (105,'','','','BISVA S.r.l.','1696880762','info@bisva.it','0971 794592','BISVA','Via Sotto il Calvario, 23 - TITO(PZ) - 85050'),
  (106,'','','','BLOOP S.r.l.','1805710769','','','BLOOP','Via del Gallitello, 221 - POTENZA(PZ) - 85100'),
  (107,'','','','CENTRO ICARO di LA TERZA VALERIO','1680510763','','971421949','CENTRO ICARO','C.da Pantano, sn - PIGNOLA(PZ) - 85010'),
  (108,'','','','CENTRO SERVIZI EDUCATIVI S.r.l.','1686320761','istitutiparitaripz@tiscali.it','0971 471066','CENTRO SER. EDU','Via Delle Querce - POTENZA(PZ) - 85100'),
  (109,'','','','OTTICA CENTRO VISIONE di Sergio Santagata','862110764','sergio.santagata@gmail.com','0971 411375','CENTRO VISIONE','via Torraca, 76 - POTENZA(PZ) - 85100'),
  (110,'','','','CERRONI GIUSEPPE','','','','CERRONI','VIA ROMA, 433 - TITO(PZ) - 85050'),
  (111,'','','','SUANNO 89  S.R.L.','1021810765','suannonicola@libero.it','973620120','CITY SPORT','C/da Galdo - Zona Ind.le F/4 - Lauria(PZ) - 85044'),
  (112,'','','','C.K. ASSOCIATI S.r.l.','','v.fonsa@ckassociati.it','971263105','CK ASSOCIATI','Via Sicilia, 67 - POTENZA(PZ) - 85100'),
  (113,'','','','CLAPS CARMEN','','','','CLAPS CARMEN','C.da Lavangone, 104/b - POTENZA(PZ) - 85100'),
  (114,'','','','COMUNITA'' MONTANA ALTO BASENTO','','','971499111','COMUN. MONTANA','Via Maestri del Lavoro, 19 - POTENZA(PZ) - 85100'),
  (115,'','','','COMUNE DI SATRIANO DI LUCANIA','135250769','','0975  383121','COMUNE DI SATI','P.zza Umberto - Potenza(PZ) - 85050'),
  (116,'','','','COPY V.D. DI VERRASTRO DONATO','1419150766','copyvd@yahoo.it','97146246','COPY V.D.','Viale dell'' AteneoLucano,2 - Potenza(PZ) - 85100'),
  (117,'','','','GIOCOLERIA di CORAZZI TERESA','1795440765','','','CORAZZI TERESA','Via Unit? d''Italia, 7 - POTENZA(PZ) - 85100'),
  (118,'','','','DE VIVO S.P.A.','545040768','michele.pergola@devivo.it','97157101','DE VIVO S.P.A.','Via dell''Edilizia, 18 - Potenza(PZ) - 85100'),
  (119,'','','','DOMENICO DE VIVO & C. S.r.l.','90080763','devivo.srl@devivo.it','97157101','DE VIVO SRL','Via della Chimica, 3/5/6 - POTENZA(PZ) - 85100'),
  (120,'','','','DI BELLO S.N.C.','1131080762','','0971 56633','DI BELLO','C/da santa loja  Zona Industriale - Tito Scalo(PZ) - 85050'),
  (121,'','','','FALEGNAMERIA DI BELLO ALFREDO','1314780766','','','DI BELLO ALFRED','C.da Cugno del Finocchio,12 - Potenza(PZ) - 85100'),
  (122,'','','','DI CHIARA NICOLA','','nicodichiara@inwind.it','','DI CHIARA NICOL','Viale Marconi, 197 - POTENZA(PZ) - 85100'),
  (123,'','','','E.F.A.B. S.R.L.','1335230767','informazioni@efab.it','0971 485348','E.F.A.B. S.R.L','Zona Industriale - TITO SCALO(PZ) - 85050'),
  (124,'','','','EB PARRUCCHIERI di EMANUELE BONELLI','1862540760','','','EB PARRUCCHIERI','Via Anna Maria Ortese,7 - Potenza(PZ) - 85100'),
  (125,'','','','ECO.GE.R. dI APRILE MADDALENA','1284470760','ecoger@libero.it','971274637','ECOGER','Via Cavour, 98 - POTENZA(PZ) - 85100'),
  (126,'','','','EDIL CERAMICHE GP di GIUSEPPE PERRONE','1540060769','','0975 383138','EDIL CERA. GP','Via S. Martino,59 - Satriano di Lucania(PZ) - 85050'),
  (127,'','','','EDITING S.R.L.','1701250761','info@mserviceweb.it','0971 27168','Editing','Via Torraca, 103 - Potenza(PZ) - 85100'),
  (128,'','','','ESERCIZIO FIERISTICO AUTONOMO BASILICATA S.r.l.','1637400761','amministrazione@efab.it','971485348','EFAB','Zona Industriale - TITO SCALO(PZ) - 85050'),
  (129,'','','','FURONE ENZO','1670380763','ff.style@yahoo.it','','ESPRIT','PIAZZA GIACOMO MATTEOTTI, 30 - POTENZA(PZ) - 85100'),
  (130,'','','','ESPRIT DISTRIBUTION S.R.L.','11922370157','marika.minadeo@esprit.com','','ESPRIT DISTRIBU','Via Moribondo,30 - Milano(MI) - 20143'),
  (131,'','','','ROBERTO GERARDA','1307850766','esteticadina@libero.it','0971 798082','ESTETICA DINA','Via Roma, 335 - TITO(PZ) - 85050'),
  (132,'','','','ESTETICA MANIA S.R.L.','1741140766','andreadebonis@hotmail.it','0971 1800255','ESTETICA MANIA','Via Oscar Romeo,5 - (PZ) - 85100'),
  (133,'','','','FIFTY FIFTY di MORELLO MASSIMO','535690762','morellom1@massimomorello.191.it','971476565','FIFTY FIFTY','Via Pretoria, 295 - POTENZA(PZ) - 85100'),
  (134,'','','','Filca Cisl Basilicata','','michele.latorre@cisl.it','0971 471417','Filca Cisl','Via degli Olmi 5/a - Potenza(PZ) - 85100'),
  (135,'','','','FRAMESI S.p.a.','729650960','eperego@framesi.it framesi@framesi.it','02 99040441','FRAMESI SPA','S.S. Dei Giovi, 135 - PADERNO DUGNANO(MI) - 20037'),
  (136,'','','','FRANCESE DAVIDE','4707310654','','','FRANCESE DAVIDE','Via Appia, 2/D - Potenza(PZ) - 85100'),
  (137,'','','','FRANCO VITO & C. S.n.c.','268570769','info@gruppofranco.com  amministrazione@gruppofranco.com','97164183','FRANCO VITO','Piano San Nicola di Pietragalla - PIETRAGALLA(PZ) - 85016'),
  (138,'','','','GALLERY di GIOVANNI FERRARA','1411660762','gallerygioielli.pz@alice.it','0971 442832','Gallery','Viale Firenze, 16 - Potenza(PZ) - 85100'),
  (139,'','','','GALLERY GIOIELLI S.r.l.','1820950762','gallerygioielli.pz@alice.it','0971 442832','GALLERY SRL','Viale Firenze, 16 - POTENZA(PZ) - 85100'),
  (140,'','','','GASPARRINI TERESA','1215890763','','','GASPARRINI TERE','Via Limiti, 45 - BARAGIANO(PZ) - 85050'),
  (141,'','','','GDA S.p.a. societ? unipersonale','1448340768','antonella.dimieri@ohspa.it','0975 3313488','GDA RETAIL SPA','Zona Industriale Loc. Sant''Antuono - POLLA(SA) - 84035'),
  (142,'','','','GET SERVICE S.a.s.','1339020768','info@getservice.it','971445816','GET SERVICE','Via Vienna, 34 - Potenza(PZ) - 85100'),
  (143,'','','','GFG PRODUCTION srl','10493061005','pps@hotmail.it esposito.rag@tiscali.it','','GFG PRODUCTION','Viale Trastevere, 230 - Roma(RO) - 00156'),
  (144,'','','','IGPDECAUX S.p.a.','893300152','teresa.marchetti@igpdecaux.it','02 654651 624981','IGPDECAUX','Centro Direzionale Milanofiori - ASSAGO(MI) - 20090'),
  (145,'','','','IKA & KIKA S.r.l.','1687850766','','97123320','IKA & KIKA','P.zza Matteotti, 16/17 - POTENZA(PZ) - 85100'),
  (146,'','','','IL BENESSERE QUOTIDIANO DI LOPIANO DANIELA A.','1878300761','ilbenesserequotidiano@gmail.com','','IL BENESSERE QU','Via Vienna, 8 - Potenza(PZ) - 85100'),
  (147,'','','','ASSOCIAZIONE CULTURALE IL CIGNO','','','','Il CIGNO','Frazione Stagliuozzo - Avigliano(PZ) - 85020'),
  (148,'','','','IMMAGINE DONNA ESTETICA SOLARIUM','1024580761','','97145637','IMMAGINE DONNA','Via Ciccotti, 11 - POTENZA(PZ) - 85100'),
  (149,'','','','IMMAGINE SPOSI S.n.c.','1036740767',' info@immaginesposiatelier.it','97163370','IMMAGINE SPOSI','C.da San Francesco, 1/A - TIERA DI POTENZA(PZ) - 85020'),
  (150,'','','','ASSOCIAZIONE IN VIAGGIO CON L''ARCA ONLUS','','','','IN VIAGGIO','Viale Marconi, 301 - POTENZA(PZ) - 85100'),
  (151,'','','','I.N.A.I.L. Direzione Regionale Basilicata','968951004','','971606639','INAIL','Viale V. Verrastro 3/c - Potenza(PZ) - 85100'),
  (152,'','','','IRIS S.a.s. di VALENTINA PAPANDREA & C','1616890768','i.iris@tiscali.it','0971 274375','IRIS S.A.S.','Via Torraca,37 - Potenza(PZ) - 85100'),
  (153,'','','','ISI SEMENTI S.p.a.','1691680340','','','ISI SEMENTI','Loc. Ponte Ghiara, 8/A - FIDENZA(PR) - 43036'),
  (154,'','','','KARISMA di PAGANO FRANCESCA','1675270761','','','KARISMA','Via Isca del Pioppo, 144 - POTENZA(PZ) - 85100'),
  (155,'','','','KEY SERVICE di AGOSTINO ROSA','1462010768','info@keyservicenet.net','','KEY SERVICE','Viale Marconi, 142 - POTENZA(PZ) - 85100'),
  (156,'','','','KLARIFIN DI TRIANI ANGELO & C. S.A.S.','1648450763','info@klarifin.it','0971 470960','klarifin','Via del Gallitello,113 - Potenza(PZ) - 85100'),
  (157,'','','','CENTRO KOS SRL','827050766','francesco.lisanti@centrokos.net','97152952','KOS','VIA DEGLI OLEANDRI, 7 - POTENZA(PZ) - 85100'),
  (158,'','','','LAURINO S.r.l.','1517850762','info@laurinosrl.it','97178518','LAURINO SRL','C.da Martiri, 2 - TITO(PZ) - 85050'),
  (159,'','','','LE SIRENE S.n.c.','1502820762','','97156319','LE SIRENE','Via dei Ligustri, 46 - POTENZA(PZ) - 85100'),
  (160,'','','','LUCANA SERVIZI s.a.s. di MARIO SARDONE','1356270767','m.sardone@lucanaservizi.com  info@lucanaservizi.com','971445855','LUCANA SERVIZI','Via Ancona, 19 - POTENZA(PZ) - 85100'),
  (161,'','','','UFFICIO INTERNAZIONALE LUCANI ALL''ESTERO','','rocco.romaniello@regione.basilicata.it','','LUCANI ESTERO','VIA VINCENZO VERRASTRO - POTENZA(PZ) - 85100'),
  (162,'','','','LUCANIA VENDING S.r.l.','1573800768','lucaniavendingsrl@gamil.com','0971 441882','LUCANIA VENDING','C.da botte, 129 - POTENZA(PZ) - 85100'),
  (163,'','','','LUCIA PAOLO','','','','LUCIA PAOLO','Via Vaccaro, 240 - POTENZA(PZ) - 85100'),
  (164,'','','','MARTORANO GEOM. DOMENICO S.r.l.','539190769','silvana.martorano@inpes.it','971485517','MARTORANO SRL','Zona Idustriale Tito Scalo - TITO SCALO(PZ) - 85050'),
  (165,'','','','MARTULLI S.n.c.','1365590767','','0971 442642','martulli','Via del Seminario Maggiore - Potenza(PZ) - 85100'),
  (166,'','','','MARZILIO GIUSEPPE','','gmarzilio@yahoo.it','328 0579275','MARZILIO GIUSEP','Via Strada Montagna, 18 - PICERNO(PZ) - 85055'),
  (167,'','','','MA.SA.LA. S.r.l.','1124310762','marilena@digrazia.org dgr.srl@inwind.it','0971 469465','MASALA','Via Angilla Vecchia, 91/93 - POTENZA(PZ) - 85100'),
  (168,'','','','MEM S.r.l.','1666910763','','','MEM SRL','Via E. Toti, 7 - POTENZA(PZ) - 85100'),
  (169,'','','','MERIDIANA LEGNAMI S.R.L.','1295600769','info@meridianalegnami.it','0971 485865','MERIDIANA LEGNA','Viale Stazione 138 - Brienza(PZ) - 85050'),
  (170,'','','','METAL GOMME SRL','266400761','metalgomme@gmail.com','97156034','METAL GOMME','C/DA CENTO MANI, 9 - POTENZA(PZ) - 85100'),
  (171,'','','','MOON LIGHT S.r.l.','1654940764','rossellagenzano@gmail.com','9711931457','MOON LIGHT SRL','C.da Baggiano, snc - VAGLIO DI BASILICATA(PZ) - 85010'),
  (172,'','','','MOTO CLUB ONLY TEAM ASD','1821670765','','','MOTO CLUB ONLY','Loc. Mazzo, 3 - Bella(PZ) - 85051'),
  (173,'','','','MOTOR FRANCE SRL','158540765','fabio.sarra@motorfrance.com','97154509','motor france','VIA DELL''EDILIZIA, 12 - POTENZA(PZ) - 85100'),
  (174,'','','','Motta Antonio Arredamenti','312590763','mottaarredamenti@libero.it','0971 485097','motta','Zona Industriale  Tito Scalo - Tito(PZ) - 85050'),
  (175,'','','','NOI BIMBI DI PASTORE CARMEN','1523250767','','0971 21632','NOI BIMBI','Via Angilla Vecchia,37/A - Potenza(PZ) - 85100'),
  (176,'','','','NOLE'' MARIO','1379800764','','97156444','NOLE'' MARIO','C.da Piani del Cardillo, 5 - POTENZA(PZ) - 85100'),
  (177,'','','','Olita Luigi & c. s.n.c.','861240760','','0971 52041','olita luigi','Via del Gallitello, 76 - Potenza(PZ) - 85100'),
  (178,'','','','OLIVIERO WEB di OLIVIERO MARIO','3843300652','','97159017','OLIVIERO WEB','Via Leonardo da Vinci, 20/A - POTENZA(PZ) - 85100'),
  (179,'','','','OMNIA SERVICE 2002 S.R.L.','1510470766','amverrastro@gmail.com','0971274806-1941390','OMNIA SERVICE 2','Via Roma, 33 - Potenza(PZ) - 85100'),
  (180,'','','','OSSERVATORIO PER L''AMBIENTE LUCANO','','osservatorio.opal@gmail.com','','OPAL','VIA DOMENICO DI GIURA, 217 - POTENZA(PZ) - 85100'),
  (181,'','','','ARREDAMENTI PAOLINI AUGUSTO','45270766','','975352122','PAOLINI ARREDA','Via Nazionale, 122 - Villa D''Agri(PZ) - 85050'),
  (182,'','','','PARCO 2000 S.r.l.','1545510768','studiobrusal@tiscali.it','0975 383494','PARCO 2000','Via G. Verdi,15 - Satriano(PZ) - 85050'),
  (183,'','','','PARCO DEI CIGNI S.n.c. di ROCCO GUARINO,','334180775','','835528985','PARCO DEI CIGNI','S.P. Fond. Bilioso c/da Siggiano,sn - TRICARICO(MT) - 75019'),
  (184,'','','','PELLART DI LAROCCA ROSARIO','862520764','pellart@tiscali.it','97122154','PELLART','Viale Marconi, 72 - Potenza(PZ) - 85100'),
  (185,'','','','PELLICCIA PASQUALE','','','','PELLICCIA PASQU','Via Ionio, 12 - POTENZA(PZ) - 85100'),
  (186,'','','','RISTORANTE PIZZERIA ROSEN GARDEN','1842750760','','','PELOSO FRANCESC','C.da Costa della Gaveta,24 - POTENZA(PZ) - 85100'),
  (187,'','','','Studio commerciale Dott.sa MARIA PERASOLE','1097610768','studio.perasolecolella@virgilio.it','0975 344032','PERASOLE MARIA','Via Municipio, 4 - MARSICO NUOVO(PZ) - 85052'),
  (188,'','','','RISTORANTE AL PIERROT','2568920652','alpierrot@libero.it','828997449','PIERROT','Via V. Lembo,32 - Bivio Palomonte(SA) - 84020'),
  (189,'','','','PIETRAFESA PASQUALE','1607620760','','0971 36918','PIETRAFESA','Via Pretoria,26 - Potenza(PZ) - 85100'),
  (190,'','','','PINNARO'' SERVICE di PINNARO'' ANTONIO','1374880761','antonio.pinnaro@gmail.com','0971 594306','PINNARO'' SERVIC','Via Tirreno, 61 - POTENZA(PZ) - 85100'),
  (191,'','','','PRIMO PIANO di CARRIERO TERESINA','1623340765','','97169483','PRIMO PIANO','Via Vaccaro, 200/202 - POTENZA(PZ) - 85100'),
  (192,'','','','COPERATIVA SOCIALE FILI D''ERBA','1740850761','potenza@privatassistenza.it','0971 470739','PRIVATA ASSISTE','Viale Dante Alighieri - Potenza(PZ) - 85100'),
  (193,'','','','PRO SYSTEM S.R.L.','1621390762','amministrazione.prosystem@gmail.com','0971 651293','PRO SYSTEM','Ctr. Molino Di Piede - Pignola(PZ) - 85010'),
  (194,'','','','PROCACCIO GROUP S.n.c.','4005760659','pubbliservice@procacciogroup.it','0975 396199','PROCACCIO GROUP','Via Mons A. Sacco, sn - SANT''ARSENIO(SA) - 84037'),
  (195,'','','','QUAGLIARELLA Dr. FRANCESCO','1650070764','','','QUAGLIARELLA DR','Via dei Ligustri, 20 - POTENZA(PZ) - 85100'),
  (196,'','','','QUALITA'' E RISPARMIO SOC. COOP.','1684540766','qualita.risparmio@alice.it','0971 411540','QUALITA''','VIA CARLO BO, 10 - POTENZA(PZ) - 85100'),
  (197,'','','','GIOIELLI G. Q. DI QUARATINO VINCENZO','1435890767','','0971 56660','QUARATINO','Viale Dante,25 - Potenza(PZ) - 85100'),
  (198,'','','','REGIONE BASILICATA','','d.pace@regione.basilicata.it','','REGIONE STAMPA','Via Vincenzo Verrastro, 4 - POTENZA(PZ) - 85100'),
  (199,'','','','REMAL S.R.L.','7154160639','','0971 443180','REMAL S.P.A.','Contrada Dragonara,2 - Potenza(PZ) - 85100'),
  (200,'','','','SANZA MOTORS S.r.l.','7263380631','sanzamot@hondaauto.it','971594039','SANZA MOTORS','Via del Gallitello, 98 - POTENZA(PZ) - 85100'),
  (201,'','','','On. ANGELO MARIA SANZA','','','','SANZA ON ANGELO','Via Vrandi Ulisse,3 - ROMA(RM) - 00197'),
  (202,'','','','SELENE S.R.L.','1523940763','selene.potenza@gmail.com','','SELENE','Viale del Basento - Potenza(PZ) - 85100'),
  (203,'','','','FANTASIA S.R.L.','2622170732','spezialesrl@libero.it','804306694','SEMERARO','Via Carlo Goldoni,24 - Martina Franca(TA) - 75015'),
  (204,'','','','SENISI SAVINO','1805610761','s.senisi@tiscali.it','0971 711413','SENISI','VIA GHERARD RHOLF - TITO SCALO(PZ) - 85050'),
  (205,'','','','STUDIO CINQUE ACTION S.r.l.','5764180724','valeria@studiocinque.it fabrizio@studiocinque.it','808985070','STUDIO CINQUE','Strada Vicinale Maccarone, C.P. 84 - POTENZA(PZ) - 85100'),
  (206,'','','','STUDIO EG di EMANUELE GIANNINI','1813850763','emanuelegiannini83@gmail.com','0971 1800107','STUDIO EG','Viale Dante, 96 - POTENZA(PZ) - 85100'),
  (207,'','','','STUDIO SPERA COMMERCIALISTI S.R.L.','1824190761','dott.nicolaspera@libero.it ','97137449','STUDIO SPERA','Via Rampa Prima Meriodionale,4 - Potenza(PZ) - 85100'),
  (208,'','','','TELESCA GERARDO','1069000766','telescag@tin.it','97146811','TELESCA GERARDO','Via Pierre De Coubertin, 4/8 - POTENZA(PZ) - 85100'),
  (209,'','','','TELESCA TRASLOCHI di DONATO TELESCA','536310766','rocco.telesca@live.it','','TELESCA TRASLO','C/da Torretta,11 - Potenza(PZ) - 85100'),
  (210,'','','','TELESCA VITTORIO','287760763','','0971 58145','TELESCA VITTORI','C/so Garibaldi, 86 E/F - Potenza(PZ) - 85100'),
  (211,'','','','TELIMA SUD S.R.L.','6571140968','','','TELIMA SUD','Via dei Martinitt,3 - Milano(MI) - 20146'),
  (212,'','','','TROTTA MARCO S.r.l.','1520730761','trottamarco@virgilio.it','971485309','TROTTA SRL','C.da Serra, 1 - POTENZA(PZ) - 85100'),
  (213,'','','','RISTORANTE DA TUCCIO DI GENOVESE LUCIANO','1676360769','luciano.genoves@gmail.com','','TUCCIO','Via Don Minzoni,131 - Avigliano(PZ) - 85021'),
  (214,'','','','VELUCCI ARREDAMENTI S.n.c.','863410767','','97157394','VELUCCI ARRED','Viale dell''Unicef - POTENZA(PZ) - 85100'),
  (215,'','','','VENDITALIA S.r.l.','1559470768','','','VENDITALIA','Via Mazzini, 108 - POTENZA(PZ) - 85100'),
  (216,'','','','FRANTOIO OLEARIO F.LLI PACE S.r.l.','719660763','info@oliopace.it  rocco.pace@oliopace.it','97168337','FRANTOIO PACE','C.da Piano San Nicola di Pietragall - PIETRAGALLA(PZ) - 85020'),
  (217,'','','','GEMELLI DIVERSI S.n.c.','1600520769','','','GEMELLI DIVERSI','Via S. Vincenzo De Paoli, 46 - POTENZA(PZ) - 85100'),
  (218,'','','','GEMIO STUDIO S.a.s. di STEFANIA IOSA','528170764','steiosa@tin.it','971594381','GEMIO STUDIO','V.le Marconi, 301 - POTENZA(PZ) - 85100'),
  (219,'','','','CONAD ADRIATICO','105820443','marina_formica@di-net.it','73570711','CONAD ADRIATICO','Via A. Manzoni, 14 - Monsampolo del Tronto(AP) - 63030'),
  (220,'','','','CONDOMINIO FABBRICATO AULETTA','','','','CONDOM. AULETTA','Via Mazzini, 85 - POTENZA(PZ) - 85100'),
  (221,'','','','CONFARTIGIANATO POTENZA','','','971411034','CONFARTIGIAN PZ','C.so 18 Agosto, 22 - POTENZA(PZ) - 85100'),
  (222,'','','','QUBICA S.r.l.','1710670769','coin.potenza@tiscali.it','0971 306959','CUBICA SRL','Via del Seminario Maggiore, snc - POTENZA(PZ) - 85100'),
  (223,'','','','TESSIVAL S.R.L.','3531470163','pierpaolo.conti@cycleband.com','','CYCLE BAND','Via Folzoni, 7 - Azzano S. Paolo(BG) - 24052'),
  (224,'','','','D''ANDREA ANTONIO','1292480769','autotecnica.dandrea@virgilio.it','0971 59050','D''ANDREA ANTONI','Via della Fisica, 28 - POTENZA(PZ) - 85100'),
  (225,'','','','DARDOX S.a.s. di FRANCESCO PERONE','1553070762','info@dardox.com','971629359','DARDOX','Zona Industriale - TITO(PZ) - 85050'),
  (226,'','','','DELTA INFORMATICA S.r.l.','1453710764','','0971 53104','DELTA INFORMAT','Via della Chimica, 41 - Potenza(PZ) - 85100'),
  (227,'','','','DELTA SERVIZI S.R.L.','1456090768','','971476608','DELTA SERVIZI','Via Ponte Nove Luci, 10 - Potenza(PZ) - 85100'),
  (228,'','','','VERI VIRGINIA CAFFE'' di DENOVELLIS MICHELE','1273050763','','','DENOVELLIS MICH','Via F. Baracca, 75/77 - POTENZA(PZ) - 85100'),
  (229,'','','','DESIGN INFISSI DI FABIO BRUNO','1844610764','designinfissi1@gmail.com','','DESIGN INFISSI','Via Palmanova, 21 - Potenza(PZ) - 85100'),
  (230,'','','','DISTRIBUZIONE TIPICA di A. PALADINO','1647760766','','97137447','DISTRIB. TIPICA','Via Caporella, 1bis - POTENZA(PZ) - 85100'),
  (231,'','','','DOC ARCHIVIAZIONE DOCUMENTALE S.N.C.','1319450761','rpugliese@doconline.it','0971 56244','DOC','C.da Centomani, 11 - Potenza(PZ) - 85100'),
  (232,'','','','EDILCENTER SABIA S.r.l.','207700766','amministrazione@sabiadesigncenter.com  acquisti@sabiadesigncenter.com','0971 68150-68016','EDILCENTER SABI','Zona Industriale Piano San Nicola - PIETRAGALLA(PZ) - 85020'),
  (233,'','','','EDILCERAMICHE S.R.L.','996780763','caterina.edilceramichegroup@yahoo.it','','EDILCERAMICHE','Via della Tecnica, 32 - Potenza(PZ) - 85100'),
  (234,'','','','EDIL CERAMICHE SANTARSIERO S.R.L.','1526280761','antonio@edilceramiche.net','0971 808686','EDILCERAMICHE P','S.P. 16/A - SCALERA(PZ) - 85020'),
  (235,'','','','EDILIZIA ARTIGIANA di VACCARO SANTOLO','1017220763','vaccaro.santolo@tiscali.it','97145410','EDILIZIA ARTIG.','C.da Serra di Pepe, 18 - RUOTI(PZ) - 85056'),
  (236,'','','','ELICAR PZ S.r.l.','1502190760','info@elicarpotenza.autogerma.it','971594355','ELICAR PZ SRL','C.da Varco d''Izzo, 18/d - POTENZA(PZ) - 85100'),
  (237,'','','','CALZATURIFICIO ELISABET S.r.l.','479970444','','','Elisabet','Viale I? Maggio, 35 - MONTE URANO(FM) - 63015'),
  (238,'','','','ELITARIA di GIULIO BRIENZA','1581930763','elitariapotenza@elitaria.com','0971 601243','ELITARIA','Via del Gallitello, 89 - POTENZA(PZ) - 85100'),
  (239,'','','','ELLIS ISLAND DI SALVIA CATERINA','1637320761','info@ellisisland.it','','ELLIS ISLAND','Sede Legale Via Giovanni XXIII, 37 - Potenza(PZ) - 85100'),
  (240,'','','','EURO-NET CENTRO EUROPE DIRECT','1375490768','euro-net@memex.it','97121124','EURO-NET','Vicolo Luigi Lavista, 3 - Potenza(PZ) - 85100'),
  (241,'','','','EUROBET ITALIA SRL','3620640106','','','EUROBET ITALIA','VIALE ALESSANDRO MARCHETTI, 105 - ROMA(RM) - 00148'),
  (242,'','','','EUROIMPIANTI di PIETRAFESA LEONARDO','1459680763','info.euroimpianti@alice.it','0971 45043','EUROIMPIANTI','Via Anzio, 38 - POTENZA(PZ) - 85100'),
  (243,'','','','FISHOUSE S.r.l.','1693450767','','','FISHOUSE SRL','C.da Acquabianca, sn - PIGNOLA(PZ) - 85010'),
  (244,'','','','FORUM REGIONALE DEI GIOVANI BASILICATA','','','','FORUM REGIONALE','Viale Marconi,180 - Potenza(PZ) - 85100'),
  (245,'','','','OFFICINA METALLICA E COSTRUZIONI EDILI','1492890767','','','FOSCOLO CAR SNC','Via Livorno, 11 - POTENZA(PZ) - 85100'),
  (246,'','','','MANCINO PIETRO','1542490766','fotomancino@fotomancino.it','97135505','FOTO MANCINO','Via Milano, 43 - POTENZA(PZ) - 85100'),
  (247,'','','','GM S.n.c. di COLONNESE M. & TELESCA G.','1628830760','justfirmepotenza@libero.it','971306963','GM SNC','Via A. Vecchia, 14 - POTENZA(PZ) - 85100'),
  (248,'','','','GMAX STORES DI CASTELLETTO ALDO','1782810764','gmaxstores@virgilio.it','0971 21356','GMAX STORES','Via Mantova,5 - potenza(PZ) - 85100'),
  (249,'','','','SUPERMERCATO IL GIRASOLE','871610762','','97157133','IL GIRASOLE','Via P. Grippo, 12/13 - Potenza(PZ) - 85100'),
  (250,'','','','IL GUARDAROBA S.R.L.','1801090760','ilguardaroba.pz@gmail.com','0971 181867','IL GUARDAROBA','Via Isca del Pioppo,94 - Potenza(PZ) - 85100'),
  (251,'','','','ARPA SISTEM S.n.c.','1854730767','','','IL GUSTO TRATTO','Via Isca del Pioppo, snc - POTENZA(PZ) - 85100'),
  (252,'','','','ASSOCIAZIONE IL MIO POTENZA','1764000764','vinlosa@tiscali.it','','IL MIO POTENZA','VIA PONTE NOVE LUCI - POTENZA(PZ) - 85100'),
  (253,'','','','INFORMATICA & SERVIZI S.R.L.','1583140767','info@info-servizi.com','0971 441886','INFORMATICA & S','Via A. Consolini,59 - Potenza(PZ) - 85100'),
  (254,'','','','INNFORM S.A.S.','1646910768','formazione@innform.eu','','INNFORM','Piazzale Bucarest, 18 - Potenza(PZ) - 85100'),
  (255,'','','','INNOTEC S.r.l.','1081160762','','','INNOTEC','Via Ponte Nove Luci, 16 - POTENZA(PZ) - 85100'),
  (256,'','','','IO AMO LA LUCANIA','','','','IO AMO LA LUCAA','VIA VINCENZO VERRASTRO - POTENZA(PZ) - 85100'),
  (257,'','','','IVOLUTION LAB DI FANELLI GIOVANNI','1679900769','www.ivolutionlab.com','0971 1932730','IVOLUTIO','Largo Santa Famiglia,2 - Potenza(PZ) - 85100'),
  (258,'','','','IVOLUTION LAB S.r.l.','1789620760','info@ivolutionlab.com','0971 56612','IVOLUTIONLABSRL','Largo Santa Famiglia, 2 - POTENZA(PZ) - 85100'),
  (259,'','','','LA CARTOTECNICA   S.R.L.','1689440764','LACARTOTECNICA@LACARTOTECNICA.IT  info@lacartotecnica.it','971476832','LA CARTOTECNIC','Viale del Basento,74 - Potenza(PZ) - 85100'),
  (260,'','','','LA FATTORIA SOTTO IL CIELO S.R.L.','1189620766','','0971 486000','LA FATTORIA SOT','C.da Petrucco, 9/A - Pignola(PZ) - 85010'),
  (261,'','','','LINEARTE S.N.C. DI CAMMAROTA R. R. & C.','1244440762','rosario.cammarota@linearte.it','971469127','LINEARTE S.N.C.','Piazza delle Regioni, 5 - Potenza(PZ) - 85100'),
  (262,'','','','PIETRAFESA ANTONIO','','antonio.pietrafesa@gdagroup.it','','LISCIO FANTASIA','Contrada Torretta, 41/A - Potenza(PZ) - 85100'),
  (263,'','','','RISTORANTE LO SFIZIO di ESPOSITO ANNA','1407830767','p.salvo87@gmail.com','0971 85176','LO SFIZIO RISTO','C.da Patacca, 61 - PIETRAGALLA(PZ) - 85020'),
  (264,'','','','LO SPUNTINO di PATUELLI STEFANIA','1407560760','marcello.marchetto@alice.it','','LO SPUNTINO','Viale del Basento, snc - POTENZA(PZ) - 85100'),
  (265,'','','','GIOIELLERIA MANZI di MANZI GERARDINA','1217780764','gioielleria.manzi@libero.it','0972 36651','MANZI GIOIELLER','Via Annunziata, 4 - VENOSA(PZ) - 85029'),
  (266,'','','','MARANO FRANCOLANDO','267150761','maranofr@tiscali.it','','MARANO','LARGO DE PILATO, 11 - POTENZA(PZ) - 85100'),
  (267,'','','','GLI ARGENTI DI MARCOPPIDO S.r.l.','1412960765','gliargentimarcoppido@interfree.it  donatomarcoppido@gmail.com','0971 53094','MARCOPPIDO','Via della Chimica, 61 - POTENZA(PZ) - 85100'),
  (268,'','','','SGR.UNO  S.r.l.','1638830768','sgr.uno@gmail.com','0971 773867','MASSERIA','Via Flavio Gioia, 21 - Salerno(SA) - 84121'),
  (269,'','','','MISTER GI S.r.l.','1646730760','marmanya@hotmail.it','97151778','MISTER GI SRL','Via Verderuolo Inferiore, 13 - POTENZA(PZ) - 85100'),
  (270,'','','','LAGUARDIA GIAMPIERO & C. S.a.s.','861640761','mobililaguardia@tiscali.it  info@mobililaguardia.it','0971 472259','MOBILI LAGURARD','C.da Costa della Gaveta, 5 - POTENZA(PZ) - 85100'),
  (271,'','','','MODEL DI GIUSEPPE MAGGIO','1243970769','info@modelstore.info','0971 26349','MODEL','Corso Garibaldi, 30 - Potenza(PZ) - 85100'),
  (272,'','','','MSD DESIGN di MARISA SANTOPIETRO','1506220761','info@msddesign.it','971445555','MSD DESING','Via Dragonara, 18 - POTENZA(PZ) - 85100'),
  (273,'','','','MULTICINEMA RANIERI S.r.l.','1638490761','multicinemaranieri@libero.it','','MULTICINEMARANI','Area Industriale di Tito - TITO(PZ) - 85050'),
  (274,'','','','MULTISERVICE  S.a.s.','1295710766','info@mserviceweb.it','97127168','MULTISERV. SAS','Via Sicilia, 5 - POTENZA(PZ) - 85100'),
  (275,'','','','MULTISISTEM S.n.c.','1643580762','multisistemsnc@tiscali.it','0971 470498','MULTISISTEM SNC','C.da Tiera di Vaglo - POTENZA(PZ) - 85100'),
  (276,'','','','NONSOLOSPORT di G. MECCA & C. S.n.c.','1115150763','','97156499','NONSOLOSPORT','Via del Gallitello, 97 - POTENZA(PZ) - 85100'),
  (277,'','','','PELLICCERIA NOZZOLILLO','1591760762','giuseppenozzolillo@tiscali.it','971411408','NOZZOLILLO PELL','Via Due Torri, 21 - POTENZA(PZ) - 85100'),
  (278,'','','','NUOVA PUBBLINEON S.n.c.','1750420760','publineondenicola@tiscali.it','0972 722040','NUOVA PUBBLINEO','Via dei Fucilai, 1 - RIONERO IN VULTURE(PZ) - 85028'),
  (279,'','','','ORME di COSTANZO CLAUDIO','1691480766','','','ORME','Via Lisbona, 45 - POTENZA(PZ) - 85100'),
  (280,'','','','ORTHOVIS DI MARIO GUIDO','1839630769','','','ORTHOVIS','Via Ciccotti - Potenza(PZ) - 85100'),
  (281,'','','','AZIENDA OSPEDALIERA REGIONALE SAN CARLO','1186830764','ugomaria.tassinari@ospedalesancarlo.it','971613199','OSPEDALESANCARL','Via Potito Petrone, sn - POTENZA(PZ) - 85100'),
  (282,'','','','PARTITO DEMOCRATICO DI BASILICATA','','','971444705','PARTIT DEMOCRAT','Piazza Emanuele Gianturco, 4 - POTENZA(PZ) - 85100'),
  (283,'','','','PASSARO SPOSA S.r.l.','2647700653','info@passarosposa.it  passarosposa@gmail.com','089 466318','PASSARO','Via Nigro, 10 - Cava dei tirreni(SA) - 84013'),
  (284,'','','','PAVESE GOMME S.A.S.','1305240762','achille.pavese@libero.it','0971 487555','PAVESE GOMME','Zona Ind. - Vaglio Basilicata(PZ) - 85010'),
  (285,'','','','P.E.S. S.r.l.','2044881007','amministrazione@pes.it  ima.bari@imaoutdoor.it','06 66181174','PES SRL','Via Cassia, 424 - ROMA(RM) - 00189'),
  (286,'','','','PESSOLANO S.R.L.','1651050765','info@pessolano.com','0971 56120','PESSOLANO S.R.L','Viale del Basento, 22/A - Potenza(PZ) - 85100'),
  (287,'','','','OLD FRIENDS NUOTO','1582080766','asdoldfriendsnuoto@gmail.com asdoldfriendsnuoto@pec.it  mario.giugliano@gmail.com','0971 995887','piscina','C/da Bosco tre Case, 16 - Picerno(PZ) - 85055'),
  (288,'','','','PITTELLA MAURZIO MARCELLO CLAUDIO','','','','PITTELLA MARCEL','Largo Plebiscito, 29 - LAURIA(PZ) - 85044'),
  (289,'','','','PIXAPIX Soc. Coop.','1784060764','info@pixapix.it','0971 1940384','PIXAPIX','Via Sanremo, 201 - POTENZA(PZ) - 85100'),
  (290,'','','','ISPE Srl','','','','PROVA',' - () - '),
  (291,'','','','PROVINCIA DI POTENZA','','','','PROVINCA POTENZ','P.zza Mario Pagano - POTENZA(PZ) - 85100'),
  (292,'','','','PUBBLIDEA di GIULIETTA MARROCCO','3691100758','pubblideataviano@libero.it','','PUBBLIDEATAVIAN','Via Tempesta, 22 - TAVIANO(LE) - 73057'),
  (293,'','','','PUBBLIPRESS S.r.l.','1631300769','dpmarketing@tiscali.it  lisanti@pubblipress.com','0971 469458','PUBBLIPRESS','C.da Rossellino, snc - POTENZA(PZ) - 85100'),
  (294,'','','','QUATTROESSE S.R.L.','1492930761','','971508055','QUATTRO ESSE','Via del Gallitello, 55 - Potenza(PZ) - 85100'),
  (295,'','','','PRICE POINT S.R.L.','1735700765','516.pickup.tito@gmail.com','','QUI DISCOUNT','Via Gherald Rohlfs,1 - Tito(PZ) - 85050'),
  (296,'','','','TABACCHERIA RAGO di RAGO FAZIO','1532590765','tabaccheriarago@hotmail.com','0971 442023','RAGO TABBACCHER','Viale Firenze, 62/64 - POTENZA(PZ) - 85100'),
  (297,'','','','RANIERI IMMOBILIARE S.r.l.','1334880760','fiatranieri@libero.it','0971 629411','RANIERI IMMOBIL','Area Industriale di Tito - TITO(PZ) - 85050'),
  (298,'','','','ASSOCIAZIONE SPORTIVA DILETTANTISTICA','96034590768','energy@memex.it','97125554','ROCKY CLUB','Corso Garibaldi,26 - Potenza(PZ) - 85100'),
  (299,'','','','COIFFEUR STUDIO DI ROMA ENZO','1048810764','','','ROMA ENZO','Via Adriatico,54 - Potenza(PZ) - 85100'),
  (300,'','','','ROMANO LUIGI Autocarrozzeria','1170050767','romanobond@hotmail.it','971471308','romano luigi','VIA DELL''EDILIZIA - POTENZA(PZ) - 85100'),
  (301,'','','','S.C.A. S.r.l.','137180766','sca@citroen.it donato.tolve@libero.it tolve.sca@citroen.it','97154515','SCA CITROEN','Via della Chimica, 1 - POTENZA(PZ) - 85100'),
  (302,'','','','SCAGLIONE LUIGI CARMINE','','luscagli@regione.basilicata.it','','SCAGLIONE LUIGI','Via delle Medeglie Olimpiche - POTENZA(PZ) - 85100'),
  (303,'','','','SCAI COMUNICAZIONE S.r.l.','1798270763','sonofranzese@gmail.com segreteria.scai@gmail.com','0971 46611','SCAI COMUN. SRL','Via Pantoni di Freda, 6 - POTENZA(PZ) - 85100'),
  (304,'','','','STECLA  STUDIO  S.n.c.','1075940765','','971469168','STECLA','Via  Palermo, 6 bis - Potenza(PZ) - 85100'),
  (305,'','','','SOCIETA'' TIPOGRAFICA EDITRICE SUD S.r.l.','94450764','stes@stes.it','971471700','STES','Via dell''Elettronica, 6/8 - POTENZA(PZ) - 85100'),
  (306,'','','','STILE & DESIGN S.R.L. S.','1850130764','gianvitolarotonda@libero.it','','STILE & DESIGN','Via Maratea, 11/12 - Atella(PZ) - 85020'),
  (307,'','','','SYSTEM OFFICE S.r.l. Unipersonale','1518260763','systemoffice@tiscali.it','97145720','SYSTEM OFFICE','1? Traversa via del Gallitello - POTENZA(PZ) - 85100'),
  (308,'','','','T & T S.r.l.','2533050643','taddeo@tetfinancial.it  g.taddeo@agente.findomestic.com','0971 292097','T & T Financial','Via del Gallitello, 93 - Potenza(PZ) - 85100'),
  (309,'','','','TAKE AWAY S.N.C. DI GALLO OMAR GIONATAN & C.','1212600769','','','TAKE AWAY','C/da Rossellino,39 - Potenza(PZ) - 85100'),
  (310,'','','','TGS S.r.l.','8571861007','danilo.dettoris@tgsconsulting.it','645444220','TGS SRL','Via Tiburtina, 652/A - ROMA(RM) - 00159'),
  (311,'','','','U.N.L.A. LAGOPESOLE','','','','UNLA','Via Leopardi, snc - LAGOPESOLE(PZ) - 85020'),
  (312,'','','','UOMINI E DONNE di DI FRANCO PASQUALE','1639260767','','0971 57386','UOMINI E DONNE','P.le Rizzo - Potenza(PZ) - 85100'),
  (313,'','','','GIACUMMO & VACCARO SRL','1592370769','','97124491','VACCARO','PIAZZALE ALDO MORO, 4/5 - POTENZA(PZ) - 85100'),
  (314,'','','','VILLA FIORENTINA DI GLIUBIZZI CLAUDIA','1419370760','','','VILLA FIORENTI','Via Serra,8 - Baragiano(PZ) - 85050'),
  (315,'','','','VIP CAR S.r.l.','1867140764','vipcarpz@gmail.com','0971 443309','VIP CAR','Via del Gallitello, 70 - POTENZA(PZ) - 85100'),
  (316,'','','','V.R. SERVICE S.r.l.','1745010767','vrpulizie@gmail.com','97151527','VR SERVICE','Piazzale Bucarest, 34 M - POTENZA(PZ) - 85100'),
  (317,'','','','WOODY GROOVE Associazione Culturale e Musicale','1885090769','woodygroove@gmail.com','','WOODY GROOVE','Via Parco Sant''Antonio LaMacchia,40 - POTENZA(PZ) - 85100'),
  (318,'','','','G.MEDIA SPECIALIST S.r.l.','7056260727','commerciale@gmediaspecialist.it','080 4169437','GMEDIA','Via San Vincenzo, 12/b - MONOPOLI(BA) - 70043'),
  (319,'','','','C.R. GORGA S.a.s. di CAGGIANESE ROSA & C.','1146710767','','0971 445644','GORGAONORANZEFU','Via Parma, 7 - POTENZA(PZ) - 85100'),
  (320,'','','','GR SALUMI S.R.L.','1068800760','','','GR SALUMI','C/da Serra n,13 - Picerno(PZ) - 85055'),
  (321,'','','','GRAFIGER S.a.s. di Elena Valvano & C.','1569960766','francescografiger@tiscali.it lucania.affari@tiscali.it','0971 86231','GRAFIGER','Piano San Nicola - PIETRAGALLA(PZ) - 85016'),
  (322,'','','','LU.SI.AN DI R. VALENTE & C. S.A.S.','1507720769','','0971 35236','LUSIAN','Via Pretoria,196-198 - Potenza(PZ) - 85100'),
  (323,'','','','MACONDO di D''EUGENIO DELIA','1464670767','','','MACONDO','Corso Vittorio Emanuele, 41 - Tolve(PZ) - 85017'),
  (324,'','','','MADE IN ITALY di MONICA PIETRAFESA','1871300768','madeinitaly.vitha@hotmail.it','','MADE IN ITALY','Via Vienna, 51 - POTENZA(PZ) - 85100'),
  (325,'','','','ARS DOMUS DI FABIO CORRADO','1446010769','','0971 274658','ARS DOMUS','Via O. Flacco,17 - Potenza(PZ) - 85100'),
  (326,'','','','ART PITT DI DI STASIO GIOVANNI','1701990762','','','ART PITT','Via Liguria,5 - Potenza(PZ) - 85100'),
  (327,'','','','ARTE TENDA S.n.c. di VINCENZO E MICHELE VESCE','1150690764','v.vesce@alice.it  v.vesce@retebarclays.com','0971 22902','ARTE TENDA','Via Mantova, 136/137 - POTENZA(PZ) - 85100'),
  (328,'','','','PUBBLIEFFE ITALIA di FERRANTE FELICE & c. SAS','3521410724','amministrazione@pubblieffeitalia.it','080 4554063','ferrante','VIA LA LENZA, 24 - Z.I. - CAPURSO(BA) - 70010'),
  (329,'','','','VINCENZO FERRARA','851350769','ferrara.stefano1@in','','FERRARA VINCEN','Via S. Lorenzo,4 - Bella(PZ) - 85051'),
  (330,'','','','MAVEN S.R.L.','4524240654','federica@fevian.it','0975 390695','FEVILU''','Viale Principessa Elena,93 - Caggiano(SA) - 84030'),
  (331,'','','','PUBBLITALIA76 DI LUPO GERARDO','4424260653','pubblitalia76@tiscali.it','','PUBBLITALIA76','Via Cotrazzo - Polla(SA) - 84035'),
  (332,'','','','PUBLICOM S.r.l.','1746710761','settimanalecontrosenso@gmail.com','0971 092255','PUBLICOM','Viale Marconi, 97 - POTENZA(PZ) - 85100'),
  (333,'','','','PICK UP S.P.A. - Sede leg.:85100 POTENZA','1157910769','','9753313453','PICK UP','Zona Industriale Loc. Sant''Antuono - POLLA(SA) - 84035'),
  (334,'','','','PRICE POINT S.N.C.','1220770760','516.pickup.tito@gmail.com','0971 651275','Pick Up Tito','Via S. Pertini,6 - Tito(PZ) - 85050'),
  (335,'','','','PIDUE SCAVONE G. & C. S.N.C.','982920761','','0971 57722','PIDUE','Via Nazario Sauro,34 - Potenza(PZ) - 85100'),
  (336,'','','','MCG SOC.COOP.','1784050765','','','MCG Soc.Coop.','Piazza dei Caduti, 6 - Vaglio di Basilicata(PZ) - 85010'),
  (337,'','','','AUTOSCUOLE DEL FUTURO S.A.S.','1734800764','','0971 783971','AUTOSCUOLE DEL','Via del Gallitello, 113 - Potenza(PZ) - 85100'),
  (338,'','','','D''ACUNTO VINCENZO','1197800764','vincenzodacunto@virgilio.it','0971 26415','AXA','Via del Gallitello,55 - Potenza(PZ) - 85100'),
  (339,'','','','AZZURRA S.R.L.','1518630767','','','AZZURRA','Zona Industriale - Tito Scalo(PZ) - 85050'),
  (340,'','','','BABA'' NAPOLI di FIORENTINO DONATA','1564790333','','','BAB'' NAPOLI','Via D. Di Giura, 219 - POTENZA(PZ) - 85100'),
  (341,'','','','M.G. GAMES S.R.L.','4875260657','jackpotpotenza@gmail.com','0971 57088','MG GAMES','C.so Garibaldi n. 16 - Salerno(SA) - 84123'),
  (342,'','','','M.G.F. S.r.l.','1964650715','direzione@mgfweb.it amministrazione@mgfweb.it','0881 549990','MGF S.r.l.','C.da Percettore, 7 - LUCERA(FG) - 71036'),
  (343,'','','','MCEVOLUTION GROUP SRL','','mcevolution@mcevolutiongroup.com  info@mcevo.it','','MCEVOLUTION','VIALE MARCONI, 301 - POTENZA(PZ) - 85100'),
  (344,'','','','POPOLARI UNITI','','','','POPOLARI UNITI','Via del Popolo, 64 - POTENZA(PZ) - 85100'),
  (345,'','','','Assoc. Cult. I PORTATORI DEL SANTO','','','','PORTATORI','Vico Riviezzi, 10 - POTENZA(PZ) - 85100'),
  (346,'','','','POSSIDENTE VITO','','vitopossidente@yahoo.it','','POSSIDENTE','via del Gallitello,89 - Potenza(PZ) - 85100'),
  (347,'','','','ASSOCIAZIONE POTENTIALMENTE ONLUS','','','','POTENTIALMENTE','Piazzale Praga, 2 - Potenza(PZ) - 85100'),
  (348,'','','','POTENZA ANTONIO','','','','POTENZA ANTONIO','Via Poggio Tre Galli, snc - POTENZA(PZ) - 85100'),
  (349,'','','','CENTRO MODA COMODA VALLEVERDE','1742140765','nicola.potenza@email.it','971411890','potenza nicola','VIA VACCARO, 10 - POTENZA(PZ) - 85100'),
  (350,'','','','ASS.NE CULT. MUSEO CIVICO DI ARTE','','elisalaraia@orfeohotel.com','','Museo civico','Corso Garibaldi,32 - Potenza(PZ) - 85100'),
  (351,'','','','MV COMUNICATIONE di MICHELE VENTRIGLIA','3486560612','mariannagalante@tin.it mvmicheleventriglia@alice.it','0823 799156','MV COMUNICATION','Via Rossini, 26 - CURTI(CE) - 81040'),
  (352,'','','','CENTRO LUDICO BELLI E RIBELLI','1681140768','bryanbrenda@alice.it','','BELLI E RIBELLI','V.le Marconi / Via N. Sauro - POTENZA(PZ) - 85100'),
  (353,'','','','BELVEDERE 2 S.r.l.','1608120760','','0971 23851','BELVEDERE 2','C.DA SERRA c/o PAPA CERAMICHE - TITO SCALO(PZ) - '),
  (354,'','','','BIAGIONE S.r.l.','1295820763','mondodibiagione@interfree.it','0971 651629','BIAGIONE SRL','Zona Industriale - TITO SCALO(PZ) - 85050'),
  (355,'','','','DESTEFANO SALVATORE & C. S.n.c.','862700762','amministrazione@destefanocostruttori.com','0971 471054','DESTEFANO SNC','Via del Basento, 244/A - POTENZA(PZ) - 85100'),
  (356,'','','','DETECTIVE AGENCY di SANTARSIERO VINCENZO','1511120766','info@svdetectiveagency.com','971306917','DETECTIVE AGENC','Via Lisbona, 4 - POTENZA(PZ) - 85100'),
  (357,'','','','GIACOMINO FAUSTINO','1588860765','','0971 487373','AGRITURISMO COS','C/da Csta del Monte,2 - Vaglio(PZ) - 85010'),
  (358,'','','','AIAS ONLUS POTENZA','','info@aiaspotenza.it','','AIAS ONLUS PO','Via Vincenzo Verrastro,2 - Potenza(PZ) - 85100'),
  (359,'','','','BASIL TOUR S.R.L.','876730763','','0971 480025','AL NORD','C.da Giuliano,6 - Potenza(PZ) - 85100'),
  (360,'','','','CENTOLA ANTONIO','1173400761','','','CENTOLA ANTO','Via Torraca,102 - Potenza(PZ) - 85100'),
  (361,'','','','CENTRO ACCESSORI S.r.l.','1697880761','centroaccessori@alice.it','0971 286349','CENTRO ACCESSO',' Zona P.I.P. C.da Serre - Tito Scalo(PZ) - 85050'),
  (362,'','','','FINDESIO SERVIZI FINANZIARI di Carleo Felice Antonio','1686510767','felice.carleo@findesio.it','0971 51461','FINDESIO','Via Giovanni XXIII, 3 - Potenza(PZ) - 85100'),
  (363,'','','','FINGAP SERVIZI FINANZIARI S.r.l.','1646460764','','971476493','FINGAP','Via del Gallitello, 153 - POTENZA(PZ) - 85100'),
  (364,'','','','FEDERAZIONE ITALIANA PALLACANESTRO','1382041000','','','FIP','Via Roma c/o complesso sportivo - POTENZA(PZ) - 85100'),
  (365,'','','','FIREFLY S.n.c. di Nicola Laguardia e Figli','816060768','fireflyaudio@tiscali.it','0971 52019','FIREFLY','Vico Asselta, 10 - POTENZA(PZ) - 85100'),
  (366,'','','','M.C.L. S.R.L.','898730767','','','MCL','P.zza M. Pagano, 20 - Potenza(PZ) - 85100'),
  (367,'','','','SOGES COMPUTER SNC','1177330766','info@sogescomputer.it','97135515','MECCA L','VIA RAVENNA,14 - POTENZA(PZ) - 85100'),
  (368,'','','','MECCA SILVANA','1667390767','','','MECCA SILVANA','Via G. Leopardi, 50 - AVIGLIANO(PZ) - 85021'),
  (369,'','','','MEDECAR S.R.L.','1095590764','daniela.fierro@medecar.it','0971 472300','MEDECAR','Via dell'' Edilizia,14 - Potenza(PZ) - 85100'),
  (370,'','','','CONSORZIO OPERATORI','4454960651','info.pontecagnano@maximall.it','089 381476','MAXIMALL','Via Pacinotti snc - Pontecagnano - Faiano(SA) - 84098'),
  (371,'','','','TOYS S.R.L.','3632130716','d.mazzeo@mazzeogiocattoli.it','','MAZZEO GIOCATTO','Via Foggia KM 1.500 - San Severo(FG) - 71016'),
  (372,'','','','MAMO''S JEANS & CO di MASSIMO MORELLO','535690762','morellom1@massimomorello.191.it','971601038','MAMO''S JEANS','Via del Gallitello (pal. Pomarico) - POTENZA(PZ) - 85100'),
  (373,'','','','GIOIELLERIA MANCINI DI MARCHISELLA VITO','1635940768','','0971 798761','MANCINI','Via Roma, 71 - Tito(PZ) - 85050'),
  (374,'','','','LA MACCHIA F. & B. SOC. COOP.','1839690763','coffeesnack2004@gmail.com','','LA MACCHIA','C.da Macchia, 21 - TITO SCALO(PZ) - 85050'),
  (375,'','','','LA MAISON DU CAFE'' sas','1882880766','','','LA MAISON','VIA DELLA FISICA SNC - POTENZA(IT) - 85100'),
  (376,'','','','LA PERLA Srl','1676020769','md888laperla@gmail.com','971651062','LA PERLA','VIA SAN VITO, 228/A - TITO(PZ) - 85050'),
  (377,'','','','LA RICOTTA ASSOCIAZIONE CULTURALE','1632770762','mario.ierace@tiscali.it','','LA RICOTTA','Vico Corrado,17 - Potenza(PZ) - 85100'),
  (378,'','','','STRAZIUSO BENIAMINO','','bstraziuso@alice.it','0971 650638','STRAZIUSO BENIA','C/so Garibaldi, 32 - Potenza(PZ) - 85100'),
  (379,'','','','STUDIO 2000 S.R.L.','1683160764','studio2000@studio2000.it','0971 1930584','STUDIO 2000','C.da Molino di Piede - Pignola(PZ) - 85010'),
  (380,'','','','Studio Legale Associato Chirico Itri','1199020650','tommaso.chirico@gmail.com','','STUDIO CHIRICO','C.so V. Emanuele n. 14 - Salerno(PZ) - 84123'),
  (381,'','','','PRO LOCO IL NIBBIO','','','971385330','IL NIBBIO PRO L','Via Roma, 22 - SASSO DI CASTALDA(PZ) - 85050'),
  (382,'','','','C.S.S. IL PONTE','','roccocasella@tiscali.it','','IL PONTE','Via Pretoria, 234 - POTENZA(PZ) - 85100'),
  (383,'','','','LAINO - DI GORGA S.A.S.','4419710654','','','IL POSTICINO','Via Isca del Pioppo, 33 - POTENZA(PZ) - 85100'),
  (384,'','','','RISTORANTE LA TARTARUGA','854820768','info@la-tartaruga.it','0971 774505','La Tartaruga','C/da Monte - Genzano di Lucania(PZ) - 85013'),
  (385,'','','','DR. INCORONATA LABELLA','1834470765','lab.incoronata@tiscali.it','349 4076496','Labella Incoro','C/da Canarra sn - Possidente(PZ) - 85020'),
  (386,'','','','LABOR S.R.L.','1796100764','laborsrl2013@gmail.com','','LABOR S.R.L.','Via Mazzini,1 - Potenza(PZ) - 85100'),
  (387,'','','','IMMOBILIARE LA CAVA S.A.S.','1584230765','','','LACAVA','C.da Martiri,2 - Tito(PZ) - 85050'),
  (388,'','','','EMMEUNO S.R.L.','6376081219','emmeuno@arubapec.it amministrazione@emmeunosrl.it','081 7625803','EMMEUNO S.R.L.','Via San Tommaso D''Aquino, 36 - NAPOLI(NA) - 80133'),
  (389,'','','','UNIVERSAL S.R.L.','3634540615','universalsrl2010@libero.it','815028716','EMO','Via Carlo Pisacane,23 - Aversa(CE) - 81031'),
  (390,'','','','FALLIMENTO N. 36/2005 TRIBUNALE DI POTENZA','929240760','linalaviola@yahoo.it','97136165','FALL. 36/2005','Via V. Verrastro, 3/l - POTENZA(PZ) - 85100'),
  (391,'','','','MONTENEGRO ARMANDO in Fallimento','69600765','dibisceglie.alberto@alice.it','971470212','FALL. MONTENEGR','Via Tirreno, 63 - POTENZA(PZ) - 85100'),
  (392,'','','','FALLIMENTO n. 20/2005 TRIBUNALE POTENZA','1053700769','rina.cosentino@tin.it','0971 471171','FALL202005','Via Rossini, 12 - POTENZA(PZ) - 85100'),
  (393,'','','','NEW GENERATION di MARILENA PIISTONE','1374510764','','0971 443394','NEW GENERATION','Via D. Di Giura, 19 - POTENZA(PZ) - 85100'),
  (394,'','','','NEW GRAFIC S.r.l.','1635310764','new.grafic@virgilio.it','0971 601014','NEW GRAFIC','C.da Poggio Cavallo, 84/B - Potenza(PZ) - 85100'),
  (395,'','','','SPIGHE LUCANE S.r.l.','1679030765','','0971 57979','SPIGHE LUCANE','Via Livorno, 54 - POTENZA(PZ) - 85100'),
  (396,'','','','ASSOCIAZIONE MUSICALE FRANCESCO STABILE','','','','STABILE','VIA LARGO DUOMO - POTENZA(PZ) - 85100'),
  (397,'','','','STAVOLA ANTONIO','2800210656','info@antoniostavola.it','97572595','STAVOLA ANTONIO','Via Ischia, 39 - SASSANO(SA) - 84038'),
  (398,'','','','BALSAMO FRANCESCO','1666500762','','0971 22428','BALSAMO FRANCES','Via Vaccaro, 27 - POTENZA(PZ) - 85100'),
  (399,'','','','BAR BIRRERIA AL SEGNO di LAURENZA ROCCO','1204590762','baralsegno@gmail.com','','BAR AL SEGNO','Via P. Grippo, 16/17/18 - POTENZA(PZ) - 85100'),
  (400,'','','','COMUNE DI BARAGIANO','','','0971 997074','BARAGIANO COMUN','Via Garibaldi, 17 - BARAGIANO(PZ) - 85050'),
  (401,'','','','NAVAZIO ALFONSO ERNESTO','','aenavazio@tiscali.it','','NAVAZIO','VIA S. SOFIA, 84 - MELFI(PZ) - 85025'),
  (402,'','','','NC EDIL PITTURAZIONI S.A.S.','1447080761','','','NC EDIL PITTUR','C/da Bucaletto sn - Potenza(PZ) - 85100'),
  (403,'','','','NESSUN LIMITE DI ROCCO D''ANDREA','1679930766','info@nessunlimite.it','','NESSUN LIMITE','Viale T. Morlino - S. Angelo di Avigliano(PZ) - 85020'),
  (404,'','','','NEW FORM A.R.L.','1793400761','info@newformpotenza.it','','NEW FORM','Via Isca del Pioppo snc - Potenza(PZ) - 85100'),
  (405,'','','','EVANGELISTA ALESSANDRA','1550060766','','971473006','BOUTIQUE EVANGE','Via F. Baracca,69 - Potenza(PZ) - 85100'),
  (406,'','','','AUTOBRINDISI SRL','1450970767','autobrindisi@tiscali.it','97157780','BRINDISI','VIA DELL''EDILIZIA, 1 - POTENZA(PZ) - 85100'),
  (407,'','','','BRUSCELLA ANGELO','','','','BRUSCELLA','Piazzale Sofia,26 - Potenza(PZ) - 85100'),
  (408,'','','','BS di BUONANSEGNA ANTONIO','1704420767','bsarredamento@alice.it','0971 420754','BS FALEGNAMERIA','C.da Villafranca, 2 - PIGNOLA(PZ) - 85010'),
  (409,'','','','PRONTO CUCINA di DONATO BUCHICCHIO','1864760762','prontocucina93@gmail.com','971650608','BUCHICCHIO D.','VIA DEL GALLITELLO, 93 - POTENZA(PZ) - 85100'),
  (410,'','','','C&F S.r.l.','1449270766','salvatore.cillis@cefonline.it','0971 410069','C&F S.R.L.','Corso Garibaldi,80 - Potenza(PZ) - 85100'),
  (411,'','','','FIALS','','info@fialspotenza.it','','Fials Potenza','Via Consolini, 33 - POTENZA(PZ) - 85100'),
  (412,'','','','FIERRO GAETANO','','','','fierro gaetano',' - POTENZA(PZ) - 85100'),
  (413,'','','','ENERGIA E SERVIZI  S.n.c.','1651610766','','097 121478','ENERGIA E SERVI','Via Mazzini, 100/102 - POTENZA(PZ) - 85100'),
  (414,'','','','ENGLISH LANGUAGE SERVICES S.a.S.','1493360760','elservices@tin.it','0971 45526','ENGLISH LANGUGE','Via Pierr De Coubertine, 4 - POTENZA(PZ) - 85100'),
  (415,'','','','D.R.I. S.r.l.','5100130656','dripricambi@hotmail.it','0971 58356','ERA ORA D.R.I','Via S. Giovanni, 48 - EBOLI(SA) - 84025'),
  (416,'','','','ERREDI DIFFUSION di ROCCO CANTORE & C. S.n.c.','1143300760','giannantoniocantore@yahoo.it','0971 36718','ERREDI DIFFUSIO','Via Bertazzoni, 44 - POTENZA(PZ) - 85100'),
  (417,'','','','BEAUTY CENTER della Dott.ssa','1226910659','antonio.maioli@ospedalesancarlo.it','0971 613557  osped','BEAUTY CENTER','Via Maratea, 35 - Potenza(PZ) - 85100'),
  (418,'','','','LOGUERCIO CANIO PARRUCCHIERE','1129310767','beauty.line@hotmail.it','0971 775787','BEAUTY LINE','Via Filippetti de Marinis, 51 - Genzano di Lucania(PZ) - 85013'),
  (419,'','','','BECCE NICOLA','','n.becce@tiscali.it','971443463','becce nicola','VIA PARIGI, 42 - POTENZA(PZ) - 85100'),
  (420,'','','','FALEGNAMERIA DI TANGREDA ROCCO','1243840764','','','TANGREDA ROCCO','Contrada Porco Morto - Picerno(PZ) - 85055'),
  (421,'','','','TANISA S.r.l.','8482781005','info@ifatelier.it','670453927','TANISA S.R.L.','Viale G. Cesare,95 - Roma(RM) - 00195'),
  (422,'','','','SALBINI GIUSEPPE','','','','SALBINI GIUSEPP','Via Genova, 20 - POTENZA(PZ) - 85100'),
  (423,'','','','SALUMI EMMEDUE S.R.L.','892500760','','0971 995850','SALUMI EMMEDUE','C.da Serralta,19 - Picerno(PZ) - 85055'),
  (424,'','','','SVILUPPO IMPRESA S.R.L.','1650330762','sviluppimpresa@gmail.com','328 9177192','SVILUPPO IMPRE','Via del Seminario Maggiore, 39 - Potenza(PZ) - 85100'),
  (425,'','','','G. A. DI COLANGELO GIUSEPPE','1685430769','gico1973@virgilio.it','','G.A.','C/da Faloppa,35/c - Potenza(PZ) - 85100'),
  (426,'','','','G MOTORS di GALASSO PIETRANTONIO','1790850760','galassopiero@yahoo.it','971601063','galasso','VIA DEL GALLITELLO, 86 - POTENZA(PZ) - 85100'),
  (427,'','','','PANIFICIO LE SPIGHE S.R.L.','1655020764','panificio.lespighe@gmail.com','0971 444980','LE SPIGHE','Via di Giura,79/B - Potenza(PZ) - 85100'),
  (428,'','','','LEGNARREDO di GLISCI LORENZO','1338840760','legnarredo@live.it','0971 487206','legnarredo','Zona Industriale di Vaglio Basilica - Vaglio Basilicata(PZ) - 85010'),
  (429,'','','','TOTALERG S.p.a.','90780768','','0971 471188','LEPRINI','Viale del Basento - POTENZA(PZ) - 85100'),
  (430,'','','','SAPIS S.R.L.','755240769','','0971 21960','SAPIS','Via 2 Torri,5 - Potenza(PZ) - 85100'),
  (431,'','','','SARLI S.r.l.','1344370760','info@sarlisrl.com','971594803','SARLI SRL','Via dell''Edilizia, 3 - POTENZA(PZ) - 85100'),
  (432,'','','','Dott. MAURIZIO SATURNO','17798885','alicesat@libero.it','','SATURNO MAURIZO','Via Livorno, 131 - POTENZA(PZ) - 85100'),
  (433,'','','','PACE ARREDAMENTI S.A.S di PACE ANNA & C.','1099700765','info@pacearredamenti.it','97159200','PACE ARREDAMENT','Viale del Basento, 7 - Potenza(PZ) - 85100'),
  (434,'','','','CARROZZERIA PACE di PACE DANIELE','1678730761','','','PACE CARROZZERI','Via della Tecnica,sn - POTENZA(PZ) - 85100'),
  (435,'','','','PADULA LUIGI','','lupadula@tin.it','0971 275905','PADULA LUIGI','Via Mazzini, 23/E - POTENZA(PZ) - 85100'),
  (436,'','','','VENERE COOPERATIVA SOCIALE  A r.l.','3486000718','venerecooperativapz@interfree.it','97126366','VENERE','Via Ciccotti, 44 - Potenza(PZ) - 85100'),
  (437,'','','','GIOV. VENNERI & C. S.r.l.','1037640768','vendite@venneri.it','0971 472210','VENNERI','Via della Fisica,26 - Potenza(PZ) - 85100'),
  (438,'','','','VENTUM S.R.L.','1630940763','gennaro@claps.mobi','','VENTUM SRL','Via del Gallitello, 84 - Potenza(PZ) - 85100'),
  (439,'','','','SOC. COOP. AGRICOLA VERDI FATTORIE','1288780768','info@verdifattorie@libero.it','0971 993348','VERDI FATTORIE','Via Appia, 47 - BARAGIANO(PZ) - 85050'),
  (440,'','','','ASSOCIAZIONE OPERA','1281210763','gennarotrit@gmail.com','','OPERA','VIA EUGENIO MONTALE, 62 - MELFI(PZ) - 85025'),
  (441,'','','','COMUNE DI OPPIDO LUCANO','531090769','antonietta.fidanza@gmail.com comuneoppidolucano.protocollo@pec.it','971945002','OPPIDO L.','VIA BARI, 16 - OPPIDO LUCANO(PZ) - 85015'),
  (442,'','','','OPTICAL CENTRE S.R.L.','1532410766','opticalcentre@live.it','97134453','optical centre','VIA VACCARO, 13 - POTENZA(PZ) - 85100'),
  (443,'','','','ORANGE CAFE'' SAS DI MARZIA SANDRO & C.','1734910761','marita.2008@alice.it','','ORANGE CAFE''','Viale Firenze,30 - Potenza(PZ) - 85100'),
  (444,'','','','TRATTORIA TRIMINIEDD S.R.L.','805860764','triminiedd@libero.it','0971 55746','TRATTORIA TRIM','C/da Bucaletto snc - Potenza(PZ) - 85100'),
  (445,'','','','FARMACIA TREROTOLA CARLO','450010764','farmaciatrerotola@email.it','0971 472839','TREROTOLA','Via Nitti Francesco Saverio - (PZ) - 85100'),
  (446,'','','','TROTTA DISTRIBUZIONE S.R.L.','4439130651','info@trottasrl.it','828370408','TROTTA DISTRIB','Via Trasimeno,2 - Battipaglia(PZ) - 84091'),
  (447,'','','','3 EFFE ARREDAMENTI  DI FARAONE ROCCO','1517760763','','0971 993185','3 EFFE','Via Dogana - Baragiano(PZ) - 85050'),
  (448,'','','','A.V.S. di FIORE MASSIMO &  C.','1374410767','avs.produzione@tiscali.it','971485857','A.V.S.','Zona ind.le Tito Scalo - Tito(PZ) - 85050'),
  (449,'','','','IPA GROUP  S.r.l.','1513260768','antiovino@virgilio.it','0971 21645','IPA GROUP','Via Orazio Flacco, 1 - Potenza(PZ) - 85100'),
  (450,'','','','IREFORR SOCIETA'' COOPERATIVA','810170761','com@ireforr.it  seg@ireforr.it','0971 51737','IREFORR','VIA DELLA TECNICA, 24 - Potenza(PZ) - 85100'),
  (451,'','','','IRIDIA SOC. COOP','1802200764','contact@iridiasoci.com','9711746137','IRIDIA','VIA DEL GALLITELLO, 105 - POTENZA(PZ) - 85100'),
  (452,'','','','CENTRO STUDI DIDATTICO di GALASSO ROCCO','1644700765','','','CSD','Via San Vincenzo De Paoli, 36 - POTENZA(PZ) - 85100'),
  (453,'','','','CENTRO SCOLASTICO EUROPEO S.R.L.','1454320761','itcmarconipz@virgilio.it','971594082','CSE','VIA ROSSELLINO - POTENZA(PZ) - 85100'),
  (454,'','','','BELLETA'' di PRINCIPALE LAURA','1782830762','belleta@tiscali.it','971292039','BELL''ETA''','VIA UNITA'' D''ITALIA, 21 - POTENZA(PZ) - 85100'),
  (455,'','','','GRUPPO CONSILIARE POPOLARI UNITI','127040764','gruppo.popolariuniti@comune.potenza.it','971415072','pop.uni.com.pz.','PIAZZA MATTEOTTI - POTENZA(PZ) - 85100'),
  (456,'','','','GRUPPO CONSILIARE REGIONALE POPOLARI UNITI','','','','popolari regio','VIA VINCENZO VERRASTRO, 6 - POTENZA(PZ) - 85100'),
  (457,'','','','DE LALLA LOREDANA','1144770763','','0971 21277','Prima Classe','Via Caporella, 8/d - Potenza(PZ) - 85100'),
  (458,'','','','LIDIANA S.r.l.','1736550763','studio@ligrani.191.it','971472127','Primigi store','Via Appia, 184 - Potenza(PZ) - 85100'),
  (459,'','','','LO SPUNTINO di MORLINO C. & C. s.r.l.s.','1834230763','claudiomorlino@hotmail.it','0971 45076','LO SPUNTINO MOR','Via dei Molinari, 63/C - POTENZA(PZ) - 85100'),
  (460,'','','','IMPRESA TURLIONE S.r.l.','1693720763','','0971 443193','TURLIONE','Via Domenico Di Giura, 155 - POTENZA(PZ) - 85100'),
  (461,'','','','TUTTOAPOSTO S.r.l.','1652640762','labellaannalisa@yahoo.it','0971 274345','TUTTOAPOSTO','Via Mazzini, 19 - POTENZA(PZ) - 85100'),
  (462,'','','','TWIN BAR s.n.c. di IUZZOLINO PASQUALE e IUZZOLINO GIUSEPPE','4641310653','iuzzolino.pasquale@hotmail.it','0971 1800609','TWIN BAR','Viale Marconi, 297/299 - POTENZA(PZ) - 85100'),
  (463,'','','','PAGINE SETTE DI MICHELA AZZARINO','1777830769','paginasette@gmail.it','0971 421388','PAGINA SETTE','Via Aldo Moro, 24/b - Pignola(PZ) - 85010'),
  (464,'','','','PALAM S.r.l.','1878480761','palamsrl@gigapec.it palermovincenzo@hotmail.it','','PALAM SRL','C.da Serra Ciciniello, 24/A - POTENZA(PZ) - 85100'),
  (465,'','','','ARTIGIAN ARREDO S.N.C.','798530762','art.arr@artigianarredo.it','0971 25115','ARTIGIAN','Via Mantova, 164 - Potenza(PZ) - 85100'),
  (466,'','','','ARVAUTO S.n.c. di SALVATO ROCCO & C.','223620766','amministrazione@arvauto.it','0971 56806','ARVAUTO','Viale del Basento, 238 - POTENZA(PZ) - 85100'),
  (467,'','','','ASD INVICTA','1685740761','invictapotenza@gmail.com','','ASD INVICTA','Via Mazzini, 1 - POTENZA(PZ) - 85100'),
  (468,'','','','DI GRAZIA S.P.A.','1209470762','presidenza@digrazia.org giovanna@digrazia.org','0971 594284','DI GRAZIA SPA','VIA APPIA , 98 - POTENZA(PZ) - 85100'),
  (469,'','','','DI.COM. s.r.l.','1538440767','di.com@virgilio.it','97136204','Di mare','Via Mantova, 112/113 - POTENZA(PZ) - 85100'),
  (470,'','','','O. S. Italia Soc. Coop. a r.l.','1190620763','','97121184','O.S. Italia','Frazione Giardiniera Inferiore - Avigliano(PZ) - 85020'),
  (471,'','','','OFFICENTER S.a.s. di FISCARELLI MICHELE','1367130760','potenzamarconi@optimamutui.it','971601322','OFFICENTER SAS','V.le Marconi, 117 - POTENZA(PZ) - 85100'),
  (472,'','','','OLIMPIA TEL S.R.L.','1799040769','pz3store@hotmail.it','','OLIMPIA TEL','Via del Gallitello, 116/O - Potenza(PZ) - 85100'),
  (473,'','','','COLORI DI TOLLENS BRAVO S.r.l. Socio Unico','6822520968','daniela.carriera@coloriditollensbravo.it','02 3912271','Colori di toll','Via Nino Bixio, 47/49 - Novate Milanese(MI) - 20026'),
  (474,'','','','COLUCCI DOMENICO','1584730764','mimmocolucci@alice.it','','COLUCCI DOMENI','Piazzale Budapest, 9 - Potenza(PZ) - 85100'),
  (475,'','','','CALZATURE COLUZZI TERESA','913130761','','','COLUZZI','Via Pretoria,80 - Potenza(PZ) - 85100'),
  (476,'','','','MARIO & JIVA STUDIO HAIRDRESSERS','528510761','mariojivahair@gmail.com','971411911','MARIO & JIVA','Via Zara, 40/52 - POTENZA(PZ) - 85100'),
  (477,'','','','MARLEN WHITE BOUTIQUE','577410764','lidia84.paggi@gmail.com','0971 1652051','MARLEN','VIA DEL GALLITELLO, 89 - POTENZA(PZ) - 85100'),
  (478,'','','','CARNEVALE SERGIO','','','','CARNEVALE SERGI','Via delle Medaglie Olimpiche, 14 - POTENZA(PZ) - 85100'),
  (479,'','','','CAROLA S.R.L.','1783770769','','0971 485429','CAROLA S.R.L.','Contrada S. Aloja - Tito Scalo(PZ) - 85050'),
  (480,'','','','CASALMOTORS S.R.L.','3482630658','amministrazione@gruppocasale.it antonella.camardo@gruppocasale.it','0975 21466','Casalmotor srl','Via S.M. Misericordia, 68 - Sala Consilina(SA) - 84036'),
  (481,'','','','CAR CENTER di DE STEFANO GAETANO ROSARIO','1826060764','gadeno@libero.it','0971 53648','CAR CENTER','V.le Marconi, 178/a - POTENZA(PZ) - 85100'),
  (482,'','','','CAR ONE S.R.L.','4708750650','antonella.camardo@gruppocasale.it amministrazione@gruppocasale.it','','CAR ONE S.R.L.','Via S.M. Misericordia, 68 - (SA) - 84036'),
  (483,'','','','AZIENDA AGRICOLA CARBONE CARLO MARIA','301820767','carbonegiuseppe81@tiscali.it','0971 487050','CARBONE','C/da Prati,28 - Vaglio(PZ) - 85010'),
  (484,'','','','MOLLICA GIUSEPPE','','giuseppe.mollica@provinciapotenza.it','','MOLLICA G','VIA SAN CARLO, 10 - MONTEMURRO(PZ) - 85053'),
  (485,'','','','MONDO ELETTRONICO S.R.L.S.','1888800768','info@mondoelettronico.com','0971 443149','MONDO ELETTRONO','Via del Gallitello, snc - Potenza(PZ) - 85100'),
  (486,'','','','Edilizia Monteverde Soc. Coop.','1862530761','coop.monteverde@virgilio.it','','MONTEVERDE','Via Mantova n. 160 - Potenza(PZ) - 85100'),
  (487,'','','','DI TOLVE E LABELLA S.N.C.','1003050760','','97181820','MOON FLOWERS','Via G. Fortunato,40 - Avigliano(PZ) - 85021'),
  (488,'','','','A.P.T. BASILICATA','','info@aptbasilicata.it  romaniello@aptbasilicata.it  protocollo@pec.aptbasilicata.it','0971 507611','APT','Via del Gallitello, 89 - POTENZA(PZ) - 85100'),
  (489,'','','','ARCHE ENTE PER LA FORMAZIONE ED IL MANAGEMENT','1312310764','amministrazione@e-sintesi.it','0971 51651','ARCHE''','Discesa San Gerardo,180 - Potenza(PZ) - 85100'),
  (490,'','','','I-CELL DI FEDOTA ANNA','1794730760','','','I-CELL','Via del Galitello,89 - Potenza(PZ) - 85100'),
  (491,'','','','MISS VESTO di CAPALBI ELISA','1689200762','ecelisa@email.it','0971 306965','MISS VESTO','Via Pierre de Coubertin,4 - Potenza(PZ) - 85100'),
  (492,'','','','PATO CAFFE'' DI PASQUALE RINALDI','1765850761','patocaffe@alice.it','','MILLEUNACIALDE','C/da S. A. La Macchia - Potenza(PZ) - 85100'),
  (493,'','','','MILLIONAIRE S.A.S. DI LAURINO MICHELE & C.','1840090763','millionaire.miki@hotmail.it','','MILLIONAIRE','Via Giovanni Gronchi,8 - Tito(PZ) - 85050'),
  (494,'','','','SPADARO MICHELE','','spadarom70@gmail.com','','SPADARO MICHELE','Via Ciccotti, 36/c - POTENZA(PZ) - 85100'),
  (495,'','','','MGM PNEUMATICI di RENDINA GIUSEPPE','1639070760','giuseppe.rendina87@gmail.com','97136930','RENDINA','VIALE DANTE, 34/36 - POTENZA(PZ) - 85100'),
  (496,'','','','RENFA S.R.L.','1858570763','enzodellamonica@gmail.com','','RENFA S.R.L.','Via Sandro Pertini, snc - Tito(PZ) - 85050'),
  (497,'','','','RESTAINO DOMENICO','1373180767','','0971 55250','RESTAINO DOMENI','Zona Industriale - TITO SCALO(PZ) - 85050'),
  (498,'','','','OTTICA LEONE di LEONE PIERLUIGI','832260764','','','OTTICA LEONE','Via del Gallitello,183 - Potenza(PZ) - 85100'),
  (499,'','','','OTTICA LEONE GLAMOUR S.r.l.','1844530764','','0971 442778','OTTICALEONEGLAM','Via del Gallitello, 183 - POTENZA(PZ) - 85100'),
  (500,'','','','ZAMBELLA ANGELO POMPEO','','','','ZAMBELLA','Via Oberdan,3 - Barile(PZ) - 85022'),
  (501,'','','','DANCOS S.R.L.','1758920761','','','FRATELLI LA BU','D.sa San Gerardo, 144 - Potenza(PZ) - 85100'),
  (502,'','','','MATERIST S.r.l.','1219090774','','','FRATELLI LA MT','Via Einaudi n. 73 - Matera(MT) - 75100'),
  (503,'','','','FREE GLUTEN di SALVATORE PIRRONE','1815210768','','','FREE GLUTEN','Via Appia, 208 - POTENZA(PZ) - 85100'),
  (504,'','','','SALUMIFICIO DELLA LUCANIA S.R.L.','841170764','','','SALUMIFICIO DE','Via Gramsci,127 - Picerno(PZ) - 85055'),
  (505,'','','','COIFFEUR SALVIA GIANNA','1434930762','','0971 794670','SALVIA GIANNA','Via Roma, 85 - TITO(PZ) - 85050'),
  (506,'','','','BLU COMMUNICATION srl','1418740765','blucommunication@libero.it','0972 237770','BLU COMM','VIA ALDO MORO snc - MELFI(PZ) - 85025'),
  (507,'','','','BLUMEGA DI ADAMO DE LUCA','1537400762','','','BLUMEGA','Viale dell''Unicef - Potenza(PZ) - 85100'),
  (508,'','','','BONSERA MARIA','','','','BONSERA MARIA','Pazzale Budapest,24 - Potenza(PZ) - 85100');
COMMIT;

#
# Data for the `tb_clienti` table  (LIMIT 319,500)
#

INSERT INTO `tb_clienti` (`id`, `nome`, `cognome`, `note`, `ragione_sociale`, `partita_iva`, `email`, `telefono`, `ad_hoc`, `indirizzo`) VALUES

  (509,'','','','BOUGANVILLE HOTEL di TRIUNFO CARMELA & C. S.a.s.','1271560763','info@hotelbouganville.it direzione@hotelbouganville.it elena.leonzio@hotelbouganville.it','0971 991084','BOUGANVILLE','Strada Provinciale 83 - PICERNO(PZ) - 85055'),
  (510,'','','','LA BOTTEGA DELLA CARNE S.R.L.','1671450763','','','ABBATE','C/da Rifoggio,2 - Albano(PZ) - 85010'),
  (511,'','','','A B C SPORT S.R.L.','967150764','info@abcsport.it','0971 55112','ABC SPORT','Via F. Baracca, 36/46 - Potenza(PZ) - 85100'),
  (512,'','','','ACME SOC. COOP. SOCIALE','1776460766','labottegadeifolletti.pz@gmail.com','','ACME','Via Del Seminario Maggiore,115 - Potenza(PZ) - 85100'),
  (513,'','','','L''ANGOLO PUBBLICITARIO S.r.l.','1627980764','angolopubblicitario@gmail.com','971601366','L''ANGOLO PUBBLI','C.da Santa Loja - TITO SCALO(PZ) - 85050'),
  (514,'','','','L''ARTE BIANCA di ROCCO DI BELLO','1238710766','lartebianca@alice.it','0971 57155','L''ARTE BIANCA','Viale Marconi, 171 - POTENZA(PZ) - 85100'),
  (515,'','','','L.A. BROKERS S.P.A.','3754700718','angelo.triani@gruppola.it','65923118','L.A. BROKERS','Via del Popolo Fiorito,27 - Roma(RM) - 00141'),
  (516,'','','','GRECO MARIA ROSARIA','1683940769','','0971 306927','METTIMI GIU','Via del Gallitello, sn - Potenza(PZ) - 85100'),
  (517,'','','','METTIMI GIU DI GRECO LUCIA','1836300762','mettimigiupotenza@virgilio.it','','METTIMI GIU 2','Via del Gallitello, 86 - Potenza(PZ) - 85100'),
  (518,'','','','GIOIELLI GINO S.R.L.','1718060765','angela.latorraca@libero.it','','LATORRACA','Via Provinciale,30 - Villa D''Agri(PZ) - 85050'),
  (519,'','','','ATELIER GIUNONE DEA SPOSA di BASILE MARIAGRAZIA','1803970761','giunonedeasposa@virgilio.it','','GIUNONE BASILE','Via D. Di Giura, 231 - POTENZA(PZ) - 85100'),
  (520,'','','','GIUNONE DEA SPOSA di Perillo Francesco','1526510761','frank.perillo@tiscali.it','0971 650505','GIUNONE SPOSA','Via D. Di Giura, 231 - POTENZA(PZ) - 85100'),
  (521,'','','','COSE DI TEATRO E MUSICA S.r.l.','1452220765','mariacarlucci@cosediteatroemusica.com','971410358','COSE DI TEATRO','C.so 18 Agosto, 2 - POTENZA(PZ) - 85100'),
  (522,'','','','COSIMO FOTO PRODUCTION di STASSANO COSIMO','2734580653','cosimofoto@gmail.com','','COSIMO FOTO','VIA NAZIONALE ,79 - QUADRIVIO DI CAMPAGNA(SA) - 84020'),
  (523,'','','','COSIMOPHOTO REPORTER SRLS','1870740766','cosimofoto@gmail.com','','COSIMOPHOTO','VIA PRETORIA, 260 - POTENZA(PZ) - 85100'),
  (524,'','','','ASSOCIAZIONE CULTURALE IL RACCONTO','','','','IL RACCONTO','P.zza Santa Maria Maggiore, sn - ALBANO DI LUCANIA(PZ) - 85010'),
  (525,'','','','IL SATELLITE S.R.L.','1033550763','','0971 441171','IL SATELLITE','Via dell''Edilizia,10 - Potenza(PZ) - 85100'),
  (526,'','','','SCAI COMUNICAZIONE di MICHELE FRANZESE','1552230763','info@scaicomunicazione.com','97146611','SCAI COMUNICAZI','C.da Riofreddo, snc - POTENZA(PZ) - 85100'),
  (527,'','','','SCAVONE NICOLA','786890764','','971594320','SCAVONE NICOLA','Viale Marconi, 341 - POTENZA(PZ) - 85100'),
  (528,'','','','SUD''ALTRO ass. cult.','1691470767','sergioc@sudaltro.com  sergio.carnevale@alice.it','97135841','SUD''ALTRO','Via Pretoria, 262 - POTENZA(PZ) - 85100'),
  (529,'','','','SUD''ALTRO CONSULTING S.R.L.','1774880767','sergio.carnevale@alice.it  sergioc@sudaltro.com','97135841','sud''altro cons','Via Sanremo, 42 - POTENZA(PZ) - 85100'),
  (530,'','','','SURGEL di GIOVANNI ATANESE','1684390766','','0971 411540','surgel','Via Carlo B?, 12 - Potenza(PZ) - 85100'),
  (531,'','','','SOC. COOP. SVAGO & DIVERTIMENTO Arl','1739470761','ristorante@pietradelsale.it','','SVAGO&DIVERTIME','Via Orto Botanico, snc - LAGOPESOLE(PZ) - 85020'),
  (532,'','','','PROFUMI DI FIORI di LOVALLO MICHELE','1516520762','','','PROFUMI DI FIOR','P.le Aldo Moro, 1/bis - POTENZA(PZ) - 85100'),
  (533,'','','','BLU BAR S.A.S. DI TOLVE GIUSEPPE & C.','1880450760','','','BLU BAR S.A.S.','Viale dell'' Unicef snc - Potenza(PZ) - 85100'),
  (534,'','','','CIGNARALE MICHELE','1696980760','m.cignarale@gmail.com','','CIGNARALE','Via Consolini, 21 - POTENZA(PZ) - 85100'),
  (535,'','','','INNOVAZIONE COMMERCIALE S.R.L.','13155770152','segreteria@cilentooutlet.com  ccascino@cilentooutlet.com','828347085','CILENTO OUTLET','CORSO TRIESTE N. 148 - Roma(RM) - 00197'),
  (536,'','','','CITTA'' DEI BIMBI DI CIRONE GIUSEPPE','1683890766','','97156877','CITTA'' DEI BIMB','Viale dell''Unicef - Potenza(PZ) - 85100'),
  (537,'','','','MEDIA DIVISION S.R.L.','3060900549','f.criscuolo@mediadivision.org','075 5001295','Media Divisionl','Via Rinnovamento,5 - CHIUGIANA DI CORCIANO(PG) - 06070'),
  (538,'','','','MEDICAL CENTER MG S.r.l.','1241060761','rosa.laurita@e-medical.it customercare@e-medical.it','0971 651215','MEDICAL CENTER','C.da Santa Aloia. sn - TITO SCALO(PZ) - 85050'),
  (539,'','','','PLASTIK LEGNO S.n.c. di GIOSCIA GIUSEPPE & EGIDIO','1043870763','gioscia.egidio@tiscali.it gioscia.egidio@gmail.com','0971 69418','PLASTIK LEGNO','Via dell''Edilizia, 16 - POTENZA(PZ) - 85100'),
  (540,'','','','POINT AGENCY S.a.s. di MEDORO MARILENA & C.','1794930766','autieroeventi@gmail.com','','POINT AGENCY','Via Mazzini, 227 - POTENZA(PZ) - 85100'),
  (541,'','','','POLI-SAN S.R.L. UNIPERSONALE','1119330767','','971470947','POLI-SAN','Via Ponte Nove Luci,16/18 A - Potenza(PZ) - 85100'),
  (542,'','','','POLO SUD di Giuseppe Cervino e Antonio De Vita snc','1847310768','polosudsnc@gmail.com','0971 292127','POLO SUD','Via Ateneo Lucano , 18 - Potenza(PZ) - 85100'),
  (543,'','','','GRUPPO INDUSTRIALE FRANCO divisione contract','788090769','amministrazione@gruppofranco.com','','gruppo franco','PIANO SAN NICOLA DI PIETRAGALLA - POTENZA(PZ) - '),
  (544,'','','','GS ARREDAMENTI DI STRAZIUSO RAFFAELE','1732070766','','','GS ARREDAMENTI','Via Nazionale,60 - Tolve(PZ) - 85017'),
  (545,'','','','PARTITO DEMOCRATICO','','info@basilicatapd.it','0971 52797','PD','Via della Tecnica, 18 - Potenza(PZ) - 85100'),
  (546,'','','','GRUPPO CONSILIARE PDL','127040764','','','PDL COM PZ G.C.','P.zza G. Matteotti - POTENZA(PZ) - 85100'),
  (547,'','','','PUBLIGM  di TELESCA GIANCANIO','1526150766','publigm@tiscali.it','97186057','PUBLIGM TELESCA','Via Andrea Doria, 2 - LAGOPESOLE(PZ) - 85020'),
  (548,'','','','PUBLIGOLD S.r.l.','6200470729','info@publigold.it','080 5621349','PUBLIGOLD','Via Saverio Damiani, 4/b - BARI(BA) - 70123'),
  (549,'','','','LAMARCA PAOLINO','519420764','','','LAMARCA PAOLINO','Via Livorno, 138 - POTENZA(PZ) - 85100'),
  (550,'','','','LAMORGESE GIOIELLI S.R.L.','552380768','','0971 21579','LAMORGESE GIOIE','Via Pretoria,109/113 - Potenza(PZ) - 85100'),
  (551,'','','','COLORIFICIO LAMORTE','1330600766','','971472216','LAMORTE COLOR','Via della Fisica, 25 - POTENZA(PZ) - 85100'),
  (552,'','','','LASVEGAS SOC. COOP','1822030761','','','LAS VEGAS','Via Sandro Pertini,29/C - Tito(PZ) - 85050'),
  (553,'','','','MYTHOS S.r.l.','1792250712','antonella.racano@siemdistribuzione.it siem@euronics.it','881654230','MYTHOS SRL','C.so Garibaldi, 94 - FOGGIA(FG) - 71100'),
  (554,'','','','NAPOLI LUIGI','','','','NAPOLI LUIGI','Via Appia, 21 - POTENZA(PZ) - 85100'),
  (555,'','','','HCM S.r.l.','1669320762','capellicesareragazzi@tiscali.it  caniorocco@tiscali.it','97159077','HCM SRL','Via San Vito, 13 - POTENZA(PZ) - 85100'),
  (556,'','','','HOBBY CENTRO S.a.s. di CARNINE LAPOLLA & C.','538510769','emilio@hobbycentro.com','0971 54873','hobby centro','Via della Meccanica, 3 - Potenza(PZ) - 85100'),
  (557,'','','','HOLZ BUILDING S.r.l.','1623880760','pietrafesa@holzbuilding.it','0971 651260','Holz Building','Zona Industriale Tito Scalo - Tito(PZ) - 85050'),
  (558,'','','','ENDOMI S.r.l.','1872480767','','','I BRIGANTI RIST','Via dell''Elettronica, 10 - POTENZA(PZ) - 85100'),
  (559,'','','','ERRE & BI DISTRIBUZIONE DI BRUNO ANGELA','1439440767','info@errebidistribuzione.it','097122738 59105','RREBI','Via Appia,21 - (PZ) - 85100'),
  (560,'','','','RSC S.R.L.','1687130763','STEFANO.CICCIOPASTORE@agenzieagos.it','','RSC S.R.L.','Via Pretoria,12 - Potenza(PZ) - 85100'),
  (561,'','','','SILEO GERARDO','1735380766','','','SILEO GERARDO','C.da Bandito, 7/A - POTENZA(PZ) - 85100'),
  (562,'','','','APULIA DISTRIBUZIONE S.R.L.','5754810728','marketing@apuliadistribuzione.it fornitori@apuliadistribuzione.it fornitori@apuliapec.it','','SIMPLY','C.da Parco Via Nuova - RUTIGLIANO(BA) - 70018'),
  (563,'','','','SINGETTA ALESSANDRO','','alessandro.singetta@regione.basilicata.it','971447225','SINGETTA','VIA VINCENZO VERRASTRO - POTENZA(PZ) - 85100'),
  (564,'','','','DIOMEDE RAFFAELE','','','','DIOMEDE','Via Francesco Baracca,9 - Potenza(PZ) - 85100'),
  (565,'','','','QUI DISCOUNT SPA','1620960763','savino.basile@ohspa.it','9753313322','DISCOUNT SPA','ZONA INDUSTRIALE LOC. SANT''ANTUONO - POLLA(SA) - 84035'),
  (566,'','','','DISEGNO S.R.L.','1836270767','gfaraldo@alice.it','971421339','DISEGNO S.R.L.','Via Aldo Moro snc - Pignola(PZ) - 85010'),
  (567,'','','','ASSOCIAZIONE SPORTIVA THE KING','','mariojivahair@gmail.com','971411911','THE KING ASSOC','Via Zara, 40 - POTENZA(PZ) - 85100'),
  (568,'','','','TIARE'''' VIAGGI DI GIULIO BRIENZA','1581930763','tiare.viaggi@gmail.com','0971 289157','TIARE''','Via del Gallitello,89 - Potenza(PZ) - 85100'),
  (569,'','','','CAMA COMPONIBILI D''ARREDAMENTO S.r.l.','1108760768','','971651121','CAMA SRL','C.da Pozzi - BRIENZA(PZ) - 85050'),
  (570,'','','','CANEPARI SRL','5998410483','annacapex@virgilio.it','','CANEPARI','VIALE DELL''UNICEF - POTENZA(PZ) - 85100'),
  (571,'','','','CAPECE & CORLETO S.n.c.','1220880767','','97158698','CAPECE&CORLETO','Via della Siderurgica - POTENZA(PZ) - 85100'),
  (572,'','','','SANTA TERESA COOPERATIVA SOCIALE','1684120767','','','SANTA TERESA','C.da Pian Cardillo, 5/E - POTENZA(PZ) - 85100'),
  (573,'','','','SANTARSIERO VITO','','','','SANTARSIERO VIT','C.da Macchia Romana, 1 - POTENZA(PZ) - 85100'),
  (574,'','','','SANTORO POINT S.R.L.','3649880659','info@autosantoro.it','','SANTOTO POINT','Via Wenner,53 - Salerno(SA) - 84131'),
  (575,'','','','Anteprima Fashion di Lapenna Angela','1714910765','','0971 443883','fashion','Via Del Gallitello, 135 - Potenza(PZ) - 85100'),
  (576,'','','','Fattorie Donna Giulia S.r.l.','1405840768','p.saraceno@fattoriedonnagiulia.it','0972 715055','fattorie donna',' Zona Ind.  Valle Di Vitalba - Atella(PZ) - 85020'),
  (577,'','','','HABITAT S.r.l.','250660768','habitat@habitatonline.info  gennaro@habitatonline.it','0971 58432','Habitat','Via Vaccaro, 150 - Potenza(PZ) - 85100'),
  (578,'','','','HAIR PROFESSIONAL SYSTEM SRL','1750840769','donato.tricarico@tiscali.it','0971 444738','HAIR PROF','CONTRADA PANTANO SNC - PIGNOLA(PZ) - 85010'),
  (579,'','','','FUSCO S.A.S. di FABRIZIA FUSCO & C.','1221380767','','','FUSCO','Via Pretoria,242 - Potenza(PZ) - 85100'),
  (580,'','','','FUSCO DI CHIRIELEISON FILOMENA','997950761','info@fuscoservice.it','971421022','FUSCO DI CHIRIE','Trav. Aldo Moro,7 - Pignola(PZ) - 85010'),
  (581,'','','','FUTURA S.r.l.','1827930767','','','FUTURA SRL','Via Pretoria, 170 - POTENZA(PZ) - 85100'),
  (582,'','','','RANIERI PAOLO ANTONIO S.R.L.','1234270765','paoloantonioranieri@libero.it','971629411','RANIERI SRL','Zona Industriale - TITO SCALO(PZ) - 85050'),
  (583,'','','','RE CARLO S.p.a.','1544640061','recarlo@recarlo.it','','RE CARLO SPA','Strada Per Solero, 3/A - VALENZA(AL) - 15048'),
  (584,'','','','REALTA'' ITALIA','','realtaitalia@libero.it','','REALTA ITALIA','Via Panama, 16 - ROMA(RM) - 00198'),
  (585,'','','','REDAN DI CARELLI ANGELA','1453130765','','','REDAN','Via Pretoria,121 - Potenza(PZ) - 85100'),
  (586,'','','','EMODIVA ACCADEMY S.r.l.','1687470763','michelecutro@libero.it','97152937','EMODIVA','Via della Tecnica, 18 - POTENZA(PZ) - 85100'),
  (587,'','','','EMOZIONI S.a.s. di LUCIANA PEPE & C.','1806910764','emozionistores@pec.it','97153691','EMOZIONI','Viale Marconi, 87 - Potenza(PZ) - 85100'),
  (588,'','','','PRESTIGE PLUS S.N.C.','1567210768','','','PRESTIGE PLUS','Via Pretoria,161 - Potenza(PZ) - 85100'),
  (589,'','','','PRESTIMUTUO FINANZIAMENTI DI ROSARIO CLAPS','1163660762','prestimutuo@alice.it','0971 56711','PRESTIMUTUO','Via del Gallitello sn - Potenza(PZ) - 85100'),
  (590,'','','','FC S.R.L.','1560350769','','0971 274514','Prestitalia','C.so Garibaldi,46 - Potenza(PZ) - 85100'),
  (591,'','','','REDFORD S.R.L.','1191620762','','0971 273137','REDFORD','Via Pretoria,182 - Potenza(PZ) - 85100'),
  (592,'','','','REGIONE BASILICATA GRUPPO CONSILIARE','96046040760','giuseppemollica@virgilio.it','','REG BAS G.S. PD','Viale Vincenzo Verrastro, sn - POTENZA(PZ) - 85100'),
  (593,'','','','REGIONE BASILICATA Dip. Agricoltura, SREM -Uff. Autorit? di','80002950766','','','REG.BAS.AGR.SRE','Via Vincenzo Verrastro, 10 - POTENZA(PZ) - 85100'),
  (594,'','','','REGIONE BASILICATA','','','','REGIONE SALUTE','Via Vincenzo Verrastro, 4 - POTENZA(PZ) - 85100'),
  (595,'','','','P & P S.A.S. DI DAVIDE PETILLI & C.','1062080765','davide@petilli1933.com','','PETILLI','Via pretoria,137 - Potenza(PZ) - 85100'),
  (596,'','','','PETRONE LUIGI','','','','PETRONE LUIGI','Via Due Torri, 33 - POTENZA(PZ) - 85100'),
  (597,'','','','PIANETA SERVICE S.r.l.','2264580644','info@pianetaservice.it','82574530','PIANETA SERVICE','Via I. De Feo, 71/73 - AVELLINO(AV) - 83100'),
  (598,'','','','PIAZZI ARTURO ANTONIO','116850769','piazziantonio@tin.it','971470938','PIAZZI','C/DA BUCALETTO, 107/A - POTENZA(PZ) - 85100'),
  (599,'','','','SOCIETA'' COOPERATIVA  SERVICE 2000','1092480761','ristorantepierfaone@libero.it','971722972','SERVICE 2000','C/da  Pierfaone - Abriola(PZ) - 85010'),
  (600,'','','','SETARO PROJECT di GIOVANNI SETARO','1679820769','antonello@cubox.it','','SETARO PROJECT','Via Ponte 9 Luci, 2 - POTENZA(PZ) - 85100'),
  (601,'','','','SFIZI PARTENOPEI di SORRENTINO CIRO','1650090762','','','SFIZI PARTENOPE','Via Milano, 11 - POTENZA(PZ) - 85100'),
  (602,'','','','SISTEMI INFORMATICI AZIENDALI S.A.S.','1505890762','','','SIA','Via della Chimica - Potenza(PZ) - 85100'),
  (603,'','','','LACEDA S.N.C.','1613510765','cristiano.laviero@tuaassicurazioni.it','','LACEDA','Via Ciccotti,36C - Potenza(PZ) - 85100'),
  (604,'','','','LACERENZA ISOLANTI S.R.L.','1464930765','info@lacerenza.it','0971 700505','LACERENZA','Contrada Valle Bona s.n. - Avigliano(PZ) - 85021'),
  (605,'','','','LACERRA SALVATORE','','salvatorelacerra@gmail.com','','LACERRA SALVAT','Via Pretoria, 54 - POTENZA(PZ) - 85100'),
  (606,'','','','MAGGIO 3 S.r.l.','1579600766','cancelleria@maggio3.it Sante.Lamoglie@maggio3.it','0971 651000','mag-03','C.da Santa Loja - TITO(PZ) - 85050'),
  (607,'','','','NOVA ITINERA S.n.c.','1615520762','info@maldiviaggi.it','0971 274718','MALDIVIAGGI','Via V. Verrastro, 5/A - POTENZA(PZ) - 85100'),
  (608,'','','','MALLAMO Dr. GIUSEPPE','1008180760','info@farmaciamallamo.com','0971 473447','MALLAMO FARMACI','Via E. Toti, 9/13 - POTENZA(PZ) - 85100'),
  (609,'','','','CAEL DI DAMMIANO ANTONIETTA','1099310763','adammiano@tiscali.it','0971 993639','CAEL','Via Appia, 174/176 - Potenza(PZ) - 85100'),
  (610,'','','','FARMACIA CAIAZZA FRANCO','244180766','','','CAIAZZA','Via Tirreno, 3 - Potenza(PZ) - 85100'),
  (611,'','','','CAIVANO PIERO','1738090768','caivanopiero@tiscali.it','0971 57699','CAIVANO','Via della Tecnica,34 - Potenza(PZ) - 85100'),
  (612,'','','','PIANI E PROGRAMMI DI AZIONE LOCALE','1320830761','a.petraglia@parcostorico.it','0971 34692','PPAL','Via Sicilia, 53 - Potenza(PZ) - 85100'),
  (613,'','','','PRECA BRUMMEL S.p.a.','2482280126','alessandra.cau@precabrummel.com','0331 988338','PRECA BRUMMEL','VIA  GALLIANO, 21 - CARNAGO(VA) - 21040'),
  (614,'','','','RENDEZ VOUS S.r.l.','1451880767','info@rendezvoussrl.it','0972 721063','Libutti','Via Foggia, 5 - MELFI(PZ) - 85025'),
  (615,'','','','LICCIARDI S.R.L.','1597730769','','','LICCIARDI','Via del Gallitello,189-227 - Potenza(PZ) - 85100'),
  (616,'','','','EvolutionCISF S.r.l.','1703140762','info@evolutioncisf.com','0971 470277','evolutioncisf','Via Del Seminario Maggiore snc - Potenza(PZ) - 85100'),
  (617,'','','','EXCLUSIVE SAS DI FRANCESCA GALLICANO & C.','1705530762','potenza@lastminutetour.com','0971 601383','EXCLUSIVE','Via degli Oleandri,28 - Potenza(PZ) - 85100'),
  (618,'','','','F & F STYLE S.R.L.','1830940761','','','F & F STYLE','Viale del Basento,114 - Potenza(PZ) - 85100'),
  (619,'','','','COVEL di COVIELLO ANGELO LUCIANO','1064340761','info@covelservice.com','','COVEL','C.da Torretta, 31/A - POTENZA(PZ) - 85100'),
  (620,'','','','CREA SVILUPPO E INNOVAZIONE S.A.S.','1713600763','creasviluppoeinnovazione@gmail.com','0971 443056','CREA SVILUPPO','Via Livorno,132 - Potenza(PZ) - 85100'),
  (621,'','','','CRISTIN SPOSA DI TOLOMEO CRISTINA','803090760','info@cristinsposa.it','0971 997236','Cristin Sposa','Strada Provinciale 83  KM 4,850 - Baragiano(PZ) - 85050'),
  (622,'','','','PUBLIFAST S.r.l.','2468820788','amministrazione@publifast.it','0984 4550300','PUBLIFAST','Via Rossini, 2 - CASTROLIBERO(CS) - 87040'),
  (623,'','','','PUBLIGM S.r.l.','1725460768','info@publigm.it','97186057','PUBLIGM SRL','Via Andrea Doria, snc - LAGOPESOLE(PZ) - 85020'),
  (624,'','','','ATELIER JOLI'' DI D''EUGENIO CANDIDA LORENA','1705910766','lorenacandida@libero.it','','joli','Via Nazionale - Tolve(PZ) - 85017'),
  (625,'','','','JPM SYSTEM ITALIA S.r.l.','6650391003','','','JPM SYSTEM','Via dell''Oceano Atlantico, 226 - ROMA(RM) - 00144'),
  (626,'','','','K26 S.r.l','1818140764','k262007@gmail.com','','K26','Via della Tecnica, 1 - POTENZA(PZ) - 85100'),
  (627,'','','','K26 S.r.l.','1681660765','k26@tiscali.it','971601161','K26 SRL','Via della Tecnica, 1 - POTENZA(PZ) - 85100'),
  (628,'','','','RHIAG S.P.A.','12645900155','','','RHIAG SPA','Via Vincenzo Monti, 23/D - Pero(MI) - 20016'),
  (629,'','','','RIVIELLO LUIGI GIOIELLI','1634440760','luigiriviello@virgilio.it luigi@riviellogioielli.com','0971 56235','RIVIELLO','Via Appia,206 - Potenza(PZ) - 85100'),
  (630,'','','','RIVIELLO & FIGLI S.a.s. di Riviello Maria Gerarda & C.','1287130767','info@riviello.it','0971 273030','RIVIELLO GIOI','Via Pretoria, 105 - POTENZA(PZ) - 85100'),
  (631,'','','','RN ALLUMINIO DI NICOLA RUGGIERI','1848290761','rnalluminio@tiscali.it','','RN ALLUMINIO','Via Enrico de Nicola - Tito Scalo(PZ) - 85050'),
  (632,'','','','G. DEL PRIORE S.R.L.','2481440655','porshe@delpriore.it  giuseppe.delpriore@delpriore.it','089 332700','DEL PRIORE','Via Parmenide,260 - Salerno(SA) - 84131'),
  (633,'','','','Gioielleria DEL VENTURA ROBERTO','1098360769','','0971 995779','DEL VENTURA','Piazza Plebiscito, 9 - Picerno(PZ) - 85055'),
  (634,'','','','GIOIELLERIA DEL VENTURA DI CURCIO ELVIRA','1797920764','delventuraroberto@alice.it','971995779','DEL VENTURA GIO','Piazza Plebiscito,9 - Picerno(PZ) - 85055'),
  (635,'','','','CENTRO COMMERCIALE AERRE','1103670764','centro.aerre@tiscali.it   antonio.capezio@alice.it','0976 72138','AERRE','C.da S. Luca - Muro Lucano(PZ) - 85054'),
  (636,'','','','AESTHETICART S n.c. di CARRATU'' KATIA','1603130764','','971476622','AESTHETICART','Via Caserma Lucania, 29 - POTENZA(PZ) - 85100'),
  (637,'','','','AGEBAS SRL SOCIO UNICO','1725060766','rosa.romano@agebas.it','971.594.293','AGEBAS','Via della Chimica, 61 - Potenza(PZ) - 85100'),
  (638,'','','','DI NELLA LEONARDO','1592670762','','','DI NELLA LEONAR','Via del Gallitello, 73 - POTENZA(PZ) - 85100'),
  (639,'','','','DI NISI NICOLA','','','','DI NISI NICOLA','Via Zanardelli, 38 - OPPIDO LUCANO(PZ) - 85015'),
  (640,'','','','DI STASIO MASSIMO','1855100762','m.distasio@hotmail.it','','DI STASIO MASSI','Via 4 Novembre, 3 - POTENZA(PZ) - 85100'),
  (641,'','','','DIGANO COMUNICATION di GIUSEPPE CUSANO','1811330768','digano.comunication@gmail.com','0972 35288','DIGANO','Vico Scuro, 8 - VENOSA(PZ) - 85029'),
  (642,'','','','UDC Segreteria Regionale','','','','UDC','Via D. Di Giura, sn - POTENZA(PZ) - 85100'),
  (643,'','','','UFFA 1972 S.r.l.','1707560767','','','UFFA','Via Pretoria, 188 - POTENZA(PZ) - 85100'),
  (644,'','','','UN FILO TIRA L''ALTRA DI SALVATORE MARIA','1561480763','','','UN FILO TIRA','Via Tirreno, 73 - POTENZA(PZ) - 85100'),
  (645,'','','','UNGARO ILARIO S.a.s.','1235360763','ungaro.ilariosas@tiscali.it','97152042','UNGARO SAS','Via del Gallitello, 93 - POTENZA(PZ) - 85100'),
  (646,'','','','TOYS & STYLE DI CRISTINA LIBERATORE','1767760760','','0972 45433','TOY E STYLE','Viale Europa,92 - PALAZZO SAN GERVASIO(PZ) - 85026'),
  (647,'','','','AZIENDA CARTARIA TRAMUTOLA','1044640769','','0971 55287','TRAMUTOLA','Via Dell''Edilizia Z. I. - Potenza(PZ) - 85100'),
  (648,'','','','MACELLERIA E GASTRONOMIA TRAMUTOLA GIUSEPPE','784040768','','0971 442712','TRAMUTOLA GIUSE','Via Sabbioneta, 5 - POTENZA(PZ) - 85100'),
  (649,'','','','AREA DODICI S.R.L.','1713420766','info@areadodici.it','0971 485640','AREA DODICI','C/da S. Aloja S.S.94 KM 46,500 - Tito Scalo(PZ) - 85050'),
  (650,'','','','AREA ESTETICA DI LORUSSO ANTONIO','1766420762','info@areaestetica.it','0971 1934385','AREA ESTETICA','Via Angilla Vecchia,141 - Potenza(PZ) - 85100'),
  (651,'','','','AREMEDIA S.r.l. - Societ? unipersonale','3107180782','info@aremedia.it','0984 35970','AREMEDIA','P.zza Zumbini-trav. A. Bandiera snc - COSENZA(CS) - 87100'),
  (652,'','','','A.R.P.A.B..','1318260765','','971656111','ARPAB','Via della Fisica, 18 - POTENZA(PZ) - 85100'),
  (653,'','','','VIA VENETO UOMO DI MANCUSI CARMELA','1548920766','','0971 56009','VIA VENETO','Viale Dante, 23 - Potenza(PZ) - 85100'),
  (654,'','','','VIDEOLAB di ARCIERI DAVIDE','1720480761','videolabarcieri@gmail.com','0971 1800471','VIDEOLAB','P.le Vilnius, 6 - POTENZA(PZ) - 85100'),
  (655,'','','','Villa Arcobaleno di Laurita Angelo','1097070765','info@villarcobaleno.it','0971 985082','VILLA ARCOBALE','C.da Ruota, 9 - Brindisi di Montagna(PZ) - 85010'),
  (656,'','','','L.C.D. S.R.L.','1650370768','','','VILLA DIAMANTE','C/da Carpinelli, snc - Avigliano(PZ) - 85021'),
  (657,'','','','BRUNELLESCHI BRICOLAGE S.r.l.','1613020765','segreteria@bricomelfi.it','0972 239848','BRUNELLESCHI','C.da Bicocca, 85 - MELFI(PZ) - 85025'),
  (658,'','','','BRUNO ROSA','1257840767','rosa.bruno@pfafineco.it','97153529','bruno','Via del Gallitello, 257 - POTENZA(PZ) - 85100'),
  (659,'','','','MB BRUNO MODA S.R.L.','1369630767','domenicobru@hotmail.it','','BRUNO MODA','Via Belvedere,70 - Satriano di Lucania(PZ) - 85050'),
  (660,'','','','ISTITUTO TECNICO INDUSTRIALE STATALE','','pztf01000d@istruzione.it','0971 51806','ITIS','Via Don Minozzi, 39 - Potenza(PZ) - 85100'),
  (661,'','','','IUCCIO RICAMBI DEI F.LLI BRIENZA S.n.c.','830000766','iuccioricambi@tiscali.it','0971 55453','Iuccio','Via Dell''Edilizia, 4 - Potenza(PZ) - 85100'),
  (662,'','','','NASCE UN SORRISO SOC. COOP. SOCIALE','1518020761','n.becce@tiscali.it','0971 443463','NASCE UN SORRIS','VIA ISCA DEGLI ANTICHI, 6 - POTENZA(PZ) - 85100'),
  (663,'','','','NATURHOUSE ITALIA S.R.L.','2505911202','amsuditalia@naturhouse.it','532907080','NATUR HOUSE','Via G. Caselli,11/f - Ferrara() - 44100'),
  (664,'','','','ASSOCIAZIONE SPORTIVA DILETTANTISTICA','1550960767','','','TEAM PENNING','C.da Valle della Lamia, sn - SAN CHIRICO NUOVO(PZ) - 85010'),
  (665,'','','','TECNOMEDICAL S.R.L.','930820766','tecnomedicalpz@virgilio.it','0971 54679','TECNOMEDICAL','VIA DEL GALLITELLO, 81 - POTENZA(PZ) - 85100'),
  (666,'','','','GRUPPO RAGNINO S.R.L.','3061350611','','823405663','ETENSIVE','Via Napoli, 105 - Maddaloni(CE) - 81024'),
  (667,'','','','PROFUMERIA EUFORIA di MARE CLAUDIA GIORGETTA','1807600760','luckyprofumeria@libero.it  euforiaprofumerie@libero.it','0971 56778','EUFORIA','Via Isca del Pioppo, 21 - POTENZA(PZ) - 85100'),
  (668,'','','','EURO SPORT FASHION S.n.c.','1588770766','','0971 594371','EURO SPORT','VIA DEL GALLITELLO - pOTENZA(PZ) - 85100'),
  (669,'','','','POTENZA ALESSANDRO','298970765','nicola.potenza@email.it','971411890','VALLEVERDE POTE','Via Vaccaro, 10 - POTENZA(PZ) - 85100'),
  (670,'','','','FOTO VECE DI VECE GIUSEPPE','1169160767','vecefotografo@gmail.it','0971 1940789','VECE','Via  G. Mazzini,127 - Potenza(PZ) - 85100'),
  (671,'','','','GIUSEPPE VECE FOTOGRAFO S.r.l.','1822600761','','','VECE FOTOGRAFO','Via Mazzini, 127 - POTENZA(PZ) - 85100'),
  (672,'','','','BABY DI D''ANGIOLILLO CINZIA','1688380763','','0971 53126','BABY','Via Nazario Sauro,21 - Potenza(PZ) - 85100'),
  (673,'','','','Baby ''s World di Senka Sonila','1662350766','babysworldvenosa@gmail.com','0972 31195','baby''s world',' Via Melfi,135 - Venosa(PZ) - 85029'),
  (674,'','','','LUCKY SRL','1758580763','luckyprofumeria@libero.it','971594237','lucky','VIA ENRICO TOTI, 3/5 - POTENZA(PZ) - 85100'),
  (675,'','','','ENTE LUCUS','1371320761','','','LUCUS','Via Pretoria,54 - Potenza(PZ) - 85100'),
  (676,'','','','LUIGI QUAGLIA & C. S.R.L.','10037780151','estero@luigiquaglia.it','02 72022614','LUIGI QUAGLIA','Via dell''Unione, 2 - Milano(MI) - 20122'),
  (677,'','','','RISTORANTE ROSEN GARDEN gestione','1756920763','','0971 50028','ROSEN GARDEN','Via Firenze,4 - Tolve(PZ) - 85017'),
  (678,'','','','RPR Communication Service S.A.S.','1246970766','gianluigi.petruccio@gruppoeditorialelucano.com','','RPR','via Roma, 26 - CASTELLUCCIO INFERIORE(PZ) - 85040'),
  (679,'','','','SO.CO. COSTRUZIONI s.r.l.','1588720761','impresasoceis@tin.it  robyurgesi@yahoo.it','','so.co.','VIA MAZZINI, 23/E - POTENZA(PZ) - 85100'),
  (680,'','','','SOGNO GIOIELLI S.R.L.','1572340766','','','SOGNO','Viale dell'' Unicef - Potenza(PZ) - 85100'),
  (681,'','','','IL SATELLITE STORE DI COVIELLO ROCCO','1733610768','','','IL SATELLITE ST','Via dell''Edilizia,10 - Potenza(PZ) - 85100'),
  (682,'','','','IL MERCATINO DELLA FRUTTA di LOTITO MARCELLO','1586760769','marcellolotito@gmail.com','','ILMERCATINODELL','Via Unit? d''Italia, 51 - POTENZA(PZ) - 85100'),
  (683,'','','','ANGLOMAGIC S.r.l.','1375210760','','97122788','ANGLOMAGIC SRL','P.zza Duca della Verdura, 10/12 - POTENZA(PZ) - 85100'),
  (684,'','','','A.N.M.I.C. ASSOCIAZIONE NAZIONALE','','','971274838','ANMIC','D.sa San Gerardo,142 - Potenza(PZ) - 85100'),
  (685,'','','','ANTONIO FABIO & C. S.n. C.','863160768','','0971 718128','ANTONIO FABIO','C.so Vittorio Emanuele, 207 - Vietri di Potenza(PZ) - 85058'),
  (686,'','','','TMC di VELLUZZI ROCCO','1713960761','infotmcgrafica@gmail.com','0971 442334','TMC','Via Discesa San Gerardo, 154 - POTENZA(PZ) - 85100'),
  (687,'','','','GUITAR VALLEY di TOLVE GINO','1812180766','goltria@email.it  ginotolve@gmail.com','971485871','TOLVE','C/DA SANTA LOJA TITO SCALO - TITO(PZ) - 85050'),
  (688,'','','','TOURING SERVICE S.r.l.','1330200765','info@hotelgiubileo.it','971479910','TOURING SERVICE','SS. 92 Rifreddo - PIGNOLA(PZ) - 85010'),
  (689,'','','','FALLIMENTO FRANCESCO LOSCALZO Curatore','528180763','avv.ivanapipponzi@tiscali.it','971410941','PIPPONZI AVV.','Via Discesa S. Gerardo, 180 - POTENZA(PZ) - 85100'),
  (690,'','','','PISANI DISTRIBUZIONE S.r.l.','1344240765','nicola@pisanisrl.com maria@pisanisrl.com','','PISANI','VIA Della Chimica,9 - (PZ) - 85100'),
  (691,'','','','PISATI IOLANDA','','','','PISATI IOLANDA','Via Trieste, 3 - POTENZA(PZ) - 85100'),
  (692,'','','','PUBBLI A di SIGNORELLI DOMENICO','1444570764','geom.signorelli@gmail.com','0972 239330','GENERAL SERVICE','Via Floriano del Zio,25 - MELFI(PZ) - 85025'),
  (693,'','','','SOCIETA'' COOPERATIVA GENIUS LOCI','1728550763','info@geniusloc.it','','GENIUS LOCI','Via San Donato,5 - Marsico Nuovo(PZ) - 85052'),
  (694,'','','','GENOVESE LUCIANO','','','','GENOVESE','Via Don Minsoni,131 - Avigliano(PZ) - 85021'),
  (695,'','','','COFIM S.r.l.','1112470768','cofimdibello@gmail.com','0971 449312','COFIM','Via Mazzini, 72 - POTENZA(PZ) - 85100'),
  (696,'','','','LEJOS S.r.l.','1794450765','coin.potenza@gmail.com','0971 306959','COIN','Via del Seminario Maggiore, snc - POTENZA(PZ) - 85100'),
  (697,'','','','GE.P.I.M. S.r.l.','1748910765','','','GEPIM','Viale del Basento, 1 - POTENZA(PZ) - 85100'),
  (698,'','','','GERARDI PUBBLICITA'' S.r.l.','1757980766','','0971 86231','GERARDI PUBBLIC','C.so Federico II, 21 - LAGOPESOLE(PZ) - 85020'),
  (699,'','','','DE CARLO INFISSI S.P.A.','2341980734','decarlo@decarlo.it','099 8833511','DE CARLO','Via per Castellaneta - San Basilio- Mottola(TA) - 74017'),
  (700,'','','','PUBLILOOK di POTENZA STEFANIA','2631550759','publilook1@tiscali.it','','PUBLILOOK','Via Roma, 16 - UGENTO(LE) - 73059'),
  (701,'','','','PUBLIONE S.r.l.','3570420400','zanelli@publione.it miotto@publione.it','','PUBLIONE','Via Costanzo II, 11 - Forl?(FC) - 47122'),
  (702,'','','','PUBLIPOINT S.a.s.','1183820768','info@publipoint.it','971445297','PUBLIPOINT SAS','Via Livorno, 21 - POTENZA(PZ) - 85100'),
  (703,'','','','TENPORT DI GALASSO SALVATORE','1272200765','tenport@libero.it','0971 46032','TENPORT','Via San Remo,193 - Potenza(PZ) - 85100'),
  (704,'','','','TERMOIDRAULICA DI TELESCA VITO','1811920766','','','TERMOIDRAULICA','Via Francesco Saverio Nitti,7/9 - Potenza(PZ) - 85100'),
  (705,'','','','TERRITORIO S.p.a.','662380765','','','TERRITORIO SPA','Via Domenico Di Giura - POTENZA(PZ) - 85100'),
  (706,'','','','TESORO CASA di TESORO VALERIA MARIA','1702400761','tesorocasa@tiscali.it  drinvale@yahoo.it','971472009','TESORO','VIA DEL GALLITELLO, 116 L/M - POTENZA(PZ) - 85100'),
  (707,'','','','CONSORZIO TURISTICO DI ABRIOLA','1451240764','','','CONSORZIO TURIS','C.da Pierfaone,8 - Abriola(PZ) - 85010'),
  (708,'','','','R.C. SISTEMI di CONTE ROCCO','1296800764','roccoconte@cheapnet.it','0971 485581','conte','via I? Maggio, 16 - PICERNO(PZ) - 85055'),
  (709,'','','','CONVERTI STEFANO','1696370764','agenzia@immobiliareconverti.it','0971 441674','CONVERTI IMMOBI','Via Milano, 55 - POTENZA(PZ) - 85100'),
  (710,'','','','PARRUCCHIERE HAIR VIKY DI MURO VINCENZO','1471710762','','0971 36861','HAIR VIKY','C.so Garibaldi, 9 - Potenza(PZ) - 85100'),
  (711,'','','','HAIRSPA by ANTONELLA di ANTONELLA VERRASTRO','1548780764','creativeheart1836@gmail.com','','HAIRSPA','Via Londra, 91 - POTENZA(PZ) - 85100'),
  (712,'','','','HAPPY CASA STORE S.R.L.','2708430737','mariocolaci@happycasastore.it','','HAPPY CASA','Via Giuseppe Cassano - Martina Franca(TA) - 74015'),
  (713,'','','','DOLCEZZE di MANCINI ANGELA','1438910760','','0971 995773','DOLCEZZE MANCIN','Via Aldo Moro - PICERNO(PZ) - 85055'),
  (714,'','','','DOLCEZZE S.R.L.','1699660765','','','DOLCEZZE S.R.L.','Via Aldo Moro.6 - Picerno(PZ) - 85055'),
  (715,'','','','DITTA FRANCESCO SOLIMENA','830670766','','0971 24493','SOLIMENA','Via Pretoria, 156-162 - Potenza(PZ) - 85100'),
  (716,'','','','SOLINAS & PARTNERS S.a.s. di GIUSEPPE SOLINAS','12351200154','info@solinas-partenrs.it','0523 892909','SOLINAS','Localit? MONTEZAGO palazzo 1 - LUGAGNANO VAL D''ARDA(PC) - 29018'),
  (717,'','','','SOLUZIONE LUCE SAS','','soluzioniluce@yahoo.it','971473624','SOLUZIONI LUCE','C/DA BUCALETTO, 105/A - POTENZA(PZ) - 85100'),
  (718,'','','','SOTTO ZERO dI POSTIGLIONE VINCENZO','919310763','postiglionevincenzo@gmail.com','0971 35557','SOTTO ZERO','VIALE DANTE, 82 - POTENZA(PZ) - 85100'),
  (719,'','','','FERRAMENTA GIURA PASQUALE','801470766','','','Giura','Via Roma, 25 - Venosa(PZ) - 85029'),
  (720,'','','','GIURA FRANCESCA IMMACOLATA','1308630761','giura@cdbmail.com','0972 33484','GIURA FRANCESC','Via Extramurale Forenza, 3 - Maschito(PZ) - 85020'),
  (721,'','','','GIUZIO VINCENZA','1032880765','','','GIUZIO VINCENZA','Via V. Verrastro, 31 - POTENZA(PZ) - 85100'),
  (722,'','','','GLOBAL TECHNOLOGY SERVICE di ROMANIELLO VITO','1876550763','info@globaltechnologyservice.net','0971 1835889','GLOBAL TECHNOLO','Via Ponte Nove Luci, 10 - POTENZA(PZ) - 85100'),
  (723,'','','','ASSOCIAZIONE ITALIANA FISIOTERAPISTI','','','','ASSOC FISIOTERA','Via San Remo, 86 - POTENZA(PZ) - 85100'),
  (724,'','','','ASSOCIAZIONE SPORTIVA DILETTANTISTICA','','tkd.security@libero.it','','Associazione Ta','Via Flavio Gioia, 14 - Anzi(PZ) - 85010'),
  (725,'','','','ASTOR S.R.L.','1766490765','adriana.petilli@astorimmobiliare.it','tel:','ASTOR','V. Ciccotti, 36/C - Potenza(PZ) - 85100'),
  (726,'','','','PITTY SERVICE S.a.s. di Pietrafesa G. & C.','1677570762','info@fantasticomondo.com','0971 472299','FANTASTICOMONDO','Viale Dante, 43 - POTENZA(PZ) - 85100'),
  (727,'','','','FARMACIA DENTE DI VICARIO LUCA','1227130760','farmaciadente@tiscali.it','0971 21449','FARMACIA DENTE','Via Pretoria, 69 - Potenza(PZ) - 85100'),
  (728,'','','','FARMACIA GIACOVAZZO FRANCA','1261590762','','','FARMACIA GIACO','Via Aldo Moro,57 - Pignola(PZ) - 85010'),
  (729,'','','','ELLE F.LLI LACERRA S.A.S.','1173180769','','0971 445122','F.LLI LACERRA','C/da Baragiano, 64/b - Potenza(PZ) - 85100'),
  (730,'','','','FALCAR spa','1087330765','mfalco@falcar.gbsnet.it','971472217','FALCAR','C/DA RIO FREDDO Z.I. - POTENZA(PZ) - 85100'),
  (731,'','','','FALL.N.1/88 CEMENTISUD SNC-soci MOSCARELLI G.','823810767','studiolavianiromano@libero.it','','FALL. 1/1988 RF','Via Viggiani, 8 - POTENZA(PZ) - 85100'),
  (732,'','','','GIOSCIA Avv. MARIA CARMELA','907710768','carmelagioscia@virgilio.it','0971 35124','FALL. 108/2004','Via Luigi Sturzo, 2 - AVIGLIANO(PZ) - 85021'),
  (733,'','','','ARCOS di RAFFAELE AVIGLIANO','1720570769','raffaeleavigliano@tiscali.it','','ARCOS','Via Montecalvario, 9 - BRIENZA(PZ) - 85050'),
  (734,'','','','GRAPHIS S.N.C. DI GIUSEPPE SALUZZI & CO.','1288050766','info@graphisweb.com','0971 749454','GRAPHIS S.N.C.','Zona PAIP - Acerenza(PZ) - 85011'),
  (735,'','','','DOTT.SSA GABRIELLA GRASSI','1106130766','','','GRASSI','P.zza Duca della Verdura,10 - Potenza(PZ) - 85100'),
  (736,'','','','GREGORIO MOBILI SRL','1666130768','mobiligregorvitt@libero.it','971993019','GREGORIO','VIA APPIA, 170 - BARAGIANO(PZ) - 85050'),
  (737,'','','','RUSSO RICAMBI di Russo Giovanni','551460769','info@autoricambirusso.it  marco@autoricambirusso.it','97150038','RUSSO RICAMBI','C.da Varco D''Izzo, 1/C - Potenza(PZ) - 85100'),
  (738,'','','','SABIA CATERINA','263840761','amministrazione@gruppofranco.com  roccorag@gruppofranco.com','0971 64183','SABIA CATERINA','Piano San Nicola - PIETRAGALLA(PZ) - 85016'),
  (739,'','','','SACAR SERVICE S.R.L.','1875170761','amministrazione@sacarpotenza.it','97154855','SACAR','Via dell''Edilizia - Potenza(PZ) - 85100'),
  (740,'','','','PROFUMIA di ARCIERI GIUSEPPE','1494330762','','971443552','PROFUMIA','Via del Gallitello, 209/211 - POTENZA(PZ) - 85100'),
  (741,'','','','PROFUMIA di LAURA FERRULLI','1777040765','laura.ferrulli@libero.it','','PROFUMIA FERRUL','Via del Gallitello, 209/211 - POTENZA(PZ) - 85100'),
  (742,'','','','ACQUEDOTTO LUCANO S.p.A.','1522200763','ufficio.marketing@acquedottolucano.it','','Acquedotto Luca','Via P.Grippo - Potenza(PZ) - 85100'),
  (743,'','','','AD LINE di DONATO DISABATO','1660550763','info@adline.it','0971 472713','AD LINE','Frazione San Donato, sn - ANZI(PZ) - 85010'),
  (744,'','','','CAPITOL S.R.L.','1209700762','capitolarredamenti@tiscali.it','','CAPITOL CUCINE','Zona Industriale Baragiano - Balvano(PZ) - 85050'),
  (745,'','','','BASILE EXPERIENCE di CAPOBIANCO ROSSELLA','1788810768','','','CAPOBIANCO R','VIA DEL GALLITELLO, 72 - POTENZA(PZ) - 85100'),
  (746,'','','','CAFE'' UNIVERSITARIO di CAPPIELLO PIETRO','1707430763','capellopietro@tiscali.it','','CAPPIELLO PIETR','Via dell''Ateneo Lucano, 10 - POTENZA(PZ) - 85100'),
  (747,'','','','INFISSI MODRONE S.r.l.','1689650768','','971594353','MODRONE INFISSI','Via della Fisica - POTENZA(PZ) - 85100'),
  (748,'','','','LICEO SCIENTIFICO MURO LUCANO','','','0976 2281','LICEO SCIE MURO','C.da Capodigiano, snc - MURO LUCANO(PZ) - 85054'),
  (749,'','','','LINEA LEGNO S.R.L.','1038450761','linealegnogroup@direzione.it','0971 994022','LINEA LEGNO','Zona Industriale Baragiano - Balvano(PZ) - 85050'),
  (750,'','','','LINEA SERRAMENTI DI VINCENZO GIULIVO','1669570762','enzo.giulivo@tiscali.it','0971 601088','LINEA SERRAMEN','Via F.lli Perito,24 - Pignola(PZ) - 85010'),
  (751,'','','','AVV COSIMO LOVELLI Curatore Fallimentare','896920766','cosimo.lovelli@tiscali.it','97125699','LOVELLI COSIMO','Via Discesa San Gerardo, 144 - POTENZA(PZ) - 85100'),
  (752,'','','','LUCANA COLORI di VITO CANTORE','854630761','lucanacolori@interfree.it','','LUCANA COLORI','Via Appia, 7 - BARAGIANO(PZ) - 85050'),
  (753,'','','','ALCOTT  DI ACIERNO LILIANA','1442720767','lacierno@libero.it','393 5289218','ALCOTT','Via del Gallitello snc - Potenza(PZ) - 85100'),
  (754,'','','','ALICE MULTIMEDIALE srl','1504090760','info@alicemultimediale.com','0971 594293','alice','Via Della Chimica, 61 - Potenza(PZ) - 85100'),
  (755,'','','','PERCHE'' PARQUET DETTAGLI di D''AIUTO VALENTINA','1772510762','info@percheparquet.it','','PERCHEPARQUET','Viale Dante, 92 - POTENZA(PZ) - 85100'),
  (756,'','','','ASSOCIAZIONE CULTURARE PERSONA LIBERA','','telescavito63@gmail.com','','PERSONALIBERA','C.da Giuliano, 6 - POTENZA(PZ) - 85100'),
  (757,'','','','PES HOLDING S.r.l.','10923151004','emanuele.latini@pes.it amministrazione@pes.it  ima.bari@imaoutdoor.it  teresa.boccia@pes.it','06 66181174','PES HOLDING SRL','Via Tomasino D?Amico, 82 - ROMA(RM) - 00166'),
  (758,'','','','ASSOCIAZIONE CONFEURO','','','','CONFEURO','Discesa San Gerardo,142 - Potenza(PZ) - 85100'),
  (759,'','','','PRESIDENZA DEL CONSIGLIO COMUNALE DI POTENZA','127040764','','','CONS. COM. PZ','P.zza Matteotti - POTENZA(PZ) - 85100'),
  (760,'','','','CONSORZIO OPERATORI LUCANIA','1786480762','lucania@project-servicesrl.it','','CONSORZIO LUCAN','C.da S. Loja, sn - Tito(PZ) - 85050'),
  (761,'','','','CONSORZIO O. P. DEL MEDITERRANEO','1408200762','','','CONSORZIO O. P.','C/da Piani snc - Palazzo San Gervasio(PZ) - 85026'),
  (762,'','','','CENTRO DI DRAMMARTURGIA EUROPEO','1083280766','','97154704','CENTRO DI DRAMA','Piazza Gianturco,2 - Potenza(PZ) - 85100'),
  (763,'','','','CENTRO GRAFICO BASILICATA S.n.c.  di','179030762','cgbpotenza@libero.it','971442172','CENTRO GRAF.BAS','Via Enna, 19 - POTENZA(PZ) - 85100'),
  (764,'','','','GIORDANO ANTONIO','1266700762','giordanoantonio@aruba.it','0971 700661','GIORDANO ANTONO','C.da Carpinelli, snc - AVIGLIANO(PZ) - 85021'),
  (765,'','','','GIORDANO MICHELE','1460850769','geometriesolari@gmail.com','0971 1835569','GIORDANO MICHEL','C.da Botte, 18 - TITO(PZ) - 85050'),
  (766,'','','','GIRALDI S.a.s. di Giraldi Federico & C.','254830763','federico.giraldi@gmail.com','0971 50050','GIRALDI SAS','Complanari Costa della Gaveta - POTENZA(PZ) - 85100'),
  (767,'','','','PANDOLFO CARMELA','1147430761','carmelapandolfo@tiscali.it','0971 993450','PANDOLFO CARMEL','Via Appia, 296 - BARAGIANO(PZ) - 85050'),
  (768,'','','','Sartoria Pansardi di Pansardi Anna Maria','807500764','info@annapansardi.com','0975 352430','Pansardi','Via Gasparrini, 17 - Villa D''Agri di Marsico Vetere(PZ) - 85050'),
  (769,'','','','PANSARDI SPOSA di LAPADULA MARIA','1778940765','info@annapansardi.com','0975 352430','PANSARDI SPOSA','Via Gasparrini, 17 - MARSICO VETERE(PZ) - 85050'),
  (770,'','','','ISOMAX S.R.L.','1111840763','isomax@tiscali.it','971485220','ISOMAX','Zona Industriale - TITO SCALO(PZ) - 85050'),
  (771,'','','','ISTAR VIAGGI E TURISMO','1631120761','','','ISTAR VIAGGI','Corso Garibaldi,83 - Potenza(PZ) - 85100'),
  (772,'','','','ITAL SE. IN. SOCIETA'' COOPERATIVA','1625770761','antonio.claps@virgilio.it','0971 82415','ITAL SE.IN.','Via G. Fortunato, 18/C - AVIGLIANO(PZ) - 85021'),
  (773,'','','','ITALCROM S.r.l.','327050654','mdevita@italcrom.it','89301260','ITALCROM s.r.l','Via Firmio Leonzio, 12 - (SA) - 84131'),
  (774,'','','','SINTESI S.R.L.','1333920765','tramutola@e-sintesi.it','','SINTESI','Via Ciccotti,36 - Potenza(PZ) - 85100'),
  (775,'','','','IMPRESA SIR LORY DI SARLI LORENZO','1779600764','','0971 55005','SIR LORY','C/da Costa della Gaveta,35 - Potenza(PZ) - 85100'),
  (776,'','','','PROTEZIONE CIVILE GRUPPO SISMA','','sismaspettacoli@gmail.com','971444310','SISMA','VIA ANCONA, 29 - POTENZA(PZ) - 85100'),
  (777,'','','','SMARTFORM di ANNA ROSA SAMMARTINO','1856760762','','','SMARTFORM','Traversa I Via del Gallitello, snc? - POTENZA(PZ) - 85100'),
  (778,'','','','FUORI SQUADRO di PECCHIOLI ILARIA','1579990761','fuori@fuorisquadro.it','971472521','FUORI SQUADRO','C.da Poggio Cavallo, 87 - POTENZA(PZ) - 85100'),
  (779,'','','','FURONE ROCCO','1249440767','','97135554','FURONE','Via Pretoria, 139/141 - Potenza(PZ) - 85100'),
  (780,'','','','PUNTO NET S.r.l.','1767840760','puntonetsrl@tiscali.it','971650557','PUNTO NET','Via Anna Maria Ortese, 7 - POTENZA(PZ) - 85100'),
  (781,'','','','ABBIGLIAMNETO PUNTO ROSSO DI CAPECE ROCCO','1146740764','puntorossomoda@libero.it','971798632','PUNTO ROSSO','C/da Petrile - Tito(PZ) - 85050'),
  (782,'','','','Fattorie Punzi Soc. Coop. Agricola','186770767','fattoriepunzi@hotmail.it','0971 795080','punzi','Via Cavour, 43 - Potenza(PZ) - 85100'),
  (783,'','','','ASSOCIAZIONE GIARDINO DEI MONELLI','','','0971 700430','Giardino dei','Via S. Vito - Avigliano(PZ) - 85021'),
  (784,'','','','GIEFFE S.r.l.','1782770760','dokpotenza@gmail.com','97158276','GIEFFE','C.da Tora, 5 - POTENZA(PZ) - 85100'),
  (785,'','','','GIOIA DEI BIMBI S.N.C.','1252150766','amministrazione@gioiadeibimbi.eu','0971 34229','GIOIA DEI BIMBI','Via Pretoria,190 - POTENZA(PZ) - 85100'),
  (786,'','','','GIOIOSA MARIO','1823000763','','','GIOIOSA MARIO','C.da Malvaccaro, 30/C - POTENZA(PZ) - 85100'),
  (787,'','','','IASILLI GIUSEPPE','96580766','arredamenti.jasilli@tiscali.it','0971 485120','IASILLI','C.da Serra,27 - TIto(PZ) - 85050'),
  (788,'','','','IBA TECNOLOGY DI ANNA BAGNUOLO','1731460760','','0975 203748','IBA TECNOLOGY','Via Umberto I, 20 - S. Angelo le Fratte(PZ) - 85050'),
  (789,'','','','ICOFFEE di LUCIA ANTONELLA','1842420760','','','ICOFFEE','Via Angilla Vecchia, 113 - POTENZA(PZ) - 85100'),
  (790,'','','','I.G.A. S.r.l.','6359940480','igasrl@legalmail.it','06 66181174','IGA','Via Pietrapiana, 32 - FIRENZE(FI) - 50121'),
  (791,'','','','MARGI di MARIA MESSINA','1693010769','','','MARGI','Via due Torri, 27 - POTENZA(PZ) - 85100'),
  (792,'','','','PARROCCHIA MARIA SS. IMMACOLATA','','','0971 58540','MARIA SS. IMMAC','Via Ionio, 54 - POTENZA(PZ) - 85100'),
  (793,'','','','GARRAMONE MICHELA','1237060767','agrimarino@email.it','','Marino','C/da Camastra, 12 - Trivigno(PZ) - 85018'),
  (794,'','','','KURSAAL BAR di FALCE VALENTINO','931250765','falce.nico@tiscali.it','0971 486040','KURSAAL','C.da Petrucco,8 - PIGNOLA(PZ) - 85010'),
  (795,'','','','ASSOCIAZIONE BASILICATA POPOLARE','96058770767','sergio.carnevale@alice.it','','basilicata pop','Via Pretoria - Potenza(PZ) - 85100'),
  (796,'','','','BASILICO FRESCO DI CORVINO CIPRIANO','1792650762','basilicofrescopz@gmail.com','0971 1800357','BASILICO FRESCO','Via del Gallitello, 157/159 - Potenza(PZ) - 85100'),
  (797,'','','','BCC MONTE PRUNO di ROSCINO e di LAURINO','269570651','antonio.mastrandrea@bccmontepruno.it','0975 398664','BCC MONTE PRUNO','VIA PAOLO BORSELLINO - SANT''ARSENIO(SA) - 84037'),
  (798,'','','','GTOUR S.R.L.','1786870764','direzione@hotelgiubileo.it  gtoursrl@pec.it','','GTOUR SRL','Via Verderuolo Inferiore, 13 - POTENZA(PZ) - 85100'),
  (799,'','','','GUARENTE MARIO','','mario.guarente@gmail.com','','GUARENTE MARIO','Via F. S. Nitti, 86 - POTENZA(PZ) - 85100'),
  (800,'','','','GUITAR VALLEY di GINO TOLVE','','ginotolve@gmail.com','0971 485871','GUITAR VALLEY','C.da Santa Loja - TITO SCALO(PZ) - 85050'),
  (801,'','','','TAPPEZZERIA MASTROGIOVANNI di VITANTONIO LORUSSO','1857690760','tapp.mastrogiovanni@alice.it','','MASTROGIOVANNI','C.da Santa Loja - Zona Industriale - TITO(PZ) - 85050'),
  (802,'','','','MATTIACCI ANDREA','1739320768','info@andreamattiacci.it','0971 1973922','MATTIACCI ANDRE','Vico Bertani,4 - Potenza(PZ) - 85100'),
  (803,'','','','MAX LE GRIFFE di CIRVIANI MASSIMO','1644370767','','971650411','MAX LE GRIFFE','Via Isca del Pioppo, - Potenza(PZ) - 85100'),
  (804,'','','','PROGETTO_G DI GUMA MAURIZIO','1668390766','m.guma@tiscali.it','','PROGETTO G','Via  G. Albini, 133 - PICERNO(PZ) - 85055'),
  (805,'','','','Pro-Loco Vaglio Basilicata','1769380765','prolocovagliobasilicata@hotmail.it  vagliobasilicataproloco@gmail.com','0971 59051','Proloco Vaglio','Piazza Del Popolo,1 - Vaglio Basilicata(PZ) - 85010'),
  (806,'','','','PRO.TEC. Societ? Cooperativa','1676560764','','0971 650736','PROTEC','Via delle Medaglie Olimpiche, 7 - POTENZA(PZ) - 85100'),
  (807,'','','','DOMUS ART BY A.P.E. CENTER SERVICE S.n.c','1579840768','','971508009','DOMUS ART','Via del Gallitello, 73 - POTENZA(PZ) - 85100'),
  (808,'','','','D.R. ASSICURAZIONI S.N.C.','1762860763','romeoromano78@libero.it','','DR ASSICURAZIO','Via Napoli,5 - Potenza(PZ) - 85100'),
  (809,'','','','DURANTE GENNARO','1055740763','durante.gennaro@tiscali.it','','DURANTE GENNARO','Via Madonna D''Anglona - Senise(PZ) - '),
  (810,'','','','VACCARO FRANCESCO','1850290766','','','VACCARO FRANCES','Via del Gallitello, 115 - POTENZA(PZ) - 85100'),
  (811,'','','','COMUNE DI VAGLIO','','','','VAGLIO','Via Carmine, 16 - VAGLIO DI BASILICATA(PZ) - 85010'),
  (812,'','','','VALENZANO S.r.l.','836360768','info@valenzanoeco.it','0971 651093','VALENZANO SRL','Zona Industriale - TITO SCALO(PZ) - 85050'),
  (813,'','','','ARREDAMENTI JASILLI S.r.l.','1744640762','arredamenti.jasilli@tiscali.it info@jasilliarredamenti.it','0971 485120','JASILLI','Via Sandro Pertini, 10 - Tito(PZ) - 85050'),
  (814,'','','','ENZA E TERESA MIRAGLIA S.R.L.','1482890769','','0971 59073','JENESSE','Via del Gallitello,89 - Potenza(PZ) - 85100'),
  (815,'','','','JETBIT S.r.l.s.','01826130765','info@jetbit.it','0971 1746274','JETBIT','Via Vincenzo Verrastro, 29 - POTENZA(PZ) - 85100'),
  (816,'','','','MOBILI GREGORVIT di GREGORIO GIUSEPPE','101860765','rocco.gregorio@libero.it','0971 993019','GREGORVIT','VIA APPIA, 170 - Baragiano(PZ) - 85050'),
  (817,'','','','GRUPPO FIRST s.r.l.','6838710157','S.Ferrara@montblancitalia.it','','GRUPPO FIRST','C.so Sempione,14 - MILANO(MI) - 20154'),
  (818,'','','','TECNUFFICIO S.r.l.','2411020718','info@tecnufficio.it','881720769','TECNUFFICIO SRL','Via D''Arignano, 11 - FOGGIA(FG) - 71100'),
  (819,'','','','TELECOMP PLANET FILM PRODUCTION S.r.l.','2497890596','virginiomoro@email.it','','TELECOMP PLANET','Via Don Torello, 113 - LATINA(LT) - 04100'),
  (820,'','','','TELESCA FRANCESCO','1724990765','','','TELESCA FRANCE','Via Don Minzoni,44 - Avigliano(PZ) - 85021'),
  (821,'','','','NAPOLI Avv. MICHELE','','avv.m.napoli@tiscali.it','97124125','NAPOLI MICHELE','C/SO GARIBALDI, 2 - POTENZA(PZ) - 85100'),
  (822,'','','','NAPOLITANO GIOIELLI DI GOLLUSCIO ROCCO S.','1531450763','golucho@alice.it','971991105','Napolitano','Corso Vittorio Emanuele,4 - Picerno(PZ) - 85055'),
  (823,'','','','NARDIELLO GERARDO','','gerardo.nardiello@yahoo.it','','NARDIELLO GERAR','Via Oscar Romero, 13 - POTENZA(PZ) - 85100'),
  (824,'asdasd','a','','a','a','a, aaa@aa.aa a asdasd','a','a','a'),
  (825,'','','sss','s','s','s','s','s','s'),
  (826,'','','','a','00121212','a','a','a','a');
COMMIT;

#
# Data for the `tb_impianto` table  (LIMIT -474,500)
#

INSERT INTO `tb_impianto` (`id`, `id_circuito1`, `id_circuito2`, `id_circuito3`, `id_serie`, `comune`, `tipo`, `formato`, `facce`, `ubicazione`, `note_ubicazione`, `cimasa`, `provenienza`, `cespite`, `note`, `proprieta`, `prezzo`, `data_scadenza`, `stato`, `data_inizio`, `link_immagine`, `addetto_manutenzione`) VALUES

  (31,7,14,6,3,'Potenza','200x100','','','Via dei Mille','','prova cimasa','','','','','10',NULL,NULL,NULL,'https://www.google.it/logos/doodles/2014/holidays-2014-day-1-5194759324827648.2-hp.gif','addetto 123'),
  (32,NULL,NULL,NULL,9,'Tito','','','','dfasdasddgaf','','','','','','','10',NULL,NULL,NULL,NULL,NULL),
  (33,7,14,NULL,5,'Matera','','','','Via prova, 22','','','','','','','10',NULL,NULL,NULL,NULL,NULL),
  (34,10,NULL,9,6,'Potenza','','','','Via serie d','','','','','','','10',NULL,NULL,NULL,NULL,NULL),
  (35,NULL,NULL,8,7,'Matera','','','','via matera xxx','','','','','','','10',NULL,NULL,NULL,NULL,NULL),
  (36,NULL,13,7,10,'Matera','','','','Via dei sassi','','','','','','','10',NULL,NULL,NULL,NULL,NULL),
  (37,NULL,13,NULL,8,'Potenza','','','','via potenza xxx','','','','','','','10',NULL,NULL,NULL,NULL,NULL),
  (38,7,NULL,NULL,4,'Potenza','','','','sasasasas','','','','','','','10',NULL,NULL,NULL,NULL,NULL),
  (43,7,NULL,NULL,NULL,'Matera','','','','Via dei mille','','','','','','','10',NULL,NULL,NULL,NULL,NULL),
  (44,7,14,NULL,NULL,'Potenza','','','','Viale Vincenzo Verrastro','','','','','','','10',NULL,NULL,NULL,NULL,NULL),
  (45,7,14,6,NULL,'Potenza','','','','Via Rocco Scotellaro','','','','','','','10',NULL,NULL,NULL,NULL,NULL),
  (46,10,NULL,9,NULL,'Matera','','','','aaaaaaaaaaaaa','','','','','','','10',NULL,NULL,NULL,NULL,NULL),
  (47,10,NULL,9,NULL,'Potenza','','','','bbbbbbbbbbbbbbbbb','','','','','','','10',NULL,NULL,NULL,NULL,NULL),
  (48,7,NULL,NULL,4,'Matera','','','','mmmmmmmmmmm','','','','','','','10',NULL,NULL,NULL,NULL,NULL),
  (49,NULL,13,NULL,NULL,'Potenza','','','','via ppppppp','','','','','','','10',NULL,NULL,NULL,NULL,NULL),
  (50,7,14,6,NULL,'Matera','','','','jjjjjjjjjjjjjjjjjj','','','','','','','10',NULL,NULL,NULL,NULL,NULL),
  (51,NULL,NULL,8,NULL,'Matera','','','','fffffffffffffffffffffffffff','','','','','','','10',NULL,NULL,NULL,NULL,NULL),
  (54,NULL,NULL,NULL,NULL,'Tito','500x200','','','solo','','aaaa','','','','','10','2014-12-04',NULL,NULL,'https://www.google.it/logos/doodles/2014/holidays-2014-day-1-5194759324827648.2-hp.gif',''),
  (55,NULL,13,7,NULL,'Tito','200x100','','','via tito','','','','','','','10',NULL,NULL,NULL,NULL,NULL),
  (56,11,NULL,NULL,NULL,'Potenza','','','','via scotellaro','','','','','','','10',NULL,NULL,NULL,NULL,NULL),
  (57,7,NULL,10,NULL,'Potenza','','','','via circuito 3 E','','','','','','','10',NULL,NULL,NULL,NULL,NULL),
  (58,10,15,NULL,NULL,'Potenza','500x200','','','via sss','','','','','','','10',NULL,NULL,NULL,NULL,NULL),
  (59,NULL,NULL,NULL,9,'Tolve','500x200','','','vicolo corto','','','','','','','10',NULL,NULL,NULL,NULL,NULL),
  (61,NULL,NULL,NULL,NULL,'Potenza','500x200','','','dsdsd','','','','','','','12','2014-12-14',NULL,'2014-12-09',NULL,NULL),
  (62,NULL,NULL,NULL,NULL,'Tito scalo','500x200 aaa','','','Prova scadenza','','','','','','','123','2014-12-17',NULL,'2014-12-01',NULL,NULL);
COMMIT;

#
# Data for the `tb_opzionato` table  (LIMIT -490,500)
#

INSERT INTO `tb_opzionato` (`id`, `id_circuito1`, `id_circuito2`, `id_circuito3`, `id_serie`, `id_impianto`, `da_data`, `a_data`, `cliente`, `id_utente`, `id_cliente`, `data_scadenza`, `prezzo`, `id_ordine`, `data`) VALUES

  (30,7,NULL,NULL,NULL,43,'2014-12-01','2014-12-15','Jetbit Srls',8,6,'2015-01-25','10',1,'2015-01-14 16:00:32'),
  (31,7,NULL,NULL,4,38,'2014-12-01','2014-12-15','Jetbit Srls',8,6,'2015-01-25','10',1,'2015-01-14 16:00:32'),
  (32,7,NULL,NULL,4,48,'2014-12-01','2014-12-15','Jetbit Srls',8,6,'2015-01-25','10',1,'2015-01-14 16:00:32'),
  (33,7,NULL,10,NULL,57,'2014-12-01','2014-12-15','Jetbit Srls',8,6,'2015-01-25','10',1,'2015-01-14 16:00:32'),
  (34,7,14,NULL,NULL,44,'2014-12-01','2014-12-15','Jetbit Srls',8,6,'2015-01-25','10',1,'2015-01-14 16:00:32'),
  (35,7,14,NULL,5,33,'2014-12-01','2014-12-15','Jetbit Srls',8,6,'2015-01-25','10',1,'2015-01-14 16:00:33'),
  (36,7,14,6,NULL,45,'2014-12-01','2014-12-15','Jetbit Srls',8,6,'2015-01-25','10',1,'2015-01-14 16:00:33'),
  (37,7,14,6,NULL,50,'2014-12-01','2014-12-15','Jetbit Srls',8,6,'2015-01-25','10',1,'2015-01-14 16:00:33'),
  (38,7,14,6,3,31,'2014-12-01','2014-12-15','Jetbit Srls',8,6,'2015-01-25','10',1,'2015-01-14 16:00:33');
COMMIT;

#
# Data for the `tb_serie` table  (LIMIT -491,500)
#

INSERT INTO `tb_serie` (`id`, `id_circuito1`, `id_circuito2`, `id_circuito3`, `codice`, `descrizione`, `note`) VALUES

  (3,7,14,6,'1','Serie A',''),
  (4,7,NULL,NULL,'2','Serie B',''),
  (5,7,14,NULL,'3','Serie C',''),
  (6,10,NULL,9,'4','Serie D',''),
  (7,NULL,NULL,8,'5','SERIE E',''),
  (8,NULL,13,NULL,'6','Serie F',''),
  (9,NULL,NULL,NULL,'7','Serie G',''),
  (10,NULL,13,7,'8','Serie H','prova note');
COMMIT;

#
# Data for the `tb_uscite` table  (LIMIT -492,500)
#

INSERT INTO `tb_uscite` (`id`, `da_data`, `a_data`, `note`) VALUES

  (3,'2014-12-01','2014-12-15','Periodo Natalizio'),
  (5,'2015-01-12','2015-01-31','Nuovo Anno'),
  (6,'2015-02-16','2015-02-22','a'),
  (7,'2015-01-02','2015-11-15','a'),
  (8,'2014-12-12','2015-01-25','a'),
  (9,'2014-12-12','2015-01-25','a'),
  (10,'2014-12-12','2014-12-25','rer');
COMMIT;

#
# Data for the `tb_utenti` table  (LIMIT -496,500)
#

INSERT INTO `tb_utenti` (`id`, `username`, `password`, `ruolo`, `nome`, `cognome`) VALUES

  (8,'admin','admin','ADMIN','Mario','Rossi'),
  (11,'user','user','USER','User','User'),
  (12,'prova','prova','ADMIN','prova','prova');
COMMIT;

#
# Data for the `tb_venduto` table  (LIMIT -489,500)
#

INSERT INTO `tb_venduto` (`id`, `id_circuito1`, `id_circuito2`, `id_circuito3`, `id_serie`, `id_impianto`, `da_data`, `a_data`, `cliente`, `id_cliente`, `id_utente`, `prezzo`, `id_ordine`, `data`) VALUES

  (176,NULL,NULL,NULL,NULL,54,'2014-12-01','2014-12-15','K2 Bar',8,8,'10',6,'2015-01-14 15:54:26'),
  (179,NULL,NULL,NULL,NULL,62,'2014-12-01','2014-12-15','K2 ',8,8,'123',7,'2015-01-14 16:13:28'),
  (180,NULL,NULL,NULL,9,32,'2014-12-01','2014-12-15','IPER FUTURA ',7,8,'10',8,'2015-01-14 16:16:07'),
  (181,NULL,NULL,NULL,9,59,'2014-12-01','2014-12-15','IPER FUTURA ',7,8,'10',8,'2015-01-14 16:16:07'),
  (182,NULL,NULL,8,NULL,51,'2014-12-12','2015-01-25','K2 ',8,8,'10',9,'2015-01-14 19:05:03'),
  (183,NULL,NULL,8,7,35,'2014-12-12','2015-01-25','K2 ',8,8,'10',9,'2015-01-14 19:05:03'),
  (184,NULL,13,NULL,NULL,49,'2014-12-01','2014-12-15','IPER FUTURA ',7,8,'10',10,'2015-01-14 19:05:33'),
  (185,NULL,13,NULL,8,37,'2014-12-01','2014-12-15','IPER FUTURA ',7,8,'10',10,'2015-01-14 19:05:33'),
  (186,NULL,13,7,NULL,55,'2014-12-01','2014-12-15','IPER FUTURA ',7,8,'10',10,'2015-01-14 19:05:33'),
  (187,NULL,13,7,10,36,'2014-12-01','2014-12-15','IPER FUTURA ',7,8,'10',10,'2015-01-14 19:05:33');
COMMIT;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;