<?php include 'functions.php'; 
	  include 'connection.php';	
	  session_start();
	  if(!isset($_SESSION['login_user']))
	  exit(header('location:home1.php'));
	  ob_start();
	  $user=$_SESSION['login_id'];
	  $db=connectDb();
	  $send=$_GET['id'];
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
			.card{
				display:block;
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
			
			<div id ='chatwrap' style="height: 400px;margin-top: 80px;overflow: scroll" class="z-depth-1" class="row">
      			<div id="chat" class="col l12">
      				
      			</div>		
      		</div>
			<div class="row" style="margin-top: 80px">
      					<div class="col l10">
      						
      							
								     <div class="input-field col l12">
								      
								      	<input id="msg" type="text" name="search" required>
								      	<label for="msg">Message</label>
								     </div></div>
								
								<div class="col l2">
								      <div class="input-field col l12">
								      	<button onclick="sendmsg()" class="btn btn-floating btn-large waves-effect">Send</button>
								      	</div>
								    
      						
      					</div>	
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
      $(document).ready(function(){
    
    
     showmsg();
		
  });    
     $('#msg').keyup(
     	function(e)
     	{
     		if(e.which==13)
     		sendmsg();
     	}
     );
     
     function sendmsg()
     {
     	var msg=$('#msg').val();
     	//alert(msg);	
     	$('#msg').val('');
     	var d = $('#chatwrap');
		d.scrollTop(d.prop("scrollHeight"));
     	$.post(
     		"insertchat.php",
     		{send:<?php echo $send;?>,by:<?php echo $user;?>,message:msg},
     		function(data){
     			
     			showmsg();
     		}
     		
     	);
     	
     }
    
     function showmsg()
     {
     	
     	$.post(
     		"showchat.php",
     		{send:<?php echo $send;?>},
     		function(data){
     			$('#chat').html(data);
     			var d = $('#chatwrap');
				d.scrollTop(d.prop("scrollHeight"));
     		}
     	);
     	setTimeout(showmsg,1500);
     }
      
     
		</script>
</body>

</html>