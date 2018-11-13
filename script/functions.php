<?php

function writerofpost($db,$post_id)
{
	
	$query="select username from users natural join posts where post_id='$post_id'";
	$result=mysqli_query($db, $query);
	$result=mysqli_fetch_assoc($result);
	return $result['username'];
}
function noOfComments($db,$post_id)
{
	$query="select * from comments where post_id='$post_id'";
	$result=mysqli_query($db, $query);
	$no=mysqli_num_rows($result);
	if($no==0)
	return "0 Comments";
	else if($no==1)
	return "1 Comment";
	else {
		return $no." Comments";
	}
}
function writerOfComment($db,$user_id)
{
	$query="select * from users where user_id='$user_id'";
	$result=mysqli_query($db, $query);
	$result=mysqli_fetch_assoc($result);
	return $result['username'];
	
}
function profileofwriter($db,$user_id)
{
	$query="select * from users where user_id='$user_id'";
	$result=mysqli_query($db, $query);
	$result=mysqli_fetch_assoc($result);
	return $result['profile'];
}
function idbyname($db,$username)
{
	$query="select * from users where username like '%$username%'";
	$result=mysqli_query($db, $query);
	$result=mysqli_fetch_assoc($result);
	return $result['user_id'];
}
function generateRandomString() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 10; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>