
<?php 
include "connection.php";
session_start();
if(!isset($_SESSION['login_user']))
{
	exit(header('location:home1.php'));
}


$db=connectDb();

$post_id=$_GET['id'];
$query="select *from posts where post_id='$post_id'";
$result=mysqli_query($db, $query);
$row=mysqli_fetch_assoc($result);
if($row['user_id']==$_SESSION['login_id']){
	setcookie('cantlike');
	exit(header('location:home2.php'));
}


$query="update posts set post_likes=post_likes+1 where post_id='$post_id'";
$result=mysqli_query($db, $query);

setcookie('liked');
setcookie('likeid',$post_id);
if($result)
{
	if(strstr($_SERVER['HTTP_REFERER'],"category")==FALSE) 
	exit(header('location:home2.php#'.$post_id));
	else
		{
			$cat=strstr($_SERVER['HTTP_REFERER'], "cat=");
			$cat=substr($cat, 4);
			exit(header('location:showbycategory.php?cat='.$cat.'#'.$post_id));
		}
}
?>