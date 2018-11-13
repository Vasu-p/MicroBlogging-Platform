<?php
include 'functions.php';
session_start();
if(isset($_SESSION['login_user']))
exit(header('location:home2.php'));
ob_start();
?>

<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link type="text/css" rel="stylesheet" href="../css/materialize.css"  media="screen,projection"/>
		
	</head>
	<body>
		<style>
			.navbar-fixed{
				margin-bottom:50px;
			}
			.posts{
				margin-bottom:30px;
			}
			.card-image img{
				height: 300px;
			}
			.noposts{
				font-size:20px;
				text-align:center;
				margin-top:20px;
			}
			.title h3{
				margin:0;
				font-size:15px;
			}
			.title p{
				margin:0;
				font-size:12px;
			}
			#cat-title{
				font-size:20px;
			}
			.card-content img{
				height:80px;
				width:80px;	
				margin-bottom:0;
			}
			.main{
				margin:0;
			}
			.main h3{
				margin-top:10px;
			}
			.cat{
				margin-top:7px;
			}
			.pagination li{
				font-size:20px;
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
								<a href="signin_page.php">Sign In</a>
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
		<div class="container">
			<div class="row">
				<div class="col l8 m8 s12">
					<!--  here  there will be posts ...... -->
				
        			
					
					<?php
					include 'connection.php';
					$db = connectDb();
					$query = "select * from posts where visible=1 order by post_likes desc,update_time desc";
					$result=mysqli_query($db, $query);
					if(mysqli_num_rows($result)==0)
					echo "<div class='noposts'>There are no posts to show ..</div>";
					$page=1;
					$cnt=0;
					while($row=mysqli_fetch_assoc($result))
					{
						echo "
						<div class='card hoverable posts page".$page."' id='all'>
						<div class='card-content title'>
						<div class='row main'>
						<div class='col l2'>
							<a href='profile.php?user_id=".$row['user_id']."'><img src='../".profileofwriter($db,$row['user_id'])."' class='circle'></img></a>
						</div>
						<div class='col l10'>
              				<h3>Posted By :-<a href='profile.php?user_id=".$row['user_id']."'> ".writerofpost($db,$row['post_id'])." </a></h3><br>
              				<p>Last edited : ".date("jS M Y G:i ",strtotime($row['update_time']))."</p>
              			</div>	
              			</div>	
            			</div>	
						<div class='card-image'>
              				<img src='data:image;base64,".$row['image']."' class='activator tooltipped' data-tooltip='Click to read..' data-position='top' data-delay='50'>
             			 	<span class='card-title'>".$row['post_title']."</span>
            			</div>
            			<div class='card-content teal lighten-4'>
              				<p class='truncate activator'>".$row['post_body']."</p>
            			</div>
            			<div class='card-action teal lighten-5'>
              				<a href='showpost.php?id=".$row['post_id']."'>See Post</a>
              				<span class='badge red-text'>".$row['post_likes']." Likes</span>
              				<a href='showbycategory.php?cat=".$row['post_category']."'>".$row['post_category']."</a>
              				<a href='#'>".date("jS M Y G:i ",strtotime($row['post_time']))."</a>
            			</div>
						
            			<div class='card-reveal'>
         			 	<span class='card-title grey-text text-darken-4'>".$row['post_title']."<i class='mdi-navigation-close right'></i></span>
          				<p>".$row['post_body']."</p>
        				</div>
						</div>
						
						
						
						
						
						
						
						";
						$cnt++;
						if($cnt%2==0)
						$page++;
					}
					if($cnt%2==0)
					$page--;
					
					

					?>
					<div class="row">
						<div class="col l14 offset-l4">
					<ul class="pagination">
						
						<?php 
						for($i=1;$i<=$page;$i++)
						{
							echo "<li class='waves-effect'><a id='pagi".$i."' onclick='show(".$i.",".$page.",this)'>".$i."</a></li>";
						}
						?>
						
					</ul>
					</div>
					</div>
					
				</div>
					
				<div class="col l4 m4 s12 cat">
					<div class="row">
      					<div class="col l12 z-depth-1">
      						<form action="search.php" method="post">
      							<div class="row">
								     <div class="input-field col l12">
								      	<i class="mdi-action-search prefix"></i>
								      	<input id="search" type="text" name="search" required>
								      	<label for="search">Search</label>
								     </div>
								</div>
								<div class="row center">
								      <div class="input-field col l12">
								      	<button type="submit" class="btn btn-floating btn-large waves-effect"><i class="mdi-navigation-arrow-forward"></i></button>
								      	</div>
								     </div>
      						</form>
      					</div>	
      				</div>
      				<div class="row">
						<div class="col l12 z-depth-1">
							<h4 id="cat-title" class="center">Categories</h4>
					      	<div class="collection">
					       	<?php 
					       	$query="select distinct post_category from posts where visible=1";
					       	$result=mysqli_query($db, $query);
					       	while($row=mysqli_fetch_assoc($result)){
					       		echo "<a class='collection-item' href='showbycategory.php?cat=".$row['post_category']."'>".$row['post_category']."</a> ";
					       	}
					       	?>
					      	</div>
					   </div>
      				</div>
				</div>
			</div>
			
		</div>
		
        
            
		<script type="text/javascript" src="../js/jquery-2.1.4.js"></script>
		<script type="text/javascript" src="../js/materialize.js"></script>
		<script type="text/javascript" src="../js/general.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
   show(1,<?php echo $page;?>,$("#pagi1"));
  });
			
			
			function show(pageno,total,elem){
				var i;
				for(i=1;i<=total;i++){
				$('.page'+i).hide();
				$('#pagi'+i).parent().removeClass("active");
				}
				$('.page'+pageno).show();
				$(elem).parent().addClass("active");
				window.scrollTo(0, 0);
			}
			
			
			
			
		</script>
		<?php

if(isset($_COOKIE['post_inserted']))
{
	setcookie('post_inserted',null);
	echo "<script type='text/javascript'>showToast('Post created successfully...');</script>";
}
if(isset($_COOKIE['not_valid']))
	 {
	setcookie('not_valid',null);
	echo "<script type='text/javascript'>showToast('You are not authorised...');</script>";
	 }
?>
	</body>

</html>