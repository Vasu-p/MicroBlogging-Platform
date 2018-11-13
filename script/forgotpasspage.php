<?php 

session_start();
if(isset($_SESSION['login_user']))
{
	header('location:home2.php');
}
?>


<html>
<title>Sign IN</title>
	<head>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
      	<link type="text/css" rel="stylesheet" href="../css/materialize.css"  media="screen,projection"/>
      	<link type="text/css" rel="stylesheet" href="../css/style.css">
	</head>
	<style>
		.main{
			padding-top:30px;
			width:42%;
			margin-top:200px;
		}
		
	</style>
	<body>
		<div class="navbar-fixed">
		<nav>
			<div class="nav-wrapper z-depth-2 teal lighten-2">
				<div class="container">
					<div class="col s12 m12 l12 navi">
						<a href="#" class="brand-logo">Is it A Blog ??</a>
						<ul class="right">
							<li>
								<a href="home1.php">Home</a>
							</li>
							<li>
								<a href="signup_page.php">Sign Up</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</nav>
	</div>
	



		<div class="row z-depth-1 main">
			<div class="row center">
				<p>Enter Your username or email to receive password change instructions ..</p>
			</div>
  <form class="col l6 offset-l3" method ="post" action="forgotpass.php">
    <div class="row">
      <div class="input-field col l12">
      	<i class="mdi-action-account-circle prefix"></i>
      	<input id="username" type="text" name="uname" required>
      	<label for="username">Username or Email</label>
      	</div>
    </div>
   
    <div class="row center">
      <div class="input-field col l12">
      	<button type="submit" class="btn btn-floating btn-large waves-effect"><i class="mdi-navigation-arrow-forward"></i></button>
      	</div>
    </div>
    
  </form>
 
</div>
		<script type="text/javascript" src="../js/jquery-2.1.4.js"></script>
		<script type="text/javascript" src="../js/materialize.js"></script>
		<script type="text/javascript" src="../js/general.js"></script>
	<?php


if(isset($_COOKIE['nouser']))
{
	setcookie('nouser',null);
	echo "<script type='text/javascript'>showToast('User Not Found');</script>";
}
if(isset($_COOKIE['fail']))
{
	
	setcookie('notin',null);
	echo "<script type='text/javascript'>showToast('Failed ..');</script>";
}
?>

</body>
	
</html>