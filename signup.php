<?php
	include("conn.php");
	$email = $_POST["email"];
	$pass = $_POST['password'];
	$type = $_POST['stype'];
	
	if($type == 'student')
	{
		$query2 = "SELECT count(*) from student WHERE email='$email'";
		$mailcheck = mysql_query($query2,$conn);
		
		$row = mysql_fetch_row($mailcheck);
		$user_count = $row[0];
		
		if($user_count > 0){
			session_Start();
			$_SESSION['errorlogin'] = "MAIL ID already registered";
			header( "refresh:2; url=index.php" );
		}
		else{
			$query1 = "INSERT INTO student (email,pass) VALUES ('$email','$pass')";
			$register = mysql_query($query1,$conn);
			if(isset($register)){
			session_start();
			$_SESSION['type'] = 'student';
			$_SESSION['email'] = $email;
			header( "refresh:2; url=internshipview.php" );
		}
		}
	}
	elseif($type == 'employee')
	{
		$query2 = "SELECT count(*) from employee WHERE email='$email'";
		$mailcheck = mysql_query($query2,$conn);
		
		$row = mysql_fetch_row($mailcheck);
		$user_count = $row[0];
		
		if($user_count > 0){
			session_Start();
			$_SESSION['errorlogin'] = "MAIL ID already registered";
			header( "refresh:2; url=index.php" );
		}
		else{
			$query1 = "INSERT INTO employee (email,pass) VALUES ('$email','$pass')";
			$register = mysql_query($query1,$conn);
			if(isset($register)){
			session_start();
			$_SESSION['type'] = 'employee';
			$_SESSION['email'] = $email;
			header( "refresh:2; url=internshippost.php" );
		}
		}
	}
	
	mysql_close($conn);

?>
<html>
    <body>
      <img src="images/Preloader_3.gif" alt="loading" height="200" width="200" style="padding-top:15%; padding-left:45%" align="center" />
    </body>
 </html>