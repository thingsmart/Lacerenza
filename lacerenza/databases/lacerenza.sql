-- phpMyAdmin SQL Dump
-- version 3.3.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: 27 mag, 2016 at 05:21 PM
-- Versione MySQL: 5.1.46
-- Versione PHP: 5.3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lacerenza`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_allegati`
--

CREATE TABLE IF NOT EXISTS `tb_allegati` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `n_sospensioni` int(11) DEFAULT NULL,
  `descrizione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `verbale_n` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `link_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `id_commessa` int(11) DEFAULT NULL,
  `file_name` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data` date DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id_commessa` (`id_commessa`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=16384 AUTO_INCREMENT=12 ;

--
-- Dump dei dati per la tabella `tb_allegati`
--

INSERT INTO `tb_allegati` (`id`, `n_sospensioni`, `descrizione`, `verbale_n`, `link_allegato`, `id_commessa`, `file_name`, `data`) VALUES
(7, 1, 'Foto', '', 'uploads/commesse/1/cantiere/collina.png', 1, 'collina.png', '2015-01-08'),
(9, 1, 'ddd', '', 'uploads/commesse/1/cantiere/cappello.png', 1, 'cappello.png', '2015-01-09'),
(10, 1, 'AAA', '', 'uploads/commesse/4/cantiere/ore_lavoro.xlsx', 4, 'ore_lavoro.xlsx', '2015-01-15'),
(11, 1, 'prova', '', 'uploads/commesse/4/cantiere/prova.rtf', 4, 'prova.rtf', '2015-01-15');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_allegati_attivita`
--

CREATE TABLE IF NOT EXISTS `tb_allegati_attivita` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_attivita` int(11) DEFAULT NULL,
  `descrizione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data_ricevuto` date DEFAULT NULL,
  `data_inviato` date DEFAULT NULL,
  `inviato_a` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `link_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id_attivita` (`id_attivita`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dump dei dati per la tabella `tb_allegati_attivita`
--


-- --------------------------------------------------------

--
-- Struttura della tabella `tb_allegati_comunicazioni`
--

CREATE TABLE IF NOT EXISTS `tb_allegati_comunicazioni` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_comunicazione` int(11) DEFAULT NULL,
  `link` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `descrizione` varchar(512) COLLATE latin1_general_ci DEFAULT NULL,
  `utente` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `file_name` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=4096 AUTO_INCREMENT=21 ;

--
-- Dump dei dati per la tabella `tb_allegati_comunicazioni`
--

INSERT INTO `tb_allegati_comunicazioni` (`id`, `id_comunicazione`, `link`, `descrizione`, `utente`, `file_name`) VALUES
(16, 7, 'uploads/comunicazioni/7/cappello - Copia.png', 'dasd', 'admin', 'cappello - Copia.png'),
(18, 8, 'uploads/comunicazioni/8/cappello.png', 'aaa', 'admin', 'cappello.png'),
(19, 5, 'uploads/comunicazioni/5/cappello.png', 'aa', 'admin', 'cappello.png'),
(20, 5, 'uploads/comunicazioni/5/fiore.png', 'bb', 'admin', 'fiore.png');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_allegati_dipendenti`
--

CREATE TABLE IF NOT EXISTS `tb_allegati_dipendenti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_dipendente` int(11) DEFAULT NULL,
  `id_commessa` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `scadenza` date DEFAULT NULL,
  `descrizione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `link_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id_dipendente` (`id_dipendente`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=8192 AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `tb_allegati_dipendenti`
--

INSERT INTO `tb_allegati_dipendenti` (`id`, `id_dipendente`, `id_commessa`, `data`, `scadenza`, `descrizione`, `link_allegato`, `nome_allegato`) VALUES
(1, 5, NULL, '2014-10-31', '2014-10-31', 'aa', 'uploads/dipendenti/5/', 'cappello - Copia.png'),
(2, 5, NULL, '2014-10-31', '2014-10-31', 'aa', 'uploads/dipendenti/5/', '31_10_2014_08_43_27cappello - Copia.png');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_allegati_gare`
--

CREATE TABLE IF NOT EXISTS `tb_allegati_gare` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descrizione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `link_file` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `filename` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `utente` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `id_gara` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `id` (`id`) USING BTREE,
  KEY `id_gara` (`id_gara`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=16384 AUTO_INCREMENT=11 ;

--
-- Dump dei dati per la tabella `tb_allegati_gare`
--

INSERT INTO `tb_allegati_gare` (`id`, `descrizione`, `link_file`, `filename`, `utente`, `id_gara`) VALUES
(10, 'fsdf', 'uploads/gare/7/', 'collina.png', 'admin', 7);

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_allegati_noleggi`
--

CREATE TABLE IF NOT EXISTS `tb_allegati_noleggi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_noleggio` int(11) DEFAULT NULL,
  `descrizione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `link_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id_noleggio` (`id_noleggio`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=16384 AUTO_INCREMENT=20 ;

--
-- Dump dei dati per la tabella `tb_allegati_noleggi`
--

INSERT INTO `tb_allegati_noleggi` (`id`, `id_noleggio`, `descrizione`, `link_allegato`, `nome_allegato`) VALUES
(19, 9, 'Contratto', 'uploads/commesse/1/noleggi/9/', 'cappello.png');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_allegati_ordini_commessa`
--

CREATE TABLE IF NOT EXISTS `tb_allegati_ordini_commessa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descrizione` varchar(512) COLLATE latin1_general_ci DEFAULT NULL,
  `data` date DEFAULT NULL,
  `id_ordine_commessa` int(11) DEFAULT NULL,
  `link_file` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `filename` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `tipologia` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `id` (`id`) USING BTREE,
  KEY `id_ordine_commessa` (`id_ordine_commessa`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=3276 AUTO_INCREMENT=15 ;

--
-- Dump dei dati per la tabella `tb_allegati_ordini_commessa`
--

INSERT INTO `tb_allegati_ordini_commessa` (`id`, `descrizione`, `data`, `id_ordine_commessa`, `link_file`, `filename`, `tipologia`) VALUES
(10, 'fattura', '2015-01-16', 14, '../uploads/commesse/1/ordini_commessa/14/cappello.png', 'cappello.png', NULL),
(11, 'DDT 123', '2015-01-17', 14, '../uploads/commesse/1/ordini_commessa/14/collina.png', 'collina.png', NULL),
(12, 'fds', '2015-01-16', 12, '../uploads/commesse/1/ordini_commessa/12/collina.png', 'collina.png', 'FATTURA'),
(13, 'ffff', '2015-01-16', 12, '../uploads/commesse/1/ordini_commessa/12/foto.png', 'foto.png', 'DDT'),
(14, 'aaa', '2015-01-28', 12, '../uploads/commesse/1/ordini_commessa/12/intro.jpg', 'intro.jpg', 'FATTURA');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_attivita`
--

CREATE TABLE IF NOT EXISTS `tb_attivita` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` int(11) DEFAULT NULL,
  `impresa_fornitrice` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `lavoro` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `importo` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `data_del` date DEFAULT NULL,
  `registrato_a` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `data_il` date DEFAULT NULL,
  `numero` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id_commessa` (`id_commessa`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=16384 AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `tb_attivita`
--

INSERT INTO `tb_attivita` (`id`, `id_commessa`, `impresa_fornitrice`, `lavoro`, `importo`, `data_del`, `registrato_a`, `data_il`, `numero`) VALUES
(1, 1, '11', '11', '1111', '2015-01-20', '11', '2015-01-20', '11');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_benzina`
--

CREATE TABLE IF NOT EXISTS `tb_benzina` (
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
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id_mezzo` (`id_mezzo`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=3276 AUTO_INCREMENT=13 ;

--
-- Dump dei dati per la tabella `tb_benzina`
--

INSERT INTO `tb_benzina` (`id`, `id_mezzo`, `n_ticket`, `localita`, `targa`, `codice_autista`, `km_veicolo`, `prodotto_servizio`, `quantita_litri`, `importo_ticket`, `prezzo_pompa`, `sconto`, `prezzo_escluso_iva`, `importo_netto`, `aliq_iva`, `importo_iva`, `totale_iva_inclusa`, `numero_carta`, `titolare_carta`, `data`) VALUES
(8, 1, NULL, 'POTENZA', 'AA123EE', '', '3181', 'Gasolio Autotrazione', '60.84', '96.01', '157.81', '3', '126.89', '77.20', '22', '16.98', '94.18', '7033161200630597', '059 IANNIELLI G.R.', '2014-09-15'),
(9, 1, NULL, '', 'AA123EE', '', '1', '', '', '', '', '', '', '', '22', '', '10', '', '', '2015-02-04'),
(10, 1, NULL, 'a', 'AA123EE', '', '100', '', '', '', '10', '', '', '', '22', '', '110', '', 'a', '2015-03-19'),
(11, 1, NULL, 'sadas', 'AA123EE', '', '29000', '', '', '', '12', '', '', '', '22', '', '12', '', 'ddd', '2015-04-10'),
(12, 2, NULL, '', '11234', '', '2000', '', '', '', '', '', '', '', '22', '', '1234', '', '', '2015-05-11');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_categorie`
--

CREATE TABLE IF NOT EXISTS `tb_categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_verbale` int(11) DEFAULT NULL,
  `descrizione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `importo` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id_verbale` (`id_verbale`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=8192 AUTO_INCREMENT=8 ;

--
-- Dump dei dati per la tabella `tb_categorie`
--

INSERT INTO `tb_categorie` (`id`, `id_verbale`, `descrizione`, `importo`) VALUES
(6, 11, 'Cat A', '1000'),
(7, 11, 'Cat B', '3000');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_commesse`
--

CREATE TABLE IF NOT EXISTS `tb_commesse` (
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
  `campo6` varchar(5) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `descrizione` (`descrizione`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=16384 AUTO_INCREMENT=10 ;

--
-- Dump dei dati per la tabella `tb_commesse`
--

INSERT INTO `tb_commesse` (`id`, `codice`, `descrizione`, `localita`, `data_inizio`, `data_fine`, `status`, `annotazioni`, `cantiere`, `importo`, `tipologia_lavori`, `referente`, `telefono`, `fax`, `cellulare`, `utente`, `campo1`, `campo2`, `campo3`, `campo4`, `campo5`, `email`, `indirizzo_referente`, `pi`, `pec`, `campo6`) VALUES
(1, '001', 'Casa della salute', 'Potenza', '2014-10-07', '2015-08-04', 1, 'asdfsd sdf asdf sdaf sdf sdf sdf asdf dsfa sdf', 'Casa della salute', '10000.21', 'Ristrutturazione', 'Condiminio via anzio', 'no', 'no', 'no', 'admin', '06', '01', '', '', 'eee', '2222', '1111', '4444', '3333', 'das'),
(4, '123', 'prova commessa 2', 'Potenza', '2014-12-10', '2015-04-01', 1, '', 'prova commessa 2', '12', '12', '12', '12', '12', '12', 'admin', '', '', '', '', '', '', '', '', '', ''),
(6, '001/16', 'Casa_Della_Salute', 'Avigliano', '2014-12-29', NULL, 0, '', 'Casa_Della_Salute', '111', 'Casa_Della_Salute', 'Casa_Della_Salute', '1', '11', '1', 'admin', '', '', '', '', '', NULL, NULL, NULL, NULL, ''),
(7, '001bis', 'ness', 'gftgg', '2015-08-06', '2015-12-31', 1, '', 'ness', NULL, NULL, NULL, NULL, NULL, NULL, 'admin', '', '', '', '', '', NULL, NULL, NULL, NULL, ''),
(8, '1', 'desc1', 'roma', '2016-01-12', NULL, 0, '', 'desc1', '1', '1', '1', '1', '1', '1', 'admin', '', '', '', '', '', '1', '1', '1', '1', ''),
(9, '123', 'test1', 'test', '2016-01-12', NULL, 0, '', 'test1', NULL, NULL, NULL, NULL, NULL, NULL, 'admin', '', '', '', '', '', NULL, NULL, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_comunicazioni`
--

CREATE TABLE IF NOT EXISTS `tb_comunicazioni` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` date DEFAULT NULL,
  `id_commessa` int(11) DEFAULT NULL,
  `descrizione_commessa` varchar(512) COLLATE latin1_general_ci DEFAULT NULL,
  `tipo_comunicazione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `destinatario` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `testo` text COLLATE latin1_general_ci,
  `note` text COLLATE latin1_general_ci,
  `utente` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `destinatario_reale` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=2730 AUTO_INCREMENT=12 ;

--
-- Dump dei dati per la tabella `tb_comunicazioni`
--

INSERT INTO `tb_comunicazioni` (`id`, `data`, `id_commessa`, `descrizione_commessa`, `tipo_comunicazione`, `destinatario`, `testo`, `note`, `utente`, `destinatario_reale`) VALUES
(5, '2015-01-12', 1, 'prova commessa 1', 'EMAIL', 'A', 'aas', '', 'admin', NULL),
(7, '2015-01-12', 4, 'prova commessa 2', 'FAX', 'sadas', 'dasdsd', 'asdasd', 'admin', NULL),
(8, '2015-01-27', 1, 'prova commessa 1', 'EMAIL', 'aaa', 'aaa', 'sss', 'admin', NULL),
(9, '2015-01-27', 6, 'Casa_Della_Salute', 'EMAIL', 'a', 'a', 'a', 'admin', NULL),
(10, '2015-02-17', 0, '', 'EMAIL', 'dasd', 'dasas', 'dasd', 'admin', 'asdsd'),
(11, '2015-02-17', 1, 'prova commessa 1', 'EMAIL', 'a', 'a', 'a', 'admin', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_contabilita`
--

CREATE TABLE IF NOT EXISTS `tb_contabilita` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` int(11) DEFAULT NULL,
  `descrizione_lavori` text COLLATE latin1_general_ci,
  `p1` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `b` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `l` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `a` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `p` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `link_allegato` varchar(512) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` varchar(512) COLLATE latin1_general_ci DEFAULT NULL,
  `prezzo` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `importo` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=8192 AUTO_INCREMENT=4 ;

--
-- Dump dei dati per la tabella `tb_contabilita`
--

INSERT INTO `tb_contabilita` (`id`, `id_commessa`, `descrizione_lavori`, `p1`, `b`, `l`, `a`, `p`, `link_allegato`, `nome_allegato`, `prezzo`, `importo`) VALUES
(2, 1, 'Computo Metrico', '2', '1', '1', '1', '3', 'uploads/commesse/1/contabilita/', '11_01_2016_11_23_02aa.jpg', '', ''),
(3, 1, '2', '1', '2', '2', '2', '2', 'uploads/commesse/1/contabilita/', '', '', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_costi`
--

CREATE TABLE IF NOT EXISTS `tb_costi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_dipendente` int(11) DEFAULT NULL,
  `data_inizio` date DEFAULT NULL,
  `data_fine` date DEFAULT NULL,
  `costo` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `mese` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `anno` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `id_commessa` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `id` (`id`) USING BTREE,
  UNIQUE KEY `tb_costi_idx1` (`mese`,`id_dipendente`,`anno`,`id_commessa`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=1820 AUTO_INCREMENT=69 ;

--
-- Dump dei dati per la tabella `tb_costi`
--

INSERT INTO `tb_costi` (`id`, `id_dipendente`, `data_inizio`, `data_fine`, `costo`, `mese`, `anno`, `id_commessa`) VALUES
(51, 12, '2015-01-01', '2015-01-31', '20', 'GENNAIO', '2015', 1),
(56, 22, '2015-01-01', '2015-01-31', '10', 'GENNAIO', '2015', -1),
(59, 22, '2015-01-01', '2015-01-31', '20', 'GENNAIO', '2015', 1),
(60, 22, '0000-00-00', '0000-00-00', '5', 'ANNUALE', '2015', -1),
(63, 22, '2015-02-01', '2015-02-28', '1', 'FEBBRAIO', '2015', -1),
(64, 5, '0000-00-00', '0000-00-00', '10', 'ANNUALE', '2015', -1),
(65, 6, '0000-00-00', '0000-00-00', '1', 'ANNUALE', '2015', -1),
(66, 12, '2016-01-01', '2016-01-31', '2', 'GENNAIO', '2016', 1),
(68, 12, '2016-01-01', '2016-01-31', '5', 'GENNAIO', '2016', 4);

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_dipendenti`
--

CREATE TABLE IF NOT EXISTS `tb_dipendenti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `cognome` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `attivo` varchar(256) COLLATE latin1_general_ci DEFAULT 'ATTIVO',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=341 AUTO_INCREMENT=55 ;

--
-- Dump dei dati per la tabella `tb_dipendenti`
--

INSERT INTO `tb_dipendenti` (`id`, `nome`, `cognome`, `attivo`) VALUES
(5, 'Mario', 'Rossi&#39;', 'ATTIVO'),
(6, 'Franco', 'Bianchi', 'IMPIEGATO'),
(7, 'Rocco', 'Verdi', 'ATTIVO'),
(8, 'Luca', 'Liscio', 'ATTIVO'),
(9, 'Franca', 'Salvia', 'ATTIVO'),
(10, 'Maria', 'Ianni', 'IMPIEGATO'),
(11, 'prova terzo', 'terzo', 'TERZI'),
(12, '1', '1', 'NON_ATTIVO'),
(13, '2', '2', 'ATTIVO'),
(14, '3', '3', 'ATTIVO'),
(15, '4', '4', 'ATTIVO'),
(16, '5', '5', 'ATTIVO'),
(17, '6', '6', 'ATTIVO'),
(18, '7', '7', 'ATTIVO'),
(19, '8', '8', 'ATTIVO'),
(20, '9', '9', 'ATTIVO'),
(21, '10', '10', 'ATTIVO'),
(22, '11', '11', 'ATTIVO'),
(23, '12', '12', 'ATTIVO'),
(24, '13', '13', 'ATTIVO'),
(25, '14', '14', 'ATTIVO'),
(26, '15', '15', 'ATTIVO'),
(27, '16', '16', 'ATTIVO'),
(28, '17', '17', 'ATTIVO'),
(29, '18', '18', 'ATTIVO'),
(30, '19', '19', 'ATTIVO'),
(31, '20', '20', 'ATTIVO'),
(32, '21', '21', 'ATTIVO'),
(33, '22', '22', 'ATTIVO'),
(34, '23', '23', 'ATTIVO'),
(35, '24', '24', 'ATTIVO'),
(36, '25', '25', 'ATTIVO'),
(37, '26', '26', 'ATTIVO'),
(38, '27', '27', 'ATTIVO'),
(39, '28', '28', 'ATTIVO'),
(40, '29', '29', 'ATTIVO'),
(41, '30', '30', 'ATTIVO'),
(42, '31', '31', 'ATTIVO'),
(44, '32', '32', 'ATTIVO'),
(45, '33', '33', 'ATTIVO'),
(46, '34', '34', 'ATTIVO'),
(47, '35', '35', 'ATTIVO'),
(48, '36', '36', 'ATTIVO'),
(49, '37', '37', 'ATTIVO'),
(50, '38', '38', 'ATTIVO'),
(51, '39', '39', 'ATTIVO'),
(52, '40', '40', 'ATTIVO'),
(53, '25%', 'Gasolio', 'TERZI'),
(54, 'Jetbit', 'Jetbit', 'ATTIVO');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_documentazione`
--

CREATE TABLE IF NOT EXISTS `tb_documentazione` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `descrizione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `link_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id_commessa` (`id_commessa`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=8192 AUTO_INCREMENT=12 ;

--
-- Dump dei dati per la tabella `tb_documentazione`
--

INSERT INTO `tb_documentazione` (`id`, `id_commessa`, `data`, `descrizione`, `link_allegato`, `nome_allegato`) VALUES
(10, 1, '2014-10-08', 'Doc 1', 'uploads/commesse/1/documentazioni/', 'prova.pdf'),
(11, 1, '2014-10-06', 'Doc 2', 'uploads/commesse/1/documentazioni/', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_documenti_cliente`
--

CREATE TABLE IF NOT EXISTS `tb_documenti_cliente` (
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
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id_commessa` (`id_commessa`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=16384 AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `tb_documenti_cliente`
--

INSERT INTO `tb_documenti_cliente` (`id`, `id_commessa`, `descrizione`, `ente_rilascio`, `data`, `validita`, `scadenza`, `rinnovo`, `link_allegato`, `nome_allegato`) VALUES
(1, 1, 'Lorem ipsum', 'Comune di Avigliano', '2014-10-08', '0000-00-00', '0000-00-00', '0000-00-00', 'uploads/commesse/1/documenti_cliente/', 'prova.pdf');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_fattura`
--

CREATE TABLE IF NOT EXISTS `tb_fattura` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` int(11) DEFAULT NULL,
  `tipo_documento` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `descrizione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `importo_totale` double(15,2) DEFAULT NULL,
  `data_pagamento` date DEFAULT NULL,
  `data_incasso` date DEFAULT NULL,
  `link_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id_commessa` (`id_commessa`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=8192 AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `tb_fattura`
--

INSERT INTO `tb_fattura` (`id`, `id_commessa`, `tipo_documento`, `descrizione`, `importo_totale`, `data_pagamento`, `data_incasso`, `link_allegato`, `nome_allegato`) VALUES
(1, 1, 'Fattura', 'Lorem Ipsum', 500.00, '2014-10-06', '2014-10-08', 'uploads/commesse/1/fatture/', 'prova.pdf'),
(2, 1, '1', '1', 100.00, '2014-10-23', '0000-00-00', 'uploads/commesse/1/fatture/', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_fattura_materiali_esterni`
--

CREATE TABLE IF NOT EXISTS `tb_fattura_materiali_esterni` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` int(11) DEFAULT NULL,
  `tipo_documento` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `descrizione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `importo_totale` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `data_pagamento` date DEFAULT NULL,
  `data_incasso` date DEFAULT NULL,
  `link_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `note` text COLLATE latin1_general_ci,
  `tipologia` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id_commessa_materiali_esterni` (`id_commessa`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=8192 AUTO_INCREMENT=11 ;

--
-- Dump dei dati per la tabella `tb_fattura_materiali_esterni`
--

INSERT INTO `tb_fattura_materiali_esterni` (`id`, `id_commessa`, `tipo_documento`, `descrizione`, `importo_totale`, `data_pagamento`, `data_incasso`, `link_allegato`, `nome_allegato`, `note`, `tipologia`) VALUES
(3, 1, 'MANODOPERA', 'a', '12.00', '2015-02-13', '0000-00-00', '', '', NULL, NULL),
(4, 1, 'MATERIALE', '1', '3.6', '2015-02-15', '0000-00-00', 'uploads/commesse/1/fatture_materiali_esterni/', 'VAIO 11 img1 Wallpaper 1366x768.jpg', '', 'cap'),
(5, 1, 'MANODOPERA', 'a', '234', '2015-02-17', '0000-00-00', 'uploads/commesse/1/fatture_materiali_esterni/', '', 'asd asd d', NULL),
(6, 1, 'MANODOPERA', 'sas', '12', '2015-02-21', '0000-00-00', 'uploads/commesse/1/fatture_materiali_esterni/', '', '', 'imp'),
(7, 1, 'MATERIALE', 'test', '1', '2015-02-16', '0000-00-00', 'uploads/commesse/1/fatture_materiali_esterni/', '', '', 'cap'),
(8, 1, 'MATERIALE', '1', '3', '2015-02-17', '0000-00-00', 'uploads/commesse/1/fatture_materiali_esterni/', '', '', 'cap'),
(9, 1, 'MATERIALE', 'a', '1', '2015-02-21', '0000-00-00', 'uploads/commesse/1/fatture_materiali_esterni/', '', '', 'cap'),
(10, 1, 'MATERIALE', 'a', '1', '2015-02-20', '0000-00-00', 'uploads/commesse/1/fatture_materiali_esterni/', '', '', 'cap');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_fatture_ral`
--

CREATE TABLE IF NOT EXISTS `tb_fatture_ral` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ral` int(11) DEFAULT NULL,
  `descrizione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `importo` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `link_allegato` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `note` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data` date DEFAULT NULL,
  `utente` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id_ral` (`id_ral`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=8192 AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `tb_fatture_ral`
--

INSERT INTO `tb_fatture_ral` (`id`, `id_ral`, `descrizione`, `importo`, `link_allegato`, `nome_allegato`, `note`, `data`, `utente`) VALUES
(1, 1, '1', '1234', '', '', '', '2015-01-20', 'admin');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_gara`
--

CREATE TABLE IF NOT EXISTS `tb_gara` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descrizione` text COLLATE latin1_general_ci,
  `data_emissione` date DEFAULT NULL,
  `data_scadenza` date DEFAULT NULL,
  `polizze` varchar(512) COLLATE latin1_general_ci DEFAULT NULL,
  `avcp` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `passoe` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `utente` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=16384 AUTO_INCREMENT=8 ;

--
-- Dump dei dati per la tabella `tb_gara`
--

INSERT INTO `tb_gara` (`id`, `descrizione`, `data_emissione`, `data_scadenza`, `polizze`, `avcp`, `passoe`, `utente`) VALUES
(7, '2', '2015-01-15', '2015-01-15', '2', '2', '2', 'admin');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_impostazioni`
--

CREATE TABLE IF NOT EXISTS `tb_impostazioni` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` date DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `id` (`id`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=8 ROW_FORMAT=FIXED AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `tb_impostazioni`
--

INSERT INTO `tb_impostazioni` (`id`, `data`) VALUES
(2, '2012-01-12');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_lavoro`
--

CREATE TABLE IF NOT EXISTS `tb_lavoro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cod_lavoro` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `descrizione` text COLLATE latin1_general_ci,
  `attivita` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `lavorazione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=8192 AUTO_INCREMENT=9 ;

--
-- Dump dei dati per la tabella `tb_lavoro`
--

INSERT INTO `tb_lavoro` (`id`, `cod_lavoro`, `descrizione`, `attivita`, `lavorazione`) VALUES
(5, '1', '', 'verifica del massetto esistente', 'IMPERMEABILIZZAZIONI scheda n. 01'),
(8, '1', '', 'demolizione del pavimento esistente', 'PAVIMENTAZIONI TERRAZZI scheda n. 02');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_libretto`
--

CREATE TABLE IF NOT EXISTS `tb_libretto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_mezzo` int(11) DEFAULT NULL,
  `descrizione` varchar(512) COLLATE latin1_general_ci DEFAULT NULL,
  `data` date DEFAULT NULL,
  `allegato` varchar(512) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `id` (`id`) USING BTREE,
  KEY `id_mezzo` (`id_mezzo`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=16384 AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `tb_libretto`
--

INSERT INTO `tb_libretto` (`id`, `id_mezzo`, `descrizione`, `data`, `allegato`) VALUES
(2, 1, 'ok', '2015-02-17', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_log`
--

CREATE TABLE IF NOT EXISTS `tb_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `operazione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `utente` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data_inserimento` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `colore` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=148 AUTO_INCREMENT=2953 ;

--
-- Dump dei dati per la tabella `tb_log`
--

INSERT INTO `tb_log` (`id`, `operazione`, `utente`, `data_inserimento`, `colore`) VALUES
(2843, 'Inserimento programmazione giornaliera cantiere', 'admin', '2015-10-30 10:30:57', 'verde'),
(2844, 'Inserimento ruolino giornaliero', 'admin', '2015-10-30 10:32:43', 'verde'),
(2845, 'Inserimento ruolino giornaliero', 'admin', '2015-10-30 10:40:59', 'verde'),
(2846, 'Modifica ruolino giornaliero', 'admin', '2015-10-30 10:47:06', 'verde'),
(2847, 'Inserimento ruolino giornaliero', 'admin', '2015-11-06 09:17:02', 'verde'),
(2848, 'Inserimento fattura', 'admin', '2015-11-06 17:17:17', 'verde'),
(2849, 'Inserimento fattura', 'admin', '2015-11-06 17:17:48', 'verde'),
(2850, 'Modifica fattura', 'admin', '2015-11-06 17:18:02', 'blu'),
(2851, 'Modifica fattura', 'admin', '2015-11-06 17:18:42', 'blu'),
(2852, 'Inserimento fattura', 'admin', '2015-11-06 17:19:17', 'verde'),
(2853, 'Modifica fattura', 'admin', '2015-11-06 17:20:11', 'blu'),
(2854, 'Modifica fattura', 'admin', '2015-11-06 17:20:40', 'blu'),
(2855, 'Inserimento fattura', 'admin', '2015-11-06 17:21:39', 'verde'),
(2856, 'Modifica fattura', 'admin', '2015-11-06 17:21:47', 'blu'),
(2857, 'Modifica commessa', 'admin', '2015-11-24 11:26:39', 'blu'),
(2858, 'Eliminazione contabilit&agrave;: id=1', 'admin', '2016-01-08 09:41:21', 'rosso'),
(2859, 'Inserimento contabilita per commessa 1 | id inserito=2', 'admin', '2016-01-08 10:04:09', 'verde'),
(2860, 'Modifica contabilita per commessa 1', 'admin', '2016-01-08 10:07:22', 'blu'),
(2861, 'Modifica contabilita per commessa 1', 'admin', '2016-01-08 10:07:57', 'blu'),
(2862, 'Modifica contabilita per commessa 1', 'admin', '2016-01-08 10:08:44', 'blu'),
(2863, 'Inserimento contabilita per commessa 1 | id inserito=3', 'admin', '2016-01-08 10:08:54', 'verde'),
(2864, 'Modifica contabilita per commessa 1', 'admin', '2016-01-08 10:09:31', 'blu'),
(2865, 'Inserimento contabilita per commessa 1 | id inserito=4', 'admin', '2016-01-08 10:09:46', 'verde'),
(2866, 'Eliminazione allegato contabilita: ', 'admin', '2016-01-08 10:09:52', 'rosso'),
(2867, 'Eliminazione allegato contabilita: ', 'admin', '2016-01-08 10:10:31', 'rosso'),
(2868, 'Eliminazione allegato contabilita: aa.jpg', 'admin', '2016-01-08 10:12:18', 'rosso'),
(2869, 'Modifica contabilita per commessa 1', 'admin', '2016-01-08 10:12:39', 'blu'),
(2870, 'Eliminazione allegato contabilita: codice71_logo-harley-davidson.jpg', 'admin', '2016-01-08 10:12:48', 'rosso'),
(2871, 'Modifica contabilita per commessa 1', 'admin', '2016-01-08 10:13:07', 'blu'),
(2872, 'Modifica contabilita per commessa 1', 'admin', '2016-01-08 10:14:25', 'blu'),
(2873, 'Modifica contabilita per commessa 1', 'admin', '2016-01-08 10:16:45', 'blu'),
(2874, 'Inserimento contabilita per commessa 1 | id inserito=5', 'admin', '2016-01-08 10:17:05', 'verde'),
(2875, 'Eliminazione contabilit&agrave;: id=5', 'admin', '2016-01-08 10:17:22', 'rosso'),
(2876, 'Inserimento contabilita per commessa 1 | id inserito=6', 'admin', '2016-01-08 10:17:28', 'verde'),
(2877, 'Eliminazione contabilit&agrave;: id=4', 'admin', '2016-01-08 10:17:32', 'rosso'),
(2878, 'Eliminazione contabilit&agrave;: id=6', 'admin', '2016-01-08 10:17:34', 'rosso'),
(2879, 'Modifica contabilita per commessa 1', 'admin', '2016-01-08 10:17:37', 'blu'),
(2880, 'Modifica contabilita per commessa 1', 'admin', '2016-01-08 10:17:39', 'blu'),
(2881, 'Modifica contabilita per commessa 1', 'admin', '2016-01-08 10:18:17', 'blu'),
(2882, 'Eliminazione allegato contabilita: aa.jpg', 'admin', '2016-01-08 10:18:50', 'rosso'),
(2883, 'Modifica contabilita per commessa 1', 'admin', '2016-01-08 10:18:56', 'blu'),
(2884, 'Modifica contabilita per commessa 1', 'admin', '2016-01-08 11:49:17', 'blu'),
(2885, 'Inserimento contabilita per commessa 1 | id inserito=7', 'admin', '2016-01-08 11:49:42', 'verde'),
(2886, 'Modifica contabilita per commessa 1', 'admin', '2016-01-08 11:52:45', 'blu'),
(2887, 'Modifica contabilita per commessa 1', 'admin', '2016-01-08 11:52:50', 'blu'),
(2888, 'Eliminazione contabilit&agrave;: id=7', 'admin', '2016-01-08 11:53:06', 'rosso'),
(2889, 'Inserimento manutenzione 2016-01-1', 'admin', '2016-01-08 12:28:32', 'verde'),
(2890, 'Inserimento manutenzione 2016-01-1', 'admin', '2016-01-08 12:29:49', 'verde'),
(2891, 'Inserimento manutenzione 2016-02-1', 'admin', '2016-01-08 12:31:07', 'verde'),
(2892, 'Inserimento magazzino', 'admin', '2016-01-08 12:36:50', 'verde'),
(2893, 'Inserimento merce magazzino', 'admin', '2016-01-08 12:36:58', 'verde'),
(2894, 'Inserimento merce magazzino', 'admin', '2016-01-08 12:37:03', 'verde'),
(2895, 'Modifica contabilita per commessa 1', 'admin', '2016-01-11 11:15:53', 'blu'),
(2896, 'Modifica contabilita per commessa 1', 'admin', '2016-01-11 11:16:01', 'blu'),
(2897, 'Modifica contabilita per commessa 1', 'admin', '2016-01-11 11:16:04', 'blu'),
(2898, 'Modifica contabilita per commessa 1', 'admin', '2016-01-11 11:16:17', 'blu'),
(2899, 'Modifica contabilita per commessa 1', 'admin', '2016-01-11 11:17:35', 'blu'),
(2900, 'Modifica contabilita per commessa 1', 'admin', '2016-01-11 11:17:55', 'blu'),
(2901, 'Modifica contabilita per commessa 1', 'admin', '2016-01-11 11:21:01', 'blu'),
(2902, 'Modifica contabilita per commessa 1', 'admin', '2016-01-11 11:21:03', 'blu'),
(2903, 'Eliminazione allegato contabilita: codice71_logo-harley-davidson.jpg', 'admin', '2016-01-11 11:21:07', 'rosso'),
(2904, 'Modifica contabilita per commessa 1', 'admin', '2016-01-11 11:21:14', 'blu'),
(2905, 'Modifica contabilita per commessa 1', 'admin', '2016-01-11 11:21:18', 'blu'),
(2906, 'Eliminazione allegato contabilita: bb_email.png', 'admin', '2016-01-11 11:21:31', 'rosso'),
(2907, 'Modifica contabilita per commessa 1', 'admin', '2016-01-11 11:21:34', 'blu'),
(2908, 'Eliminazione allegato contabilita: bb_email.png', 'admin', '2016-01-11 11:22:05', 'rosso'),
(2909, 'Modifica contabilita per commessa 1', 'admin', '2016-01-11 11:22:08', 'blu'),
(2910, 'Modifica contabilita per commessa 1', 'admin', '2016-01-11 11:22:13', 'blu'),
(2911, 'Modifica contabilita per commessa 1', 'admin', '2016-01-11 11:22:50', 'blu'),
(2912, 'Modifica contabilita per commessa 1', 'admin', '2016-01-11 11:22:52', 'blu'),
(2913, 'Eliminazione allegato contabilita: bb_email.png', 'admin', '2016-01-11 11:22:59', 'rosso'),
(2914, 'Modifica contabilita per commessa 1', 'admin', '2016-01-11 11:23:02', 'blu'),
(2915, 'Modifica contabilita per commessa 1', 'admin', '2016-01-11 11:31:32', 'blu'),
(2916, 'Inserimento contabilita per commessa 1 | id inserito=4', 'admin', '2016-01-11 11:31:38', 'verde'),
(2917, 'Eliminazione contabilit&agrave;: id=4', 'admin', '2016-01-11 11:31:41', 'rosso'),
(2918, 'Modifica commessa', 'a', '2016-01-11 18:09:17', 'blu'),
(2919, 'Modifica commessa', 'a', '2016-01-11 18:10:33', 'blu'),
(2920, 'Modifica commessa', 'a', '2016-01-11 18:10:50', 'blu'),
(2921, 'Modifica contabilita per commessa 1', 'admin', '2016-01-12 09:23:38', 'blu'),
(2922, 'Modifica contabilita per commessa 1', 'admin', '2016-01-12 09:27:04', 'blu'),
(2923, 'Modifica contabilita per commessa 1', 'admin', '2016-01-12 09:27:10', 'blu'),
(2924, 'Modifica contabilita per commessa 1', 'admin', '2016-01-12 09:27:36', 'blu'),
(2925, 'Modifica contabilita per commessa 1', 'admin', '2016-01-12 09:28:23', 'blu'),
(2926, 'Modifica contabilita per commessa 1', 'admin', '2016-01-12 09:28:42', 'blu'),
(2927, 'Modifica contabilita per commessa 1', 'admin', '2016-01-12 09:55:16', 'blu'),
(2928, 'Modifica commessa', 'admin', '2016-01-12 09:58:35', 'blu'),
(2929, 'Modifica commessa', 'admin', '2016-01-12 10:28:48', 'blu'),
(2930, 'Modifica commessa', 'admin', '2016-01-12 10:28:57', 'blu'),
(2931, 'Inserimento commessa', 'admin', '2016-01-12 11:30:14', 'verde'),
(2932, 'Modifica commessa', 'admin', '2016-01-12 11:35:20', 'blu'),
(2933, 'Modifica commessa', 'admin', '2016-01-12 11:35:27', 'blu'),
(2934, 'Modifica Cantiere', 'admin', '2016-01-12 11:36:03', 'blu'),
(2935, 'Modifica commessa', 'admin', '2016-01-12 11:36:15', 'blu'),
(2936, 'Inserimento commessa', 'admin', '2016-01-12 11:36:35', 'verde'),
(2937, 'Modifica commessa', 'admin', '2016-01-12 12:00:38', 'blu'),
(2938, 'Modifica commessa', 'admin', '2016-01-12 12:00:48', 'blu'),
(2939, 'Modifica commessa', 'admin', '2016-01-12 12:01:15', 'blu'),
(2940, 'Inserimento programmazione giornaliera cantiere', 'admin', '2016-01-12 12:27:40', 'verde'),
(2941, 'Modifica commessa', 'admin', '2016-01-12 12:27:50', 'blu'),
(2942, 'Modifica commessa', 'admin', '2016-01-12 12:29:11', 'blu'),
(2943, 'Inserimento ruolino giornaliero', 'admin', '2016-01-12 12:29:37', 'verde'),
(2944, 'Modifica commessa', 'admin', '2016-01-12 12:29:53', 'blu'),
(2945, 'Inserimento magazzino', 'admin', '2016-01-12 12:30:29', 'verde'),
(2946, 'Modifica commessa', 'admin', '2016-01-12 12:30:35', 'blu'),
(2947, 'Modifica commessa', 'admin', '2016-01-12 12:33:38', 'blu'),
(2948, 'Modifica commessa', 'admin', '2016-01-12 12:33:58', 'blu'),
(2949, 'Modifica commessa', 'admin', '2016-01-12 12:50:32', 'blu'),
(2950, 'Inserimento costo', 'admin', '2016-02-09 11:39:29', 'verde'),
(2951, 'Inserimento costo', 'admin', '2016-02-09 11:39:32', 'verde'),
(2952, 'Inserimento costo', 'admin', '2016-02-09 11:39:38', 'verde');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_magazzino`
--

CREATE TABLE IF NOT EXISTS `tb_magazzino` (
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
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dump dei dati per la tabella `tb_magazzino`
--


-- --------------------------------------------------------

--
-- Struttura della tabella `tb_manutenzione`
--

CREATE TABLE IF NOT EXISTS `tb_manutenzione` (
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
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=1092 AUTO_INCREMENT=23 ;

--
-- Dump dei dati per la tabella `tb_manutenzione`
--

INSERT INTO `tb_manutenzione` (`id`, `data`, `id_mezzo`, `mezzo`, `utente`, `libretto`, `assicurazione`, `olio_cambio`, `olio_motore`, `estintori`, `pneumatici`, `elettrico`, `triangolo`, `giubbino`, `vetri`, `pronto_soccorso`, `carrozzeria`, `freni`, `luci`, `tergicristalli`, `indicatori`, `climatizzatore`, `altro`, `note`) VALUES
(5, '2015-02-04', 1, 'Clio', 'admin', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 1, 0, 'prova NOTE'),
(7, '2015-02-04', 2, 'Altro', 'admin', 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'jj'),
(8, '2015-02-04', 1, 'Clio', 'admin', 1, 1, 1, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 'kjkhjkk'),
(9, '2015-02-04', 2, 'Altro', 'admin', 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 1, ''),
(10, '2015-02-04', 2, 'Altro', 'admin', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, ''),
(11, '2015-01-01', 2, 'Altro', 'admin', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'rrr'),
(12, '2015-03-01', 2, 'Altro', 'admin', 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 'rtrte'),
(13, '2015-02-01', 3, 'a', 'admin', 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 0, 0, 0, 'ok'),
(16, '2015-03-01', 1, 'Clio', 'admin', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 1, 0, 'prova NOTE'),
(17, '2015-04-01', 1, 'Clio', 'admin', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 1, 0, 'prova NOTE'),
(18, '2014-12-01', 1, 'Clio', 'admin', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'asas'),
(19, '2015-01-01', 1, 'Clio', 'admin', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'asas'),
(20, '2016-01-01', 0, '', 'admin', 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, ''),
(21, '2016-01-01', 1, 'Clio', 'admin', 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 1, 0, 1, 0, 0, 'a1'),
(22, '2016-02-01', 1, 'Clio', 'admin', 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 1, 0, 1, 0, 0, 'a1');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_materiale`
--

CREATE TABLE IF NOT EXISTS `tb_materiale` (
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
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id_commessa` (`id_commessa`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=8192 AUTO_INCREMENT=11 ;

--
-- Dump dei dati per la tabella `tb_materiale`
--

INSERT INTO `tb_materiale` (`id`, `id_commessa`, `tipo_materiale`, `fornitore`, `costo`, `quantita`, `data`, `link_allegato`, `nome_allegato`, `importo`) VALUES
(9, 1, 'Cemento', 'Prova', '100', '2', '2014-10-09', 'uploads/commesse/1/materiali/', 'cappello.png', '200'),
(10, 1, 'a', 'a', '12.12', '3', '2014-12-10', 'uploads/commesse/1/materiali/', '', '36.36');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_mezzi`
--

CREATE TABLE IF NOT EXISTS `tb_mezzi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mezzo` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `targa` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `km_percorsi` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data_ultimo_aggiornamento_km` date DEFAULT NULL,
  `tagliando_ogni` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `km_ultimo_tagliando` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `costo_totale` double(15,2) DEFAULT '0.00',
  `venduto` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=2048 AUTO_INCREMENT=9 ;

--
-- Dump dei dati per la tabella `tb_mezzi`
--

INSERT INTO `tb_mezzi` (`id`, `mezzo`, `targa`, `km_percorsi`, `data_ultimo_aggiornamento_km`, `tagliando_ogni`, `km_ultimo_tagliando`, `costo_totale`, `venduto`) VALUES
(1, 'Clio', 'AA123EE', '30000', '2015-01-21', '0', NULL, 0.00, 'IN_POSSESSO'),
(2, 'Altro', '11234', '2000', '2015-01-09', '0', NULL, 0.00, 'IN_POSSESSO'),
(3, 'a', 'a', '1', '2015-01-20', '11', NULL, 0.00, 'IN_POSSESSO'),
(4, 'furgone', 'AA123DD', '1234', '2015-01-20', '123454', NULL, 0.00, 'IN_POSSESSO'),
(5, 'furgone 2', 'aaa', '1234', '2015-01-21', '0', NULL, 0.00, 'IN_POSSESSO'),
(6, 'qqq', 'qqqq', '123', '2015-01-23', '0', NULL, 0.00, 'VENDUTO'),
(7, 'www', 'www', '123', '2015-01-23', '0', NULL, 0.00, 'VENDUTO'),
(8, 'aa', 'aa', '12', '2015-02-17', '0', NULL, 0.00, 'IN_POSSESSO');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_modello`
--

CREATE TABLE IF NOT EXISTS `tb_modello` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_modello_master` int(11) NOT NULL,
  `id_sezione` int(11) NOT NULL,
  `posizione` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=77 ;

--
-- Dump dei dati per la tabella `tb_modello`
--

INSERT INTO `tb_modello` (`id`, `id_modello_master`, `id_sezione`, `posizione`) VALUES
(60, 1, 28, 3),
(61, 1, 28, 1),
(64, 7, 28, 1),
(67, 7, 29, 0),
(74, 1, 29, 0),
(75, 1, 29, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_modello_master`
--

CREATE TABLE IF NOT EXISTS `tb_modello_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titolo` varchar(512) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=8 ;

--
-- Dump dei dati per la tabella `tb_modello_master`
--

INSERT INTO `tb_modello_master` (`id`, `titolo`) VALUES
(1, 'Preventivo Base'),
(7, 'Preventivo Easy');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_noleggi`
--

CREATE TABLE IF NOT EXISTS `tb_noleggi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` int(11) DEFAULT NULL,
  `numero` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `descrizione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `importo` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `fornitore` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `data` date DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id_commessa` (`id_commessa`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=16384 AUTO_INCREMENT=10 ;

--
-- Dump dei dati per la tabella `tb_noleggi`
--

INSERT INTO `tb_noleggi` (`id`, `id_commessa`, `numero`, `descrizione`, `importo`, `fornitore`, `data`) VALUES
(9, 1, '123', 'AUTO', '100', 'FIAT', '2014-10-08');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_ordini`
--

CREATE TABLE IF NOT EXISTS `tb_ordini` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` int(11) DEFAULT NULL,
  `descrizione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `link_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id_commessa` (`id_commessa`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=16384 AUTO_INCREMENT=7 ;

--
-- Dump dei dati per la tabella `tb_ordini`
--

INSERT INTO `tb_ordini` (`id`, `id_commessa`, `descrizione`, `link_allegato`, `nome_allegato`) VALUES
(6, 1, 'Ordine 1', 'uploads/commesse/1/ordini/', 'cappello.png');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_ordini_commessa`
--

CREATE TABLE IF NOT EXISTS `tb_ordini_commessa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` int(11) DEFAULT NULL,
  `cod_commessa` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `descrizione_commessa` varchar(512) COLLATE latin1_general_ci DEFAULT NULL,
  `fornitore` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `utente` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=4096 AUTO_INCREMENT=16 ;

--
-- Dump dei dati per la tabella `tb_ordini_commessa`
--

INSERT INTO `tb_ordini_commessa` (`id`, `id_commessa`, `cod_commessa`, `descrizione_commessa`, `fornitore`, `utente`) VALUES
(12, 1, '12/01', 'prova commessa 1', 'Jetbit', NULL),
(13, 1, '12/01', 'prova commessa 1', 'K2', NULL),
(14, 1, '12/01', 'prova commessa 1', 'prova', NULL),
(15, 1, '12/01', 'prova commessa 1', 'dasd', 'admin');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_personale`
--

CREATE TABLE IF NOT EXISTS `tb_personale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` int(11) DEFAULT NULL,
  `id_dipendente` int(11) DEFAULT NULL,
  `nome` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `cognome` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `costo_h` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `tb_personale_idx1` (`id_commessa`,`id_dipendente`) USING BTREE,
  KEY `id_commessa` (`id_commessa`) USING BTREE,
  KEY `id_dipendente` (`id_dipendente`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dump dei dati per la tabella `tb_personale`
--


-- --------------------------------------------------------

--
-- Struttura della tabella `tb_polizza`
--

CREATE TABLE IF NOT EXISTS `tb_polizza` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` int(11) DEFAULT NULL,
  `descrizione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data_stipula` date DEFAULT NULL,
  `scadenza` date DEFAULT NULL,
  `importo` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `link_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `polizza_svincolata` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id_commessa` (`id_commessa`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=8192 AUTO_INCREMENT=4 ;

--
-- Dump dei dati per la tabella `tb_polizza`
--

INSERT INTO `tb_polizza` (`id`, `id_commessa`, `descrizione`, `data_stipula`, `scadenza`, `importo`, `link_allegato`, `nome_allegato`, `polizza_svincolata`) VALUES
(2, 1, 'Lorem ipsum', '2014-10-08', '2014-10-08', '5000', 'uploads/commesse/1/polizze/', 'prova.pdf', 'SI'),
(3, 1, 'Lorem ipsum', '2014-10-08', '2014-10-08', '3000', 'uploads/commesse/1/polizze/', '', 'NO');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_presenze`
--

CREATE TABLE IF NOT EXISTS `tb_presenze` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_dipendente` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `dettagli` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `n_ore` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `n_giorni` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `id_commessa` int(11) DEFAULT NULL,
  `costo` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `tb_presenze_idx1` (`id_dipendente`,`id_commessa`,`data`,`dettagli`) USING BTREE,
  KEY `id_dipendente` (`id_dipendente`) USING BTREE,
  KEY `id_commessa` (`id_commessa`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=16384 AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `tb_presenze`
--

INSERT INTO `tb_presenze` (`id`, `id_dipendente`, `data`, `dettagli`, `n_ore`, `n_giorni`, `id_commessa`, `costo`) VALUES
(1, 5, '2015-01-09', '', '6', NULL, 1, '');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_preventivo`
--

CREATE TABLE IF NOT EXISTS `tb_preventivo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_prev_master` int(11) NOT NULL,
  `id_sezione` int(11) NOT NULL,
  `costo` varchar(512) COLLATE latin1_general_ci NOT NULL,
  `link_file` varchar(512) COLLATE latin1_general_ci NOT NULL,
  `filename` varchar(512) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dump dei dati per la tabella `tb_preventivo`
--


-- --------------------------------------------------------

--
-- Struttura della tabella `tb_preventivo_master`
--

CREATE TABLE IF NOT EXISTS `tb_preventivo_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_modello_master` int(11) NOT NULL,
  `num_preventivo` varchar(512) COLLATE latin1_general_ci NOT NULL,
  `cliente` varchar(512) COLLATE latin1_general_ci NOT NULL,
  `data_preventivo` date NOT NULL,
  `descrizione` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `tb_preventivo_master`
--

INSERT INTO `tb_preventivo_master` (`id`, `id_modello_master`, `num_preventivo`, `cliente`, `data_preventivo`, `descrizione`) VALUES
(1, 7, '123/TT', 'Cliente', '2016-05-26', 'Lorem Ipsum'),
(2, 1, '1111', 'Jetbit Digital Agency', '2016-05-27', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_programmazione_cantiere`
--

CREATE TABLE IF NOT EXISTS `tb_programmazione_cantiere` (
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
  `tipologia_lavoro` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=174 AUTO_INCREMENT=148 ;

--
-- Dump dei dati per la tabella `tb_programmazione_cantiere`
--

INSERT INTO `tb_programmazione_cantiere` (`id`, `id_commessa`, `cod_commessa`, `descrizione_commessa`, `cod_lavoro`, `descrizione_lavoro`, `id_dipendenti`, `addetti`, `id_mezzo`, `mezzo`, `note`, `data`, `utente`, `id_lavoro`, `tipologia_lavoro`) VALUES
(14, 1, '12/12', 'Casa della salute', '12/12', 'prova', '5 ', ' Mario Rossi', 1, 'Clio', 'adasffasdf', '2015-01-07', 'admin', 1, NULL),
(21, 6, '001', 'Casa_Della_Salute', '12', '21', '5 ,8 ', ' Mario Rossi, Luca Liscio', 1, 'Clio', '2', '2015-01-07', 'admin', 12, NULL),
(22, 6, '001', 'Casa_Della_Salute', '2', 'Rasatura', '5 ,6 ', ' Mario Rossi, Franco Bianchi', 1, 'Clio', 'prova note', '2015-01-07', 'admin', 2, NULL),
(23, 6, '001', 'Casa_Della_Salute', '', '', '8 ', ' Luca Liscio', 1, 'Clio', '', '2015-01-08', 'admin', 0, NULL),
(25, 6, '001', 'Casa_Della_Salute', '', '', '5 ,7 ', ' Rossi Mario, Verdi Rocco', 1, 'Clio', 'qqqq', '2015-01-12', 'admin', 0, NULL),
(27, 6, '001', 'Casa_Della_Salute', '', '', '6 ,10 ', ' Bianchi Franco, Ianni Maria', 1, 'Clio', '', '2015-01-14', 'admin', -1, NULL),
(28, 4, '123', 'prova commessa 2', '', '', '6 ,11 ', ' Bianchi Franco, terzo prova terzo', 2, 'Altro', 'aa', '2015-01-12', 'admin', 0, NULL),
(34, 6, '001', 'Casa_Della_Salute', '', '', '5 ,7 ', ' Rossi Mario, Verdi Rocco', 1, 'Clio', 'qqqq', '2015-01-21', 'admin', 0, NULL),
(35, 4, '123', 'prova commessa 2', '', '', '6 ,11 ', ' Bianchi Franco, terzo prova terzo', 2, 'Altro', 'aa', '2015-01-21', 'admin', 0, NULL),
(44, 1, '12/01', 'Casa della salute', '', '', '5', 'Rossi Mario', 4, 'furgone', '', '2015-01-22', 'admin', 0, NULL),
(45, 1, '12/01', 'Casa della salute', '', '', '5,7', 'Rossi Mario,Verdi Rocco', 1, 'Clio', '', '2015-01-26', 'admin', 0, NULL),
(47, 6, '001', 'Casa_Della_Salute', '', '', '11,5', 'terzo prova terzo,Rossi Mario', 4, 'furgone', '', '2015-01-26', 'admin', 0, NULL),
(48, 1, '12/01', 'Casa della salute', '', '', '5,7', 'Rossi Mario,Verdi Rocco', 1, 'Clio', '', '2015-01-27', 'admin', 0, NULL),
(49, 6, '001', 'Casa_Della_Salute', '', '', '11,5', 'terzo prova terzo,Rossi Mario', 4, 'furgone', '', '2015-01-27', 'admin', 0, NULL),
(51, 1, '12/01', 'Casa della salute', '', '', '5', 'Rossi Mario', 1, 'Clio', '', '2015-03-30', 'admin', 0, NULL),
(52, 1, '12/01', 'Casa della salute', '', '', '5', 'Rossi Mario', 1, 'Clio', 'we', '2015-03-30', 'admin', 0, NULL),
(53, 1, '12/01', 'Casa della salute', '', '', '5,7', 'Rossi Mario,Verdi Rocco', 1, 'Clio', 'we', '2015-03-30', 'admin', 0, NULL),
(54, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-03-30', 'admin', 0, NULL),
(55, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-03-30', 'admin', 0, NULL),
(56, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-03-30', 'admin', 0, NULL),
(57, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-03-30', 'admin', 0, NULL),
(58, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-03-30', 'admin', 0, NULL),
(59, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-03-30', 'admin', 0, NULL),
(60, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-03-30', 'admin', 0, NULL),
(61, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-03-30', 'admin', 0, NULL),
(73, 1, '12/01', 'Casa della salute', '', '', '5', 'Rossi Mario', 1, 'Clio', '', '2015-04-02', 'admin', 0, NULL),
(74, 1, '12/01', 'Casa della salute', '', '', '5', 'Rossi Mario', 1, 'Clio', 'we', '2015-04-02', 'admin', 0, NULL),
(75, 1, '12/01', 'Casa della salute', '', '', '5,7', 'Rossi Mario,Verdi Rocco', 1, 'Clio', 'we', '2015-04-02', 'admin', 0, NULL),
(76, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-04-02', 'admin', 0, NULL),
(77, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-04-02', 'admin', 0, NULL),
(78, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-04-02', 'admin', 0, NULL),
(79, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-04-02', 'admin', 0, NULL),
(80, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-04-02', 'admin', 0, NULL),
(81, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-04-02', 'admin', 0, NULL),
(84, 1, '12/01', 'Casa della salute', '', '', '5', 'Rossi Mario', 1, 'Clio', '', '2015-04-03', 'admin', 0, NULL),
(85, 1, '12/01', 'Casa della salute', '', '', '5', 'Rossi Mario', 1, 'Clio', 'we', '2015-04-03', 'admin', 0, NULL),
(86, 1, '12/01', 'Casa della salute', '', '', '5,7', 'Rossi Mario,Verdi Rocco', 1, 'Clio', 'we', '2015-04-03', 'admin', 0, NULL),
(87, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-04-03', 'admin', 0, NULL),
(88, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-04-03', 'admin', 0, NULL),
(89, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-04-03', 'admin', 0, NULL),
(90, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-04-03', 'admin', 0, NULL),
(91, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-04-03', 'admin', 0, NULL),
(92, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-04-03', 'admin', 0, NULL),
(93, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-04-03', 'admin', 0, NULL),
(94, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-04-03', 'admin', 0, NULL),
(95, 1, '12/01', 'Casa della salute', '', '', '5', 'Rossi Mario', 1, 'Clio', '', '2015-04-16', 'admin', 0, NULL),
(96, 1, '12/01', 'Casa della salute', '', '', '5', 'Rossi Mario', 1, 'Clio', 'we', '2015-04-16', 'admin', 0, NULL),
(97, 1, '12/01', 'Casa della salute', '', '', '5,7', 'Rossi Mario,Verdi Rocco', 1, 'Clio', 'we', '2015-04-16', 'admin', 0, NULL),
(98, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-04-16', 'admin', 0, NULL),
(99, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-04-16', 'admin', 0, NULL),
(100, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-04-16', 'admin', 0, NULL),
(101, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-04-16', 'admin', 0, NULL),
(102, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-04-16', 'admin', 0, NULL),
(103, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-04-16', 'admin', 0, NULL),
(104, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-04-16', 'admin', 0, NULL),
(105, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-04-16', 'admin', 0, NULL),
(106, 1, '12/01', 'Casa della salute', '', '', '5', 'Rossi Mario', 1, 'Clio', '', '2015-04-04', 'admin', 0, NULL),
(107, 1, '12/01', 'Casa della salute', '', '', '5', 'Rossi Mario', 1, 'Clio', 'we', '2015-04-04', 'admin', 0, NULL),
(108, 1, '12/01', 'Casa della salute', '', '', '5,7', 'Rossi Mario,Verdi Rocco', 1, 'Clio', 'we', '2015-04-04', 'admin', 0, NULL),
(109, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-04-04', 'admin', 0, NULL),
(110, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-04-04', 'admin', 0, NULL),
(111, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-04-04', 'admin', 0, NULL),
(112, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-04-04', 'admin', 0, NULL),
(113, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-04-04', 'admin', 0, NULL),
(114, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-04-04', 'admin', 0, NULL),
(115, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-04-04', 'admin', 0, NULL),
(116, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-04-04', 'admin', 0, NULL),
(117, 1, '12/01', 'Casa della salute', '', '', '12', '1 1', 1, 'Clio', '1', '2015-04-04', 'admin', 0, NULL),
(120, 1, '12/01', 'Casa della salute', '', '', '5', 'Rossi Mario', 1, 'Clio', 'we', '2015-04-05', 'admin', 0, NULL),
(121, 1, '12/01', 'Casa della salute', '', '', '5,7', 'Rossi Mario,Verdi Rocco', 1, 'Clio', 'we', '2015-04-05', 'admin', 0, NULL),
(122, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-04-05', 'admin', 0, NULL),
(123, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-04-05', 'admin', 0, NULL),
(124, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-04-05', 'admin', 0, NULL),
(125, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-04-05', 'admin', 0, NULL),
(126, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-04-05', 'admin', 0, NULL),
(127, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-04-05', 'admin', 0, NULL),
(128, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-04-05', 'admin', 0, NULL),
(129, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-04-05', 'admin', 0, NULL),
(130, 1, '12/01', 'Casa della salute', '', '', '12', '1 1', 1, 'Clio', '1', '2015-04-05', 'admin', 0, NULL),
(135, 1, '12/01', 'Casa della salute', '', '', '5', 'Rossi Mario', 2, 'Altro', '', '2015-05-13', 'admin', 0, 'imp'),
(136, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-05-13', 'admin', 0, 'pitt'),
(137, 1, '12/01', 'Casa della salute', '', '', '5', 'Rossi Mario', 2, 'Altro', '', '2015-05-14', 'admin', 0, 'imp'),
(138, 1, '12/01', 'Casa della salute', '', '', '7', 'Verdi Rocco', 1, 'Clio', '', '2015-05-14', 'admin', 0, 'pitt'),
(141, 1, '12/01', 'Casa della salute', '', '', '12', '1 1', -1, 'nessuno', '', '2015-05-26', 'admin', 0, 'cap'),
(142, 1, '12/01', 'Casa della salute', '', '', '12', '1 1', -1, 'nessuno', '', '2015-05-26', 'admin', 0, 'Array'),
(143, 1, '12/01', 'Casa della salute', '', '', '5', 'Rossi&#39; Mario', 2, 'Altro', '', '2015-07-14', 'admin', 0, 'cap'),
(144, 1, '12/01', 'Casa della salute', '', '', '7,5,22,25', 'Verdi Rocco,Rossi&#39; Mario,11 11,14 14', 1, 'Clio', 'test', '2015-07-17', 'admin', 0, 'cap'),
(145, 4, '123', 'prova commessa 2', '', '', '21,7', '10 10,Verdi Rocco', 1, 'Clio', 's', '2015-07-17', 'admin', 0, 'cap'),
(146, 1, '12/01', 'Casa della salute', '', '', '5', 'Rossi&#39; Mario', 2, 'Altro', '', '2015-10-30', 'admin', 0, 'cap'),
(147, 1, '001', 'Casa della salute', '', '', '5', 'Rossi&#39; Mario', 1, 'Clio', 'no', '2016-01-12', 'admin', 0, 'cap');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_ral`
--

CREATE TABLE IF NOT EXISTS `tb_ral` (
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
  `tipologia` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id_commessa` (`id_commessa`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=16384 AUTO_INCREMENT=8 ;

--
-- Dump dei dati per la tabella `tb_ral`
--

INSERT INTO `tb_ral` (`id`, `id_commessa`, `ral`, `totale_ral`, `link_allegato`, `nome_allegato`, `totale_fatture`, `data`, `note`, `utente`, `tipologia`) VALUES
(1, 1, '1', '1111', 'uploads/commesse/1/ral/', '', NULL, '2015-01-20', '', 'admin', 'cap'),
(2, 6, '1', '1', 'uploads/commesse/6/ral/', '', NULL, '2015-02-04', '1', 'admin', NULL),
(3, 1, 'ssdad', '100', 'uploads/commesse/1/ral/', '', NULL, '2015-02-13', '', 'admin', 'cap'),
(4, 1, 'dsadsad', '231231', 'uploads/commesse/1/ral/', '', NULL, '2014-10-08', '', 'admin', 'cap'),
(6, 1, 'aaa', '1', 'uploads/commesse/1/ral/', '', NULL, '2015-03-03', '', 'admin', 'fv'),
(7, 1, 'città', '12', 'uploads/commesse/1/ral/', '', NULL, '2015-04-17', '', 'admin', 'cg');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_regolarita`
--

CREATE TABLE IF NOT EXISTS `tb_regolarita` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` int(11) DEFAULT NULL,
  `descrizione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data` date DEFAULT NULL,
  `ente` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `link_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `scadenza` date DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id_commessa` (`id_commessa`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=8192 AUTO_INCREMENT=6 ;

--
-- Dump dei dati per la tabella `tb_regolarita`
--

INSERT INTO `tb_regolarita` (`id`, `id_commessa`, `descrizione`, `data`, `ente`, `nome_allegato`, `link_allegato`, `scadenza`) VALUES
(4, 1, 'Lorem ipsum', '2014-10-09', 'Ente x', 'cappello.png', 'uploads/commesse/1/regolarita/', '2014-10-25'),
(5, 1, 'Lorem Ipsum', '2014-10-07', 'Ente Y', '', '', '2014-10-22');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_revisioni`
--

CREATE TABLE IF NOT EXISTS `tb_revisioni` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` int(11) DEFAULT NULL,
  `tipo_documento` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `numero_documento` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `registrato_a` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `data` date DEFAULT NULL,
  `link_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `tb_revisioni_fk1` (`id_commessa`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dump dei dati per la tabella `tb_revisioni`
--


-- --------------------------------------------------------

--
-- Struttura della tabella `tb_riserve`
--

CREATE TABLE IF NOT EXISTS `tb_riserve` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` int(11) DEFAULT NULL,
  `descrizione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data` date DEFAULT NULL,
  `dettagli` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `link_allegato` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id_commessa` (`id_commessa`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=16384 AUTO_INCREMENT=11 ;

--
-- Dump dei dati per la tabella `tb_riserve`
--

INSERT INTO `tb_riserve` (`id`, `id_commessa`, `descrizione`, `data`, `dettagli`, `link_allegato`, `nome_allegato`) VALUES
(10, 1, 'prova riserva', '2014-10-06', 'riserva dettagli', 'uploads/commesse/1/riserve/', 'cappello.png');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_ruolino`
--

CREATE TABLE IF NOT EXISTS `tb_ruolino` (
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
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `id` (`id`) USING BTREE,
  KEY `id_commessa` (`id_commessa`) USING BTREE,
  KEY `descrizione_commessa` (`descrizione_commessa`(1)) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=409 AUTO_INCREMENT=89 ;

--
-- Dump dei dati per la tabella `tb_ruolino`
--

INSERT INTO `tb_ruolino` (`id`, `ultima_modifica`, `id_commessa`, `cod_commessa`, `descrizione_commessa`, `localizzazione_lavoro`, `quantita`, `addetti`, `ore`, `mezzo`, `km`, `autista`, `terzi`, `ore_terzi`, `note`, `data`, `utente`, `cod_lavoro`, `descrizione_lavoro`, `codizioni_climatiche`, `id_lavoro`, `id_dipendenti`, `id_mezzo`, `clima`, `tipologia`) VALUES
(8, '2016-01-12 10:28:57', 6, '001', 'Casa_Della_Salute', NULL, '', ' Mario Rossi, Franco Bianchi', '6', 'Clio', '', '5-Mario Rossi', '', '0', '', '2015-01-08', 'admin', '-1', 'verifica del massetto esistente (PAVIMENTAZIONI TERRAZZI scheda n. 02)', NULL, -1, '5 ,6 ', 1, 'SERENO', 'cap'),
(9, '2016-01-12 12:50:32', 1, '12/01', 'Casa della salute', NULL, '', ' Mario Rossi', '5', '', '', '5-Mario Rossi', '', '0', '', '2015-01-08', 'admin', '-1', 'Preparazione del supporto', NULL, -1, '5 ', 0, 'SERENO', 'cap'),
(21, '2016-01-12 12:50:32', 1, '12/01', 'Casa della salute', NULL, '', ' Rossi Mario', '1', NULL, NULL, 'Rossi Mario', '', '', '', '2015-01-09', 'admin', '1', 'verifica del massetto esistente (IMPERMEABILIZZAZIONI scheda n. 01)', NULL, 5, '5 ', NULL, 'SERENO', 'cap'),
(34, '2016-01-12 10:28:57', 6, '001', 'Casa_Della_Salute', NULL, '100', ' Salvia Franca, Bianchi Franco, Verdi Rocco, terzo prova terzo', '9', NULL, NULL, 'Rossi Mario,Bianchi Franco', '', '8', 'prova', '2015-01-12', 'admin', '-1', 'demolizione del pavimento esistente (PAVIMENTAZIONI TERRAZZI scheda n. 02)', NULL, -1, '9 ,6 ,7 ,11 ', NULL, 'ok_ok_ok', 'fv'),
(40, '2016-01-12 10:28:57', 6, '001', 'Casa_Della_Salute', NULL, 'qta', ' Bianchi Franco, Ianni Maria', '8', NULL, NULL, 'Bianchi Franco', '', '', 'prova note', '2015-01-14', 'admin', '-1', 'prova lavoro', NULL, -1, '6 ,10 ', NULL, 'SERENO', 'cg'),
(41, '2016-01-12 10:28:57', 6, '001', 'Casa_Della_Salute', NULL, 'qta', ' Rossi Mario', '6', NULL, NULL, 'Bianchi Franco', '', '', '', '2015-01-14', 'admin', '-1', 'ppp', NULL, -1, '5 ', NULL, 'SERENO', 'imp'),
(42, '2016-01-12 12:50:32', 1, '12/01', 'Casa della salute', NULL, '', ' Bianchi Franco, terzo prova terzo', '6', NULL, NULL, 'Bianchi Franco', 'dfsfasd', '8', '', '2015-01-20', 'admin', '-1', 'adasdasd&#39;', NULL, -1, '6 ,11 ', NULL, 'SERENO', 'cap'),
(54, '2016-01-12 12:50:32', 1, '12/01', 'Casa della salute', NULL, '', 'Rossi Mario', '8', NULL, NULL, '5-Rossi Mario', '', '', '', '2015-01-22', 'admin', '-1', 'ff', NULL, -1, '5', NULL, 'SERENO', 'cap'),
(55, '2016-01-12 12:50:32', 1, '12/01', 'Casa della salute', NULL, '', 'Rossi Mario', '8', NULL, NULL, '7-Verdi Rocco', '', '', '', '2015-01-23', 'admin', '-1', 'sasas', NULL, -1, '5', NULL, 'SERENO', 'cap'),
(56, '2016-01-12 12:50:32', 1, '12/01', 'Casa della salute', NULL, '', 'Rossi Mario,Verdi Rocco', '8', NULL, NULL, '7-Verdi Rocco', '', '', '', '2015-01-26', 'admin', '-1', 'asdasdasds', NULL, -1, '5,7', NULL, 'SERENO', 'cap'),
(57, '2016-01-12 12:50:32', 1, '12/01', 'Casa della salute', NULL, '', 'Rossi Mario', '5', NULL, NULL, '7-Verdi Rocco', '', '', '', '2015-01-26', 'admin', '-1', 'fdsfd', NULL, -1, '5', NULL, 'SERENO', 'cap'),
(58, '2016-01-12 12:50:32', 1, '12/01', 'Casa della salute', NULL, '', 'Ianni Maria', '8', NULL, NULL, '10-Ianni Maria', '', '', '', '2015-01-28', 'admin', '-1', 'asas', NULL, -1, '10', NULL, 'SERENO', 'cap'),
(61, '2016-01-12 10:28:57', 6, '001', 'Casa_Della_Salute', NULL, '', 'Rossi Mario', '8', NULL, NULL, '5-Rossi Mario', '', '', '', '2015-02-04', 'admin', '-1', 'fsdf', NULL, -1, '5', NULL, 'asd_asd', 'cap'),
(62, '2016-01-12 12:50:32', 1, '12/01', 'Casa della salute', NULL, '', 'Rossi Mario', '8', NULL, NULL, '5-Rossi Mario', 'gfdgdd', '6', '', '2015-01-12', 'admin', '-1', '5-1-verifica del massetto esistente (IMPERMEABILIZZAZIONI scheda n. 01)', NULL, -1, '5', NULL, 'ok_ok_ok_1', 'cap'),
(63, '2016-01-12 12:50:32', 1, '12/01', 'Casa della salute', NULL, '', 'Rossi Mario', '8', NULL, NULL, '5-Rossi Mario', '', '', '', '2015-01-09', 'admin', '-1', 'rrr', NULL, -1, '5', NULL, 'non_SERENO', 'cap'),
(64, '2016-01-12 12:50:32', 1, '12/01', 'Casa della salute', NULL, '', 'Verdi Rocco', '4', NULL, NULL, '7-Verdi Rocco', '', '', '', '2014-12-11', 'admin', '-1', 'dfsd', NULL, -1, '7', NULL, 'SERENO', 'cap'),
(65, '2016-01-12 12:50:32', 1, '12/01', 'Casa della salute', NULL, '', '11 11', '8', NULL, NULL, '22-11 11', '', '', '', '2015-01-01', 'admin', '-1', '5-1-verifica del massetto esistente (IMPERMEABILIZZAZIONI scheda n. 01)', NULL, -1, '22', NULL, 'SERENO', 'cap'),
(66, '2015-03-04 09:42:39', 4, '123', 'prova commessa 2', NULL, '', '11 11', '8', NULL, NULL, '22-11 11', '', '', '', '2015-01-01', 'admin', '-1', '5-1-verifica del massetto esistente (IMPERMEABILIZZAZIONI scheda n. 01)', NULL, -1, '22', NULL, 'SERENO', 'cap'),
(67, '2016-01-12 10:28:57', 6, '001', 'Casa_Della_Salute', NULL, '', '11 11', '10', NULL, NULL, '22-11 11', '', '', '', '2015-01-02', 'admin', '-1', '8-1-demolizione del pavimento esistente (PAVIMENTAZIONI TERRAZZI scheda n. 02)', NULL, -1, '22', NULL, 'SERENO', 'cap'),
(68, '2016-01-12 12:50:32', 1, '12/01', 'Casa della salute', NULL, '', '11 11', '10', NULL, NULL, '22-11 11', '', '', '', '2015-02-02', 'admin', '-1', '5-1-verifica del massetto esistente (IMPERMEABILIZZAZIONI scheda n. 01)', NULL, -1, '22', NULL, 'SERENO', 'cap'),
(69, '2016-01-12 12:50:32', 1, '12/01', 'Casa della salute', NULL, '', '1 1', '8', NULL, NULL, '12-1 1', '', '', '', '2015-03-11', 'admin', '-1', '5-1-verifica del massetto esistente (IMPERMEABILIZZAZIONI scheda n. 01)', NULL, -1, '12', NULL, 'SERENO', 'cap'),
(70, '2016-01-12 12:50:32', 1, '12/01', 'Casa della salute', NULL, '', '1 1', '6', NULL, NULL, '12-1 1', '', '', '', '2015-03-12', 'admin', '-1', '5-1-verifica del massetto esistente (IMPERMEABILIZZAZIONI scheda n. 01)', NULL, -1, '12', NULL, 'SERENO', 'cap'),
(71, '2016-01-12 12:50:32', 1, '12/01', 'Casa della salute', NULL, '', 'Rossi Mario', '10', NULL, NULL, '5-Rossi Mario', '', '', '', '2015-03-19', 'admin', '-1', '5-1-verifica del massetto esistente (IMPERMEABILIZZAZIONI scheda n. 01)', NULL, -1, '5', NULL, 'SERENO', 'cap'),
(72, '2016-01-12 12:50:32', 1, '12/01', 'Casa della salute', NULL, '', 'Rossi Mario,Verdi Rocco', '8', NULL, NULL, '5-Rossi Mario', '', '', '', '2015-03-25', 'admin', '-1', 'rrr', NULL, -1, '5,7', NULL, 'SERENO', 'cap'),
(73, '2016-01-12 12:50:32', 1, '12/01', 'Casa della salute', NULL, '', 'Verdi Rocco', '8', NULL, NULL, '5-Rossi Mario', '', '', '', '2015-04-08', 'admin', '-1', 'dsfsd', NULL, -1, '7', NULL, 'PIOGGIA', 'cap'),
(74, '2016-01-12 10:28:57', 6, '001', 'Casa_Della_Salute', NULL, '', 'Rossi Mario', '8', NULL, NULL, '5-Rossi Mario', '', '', '', '2015-04-08', 'admin', '-1', 'dd', NULL, -1, '5', NULL, 'PIOGGIA', 'cap'),
(75, '2016-01-12 10:28:57', 6, '001', 'Casa_Della_Salute', NULL, '', 'Rossi Mario', '7', NULL, NULL, '5-Rossi Mario', '', '', '', '2015-01-14', 'admin', '-1', 'dsas', NULL, -1, '5', NULL, 'SERENO', 'cap'),
(76, '2016-01-12 12:50:32', 1, '12/01', 'Casa della salute', NULL, '', '1 1', '8', NULL, NULL, '12-1 1', '1', '6', '', '2015-06-12', 'admin', '-1', '5-1-verifica del massetto esistente (IMPERMEABILIZZAZIONI scheda n. 01)', NULL, -1, '12', NULL, 'SERENO', 'cap'),
(77, '2016-01-12 12:50:32', 1, '12/01', 'Casa della salute', NULL, '', '10 10', '8', NULL, NULL, '21-10 10', '', '', '', '2015-06-13', 'admin', '-1', 'sadasdasd', NULL, -1, '21', NULL, 'NUVOLOSO', 'cap'),
(78, '2016-01-12 12:50:32', 1, '12/01', 'Casa della salute', NULL, '', '10 10,Rossi&#39; Mario', '8', NULL, NULL, '5-Rossi&#39; Mario', '', '', '', '2015-07-17', 'admin', '-1', '5-1-verifica del massetto esistente (IMPERMEABILIZZAZIONI scheda n. 01)', NULL, -1, '21,5', NULL, 'SERENO', 'cap'),
(79, '2016-01-12 12:50:32', 1, '12/01', 'Casa della salute', NULL, '', 'Rossi&#39; Mario,Verdi Rocco', '8', NULL, NULL, '7-Verdi Rocco', '', '', '', '2015-07-17', 'admin', '-1', '5-1-verifica del massetto esistente (IMPERMEABILIZZAZIONI scheda n. 01)', NULL, -1, '5,7', NULL, 'SERENO', 'cap'),
(80, '2016-01-12 12:50:32', 1, '12/01', 'Casa della salute', NULL, '', 'Rossi&#39; Mario', '7', NULL, NULL, '5-Rossi&#39; Mario', '', '', '', '2015-09-15', 'admin', '-1', '8-1-demolizione del pavimento esistente (PAVIMENTAZIONI TERRAZZI scheda n. 02)', NULL, -1, '5', NULL, 'SERENO', 'cap'),
(81, '2015-09-15 14:38:48', 4, '123', 'prova commessa 2', NULL, '', '10 10', '6', NULL, NULL, '21-10 10', '', '', '', '2015-09-15', 'admin', '-1', '5-1-verifica del massetto esistente (IMPERMEABILIZZAZIONI scheda n. 01)', NULL, -1, '21', NULL, 'NUVOLOSO', 'cap'),
(82, '2016-01-12 12:50:32', 1, '12/01', 'Casa della salute', NULL, '', 'Verdi Rocco', '2', NULL, NULL, '7-Verdi Rocco', '', '', '', '2015-09-16', 'admin', '-1', '8-1-demolizione del pavimento esistente (PAVIMENTAZIONI TERRAZZI scheda n. 02)', NULL, -1, '7', NULL, 'NUVOLOSO', 'cap'),
(83, '2016-01-12 12:50:32', 1, '12/01', 'Casa della salute', NULL, '', '12 12', '1', NULL, NULL, '23-12 12', '', '', '', '2015-09-15', 'admin', '-1', '8-1-demolizione del pavimento esistente (PAVIMENTAZIONI TERRAZZI scheda n. 02)', NULL, -1, '23', NULL, 'NUVOLOSO', 'cap'),
(84, '2016-01-12 12:50:32', 1, '12/01', 'Casa della salute', NULL, '', 'Rossi&#39; Mario', '1', NULL, NULL, '5-Rossi&#39; Mario', '', '', '', '2015-09-24', 'admin', '-1', '5-1-verifica del massetto esistente (IMPERMEABILIZZAZIONI scheda n. 01)', NULL, -1, '5', NULL, 'SERENO', 'cap'),
(85, '2016-01-12 12:50:32', 1, '12/01', 'Casa della salute', NULL, '', '10 10,11 11,12 12,13 13,14 14', '3', NULL, NULL, '21-10 10', '', '', '', '2015-10-30', 'admin', '-1', '5-1-verifica del massetto esistente (IMPERMEABILIZZAZIONI scheda n. 01)', NULL, -1, '21,22,23,24,25', NULL, 'PIOGGIA', 'cap'),
(86, '2015-10-30 10:47:06', 4, '123', 'prova commessa 2', NULL, '', '10 10,40 40,Verdi Rocco', '4', NULL, NULL, '52-40 40', '', '', '', '2015-10-30', 'admin', '-1', '5-1-verifica del massetto esistente (IMPERMEABILIZZAZIONI scheda n. 01)', NULL, -1, '21,52,7', NULL, 'PIOGGIA', 'cap'),
(87, '2016-01-12 12:50:32', 1, '12/01', 'Casa della salute', NULL, '', 'Gasolio 25%', '3', NULL, NULL, '53-Gasolio 25%', '', '', '', '2015-11-06', 'admin', '-1', '5-1-verifica del massetto esistente (IMPERMEABILIZZAZIONI scheda n. 01)', NULL, -1, '53', NULL, 'SERENO', 'cap'),
(88, '2016-01-12 12:50:32', 1, '001', 'Casa della salute', NULL, '', 'Rossi&#39; Mario', '3', NULL, NULL, '5-Rossi&#39; Mario', '', '', '', '2016-01-12', 'admin', '-1', '5-1-verifica del massetto esistente (IMPERMEABILIZZAZIONI scheda n. 01)', NULL, -1, '5', NULL, 'SERENO', 'cap');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_sezione`
--

CREATE TABLE IF NOT EXISTS `tb_sezione` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titolo` varchar(512) COLLATE latin1_general_ci NOT NULL,
  `tipologia` varchar(512) COLLATE latin1_general_ci NOT NULL,
  `testo` text COLLATE latin1_general_ci NOT NULL,
  `costo` varchar(512) COLLATE latin1_general_ci NOT NULL,
  `link_file` varchar(512) COLLATE latin1_general_ci NOT NULL,
  `filename` varchar(512) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=30 ;

--
-- Dump dei dati per la tabella `tb_sezione`
--

INSERT INTO `tb_sezione` (`id`, `titolo`, `tipologia`, `testo`, `costo`, `link_file`, `filename`) VALUES
(28, 'Titolo Sezione', '', '<p><span style="font-family: ''Open Sans'', Arial, sans-serif; text-align: justify;">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span><br></p>', '9.99', '', ''),
(29, 'Sezione', '', '<span style="font-family: ''Open Sans'', Arial, sans-serif; text-align: justify;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span>', '', 'uploads/sezioni/29/img/', 'immagine.jpg');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_spese`
--

CREATE TABLE IF NOT EXISTS `tb_spese` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_mezzo` int(11) DEFAULT NULL,
  `tipo` varchar(256) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'Bollo, Assicurazione, Revisioni, Altro',
  `data_ultimo_pagamento` date DEFAULT NULL,
  `data_scadenza` date DEFAULT NULL,
  `avviso_entro_giorni` int(11) DEFAULT NULL,
  `riferimento_fattura` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `costo` double(15,2) DEFAULT '0.00',
  `eseguito` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id_mezzo` (`id_mezzo`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=4096 AUTO_INCREMENT=5 ;

--
-- Dump dei dati per la tabella `tb_spese`
--

INSERT INTO `tb_spese` (`id`, `id_mezzo`, `tipo`, `data_ultimo_pagamento`, `data_scadenza`, `avviso_entro_giorni`, `riferimento_fattura`, `costo`, `eseguito`) VALUES
(1, 1, 'Bollo', '2014-10-01', '2015-01-01', NULL, '', 3200.00, 1),
(2, 1, 'aa', '2015-01-20', '2015-01-01', NULL, '', 11.00, 1),
(3, 1, 'prova', '2015-02-25', '2014-02-06', NULL, '', 12.00, 1),
(4, 1, 're', '2015-02-04', '2015-02-14', NULL, '', 23.00, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_tagliando`
--

CREATE TABLE IF NOT EXISTS `tb_tagliando` (
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
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id_mezzo` (`id_mezzo`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=8192 AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `tb_tagliando`
--

INSERT INTO `tb_tagliando` (`id`, `id_mezzo`, `tipo_tagliando`, `data_tagliando`, `costo`, `riferimento_fattura`, `tagliando_ogni`, `eseguito`, `colore`, `tagliando_prossimo`) VALUES
(1, 1, 'Olio', '2014-10-01', 1000.00, '', '22000', 0, '53cc26', '25000'),
(2, 1, 'Freni', '2015-01-21', 123.00, '', '30000', 0, '16466e', '40000');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_tecnica`
--

CREATE TABLE IF NOT EXISTS `tb_tecnica` (
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
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=16384 AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `tb_tecnica`
--

INSERT INTO `tb_tecnica` (`id`, `num_preventivo`, `cliente`, `sopraluogo`, `data`, `offerta`, `operatore`, `ricontatti`, `esito`, `tipo_cliente`, `tipo_sede`, `motivazione`, `data_acquisizione`, `modalita`, `link_file`) VALUES
(1, '1', '', 'SI', '2015-02-06', '', 'admin', 'dasddsad', '', 'NUOVO', 'SEDE', '', NULL, '', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_terzi`
--

CREATE TABLE IF NOT EXISTS `tb_terzi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `descrizione` text COLLATE latin1_general_ci,
  `ore` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=5461 AUTO_INCREMENT=15 ;

--
-- Dump dei dati per la tabella `tb_terzi`
--

INSERT INTO `tb_terzi` (`id`, `id_commessa`, `data`, `descrizione`, `ore`) VALUES
(10, 6, '2015-01-14', 'aaa', 'aaa'),
(13, 6, '2015-01-14', 'bbbb', 'bbb'),
(14, 4, '2015-10-30', 'ad', '3');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_testata_magazzino`
--

CREATE TABLE IF NOT EXISTS `tb_testata_magazzino` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mezzo` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `id_mezzo` int(11) DEFAULT NULL,
  `id_commessa` int(11) DEFAULT NULL,
  `descrizione_commessa` varchar(512) COLLATE latin1_general_ci DEFAULT NULL,
  `data` date DEFAULT NULL,
  `utente` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=1638 AUTO_INCREMENT=35 ;

--
-- Dump dei dati per la tabella `tb_testata_magazzino`
--

INSERT INTO `tb_testata_magazzino` (`id`, `mezzo`, `id_mezzo`, `id_commessa`, `descrizione_commessa`, `data`, `utente`) VALUES
(1, 'Clio', 1, 1, 'Casa della salute', '2015-01-15', 'admin'),
(4, 'Clio', 1, 6, 'Casa_Della_Salute', '2015-01-15', 'admin'),
(11, 'Altro', 2, 4, 'prova commessa 2', '2015-01-15', 'admin'),
(12, 'Altro', 2, 1, 'Casa della salute', '2015-01-19', 'admin'),
(29, 'Clio', 1, 4, 'prova commessa 2', '2015-01-22', 'admin'),
(30, 'Clio', 1, 1, 'Casa della salute', '2015-03-11', 'admin'),
(31, 'Altro', 2, 1, 'Casa della salute', '2015-05-13', 'admin'),
(32, 'Clio', 1, 1, 'Casa della salute', '2015-05-13', 'admin'),
(33, 'Clio', 1, 1, 'Casa della salute', '2016-01-08', 'admin'),
(34, 'Clio', 1, 1, 'Casa della salute', '2016-01-12', 'admin');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_users`
--

CREATE TABLE IF NOT EXISTS `tb_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `password` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `ruolo` varchar(256) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'ADMIN | USER',
  `email` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `mansione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `nome` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `cognome` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `username` (`username`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=16384 AUTO_INCREMENT=41 ;

--
-- Dump dei dati per la tabella `tb_users`
--

INSERT INTO `tb_users` (`id`, `username`, `password`, `ruolo`, `email`, `mansione`, `nome`, `cognome`) VALUES
(32, 'admin', 'admin', 'ADMIN', 'prova@prova.it', 'amministratore', 'mario', 'rossi'),
(33, 'mezzo', 'mezzo', 'MEZZI', 'mezzo@m.it', 'mezzo', 'mezzo', 'mezzo'),
(34, 'commessa', 'commessa', 'ADMIN', 'commessa@m.it', 'commessa', 'commessa', 'commessa'),
(35, 'ruolino', 'ruolino', 'RUOLINO', 'ruolino@m.it', 'impiegato', 'ruolino', 'ruolino'),
(36, 'user', 'user', 'PERSONALE_RUOLINO', 'user@m.it', 'Impiegato', 'user', 'user'),
(39, 'prova', 'prova', 'ADMIN', 'prova@prova.it', 'prova', 'prova', 'prova'),
(40, 'mag', 'mag', 'MAGAZZINIERE', 'mag@mag.it', 'mag', 'mag', 'mag');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_utilizzo`
--

CREATE TABLE IF NOT EXISTS `tb_utilizzo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_mezzo` int(11) DEFAULT NULL,
  `id_commessa` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `dettagli` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `n_ore` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id_commessa` (`id_commessa`) USING BTREE,
  KEY `id_mezzo` (`id_mezzo`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dump dei dati per la tabella `tb_utilizzo`
--


-- --------------------------------------------------------

--
-- Struttura della tabella `tb_veicoli`
--

CREATE TABLE IF NOT EXISTS `tb_veicoli` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` int(11) DEFAULT NULL,
  `id_mezzo` int(11) DEFAULT NULL,
  `mezzo` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `targa` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `costo_h` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `data` date DEFAULT NULL,
  `km` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `tb_veicoli_idx1` (`id_commessa`,`id_mezzo`,`data`) USING BTREE,
  KEY `id_mezzo` (`id_mezzo`) USING BTREE,
  KEY `id_commessa` (`id_commessa`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=5461 AUTO_INCREMENT=13 ;

--
-- Dump dei dati per la tabella `tb_veicoli`
--

INSERT INTO `tb_veicoli` (`id`, `id_commessa`, `id_mezzo`, `mezzo`, `targa`, `costo_h`, `data`, `km`) VALUES
(1, 6, 1, 'Clio', '', '10', '2015-01-12', ''),
(11, 6, 0, '', '', 'aaa', '2015-01-14', ''),
(12, 4, 1, 'Clio', '', '1', '2015-10-30', '1');

-- --------------------------------------------------------

--
-- Struttura della tabella `tb_verbali`
--

CREATE TABLE IF NOT EXISTS `tb_verbali` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commessa` int(11) DEFAULT NULL,
  `descrizione` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `data` date DEFAULT NULL,
  `importo` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `link_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `nome_allegato` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id_commessa` (`id_commessa`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AVG_ROW_LENGTH=16384 AUTO_INCREMENT=12 ;

--
-- Dump dei dati per la tabella `tb_verbali`
--

INSERT INTO `tb_verbali` (`id`, `id_commessa`, `descrizione`, `data`, `importo`, `link_allegato`, `nome_allegato`) VALUES
(11, 1, 'Lorem Ipsum', '2014-10-08', '5.000', 'uploads/commesse/1/verbali/', 'prova.pdf');

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `tb_allegati`
--
ALTER TABLE `tb_allegati`
  ADD CONSTRAINT `tb_allegati_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `tb_allegati_attivita`
--
ALTER TABLE `tb_allegati_attivita`
  ADD CONSTRAINT `tb_allegati_attivita_fk1` FOREIGN KEY (`id_attivita`) REFERENCES `tb_attivita` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `tb_allegati_dipendenti`
--
ALTER TABLE `tb_allegati_dipendenti`
  ADD CONSTRAINT `tb_allegati_dipendenti_fk1` FOREIGN KEY (`id_dipendente`) REFERENCES `tb_dipendenti` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `tb_allegati_gare`
--
ALTER TABLE `tb_allegati_gare`
  ADD CONSTRAINT `tb_allegati_gare_fk1` FOREIGN KEY (`id_gara`) REFERENCES `tb_gara` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `tb_allegati_noleggi`
--
ALTER TABLE `tb_allegati_noleggi`
  ADD CONSTRAINT `tb_allegati_noleggi_fk1` FOREIGN KEY (`id_noleggio`) REFERENCES `tb_noleggi` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `tb_allegati_ordini_commessa`
--
ALTER TABLE `tb_allegati_ordini_commessa`
  ADD CONSTRAINT `tb_allegati_ordini_commessa_fk1` FOREIGN KEY (`id_ordine_commessa`) REFERENCES `tb_ordini_commessa` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `tb_attivita`
--
ALTER TABLE `tb_attivita`
  ADD CONSTRAINT `tb_attivita_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `tb_benzina`
--
ALTER TABLE `tb_benzina`
  ADD CONSTRAINT `tb_benzina_fk1` FOREIGN KEY (`id_mezzo`) REFERENCES `tb_mezzi` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `tb_categorie`
--
ALTER TABLE `tb_categorie`
  ADD CONSTRAINT `tb_categorie_fk1` FOREIGN KEY (`id_verbale`) REFERENCES `tb_verbali` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `tb_documentazione`
--
ALTER TABLE `tb_documentazione`
  ADD CONSTRAINT `tb_documentazione_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `tb_documenti_cliente`
--
ALTER TABLE `tb_documenti_cliente`
  ADD CONSTRAINT `tb_documenti_cliente_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `tb_fattura`
--
ALTER TABLE `tb_fattura`
  ADD CONSTRAINT `tb_fattura_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `tb_fattura_materiali_esterni`
--
ALTER TABLE `tb_fattura_materiali_esterni`
  ADD CONSTRAINT `tb_fattura_fk1_materiali_esterni` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `tb_fatture_ral`
--
ALTER TABLE `tb_fatture_ral`
  ADD CONSTRAINT `tb_fatture_ral_fk1` FOREIGN KEY (`id_ral`) REFERENCES `tb_ral` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `tb_libretto`
--
ALTER TABLE `tb_libretto`
  ADD CONSTRAINT `tb_libretto_fk1` FOREIGN KEY (`id_mezzo`) REFERENCES `tb_mezzi` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `tb_materiale`
--
ALTER TABLE `tb_materiale`
  ADD CONSTRAINT `tb_materiale_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `tb_noleggi`
--
ALTER TABLE `tb_noleggi`
  ADD CONSTRAINT `tb_noleggi_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `tb_ordini`
--
ALTER TABLE `tb_ordini`
  ADD CONSTRAINT `tb_ordini_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `tb_personale`
--
ALTER TABLE `tb_personale`
  ADD CONSTRAINT `tb_personale_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `tb_polizza`
--
ALTER TABLE `tb_polizza`
  ADD CONSTRAINT `tb_polizza_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `tb_presenze`
--
ALTER TABLE `tb_presenze`
  ADD CONSTRAINT `tb_presenze_fk1` FOREIGN KEY (`id_dipendente`) REFERENCES `tb_dipendenti` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_presenze_fk2` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `tb_ral`
--
ALTER TABLE `tb_ral`
  ADD CONSTRAINT `tb_ral_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `tb_regolarita`
--
ALTER TABLE `tb_regolarita`
  ADD CONSTRAINT `tb_regolarita_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `tb_revisioni`
--
ALTER TABLE `tb_revisioni`
  ADD CONSTRAINT `tb_revisioni_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `tb_riserve`
--
ALTER TABLE `tb_riserve`
  ADD CONSTRAINT `tb_riserve_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `tb_ruolino`
--
ALTER TABLE `tb_ruolino`
  ADD CONSTRAINT `tb_ruolino_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`);

--
-- Limiti per la tabella `tb_spese`
--
ALTER TABLE `tb_spese`
  ADD CONSTRAINT `tb_spese_fk1` FOREIGN KEY (`id_mezzo`) REFERENCES `tb_mezzi` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `tb_tagliando`
--
ALTER TABLE `tb_tagliando`
  ADD CONSTRAINT `tb_tagliando_fk1` FOREIGN KEY (`id_mezzo`) REFERENCES `tb_mezzi` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `tb_utilizzo`
--
ALTER TABLE `tb_utilizzo`
  ADD CONSTRAINT `tb_utilizzo_fk1` FOREIGN KEY (`id_mezzo`) REFERENCES `tb_veicoli` (`id_mezzo`) ON DELETE CASCADE;

--
-- Limiti per la tabella `tb_verbali`
--
ALTER TABLE `tb_verbali`
  ADD CONSTRAINT `tb_verbali_fk1` FOREIGN KEY (`id_commessa`) REFERENCES `tb_commesse` (`id`) ON DELETE CASCADE;
