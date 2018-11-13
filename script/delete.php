<?php 
include "connection.php";
$db=connectDb();
session_start();
$id=$_GET['id'];
$query="select * from posts where post_id='$id'";
$result=mysqli_query($db, $query);
$row=mysqli_fetch_assoc($result);
if($row['user_id']!=$_SESSION['login_id']||!isset($_SESSION['login_id'])||$_SESSION['permission']==0)
{
	setcookie('not_valid');
	exit(header('location:home1.php'));
}


$query="delete from posts where post_id='$id'";
	

if(mysqli_query($db,$query)==TRUE)
	{
		setcookie('post_deleted');
		exit(header('location:home2.php'));
	}
	
	


?>