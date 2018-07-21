<?php
/*
 * @author Trajilovic Goran
 * @website http://www.globcast.eu
 * Fahrtendienst Software v1.0
 */
require_once './config.php';
include './header.php';
try {
   $sql = "SELECT * FROM users WHERE 1 AND user_id = :cid";
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
            <h3>Driver Profil </h3>
          </div>
      <div class="panel-body">
        <form class="form-horizontal" name="driver_form" id="driver_form" enctype="multipart/form-data" method="post" action="driver_process_form.php">
          <fieldset>
            <div class="form-group">
              <label class="col-lg-4 control-label" for="user_name"><span class="required">*</span>Driver Name:</label>
              <div class="col-lg-5">
                <input type="text" readonly="" placeholder="Driver Name" value="<?php echo $results[0]["user_name"] ?>" id="user_name" class="form-control" name="user_name"><span id="first_name_err" class="error"></span>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="user_email">E-mail:</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php echo $results[0]["user_email"] ?>" placeholder="E-mail" id="user_email" class="form-control" name="user_email">
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="last_name"><span class="required">*</span>Phone Number:</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php echo $results[0]["user_num"] ?>" placeholder="Last Name" id="last_name" class="form-control" name="last_name"><span id="last_name_err" class="error"></span>
              </div>
            </div>
            
             <div class="form-group">
              <label class="col-lg-4 control-label" for="profile_pic">Profile picture:</label>
              <div class="col-lg-5">
                <?php $pic = ($results[0]["user_name"] <> "" ) ? $results[0]["user_name"] : "no_avatar.png" ?>
                <a href="profile_pics/<?php echo $pic ?>.png" target="_blank"><img src="profile_pics/<?php echo $pic ?>.png" alt="" width="100" height="100" class="thumbnail" ></a>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="email_id"><span class="required">*</span>KFZ:</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php echo $results[0]["pin"] ?>" placeholder="KFZ Kenzeichen" id="pin" class="form-control" name="pin"><span id="pin" class="error"></span>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="IMEI"><span class="required">*</span>IMEI:</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php echo $results[0]["imei"] ?>" placeholder="Contact Number" id="user_num" class="form-control" name="user_num"><span id="contact_no1_err" class="error"></span>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="contact_no2">Simcard Serial:</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php echo $results[0]["sim_serial"] ?>" placeholder="Contact Number" id="contact_no2" class="form-control" name="contact_no2"><span id="contact_no2_err" class="error"></span>
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