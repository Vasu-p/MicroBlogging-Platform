<?php include 'functions.php'; 
include 'connection.php';
ob_start();
//https://www.youtube.com/watch?v=4ZpqQ3j1o2w
session_start();
$db=connectDb();
$post_id=$_GET['id'];
$query="select * from posts where post_id='$post_id'";
$result=mysqli_query($db, $query);
$row=mysqli_fetch_assoc($result);
if($row['user_id']!=$_SESSION['login_id']||!isset($_SESSION['login_id'])||$_SESSION['permission']==0)
{
	setcookie('not_valid');
	exit(header('location:home1.php'));
}
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
			margin-top:30px;
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
				
  <form class="col l12" method="post" enctype="multipart/form-data" action="editpost.php?id=<?php echo $post_id;  ?>">
    <div class="row">
      <div class="input-field col l12">
      	<i class="mdi-action-description prefix"></i>
      
      	<input id='post_title' type='text' length='50' name='postTitle' required='true' value=<?php echo $row['post_title'];?>>
      
      	
      	<label for="post_title">Post Title</label>
      	</div>
    </div>
   <div class="row">
        <div class="input-field col l12">
        	<i class="mdi-content-create prefix"></i>
          <textarea id="post_body" class="materialize-textarea" length="10000" name="postBody" required><?php echo $row['post_body'];?></textarea>
          <label for="post_body">Post Body</label>
        </div>
      </div>
    <div class="row">
      <div class="input-field col l12">
      	
      	
      	 <select id="cat" name="postCategory">
     
      <option value="Art" <?php if($row['post_category']=="Art") echo "selected"; ?>>Art</option>
      <option value="Automotive" <?php if($row['post_category']=="Automotive") echo "selected"; ?>>Automotive</option>
      <option value="Beauty" <?php if($row['post_category']=="Beauty") echo "selected"; ?>>Beauty</option>
      <option value="Business" <?php if($row['post_category']=="Business") echo "selected"; ?>>Business</option>
      <option value="Comedy" <?php if($row['post_category']=="Comedy") echo "selected"; ?>>Comedy</option>
      <option value="Education" <?php if($row['post_category']=="Education") echo "selected"; ?>>Education</option>
      <option value="Entertainment" <?php if($row['post_category']=="Entertainment") echo "selected"; ?>>Entertainment</option>
      <option value="Eye Candy" <?php if($row['post_category']=="Eye Candy") echo "selected"; ?>>Eye Candy</option>
      <option value="Family" <?php if($row['post_category']=="Family") echo "selected"; ?>>Family</option>
      <option value="Fashion" <?php if($row['post_category']=="Fashion") echo "selected"; ?>>Fashion</option>
      <option value="Food" <?php if($row['post_category']=="Food") echo "selected"; ?>>Food</option>
      <option value="Gaming" <?php if($row['post_category']=="Gaming") echo "selected"; ?>>Gaming</option>
       <option value="Health" <?php if($row['post_category']=="Health") echo "selected"; ?>>Health</option>
      <option value="How To" <?php if($row['post_category']=="How To") echo "selected"; ?>>How To</option>
      <option value="Journal" <?php if($row['post_category']=="Journal") echo "selected"; ?>>Journal</option>
      <option value="Lifestyle" <?php if($row['post_category']=="Lifestyle") echo "selected"; ?>>Lifestyle</option>
      <option value="Movies and TV" <?php if($row['post_category']=="Movies and TV") echo "selected"; ?>>Movies and TV</option>
      <option value="Music" <?php if($row['post_category']=="Music") echo "selected"; ?>>Music</option>
       <option value="News" <?php if($row['post_category']=="News") echo "selected"; ?>>News</option>
      <option value="Pets and Animals" <?php if($row['post_category']=="Pets and Animals") echo "selected"; ?>>Pets and Animals</option>
      <option value="Photography" <?php if($row['post_category']=="Photography") echo "selected"; ?>>Photography</option>
      <option value="Politics" <?php if($row['post_category']=="Politics") echo "selected"; ?>>Politics</option>
       <option value="Relationships" <?php if($row['post_category']=="Relationships") echo "selected"; ?>>Relationships</option>
      <option value="Science" <?php if($row['post_category']=="Science") echo "selected"; ?>>Science</option>
      <option value="Sports" <?php if($row['post_category']=="Sports") echo "selected"; ?>>Sports</option>
      <option value="Tech" <?php if($row['post_category']=="Tech") echo "selected"; ?>>Tech</option>
      <option value="Travel" <?php if($row['post_category']=="Travel") echo "selected"; ?>>Travel</option>
      <option value="Women" <?php if($row['post_category']=="Women") echo "selected"; ?>>Women</option>
    </select>
    <label for="cat">Post Category</label>
    </div>
    </div>
    <div class="row">
    <div class="file-field input-field col l12">
      <input class="file-path validate" type="text"/>
      <div class="btn">
        <span>Upload Image</span>
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




















	<?php
	 if(isset($_COOKIE['large']))
	 {
	setcookie('large',null);
	echo "<script type='text/javascript'>showToast('Maybe too large image ..');</script>";
	 }
	 ?>


	 <script type="text/javascript" src="../js/jquery-2.1.4.js"></script>
     <script type="text/javascript" src="../js/materialize.js"></script>
     <script type="text/javascript" src="../js/general.js"></script>
     <script type="text/javascript">
$(document).ready(function() {
    $('select').material_select();
  });

        

     </script>
</body>

</html>