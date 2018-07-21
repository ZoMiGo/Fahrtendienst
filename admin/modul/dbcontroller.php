<?php
require_once("./config.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    // not logged in send to login page
    redirect("index.php");
}
$status = FALSE;
if ( authorize($_SESSION["access"]["Display All Rides"]["Display All Rides"]["create"]) ||
     authorize($_SESSION["access"]["Display All Rides"]["Display All Rides"]["edit"]) ||
     authorize($_SESSION["access"]["Display All Rides"]["Display All Rides"]["view"]) ||
     authorize($_SESSION["access"]["Alle Dauer Auftrege"]["Dispo"]["create"]) ||
     authorize($_SESSION["access"]["Alle Dauer Auftrege"]["Dispo"]["edit"]) ||
     authorize($_SESSION["access"]["Alle Dauer Auftrege"]["Dispo"]["view"]) ||
     authorize($_SESSION["access"]["Display All Rides"]["Display All Rides"]["delete"]) ) {
     $status = TRUE;
}

if ($status === FALSE) {
die("You dont have the permission to access this page");
}
class DBController {

    function __construct() {
        $conn = $this->connectDB();
        if(!empty($conn)) {
            $this->selectDB($conn);
        }
    }

    function connectDB() {
        $conn = mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD);


        return $conn;
    }

    function selectDB($conn) {
        mysql_select_db(DB_DATABASE,$conn);
        mysql_query("set character_set_server='utf8'");
	mysql_query("set names 'utf8'");
    }

    function runQuery($query) {
        $result = mysql_query($query);
        while($row=mysql_fetch_assoc($result)) {
            $resultset[] = $row;
        }       
        if(!empty($resultset))
            return $resultset;
    }

    function numRows($query) {
        $result  = mysql_query($query);
        $rowcount = mysql_num_rows($result);
        return $rowcount;   
    }
}
?>