<?php 
function connectDb()
{
if($link=mysqli_connect('localhost','root','','blog'))
{
	
	return $link;
}
else
	die("cant connect" . mysqli_error());
}
?>