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
if ( authorize($_SESSION["access"]["INVT"]["STOCKS"]["create"]) || 
authorize($_SESSION["access"]["INVT"]["STOCKS"]["edit"]) || 
authorize($_SESSION["access"]["INVT"]["STOCKS"]["view"]) || 
authorize($_SESSION["access"]["INVT"]["STOCKS"]["delete"]) ) {
 $status = TRUE;
}

if ($status === FALSE) {
die("You dont have the permission to access this page");
}

// set page title
$title = "Stocks";


include 'header.php';
?>
<div class="row">
    <div class="col-lg-9">

        <?php if (authorize($_SESSION["access"]["INVT"]["STOCKS"]["create"])) { ?>
            <button class="btn btn-sm btn-primary" type="button"><i class="fa fa-plus"></i> ADD STOCKS</button> 
        <?php } ?>
        <div style="height: 10px;">&nbsp;</div>

        <div class=" table-responsive">
            <table class="table table-striped table-hover ">
                <tbody><tr>
                        <th>#</th>
                        <th>Sample heading</th>
                        <th>Sample heading</th>
                        <th style="width: 280px;">Actions</th>
                    </tr>
                    <?php for ($i = 1; $i <= 10; $i++) { ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td>Sample content</td>
                            <td>Sample content</td>
                            <td>
                                <?php if (authorize($_SESSION["access"]["INVT"]["STOCKS"]["edit"])) { ?>
                                    <button class="btn btn-sm btn-info" type="button"><i class="fa fa-edit"></i> EDIT</button> 
                                <?php } ?>
                                <?php if (authorize($_SESSION["access"]["INVT"]["STOCKS"]["view"])) { ?>
                                    <button class="btn btn-sm btn-warning" type="button"><i class="fa fa-search-plus"></i> VIEW</button>
                                <?php } ?>
                                <?php if (authorize($_SESSION["access"]["INVT"]["STOCKS"]["delete"])) { ?>
                                    <button class="btn btn-sm btn-danger" type="button"><i class="fa fa-trash-o"></i> DELETE</button>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody></table>
        </div>


        <div style="height: 20px;">&nbsp;</div>
        <a href="dashboard.php"><button class="btn btn-lg btn-info" type="button"><i class="fa fa-backward"></i> Back to dashboard</button></a>

    </div>

    <div class="col-lg-3">
        <?php include 'sidebar.php'; ?>
    </div>
</div>
<?php include 'footer.php'; ?>