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
  $add=mysqli_query($conn,"SELECT SUM(sbehalt),SUM(sbehalt) from `dauer` WHERE Transportar = '$transport'");
  while($row1=mysqli_fetch_array($add))
  {
    $mark=$row1['SUM(sbehalt)'];
    $mark1=$row1['SUM(sbehalt)'];  
 ?>
  <tr>
    <th>Total</th>
    <th><?php echo $mark ?>,- Euro</th>
    <th><?php echo $mark1 ?>,- Euro</th>
  </tr>
  <?php } ?>
</table>