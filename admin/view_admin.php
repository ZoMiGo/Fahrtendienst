<?php
/*
 * @author Trajilovic Goran
 * @website http://www.globcast.eu
 * Fahrtendienst Software v1.0
 */
require_once './config.php';
include './header.php';
try {
   $sql = "SELECT * FROM system_users WHERE 1 AND u_userid = :cid";
   $stmt = $DB->prepare($sql);
   $stmt->bindValue(":cid", intval($_GET["cid"]));
   
   $stmt->execute();
   $results = $stmt->fetchAll();
} catch (Exception $ex) {
  echo $ex->getMessage();
}

?>

<div id="cl-wrapper">
  <div class="container-fluid" id="pcont">
    <!-- TOP NAVBAR -->

    <div class="cl-mcont">
	  <div class="row">
	    <div class="col-sm-12 col-md-12">
        <div class="block-flat">
          <div class="header">							
            <h3>Dispo Acount Management </h3>
          </div>
      <div class="panel-body">
        <form class="form-horizontal" name="admin_form" id="admin_form" enctype="multipart/form-data" method="post" action="admin_process_form.php">
          <fieldset>
            <div class="form-group">
              <label class="col-lg-4 control-label" for="uusername"><span class="required">*</span>User Name:</label>
              <div class="col-lg-5">
                <input type="text" readonly="" placeholder="Name von Disponenten" value="<?php echo $results[0]["u_username"] ?>" id="user_name" class="form-control" name="user_name"><span id="first_name_err" class="error"></span>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="email">E-mail:</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php echo $results[0]["email"] ?>" placeholder="E-mail" id="email" class="form-control" name="user_email">
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="name"><span class="required">*</span>Name:</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php echo $results[0]["name"] ?>" placeholder="Name" id="name" class="form-control" name="last_name"><span id="last_name_err" class="error"></span>
              </div>
            </div>
            
             <div class="form-group">
              <label class="col-lg-4 control-label" for="profile_pic">Profile picture:</label>
              <div class="col-lg-5">
                <?php 
                 $pic = ($results[0]["name"]<> "" ) ? $results[0]["name"] : "no_avatar.png" ?>
                <a href="profile_pics/<?php echo $pic ?>.png" target="_blank"><img src="profile_pics/<?php echo $pic ?>.png" alt="" width="100" height="100" class="thumbnail" ></a>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="email_id"><span class="required">*</span>Password:</label>
              <div class="col-lg-5">
                <input type="password" readonly="" value="<?php echo $results[0]["u_password"] ?>" placeholder="Password" id="pin" class="form-control" name="pin"><span id="pin" class="error"></span>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="IMEI"><span class="required">*</span>Category:</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php echo $results[0]["category"] ?>" placeholder="Category" id="user_num" class="form-control" name="user_num"><span id="contact_no1_err" class="error"></span>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="contact_no2">Zugrifsrechte:</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php echo $results[0]["u_rolecode"] ?>" placeholder="Zugrifsrechte" id="contact_no2" class="form-control" name="contact_no2"><span id="contact_no2_err" class="error"></span>
              </div>
            </div>
            </div>
          </fieldset>
        </form>

      </div>
    </div>
  </div>
<?php
include './footer.php';
?>