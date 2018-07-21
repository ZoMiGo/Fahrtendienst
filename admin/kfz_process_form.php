<?php
require_once './config.php';

/*************************************************************************************************************************************
 * @author Trajilovic Goran
 * @website http://www.globcast.eu
 * @e-mail gorance@live.de
 * Fahrtendienst Software v3.0
 ************************************************************************************************************************************/
$termin = $_POST['termin'];
$id = $_POST['user_id'];
$location = $_POST['location'];
$droplocation = $_POST['droplocation'];

function GetDrivingDistance($lat1, $lat2, $long1, $long2)
{
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat1.",".$long1."&destinations=".$lat2.",".$long2."&mode=driving&language=de";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($ch);
    curl_close($ch);
    $response_a = json_decode($response, true);
$dist = $response_a['rows'][0]['elements'][0]['distance']['text'];
$time = $response_a['rows'][0]['elements'][0]['duration']['value'];

    return array('distance' => $dist, 'time' => $time);
}
function get_coordinates($city, $street, $province)
{
    $address = urlencode($city.','.$street.','.$province);
    $url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&sensor=false&region=Austria&key=$api";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($ch);
    curl_close($ch);
    $response_a = json_decode($response);
    $status = $response_a->status;

    if ( $status == 'ZERO_RESULTS' )
    {
        return FALSE;
    }
    else
    {
        $return = array('lat' => $response_a->results[0]->geometry->location->lat, 'long' => $long = $response_a->results[0]->geometry->location->lng);
        return $return;
    }
}
$coordinates1 = get_coordinates('', "$location", '');
$coordinates2 = get_coordinates('', "$droplocation", '');

$dist = GetDrivingDistance($coordinates1['lat'], $coordinates2['lat'], $coordinates1['long'], $coordinates2['long']);
$result = $dist["time"];
$hours = floor($result / 3600);
$mins = floor($result / 60 % 60);
$secs = floor($result % 60);
$endTime1 = strtotime("+ $hours hours + $mins minutes + 10 minutes", strtotime($termin)); 
$result1 = date('H:i', $endTime1);
$termin1 ="$termin - $result1";

$vreme = "$termin1";
$distanc = $dist["distance"]; // Berechnung der Entfernung in Kilometer

$pdo= new PDO('mysql:host='. $host .';dbname='.$db_name, $db_username, $db_password);

$sql = "SELECT user_email, user_name, user_id FROM users WHERE user_id = '$id'";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll();
foreach($users as $user);
$user_name = $user['user_name'];
$user_email = $user['user_email'];
$user_id = $user['user_id']; 
/*************************************************************************************************************************************
 * @author Trajilovic Goran
 * @website http://www.globcast.eu
 * @e-mail gorance@live.de
 * Fahrtendienst Software v3.0
 ************************************************************************************************************************************/
//require './modul/class_routetime.php';
$mode = $_REQUEST["mode"];
if ($mode == "add_new" ) {
  $driver_id = trim($_POST['driverid']);
  $driver_email = trim($_POST['driveremail']);
  $driver_name = trim($_POST['drivername']);
  $sender_id = trim($_POST['senderid']);
  $name = "Internet Auftrag";
  $typ = trim($_POST['typ']);
  $sbehalt = trim($_POST['sbehalt']);
  $cid = trim($_POST['cid']);
  $Transportar = trim($_POST['Transportar']);
  $bfahrer = trim($_POST['bfahrer']);
  $zinfo = trim($_POST['zinfo']);
  $dauer_auftrag = "2";
  $status = trim($_POST['status']);
  $phoneM = trim($_POST['phoneM']);
  $phoneF = trim($_POST['phoneF']);
  $termin = "$vreme";
  $phone = trim($_POST['phone']);
  $droplocation = trim($_POST['droplocation']);
  $location = trim($_POST['location']);
  $latitude = trim($_POST['latitude']);
  $longitude = trim($_POST['longitude']);
  $timedate = trim($_POST['timedate']);  // DATA READ BY FORMULAR
  $disponent = $_SESSION["name"];
  $accept = trim($_POST['accept']);
  $filename = "";
  $error = FALSE;
  $sender_id = "27";  // setings
  $driver_id = "$user_id";  // setings
  $driver_email = "$user_email";
  $driver_name = "$user_name";
  $auftrag_typ = "dauer"; //"texirequest"; // Vorbereitung für Auftrag Art

  if (is_uploaded_file($_FILES["profile_pic"]["tmp_name"])) {
    $filename = time() . '_' . $_FILES["profile_pic"]["name"];
    $filepath = 'profile_pics/' . $filename;
    if (!move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $filepath)) {
      $error = TRUE;
    }
  }

  if (!$error) {
    $sql = "INSERT INTO `$auftrag_typ` (`driver_id`, `driver_email`, `driver_name`, `sender_id`, `name`, `typ`, `sbehalt`, `Transportar`, `bfahrer`, `zinfo`, `dauer_auftrag`, `status`, `phoneM`, `phoneF`, `termin`, `phone`, `droplocation`, `location`, `latitude`, `longitude`, `timedate`, `disponent`, `accept`) 
VALUES ". "(:driverid, :driveremail, :drivername, :senderid, :name, :typ, :sbehalt, :Transportar, :bfahrer, :zinfo, :dauerauftrag, :status :auftrag_typ, :phoneM, :phoneF, :termin, :phone, :droplocation, :location, :latitude, :longitude, :timedate, :disponent, :accept)";
    try {
      $stmt = $DB->prepare($sql);

      // bind the values
      $stmt->bindValue(":driverid", $driver_id);
      $stmt->bindValue(":driveremail", $driver_email);
      $stmt->bindValue(":drivername", $driver_name);
      $stmt->bindValue(":senderid", $sender_id);
      $stmt->bindValue(":name", $name);
      $stmt->bindValue(":typ", $typ);
      $stmt->bindValue(":sbehalt", $sbehalt);
      $stmt->bindValue(":Transportar", $Transportar);
      $stmt->bindValue(":bfahrer", $bfahrer);
      $stmt->bindValue(":zinfo", $zinfo);
      $stmt->bindValue(":dauerauftrag", $dauer_auftrag);
      $stmt->bindValue(":status", $status);
      $stmt->bindValue(":phoneM", $phoneM);
      $stmt->bindValue(":phoneF", $phoneF);
      $stmt->bindValue(":termin", $termin);
      $stmt->bindValue(":phone", $phone);
      $stmt->bindValue(":droplocation", $droplocation);
      $stmt->bindValue(":location", $location);
      $stmt->bindValue(":latitude", $latitude);
      $stmt->bindValue(":longitude", $longitude);
      $stmt->bindValue(":timedate", $timedate);
      $stmt->bindValue(":disponent", $disponent);
      $stmt->bindValue(":auftrag_typ", $auftrag_typ);
      $stmt->bindValue(":accept", $accept);

      // execute Query
      $stmt->execute();
      $result = $stmt->rowCount();
      if ($result > 0) {
        $_SESSION["errorType"] = "success";
        $_SESSION["errorMsg"] = "Dauer Auftrag added successfully.";
      } else {
        $_SESSION["errorType"] = "danger";
        $_SESSION["errorMsg"] = "Failed to add Dauer Auftrag.";
      }
    } catch (Exception $ex) {

      $_SESSION["errorType"] = "danger";
      $_SESSION["errorMsg"] = $ex->getMessage();
    }
  } else {
    $_SESSION["errorType"] = "danger";
    $_SESSION["errorMsg"] = "failed to upload image.";
  }
  header("location:all_kfz.php");
} elseif ( $mode == "update_old" ) {

  $driver_id = trim($_POST['driverid']);
  $driver_email = trim($_POST['driveremail']);
  $driver_name = trim($_POST['drivername']);
  $sender_id = trim($_POST['senderid']);
  $name = "Internet Auftrag";
  $typ = trim($_POST['typ']);
  $sbehalt = trim($_POST['sbehalt']);
  $cid = trim($_POST['cid']);
  $Transportar = trim($_POST['Transportar']);
  $bfahrer = trim($_POST['bfahrer']);
  $zinfo = trim($_POST['zinfo']);
  $dauer_auftrag = "2";
  $status = trim($_POST['status']);
  $phoneM = trim($_POST['phoneM']);
  $phoneF = trim($_POST['phoneF']);
  $termin = "$vreme";
  $phone = trim($_POST['phone']);
  $droplocation = trim($_POST['droplocation']);
  $location = trim($_POST['location']);
  $latitude = trim($_POST['latitude']);
  $longitude = trim($_POST['longitude']);
  $timedate = trim($_POST['timedate']);  // DATA READ BY FORMULAR
  $disponent = $_SESSION["name"];
  $accept = trim($_POST['accept']);
  $filename = "";
  $error = FALSE;
  $sender_id = "27";  // setings
  $driver_id = "$user_id";  // setings
  $driver_email = "$user_email";
  $driver_name = "$user_name";
  $auftrag_typ = "dauer"; //"texirequest"; // Vorbereitung für Auftrag Art

  if (is_uploaded_file($_FILES["profile_pic"]["tmp_name"])) {
    $filename = time() . '_' . $_FILES["profile_pic"]["name"];
    $filepath = 'profile_pics/' . $filename;
    if (!move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $filepath)) {
      $error = TRUE;
    }
  } else {
     $filename = $_POST['old_pic'];
  }

  if (!$error) {
    $sql = "UPDATE `$auftrag_typ` SET `driver_id` = :driverid, `driver_email` = :driveremail, `driver_name` = :drivername, `sender_id` = :senderid, `name` = :name, `typ` = :typ, `sbehalt` = :sbehalt, `Transportar` = :Transportar, `bfahrer` = :bfahrer, `zinfo` = :zinfo, `dauer_auftrag` = :dauerauftrag, `status` = :status, `phoneM` = :phoneM, `phoneF` = :phoneF, `termin` = :termin, `phone` = :phone, `droplocation` = :droplocation, `location` = :location, `latitude` = :latitude, `longitude` = :longitude, `termindate` = :termindate, `disponent` = :disponent, `accept` = :accept "
    . "WHERE id = :cid ";

    try {
      $stmt = $DB->prepare($sql);

      // bind the values
      $stmt->bindValue(":driverid", $driver_id);
      $stmt->bindValue(":driveremail", $driver_email);
      $stmt->bindValue(":drivername", $driver_name);
      $stmt->bindValue(":senderid", $sender_id);
      $stmt->bindValue(":name", $name);
      $stmt->bindValue(":typ", $typ);
      $stmt->bindValue(":sbehalt", $sbehalt);
      $stmt->bindValue(":Transportar", $Transportar);
      $stmt->bindValue(":bfahrer", $bfahrer);
      $stmt->bindValue(":zinfo", $zinfo);
      $stmt->bindValue(":dauerauftrag", $dauer_auftrag);
      $stmt->bindValue(":status", $status);
      $stmt->bindValue(":phoneM", $phoneM);
      $stmt->bindValue(":phoneF", $phoneF);
      $stmt->bindValue(":termin", $termin);
      $stmt->bindValue(":phone", $phone);
      $stmt->bindValue(":droplocation", $droplocation);
      $stmt->bindValue(":location", $location);
      $stmt->bindValue(":latitude", $latitude);
      $stmt->bindValue(":longitude", $longitude);
      $stmt->bindValue(":cid", $cid);
      $stmt->bindValue(":timedate", $timedate);
      $stmt->bindValue(":disponent", $disponent);
      $stmt->bindValue(":auftrag_typ", $auftrag_typ);
      $stmt->bindValue(":accept", $accept);



      // execute Query
      $stmt->execute();
      $result = $stmt->rowCount();
      if ($result > 0) {
        $_SESSION["errorType"] = "success";
        $_SESSION["errorMsg"] = "Dauer Auftrag updated successfully.";
      } else {
        $_SESSION["errorType"] = "info";
        $_SESSION["errorMsg"] = "No changes made to Dauer Auftrag.";
      }
    } catch (Exception $ex) {

      $_SESSION["errorType"] = "danger";
      $_SESSION["errorMsg"] = $ex->getMessage();
    }
  } else {
    $_SESSION["errorType"] = "danger";
    $_SESSION["errorMsg"] = "Failed to upload image.";
  }
  header("location:all_kfz.php?pagenum=".$_POST['pagenum']);
} elseif ( $mode == "delete" ) {
   $cid = intval($_GET['cid']);

   $sql = "DELETE FROM `texirequest` WHERE id = :cid";
   try {

      $stmt = $DB->prepare($sql);
      $stmt->bindValue(":cid", $cid);

       $stmt->execute();
       $res = $stmt->rowCount();
       if ($res > 0) {
        $_SESSION["errorType"] = "success";
        $_SESSION["errorMsg"] = "Dauer Auftrag deleted successfully.";
      } else {
        $_SESSION["errorType"] = "info";
        $_SESSION["errorMsg"] = "Failed to delete Dauer Auftrag.";
      }

   } catch (Exception $ex) {
      $_SESSION["errorType"] = "danger";
      $_SESSION["errorMsg"] = $ex->getMessage();
   }

   header("location:all_kfz.php?pagenum=".$_GET['pagenum']);
}

?>
