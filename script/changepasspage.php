<?php 

session_start();
if(!isset($_SESSION['login_user']))
{
	setcookie('wrong');
	header('location:home1.php');
}
?>


<html>
<title>Change Password</title>
	<head>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
      	<link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
      	<link type="text/css" rel="stylesheet" href="css/style.css">
	</head>
	<style>
		.main{
			padding-top:30px;
			width:42%;
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
  <form class="col l6 offset-l3" method ="post" action="changepass.php">
    <div class="row">
      <div class="input-field col l12">
      	<i class="mdi-action-account-circle prefix"></i>
      	<input id="oldpass" type="password" name="oldpass" required>
      	<label for="oldpass">Old Password</label>
      	</div>
    </div>
   <div class="row">
      <div class="input-field col l12">
      	<i class="mdi-action-https prefix"></i>
      	<input id="pass" type="password" name="newpass" required title="6 to 12 charachters" pattern=".{6,12}"
      	data-position="right" data-delay="50" data-tooltip="6 to 12 charachters" class="validate">
      	<label for="pass">Password</label>
      	</div>
    </div>
    <div class="row center">
      <div class="input-field col l12">
      	<button type="submit" class="btn btn-floating btn-large"><i class="mdi-navigation-arrow-forward"></i></button>
      	</div>
    </div>
    
  </form>
</div>
		<script type="text/javascript" src="js/jquery-2.1.4.js"></script>
		<script type="text/javascript" src="js/materialize.js"></script>
		<script type="text/javascript" src="js/general.js"></script>
		<script type="text/javascript">
	
  $(document).ready(function(){
    $('#pass').tooltip({delay: 50});
    
  });
      
	
	
</script>
	<?php

if(isset($_COOKIE['oldwrong']))
{
	setcookie('oldwrong',null);
	echo "<script type='text/javascript'>showToast('Wrong Password');</script>";
}

?>

</body>
	<style>
		.main{
			margin-top:200px;
			
		}
		</style>
</html>