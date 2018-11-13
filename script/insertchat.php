<?php 
$send=$_POST['send'];
$by=$_POST['by'];
$msg=$_POST['message'];
//echo $msg;
include 'connection.php';
$db=connectDb();
$query="insert into chats values('','$by','$send','$msg',now())";
if(mysqli_query($db, $query))
{
	echo "success";
}
else
	{
		echo "faileed";
	}
?>