<?php
/*************************************************************************************************************************************
 * @author Trajilovic Goran All right reserved
 * @website http://www.globcast.eu
 * @e-mail gorance@live.de
 * PDF for Auftrag by VARZAN Fahrtendienst Software 
 ************************************************************************************************************************************/
require('./modul/pdf/mysql_table.php');
class PDF extends PDF_MySQL_Table
{
function Header()
{
require_once("./modul/dbcron.php");
$db_handle = new DBController();

$id = $_GET['id'];

try {
   $sql = "SELECT user_name FROM users WHERE user_email = '".$id."'";
   $stmt = $DB->prepare($sql);
   $stmt->bindValue(":id", intval($_GET["id"]));

   $stmt->execute();
   $results = $stmt->fetchAll();
} 
catch (Exception $ex) 
{
  echo $ex->getMessage();
}
$driver = $results[0]["user_name"];
//$datenow = $results[0]["timedate"];
$datenow = date("Y-m-d");
	
        //Header Company Information
	$this->SetFont('Arial','',9);
        $curentdate = date('"M Y"', strtotime($datenow)); 
        $resultat = "Stunden Liste von $driver für $curentdate";
        $dispo ="Disposition";
        $this->SetXY(120, 6);
        $this->Cell(90, 12, "$resultat", 0, 1);
        $this->SetXY(30, 5);
        $this->Cell(5, 12, "$firma", 0, 1);
        $this->SetXY(30, 10);
        $this->Cell(5, 12, "$dispo", 0, 1);
	parent::Header();

}
    }

$pdf = new PDF('L','mm');
$pdf->AddPage();
//Second table: specify 3 columns
$pdf->AddCol('date22',30,'Datum','C');
$pdf->AddCol('time1',30,'Von','C');
$pdf->AddCol('time2',30,'Bis','C');
$pdf->AddCol('Stunden',30,'Stunden','C');
//$pdf->AddCol('',20,'Pause Anfang','C');
//$pdf->AddCol('',18,'Pause Ende','C');
//$pdf->AddCol('',16,'PAUSE','C');

$prop=array('HeaderColor'=>array(255,150,100),
			'color1'=>array(100,245,255),
			'color2'=>array(255,255,210),
			'padding'=>2);

$id = $_GET['id'];

$pdf->Table("SELECT timediff(MAX(end_time),MIN(start_time)) as Stunden, time(min(start_time)) AS time1, time(max(end_time)) AS time2, date(start_time) AS date22, driver_id from auftrege WHERE `driver_email`='".$id."' AND start_time>= last_day(now()) + interval 1 day - interval 1 month GROUP BY date22");

include("./config.php");

try {
   //$sql = "SELECT timediff(MAX(end_time),MIN(start_time)) AS Stunden, datediff(MAX(start_time),MIN(end_time)) AS date FROM auftrege WHERE driver_email = '".$id."'";
   //$sql = "SELECT sum(TIME_TO_SEC(TIMEDIFF(end_time,start_time)) /3600) AS Stunden, datediff(MAX(start_time),MIN(end_time)) AS date FROM auftrege WHERE driver_email = '".$id."'";

   $sql = "SELECT sum(timediff(end_time,start_time)) AS Stunden, datediff(MAX(start_time),MIN(end_time)) AS date FROM auftrege WHERE driver_email = '".$id."' AND start_time>= last_day(now()) + interval 1 day - interval 1 month";
   $stmt = $DB->prepare($sql);
   $stmt->bindValue(":id", intval($_GET["id"]));

   $stmt->execute();
   $results = $stmt->fetchAll();
} 
catch (Exception $ex) 
{
  echo $ex->getMessage();
}
$mail = $results[0]["driver_email"];// email stuff (change data below)
$ges_tage = $results[0]["date"] +2;
$stunden = $results[0]["Stunden"];
//$stunden1 = date("H:i",strtotime($stunden));


        $pdf->SetXY(10, 160);
        $pdf->Cell(275, 5, "Arbeitstage: $ges_tage", 1, 1);
        $pdf->SetXY(10, 168);
        $pdf->Cell(35, 5, "Gesamt Stunden: $stunden", 0, 1);
try {
   $sql = "SELECT user_name FROM users WHERE user_email = '".$id."'";
   $stmt = $DB->prepare($sql);
   $stmt->bindValue(":id", intval($_GET["id"]));

   $stmt->execute();
   $results = $stmt->fetchAll();
} 
catch (Exception $ex) 
{
  echo $ex->getMessage();
}
$driver = $results[0]["user_name"];
$date = date('M Y');

//header('Content-type: projekter/pdf');
$filename="./zeit/$driver - Stundenliste - $date".".pdf";
$pdf->Output($filename,'F');
//$pdf->Output("$driver - Stundenliste - $date".".pdf", 'F'); 
//header('Location: '.projekter.".pdf");

?>