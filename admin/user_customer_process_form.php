<?php
/*
 * @author Trajilovic Goran
 * @website http://www.globcast.eu
 * Fahrtendienst Software v1.0
 */
require './config.php';
$mode = $_REQUEST["mode"];
if ($mode == "add_new" ) {
  $name = trim($_POST['name']);
  $user_email = trim($_POST['useremail']);
  $driver_id = $_SESSION['user_id'];
  $phone = trim($_POST['phone']);
  $fsw = trim($_POST['fsw']);
  $sbehalt = trim($_POST['sbehalt']);
  $kassa = trim($_POST['kassa']);
  $SvNr = trim($_POST['SvNr']);
  $kdnr = trim($_POST['kdnr']);
  $typ = trim($_POST['typ']);
  $location = trim($_POST['location']);
  $droplocation = trim($_POST['droplocation']);
  $mobilitet = trim($_POST['mobilitet']);
  $phoneM = trim($_POST['phoneM']);
  $phoneF = trim($_POST['phoneF']);
  $bfahrer = trim($_POST['bfahrer']);
  $zinfo = trim($_POST['zinfo']);
  $Transportar = trim($_POST['Transportar']);
  $dauer_auftrag = trim($_POST['dauerauftrag']);
  $filename = "";
  $error = FALSE;

  if (is_uploaded_file($_FILES["profile_pic"]["tmp_name"])) {
    $filename = time() . '_' . $_FILES["profile_pic"]["name"];
    $filepath = 'profile_pics/' . $filename;
    if (!move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $filepath)) {
      $error = TRUE;
    }
  }

  if (!$error) {
    $sql = "INSERT INTO `userkunden` (`name`, `user_email`, `driver_id`, `phone`, `fsw`, `sbehalt`, `kassa`, `SvNr`, `kdnr`, `typ`, `location`, `droplocation`, `mobilitet`, `phoneM`, `phoneF`, `bfahrer`, `zinfo`, `Transportar`, `dauer_auftrag`) VALUES "
         . "( :name, :useremail, :driverid, :phone, :fsw, :sbehalt, :kassa, :SvNr, :kdnr, :typ, :location, :droplocation, :mobilitet, :phoneM, :phoneF, :bfahrer, :zinfo, :Transportar, :dauerauftrag)";
    try {
      $stmt = $DB->prepare($sql);

      // bind the values
      $stmt->bindValue(":name", $name);
      $stmt->bindValue(":useremail", $user_email);
      $stmt->bindValue(":driverid", $driver_id);
      $stmt->bindValue(":phone", $phone);
      $stmt->bindValue(":fsw", $fsw);
      $stmt->bindValue(":sbehalt", $sbehalt);
      $stmt->bindValue(":kassa", $kassa);
      $stmt->bindValue(":SvNr", $SvNr);
      $stmt->bindValue(":kdnr", $kdnr);
      $stmt->bindValue(":typ", $typ);
      $stmt->bindValue(":location", $location);
      $stmt->bindValue(":droplocation", $droplocation);
      $stmt->bindValue(":mobilitet", $mobilitet);
      $stmt->bindValue(":phoneM", $phoneM);
      $stmt->bindValue(":phoneF", $phoneF);
      $stmt->bindValue(":bfahrer", $bfahrer);
      $stmt->bindValue(":zinfo", $zinfo);
      $stmt->bindValue(":Transportar", $Transportar);
      $stmt->bindValue(":dauerauftrag", $dauer_auftrag);


      // execute Query
      $stmt->execute();
      $result = $stmt->rowCount();
      if ($result > 0) {
        $_SESSION["errorType"] = "success";
        $_SESSION["errorMsg"] = "Customer added successfully.";
      } else {
        $_SESSION["errorType"] = "danger";
        $_SESSION["errorMsg"] = "Failed to add Customer.";
      }
    } catch (Exception $ex) {

      $_SESSION["errorType"] = "danger";
      $_SESSION["errorMsg"] = $ex->getMessage();
    }
  } else {
    $_SESSION["errorType"] = "danger";
    $_SESSION["errorMsg"] = "failed to upload image.";
  }
  header("location:user_all_customer.php");
} elseif ( $mode == "update_old" ) {

  $name = trim($_POST['name']);
  $user_email = trim($_POST['useremail']);
  $driver_id = $_SESSION['user_id'];
  $phone = trim($_POST['phone']);
  $fsw = trim($_POST['fsw']);
  $sbehalt = trim($_POST['sbehalt']);
  $kassa = trim($_POST['kassa']);
  $SvNr = trim($_POST['SvNr']);
  $kdnr = trim($_POST['kdnr']);
  $typ = trim($_POST['typ']);
  $cid = trim($_POST['cid']);
  $location = trim($_POST['location']);
  $droplocation = trim($_POST['droplocation']);
  $mobilitet = trim($_POST['mobilitet']);
  $phoneM = trim($_POST['phoneM']);
  $phoneF = trim($_POST['phoneF']);
  $bfahrer = trim($_POST['bfahrer']);
  $zinfo = trim($_POST['zinfo']);
  $Transportar = trim($_POST['Transportar']);
  $dauer_auftrag = trim($_POST['dauerauftrag']);
  $filename = "";
  $error = FALSE;

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
    $sql = "UPDATE `userkunden` SET `name` = :name, `user_email` = :useremail, `driver_id` = :driverid, `phone` = :phone, `fsw` = :fsw, `sbehalt` = :sbehalt, `kassa` = :kassa, `SvNr` = :SvNr, `kdnr` = :kdnr, `typ` = :typ, `location` = :location, `droplocation` = :droplocation, `mobilitet` = :mobilitet, `phoneM` = :phoneM, `phoneF` = :phoneF, `bfahrer` = :bfahrer, `zinfo` = :zinfo, `Transportar` = :Transportar, `dauer_auftrag` = :dauerauftrag  "
 . "WHERE user_id = :cid";

    try {
      $stmt = $DB->prepare($sql);

      // bind the values
      $stmt->bindValue(":name", $name);
      $stmt->bindValue(":useremail", $user_email);
      $stmt->bindValue(":driverid", $driver_id);
      $stmt->bindValue(":phone", $phone);
      $stmt->bindValue(":fsw", $fsw);
      $stmt->bindValue(":sbehalt", $sbehalt);
      $stmt->bindValue(":kassa", $kassa);
      $stmt->bindValue(":SvNr", $SvNr);
      $stmt->bindValue(":kdnr", $kdnr);
      $stmt->bindValue(":typ", $typ);
      $stmt->bindValue(":cid", $cid);
      $stmt->bindValue(":location", $location);
      $stmt->bindValue(":droplocation", $droplocation);
      $stmt->bindValue(":mobilitet", $mobilitet);
      $stmt->bindValue(":phoneM", $phoneM);
      $stmt->bindValue(":phoneF", $phoneF);
      $stmt->bindValue(":bfahrer", $bfahrer);
      $stmt->bindValue(":zinfo", $zinfo);
      $stmt->bindValue(":Transportar", $Transportar);
      $stmt->bindValue(":dauerauftrag", $dauer_auftrag);


      // execute Query
      $stmt->execute();
      $result = $stmt->rowCount();
      if ($result > 0) {
        $_SESSION["errorType"] = "success";
        $_SESSION["errorMsg"] = "Customer updated successfully.";
      } else {
        $_SESSION["errorType"] = "info";
        $_SESSION["errorMsg"] = "No changes made to Customer.";
      }
    } catch (Exception $ex) {

      $_SESSION["errorType"] = "danger";
      $_SESSION["errorMsg"] = $ex->getMessage();
    }
  } else {
    $_SESSION["errorType"] = "danger";
    $_SESSION["errorMsg"] = "Failed to upload image.";
  }
  header("location:user_all_customer.php?pagenum=".$_POST['pagenum']);
} elseif ( $mode == "delete" ) {
   $cid = intval($_GET['cid']);

   $sql = "DELETE FROM `userkunden` WHERE user_id = :cid";
   try {

      $stmt = $DB->prepare($sql);
      $stmt->bindValue(":cid", $cid);

       $stmt->execute();
       $res = $stmt->rowCount();
       if ($res > 0) {
        $_SESSION["errorType"] = "success";
        $_SESSION["errorMsg"] = "Customer deleted successfully.";
      } else {
        $_SESSION["errorType"] = "info";
        $_SESSION["errorMsg"] = "Failed to delete Customer.";
      }

   } catch (Exception $ex) {
      $_SESSION["errorType"] = "danger";
      $_SESSION["errorMsg"] = $ex->getMessage();
   }

   header("location:user_all_customer.php?pagenum=".$_GET['pagenum']);
}
?>
