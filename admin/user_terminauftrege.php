<?php
require_once './config.php';
include './header.php';
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    // not logged in send to login page
    redirect("index.php");
}
$status = FALSE;
if ( authorize($_SESSION["access"]["CUSTM_driver"]["CUSTM_driver"]["create"]) ||
     authorize($_SESSION["access"]["CUSTM_driver"]["CUSTM_driver"]["edit"]) ||
     authorize($_SESSION["access"]["CUSTM_driver"]["CUSTM_driver"]["view"]) ||
     authorize($_SESSION["access"]["CUSTM_driver"]["CUSTM_driver"]["delete"]) ) {
     $status = TRUE;
}
$driver_id = $_SESSION['user_id'];

if ($status === FALSE) {
die("You dont have the permission to access this page");
}
$curentdate = date('Y-m-d');
//Connect to our MySQL database using the PDO extension.
$pdo= new PDO('mysql:host='. $host .';dbname='.$db_name, $db_username, $db_password);
$sql = "SELECT user_id, name FROM userkunden WHERE driver_id ='$driver_id'";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$kunden = $stmt->fetchAll();

//Our select statement. This will retrieve the data that we want.
$driver = "SELECT user_email, user_name, user_id FROM users WHERE category = 'driver'";
$stmt = $pdo->prepare($driver);
$stmt->execute();
$users = $stmt->fetchAll();

$link = mysql_connect("localhost","$db_username","$db_password");
mysql_select_db("$db_name",$link);

$sql = "SELECT * FROM userkunden";
$aResult = mysql_query($sql);
if($_REQUEST['frm_action'] == 3)
{
if ($_REQUEST['user_id'] == 0)
{
$user_id = $_REQUEST['user_id'];
$sqlCustomer = "SELECT * FROM userkunden";
}
else
{
$user_id = $_REQUEST['cid'];
$sqlCustomer = "SELECT * FROM userkunden";
}
$aCustomer = mysql_query($sqlCustomer);
}
?>
<html>
<head>
<script type="text/javascript">
function changeSID()
{
oForm       = eval(document.getElementById("frmForm"));
iCustomerId = document.getElementById("user_id").value;
url         = "user_terminauftrege.php?frm_action=3&cid=" +iCustomerId;
document.location = url;
}
</script>
</head>


<?php
$sid1 = $_REQUEST['cid'];
while($rows=mysql_fetch_array($aResult,MYSQL_ASSOC))
{
$user_id  = $rows['user_id'];
$name = $rows['name'];
if($sid1 == $user_id)
{
$chkselect = 'selected';

}
else
{
$chkselect ='';
}
?>
<?php } ?>

<?php
{
try {
   $sql = "SELECT * FROM userkunden WHERE 1 AND user_id = $sid1";
   $stmt = $DB->prepare($sql);
   $stmt->bindValue(":user_id", intval($_GET["$sid1"]));

   $stmt->execute();
   $results = $stmt->fetchAll();
} catch (Exception $ex) {
  echo $ex->getMessage();
}
$typ = $results[0]["typ"];
$transport = $results[0]["Transportar"];
$sbehalt = $results[0]["sbehalt"];
$dauer_auftrag = $results[0]["dauer_auftrag"];
$bfahrer = $results[0]["bfahrer"];
//echo $_SESSION['name']; 
 ?>
<div id="cl-wrapper">
  <div class="container-fluid" id="pcont">
    <!-- TOP NAVBAR -->

    <div class="cl-mcont">
	  <div class="row">
	    <div class="col-sm-12 col-md-12">
        <div class="block-flat">
          <div class="header">
            <h3>Termin Auftrag Vergabe </h3>
          </div>
<?php if ($ERROR_MSG <> "") { ?>
    <div class="alert alert-dismissable alert-<?php echo $ERROR_TYPE ?>">
      <button data-dismiss="alert" class="close" type="button">�</button>
      <p><?php echo $ERROR_MSG; ?></p>
    </div>
<?php } ?>
          <div class="content">
             <div class="form-group col-md-12 ">
        <form class="form-horizontal" name="user_terminauftrege" id="user_terminauftrege_form" enctype="multipart/form-data" method="post" action="user_terminauftrege_process_form.php">
          <input type="hidden" name="mode" value="<?php echo ($_GET["m"] == "update") ? "update_old" : "add_new"; ?>" >
          <input type="hidden" name="old_pic" value="<?php echo $results[0]["profile_pic"] ?>" >
          <input type="hidden" name="cid" value="<?php echo intval($results[0][":cid"]); ?>" >
          <input type="hidden" name="pagenum" value="<?php echo $_GET["pagenum"]; ?>" >
          <fieldset></div>
                  <div class="form-group col-md-3 setmyheight">
                  <label class="control-label">Kunde Ausw&auml;hlen</label>
                  <select class="form-control select2" name="user_id" id="user_id" onchange="javascript:changeSID();" style="width: 100%;">
                  <?php foreach($kunden as $user): ?>
                  <option value="<?= $user['user_id']; ?>"><?= $user['name']; ?></option>
                  <?php endforeach; ?>
                  </select>		
                  </div>
	    <div class="form-group col-md-3 setmyheight">
            <label>Customer Name</label>
            <input type="text" name="name" value="<?php echo $results[0]["name"] ?>" class="form-control" placeholder="Enter Customer Name">
            </div>
              <div class="form-group col-md-3 setmyheight">
                  <label class="control-label">Termin Date</label>
                  <input type="text" name ="timedate" value="<?php echo $results[0]["timedate"] ?><?php echo $curentdate ?>" class="form-control pull-right" id="datepicker" placeholder="enter termin date" data-date-format="yyyy-mm-dd">
                </div>
              <div class="form-group col-md-3 setmyheight">
              <label>Transport Art</label>
                <select class="form-control select2" name="typ" id="typ" style="width: 100%;">
                 <option value="G" <?php if($typ=="G") { echo "selected"; } ?> >Geher</option>
                 <option value="R" <?php if($typ=="R") { echo "selected"; } ?> >Rohlstuhl</option> 
                 <option value="ROL" <?php if($typ=="ROL") { echo "selected"; } ?> >Rolator</option>
                 <option value="U" <?php if($typ=="U") { echo "selected"; } ?> >Umsetzer</option>
                 <option value="EF" <?php if($typ=="EF") { echo "selected"; } ?> >Einzel Fahrt</option>

              </select>
              </div>
              <div class="form-group col-md-3 setmyheight">
              <label class="control-label">Transport Typ</label>   
                 <select id="full_pay"  onchange="check();" name="Transportar" class="form-control select2">
                 <option value="Schulfahrt" <?php if($transport=="Schulfahrt") { echo "selected"; } ?> >Schulfahrt</option>
                 <option value="Freizeitfahrt" <?php if($transport=="Freizeitfahrt") { echo "selected"; } ?> >Freizeitfahrt</option> 
                 <option value="KKT" <?php if($transport=="KKT") { echo "selected"; } ?> >KrankenTransport</option>
                 <option value="Kuhrfahrt" <?php if($transport=="Kuhrfahrt") { echo "selected"; } ?> >Kuhrfahrt</option>
                 <option value="Regelfahrt" <?php if($transport=="Regelfahrt") { echo "selected"; } ?> >Regelfahrt</option>                  
                  </select>
            </div>
            <div id="min_pay" class="form-group col-md-3 setmyheight" style="display:none">
              <label>Selbstbehalt</label>
                  <select id="mini_pay" name="sbehalt" class="form-control select2" style="width: 100%;">
                <option selected="selected" value="0" <?php if($sbehalt=="0") { echo "selected"; } ?> >Kein Selbstbehalt</option>
                 <option value="1,20" <?php if($sbehalt=="1,20") { echo "selected"; } ?> >1,20-, &euro;</option>
                 <option value="2,20" <?php if($sbehalt=="2,20") { echo "selected"; } ?> >2,20-, &euro;</option> 
                 <option value="5,20" <?php if($sbehalt=="5,20") { echo "selected"; } ?> >5,20-, &euro;</option>
                 <option value="33,00" <?php if($sbehalt=="33,00") { echo "selected"; } ?> >33-, &euro;</option>
             </select>
              </div>
	      <div class="form-group col-md-3 setmyheight">
              <label>Zusatz Info</label>
            <textarea class="form-control" rows="3" name="zinfo" id ="zinfo" value="<?php echo $results[0]["zinfo"] ?>"><?php echo $results[0]["zinfo"] ?></textarea>
            </div>
              <div class="form-group col-md-4 setmyheight">
              <label class="control-label">Beifahrer</label>
                <select class="form-control select2" name="bfahrer" id="bfahrer" style="width: 100%;">
                 <option value="JA" <?php if($bfahrer=="JA") { echo "selected"; } ?> >YES</option>
                 <option value="NEIN" <?php if($bfahrer=="NEIN") { echo "selected"; } ?> >NO</option>
                </select>
              </div>
			<div class="form-group col-md-3 setmyheight">
              <label>Telefon Vater</label>
		<input type="text" name="phoneF" value="<?php echo $results[0]["phoneF"] ?>" parsley-trigger="change"   placeholder="" class="form-control">
            </div>
			<div class="form-group col-md-3 setmyheight">
              <label>Telefon Mutter</label>
			  <input type="text" name="phoneM" value="<?php echo $results[0]["phoneM"] ?>" parsley-trigger="change"   placeholder="" class="form-control">
            </div>
            <div class="form-group col-md-3 setmyheight">
              <label>Telefonr</label>
			  <input type="text" name="phone" value="<?php echo $results[0]["phone"] ?>" parsley-trigger="change"   placeholder="" class="form-control">
            </div>
		<div class="form-group col-md-3 setmyheight">
              <label>Abholadresse</label>
		<input type="text" name="location" value="<?php echo $results[0]["location"] ?>" parsley-trigger="change"  id="location" placeholder="" class="form-control">
      <input type="hidden" id="ank_latitude" name="ank_latitude" value="<?php echo $results[0]["ank_latitude"] ?>"/>
<input type="hidden" id="ank_longitude" name="ank_longitude" value="<?php echo $results[0]["ank_longitude"] ?>"/>        
</div>
	    <div class="form-group col-md-3 setmyheight">
              <label>Zieladresse</label>
			  <input type="text" name="droplocation" value="<?php echo $results[0]["droplocation"] ?>" parsley-trigger="change"  id="droplocation" placeholder="" class="form-control">
             </div>

<input type="hidden" id="city2" name="city2" />
<input type="hidden" id="latitude" name="latitude" value="<?php echo $results[0]["latitude"] ?>"/>
<input type="hidden" id="longitude" name="longitude" value="<?php echo $results[0]["longitude"] ?>"/> 
 
		<div class="form-group col-md-3 setmyheight">


  <div class="bootstrap-timepicker">
                <div class="form-group">
                  <label>Abholzeit:</label>

                  <div class="input-group">
			  <input type="text" name="termin" value="<?php echo $results[0]["termin"] ?>" parsley-trigger="change"  placeholder="08:00" placeholder="" class="form-control timepicker">

                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>                  </div>

                          <?php if ($_GET["m"] == "update") { ?>
            <?php
            }
            ?></div>                  </div>

            <div class="form-group">
              <div class="col-lg-5 col-lg-offset-4">
                <button class="btn btn-block btn-primary btn-lg" type="submit">Auftrag Senden</button>
              </div>
            </div>
          </fieldset>
        </form>
            <div class="clear"></div>


            <div class="form-group col-md-12 ">
              </div>
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
<?php } ?>
