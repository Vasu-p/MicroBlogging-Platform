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
								<a href="admin.php">Users</a>
							</li>
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
$id=$_GET['id'];
$query="select * from posts where user_id='$id'";
$res=mysqli_query($db,$query);
$query="select * from users where user_id='$id'";
$user=mysqli_fetch_assoc(mysqli_query($db, $query));

echo "<div class='container'>";
echo "<h3 class='center'>Posts by ".$user['username']."</h3>";
echo "<table class='bordered'>";
echo "<thead><tr>";
echo "<th>Post_id";
echo "<th>Title";

echo "<th>Category";
echo "<th>Posted at";
echo "<th>Updated at";
echo "<th>Likes";
echo "</tr><tdead>";
echo "<tbody>";
while ($row=mysqli_fetch_assoc($res)) {

	echo "<tr>";
	echo "<td>".$row["post_id"];
	echo "<td>".$row["post_title"];
	
	echo "<td>".$row["post_category"];
	echo "<td>".$row["post_time"];
	echo "<td>".$row["update_time"];
	echo "<td>".$row["post_likes"];
	echo "<td>
	 <div class='switch'>
    <label>
      No
      ";
	  if($row['visible'])
	  echo "<input type='checkbox' name='per' id=".$row['post_id']." checked>";
		else
		echo "<input type='checkbox' name='per' id=".$row['post_id']." >";
     
     echo "<span class='lever'></span>
      Yes
    </label>
  </div>
	
	";
	
	
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
     		$.post('change_visibility.php',{id:name,value:1},function(res){
     			showToast(res);
     		});
     		else
     		$.post('change_visibility.php',{id:name,value:0},function(res){
     			showToast(res);
     		});
     	});
     		
     	
     	
     </script>
	</body>
</html>