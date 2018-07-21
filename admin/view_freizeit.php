<?php
/*
 * @author Trajilovic Goran
 * @website http://www.globcast.eu
 * Fahrtendienst Software v1.0
 */
require_once './config.php';
include './header.php';
try {
   $sql = "SELECT * FROM dispo WHERE 1 AND id = :cid";
   $stmt = $DB->prepare($sql);
   $stmt->bindValue(":cid", intval($_GET["cid"]));
   
   $stmt->execute();
   $results = $stmt->fetchAll();
} catch (Exception $ex) {
  echo $ex->getMessage();
}
$status = $results[0]["dauer_auftrag"]; //Dropdown Menue Ucitavanje
$transport = $results[0]["typ"];
?>

<div id="cl-wrapper">
  <div class="container-fluid" id="pcont">
    <!-- TOP NAVBAR -->

    <div class="cl-mcont">
	  <div class="row">
	    <div class="col-sm-12 col-md-12">
        <div class="block-flat">
          <div class="header">							
            <h3>Kunden Verwaltung </h3>
          </div>
          <div class="content">
          <div class="form-group col-md-12 ">
          </div>
            <div class="form-group col-md-3 setmyheight">
              <label>Kunden Nummer</label>
		<input type="text" readonly="" name="kdnr" value="<?php echo $results[0]["kdnr"] ?>" parsley-trigger="change"   placeholder="" class="form-control">
             </div>
            <div class="form-group col-md-3 setmyheight">
              <label>Name</label>
			  <input type="text" readonly="" name="name" value="<?php echo $results[0]["name"] ?>" parsley-trigger="change"   placeholder="" class="form-control">
            </div>
             <div class="form-group col-md-3 setmyheight">
              <label>Kontakt Telefon Nummer</label>
		<input type="number" readonly="" id="phone" name="phone" value="<?php echo $results[0]["phone"] ?>" parsley-trigger="change"   placeholder="" class="form-control">			
            </div>
              <div class="form-group col-md-3 setmyheight">
              <label>FSW Nr:.</label>
		<input type="number" readonly="" name="fsw" value="<?php echo $results[0]["fsw"] ?>" parsley-trigger="change"   placeholder="" class="form-control">
            </div>
              <div class="form-group col-md-3 setmyheight">
              <label>FSW G&uuml;ltig bis:.</label>
		<input type="number" readonly="" name="fsw" value="<?php echo $results[0]["mobilitet"] ?>" parsley-trigger="change"   placeholder="" class="form-control">
            </div>

            <div class="form-group col-md-3 setmyheight">
              <label>Krankenkassa</label>
		<input type="text" readonly="" name="kassa" value="<?php echo $results[0]["kassa"] ?>" parsley-trigger="change"   placeholder="" class="form-control">
             </div>
            <div class="form-group col-md-3 setmyheight">
              <label>SVNr:.</label>
		<input type="number" readonly="" name="SvNr" value="<?php echo $results[0]["SvNr"] ?>" parsley-trigger="change"   placeholder="" class="form-control">
             </div>
	     <div class="form-group col-md-3 setmyheight">
              <label>User Typ</label>
			  <input type="text" name="typ" readonly="" value="<?php echo $results[0]["typ"] ?>" parsley-trigger="change"   placeholder="" class="form-control">
            </div>
		<div class="form-group col-md-3 setmyheight">
              <label>Adresse</label>
		<input type="text" readonly="" name="location" value="<?php echo $results[0]["location"] ?>" parsley-trigger="change"   placeholder="" class="form-control">
             </div>
            <div class="form-group col-md-3 setmyheight">
              <label>Mobilitet</label>
		<input type="text" readonly="" name="mobilitet" value="<?php echo $results[0]["mobilitet"] ?>" parsley-trigger="change"   placeholder="" class="form-control">
             </div>
            <div class="form-group col-md-3 setmyheight">
              <label>Selbstbehalt</label>
		<input type="number" readonly="" name="sbehalt" value="<?php echo $results[0]["sbehalt"] ?>" parsley-trigger="change"   placeholder="" class="form-control">
             </div>	
	    <div class="form-group col-md-3 setmyheight">
              <label>Zusatz Info</label>
			  <input type="text" name="zinfo" readonly="" value="<?php echo $results[0]["zinfo"] ?>" parsley-trigger="change"   placeholder="" class="form-control">
            </div>
			<div class="form-group col-md-3 setmyheight">
              <label>Telefon Vater</label>
			  <input type="number" name="phoneF" readonly="" value="<?php echo $results[0]["phoneF"] ?>" parsley-trigger="change"   placeholder="" class="form-control">
            </div>
			<div class="form-group col-md-3 setmyheight">
              <label>Telefon Mutter</label>
			  <input type="number" name="phoneM" readonly="" value="<?php echo $results[0]["phoneM"] ?>" parsley-trigger="change"   placeholder="" class="form-control">
            </div>
            <div class="form-group col-md-3 setmyheight">
              <label>Beifahrer Pflichtig</label>
			  <input type="text" name="bfahrer" readonly="" value="<?php echo $results[0]["bfahrer"] ?>" parsley-trigger="change"   placeholder="" class="form-control">
            </div>
		<div class="form-group col-md-3 setmyheight">
              <label>Aftrag Status</label>
			  <input type="text" name="dauerautrag" readonly="" value="<?php echo $results[0]["dauer_auftrag"] ?>" parsley-trigger="change"  id="txtPlaces" placeholder="" class="form-control">
            </div>         								
            <div class="clear"></div>
            
         
            <div class="form-group col-md-12 ">
              </div>
            </form>

      </div>
    </div>
  </div>
<?php
include './footer.php';

