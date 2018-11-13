<?php 
include "connection.php";
session_start();
if(!isset($_SESSION['login_user']))
{
	exit(header('location:home1.php'));
}
$db=connectDb();

$comm=$_POST['comment'];
$post_id=$_GET['id'];
$user_id=$_SESSION['login_id'];
$query="insert into comments values ('','$post_id','$user_id','$comm')";
$result=mysqli_query($db, $query);
if($result)
{
	exit(header('location:showpost.php?id='.$post_id.'#comment'));
}
else {
		setcookie('cant_comment');
		exit(header('location:showpost.php?id='.$post_id).'#comment');
	
}
?>