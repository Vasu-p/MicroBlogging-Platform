<?php include 'functions.php'; 
	  include 'connection.php';	
	  session_start();
	  if(!isset($_SESSION['login_user']))
	  exit(header('location:home1.php'));
	  ob_start();
	  //<a href='delete.php?id=".$row['post_id']."' class='tooltipped' data-tooltip='Delete Post..' data-position='bottom' data-delay='10'><i class='mdi-content-remove-circle tiny'></i></a>
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
			.posts{
				margin-bottom:30px;
				
			}
			.tabs{
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
			.newpost{
				position:fixed;
				bottom: 10%;
				right: 8%;
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
				margin-top:80px;
				
			}
			.cat img{
				margin-top: 30px;
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
						<li><a href="chat.php">Chat</a></li>
						<li><a href="logout.php">Log Out</a></li>
					</ul>
				</div>
			</div>
		</div>	
	</nav>
</div>

	<div class="container">
		
		<a class="btn-floating btn-large newpost tooltipped" href="new_post.php" data-position="left" data-delay="10" data-tooltip="Create New Post .."><i class="mdi-content-create prefix"></i></a>
		
		<div class="row">
			<div class="col l8 m8 s12">
			<!--  here  there will be posts ...... -->
				<ul class="tabs">
        			<li class="tab col l6"><a href="#all" active>All Posts</a></li>
        			<li class="tab col l6"><a href="#your">Your Posts</a></li>
       			</ul> 
					<div id="all">
					<?php
					
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
						<div class='card hoverable posts page".$page."' id='".$row['post_id']."'>
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
					<div id="your">
					<?php
					
					$db = connectDb();
					$user=$_SESSION['login_id'];
					$query = "select * from posts where user_id='$user' order by post_likes desc,update_time desc";
					
					$result=mysqli_query($db, $query);
					if(mysqli_num_rows($result)==0)
					echo "<div class='noposts'>There are no posts to show ..</div>";
					
					while($row=mysqli_fetch_assoc($result))
					{
						echo "
						<div class='card hoverable posts' id='".$row['post_id']."'>
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
						<div class='card-action teal lighten-5'>
              				
              				<a href='showpost.php?id=".$row['post_id']."'>See Post</a>
              				<a href='editpostpage.php?id=".$row['post_id']."'>Edit Post</a>
            				<a class='right' href='showpost.php?id=".$row['post_id']."#comment'> ".noOfComments($db,$row['post_id']) ."</a>
            				<a href='#modal".$row['post_id']."' class='tooltipped modal-trigger' data-tooltip='Delete Post..' data-position='bottom' data-delay='10'><i class='mdi-content-remove-circle tiny'></i></a>
            			
            			<div id='modal".$row['post_id']."' class='modal'>
    						<div class='modal-content'>
      							<h4>Confirm Delete</h4>
     			 				<p>Are you sure you want to delete this post permenantly?</p>
    						</div>
    						<div class='modal-footer'>
      							<a href='delete.php?id=".$row['post_id']."' class=' modal-action modal-close waves-effect waves-green btn-flat'>Yes</a>
      							<a href='#!' class=' modal-action modal-close waves-effect waves-green btn-flat'>No</a>
    						</div>
  						</div>				
  						
            			</div>
            			<div class='card-reveal'>
         			 	<span class='card-title grey-text text-darken-4'>".$row['post_title']."<i class='mdi-navigation-close right'></i></span>
          				<p>".$row['post_body']."</p>
        				</div>
        				
						</div>
						
						
						
						
						
						
						
						";
						
					}
					
					
					

					?>
					</div>
					
				</div>
				
				<div class="col l4 m4 s12">
					<?php 
					
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
     	$('.modal-trigger').leanModal();
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
	  if(isset($_COOKIE['post_deleted']))
	 {
	setcookie('post_deleted',null);
	echo "<script type='text/javascript'>showToast('Post deleted successfully...');</script>";
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