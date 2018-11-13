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
$title=$_POST["postTitle"];
$body=$_POST["postBody"];
$category=$_POST["postCategory"];





	$image=addslashes($_FILES['image']['tmp_name']);
	$image=file_get_contents($image);
	$image=base64_encode($image);		


$query="update posts set post_title='$title',post_body='$body',post_category='$category',image='$image',update_time=now() where post_id='$id'";
	

if(mysqli_query($db,$query)==TRUE)
	{
		setcookie('post_edited');
		exit(header('location:showpost.php?id='.$id));
	}
else
	{
		setcookie('large');
		exit(header('location:editpostpage.php?id='.$id));
	}
	
	


?>