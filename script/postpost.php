<?php 
include "connection.php";
$db=connectDb();
session_start();
$title=$_POST["postTitle"];
$body=$_POST["postBody"];
$category=$_POST["postCategory"];

if(isset($_SESSION['login_id']))
$log_id=$_SESSION['login_id'];
else
	{
		setcookie('notin');
		exit(header('location:signin_page.php'));
		
	}


	$image=addslashes($_FILES['image']['tmp_name']);
	$image=file_get_contents($image);
	$image=base64_encode($image);		


$query="insert into posts(user_id,post_title,post_body,post_category,image) values('$log_id','$title','$body','$category','$image')";
if(mysqli_query($db,$query)==TRUE)
	{
		setcookie('post_inserted');
		exit(header('location:home2.php'));
	}
	
	else
	{
		setcookie('cant_insert_post');
		header('location:new_post.php');
	}	


?>