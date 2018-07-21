<?php
ob_start();
session_start();
class database
{
private $func;

function __construct($pdo)
{
$this->pdo=$pdo; 
}
function adminLogin()
{
	$username= $_POST['username'];
	$password= $_POST['password'];
	$query=$this->pdo->prepare("select * from admin where username='$username' && password= '$password'");
	$query->execute();
	$count =$query->rowCount();
	if ($count == 1)
	{	
		session_start();
		$_SESSION['$username']=$_POST['$username'];
		header("Location:index.php");
		exit();
	}
	else
	{
		print "Incorrect Username or Password";
	}
}
function mapOffers()
{
	$expiry = date("Y-m-d");
	$query=$this->pdo->prepare("SELECT  * FROM locations");
	$query->execute();
	while ($maps=$query->fetch(PDO::FETCH_OBJ))
	{
		
		//$name= "Fahrer: $maps->name";
		$name= "<div style=\"font-weight:bold; color:#900\">$maps->name";
		$no= "<img src=\http://fahrtendienst.net/admin/img/$maps->online.png>";
                $check_pic="images/countries/$maps->c_id.jpg";
		//$pic= "<img src=\"$check_pic\"/>";
		//$name= "<div style=\"font-weight:bold; color:#900\">£$maps->name</div>";

		echo ("addMarker($maps->latitude, $maps->longitude,'$name<br/>$no' )\n;");
	}
	
}
}
?>


