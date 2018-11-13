<?php 
include "connection.php";
include 'functions.php';
require '../phpmailer/PHPMailerAutoload.php';
session_start();
if(isset($_SESSION['login_user']))
{
	header('location:home2.php');
}

$db=connectDb();

$uname=$_POST["uname"];

$query="select * from users where username='$uname' or email='$uname'";
$result=mysqli_query($db, $query);
if(mysqli_num_rows($result)==0)
{
	setcookie('nouser');
	exit(header('location:forgotpasspage.php'));
}
$row=mysqli_fetch_assoc($result);

$username=$row['username'];
$email=$row['email'];
$newpass=generateRandomString();
$newpasssha=sha1($newpass);
$message="<html>
<body>
<h3>Pass change instructions</h3>
<p>username::".$username."</p>
<p>new password::".$newpass."</p>
<p>use this to login and then change the password ...</p>
</body>
</html>
";

$query="update users set password='$newpasssha' where username='$username'";
//------------mail settings ------
date_default_timezone_set('Etc/UTC');

$mail = new PHPMailer;

$mail->SMTPDebug = 3;    
$mail->Debugoutput = 'html';                           // Enable verbose debug output
$mail->Mailer="smtp";
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'vasudevp2496@gmail.com';                 // SMTP username
$mail->Password = 'viva2486<stdio.h>';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to
//$mail->SMTPDebug=3;
$mail->From = 'vasudevp2496@gmail.com';
$mail->FromName = 'Is It A Blog ??';
     
$mail->addAddress($email);               // Name is optional

$mail->WordWrap=70;
$mail->Subject = 'Is It a Blog? Password change';
$mail->Body    = $message;
$mail->AltBody = 'try again';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
	
}




//------------mail settings ------



if(mysqli_query($db, $query))
{
	echo "pass";
	//setcookie('visitmail');
	//exit(header('location:signin_page.php'));
}
else {
	echo "fial";
	//setcookie('fail');
	//exit(header('location:forgotpasspage.php'));
}
	
?>