<?php
/*
 * @author Trajilovic Goran
 * @website http://www.globcast.eu
 * Fahrtendienst Software v1.0
 */
require_once './config.php';
include './header.php';
try {
   $sql = "SELECT * FROM kunden WHERE 1 AND user_id = :cid";
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
        <h3 class="panel-title"><?php echo ($_GET["m"] == "update") ? "Edit" : "Kunden"; ?> Stammdaten</h3>

          </div>
          <div class="content">

             <div class="form-group col-md-12 ">
        <form class="form-horizontal" name="customer_process_form" id="customer_process_form" enctype="multipart/form-data" method="post" action="customer_process_form.php">
          <input type="hidden" name="mode" value="<?php echo ($_GET["m"] == "update") ? "update_old" : "add_new"; ?>" >
          <input type="hidden" name="old_pic" value="<?php echo $results[0]["profile_pic"] ?>" >
          <input type="hidden" name="cid" value="<?php echo intval($results[0]["user_id"]); ?>" >
          <input type="hidden" name="pagenum" value="<?php echo $_GET["pagenum"]; ?>" >
          <fieldset></div>
	    <div class="form-group col-md-3 setmyheight">
            <label>Name</label>
            <input type="text" name="name" value="<?php echo $results[0]["name"] ?>" class="form-control" placeholder="Enter Customer Name">
            </div>
              <div class="form-group col-md-3 setmyheight">
              <label>Transport Art</label>
                <select class="form-control select2" name="typ" id="typ" style="width: 100%;">
                <option selected="selected" value="G" <?php if($typ=="G") { echo "selected"; } ?> >Geher</option>
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
            <textarea class="form-control" rows="3" name="zinfo" value="<?php echo $results[0]["zinfo"] ?>" placeholder="Enter ..."></textarea>
            </div>
              <div class="form-group col-md-4 setmyheight">
              <label class="control-label">Dauer Auftrag</label>
                <select class="form-control select2" name="dauerauftrag" id="dauerauftrag" style="width: 100%;">
                 <option value="0" <?php if($dauerauftrag=="0") { echo "selected"; } ?> >NEIN</option>
                 <option value="1" <?php if($dauerauftrag=="1") { echo "selected"; } ?> >JA</option>
                </select>
              </div>

              <div class="form-group col-md-4 setmyheight">
              <label class="control-label">Beifahrer</label>
                <select class="form-control select2" name="bfahrer" id="bfahrer" style="width: 100%;">
                 <option value="JA" <?php if($bfahrer=="JA") { echo "selected"; } ?> >JA</option>
                 <option value="NEIN" <?php if($bfahrer=="NEIN") { echo "selected"; } ?> >NEIN</option>
                </select>
              </div>
              <div class="form-group col-md-3 setmyheight">
              <label>FSW Nummer:.</label>
			  <input type="number" name="fsw" value="<?php echo $results[0]["fsw"] ?>" parsley-trigger="change"   placeholder="" class="form-control">
            </div>
              <div class="form-group col-md-3 setmyheight">
                  <label class="control-label">FSW G&uuml;ltig bis</label>
                  <input type="text" name ="mobilitet" value="<?php echo $results[0]["mobilitet"] ?><?php echo $mobilitet ?>" class="form-control pull-right" id="datepicker" placeholder="FSW G&uuml;ltigkeit" data-date-format="yyyy-mm-dd">
                </div>
<div class="form-group col-md-3 setmyheight">
              <label>Sozial Versicherungs Nummer:.</label>
			  <input type="number" name="SvNr" value="<?php echo $results[0]["SvNr"] ?>" parsley-trigger="change"   placeholder="" class="form-control">
            </div>
              <div class="form-group col-md-4 setmyheight">
              <label class="control-label">Krankenkassa</label>
                <select class="form-control select2" name="kassa" id="kassa" style="width: 100%;">
                 <option value="WGKK" <?php if($kassa=="WGKK") { echo "selected"; } ?> >Wiener Gebietskrankenkasse</option>
                 <option value="SVA" <?php if($kassa=="SVA") { echo "selected"; } ?> >Sozialversicherungsanstalt der gewerblichen Wirtschaft</option>
                 <option value="NOEGKK" <?php if($kassa=="NOEGKK") { echo "selected"; } ?> >Nieder&ouml;sterreichische Gebietskrankenkasse</option>             
                 <option value="AUVA" <?php if($kassa=="AUVA") { echo "selected"; } ?> >Allgemeine Unfallversicherungsanstalt</option>
                 <option value="BGKK" <?php if($kassa=="BGKK") { echo "selected"; } ?> >Burgenlendische Gebietskrankenkasse</option>
                 <option value="BVA" <?php if($kassa=="BVA") { echo "selected"; } ?> >Versicherungsanstalt &Ouml;ffentlich Bediensteter</option>
                 <option value="HVB" <?php if($kassa=="HVB") { echo "selected"; } ?> >Hauptverband der &Ouml;sterreichischen Sozialversicherungstr&auml;ger</option>
                 <option value="KGKK" <?php if($kassa=="KGKK") { echo "selected"; } ?> >Kerntner Gebietskrankenkasse</option>
                 <option value="SGKK" <?php if($kassa=="SGKK") { echo "selected"; } ?> >Salzburger Gebietskrankenkasse</option>
                 <option value="SVB" <?php if($kassa=="SVB") { echo "selected"; } ?> >Sozialversicherungsanstalt der Bauern</option>
                 <option value="TGKK" <?php if($kassa=="TGKK") { echo "selected"; } ?> >Tiroler Gebietskrankenkasse</option>
                 <option value="VAEB" <?php if($kassa=="VAEB") { echo "selected"; } ?> >Versicherungsanstalt f&uuml;r Eisenbahnen und Bergbau</option>
                 <option value="VGKK" <?php if($kassa=="VGKK") { echo "selected"; } ?> >Vorarlberger Gebietskrankenkasse</option>
                 <option value="BKK-VA" <?php if($kassa=="BKK-VA") { echo "selected"; } ?> >BKK F&ouml;rstalpine Bahnsysteme</option>
                 <option value="BKK-Mondi" <?php if($kassa=="BKK-Mondi") { echo "selected"; } ?> >Betriebskrankenkasse Mondi</option>
                 <option value="BKK-WVB" <?php if($kassa=="BKK-WVB") { echo "selected"; } ?> >BKK der Wiener Verkehrsbetriebe</option>
                 <option value="BKK-KA" <?php if($kassa=="BKK-KA") { echo "selected"; } ?> >BKK Kapfenberg</option>
              </select>
              </div>
<div class="form-group col-md-3 setmyheight">
              <label>Kunden Nr:.</label>
			  <input type="number" name="kdnr" value="<?php echo $results[0]["kdnr"] ?>" parsley-trigger="change"   placeholder="" class="form-control">
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
            </div> 
            <?php if ($_GET["m"] == "update") { ?>
            <?php 
            }
            ?>
            <div class="form-group">
              <div class="col-lg-5 col-lg-offset-4">
                <button class="btn btn-block btn-primary btn-lg" type="submit">Kunden Stammdaten Speichern</button>
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

