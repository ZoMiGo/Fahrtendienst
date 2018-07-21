<?php
require_once './config.php';
include './header.php';
$curentdate = date('Y-m-d');
//Connect to our MySQL database using the PDO extension.
$pdo= new PDO('mysql:host='. $host .';dbname='.$db_name, $db_username, $db_password);
$sql = "SELECT user_id, name FROM kunden";
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

$sql = "SELECT * FROM kunden ";
$aResult = mysql_query($sql);
if($_REQUEST['frm_action'] == 3)
{
if ($_REQUEST['user_id'] == 0)
{
$user_id = $_REQUEST['user_id'];
$sqlCustomer = "SELECT * FROM kunden ";
}
else
{
$id = $_REQUEST['cid'];
$sqlCustomer = "SELECT * FROM kunden WHERE user_id ='$user_id'";
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
iCustomerId = document.getElementById("id").value;
url         = "regel.php?frm_action=3&cid=" +iCustomerId;
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
   $sql = "SELECT * FROM texirequest WHERE 1 AND id = $sid1";
   $stmt = $DB->prepare($sql);
   $stmt->bindValue(":id", intval($_GET["$sid1"]));

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
 ?>
<div id="cl-wrapper">
  <div class="container-fluid" id="pcont">
    <!-- TOP NAVBAR -->

    <div class="cl-mcont">
	  <div class="row">
	    <div class="col-sm-12 col-md-12">
        <div class="block-flat">
          <div class="header">
            <h3>Auftrag Vergabe </h3>
          </div>
          <div class="content">
             <div class="form-group col-md-12 ">
        <form class="form-horizontal" name="dauerauftrege" id="dauerauftrege_form" enctype="multipart/form-data" method="post" action="dauerauftrege_process_form.php">
          <input type="hidden" name="mode" value="<?php echo ($_GET["m"] == "update") ? "update_old" : "add_new"; ?>" >
          <input type="hidden" name="old_pic" value="<?php echo $results[0]["profile_pic"] ?>" >
          <input type="hidden" name="cid" value="<?php echo intval($results[0]["id"]); ?>" >
          <input type="hidden" name="pagenum" value="<?php echo $_GET["pagenum"]; ?>" >
          <fieldset></div>
           <div class="form-group col-md-3 setmyheight">
              <label>Auftrag Kategotie </label>
                <select class="form-control select2" name="auftrag_typ" id="auftrag_typ" style="width: 100%;">
                 <option value="texirequest" <?php if($transport=="texirequest") { echo "selected"; } ?> >SENDE JETZT</option>
                 <option value="dauer" <?php if($transport=="dauer") { echo "selected"; } ?> >Normaler Auftrag Freizeit etc..</option>
                 <option value="dispo" <?php if($transport=="dispo") { echo "selected"; } ?> >Dauer Auftrag Schulfahrt etc..</option>
              </select>
              </div>
                  <div class="form-group col-md-3 setmyheight">
                  <label class="control-label">Select Customer</label>
                  <select class="form-control select2" name="id" id="id" onchange="javascript:changeSID();" style="width: 100%;">
                  <?php foreach($kunden as $user): ?>
                  <option value="<?= $user['id']; ?>"><?= $user['name']; ?></option>
                  <?php endforeach; ?>
                  </select>		
                  </div>
              <div class="form-group col-md-3 setmyheight">
                  <label class="control-label">Termin Date</label>
                  <input type="text" name ="timedate" value="<?php echo $results[0]["timedate"] ?><?php echo $curentdate ?>" class="form-control pull-right" id="datepicker" placeholder="enter termin date" data-date-format="yyyy-mm-dd">
                </div>
	    <div class="form-group col-md-3 setmyheight">
            <label>Customer Name</label>
            <input type="text" name="name" value="<?php echo $results[0]["name"] ?>" class="form-control" placeholder="Enter Customer Name">
            </div>
		  <div class="form-group col-md-3 setmyheight">
                  <label class="control-label">Fahrer Name</label>
                  <select class="form-control select2" name="id" id="id" style="width: 100%;">
                  <?php foreach($users as $user): ?>
                  <option value="<?= $user['user_id']; ?>"><?= $user['user_name']; ?></option>
                  <?php endforeach; ?>
                  </select>		
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
              <label class="control-label">Auftrag Typ</label>
                <select class="form-control select2" name="dauerauftrag" id="dauerauftrag" style="width: 100%;">
                 <option value="2" <?php if($dauer_auftrag=="2") { echo "selected"; } ?> >Normal Auftrag</option>
                 <option value="1" <?php if($dauer_auftrag=="1") { echo "selected"; } ?> >Dauer Auftrag</option>
                </select>
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
			  <input type="number" name="phoneF" value="<?php echo $results[0]["phoneF"] ?>" parsley-trigger="change"   placeholder="" class="form-control">
            </div>
			<div class="form-group col-md-3 setmyheight">
              <label>Telefon Mutter</label>
			  <input type="number" name="phoneM" value="<?php echo $results[0]["phoneM"] ?>" parsley-trigger="change"   placeholder="" class="form-control">
            </div>
            <div class="form-group col-md-3 setmyheight">
              <label>Telefonr</label>
			  <input type="number" name="phone" value="<?php echo $results[0]["phone"] ?>" parsley-trigger="change"   placeholder="" class="form-control">
            </div>
		<div class="form-group col-md-3 setmyheight">
              <label>Abholadresse</label>
			  <input type="text" name="location" value="<?php echo $results[0]["location"] ?>" parsley-trigger="change"  id="txtPlaces" placeholder="" class="form-control">
            </div>
	    <div class="form-group col-md-3 setmyheight">
              <label>Zieladresse</label>
			  <input type="text" name="droplocation" value="<?php echo $results[0]["droplocation"] ?>" parsley-trigger="change"  id="drop" placeholder="" class="form-control">
             </div>

		<div class="form-group col-md-3 setmyheight">
              <label>Abholzeit</label>
			  <input type="number" name="termin" value="<?php echo $results[0]["termin"] ?>" parsley-trigger="change"  placeholder="08:00" placeholder="" class="form-control">
            </div>

            <?php if ($_GET["m"] == "update") { ?>
            <?php
            }
            ?></div>
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
<?php
include './footer.php';
?>

<?php } ?>
