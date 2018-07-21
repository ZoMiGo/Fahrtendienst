<?php
/*
 * @author copyright all rights reserved by Trajilovic Goran
 * @website http://www.globcast.eu
 * @Fahrtendienst Software v1.0
 * @contact gorance@live.de
 * @Created 15.10.2017
 */

  require_once('../core/db_config.php');

  $conn = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD);

if (!$conn) {
    echo "Unable to connect to DB: " . mysql_error();
    exit;
}

if (!mysql_select_db("admin_taxi")) {
    echo "Unable to select mydbname: " . mysql_error();
    exit;
}

$sql = "SELECT id as userid, name
        FROM   locations
        WHERE  online = 1";
$sql_off = "SELECT id as userid, name
        FROM   locations
        WHERE  online = 0";

$result = mysql_query($sql);
$result1 = mysql_query($sql_off);



while ($row = mysql_fetch_assoc($result)) {
$korisnik = $row["name"];
echo '<li class="online"><a href="#"><i class="fa fa-circle-o"></i>'.$korisnik.'</a></li>';
}

while ($row = mysql_fetch_assoc($result1)) {
$korisnik = $row["name"];
echo '<li class="busy"><a href="#"><i class="fa fa-circle-o"></i>'.$korisnik.'</a></li>';
}

mysql_free_result($result);

?>
