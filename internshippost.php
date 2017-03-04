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
				
				}
		}
		else{
			header( "refresh:0; url=index.php" );
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
    <body onload="session1()"  class=" teal lighten-2">
	<div class="row container">
		<center>
			<h3 style="color:white" >EMPLOYEE PORTAL</h3>
			<a class="waves-effect deep-orange waves-light btn-large" href="#modal1">POST INTERNSHIP</a>
			<a class="waves-effect grey darken-3 waves-light btn-large tooltipped" href="logout.php" data-position="right" data-delay="50" data-tooltip="<?php echo $_SESSION['email'];  ?>" >LOGOUT</a>
			</center>
			<blockquote> POSTED INTERNSHIPS</blockquote>
			<table class="striped">
				<thead>
				  <tr>
					  <th data-field="name">Title</th>
					  <th data-field="name">Details</th>
					  <th data-field="price">Max students</th>
					  <th data-field="price"></th>
				  </tr>
				</thead>
				<tbody>
			<?php	
			include("conn.php");
		$mail = $_SESSION['email'];
		$query1 = "SELECT id from employee WHERE email='$mail'";
		$login = mysql_query($query1,$conn)or die(mysql_error());
		$res = mysql_fetch_array($login);
		if($res){
			
			$_SESSION['id'] = $res['id'];
		}
			$id = $_SESSION['id'];
			$query ="SELECT * FROM internships WHERE empid='$id'";
				$access = mysql_query($query,$conn) or die(mysql_error());
				while($row = mysql_fetch_array($access)) {
								echo '
									<tr>
										<td>'.$row['title'].'</td>
										<td>'.$row['detail'].'</td>
										<td>'.$row['no'].'</td>
										<td><a class="waves-effect blue lighten-3 waves-light btn" onclick="openstd('.$row['internid'].');" href="#appled">Applied Students</a></center></td>
									</tr>
								';
				}
	/*	
		$query1 = "SELECT * from employee WHERE email='$mail' and pass='$password'";
		$login = mysql_query($query1,$conn)or die(mysql_error());
		$res = mysql_fetch_array($login);
		if($res){
			session_start();
			$_SESSION['email'] = $res['email'];

			header( "refresh:2; url=internshippost.php" );
		}
		*/
					
			?>
				</tbody>
			</table>
			<!-- Modal Structure -->
		<div id="modal1" class="modal">
			<div class="modal-content">
				<Center><h4>INTERNSHIP DETAILS</h4></Center>
				<div class="row ">
				<form action="post.php" method="POST">
					<div class="input-field col s12">
					  <i class="material-icons prefix">business</i>
					  <input id="org" name="org" type="text" class="validate" required>
					  <label for="org">Organisation Name</label>
					</div>
					<div class="input-field col s8">
					  <i class="material-icons prefix">event</i>
					  <input id="title" name="title" type="text" class="validate" required>
					  <label for="title">Title</label>
					</div>
					<div class="input-field col s4">
					  <i class="material-icons prefix">portrait</i>
					  <input id="studentno" name="studentno" type="number" maxvalue="50" minvalue="1" class="validate" required>
					  <label for="studentno">No of students</label>
					</div>
					<div class="input-field col s12">
					  <i class="material-icons prefix">label</i>
					  <textarea id="detail" name="detail" class="materialize-textarea" required></textarea>
					  <label for="detail">Details</label>
					</div>
					
			</div>
			
			<div class="modal-footer">
				
				<button class=" modal-action modal-close btn waves-effect waves-light" type="submit" name="action">POST
					<i class="material-icons right">send</i>
				</button>
			</div>
			</form>
			</div>
		</div>
		<div id="appled" class="modal">
			<div class="modal-content">
					<h4>Students List</h4>
					<table class="striped">
				<thead>
				  <tr>
					  <th data-field="name">Student Email</th>
					  <th data-field="name">Action</th>
				  </tr>
				</thead>

				<tbody class="show">
				  
				</tbody>
			</table>
				
					<div class="modal-footer">
						<button class=" modal-action modal-close btn waves-effect waves-light" type="submit" name="action">CLOSE
							<i class="material-icons right">close</i>
						</button>
					</div>
			</div>
		</div>
	<div class="output">
	</div>
	  <!--Import jQuery before materialize.js-->
	  
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
	  <script>
	  function openstd(a){
			jQuery.ajax({
				url: "stdreg.php",
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