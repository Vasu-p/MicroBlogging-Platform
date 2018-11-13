<?php
$search=$_POST['search'];
session_start();
include 'connection.php';
$db = connectDb();
//$query = "select * from posts where (post_category like '%'$search%'' or post_title like %$search% or user_id=".idbyname($db, $search)." or post_body like %$search%) and (visible=1) order by post_likes desc,update_time desc";
$query = "select * from users where username like '%$search%'";
$result=mysqli_query($db, $query);
if(mysqli_num_rows($result)==0)
echo "No users found";
else {
while($row=mysqli_fetch_assoc($result))
{
	if($row['user_id']!=$_SESSION['login_id'])	
	echo "
	
		<div class='card center z-depth-0'>
		<a href='chatpage.php?id=".$row['user_id']."' style='float:left'><img src='../".$row['profile']."' class='circle' style='height:80px;width:80px'></img></a>
	<a href='chatpage.php?id=".$row['user_id']."'>
   	<h3 style='font-size:20px;text-align:left;'>".$row['username']."</h3></a>
  	</div>            				
  	
    
	";	
}
}

?>