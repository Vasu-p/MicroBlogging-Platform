<?php 
include "connection.php";
session_start();

$db=connectDb();
$id=$_SESSION['login_id'];
$oldpass=$_POST["oldpass"];
$newpass=$_POST["newpass"];

$oldpass=sha1($oldpass);
$newpass=sha1($newpass);
$query="select * from users where user_id='$id'";
$result=mysqli_query($db, $query);
$row=mysqli_fetch_assoc($result);
if($row['password']!=$oldpass)
{
	setcookie('oldwrong');
	exit(header('location:changepasspage.php'));
}
$query="update users set password='$newpass' where user_id='$id'";
if(mysqli_query($db, $query))
{
	setcookie('changesuccess');
	exit(header('location:profile.php?user_id='.$id));
}
else{
	setcookie('changefail');
	exit(header('location:profile.php?user_id='.$id));	
}
	
?>