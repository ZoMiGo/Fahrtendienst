<?php
echo '#!/usr/bin/php';
echo " <br><br/> ";
/*************************************************************************************************************************************
 * @author Trajilovic Goran
 * @website http://www.globcast.eu
 * @e-mail gorance@live.de
 * Monday Cron Update Driver Database
 ************************************************************************************************************************************/
include './config.php';
$mod = $_GET['mod'];
$dey = $_GET['dey'];
//////////////////////////////////
if ($mod=="1"){
//////////////////////////////////

$datenow22 = date("Y-m-d");
$datum22 = date("Y-m-d", strtotime("$dey this week", strtotime($datenow22)));

$con = mysql_connect("$host","$db_username","$db_password");
if(!$con) {
    die('could not connect: '.mysql_error());
}
mysql_select_db("$db_name", $con);
foreach($standardauftrag_array AS $auftrag) 
{
  $result = mysql_query("SELECT * FROM dauer WHERE timedate = '".$datum22."' AND dauer_auftrag = '".$auftrag."'");
  while($row = mysql_fetch_array($result)) 
  {
  mysql_query("INSERT INTO texirequest (id, driver_id, driver_email, driver_name, sender_id, name, typ, sbehalt, Transportar, bfahrer,
zinfo, dauer_auftrag, status, phoneM, phoneF, termin, phone, droplocation, location, latitude, longitude, timedate, start_time, end_time, disponent, accept)
VALUES (
'".$row['']."', '".$row['driver_id']."', '".$row['driver_email']."', '".$row['driver_name']."', '".$row['sender_id']."', '".$row['name']."', '".$row['typ']."',
'".$row['sbehalt']."', '".$row['Transportar']."', '".$row['bfahrer']."', '".$row['zinfo']."', '".$row['dauer_auftrag']."',
'".$row['status']."', '".$row['phoneM']."', '".$row['phoneF']."', '".$row['termin']."', '".$row['phone']."', '".$row['droplocation']."',
'".$row['location']."', '".$row['latitude']."', '".$row['longitude']."', '".$row['timedate']."', '".$row['start_time']."', '".$row['end_time']."', '".$row['disponent']."', '".$row['accept']."') ON DUPLICATE KEY UPDATE id = '".$row['id']."',
driver_id = '".$row['driver_id']."', driver_email = '".$row['driver_email']."', driver_name = '".$row['driver_name']."', sender_id = '".$row['sender_id']."',
name = '".$row['name']."', typ = '".$row['typ']."', sbehalt = '".$row['sbehalt']."', Transportar = '".$row['Transportar']."', bfahrer = '".$row['bfahrer']."',
zinfo = '".$row['zinfo']."', dauer_auftrag = '".$row['dauer_auftrag']."',
status = '".$row['status']."', phoneM = '".$row['phoneM']."', phoneF = '".$row['phoneF']."', termin = '".$row['termin']."',
phone = '".$row['phone']."',
droplocation = '".$row['droplocation']."', location = '".$row['location']."', latitude = '".$row['latitude']."', longitude = '".$row['longitude']."',
timedate = '".$row['timedate']."', start_time = '".$row['start_time']."', end_time = '".$row['end_time']."', disponent = '".$row['disponent']."', accept = '".$row['accept']."'");

}
}
mysql_close($con);
echo " <br><br/> ";
if ($result) {print("Send Standard Auftrag to Driver OK.");
}
//////////////////////////////////
}else if ($mod=="2"){
//////////////////////////////////

$con = mysql_connect("$host","$db_username","$db_password");
if(!$con) {
    die('could not connect: '.mysql_error());
}
mysql_select_db("$db_name", $con);

//foreach($bakupdell_array AS $mid)
//$d=mysql_query("DELETE FROM $db_table_request WHERE accept = '".$mid."'");
//if ($d) {print("Update Standard Auftrege OK.");}
echo "<br><br/>";
foreach($bakup_array AS $id) {
  $result = mysql_query("SELECT * FROM $db_table_request WHERE dauer_auftrag = '".$id."'");
  while($row = mysql_fetch_array($result)) {
  mysql_query("INSERT INTO $db_auftrege (id, driver_id, driver_email, driver_name, sender_id, name, typ, sbehalt, Transportar, bfahrer,
zinfo, dauer_auftrag, status, phoneM, phoneF, termin, phone, droplocation, location, latitude, longitude, timedate, start_time, end_time, disponent, accept)
VALUES (
'".$row['']."', '".$row['driver_id']."', '".$row['driver_email']."', '".$row['driver_name']."', '".$row['sender_id']."', '".$row['name']."', '".$row['typ']."',
'".$row['sbehalt']."', '".$row['Transportar']."', '".$row['bfahrer']."', '".$row['zinfo']."', '".$row['dauer_auftrag']."',
'".$row['status']."', '".$row['phoneM']."', '".$row['phoneF']."', '".$row['termin']."', '".$row['phone']."', '".$row['droplocation']."',
'".$row['location']."', '".$row['latitude']."', '".$row['longitude']."', '".$row['timedate']."', '".$row['start_time']."', '".$row['end_time']."', '".$row['disponent']."', '".$row['accept']."') ON DUPLICATE KEY UPDATE id = '".$row['id']."',
driver_id = '".$row['driver_id']."', driver_email = '".$row['driver_email']."', driver_name = '".$row['driver_name']."', sender_id = '".$row['sender_id']."',
name = '".$row['name']."', typ = '".$row['typ']."', sbehalt = '".$row['sbehalt']."', Transportar = '".$row['Transportar']."', bfahrer = '".$row['bfahrer']."',
zinfo = '".$row['zinfo']."', dauer_auftrag = '".$row['dauer_auftrag']."',
status = '".$row['status']."', phoneM = '".$row['phoneM']."', phoneF = '".$row['phoneF']."', termin = '".$row['termin']."',
phone = '".$row['phone']."',
droplocation = '".$row['droplocation']."', location = '".$row['location']."', latitude = '".$row['latitude']."', longitude = '".$row['longitude']."',
timedate = '".$row['timedate']."', start_time = '".$row['start_time']."', end_time = '".$row['end_time']."', disponent = '".$row['disponent']."', accept = '".$row['accept']."'");

}
}
mysql_close($con);
echo " <br><br/> ";
if ($result) {print("Update Save Data to BackUp OK.");}
//////////////////////////////////
}else if ($mod=="3"){
//////////////////////////////////
$datenow = date("Y-m-d");
$curentdate = date('Y-m-d', strtotime('+1 day', strtotime($datenow)));
$dauerauftrag_array = array(1); // Select DauerAuftrag Value 1=ON
$mid_array = array(0, 1, 2, 3);  // Set Curenr accept value to delete tables like 1,2,3,4 0 = for Dauerauftrag

$con = mysql_connect("$host","$db_username","$db_password");

if(!$con) {
    die('could not connect: '.mysql_error());
}
mysql_select_db("$db_name", $con);

foreach($mid_array AS $mid)
$d=mysql_query("DELETE FROM $db_table_request WHERE accept = '".$mid."'");

if ($d) {print("Update Dauer Auftrag OK.");
}
echo " <br><br/> ";
foreach($dauerauftrag_array AS $id) {
    $result = mysql_query("SELECT * FROM $db_dispo WHERE dauer_auftrag = '".$id."'");
    while($row = mysql_fetch_array($result)) {
    mysql_query("INSERT INTO $db_table_request (id, driver_id, driver_email, driver_name, sender_id, name, typ, sbehalt, fsw, Transportar, bfahrer,
zinfo, dauer_auftrag, status, phoneM, phoneF, termin, phone, droplocation, location, latitude, longitude, timedate, start_time, end_time, disponent, accept)
VALUES (
'".$row['']."', '".$row['driver_id']."', '".$row['driver_email']."', '".$row['driver_name']."', '".$row['sender_id']."', '".$row['name']."', '".$row['typ']."',
'".$row['sbehalt']."', '".$row['fsw']."', '".$row['Transportar']."', '".$row['bfahrer']."', '".$row['zinfo']."', '".$row['dauer_auftrag']."',
'".$row['status']."', '".$row['phoneM']."', '".$row['phoneF']."', '".$row['termin']."', '".$row['phone']."', '".$row['droplocation']."',
'".$row['location']."', '".$row['latitude']."', '".$row['longitude']."', '$curentdate', '".$row['start_time']."', '".$row['end_time']."', '".$row['disponent']."', '".$row['accept']."') ON DUPLICATE KEY UPDATE id = '".$row['id']."',
driver_id = '".$row['driver_id']."', driver_email = '".$row['driver_email']."', driver_name = '".$row['driver_name']."', sender_id = '".$row['sender_id']."',
name = '".$row['name']."', typ = '".$row['typ']."', sbehalt = '".$row['sbehalt']."', fsw = '".$row['fsw']."', Transportar = '".$row['Transportar']."', bfahrer = '".$row['bfahrer']."',
zinfo = '".$row['zinfo']."', dauer_auftrag = '".$row['dauer_auftrag']."',
status = '".$row['status']."', phoneM = '".$row['phoneM']."', phoneF = '".$row['phoneF']."', termin = '".$row['termin']."',
phone = '".$row['phone']."',
droplocation = '".$row['droplocation']."', location = '".$row['location']."', latitude = '".$row['latitude']."', longitude = '".$row['longitude']."',
timedate = '$curentdate', fsw = '".$row['fsw']."',start_time = '".$row['start_time']."', end_time = '".$row['end_time']."', disponent = '".$row['disponent']."', accept = '".$row['accept']."'");

 }
}
mysql_close($con);
if ($result) {print("Send Data from Dispo to Driver OK.");
}
echo " <br><br/> ";
//////////////////////////////////
}else if ($mod=="4"){
//////////////////////////////////
$datenow = date("Y-m-d");
$datum = date('Y-m-d', strtotime('+1 day', strtotime($datenow)));

$con = mysql_connect("$host","$db_username","$db_password");
if(!$con) {
    die('could not connect: '.mysql_error());
}
mysql_select_db("$db_name", $con);

foreach($standardauftrag_array AS $auftrag) {
  $result = mysql_query("SELECT * FROM $db_table WHERE timedate = '".$datum."' AND dauer_auftrag = '".$auftrag."'");
  while($row = mysql_fetch_array($result)) {
  mysql_query("INSERT INTO $db_table_request (id, driver_id, driver_email, driver_name, sender_id, name, typ, sbehalt, Transportar, bfahrer,
zinfo, dauer_auftrag, status, phoneM, phoneF, termin, phone, droplocation, location, latitude, longitude, timedate, start_time, end_time, disponent, accept)
VALUES (
'".$row['id']."', '".$row['driver_id']."', '".$row['driver_email']."', '".$row['driver_name']."', '".$row['sender_id']."', '".$row['name']."', '".$row['typ']."',
'".$row['sbehalt']."', '".$row['Transportar']."', '".$row['bfahrer']."', '".$row['zinfo']."', '".$row['dauer_auftrag']."',
'".$row['status']."', '".$row['phoneM']."', '".$row['phoneF']."', '".$row['termin']."', '".$row['phone']."', '".$row['droplocation']."',
'".$row['location']."', '".$row['latitude']."', '".$row['longitude']."', '".$row['timedate']."', '".$row['start_time']."', '".$row['end_time']."', '".$row['disponent']."', '".$row['accept']."') ON DUPLICATE KEY UPDATE id = '".$row['id']."',
driver_id = '".$row['driver_id']."', driver_email = '".$row['driver_email']."', driver_name = '".$row['driver_name']."', sender_id = '".$row['sender_id']."',
name = '".$row['name']."', typ = '".$row['typ']."', sbehalt = '".$row['sbehalt']."', Transportar = '".$row['Transportar']."', bfahrer = '".$row['bfahrer']."',
zinfo = '".$row['zinfo']."', dauer_auftrag = '".$row['dauer_auftrag']."',
status = '".$row['status']."', phoneM = '".$row['phoneM']."', phoneF = '".$row['phoneF']."', termin = '".$row['termin']."',
phone = '".$row['phone']."',
droplocation = '".$row['droplocation']."', location = '".$row['location']."', latitude = '".$row['latitude']."', longitude = '".$row['longitude']."',
timedate = '".$row['timedate']."', start_time = '".$row['start_time']."', end_time = '".$row['end_time']."', disponent = '".$row['disponent']."', accept = '".$row['accept']."'");

}
}
mysql_close($con);
echo " <br><br/> ";
if ($result) {print("Send Standard Auftrag to Driver OK.");}
}

?>
