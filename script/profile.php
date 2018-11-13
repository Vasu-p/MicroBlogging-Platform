<?php include 'functions.php'; 
	  include 'connection.php';	
	  session_start();
	  if(!isset($_SESSION['login_user']))
	  {
	  	setcookie('not_valid');
	  exit(header('location:home1.php'));
	  }
	  ob_start();
	  $db=connectDb();
	  $id=$_GET['user_id'];
	  $query="select * from users where user_id='$id'";
	  $result=mysqli_query($db,$query);
	  $row=mysqli_fetch_assoc($result);
	  $query="select * from posts where user_id='$id'";
	  $result=mysqli_query($db, $query);
	  $row1=mysqli_num_rows($result);
	  
?>

<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link type="text/css" rel="stylesheet" href="../css/materialize.css"  media="screen,projection"/>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
<style>
			.navbar-fixed{
				margin-bottom:50px;
			}
			.pro{
				width: 220px;
				height:220px;
			}
			.procon h5{
				margin:10px 0 0 0;
			}
			.procon p{
				margin:0;
			}
			.procon{
				border-radius:40px;
			}
			.action{
				margin-top:20px;
			}
		</style>
<div class="navbar-fixed">
	<nav>
		<div class="nav-wrapper z-depth-2 teal lighten-2">
			<div class="container">
				<div class="col s12 m12 l12 navi">
					<a href="home2.php" class="brand-logo">Is it A Blog ??</a>
					<ul class="right">
						<li><?php echo "<a href='profile.php?user_id=".$_SESSION['login_id']."'>Welcome ".$_SESSION['login_user']."</a>";?></li>
						<li><a href="home2.php">Home</a></li>
						<li><a href="chat.php">Chat</a></li>
						<li><a href="logout.php">Log Out</a></li>
					</ul>
				</div>
			</div>
		</div>	
	</nav>
</div>
	<div class="container">
		<div class="row">
			<div class="col l4">
				<img src='../<?php echo $row['profile']?>' class="circle pro"></img>
				<?php if($_SESSION['login_id']==$id) { ?>
				<div class="row action">
				<div class="col l12">
					<a class="btn btn-large" href="changepasspage.php">Change Password</a>
				</div>
				</div>
			<?php } ?>
			</div>
			<div class="col l5">
				<div class="card procon">
					<h5 class="center"><?php echo $row['username'];?></h5>
					<br>
					<p class="center">Username</p>
				</div>
				<div class="card procon">
					<h5 class="center"><?php echo $row['email'];?></h5>
					<br>
					<p class="center">Email</p>
				</div>
				
				<div class="card procon">
					<h5 class="center"><?php echo $row['phone'];?></h5>
					<br>
					<p class="center">Phone</p>
				</div>
				<div class="card procon">
					<h5 class="center"><?php echo $row1;?></h5>
					<br>
					<p class="center">No of Posts</p>
				</div>
			</div>
			
		</div>
	</div>
























	 <script type="text/javascript" src="../js/jquery-2.1.4.js"></script>
     <script type="text/javascript" src="../js/materialize.js"></script>
     <script type="text/javascript" src="../js/general.js"></script>
     <script type="text/javascript">
     
		
    $(document).ready(function(){
    
    
     $('ul.tabs').tabs();
		
  });    
	
     </script>
     <?php
     if(isset($_COOKIE['changesuccess']))
	 {
	setcookie('changesuccess',null);
	echo "<script type='text/javascript'>showToast('Password changed successfully...');</script>";
	 }
	 if(isset($_COOKIE['changefail']))
	 {
	setcookie('changefail',null);
	echo "<script type='text/javascript'>showToast('Cant change password...');</script>";
	 }
	

?>
</body>

</html>