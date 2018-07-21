<?php
/*
 * @author Trajilovic Goran
 * @website http://www.globcast.eu
 * Fahrtendienst Software v1.0
 */
session_start();
$_SESSION = array();
unset($_SESSION);
session_destroy();
header("location:index.php");
exit;
?>
