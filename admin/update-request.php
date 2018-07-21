<?php
/*************************************************************************************************************************************
 * @Software: VARZAN Fahrtendienst v1.1.4.0
 * @author:   Trajilovic Goran All Right Reserved
 * @website:  http://www.globcast.eu
 * @e-mail:   gorance@live.de
 * @Info:     Sende GPS Koordinaten
 ************************************************************************************************************************************/

if(isset($_POST['id']) && isset($_POST['accept'])){
$response = array();
$datenow = date("Y-m-d H:i:s");

require_once 'core/db_connect.php';
$db = new DB_CONNECT();

//Pass your driver number here
$id = $_POST['id'];
$accept = $_POST['accept'];
$driver_email = $_POST['email'];

$baza = mysql_query("select * from locations where email = '$driver_email'");
while($row = mysql_fetch_array($baza))
{
$latitude = $row['latitude'];
$longitude = $row['longitude'];  
}
  
// ********* EINSTIEG STATUS ************
if ($accept=="1"){
$result = mysql_query("UPDATE texirequest SET accept ='$accept' , start_time ='$datenow' , latitude='$latitude', longitude='$longitude' where id = '$id' ");
 
// ********* AUSSTIEG STATUS ************ 
}else if ($accept=="2"){
$result = mysql_query("UPDATE texirequest SET accept ='$accept' , end_time ='$datenow' where id = '$id' ");

// ********* UMSONST STATUS***************
}else if ($accept=="3"){
$result = mysql_query("UPDATE texirequest SET accept ='$accept' , start_time ='$datenow' , end_time ='$datenow' , latitude='$latitude', longitude='$longitude' where id = '$id' ");

// ********************************************** ANKUNFT STATUS START TESTING ********************************************************
}else if ($accept=="4"){
//$result = mysql_query("UPDATE texirequest SET accept ='$accept' , start_time ='$datenow' , end_time ='$datenow' , ums_latitude='$latitude', ums_longitude='$longitude' where id = '$id' ");
// ***********************************************ANKUNFT STATUS STOP TESTING *********************************************************
}else{
    $result = mysql_query("UPDATE texirequest SET accept ='$accept' where id = '$id'");
}
	if($result){
			$response["success"] = 1;
			$response["message"] = "Data Update successful.";
			echo json_encode($response);
		}else{
			$response["success"] = 0;
			$response["message"] = "Could not load data".mysql_error();
			echo json_encode($response);
		}
}else{

	$response["success"] = 0;
	$response["message"] = "Required field(s) is missing";
	// echoing JSON response
	echo json_encode($response);

}
?>
