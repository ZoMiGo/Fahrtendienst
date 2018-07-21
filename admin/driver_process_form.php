<?php
/*
 * @author Trajilovic Goran
 * @website http://www.globcast.eu
 * Fahrtendienst Software v1.0
 */
 
require './config.php';
$mode = $_REQUEST["mode"];
if ($mode == "add_new" ) {
  $user_name = trim($_POST['username']);
  $password = trim($_POST['password']);
  $pin = trim($_POST['pin']);
  $user_email = trim($_POST['useremail']);
  $user_num = trim($_POST['usernum']);  
  $category = trim($_POST['category']);  
  $imei = trim($_POST['imei']);
  $sim_serial = trim($_POST['simserial']);
  $kljuc = trim($_POST['kljuc']);
  $superkljuc = trim($_POST['superkljuc']);


  $cid = trim($_POST['cid']);
  $filename = "";
  $error = FALSE;
  $category = "driver";  // set Driver Category "Driver" - "Customer"

  if (is_uploaded_file($_FILES["profile_pic"]["tmp_name"])) {
    $filename = time() . '_' . $_FILES["profile_pic"]["name"];
    $filepath = 'profile_pics/' . $filename;
    if (!move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $filepath)) {
      $error = TRUE;
    }
  }

  if (!$error) {
    $sql = "INSERT INTO `users` (`user_name`, `password`, `pin`, `user_email`, `user_num`, `category`, `imei`, `sim_serial`, `kljuc`, `superkljuc`) VALUES "
         . "( :username, :password, :pin, :useremail, :usernum, :category, :imei, :simserial, :kljuc, :superkljuc)";
    try {
      $stmt = $DB->prepare($sql);

      // bind the values
      $stmt->bindValue(":username", $user_name);
      $stmt->bindValue(":password", $password);
      $stmt->bindValue(":pin", $pin);
      $stmt->bindValue(":useremail", $user_email);
      $stmt->bindValue(":usernum", $user_num);
      $stmt->bindValue(":category", $category);
      $stmt->bindValue(":imei", $imei);
      $stmt->bindValue(":simserial", $sim_serial);
      $stmt->bindValue(":kljuc", $kljuc);
      $stmt->bindValue(":superkljuc", $superkljuc);

      // execute Query
      $stmt->execute();
      $result = $stmt->rowCount();
      if ($result > 0) {
        $_SESSION["errorType"] = "success";
        $_SESSION["errorMsg"] = "Driver added successfully.";
      } else {
        $_SESSION["errorType"] = "danger";
        $_SESSION["errorMsg"] = "Failed to add Driver.";
      }
    } catch (Exception $ex) {

      $_SESSION["errorType"] = "danger";
      $_SESSION["errorMsg"] = $ex->getMessage();
    }
  } else {
    $_SESSION["errorType"] = "danger";
    $_SESSION["errorMsg"] = "failed to upload image.";
  }
  header("location:driver_setings.php"); // all_driver.php
} elseif ( $mode == "update_old" ) {

  $user_name = trim($_POST['username']);
  $password = trim($_POST['password']);
  $pin = trim($_POST['pin']);
  $user_email = trim($_POST['useremail']);
  $user_num = trim($_POST['usernum']);
  $category = trim($_POST['category']);
  $imei = trim($_POST['imei']);
  $sim_serial = trim($_POST['simserial']);
  $kljuc = trim($_POST['kljuc']);
  $superkljuc = trim($_POST['superkljuc']);
  $cid = trim($_POST['cid']);
  $filename = "";
  $error = FALSE;
  $category = "driver";  // set Driver Category "Driver" - "Customer"

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
    $sql = "UPDATE `users` SET `user_name` = :username, `password` = :password, `pin` = :pin, `user_email` = :useremail, `user_num` = :usernum, `category` = :category, `imei` = :imei, `sim_serial` = :simserial, `kljuc` = :kljuc, `superkljuc` = :superkljuc  "
            . "WHERE user_id = :cid ";

    try {
      $stmt = $DB->prepare($sql);

      // bind the values
      $stmt->bindValue(":username", $user_name);
      $stmt->bindValue(":password", $password);
      $stmt->bindValue(":pin", $pin);
      $stmt->bindValue(":useremail", $user_email);
      $stmt->bindValue(":usernum", $user_num);
      $stmt->bindValue(":category", $category);
      $stmt->bindValue(":imei", $imei);
      $stmt->bindValue(":simserial", $sim_serial);
      $stmt->bindValue(":kljuc", $kljuc);
      $stmt->bindValue(":superkljuc", $superkljuc);
      $stmt->bindValue(":cid", $cid);

      // execute Query
      $stmt->execute();
      $result = $stmt->rowCount();
      if ($result > 0) {
        $_SESSION["errorType"] = "success";
        $_SESSION["errorMsg"] = "Driver updated successfully.";
      } else {
        $_SESSION["errorType"] = "info";
        $_SESSION["errorMsg"] = "No changes made to Driver.";
      }
    } catch (Exception $ex) {

      $_SESSION["errorType"] = "danger";
      $_SESSION["errorMsg"] = $ex->getMessage();
    }
  } else {
    $_SESSION["errorType"] = "danger";
    $_SESSION["errorMsg"] = "Failed to upload image.";
  }
  header("location:driver_setings.php?pagenum=".$_POST['pagenum']);
} elseif ( $mode == "delete" ) {
   $cid = intval($_GET['cid']);

   $sql = "DELETE FROM `users` WHERE user_id = :cid";
   try {

      $stmt = $DB->prepare($sql);
      $stmt->bindValue(":cid", $cid);

       $stmt->execute();
       $res = $stmt->rowCount();
       if ($res > 0) {
        $_SESSION["errorType"] = "success";
        $_SESSION["errorMsg"] = "Driver deleted successfully.";
      } else {
        $_SESSION["errorType"] = "info";
        $_SESSION["errorMsg"] = "Failed to delete Driver.";
      }

   } catch (Exception $ex) {
      $_SESSION["errorType"] = "danger";
      $_SESSION["errorMsg"] = $ex->getMessage();
   }

   header("location:driver_setings.php?pagenum=".$_GET['pagenum']);
}
?>
