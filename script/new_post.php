<?php include 'functions.php'; 
include 'connection.php';
//https://www.youtube.com/watch?v=4ZpqQ3j1o2w
session_start();
if(!isset($_SESSION['login_id'])||$_SESSION['permission']==0)
{
	setcookie('not_valid');
	exit(header('location:home1.php'));
}
$db=connectDb();
$user=$_SESSION['login_id'];
?>

<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link type="text/css" rel="stylesheet" href="../css/materialize.css"  media="screen,projection"/>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
	<style>
		nav{
				margin-bottom:50px;
			}
			
			.cat img{
				margin-top: 30px;
			}
		
	</style>
	
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

	<div class="container">
		<div class="row">
			<div class="col l8 m8 s12">
			<div class="row">
  <form class="col l12" method="post" enctype="multipart/form-data" action="postpost.php">
    <div class="row">
      <div class="input-field col l12">
      	<i class="mdi-action-description prefix"></i>
      	<input id="post_title" type="text" length="50" name="postTitle" required="true">
      	<label for="post_title">Post Title</label>
      	</div>
    </div>
   <div class="row">
        <div class="input-field col l12">
        	<i class="mdi-content-create prefix"></i>
          <textarea id="post_body" class="materialize-textarea" length="10000" name="postBody" required></textarea>
          <label for="post_body">Post Body</label>
        </div>
      </div>
    <div class="row">
      <div class="input-field col l12">
      	
      	 <select id="cat" name="postCategory">
     
      <option value="Art" selected>Art</option>
      <option value="Automotive">Automotive</option>
      <option value="Beauty">Beauty</option>
      <option value="Business">Business</option>
      <option value="Comedy">Comedy</option>
      <option value="Education">Education</option>
      <option value="Entertainment">Entertainment</option>
      <option value="Eye Candy">Eye Candy</option>
      <option value="Family">Family</option>
      <option value="Fashion">Fashion</option>
      <option value="Food">Food</option>
      <option value="Gaming">Gaming</option>
       <option value="Health">Health</option>
      <option value="How To">How To</option>
      <option value="Journal">Journal</option>
      <option value="Lifestyle">Lifestyle</option>
      <option value="Movies and TV">Movies and TV</option>
      <option value="Music">Music</option>
       <option value="News">News</option>
      <option value="Pets and Animals">Pets and Animals</option>
      <option value="Photography">Photography</option>
      <option value="Politics">Politics</option>
       <option value="Relationships">Relationships</option>
      <option value="Science">Science</option>
      <option value="Sports">Sports</option>
      <option value="Tech">Tech</option>
      <option value="Travel">Travel</option>
      <option value="Women">Women</option>
    </select>
    <label for="cat">Post Category</label>
      	</div>
    </div>
    <div class="row">
    <div class="file-field input-field col l12">
      <input class="file-path validate" type="text"/>
      <div class="btn">
        <span>Upload Image</span>
        <input type="file" name="image" required="true" accept="image/*">
      </div>
    </div>
   </div> 
   
    <div class="row center">
      <div class="input-field col l12">
      	<button type="submit" class="btn btn-floating btn-large"><i class="mdi-navigation-arrow-forward
"></i></button>
      	</div>
    </div>
    
  </form>
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
     <script type="text/javascript">

	$(document).ready(function() {
    $('select').material_select();
  });
        

     </script>
</body>

</html>