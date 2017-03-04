<?php
session_start();
$a = $_POST['internid'];
if(!isset($_SESSION['id'])){
	header( "refresh:1; url=index.php" );
	session_unset();
	session_destroy();
	session_Start();
	$_SESSION['errorlogin'] = "Please login to apply";
}
else
{
	$id = $_SESSION['id'];
include("conn.php");

$query1 = "SELECT * from internships WHERE internid='$a'";
		$login = mysql_query($query1,$conn)or die(mysql_error());
		$res = mysql_fetch_array($login);
		if($res){
			$_SESSION['employeeid'] = $res['empid'];
		}
$empid = $_SESSION['employeeid'];
$query2 = "INSERT INTO stdintern (stdid,empid,internid) VALUES ('$id','$empid','$a')";
			$apply = mysql_query($query2,$conn);
			if(isset($apply)){
			header( "refresh:1; url=internshipview.php" );
			}
}
?>
<html>
    <body>
      <img src="images/Preloader_3.gif" alt="loading" height="200" width="200" style="padding-top:15%; padding-left:45%" align="center" />
    </body>
 </html>