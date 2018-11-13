<?php
session_start();
if(!isset($_SESSION['isadmin']))
exit(header('location:home1.php'));
?>


<html>
	<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link type="text/css" rel="stylesheet" href="../css/materialize.css"  media="screen,projection"/>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
	<body>
		<style>
		
		.navbar-fixed{
				margin-bottom:50px;
			}
		</style>
		<div class="navbar-fixed">
		<nav>
			<div class="nav-wrapper z-depth-2 teal lighten-2">
				<div class="container">
					<div class="col s12 m12 l12 navi">
						<a href="#" class="brand-logo">Is it A Blog ??</a>
						<ul class="right">
							<li>
								<a href="logout.php">Logout</a>
							</li>
							
						</ul>
					</div>
				</div>
			</div>
		</nav>
	</div>
<?php 
include "connection.php";
$db=connectDb();
$query="select * from users";
$res=mysqli_query($db,$query);
echo "<div class='container'>";

echo "<table class='bordered'>";
echo "<thead><tr>";
echo "<th>User_ID";
echo "<th>Username";
echo "<th>Email";
echo "<th>Phone";
echo "<th>Permission";
echo "</tr><tdead>";
echo "<tbody>";
while ($row=mysqli_fetch_assoc($res)) {

	echo "<tr>";
	echo "<td>".$row["user_id"];
	echo "<td><a href='admin_posts.php?id=".$row['user_id']."'>".$row["username"]."</a>";
	echo "<td>".$row["email"];
	echo "<td>".$row["phone"];
	echo "<td>
	 <div class='switch'>
    <label>
      No
      ";
	  if($row['permission']==1)
	  echo "<input type='checkbox' name='per' id=".$row['user_id']." checked>";
		else
		echo "<input type='checkbox' name='per' id=".$row['user_id']." >";
     
     echo "<span class='lever'></span>
      Yes
    </label>
  </div>
	
	";
	echo "<td><a href='deleteuser.php?id=".$row['user_id']."'><i class='mdi-content-remove-circle small'></i></a>";
	
	echo "</tr>";
	
}
echo "</tbody></table></div>";


?>
		<script type="text/javascript" src="../js/jquery-2.1.4.js"></script>
     <script type="text/javascript" src="../js/materialize.js"></script>
     <script type="text/javascript" src="../js/general.js"></script>
     <script type="text/javascript">
     	
     	$(':checkbox').change(function(){
     		var name=$(this).prop('id');
     		if($(this).is(':checked'))
     		$.post('change_permission.php',{id:name,value:1},function(res){
     			showToast(res);
     		});
     		else
     		$.post('change_permission.php',{id:name,value:0},function(res){
     			showToast(res);
     		});
     	});
     		
     	
     	
     </script>
	</body>
</html>