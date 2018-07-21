<?php
/*
 * @author copyright all rights reserved by Trajilovic Goran
 * @website http://www.globcast.eu
 * @Fahrtendienst Software v1.0
 * @contact gorance@live.de
 * @Created 15.10.2017
 */

  require_once('../core/db_config.php');

  $link = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);


/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
$DB ="texirequest";
$im_fahrzeug_1 ="1"; //Kunde im Fahrzeug
$im_fahrzeug_0 ="0"; //Ausstechender Auftrag
$im_fahrzeug_3 ="3"; //Auftrag Durchgefürt
$im_fahrzeug_4 ="4"; //Auftrag Umsoonst


if ($total_Auftrege = mysqli_query($link, "SELECT driver_id, name FROM $DB ORDER BY name")) 
if ($driver_result = mysqli_query($link, "SELECT u_userid, name FROM system_users ORDER BY name")) 
if ($total_fahrten = mysqli_query($link, "SELECT driver_id, name FROM auftrege ORDER BY name")) 
if ($kunden_unterwegs = mysqli_query($link, "SELECT * FROM texirequest WHERE accept ='$im_fahrzeug_1' ORDER BY name"))
{

    /* determine number of rows result set */
    $row_cnt = mysqli_num_rows($total_Auftrege);
    $row_driver = mysqli_num_rows($driver_result);
    $row_totalfahrten = mysqli_num_rows($total_fahrten);
    $row_kundenunterwegs = mysqli_num_rows($kunden_unterwegs);




    /* close result set */
    mysqli_free_result($total_Auftrege);
    mysqli_free_result($driver_result);
    mysqli_free_result($total_fahrten);
    mysqli_free_result($kunden_unterwegs);


}

/* close connection */
mysqli_close($link);
    //$totalAuftrege = $row_cnt;
    //$totaldrivers = $row_driver;
    //$totalfahrten = $row_totalfahrten;
    //$kundenunterwegs = $row_kundenunterwegs;

 ?>