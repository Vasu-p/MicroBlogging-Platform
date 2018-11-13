<?php

session_start();
include 'connection.php';

if(!isset($_SESSION['isadmin']))
exit(header('location:home1.php'));

$db=connectDb();
$id=$_GET['id'];
$query="delete from users where user_id='$id'";
if(mysqli_query($db, $query)){
	
	exit(header('location:admin.php'));
	
}
else {
	
	exit(header('location:admin.php'));
}


?>