<?php
session_start();
if(!isset($_SESSION['login_user']))
{
	header('location:home1.php');
}
include 'connection.php';
$db=connectDb();
$sender=$_SESSION['login_id'];
$rec=$_POST['send'];
$query="select *from chats where (send_to='$rec' and send_by='$sender') or (send_to='$sender' and send_by='$rec') order by send_time";
//$query="select * from chats where send_to='$rec' and send_by='$sender' order by send_time desc";
$result=mysqli_query($db, $query) or die(mysqli_error($db));
while($row=mysqli_fetch_assoc($result))
{
	if($row['send_by']==$sender)
	echo "
	<div class='row' style='margin:0'>
	<p class='col l4 offset-l8 teal lighten-3' style='border-radius:30px;padding:5px 2px;text-align:right'>".$row['msg']."</p>
	</div>
	
	";
	else 
		echo "
	<div class='row' style='margin:0'>
	<p class='col l4 teal lighten-1' style='border-radius:30px;padding:5px 2px'>".$row['msg']."</p>
	</div>
	
	";
	
}
?>