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
        <h3 class="panel-title"><?php echo ($_GET["m"] == "update") ? "My" : "Edit"; ?> Account</h3>
          </div>
      <div class="panel-body">

        <form class="form-horizontal" name="driver_form" id="driver_form" enctype="multipart/form-data" method="post" action="driver_process_form.php">
          <input type="hidden" name="mode" value="<?php echo ($_GET["m"] == "update") ? "update_old" : "add_new"; ?>" >
          <input type="hidden" name="old_pic" value="<?php echo $results[0]["profile_pic"] ?>" >
          <input type="hidden" name="cid" value="<?php echo intval($results[0]["user_id"]); ?>" >
          <input type="hidden" name="pagenum" value="<?php echo $_GET["pagenum"]; ?>" >
          <fieldset>
            <div class="form-group">
              <label class="col-lg-4 control-label" for="username"><span class="required">*</span>Driver Name:</label>
              <div class="col-lg-5">
                <input type="text" value="<?php echo $results[0]["user_name"] ?>" placeholder="Driver Name" id="username" class="form-control" name="username"><span id="user_name_err" class="error"></span>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-lg-4 control-label" for="useremail">E-mail:</label>
              <div class="col-lg-5">
                <input type="text" value="<?php echo $results[0]["user_email"] ?>" placeholder="E-mail" id="useremail" class="form-control" name="useremail">
                             <span class="help-block">wird als Username f&uuml;r APP Zugrif Verwendet</span>
            </div>
            </div> 
            <div class="form-group">
              <label class="col-lg-4 control-label" for="useremail">KFZ:</label>
              <div class="col-lg-5">
                <input type="text" value="<?php echo $results[0]["pin"] ?>" placeholder="KFZ Kenzeichen" id="pin" class="form-control" name="pin">
               <span class="help-block">KFZ Kenzeichen.</span>
            </div>   
            <div class="form-group">
              <label class="col-lg-4 control-label" for="IMEI"><span class="required">*</span>IMEI:</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php echo $results[0]["imei"] ?>" placeholder="Contact Number" id="imei" class="form-control" name="imei"><span id="contact_no1_err" class="error"></span>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-4 control-label" for="simserial">Simcard Serial:</label>
              <div class="col-lg-5">
                <input type="text" readonly="" value="<?php echo $results[0]["sim_serial"] ?>" placeholder="Contact Number" id="simserial" class="form-control" name="simserial"><span id="contact_no2_err" class="error"></span>
              </div>
            </div>               
             <div class="form-group">
              <label class="col-lg-4 control-label" for="password"><span class="required">*</span>Password:</label>
              <div class="col-lg-5">
                <input type="password" value="<?php echo $results[0]["password"] ?>" placeholder="Enter Password" id="password" class="form-control" name="password"><span id="password" class="error"></span>
                <span class="help-block">Enter the Driver Password for APP.</span>
              </div>
            </div> 
            <?php if ($_GET["m"] == "update") { ?>
            <?php 
            }
            ?>
            <div class="form-group">
              <label class="col-lg-4 control-label" for="kljuc"><span class="required">*</span>Decoder Key/Simcard Serial</label>
              <div class="col-lg-5">
                <input type="text" value="<?php echo $results[0]["kljuc"] ?>" placeholder="Contact Number" id="kljuc" class="form-control" name="kljuc"><span id="kljuc" class="error"></span>
                <span class="help-block">Maximum of 16 digits only and only numbers.</span>
              </div>
              <div class="form-group">
              <label class="col-lg-4 control-label" for="superkljuc"><span class="required">*</span>Decoder Superkey/IMEI</label>
              <div class="col-lg-5">
                <input type="text" value="<?php echo $results[0]["superkljuc"] ?>" placeholder="Contact Number" id="superkljuc" class="form-control" name="superkljuc"><span id="superkljuc" class="error"></span>
                <span class="help-block">Maximum of 16 digits only and only numbers.</span>
              </div>

            <div class="form-group">
              <div class="col-lg-5 col-lg-offset-4">
                <button class="btn btn-primary" type="submit">Submit</button> 
              </div>
            </div>
          </fieldset>
        </form>

      </div>
    </div>
  </div>

<script type="text/javascript">
$(document).ready(function() {
	
	// the fade out effect on hover
	$('.error').hover(function() {
		$(this).fadeOut(200);  
	});
	
	
	$("#contact_form").submit(function() {
		$('.error').fadeOut(200);  
		if(!validateForm()) {
            // go to the top of form first
            $(window).scrollTop($("#contact_form").offset().top);
			return false;
		}     
		return true;
    });

});

function validateForm() {
	 var errCnt = 0;
	 
	 var first_name = $.trim( $("#first_name").val());
     var last_name = $.trim( $("#last_name").val());
	 var email_id = $.trim( $("#email_id").val());
	 var contact_no1 = $.trim( $("#contact_no1").val());
	 var contact_no2 = $.trim( $("#contact_no2").val());
     
	 var profile_pic =  $.trim( $("#profile_pic").val());

	// Driver name
	if (user_name == "" ) {
		$("#user_name_err").html("Enter your first name.");
		$('#user_name_err').fadeIn("fast"); 
		errCnt++;
	}  else if (user_name.length <= 2 ) {
		$("#user_name_err").html("Enter atleast 3 letter.");
		$('#user_name_err').fadeIn("fast"); 
		errCnt++;
	}
    
    if (last_name == "" ) {
		$("#last_name_err").html("Enter your last name.");
		$('#last_name_err').fadeIn("fast"); 
		errCnt++;
	}  else if (last_name.length <= 2 ) {
		$("#last_name_err").html("Enter atleast 3 letter.");
		$('#last_name_err').fadeIn("fast"); 
		errCnt++;
	}
    
    if (!isValidEmail(email_id)) {
		$("#email_id_err").html("Enter valid email.");
		$('#email_id_err').fadeIn("fast"); 
		errCnt++;
	}
    
    if (contact_no1 == "" ) {
		$("#contact_no1_err").html("Enter first contact number.");
		$('#contact_no1_err').fadeIn("fast"); 
		errCnt++;
	}  else if (contact_no1.length <= 9 || contact_no1.length > 10 ) {
		$("#contact_no1_err").html("Enter 10 digits only.");
		$('#contact_no1_err').fadeIn("fast"); 
		errCnt++;
	} else if ( !$.isNumeric(contact_no1) ) {
		$("#contact_no1_err").html("Must be digits only.");
		$('#contact_no1_err').fadeIn("fast"); 
		errCnt++;
	}
    
    if (contact_no2.length > 0) {
      if (contact_no2.length <= 9 || contact_no2.length > 10 ) {
		$("#contact_no2_err").html("Enter 10 digits only.");
		$('#contact_no2_err').fadeIn("fast"); 
		errCnt++;
	} else if ( !$.isNumeric(contact_no2) ) {
		$("#contact_no2_err").html("Must be digits only.");
		$('#contact_no2_err').fadeIn("fast"); 
		errCnt++;
	}
    }
    
    
    if (profile_pic.length > 0) {
        var exts = ['jpg','jpeg','png','gif', 'bmp'];
		var get_ext = profile_pic.split('.');
		get_ext = get_ext.reverse();
        
       
        if ($.inArray ( get_ext[0].toLowerCase(), exts ) <= -1 ){
          $("#profile_pic_err").html("Must me jpg, jpeg, png, gif, bmp image only..");
          $('#profile_pic_err').fadeIn("fast"); 
        }
       
    }
    
	if(errCnt > 0) return false; else return true;
}

function isValidEmail(email) {
  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
</script>
<?php
include './footer.php';
?>