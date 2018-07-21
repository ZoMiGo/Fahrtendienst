<?php
/*
 * @author Trajilovic Goran
 * @website http://www.globcast.eu
 * Fahrtendienst Software v1.0
 */
require_once './config.php';
include './header.php';
try {
   $sql = "SELECT * FROM texirequest WHERE 1 AND id = :cid";
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
            <h3>Auftrag Vergeben </h3>
          </div>
          <div class="content">
          <div class="form-group col-md-12 ">
</div>

  <div class="form-group col-md-3 setmyheight">
              <label>Fahrer ID</label>
			  <input type="number" readonly="" name="driver_id" value="<?php echo $results[0]["driver_id"] ?>" parsley-trigger="change"   placeholder="" class="form-control">
            </div>
		<div class="form-group col-md-3 setmyheight">
              <label>Fahrer Name</label>
			  <input type="text" readonly="" name="driver_name" value="<?php echo $results[0]["driver_name"] ?>" parsley-trigger="change"   placeholder="" class="form-control">
            </div>
             <div class="form-group col-md-3 setmyheight">
              <label>Name</label>
		<input type="text" readonly="" id="name" name="name" value="<?php echo $results[0]["name"] ?>" parsley-trigger="change"   placeholder="" class="form-control">
            </div>
              <div class="form-group col-md-3 setmyheight">
              <label>Transport Art</label>
		<input type="text" readonly="" name="Transportar" value="<?php echo $results[0]["Transportar"] ?>" parsley-trigger="change"   placeholder="" class="form-control">
            </div>

            <div class="form-group col-md-3 setmyheight">
              <label>Selbstbehalt</label>
		<input type="text" readonly="" name="sbehalt" value="<?php echo $results[0]["sbehalt"] ?>" parsley-trigger="change"   placeholder="" class="form-control">
             </div>
             <div class="form-group col-md-3 setmyheight">
              <label>Transport Typ</label>
                 <select name="dauer_auftrag" id="dauer_auftrag" readonly="" class="form-control">
                 <option value="G" <?php if($transport=="G") { echo "selected"; } ?> >Geher</option>
                 <option value="R" <?php if($transport=="R") { echo "selected"; } ?> >Rohlstuhl</option>
                </select>
              </div>
              <div class="form-group col-md-4 setmyheight">
              <label class="control-label">Dauer Auftrag</label>
                 <select name="dauer_auftrag" id="dauer_auftrag" readonly="" class="form-control">
                 <option value="0" <?php if($status=="0") { echo "selected"; } ?> >NO</option>
                 <option value="1" <?php if($status=="1") { echo "selected"; } ?> >YES</option>
                </select>
              </div>

		<div class="form-group col-md-3 setmyheight">
              <label>Beifahrer</label>
			  <input type="text" name="typ" readonly="" value="<?php echo $results[0]["bfahrer"] ?>" parsley-trigger="change"   placeholder="" class="form-control">
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
              <label>Telefonr</label>
			  <input type="number" name="phone" readonly="" value="<?php echo $results[0]["phone"] ?>" parsley-trigger="change"   placeholder="" class="form-control">
            </div>
		<div class="form-group col-md-3 setmyheight">
              <label>Abhohl Adresse</label>
			  <input type="text" name="location" readonly="" value="<?php echo $results[0]["location"] ?>" parsley-trigger="change"  id="txtPlaces" placeholder="" class="form-control">
            </div>
	    <div class="form-group col-md-3 setmyheight">
              <label>Ziel Adresse</label>
			  <input type="text" name="droplocation" readonly="" value="<?php echo $results[0]["droplocation"] ?>" parsley-trigger="change"  id="drop" placeholder="" class="form-control">
             </div>

		<div class="form-group col-md-3 setmyheight">
              <label>Termin</label>
			  <input type="number" name="termin" readonly="" value="<?php echo $results[0]["termin"] ?>" parsley-trigger="change"   placeholder="" class="form-control">
            </div>


            <div class="clear"></div>


            <div class="form-group col-md-12 ">
              </div>
            </form>

      </div>
    </div>
  </div>

