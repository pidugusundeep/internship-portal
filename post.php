<?php
	session_start();
	include("conn.php");
	$title = $_POST["title"];
	$sno = $_POST['studentno'];
	$detail = $_POST['detail'];
	$mail = $_SESSION['email'];
	
	
		$no = $_SESSION['id'];
			$query1 = "INSERT INTO internships (title,detail,no,empid) VALUES ('$title','$detail','$sno','$no')";
			$register = mysql_query($query1,$conn);
			if(isset($register)){
				$_SESSION['errorlogin'] = "INTERNSHIP POST";
				header( "refresh:2; url=internshippost.php" );
			}
	
	
	mysql_close($conn);

?>
<html>
    <body>
      <img src="images/Preloader_3.gif" alt="loading" height="200" width="200" style="padding-top:15%; padding-left:45%" align="center" />
    </body>
 </html>