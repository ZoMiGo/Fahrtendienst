
<?php
/*
 * @author Trajilovic Goran
 * @website http://www.globcast.eu
 * Fahrtendienst Software v1.0
 */
/*
$startArbeit= '2017-10-19 06:00:00';
$endarbeit= '2017-10-19 08:00:00';
$startpause= '01:00:00';
$endpause= '02:00:00';


$totalarbeit= strtotime($endarbeit) - strtotime($startArbeit);
$totalpause= strtotime($endpause) - strtotime($startpause);
$result = $totalarbeit - $totalpause;

$hours= floor($result / 60 / 60);


$minutes= round(($result - ($hours * 60 * 60)) / 60);


 echo "Arbbeitszeit: <b>$hours.$minutes</b> Stunden";

*/
?>
<style>
table {
	 width: 100%;
    border-collapse: collapse;
}
th {
    background-color: green;
    color: white;
}
table, td {
    border: 1px solid black;
	text-align:center;
}
</style>

<table>
  <tr>
    <th >Freizeitfahrt Kunde</th>
    <th>Selbstbehalt</th>
    <th class="head">Kassa</th>
  </tr>
  
<?php
header("Content-Type: text/html; charset=utf-8");
/*
 * @author Trajilovic Goran
 * @website http://www.globcast.eu
 * Fahrtendienst Software v1.0
 */

require_once("config.php");
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    // not logged in send to login page
    redirect("index.php");
}
$status = FALSE;
if ( authorize($_SESSION["access"]["Alle Dauer Auftrege"]["Alle Dauer Auftrege"]["create"]) ||
     authorize($_SESSION["access"]["Alle Dauer Auftrege"]["Alle Dauer Auftrege"]["edit"]) ||
     authorize($_SESSION["access"]["Alle Dauer Auftrege"]["Alle Dauer Auftrege"]["view"]) ||
     authorize($_SESSION["access"]["Alle Dauer Auftrege"]["Alle Dauer Auftrege"]["delete"]) ) {
     $status = TRUE;
}

if ($status === FALSE) {
die("You dont have the permission to access this page");
}

  require_once('../core/db_config.php');
  $conn=mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
  $transport = "Freizeitfahrt";

  $table=mysqli_query($conn,"SELECT * FROM `dauer` WHERE Transportar = '$transport'");
  while($row=mysqli_fetch_array($table))
  {
      $number=$row['name'];
      $smaths=$row['sbehalt'];
      $senglish=$row['sbehalt'];
  ?>
  <tr>
    <td class="sno"><?php echo $number ?></td>
    <td class="mark"><?php echo $smaths ?></td>
    <td class="mark"><?php echo $senglish ?></td>
  </tr>
  <?php } ?>
  
  <?php 
  //$add=mysqli_query($conn,"SELECT SUM(sbehalt),SUM(sbehalt) from `dauer` WHERE Transportar = '$transport'");
$id= "gorance@live.de";
$add=mysqli_query($conn,"SELECT timediff(MAX(end_time),MIN(start_time)) as Stunden, time(min(start_time)) AS time1, time(max(end_time)) AS time2, date(start_time) AS date22, driver_id from auftrege WHERE `driver_email`='".$id."' AND start_time>= last_day(now()) + interval 1 day - interval 1 month GROUP BY date22");




  while($row1=mysqli_fetch_array($add))
  {
    $mark=$row1['time1'];
    $mark1=$row1['time2']; 
    $mark3 =$row1['Stunden']; 


///////////
$startArbeit= $mark;
$endarbeit= $mark1;
$startpause= '00:00:00';
$endpause= '00:00:00';


$totalarbeit= strtotime($endarbeit) - strtotime($startArbeit);
$totalpause= strtotime($endpause) - strtotime($startpause);
$result = $totalarbeit - $totalpause;

$hours= floor($result / 60 / 60);


$minutes= round(($result - ($hours * 60 * 60)) / 60);


 //echo "Arbbeitszeit: <b>$hours.$minutes</b> Stunden";



/////////// 
 ?>
  <tr>
    <th>Total</th>
    <th><?php echo $hours ?></th>
    <th><?php echo $mark3 ?></th>
  </tr>
  <?php } ?>
</table>