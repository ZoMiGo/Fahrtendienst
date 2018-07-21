<?php
header("Content-Type: text/html; charset=utf-8");
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
if ( authorize($_SESSION["access"]["Alle Dauer Auftrege"]["Alle Dauer Auftrege"]["create"]) ||
     authorize($_SESSION["access"]["Alle Dauer Auftrege"]["Alle Dauer Auftrege"]["edit"]) ||
     authorize($_SESSION["access"]["Alle Dauer Auftrege"]["Alle Dauer Auftrege"]["view"]) ||
     authorize($_SESSION["access"]["Alle Dauer Auftrege"]["Alle Dauer Auftrege"]["delete"]) ) {
     $status = TRUE;
}

if ($status === FALSE) {
die("You dont have the permission to access this page");
}

// set page title
$title = "Alle Regelfahrten";
include './header.php';
/*******PAGINATION CODE STARTS*****************/
if (!(isset($_GET['pagenum']))) {
  $pagenum = 1;
} else {
  $pagenum = $_GET['pagenum'];
}
$page_limit = ($_GET["show"] <> "" && is_numeric($_GET["show"]) ) ? $_GET["show"] : 8;


try {
  $keyword = trim($_GET["keyword"]);
  if ($keyword <> "" ) {
    $sql = "SELECT * FROM texirequest WHERE 1 AND "
            . " (driver_name LIKE :keyword) ORDER BY driver_name ";
    $stmt = $DB->prepare($sql);

    $stmt->bindValue(":keyword", $keyword."%");

  } else {
    $sql = "SELECT * FROM texirequest WHERE Transportar = 'Regelfahrt' ";
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
        <form action="regel.php" method="get" >
        <div class="col-lg-6 pull-left"style="padding-left: 0;"  >
          <span class="pull-left">
            <label class="col-lg-12 control-label" for="keyword" style="padding-right: 0;">
              <input type="text" value="<?php echo $_GET["keyword"]; ?>" placeholder="Nach Fahrer Suchen" id="" class="form-control" name="keyword" style="height: 41px;">
            </label>
            </span>
          <button class="btn btn-info">Suchen</button>
        </div>
        </form>
        <?php if (authorize($_SESSION["access"]["Alle Dauer Auftrege"]["Alle Dauer Auftrege"]["create"])) { ?>
        <div class="pull-right" ><a href="regel.php"><button class="btn btn-success"><span class="glyphicon glyphicon-user"></span> Auftrag Hinzuf&#252;gen</button></a></div>
              <?php } ?>
</div>
      <div class="clearfix"></div>
<?php if (count($results) > 0) { ?>
        <div class="table-responsive">
          <table class="table table-striped table-hover table-bordered ">
            <tbody><tr>
                <th>Driver</th>
                <th>Termin</th>
                <th>Name</th>
                <th>Typ</th>
                <th>Adrese</th>
                <th>Ziel Adresse</th>
                <th>Status</th>
                <th>Action </th>

              </tr>
  <?php foreach ($results as $res) { ?>
                <tr>
                  <td><?php echo $res["driver_name"]; ?></td>
                  <td><?php echo $res["termin"]; ?></td>
                  <td><?php echo $res["name"]; ?></td>
                  <td><?php echo $res["Transportar"]; ?></td>
                  <td><?php echo $res["location"]; ?></td>
                  <td><?php echo $res["droplocation"]; ?></td>
<td style="text-align: center;">
                <?php $pic = ($res["accept"] <> "" ) ? $res["accept"] : "no.png" ?>
                    <a target="_blank"><img src="status/all/<?php echo $pic ?>.png" alt="" width="40" height="40" ></a>
                  </td>
                  <td>
                    <?php if (authorize($_SESSION["access"]["Alle Dauer Auftrege"]["Alle Dauer Auftrege"]["view"])) { ?>
                    <a href="view_dauerauftrege.php?cid=<?php echo $res["id"]; ?>"><button class="btn btn-sm btn-info"><span class="glyphicon glyphicon-zoom-in"></span> View</button></a>&nbsp;
                    <?php } ?>
                    <?php if (authorize($_SESSION["access"]["Alle Dauer Auftrege"]["Alle Dauer Auftrege"]["edit"])) { ?>
                    <a href="regel.php?mode=update&cid=<?php echo $res["id"]; ?>&pagenum=<?php echo $_GET["pagenum"]; ?>"><button class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-edit"></span> Edit</button></a>&nbsp;
                    <?php } ?>
                   <?php if (authorize($_SESSION["access"]["Alle Dauer Auftrege"]["Alle Dauer Auftrege"]["delete"])) { ?>
                  <a href="dauerauftrege_process_form.php?mode=delete&cid=<?php echo $res["id"]; ?>&keyword=<?php echo $_GET["keyword"]; ?>&pagenum=<?php echo $_GET["pagenum"]; ?>" onclick="return confirm('Are you sure?')"><button class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove-circle"></span> Delete</button></a>&nbsp;
                 <?php } ?>
                </td>
                </tr>
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
                <li><a href="all_dauerauftrege.php?pagenum=<?php echo $i; ?>&keyword=<?php echo $_GET["keyword"]; ?>" class="links"  onclick="displayRecords('<?php echo $page_limit; ?>', '<?php echo $i; ?>');" ><?php echo $i ?></a></li>
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
</div>
