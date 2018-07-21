<?php
require_once("./config.php");
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