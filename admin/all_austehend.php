<?php
/*
 * @author Trajilovic Goran
 * @website http://www.globcast.eu
 * Fahrtendienst Software v1.0
 */

require_once("config.php");
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    // not logged in send to login page
    redirect("index.php");
}
$status = FALSE;
if ( authorize($_SESSION["access"]["Display All Rides"]["Display All Rides"]["create"]) ||
     authorize($_SESSION["access"]["Display All Rides"]["Display All Rides"]["edit"]) ||
     authorize($_SESSION["access"]["Display All Rides"]["Display All Rides"]["view"]) ||
     authorize($_SESSION["access"]["Display All Rides"]["Display All Rides"]["delete"]) ) {
     $status = TRUE;
}

if ($status === FALSE) {
die("You dont have the permission to access this page");
}

// set page title
$title = "Alle Offene Auftr&#228;ge";
include './header.php';
/*******PAGINATION CODE STARTS*****************/
if (!(isset($_GET['pagenum']))) {
  $pagenum = 1;
} else {
  $pagenum = $_GET['pagenum'];
}
$page_limit = ($_GET["show"] <> "" && is_numeric($_GET["show"]) ) ? $_GET["show"] : 18; //zeige 18 resultate


try {
  $keyword = trim($_GET["keyword"]);
  if ($keyword <> "" ) {
    $sql = "SELECT * FROM texirequest WHERE 1 AND "
            . " (name LIKE :keyword) ORDER BY name ";
    $stmt = $DB->prepare($sql);

    $stmt->bindValue(":keyword", $keyword."%");

  } else {
    $sql = "SELECT * FROM texirequest WHERE 1 ORDER BY termin ";
    $stmt = $DB->prepare($sql);
  }

  $stmt->execute();
  $total_count = count($stmt->fetchAll());

  $last = ceil($total_count / $page_limit);

  if ($pagenum < 1) {
    $pagenum = 1;
  } elseif ($pagenum > $last) {
    $pagenum = $last;
  }

  $lower_limit = ($pagenum - 1) * $page_limit;
  $lower_limit = ($lower_limit < 0) ? 0 : $lower_limit;
  $sql2 = $sql . " limit " . ($lower_limit) . " ,  " . ($page_limit) . " ";
  $stmt = $DB->prepare($sql2);

  if ($keyword <> "" ) {
    $stmt->bindValue(":keyword", $keyword."%");
   }

  $stmt->execute();
  $results = $stmt->fetchAll();
} catch (Exception $ex) {
  echo $ex->getMessage();
}
/*******PAGINATION CODE ENDS*****************/
?>
<div id="cl-wrapper">
  <div class="container-fluid" id="pcont">
    <!-- TOP NAVBAR -->

    <div class="cl-mcont">
	  <div class="row">
	    <div class="col-sm-12 col-md-12">
        <div class="block-flat">
          <div class="header">							
            <h3><?php echo $title; ?></h3>
          </div>
<?php if ($ERROR_MSG <> "") { ?>
    <div class="alert alert-dismissable alert-<?php echo $ERROR_TYPE ?>">
      <button data-dismiss="alert" class="close" type="button">×</button>
      <p><?php echo $ERROR_MSG; ?></p>
    </div>
<?php } ?>

    <div class="panel-body">

      <div class="col-lg-12" style="padding-left: 0; padding-right: 0;" >
        <form action="all_austehend.php" method="get" >
        <div class="col-lg-6 pull-left"style="padding-left: 0;"  >
          <span class="pull-left">
            <label class="col-lg-12 control-label" for="keyword" style="padding-right: 0;">
              <input type="text" value="<?php echo $_GET["keyword"]; ?>" placeholder="search by name" id="" class="form-control" name="keyword" style="height: 41px;">
            </label>
            </span>
          <button class="btn btn-info">search</button>
        </div>
        </form>
</div>
      <div class="clearfix"></div>
<?php if (count($results) > 0) { ?>
        <div class="table-responsive">
<table class="table table-bordered" id="datatable">            
<tbody><tr>
                <th>Fahrer</th>
                <th>Termin</th>
                <th>Name</th>
                <th>Typ</th>
                <th>Adrese</th>
                <th>START GPS</th>
                <th>Ziel Adresse</th>
                <th>ZIEL GPS</th>
                <th>Datum</th>
                <th>Status</th>
              </tr>
  <?php foreach ($results as $res) {
 ?>                 
  <?php 
       $var = ($res["accept"] <> "" ) ? $res["accept"] : ""; 

       $colorMap[0] = '#00FF00'; //orange
       $colorMap[1] = '#FF8000'; //green
       $colorMap[2] = '#ffff00'; //red
       $colorMap[3] = '#FF0000'; //yelow
       $latitude1 = $res["latitude"];
       $longitude1 = $res["longitude"];
  ?>
                <tr>
                  <td style='background-color:<?php echo $colorMap[$var]; ?>'><?php echo $res["driver_name"];?></td>
                  <td style='background-color:<?php echo $colorMap[$var]; ?>'><?php echo $res["termin"]; ?></td>
                  <td style='background-color:<?php echo $colorMap[$var]; ?>'><?php echo $res["name"]; ?></td>
                  <td style='background-color:<?php echo $colorMap[$var]; ?>'><?php echo $res["Transportar"]; ?></td>
                  <td style='background-color:<?php echo $colorMap[$var]; ?>'><?php $a = $res["location"]; $ret = explode(',', $a); echo $ret[0]; ?></td>
                  <td style='background-color:<?php echo $colorMap[$var]; ?>'><?php echo "<a href=\"https://maps.google.com/?q=$latitude1,$longitude1\" target=\"_blank\">GET GPS</a>"?></td>
                  <td style='background-color:<?php echo $colorMap[$var]; ?>'><?php $a = $res["droplocation"]; $ret = explode(',', $a); echo $ret[0]; ?></td>
                  <td style='background-color:<?php echo $colorMap[$var]; ?>'><?php echo "<a href=\"https://maps.google.com/?q=$latitude1,$longitude1\" target=\"_blank\">GET GPS</a>"?></td>
                  <td style='background-color:<?php echo $colorMap[$var]; ?>'><?php echo $res["timedate"]; ?></td>
                  <td style="text-align: center;">
                  <?php $pic = ($res["accept"] <> "" ) ? $res["accept"] : "no.png" ?>
                  <a target="_blank"><img src="status/all/<?php echo $pic ?>.png" alt="" width="20" height="20" ></a></td            
                 </td>                 
            <?php } ?>
            </tbody></table>
        </div>

        <div class="col-lg-12 center">
          <ul class="pagination pagination-sm">
  <?php
  //Show page links
  for ($i = 1; $i <= $last; $i++) {
    if ($i == $pagenum) {
      ?>
                <li class="active"><a href="javascript:void(0);" ><?php echo $i ?></a></li>
                <?php
              } else {
                ?>
                <li><a href="all_austehend.php?pagenum=<?php echo $i; ?>&keyword=<?php echo $_GET["keyword"]; ?>" class="links"  onclick="displayRecords('<?php echo $page_limit; ?>', '<?php echo $i; ?>');" ><?php echo $i ?></a></li>
                <?php
              }
            }
            ?>
          </ul>
        </div>

          <?php } else { ?>
        <div class="well well-lg">No contacts found.</div>
<?php } ?>
  </div>
</div>
