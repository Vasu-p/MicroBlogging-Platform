<?php 
include "connection.php";
session_start();
if(isset($_SESSION['login_user']))
{
	header('location:home2.php');
}
$db=connectDb();

$uname=$_POST["uname"];
$pass=$_POST["pass"];

if($uname=="admin")
{
	if($pass=="isitablog")
	{
	$_SESSION['isadmin']=1;
	exit(header('location:admin.php'));
	}
	else {
		setcookie('wrong');
		exit(header('location:signin_page.php'));
	}
}

$pass=sha1($pass);

$query="select * from users where username='$uname'";
if(mysqli_num_rows($res=mysqli_query($db,$query)))
	{
		$row=mysqli_fetch_assoc($res);
		if($row["password"]==$pass)
			{
				
				$_SESSION['login_user']=$uname;
				$_SESSION['login_id']=$row['user_id'];
				$_SESSION['permission']=$row['permission'];
				$_SESSION['profile']=$row['profile'];
				exit(header("location:home2.php"));
				die(); 
			}
		else
			{
				setcookie('wrong');
				exit(header("location:signin_page.php"));
			}
	}
else
	{
		setcookie('nouser');
		exit(header("location:signin_page.php"));
	}
	
?>