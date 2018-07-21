<?php
/*
 * @author Trajilovic Goran
 * @website http://www.globcast.eu
 * Fahrtendienst Software v1.0
 */
 
require './config.php';
$mode = $_REQUEST["mode"];
if ($mode == "add_new" ) {
  $u_username = trim($_POST['uusername']);
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $u_password = trim($_POST['upassword']);
  $pin = trim($_POST['pin']);  
  $user_num = trim($_POST['usernum']);  
  $category = trim($_POST['category']);
  $imei = trim($_POST['imei']);
  $sim_serial = trim($_POST['simserial']);
  $u_rolecode = trim($_POST['urolecode']);


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
    $sql = "INSERT INTO `system_users` (`u_username`, `name`, `email`, `u_password`, `pin`, `user_num`, `category`, `imei`, `sim_serial`, `u_rolecode`) VALUES "
         . "( :username, :name, :email, :upassword, :pin, :usernum, :category, :imei, :simserial, :urolecode)";
    try {
      $stmt = $DB->prepare($sql);

      // bind the values
      $stmt->bindValue(":uusername", $u_username);
      $stmt->bindValue(":name", $name);
      $stmt->bindValue(":email", $email);
      $stmt->bindValue(":upassword", $u_password);
      $stmt->bindValue(":pin", $pin);
      $stmt->bindValue(":usernum", $user_num);
      $stmt->bindValue(":category", $category);
      $stmt->bindValue(":imei", $imei);
      $stmt->bindValue(":simserial", $sim_serial);
      $stmt->bindValue(":urolecode", $u_rolecode);

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
  header("location:admin_setings.php"); // all_admins.php
} elseif ( $mode == "update_old" ) {

  $u_username = trim($_POST['uusername']);
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $u_password = trim($_POST['upassword']);
  $pin = trim($_POST['pin']);  
  $user_num = trim($_POST['usernum']);  
  $category = trim($_POST['category']);
  $imei = trim($_POST['imei']);
  $sim_serial = trim($_POST['simserial']);
  $u_rolecode = trim($_POST['urolecode']);
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
    $sql = "UPDATE `system_users` SET `u_username` = :uusername, `name` = :name, `email` = :email, `u_password` = :upassword, `pin` = :pin, `user_num` = :usernum, `category` = :category, `imei` = :imei, `sim_serial` = :simserial, `u_rolecode` = :urolecode  "
            . "WHERE u_userid = :cid ";

    try {
      $stmt = $DB->prepare($sql);

      // bind the values
      $stmt->bindValue(":uusername", $u_username);
      $stmt->bindValue(":name", $name);
      $stmt->bindValue(":email", $email);
      $stmt->bindValue(":upassword", $u_password);
      $stmt->bindValue(":pin", $pin);
      $stmt->bindValue(":usernum", $user_num);
      $stmt->bindValue(":category", $category);
      $stmt->bindValue(":imei", $imei);
      $stmt->bindValue(":simserial", $sim_serial);
      $stmt->bindValue(":urolecode", $u_rolecode);
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
  header("location:admin_setings.php?pagenum=".$_POST['pagenum']);
} elseif ( $mode == "delete" ) {
   $cid = intval($_GET['cid']);

   $sql = "DELETE FROM `system_users` WHERE u_userid = :cid";
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

   header("location:admin_setings.php?pagenum=".$_GET['pagenum']);
}
?>
