<?php
session_Start();

if(isset($_SESSION['errorlogin'])){
			echo '<script>
					function session1(){
					Materialize.toast("'.$_SESSION['errorlogin'].'", 1500);
					}
				  </script>';
				  unset($_SESSION['errorlogin']);
		}
if(isset($_SESSION['email']) && $_SESSION['type']){
	if($_SESSION['type'] == "student"){
		$_SESSION['errorlogin'] = "Welcome ".$_SESSION['email'];
		header( "refresh:0; url=internshipview.php" );
	}
	elseif($_SESSION['type'] == "employee"){
		$_SESSION['errorlogin'] = "Welcome ".$_SESSION['email'];
		header( "refresh:0; url=internshippost.php" );
	}
}	
		
?>
  <!DOCTYPE html>
  <html>
    <head>
	  <title>INTERNSHIP PORTAL</title>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body  onload="session1()" class=" teal lighten-2">
	<div class="row">
      <div class="card col s10 m8 l6 hoverable push-l3 push-m2 push-s1">
		<div class="card-content">
		  <h2 class="center">INTERNSHIP PORTAL</h2>
		</div>
		<div class="card-tabs">
		  <ul class="tabs tabs-fixed-width">
			<li class="tab"><a class="active" href="#slogin">Student Login</a></li>
			<li class="tab"><a class="active" href="#elogin">Employer</a></li>
			<li class="tab"><a  href="#signup">Signup</a></li>
		  </ul>
		</div>
		<div class="card-content">
		  <div id="slogin">
			<div class="row">
			<form action="login.php" method="POST">
				<div class="input-field col s8 push-s2">
				  <i class="material-icons prefix">account_circle</i>
				  <input id="smail" type="text" name="email" class="validate" required>
				  <label for="smail">Student Email</label>
				</div>
				<div class="input-field col s8 push-s2">
				  <i class="material-icons prefix">lock</i>
				  <input id="spass" type="password" name="password" class="validate" required>
				  <label for="spass">Password</label>
				</div>
				<input type="hidden" value="student" id="tp" name="tp"/>
			</div>
			<div class="row">
			<button class="btn waves-effect waves-light col s4 push-s4" type="submit" name="action">Login
					<i class="material-icons right">send</i>
				</button>
				</form>
			</div>
		  </div>
		  <div id="elogin">
			<div class="row">
			<form action="login.php" method="POST">
				<div class="input-field col s8 push-s2">
				  <i class="material-icons prefix">account_circle</i>
				  <input id="email" type="text" name="email" class="validate" required>
				  <label for="email">Employee Email</label>
				</div>
				<div class="input-field col s8 push-s2">
				  <i class="material-icons prefix">lock</i>
				  <input id="password" name="password" type="password" class="validate" required>
				  <label for="epass">Password</label>
				</div>
				<input type="hidden" value="employee" id="tp" name="tp"/>
			</div>
			<div class="row">
			<button class="btn waves-effect waves-light col s4 push-s4" type="submit" name="action">Login
					<i class="material-icons right">send</i>
				</button>
				</form>
			</div>
		  </div>
		  <div id="signup">
			<div class="row">
			<form action="signup.php" method="POST">
				<div class="input-field col s8 push-s2">
				  <i class="material-icons prefix">account_circle</i>
				  <input id="email" type="email" name="email" class="validate" required>
				  <label for="email">Email</label>
				</div>
				<div class="input-field col s8 push-s2">
				  <i class="material-icons prefix">lock</i>
				  <input id="password" type="password" name="password" class="validate" required>
				  <label for="password">Password</label>
				</div>
				<div class="input-field col s8 push-s2">
				  <i class="material-icons prefix">lock</i>
				  <input id="password1" type="password" class="validate"  required>
				  <label for="password1">Re-Password</label>
				</div>
			</div>
			<div class="row">
				<div class="col s4 push-s4">
					<input name="stype" type="radio" value="student" id="test1"  required />
					<label for="test1">Student</label>
				</div>
				<div class="col s4 push-s2">
					<input name="stype" type="radio" value="employee" id="test2"  required />
					<label for="test2">Employee</label>
				</div>
			</div>
			<div class="row">
			<button class="btn waves-effect waves-light col s4 push-s4" onclick="signup()" type="submit" name="action">Signup
					<i class="material-icons right">send</i>
				</button>
				</form>
			</div>
			
		  </div>
		</div>
		
	  </div>
	</div>
	<div class="row">
		<a class="col s4 push-s4 waves-effect  light-blue darken-4 waves-light btn-large" href="internshipview.php" ><i class="material-icons right">launch</i>VIEW POSTED INTERNSHIPS</a>
	</div>
	<div class="output">
	</div>
	  <!--Import jQuery before materialize.js-->
	  
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
	  <script>
		$(document).ready(function() {
    $('select').material_select();
  });
	  </script>
    </body>
  </html>