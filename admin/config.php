<?php
/*
 * @author Trajilovic Goran
 * @website http://www.globcast.eu
 * Fahrtendienst Software v1.0
 */
require_once("../core/db_config.php");

#Database
$pdo = new PDO(DB_DRIVER.':host='. DB_SERVER .';dbname='.DB_DATABASE, DB_USER, DB_PASSWORD);

$sql = "SELECT * FROM settings WHERE settings_id = '1'";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$settings = $stmt->fetchAll();
foreach($settings as $citai);
#Status from Database
/*
$a = $citai["status_0"];
$b = $citai["status_1"];
$c = $citai["status_2"];
$d = $citai["status_3"];
$e = $citai["status_4"];
$db_table_request = $citai["expres_auftrag"];
$api = $citai["google_api"];
$zzeit = $citai["zzeit"];
$db_table = $citai["daurt_auftrag"];
$standardauftrag_array = array($c);
$db_dispo = $citai["normal_auftrag"];
$db_auftrege = $citai["dispo_auftrag"];
$bakup_array = array($b, $c, $d);
$bakupdell_array = array($a, $b, $c, $d, $e);
$hometitle = $citai["page_title"];
$email_abs = $citai["email_abs"];
$firma = $citai["firma_name"];
*/

# Fahrer Datenbank
//$db_table_request = "texirequest"; // Fahrer Datenbank 
$db_table_request = $citai["expres_auftrag"];


//$google_api

# API Key für Fahzeit Berechnung
$api = $citai["google_api"];


$zzeit = $citai["zzeit"];

# Crontab Configuration für Standard Auftrag
$db_table="dauer"; // Datenbank mit den Aufträgen - (new_crontab.php) //
//$db_table = $citai["daurt_auftrag"];


$standardauftrag_array = array(0, 2); // Select Standard Auftrag Default Value 2=ON
//$standardauftrag_array = array(a, $c);


# Crontab Configuration für Dauer Auftrag - (cron1_dauerauftrag.php)
$db_dispo="dispo"; // Datenbank mit den Aufträgen
//$db_dispo = $citai["normal_auftrag"];



# Crontab Configuration für BackUp Alle Aufträge - (cron0_allauftrag.php)
//$db_auftrege="auftrege"; // Datenbank mit den Aufträgen
$db_auftrege = $citai["dispo_auftrag"];

$bakup_array = array(1, 2, 3); // Select accept Value 1=ON
$bakupdell_array = array(0, 1, 2, 3, 4);  // Set Curenr accept value to delete tables like 1,2,3,4 0 = for Dauerauftrag

//$bakup_array = array($b, $c, $d);
//$bakupdell_array = array($a, $b, $c, $d, $e);

# Page Name
$hometitle = $citai["page_title"];

# PDF E-mail Service Configuration
$email_abs = $citai["email_abs"];
$firma = $citai["firma_name"];


error_reporting( E_ALL & ~E_DEPRECATED & ~E_NOTICE );
ob_start();
session_start();

try {
    $DB = new PDO(DB_DRIVER.':host='.DB_SERVER.';dbname='.DB_DATABASE, DB_USER, DB_PASSWORD , $dboptions);

} catch (Exception $ex) {
  echo $ex->getMessage();
  die;
}

require_once 'functions.php';

//get error/success messages
if ($_SESSION["errorType"] != "" && $_SESSION["errorMsg"] != "" ) {
    $ERROR_TYPE = $_SESSION["errorType"];
    $ERROR_MSG = $_SESSION["errorMsg"];
    $_SESSION["errorType"] = "";
    $_SESSION["errorMsg"] = "";
}
?>