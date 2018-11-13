<?php 
include "connection.php";
$db=connectDb();
session_start();
$uname=$_POST["uname"];
$pass=$_POST["pass"];
$em=$_POST["email"];
$ph=$_POST["phone"];
$pass=sha1($pass);

$image=$_FILES['image']['tmp_name'];
$target="images/".$_FILES['image']['name'];
if(!move_uploaded_file($image, $target)){
	$target="images/default.jpg";
	
}

$query="insert into users values('','$uname','$pass','$em','$ph','0','$target')";
if(mysqli_query($db,$query))
	{
				$_SESSION['login_user']=$uname;
				$query="select * from users where username='$uname'";
				$row=mysqli_fetch_assoc(mysqli_query($db, $query));
				$_SESSION['login_id']=$row['user_id'];
				$_SESSION['permission']=$row['permission'];
				header("location:home2.php");
	}
	else
	{
				$query="select * from users where username='$uname'";
				if(mysqli_num_rows(mysqli_query($db, $query)))
				{
					setcookie('taken');
					header('location:signup_page.php');
				}
			
	}


?>