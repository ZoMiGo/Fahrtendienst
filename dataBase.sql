-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Erstellungszeit: 02. Nov 2017 um 07:02
-- Server-Version: 5.5.50-0ubuntu0.14.04.1
-- PHP-Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `admin_demo`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `auftrege`
--

CREATE TABLE `auftrege` (
  `id` int(11) NOT NULL,
  `driver_id` varchar(100) NOT NULL,
  `driver_email` varchar(100) NOT NULL,
  `driver_name` varchar(100) NOT NULL,
  `sender_id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `typ` varchar(100) NOT NULL,
  `sbehalt` varchar(100) NOT NULL,
  `Transportar` varchar(100) NOT NULL,
  `bfahrer` varchar(100) NOT NULL,
  `zinfo` varchar(100) NOT NULL,
  `dauer_auftrag` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `phoneM` varchar(100) NOT NULL,
  `phoneF` varchar(100) NOT NULL,
  `termin` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `droplocation` varchar(100) NOT NULL,
  `location` text NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `timedate` text NOT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `disponent` varchar(20) NOT NULL,
  `accept` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `dauer`
--

CREATE TABLE `dauer` (
  `id` int(11) NOT NULL,
  `driver_id` varchar(100) NOT NULL,
  `driver_email` varchar(100) NOT NULL,
  `driver_name` varchar(100) NOT NULL,
  `sender_id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `typ` varchar(100) NOT NULL,
  `sbehalt` varchar(100) NOT NULL,
  `Transportar` varchar(100) NOT NULL,
  `bfahrer` varchar(100) NOT NULL,
  `zinfo` varchar(100) NOT NULL,
  `dauer_auftrag` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `phoneM` varchar(100) NOT NULL,
  `phoneF` varchar(100) NOT NULL,
  `termin` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `droplocation` varchar(100) NOT NULL,
  `location` text NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `timedate` date NOT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `disponent` varchar(20) NOT NULL,
  `accept` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `dispo`
--

CREATE TABLE `dispo` (
  `id` int(11) NOT NULL,
  `driver_id` varchar(100) NOT NULL,
  `driver_email` varchar(100) NOT NULL,
  `driver_name` varchar(100) NOT NULL,
  `sender_id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `typ` varchar(100) NOT NULL,
  `sbehalt` varchar(100) NOT NULL,
  `Transportar` varchar(100) NOT NULL,
  `bfahrer` varchar(100) NOT NULL,
  `zinfo` varchar(100) NOT NULL,
  `dauer_auftrag` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `phoneM` varchar(100) NOT NULL,
  `phoneF` varchar(100) NOT NULL,
  `termin` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `droplocation` varchar(100) NOT NULL,
  `location` text NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `timedate` date DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `disponent` varchar(20) NOT NULL,
  `accept` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `dispo`
--

INSERT INTO `dispo` (`id`, `driver_id`, `driver_email`, `driver_name`, `sender_id`, `name`, `typ`, `sbehalt`, `Transportar`, `bfahrer`, `zinfo`, `dauer_auftrag`, `status`, `phoneM`, `phoneF`, `termin`, `phone`, `droplocation`, `location`, `latitude`, `longitude`, `timedate`, `start_time`, `end_time`, `disponent`, `accept`) VALUES
(49, '1', 'gorance@live.de', 'Trajilovic Goran', '27', 'Weidennauer Susanne', 'G', '0', 'Regelfahrt', 'JA', '', '1', 'dispo', '06765834840', '', '15:15 - 15:42', '06765834840', 'Salzwiesengasse 46/5, Wien, Ã–sterreich', 'KendlerstraÃŸe 29, Wien, Ã–sterreich', '', '', '2017-10-10', NULL, NULL, 'Trajilovic Goran', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fuhrpark`
--

CREATE TABLE `fuhrpark` (
  `kfz_id` int(5) NOT NULL DEFAULT '0',
  `Fahrzeug_typ` text NOT NULL,
  `Kenzeichen` text NOT NULL,
  `Fahrer` text NOT NULL,
  `date` date DEFAULT NULL,
  `km_start` text NOT NULL,
  `km_end` text NOT NULL,
  `sitzpletze` text NOT NULL,
  `rol` text NOT NULL,
  `inspection` date NOT NULL,
  `info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `fuhrpark`
--

INSERT INTO `fuhrpark` (`kfz_id`, `Fahrzeug_typ`, `Kenzeichen`, `Fahrer`, `date`, `km_start`, `km_end`, `sitzpletze`, `rol`, `inspection`, `info`) VALUES
(1, 'Merzedes Sprinter', 'W-5955MW', 'Trajilovic Goran', '2017-04-15', '250124', '250144', '8', '4', '2017-06-30', ''),
(2, 'Ford', 'W-9350MW', 'Craiu Florin', '2017-04-15', '250124', '250144', '8', '4', '2017-06-30', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kunden`
--

CREATE TABLE `kunden` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `fsw` varchar(100) NOT NULL,
  `sbehalt` varchar(100) NOT NULL,
  `kassa` text,
  `SvNr` varchar(100) NOT NULL,
  `kdnr` varchar(100) NOT NULL,
  `typ` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `droplocation` varchar(100) NOT NULL,
  `mobilitet` varchar(100) NOT NULL,
  `phoneM` varchar(100) NOT NULL,
  `phoneF` varchar(100) NOT NULL,
  `bfahrer` varchar(100) NOT NULL,
  `zinfo` varchar(100) NOT NULL,
  `Transportar` varchar(100) NOT NULL,
  `dauer_auftrag` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `number` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `latitude` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `longitude` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `vehicleinfo` text COLLATE latin1_general_ci NOT NULL,
  `costpkm` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `online` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Daten für Tabelle `locations`
--

INSERT INTO `locations` (`id`, `name`, `number`, `email`, `latitude`, `longitude`, `vehicleinfo`, `costpkm`, `online`) VALUES
(1, 'Max Musterman', '4369911026964', 'driver@fahrtendienst.net', '48.2694766', '16.4465998', 'Mercedes, Sprinter, Color:Red, 8 passenger vehicle', '5955', 1),
(10, 'Driver Musterman', '4369911026964', 'drivermusterman@fahrtendienst.net', '48.1834489', '16.3186447', 'Ford, 8 Personen', '9350', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `login_logout`
--

CREATE TABLE `login_logout` (
  `login_id` int(11) NOT NULL,
  `driver_id` varchar(100) NOT NULL,
  `login_time` datetime NOT NULL,
  `logout_time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `login_logout`
--

INSERT INTO `login_logout` (`login_id`, `driver_id`, `login_time`, `logout_time`) VALUES
(1, 'driver@fahrtendienst.net', '2017-10-06 16:42:48', '0000-00-00 00:00:00'),
(2, 'driver@fahrtendienst.net', '2017-10-07 07:07:17', '2017-10-07 07:07:18'),
(3, 'driver@fahrtendienst.net', '2017-10-07 11:08:02', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `module`
--

CREATE TABLE `module` (
  `mod_modulegroupcode` varchar(25) NOT NULL,
  `mod_modulegroupname` varchar(50) NOT NULL,
  `mod_modulecode` varchar(25) NOT NULL,
  `mod_modulename` varchar(50) NOT NULL,
  `mod_modulegrouporder` int(3) NOT NULL,
  `mod_moduleorder` int(3) NOT NULL,
  `mod_modulepagename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `module`
--

INSERT INTO `module` (`mod_modulegroupcode`, `mod_modulegroupname`, `mod_modulecode`, `mod_modulename`, `mod_modulegrouporder`, `mod_moduleorder`, `mod_modulepagename`) VALUES
('Alle Dauer Auftrege', 'Auftrag Verwaltung', 'Alle Dauer Auftrege', 'Auftrag Vergabe', 2, 2, 'all_dauerauftrege.php'),
('Alle Dauer Auftrege', 'Auftrag Verwaltung', 'Alle Freizeit Fahrten', 'Manage Dauer Auftrege', 2, 2, 'all_freizeit.php'),
('Alle Dauer Auftrege', 'Auftrag Verwaltung', 'Alle Kranken Transporte', 'Manage Kranken Transporte', 2, 2, 'all_krankentransporte.php'),
('Alle Dauer Auftrege', 'Auftrag Verwaltung', 'Alle Regel Fahrten', 'Manage Regel Fahrten', 2, 2, 'all_regel.php'),
('Alle Dauer Auftrege', 'Alle Dauer Auftrege', 'Dispo', 'Dispo', 2, 2, 'user_dauerauftrege.php'),
('Auftrag Management', 'Auftrag Management', 'Dauer Auftrag Vergabe', 'Dauer Auftrag Vergabe', 2, 2, 'user_dauerauftregenew.php'),
('Auftrag Management', 'Auftrag Management', 'Expres Auftrag Vergabe', 'Expres Auftrag Vergabe', 2, 2, 'user_expresauftrege.php'),
('Auftrag Management', 'Auftrag Management', 'Termin Auftrag Vergabe', 'Termin Auftrag Vergabe', 2, 2, 'user_terminauftrege.php'),
('Auftrag_Management', 'Meine Auftrege', 'Auftrag_Management', 'Meine Auftrege Heute', 2, 2, 'all_auftregeferv.php'),
('CUSTM', 'Customer Management', 'CUSTM', 'View Registred Customers', 2, 2, 'all_customer.php'),
('CUSTM_driver', 'Kunden Verwaltung', 'CUSTM_driver', 'Kunden Datenbank Bearbeiten', 2, 2, 'user_all_customer.php'),
('CUSTM_driver', 'Kunden Verwaltung', 'Kunde Hinzufuegen', 'Kunde Hinzufuegen', 2, 2, 'user_customer.php'),
('DASH', 'Dashboard', 'Dashboard', 'Dashboard', 2, 2, 'dashboard.php'),
('Display All Rides', 'Display All Rides', 'Alle Umsonst Fahrten', 'Alle Umsonst Fahrten', 2, 2, 'all_storno.php'),
('Display All Rides', 'Display All Rides', 'Ausstehende Fahrten', 'Ausstehende Fahrten', 2, 2, 'all_austehend.php'),
('Display All Rides', 'Display All Rides', 'Display All Rides', 'Display All Rides', 2, 2, 'all_rides.php'),
('Display All Rides', 'Display All Rides', 'Kunde im Auto/Unterwegs', 'Kunde im Auto/Unterwegs', 2, 2, 'all_unterwegs.php'),
('Display All Rides', 'Display All Rides', 'Meine Dauer Auftrege', 'Meine Dauer Auftrege', 2, 2, 'user_all_dauerauftrege.php'),
('Display All Rides', 'Display All Rides', 'Meine Fahrten', 'Meine Fahrten Heute', 2, 2, 'user_all_rides.php'),
('DRVSET', 'Driver Setings', 'DRVSET', 'General Driver Settings', 2, 2, 'driver_setings.php'),
('General Setings', 'General Setings', 'Dispo Management', 'Dispo Management', 2, 2, 'admin_setings.php'),
('General Setings', 'General Setings', 'General Setings', 'General Setings', 2, 2, 'settings.php'),
('KFZ Verwaltung', 'KFZ Verwaltung', 'Fahrten Buch', 'Fahrzeug Verwaltung', 2, 2, 'all_fbuch.php'),
('KFZ Verwaltung', 'KFZ Verwaltung', 'KFZ Verwaltung', 'Interner Auftrag', 2, 2, 'kfz.php'),
('TRACK', 'Track Drivers', 'GPS Tracker', 'GPS Tracker', 2, 2, '../tracker.php'),
('TRACK', 'Track Drivers', 'Track Drivers', 'GPS Fahrzeug Lokation', 2, 2, 'tracker.php');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pdf`
--

CREATE TABLE `pdf` (
  `pdf_id` int(11) NOT NULL,
  `Zeit` text NOT NULL,
  `Kat` text NOT NULL,
  `FSW` text NOT NULL,
  `Kundennamme` text NOT NULL,
  `S` text NOT NULL,
  `Adressevon` text NOT NULL,
  `Informationen` text NOT NULL,
  `Adressanach` text NOT NULL,
  `Informationennach` text NOT NULL,
  `Begleitung` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `pdf`
--

INSERT INTO `pdf` (`pdf_id`, `Zeit`, `Kat`, `FSW`, `Kundennamme`, `S`, `Adressevon`, `Informationen`, `Adressanach`, `Informationennach`, `Begleitung`) VALUES
(1, 'Zeit', 'Kat.', 'FSW', 'Kundenname', 'Selbstbehalt', 'Adresse von', 'Informationen', 'Adresse nach', 'Informationen', 'Begleitung');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `role`
--

CREATE TABLE `role` (
  `role_rolecode` varchar(50) NOT NULL,
  `role_rolename` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `role`
--

INSERT INTO `role` (`role_rolecode`, `role_rolename`) VALUES
('ADMIN', 'Administrator'),
('DISPONENT', 'Administrator'),
('DRIVER', 'Administrator'),
('SUPERADMIN', 'Super Admin');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `role_rights`
--

CREATE TABLE `role_rights` (
  `rr_rolecode` varchar(50) NOT NULL,
  `rr_modulecode` varchar(25) NOT NULL,
  `rr_create` enum('yes','no') NOT NULL DEFAULT 'no',
  `rr_edit` enum('yes','no') NOT NULL DEFAULT 'no',
  `rr_delete` enum('yes','no') NOT NULL DEFAULT 'no',
  `rr_view` enum('yes','no') NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `role_rights`
--

INSERT INTO `role_rights` (`rr_rolecode`, `rr_modulecode`, `rr_create`, `rr_edit`, `rr_delete`, `rr_view`) VALUES
('DISPONENT', 'Ausstehende Fahrten', 'no', 'no', 'no', 'yes'),
('DISPONENT', 'Dispo', 'yes', 'yes', 'yes', 'yes'),
('DISPONENT', 'Track Drivers', 'yes', 'yes', 'yes', 'yes'),
('DRIVER', 'Auftrag_Management', 'no', 'no', 'no', 'yes'),
('DRIVER', 'CUSTM_driver', 'yes', 'yes', 'yes', 'yes'),
('DRIVER', 'Dauer Auftrag Vergabe', 'yes', 'yes', 'yes', 'yes'),
('DRIVER', 'Expres Auftrag Vergabe', 'yes', 'yes', 'yes', 'yes'),
('DRIVER', 'Kunde Hinzufuegen', 'yes', 'yes', 'yes', 'yes'),
('DRIVER', 'Meine Dauer Auftrege', 'no', 'no', 'no', 'yes'),
('DRIVER', 'Meine Fahrten', 'no', 'no', 'no', 'yes'),
('DRIVER', 'Termin Auftrag Vergabe', 'yes', 'yes', 'yes', 'yes'),
('DRIVER', 'Track Drivers', 'yes', 'yes', 'yes', 'yes'),
('SUPERADMIN', 'Alle Dauer Auftrege', 'yes', 'yes', 'yes', 'yes'),
('SUPERADMIN', 'Alle Freizeit Fahrten', 'yes', 'yes', 'no', 'yes'),
('SUPERADMIN', 'Alle Kranken Transporte', 'yes', 'yes', 'yes', 'yes'),
('SUPERADMIN', 'Alle Regel Fahrten', 'yes', 'yes', 'yes', 'yes'),
('SUPERADMIN', 'Alle Umsonst Fahrten', 'yes', 'yes', 'yes', 'yes'),
('SUPERADMIN', 'Ausstehende Fahrten', 'yes', 'yes', 'yes', 'yes'),
('SUPERADMIN', 'CUSTM', 'yes', 'yes', 'yes', 'yes'),
('SUPERADMIN', 'Dashboard', 'yes', 'yes', 'yes', 'yes'),
('SUPERADMIN', 'Display All Rides', 'yes', 'yes', 'yes', 'yes'),
('SUPERADMIN', 'Dispo Management', 'yes', 'yes', 'yes', 'yes'),
('SUPERADMIN', 'DRVSET', 'yes', 'yes', 'yes', 'yes'),
('SUPERADMIN', 'Fahrten Buch', 'yes', 'yes', 'yes', 'yes'),
('SUPERADMIN', 'General Setings', 'yes', 'yes', 'yes', 'yes'),
('SUPERADMIN', 'KFZ Verwaltung', 'yes', 'yes', 'yes', 'yes'),
('SUPERADMIN', 'Kunde im Auto/Unterwegs', 'yes', 'yes', 'yes', 'yes'),
('SUPERADMIN', 'Track Drivers', 'yes', 'yes', 'yes', 'yes');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `settings`
--

CREATE TABLE `settings` (
  `settings_id` int(11) NOT NULL,
  `google_api` varchar(100) NOT NULL,
  `zzeit` varchar(100) NOT NULL,
  `daurt_autrag` varchar(100) NOT NULL,
  `status_0` varchar(100) NOT NULL,
  `status_1` varchar(100) NOT NULL,
  `status_2` varchar(100) NOT NULL,
  `status_3` varchar(100) NOT NULL,
  `status_4` varchar(100) NOT NULL,
  `normal_autrag` varchar(100) NOT NULL,
  `dispo_auftrag` varchar(100) NOT NULL,
  `page_title` varchar(100) NOT NULL,
  `email_abs` varchar(100) NOT NULL,
  `firma_name` varchar(100) NOT NULL,
  `expres_auftrag` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `settings`
--

INSERT INTO `settings` (`settings_id`, `google_api`, `zzeit`, `daurt_autrag`, `status_0`, `status_1`, `status_2`, `status_3`, `status_4`, `normal_autrag`, `dispo_auftrag`, `page_title`, `email_abs`, `firma_name`, `expres_auftrag`) VALUES
(1, 'AIzaSyC2P1C7YwSvdMztdGj3tE6eKi1CzmJuHkw', '10', 'dauer', '0', '1', '2', '3', '4', 'dispo', 'auftrege', 'Fahrtendienst v1.0.1', 'office@zandale.com', 'VARZAN Fahrtendienst GmbH', 'texirequest');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `system_users`
--

CREATE TABLE `system_users` (
  `u_userid` int(11) NOT NULL,
  `u_username` varchar(100) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `u_password` varchar(255) NOT NULL,
  `pin` varchar(10) NOT NULL,
  `user_num` varchar(15) NOT NULL,
  `category` varchar(10) NOT NULL,
  `imei` varchar(20) NOT NULL,
  `sim_serial` varchar(20) NOT NULL,
  `u_rolecode` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `system_users`
--

INSERT INTO `system_users` (`u_userid`, `u_username`, `name`, `email`, `u_password`, `pin`, `user_num`, `category`, `imei`, `sim_serial`, `u_rolecode`) VALUES
(1, 'admin', 'Max Musterman', 'admin@fahrtendienst.net', 'admin', '', '', 'driver', '', '', 'SUPERADMIN'),
(3, 'driver@fahrtendienst.net', 'Driver', 'driver@fahrtendienst.net', 'driver', '', '', 'driver', '', '', 'DRIVER');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `texirequest`
--

CREATE TABLE `texirequest` (
  `id` int(11) NOT NULL,
  `driver_id` varchar(100) DEFAULT NULL,
  `driver_email` varchar(100) DEFAULT NULL,
  `driver_name` varchar(100) DEFAULT NULL,
  `sender_id` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `typ` varchar(100) DEFAULT NULL,
  `sbehalt` varchar(100) DEFAULT NULL,
  `Transportar` varchar(100) DEFAULT NULL,
  `bfahrer` varchar(100) DEFAULT NULL,
  `zinfo` varchar(100) DEFAULT NULL,
  `dauer_auftrag` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `phoneM` varchar(100) DEFAULT 'null',
  `phoneF` text,
  `termin` varchar(100) DEFAULT '0',
  `phone` varchar(100) NOT NULL,
  `droplocation` varchar(100) NOT NULL,
  `location` text NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `ank_latitude` varchar(10) NOT NULL,
  `ank_longitude` varchar(10) NOT NULL,
  `ums_latitude` varchar(10) NOT NULL,
  `ums_longitude` varchar(10) NOT NULL,
  `aus_latitude` varchar(10) NOT NULL,
  `aus_longitude` varchar(10) NOT NULL,
  `timedate` date DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `disponent` varchar(20) NOT NULL,
  `turnr` varchar(10) NOT NULL,
  `accept` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `texirequest`
--

INSERT INTO `texirequest` (`id`, `driver_id`, `driver_email`, `driver_name`, `sender_id`, `name`, `typ`, `sbehalt`, `Transportar`, `bfahrer`, `zinfo`, `dauer_auftrag`, `status`, `phoneM`, `phoneF`, `termin`, `phone`, `droplocation`, `location`, `latitude`, `longitude`, `ank_latitude`, `ank_longitude`, `ums_latitude`, `ums_longitude`, `aus_latitude`, `aus_longitude`, `timedate`, `start_time`, `end_time`, `disponent`, `turnr`, `accept`) VALUES
(3198, '1', 'gorance@live.de', 'Trajilovic Goran', '27', 'Max Musterman', 'G', '2,20', 'Schulfahrt', 'JA', 'Darf Alleine Gehen lt. Papa', '2', 'texirequest', '069911026964', '2', '21:00 - 21:27', '3', 'Pastorstrasse 14, Wien, Ã–sterreich', 'Herbststrasse 15, Wien, Ã–sterreich', '', '', '', '', '', '', '', '', '2017-10-04', '2017-10-06 09:57:45', '2017-10-06 09:56:32', 'Trajilovic Goran', '2', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `userkunden`
--

CREATE TABLE `userkunden` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `driver_id` varchar(10) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `fsw` varchar(100) NOT NULL,
  `sbehalt` varchar(100) NOT NULL,
  `kassa` text,
  `SvNr` varchar(100) NOT NULL,
  `kdnr` varchar(100) NOT NULL,
  `typ` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `droplocation` varchar(100) NOT NULL,
  `mobilitet` varchar(100) NOT NULL,
  `phoneM` varchar(100) NOT NULL,
  `phoneF` varchar(100) NOT NULL,
  `bfahrer` varchar(100) NOT NULL,
  `zinfo` varchar(100) NOT NULL,
  `Transportar` varchar(100) NOT NULL,
  `dauer_auftrag` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `userkunden`
--

INSERT INTO `userkunden` (`user_id`, `name`, `user_email`, `driver_id`, `phone`, `fsw`, `sbehalt`, `kassa`, `SvNr`, `kdnr`, `typ`, `location`, `droplocation`, `mobilitet`, `phoneM`, `phoneF`, `bfahrer`, `zinfo`, `Transportar`, `dauer_auftrag`) VALUES
(180, 'Gezer Burak', '', '3', '068110684584', '', '0', 'WGKK', '', '', 'R', 'Hernalser HauptstraÃŸe 220-222, Wien, Ã–sterreich', 'Am Fuchsenfeld 1-3/36/3B', '', '068110684854', '06604879263', 'JA', '', 'Schulfahrt', '0');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `pin` varchar(20) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_num` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `imei` varchar(30) NOT NULL,
  `sim_serial` varchar(30) NOT NULL,
  `kljuc` varchar(30) NOT NULL,
  `superkljuc` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `password`, `pin`, `user_email`, `user_num`, `category`, `imei`, `sim_serial`, `kljuc`, `superkljuc`) VALUES
(1, 'Max Musterman', 'driver', 'W-1111 MW', 'driver@fahrtendienst.net', '', 'driver', 'A357558064360296', '3102101594038057', '3102101594038057', 'A357558064360296'),
(3, 'Driver Musterman', '123456', 'W-9350 MW', 'drivermusterman@fahrtendienst.net', '', 'driver', 'A357329071062758', '3102001364032712', '3102001364032712', 'A357329071062758');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indizes für die Tabelle `auftrege`
--
ALTER TABLE `auftrege`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `dauer`
--
ALTER TABLE `dauer`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `dispo`
--
ALTER TABLE `dispo`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `fuhrpark`
--
ALTER TABLE `fuhrpark`
  ADD PRIMARY KEY (`kfz_id`);

--
-- Indizes für die Tabelle `kunden`
--
ALTER TABLE `kunden`
  ADD PRIMARY KEY (`user_id`);

--
-- Indizes für die Tabelle `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `login_logout`
--
ALTER TABLE `login_logout`
  ADD PRIMARY KEY (`login_id`);

--
-- Indizes für die Tabelle `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`mod_modulegroupcode`,`mod_modulecode`),
  ADD UNIQUE KEY `mod_modulecode` (`mod_modulecode`);

--
-- Indizes für die Tabelle `pdf`
--
ALTER TABLE `pdf`
  ADD PRIMARY KEY (`pdf_id`);

--
-- Indizes für die Tabelle `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_rolecode`);

--
-- Indizes für die Tabelle `role_rights`
--
ALTER TABLE `role_rights`
  ADD PRIMARY KEY (`rr_rolecode`,`rr_modulecode`),
  ADD KEY `rr_modulecode` (`rr_modulecode`);

--
-- Indizes für die Tabelle `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`settings_id`);

--
-- Indizes für die Tabelle `system_users`
--
ALTER TABLE `system_users`
  ADD PRIMARY KEY (`u_userid`),
  ADD KEY `u_rolecode` (`u_rolecode`);

--
-- Indizes für die Tabelle `texirequest`
--
ALTER TABLE `texirequest`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `userkunden`
--
ALTER TABLE `userkunden`
  ADD PRIMARY KEY (`user_id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `auftrege`
--
ALTER TABLE `auftrege`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `dauer`
--
ALTER TABLE `dauer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `dispo`
--
ALTER TABLE `dispo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT für Tabelle `kunden`
--
ALTER TABLE `kunden`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT für Tabelle `login_logout`
--
ALTER TABLE `login_logout`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT für Tabelle `pdf`
--
ALTER TABLE `pdf`
  MODIFY `pdf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `settings`
--
ALTER TABLE `settings`
  MODIFY `settings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `system_users`
--
ALTER TABLE `system_users`
  MODIFY `u_userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT für Tabelle `texirequest`
--
ALTER TABLE `texirequest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3199;
--
-- AUTO_INCREMENT für Tabelle `userkunden`
--
ALTER TABLE `userkunden`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;
--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `role_rights`
--
ALTER TABLE `role_rights`
  ADD CONSTRAINT `role_rights_ibfk_1` FOREIGN KEY (`rr_rolecode`) REFERENCES `role` (`role_rolecode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `role_rights_ibfk_2` FOREIGN KEY (`rr_modulecode`) REFERENCES `module` (`mod_modulecode`) ON UPDATE CASCADE;

--
-- Constraints der Tabelle `system_users`
--
ALTER TABLE `system_users`
  ADD CONSTRAINT `system_users_ibfk_1` FOREIGN KEY (`u_rolecode`) REFERENCES `role` (`role_rolecode`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;