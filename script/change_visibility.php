<?php 
session_start();
if(!isset($_SESSION['isadmin']))
exit(header('location:home1.php'));

$id=$_POST['id'];
$val=$_POST['value'];
include 'connection.php';
$db=connectDb();
$query="update posts set visible='$val' where post_id='$id'";
$result=mysqli_query($db, $query);
if($result)
{
	echo "Visibility changed";
	
}
?>