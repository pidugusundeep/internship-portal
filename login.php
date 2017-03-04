<?php
	include("conn.php");
	$mail = $_POST['email'];
	$password = $_POST['password'];
	$tp = $_POST['tp'];
	
	if($tp == "student"){
		
		$query1 = "SELECT * from student WHERE email='$mail' and pass='$password'";
		$login = mysql_query($query1,$conn)or die(mysql_error());
		$res = mysql_fetch_array($login);
		if($res){
			session_start();
			$_SESSION['email'] = $res['email'];
			$_SESSION['type'] = 'student';
			header( "refresh:2; url=internshipview.php" );
		}
		else{
			session_start();
			$_SESSION['errorlogin'] = "INCORRECT LOGIN DETAILS";
			header( "refresh:2; url=index.php" );
		}
		mysql_close($conn);
	}
	elseif($tp == "employee"){
		$query1 = "SELECT * from employee WHERE email='$mail' and pass='$password'";
		$login = mysql_query($query1,$conn)or die(mysql_error());
		$res = mysql_fetch_array($login);
		if($res){
			session_start();
			$_SESSION['type'] = 'employee';
			$_SESSION['email'] = $res['email'];

			header( "refresh:2; url=internshippost.php" );
		}
		else{
			session_start();
			$_SESSION['errorlogin'] = "INCORRECT LOGIN DETAILS";
			header( "refresh:2; url=index.php" );
		}
		mysql_close($conn);
	}
	
	/*
	$query1 = "SELECT * from users WHERE mail='$username' and pass='$password'";
	
	$login = mysql_query($query1,$conn)or die(mysql_error());
	$res = mysql_fetch_array($login);
	if($res){
		session_start();
		$_SESSION['uname'] = $res['uname'];
		$_SESSION['mail'] = $res['mail'];
		header( "refresh:0; url=index" );
		unset($_SESSION['errorlogin']);
		$_SESSION['welcome_msg'] = $res['uname'];
		$_SESSION['password'] = $res['pass'];
		$_SESSION['id'] = $res['ID'];
		$_SESSION['phone'] = $res['tel'];
	}
	else{
		
		session_start();
		$_SESSION['errorlogin'] = "INCORRECT LOGIN DETAILS";
		header( "refresh:2; url=index" );
	}
	mysql_close($conn);
*/
?>
<html>
    <body>
      <img src="images/Preloader_3.gif" alt="loading" height="200" width="200" style="padding-top:15%; padding-left:45%" align="center" />
    </body>
 </html>