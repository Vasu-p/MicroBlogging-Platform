<html>
	<head>
		<title>Sign Up</title>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
      	<link type="text/css" rel="stylesheet" href="../css/materialize.css"  media="screen,projection"/>
      	<link type="text/css" rel="stylesheet" href="../css/style.css">
	</head>
	
	
	<body>
		<style>
			.main{
				margin-top:30px;
				width:60%;
			}
			
		</style>

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
								<a href="signin_page.php">Sign In</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</nav>
	</div>
		<div class="row main z-depth-1">
			<h3 class="center">Sign Up</h3>
  <form class="col l6 offset-l3" enctype="multipart/form-data" method ="post" action="signup.php">
    <div class="row">
      <div class="input-field col l12">
      	<i class="mdi-action-account-circle prefix"></i>
      	<input id="username" type="text" length="10" name="uname" required pattern="^[a-zA-Z0-9]*$"
      	data-position="right" data-delay="50" data-tooltip="Must be alphanumeric" autocomplete="off" class="validate">
      	<label for="username">Username</label>
      	</div>
    </div>
    <div class="row">
      <div class="input-field col l12">
      	<i class="mdi-action-https prefix"></i>
      	<input id="pass" type="password" name="pass" required title="6 to 12 charachters" pattern=".{6,12}"
      	data-position="right" data-delay="50" data-tooltip="6 to 12 charachters" class="validate">
      	<label for="pass">Password</label>
      	</div>
    </div>
    <div class="row">
      <div class="input-field col l12">
      	<i class="mdi-action-https prefix"></i>
      	<input id="email" type="email" name="email" required
      	data-position="right" data-delay="50" data-tooltip="Enter valid Email" class="validate">
      	<label for="email">Email</label>
      	</div>
    </div>
    <div class="row">
      <div class="input-field col l12">
      	<i class="mdi-action-https prefix"></i>
      	<input id="phone" type="text" name="phone" pattern=".{10}" title="Must be 10 characters" required
      	data-position="right" data-delay="50" data-tooltip="Enter 10 Character phone no" class="validate">
      	<label for="phone">Phone</label>
      	</div>
    </div>
    <div class="row">
    <div class="file-field input-field col l12">
      <input class="file-path validate" type="text"/>
      <div class="btn">
        <span>Profile Image</span>
        <input type="file" name="image" required accept="image/*">
      </div>
    </div>
   </div> 
    <div class="row center">
      <div class="input-field col l12">
      	<button type="submit" class="btn btn-floating btn-large"><i class="mdi-navigation-arrow-forward"></i></button>
      	</div>
    </div>
    
  </form>
</div>
		<script type="text/javascript" src="../js/jquery-2.1.4.js"></script>
		<script type="text/javascript" src="../js/materialize.js"></script>
	<script type="text/javascript">
	
  $(document).ready(function(){
    $('#username,#pass,#phone,#email').tooltip({delay: 50});
    
  });
      
	
	
</script>
	<?php

if(isset($_COOKIE['taken']))
{
	setcookie('taken',null);
	echo "<script type='text/javascript'>showToast('Username already taken');</script>";
}
?>

	</body>
	
</html>