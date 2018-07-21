<?php
require_once './config.php';

/*************************************************************************************************************************************
 * @author Trajilovic Goran
 * @website http://www.globcast.eu
 * @e-mail gorance@live.de
 * Fahrtendienst Software v3.0
 ************************************************************************************************************************************/
$mode = $_REQUEST["mode"];
if ($mode == "add_new" ) {
  $driver_id = trim($_POST['driverid']);
  $driver_email = trim($_POST['driveremail']);
  $driver_name = trim($_POST['drivername']);
  $sender_id = trim($_POST['senderid']);
  $name = trim($_POST['name']);
  $typ = trim($_POST['typ']);
  $sbehalt = trim($_POST['sbehalt']);
  $cid = trim($_POST['cid']);
  $Transportar = trim($_POST['Transportar']);
  $bfahrer = trim($_POST['bfahrer']);
  $zinfo = trim($_POST['zinfo']);
  $dauer_auftrag = trim($_POST['dauerauftrag']);
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
  $auftrag_typ = "dispo"; //"texirequest"; // Vorbereitung für Auftrag Art

  if (is_uploaded_file($_FILES["profile_pic"]["tmp_name"])) {
    $filename = time() . '_' . $_FILES["profile_pic"]["name"];
    $filepath = 'profile_pics/' . $filename;
    if (!move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $filepath)) {
      $error = TRUE;
    }
  }

  if (!$error) {
    $sql = "INSERT INTO `dispo` (`driver_id`, `driver_email`, `driver_name`, `sender_id`, `name`, `typ`, `sbehalt`, `Transportar`, `bfahrer`, `zinfo`, `dauer_auftrag`, `status`, `phoneM`, `phoneF`, `termin`, `phone`, `droplocation`, `location`, `latitude`, `longitude`, `timedate`, `disponent`, `accept`) 
VALUES ". "(:driverid, :driveremail, :drivername, :senderid, :name, :typ, :sbehalt, :Transportar, :bfahrer, :zinfo, :dauerauftrag, :status, :phoneM, :phoneF, :termin, :phone, :droplocation, :location, :latitude, :longitude, :timedate, :disponent, :accept)";
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
  header("location:all_freizeit.php");
} elseif ( $mode == "update_old" ) {

  $driver_id = trim($_POST['driverid']);
  $driver_email = trim($_POST['driveremail']);
  $driver_name = trim($_POST['drivername']);
  $sender_id = trim($_POST['senderid']);
  $name = trim($_POST['name']);
  $typ = trim($_POST['typ']);
  $sbehalt = trim($_POST['sbehalt']);
  $cid = trim($_POST['cid']);
  $Transportar = trim($_POST['Transportar']);
  $bfahrer = trim($_POST['bfahrer']);
  $zinfo = trim($_POST['zinfo']);
  $dauer_auftrag = trim($_POST['dauerauftrag']);
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
  $auftrag_typ = "dispo"; //"texirequest"; // Vorbereitung für Auftrag Art

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
    $sql = "UPDATE `dispo` SET `driver_id` = :driverid, `driver_email` = :driveremail, `driver_name` = :drivername, `sender_id` = :senderid, `name` = :name, `typ` = :typ, `sbehalt` = :sbehalt, `Transportar` = :Transportar, `bfahrer` = :bfahrer, `zinfo` = :zinfo, `dauer_auftrag` = :dauerauftrag, `status` = :status, `phoneM` = :phoneM, `phoneF` = :phoneF, `termin` = :termin, `phone` = :phone, `droplocation` = :droplocation, `location` = :location, `latitude` = :latitude, `longitude` = :longitude, `termindate` = :termindate, `disponent` = :disponent, `accept` = :accept "
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
      $stmt->bindValue(":cid", $cid);
      $stmt->bindValue(":droplocation", $droplocation);
      $stmt->bindValue(":location", $location);
      $stmt->bindValue(":latitude", $latitude);
      $stmt->bindValue(":longitude", $longitude);
      $stmt->bindValue(":timedate", $timedate);
      $stmt->bindValue(":disponent", $disponent);
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
  header("location:all_freizeit.php?pagenum=".$_POST['pagenum']);
} elseif ( $mode == "delete" ) {
   $cid = intval($_GET['cid']);

   $sql = "DELETE FROM `dispo` WHERE id = :cid";
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

   header("location:all_freizeit.php?pagenum=".$_GET['pagenum']);
}

?>
