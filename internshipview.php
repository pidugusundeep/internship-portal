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
			if($_SESSION['type'] == "employee"){
				$_SESSION['errorlogin'] = "Welcome ".$_SESSION['email'];
				header( "refresh:0; url=internshippost.php" );
				}
		}
		else{

		}
?>
  <!DOCTYPE html>
  <html>
    <head>
	  <title>EMPLOYEE PORTAL</title>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body  onload="session1()" class=" teal lighten-2">
	<div class="row container">
		<center>
			<h3 style="color:white">INTERNSHIPS</h3>
			<?php
				if(isset($_SESSION["type"])){
					
					echo'<a class="waves-effect grey darken-3 waves-light btn-large tooltipped" href="logout.php" data-position="right" data-delay="50" data-tooltip="'.$_SESSION['email'].'" >LOGOUT</a>
						';
				}
				else{
					echo'<a class="waves-effect grey darken-3 waves-light btn-large" href="index.php">LOGIN</a>';
				}
			
			?>
			</center>
			<blockquote> POSTED INTERNSHIPS</blockquote>
			<div class="row">
				
			<?php	
			include("conn.php");
			if(isset($_SESSION['email'])){
		$mail = $_SESSION['email'];
		$query1 = "SELECT id from student WHERE email='$mail'";
		$login = mysql_query($query1,$conn)or die(mysql_error());
		$res = mysql_fetch_array($login);
		if($res){
			
			$_SESSION['id'] = $res['id'];
		}
			$id = $_SESSION['id'];
			}
			$query ="SELECT * FROM internships";
				$access = mysql_query($query,$conn) or die(mysql_error());
				while($row = mysql_fetch_array($access)) {
					if(isset($_SESSION['email'])){
						$a = $row['internid'];
						$query1 = "SELECT * from stdintern WHERE internid='$a' and stdid='$id'";
						$enq = mysql_query($query1,$conn)or die(mysql_error());
						$resp = mysql_fetch_array($enq);
						if($resp){
							$_SESSION['appliedstatus'] = "YES";
						}
						else{
							$_SESSION['appliedstatus'] = "NO";
						}
					}
					if(isset($_SESSION['appliedstatus'])){
						
					}
					else{
						$_SESSION['appliedstatus'] = "NO";
					}
					
								echo '
										<div class="card deep-purple">
											<div class="card-content white-text">
											  <span class="card-title">'.$row['title'].'</span>
											  <p>'.$row['detail'].'</p>
											</div>
											<div class="card-action">
											  <span style="color:#ff80ab;" >Interns Available : <b>'.$row['no'].'</b></span>
									';
										if($_SESSION['appliedstatus'] == "YES"){
												echo '<a class="waves-effect waves-light btn right deep-orange darken-2 ">APPLIED</a>';
										}
										else{
												echo '
												<form action="apply.php" method="POST">
												<input id="internid" name="internid" type="hidden" value="'.$row['internid'].'"/>
												<button class=" modal-action modal-close btn waves-effect waves-light " type="submit" name="action">APPLY
													<i class="material-icons right">send</i>
												</button>
												</form>';
											}
								echo'
											</div>
										</div>
										
									
								';
				}
				
			?>
			</div>	
			
			</div>
		<!--	<div class="show">
				hello
			</div>
			-->
		
	  <!--Import jQuery before materialize.js-->
	  
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
	  <script>
	  function apply(a){
			jQuery.ajax({
				url: "apply.php",
				data:'internid='+a,
				type: "POST",
				success:function(data){
					$(".show").html(data);
				},
				error:function (){}
				});
		}
		  $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
  });
  $(document).ready(function(){
    $('.tooltipped').tooltip({delay: 50});
  });
	  </script>
    </body>
  </html>