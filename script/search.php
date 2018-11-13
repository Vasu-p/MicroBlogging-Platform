<?php
include 'functions.php';
session_start();
$search=$_POST['search'];
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
			.newpost{
				position:fixed;
				bottom: 10%;
				right: 8%;
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
			.cat_title{
			font-size: 36px;
			margin-bottom:30px;
			}
			
			.cat{
				margin-top:7px;
			}
			.cat img{
				margin-top:30px;
			}
			
		</style>
	<div class="navbar-fixed">
		<nav>
			<div class="nav-wrapper z-depth-2 teal lighten-2">
				<div class="container">
					<div class="col s12 m12 l12 navi">
						<a href="home1.php" class="brand-logo">Is it A Blog ??</a>
						<ul class="right">
							<?php if(isset($_SESSION['login_user'])) {?>
							<li><?php echo "<a href='profile.php?user_id=".$_SESSION['login_id']."'>Welcome ".$_SESSION['login_user']."</a>";?></li>
							<li><a href="home2.php">Home</a></li>
							<li><a href="chat.php">Chat</a></li>
							<li><a href="logout.php">Log Out</a></li>
							<?php } else {?>
							<li>
								<a href="signin_page.php">Sign In</a>
							</li>
							<li>
								<a href="signup_page.php">Sign Up</a>
							</li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
		</nav>
	</div>
		<div class="container">
			
			<?php if(isset($_SESSION['login_user'])) {?>
			<a class="btn-floating btn-large newpost tooltipped" href="new_post.php" data-position="left" data-delay="10" data-tooltip="Create New Post .."><i class="mdi-content-create prefix"></i></a>
			<?php }?>
			<div class="row">
        				<div class="col l12 cat_title center z-depth-1 teal lighten-5 teal-text flow-text">
        					Posts on <?php echo $search;?>
        					
        				</div>
        			</div>
			<div class="row">
				<div class="col l8 m8 s12">
					<!--  here  there will be posts ...... -->
				
        			
					
					<?php
					$page=1;
					$cnt=0;
					include 'connection.php';
					$db = connectDb();
					//$query = "select * from posts where (post_category like '%'$search%'' or post_title like %$search% or user_id=".idbyname($db, $search)." or post_body like %$search%) and (visible=1) order by post_likes desc,update_time desc";
					$query = "select * from posts where (post_category like '%$search%') or (post_title like '%$search%') and (visible=1)";
					$result=mysqli_query($db, $query);
					if (!$result) {
    				die(mysqli_error($db));
					}
					if(mysqli_num_rows($result)==0)
					echo "<div class='noposts'>There are no posts to show ..</div>";	
					else {
					
					
					while($row=mysqli_fetch_assoc($result))
					{
						if(!isset($_SESSION['login_user'])){
						echo "
						<div class='card hoverable posts page".$page."'>
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
						else
						{
							echo "
						<div class='card hoverable posts page".$page."'' id='".$row['post_id']."'>
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
              				<a href='inc_like.php?id=".$row['post_id']."' onclick='like(this)'><i class='mdi-action-favorite'></i></a>
              				<span class='badge red-text'>".$row['post_likes']." Likes</span>
              				
              				<a href='showbycategory.php?cat=".$row['post_category']."'>".$row['post_category']."</a>
              				<a href='#'>".date("jS M Y G:i ",strtotime($row['post_time']))."</a>
              				
            			</div>
						<div class='card-action teal lighten-5'>
              				
              				<a href='showpost.php?id=".$row['post_id']."'>See Post</a>
              				
            				<a class='right' href='showpost.php?id=".$row['post_id']."#comment'> ".noOfComments($db,$row['post_id']) ."</a>
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
						
					}
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
			
				<div class="col l4 m4 s12">
					<?php 
					if(isset($_SESSION['login_id']))
					{
					$user=$_SESSION['login_id'];
	 			 $query="select * from users where user_id='$user'";
	 			 $row=mysqli_fetch_assoc(mysqli_query($db, $query));
	 			 $query="select * from posts where user_id='$user'";
	 			 $result=mysqli_query($db, $query);
	  			 $row1=mysqli_num_rows($result);
					
					?>
					<div class="row cat z-depth-1">
						<div class="row center">
							<img src="../<?php echo $row['profile'];?>" width="150" height="150" class="circle" />
						</div>	
						<div class="row center">
							<p><?php echo $row['email'];?></p>
						</div>
						<div class="row center">
							<p>No of Posts : <?php echo $row1;?></p>
						</div>					
					</div>
					<?php } ?>
					<div class="row">
      					<div class="col l12 z-depth-1">
      						<form action="search.php" method="post">
      							<div class="row">
								     <div class="input-field col l12">
								      	<i class="mdi-action-search prefix"></i>
								      	<input id="search" type="text" name="search" required>
								      	<label for="search center">Search</label>
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
						<div class="col l12 z-depth-1 cat">
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
     	 $('ul.tabs').tabs();
   <?php if(!isset($_COOKIE['liked'])) {?>
   show(1,<?php echo $page;?>,$("#pagi1"));
   <?php  } else {
   	
	setcookie('liked',null);
   }?>
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
			function like(elem)
			{
				
				var page=$(elem).parent().parent().attr('class');
				var page_in=page.split(' ');
				page=page_in[3];
				page=page.substring(4,page.length);
				
				document.cookie="pageno="+page;
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
	  if(isset($_COOKIE['cantlike']))
	 {
	setcookie('cantlike',null);
	echo "<script type='text/javascript'>showToast('Cant like your own post...');</script>";
	 }
	  if(isset($_COOKIE['liked']))
	 {
	 	//echo "<script type='text/javascript'>showToast('".$_COOKIE['pageno']."');</script>";
		setcookie('liked',null);
		//echo "<script type='text/javascript'>show(".$_COOKIE['pageno'].",".$page.",$('#pagi".$_COOKIE['pageno']."'));</script>";
		?>
		<script type="text/javascript">
			var id=<?php echo $_COOKIE['likeid'];?>;
			//alert(id);
			var elem=$('#'+id);
			var page=$(elem).attr('class');
				var page_in=page.split(' ');
				page=page_in[3];
				page=page.substring(4,page.length);
				//alert(page);
			show(page,<?php echo $page; ?>,'#pagi'+page);
			elem=document.getElementById(id);  
			window.scrollTo(elem.offsetLeft,elem.offsetTop);
			
			//alert(elem.offsetTop);
		</script>
		<?php
	 }
?>
	</body>

</html>