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
require_once("./modul/dbcontroller.php");
include("./config.php");

$db_handle = new DBController();

$id = $_GET['id'];

try {
   $sql = "SELECT driver_name, timedate FROM texirequest WHERE driver_id = '".$id."'";
   $stmt = $DB->prepare($sql);
   $stmt->bindValue(":id", intval($_GET["id"]));

   $stmt->execute();
   $results = $stmt->fetchAll();
} 
catch (Exception $ex) 
{
  echo $ex->getMessage();
}
$driver = $results[0]["driver_name"];
$datenow = $results[0]["timedate"];
	
        //Header Company Information
	$this->SetFont('Arial','',9);
        $curentdate = date('d.m.Y', strtotime('+0 day', strtotime($datenow)));
        $resultat = "Fahrt für $driver von $curentdate";
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
$pdf->AddCol("termin",20,'','L');
$pdf->AddCol('typ',7,'Typ','C');
$pdf->AddCol('Transportar',15,'Modus','L');
$pdf->AddCol('name',30,'','C');
$pdf->AddCol('location',60,'Abhohl Adresse','C');
$pdf->AddCol('sbehalt',8,'EUR','C');
$pdf->AddCol('zinfo',30,'Infos','L');
$pdf->AddCol('phoneM',30,'Tel Nr:','C');
$pdf->AddCol('droplocation',70,'Ziel Adresse','C');
$pdf->AddCol('bfahrer',20,'Bgl.Pflicht','C');
$prop=array('HeaderColor'=>array(255,150,100),'color1'=>array(100,245,255),'color2'=>array(255,255,210),'padding'=>2);

$id = $_GET['id'];

$pdf->Table("SELECT termin, typ, name, location, sbehalt, zinfo, droplocation, bfahrer, phoneM, Transportar from texirequest WHERE `accept` = '0' & `driver_id`='".$id."' ORDER BY termin");
require_once('../core/db_config.php');

  $link = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);


/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
$typr ="R";
$typg ="G";
$typu ="U";



if ($gesamt_auftrege = mysqli_query($link, "SELECT termin, typ, name, location, sbehalt, zinfo, droplocation, bfahrer, phoneM, Transportar from texirequest WHERE `accept` = '0' AND `driver_id`='".$id."' ORDER BY termin"))
if ($driver_result = mysqli_query($link, "SELECT termin, typ, name, location, sbehalt, zinfo, droplocation, bfahrer, phoneM, Transportar from texirequest WHERE `accept` = '0' AND `driver_id`='".$id."' AND `typ`='".$typr."' ORDER BY termin"))
if ($total_fahrten = mysqli_query($link, "SELECT termin, typ, name, location, sbehalt, zinfo, droplocation, bfahrer, phoneM, Transportar from texirequest WHERE `accept` = '0' AND `driver_id`='".$id."' AND `typ`='".$typg."' ORDER BY termin"))
if ($total_umsetzer = mysqli_query($link, "SELECT termin, typ, name, location, sbehalt, zinfo, droplocation, bfahrer, phoneM, Transportar from texirequest WHERE `accept` = '0' AND `driver_id`='".$id."' AND `typ`='".$typu."' ORDER BY termin"))

{

    /* determine number of rows result set */
    $row_cnt = mysqli_num_rows($gesamt_auftrege);
    $row_driver = mysqli_num_rows($driver_result);
    $row_totalfahrten = mysqli_num_rows($total_fahrten);
    $row_umsetzer = mysqli_num_rows($total_umsetzer);




    /* close result set */
    mysqli_free_result($gesamt_auftrege);
    mysqli_free_result($driver_result);
    mysqli_free_result($total_fahrten);
    mysqli_free_result($total_umsetzer);


}

/* close connection */
mysqli_close($link);
    $gesamt = $row_cnt; //Gesamt
    $rolstuhl = $row_driver; //Rolstuhl
    $geher = $row_totalfahrten; //Geher
    $umsetzer = $row_umsetzer; //Umsetzer

      
        $pdf->SetXY(10, 100);
        $pdf->Cell(0, 12, "Anzahl Rollstuhlfahrer: $rolstuhl Anzahl Geher: $geher Anzahl Umsetzer: $umsetzer", 0, 1);
        $pdf->SetXY(10, 105);
        $pdf->Cell(0, 12, "$gesamt Fahrten, davon 0 mit Sozialpass, $gesamt ohne", 0, 1);



//header('Content-type: projekter/pdf');
//$pdf->Output("$driver".".pdf", 'I'); 
//header('Location: '.projekter.".pdf");

//echo "Auftrag wird Bearbeitet";
Redirect('driver_setings.php', false);
include("./config.php");

$db_handle = new DBController();

try {
   $sql = "SELECT driver_name, driver_email, timedate FROM texirequest WHERE driver_id = '".$id."'";
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
$name = $results[0]["driver_name"];
$datenow = $results[0]["timedate"];
$datum = date('d.m.Y', strtotime('+0 day', strtotime($datenow)));
$to = "$mail"; 
$from = "$firma<$email_abs>"; 
$subject = "Fahrten für $name vom $datum"; 
$message = "<p>Im Anhang die Fahrt für $name .</p><p>Mit freundlichen Grüßen</p><p>Fahrtendienst Software VARZAN<p>";

// a random hash will be necessary to send mixed content
$separator = md5(time());

// carriage return type (we use a PHP end of line constant)
$eol = PHP_EOL;

// attachment name
$filename = "Tourenliste-$datum.pdf";

// encode data (puts attachment in proper format)
$pdfdoc = $pdf->Output("", "S");
$attachment = chunk_split(base64_encode($pdfdoc));

// main header
$headers  = "From: ".$from.$eol;
$headers .= "MIME-Version: 1.0".$eol; 
$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"";

// no more headers after this, we start the body! //

$body = "--".$separator.$eol;
$body .= "Content-Transfer-Encoding: 7bit".$eol.$eol;
$body .= "Im Anhang die Fahrt für $name".$eol;
$body .= "Mit freundlichen Grüßen ".$eol;
$body .= "$firma".$eol;


// message
//$body .= "--".$separator.$eol;
//$body .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
//$body .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
//$body .= $message.$eol;

// attachment
$body .= "--".$separator.$eol;
$body .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol; 
$body .= "Content-Transfer-Encoding: base64".$eol;
$body .= "Content-Disposition: attachment".$eol.$eol;
$body .= $attachment.$eol;
$body .= "--".$separator."--";

// send message
mail($to, $subject, $body, $headers);
?>