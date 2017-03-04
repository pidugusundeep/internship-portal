<?php
session_start();
include("conn.php");
$a = $_POST['internid'];

$query ="SELECT * FROM stdintern WHERE internid='$a'";
				$access = mysql_query($query,$conn) or die(mysql_error());
				while($row = mysql_fetch_array($access)) {
					$stdid = $row['stdid'];
					$query1 ="SELECT email FROM student WHERE id='$stdid'";
						$access1 = mysql_query($query1,$conn) or die(mysql_error());
							while($row1 = mysql_fetch_array($access1)) {
								echo '
									<tr>
										<td>'.$row1['email'].'</td>
										<td><a class="waves-effect light-green darken-3 lighten-3 waves-light btn" href="#sel">Select</a>&nbsp<a class="waves-effect red accent-3 lighten-3 waves-light btn" href="#rej">Reject</a></td>
									</tr>
								';
							}
				}


?>