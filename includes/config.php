<?php
include '../admin/config.php';
try
{
  $pdo = new PDO(DB_DRIVER.':host='. DB_SERVER .';dbname='.DB_DATABASE, DB_USER, DB_PASSWORD);

}
catch(PDOException $e)
{
exit("Error Connectiong to database");
}

?>