<?php include 'functions.php'; 
	  include 'connection.php';	
	  session_start();
	  
	  ob_start();
?>

<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link type="text/css" rel="stylesheet" href="../css/materialize.css"  media="screen,projection"/>
	
	<link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
<style>
			.navbar-fixed{
				margin-bottom:50px;
			}
			
			.title{
				margin-top:20px;
				font-size:25px;
				
			}
			.body{
				font-size:20px;
				margin-top:25px;
			}
			.newpost{
				position:fixed;
				bottom: 10%;
				right: 8%;
			}
			img{
				width: 80%;
			}
			.container .row{
				padding-bottom:10px;
			}
			.com_title{
				
				margin:0;
				font-size:20px;
			}
			.com_body{
				
				margin:0;
				font-size:15px;
			}
			
		</style>
<div class="navbar-fixed">
	<nav>
		<div class="nav-wrapper z-depth-2 teal lighten-2">
			<div class="container">
				<div class="col s12 m12 l12 navi">
					<a href="home1.php" class="brand-logo">Is it A Blog ??</a>
					<ul class="right">
						<?php if(isset($_SESSION['login_user'])) { ?>
						<li><?php echo "<a href='profile.php?user_id=".$_SESSION['login_id']."'>Welcome ".$_SESSION['login_user']."</a>";?></li>
						<li><a href="home1.php">Home</a></li>
						<li><a href="logout.php">Log Out</a></li>
						<?php } else {?>
							<li>
								<a href="signin_page.php">Sign In</a>
							</li>
							<li>
								<a href="signup_page.php">Sign Up</a>
							</li>
						<?php }?>	
						
					</ul>
				</div>
			</div>
		</div>	
	</nav>
</div>
	<div class="container">
		<?php if(isset($_SESSION['login_id'])) {?>
		<a class="btn-floating btn-large newpost tooltipped" href="new_post.php" data-position="left" data-delay="10" data-tooltip="Create New Post .."><i class="mdi-content-create prefix"></i></a>
		<?php 
		}
		$post_id=$_GET['id'];
		$db=connectDb();
		$query="select * from posts where post_id='$post_id'";
		$result=mysqli_query($db, $query);
		$row=mysqli_fetch_assoc($result);
		?>
		
		<div class="row center">
			
			<?php echo "<img src='data:image;base64,".$row['image']."'>" ?>
			
		</div>
		
		<div class="row card-panel blue lighten-5">
			<div class="col l4 title flow-text">
				Name of the Post :
				
			</div>
			<div class="col l8 body flow-text">
				<?php echo $row['post_title'];?>
				
				
			</div>
		</div>
		
		<div class="row card-panel deep-purple lighten-5">
			<div class="col l4 title flow-text">
				Body of the Post :
				
			</div>
			<div class="col l8 body flow-text">
				<?php echo $row['post_body'];?>
				
				
			</div>
		</div>
		
		<div class="row card-panel blue lighten-5">
			<div class="col l4 title flow-text">
				Category of the Post :
				
			</div>
			<div class="col l8 body flow-text">
				<?php echo $row['post_category'];?>
				
				
			</div>
		</div>
		
		<div class="row card-panel deep-purple lighten-5">
			<div class="col l4 title flow-text">
				Post Likes :
				
			</div>
			<div class="col l8 body flow-text">
				<?php echo $row['post_likes'];?>
				
				
			</div>
		</div>
		
		
		<div class="row card-panel blue lighten-5">
			<div class="col l4 title flow-text">
				Created At:
				
			</div>
			<div class="col l8 body flow-text">
				<?php echo $row['post_time'];?>
				
				
			</div>
		</div>
		<div class="row card-panel deep-purple lighten-5">
			<div class="col l4 title flow-text">
				Last Updated At:
				
			</div>
			<div class="col l8 body flow-text">
				<?php echo $row['update_time'];?>
				
				
			</div>
		</div>
		<div class="row card-panel blue lighten-5">
			<div class="col l4 title flow-text">
				Created By:
				
			</div>
			<div class="col l8 body flow-text">
				<?php echo writerofpost($db,$row['post_id']);?>
				
				
			</div>
		</div>
		
		<div class="row card-panel deep-purple lighten-5">
			<div class="col l4 title flow-text">
				Comments:
				
			</div>
			<div class="col l8 body flow-text">
				<ul class='collection'>
				 <?php 
				 $query="select * from comments where post_id='$post_id'";
				 $result=mysqli_query($db, $query);
				 while($row=mysqli_fetch_assoc($result))
				 {
				 	
				 echo "
				 
   	 				<li class='collection-item'>
      					<p class='com_title'>By: ".writerOfComment($db,$row['user_id'])."</p>
      					
      					<p class='com_body'>".$row['comm_body']."</p>
      				</li>
      			
				";
				}
				if(isset($_SESSION['login_user'])){
				echo "
					<li class='collection-item lime lighten-4' id='comment'>
      					<p class='com_title'>By: ".$_SESSION['login_user']."</p>
      					<form action='post_comment.php?id=".$post_id."' method='post'>
      					<input type='text' name='comment'>
      					<input type='submit' value='Post'>
      					</form>
      				</li>
				
				
				";}
				
				?>
				
				</ul>
			</div>
		</div>
		
		
	</div>
























	 <script type="text/javascript" src="js/jquery-2.1.4.js"></script>
     <script type="text/javascript" src="js/materialize.js"></script>
     <script type="text/javascript" src="js/general.js"></script>
     <script type="text/javascript">
     
		
    $(document).ready(function(){
    
    
    
		
  });    
	
     </script>
     <?php
     if(isset($_COOKIE['cant_comment']))
	 {
	setcookie('cant_comment',null);
	echo "<script type='text/javascript'>showToast('Cannot Post Comment ..');</script>";	
	 }
	 if(isset($_COOKIE['post_edited']))
	 {
	setcookie('post_edited',null);
	echo "<script type='text/javascript'>showToast('Edited Successfully ..');</script>";	
	 }
?>
</body>

</html>