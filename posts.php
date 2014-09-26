<html>

  <head>
    <title>
      BUYNSELL@IITM
    </title>
  </head>
  <body>

  <?php
    session_start();
	include "header.php";
    include "db.php";
	echo "<div class='col-xs-8 col-xs-offset-2'";
	include "carousal.php";
	echo"<br><br><br>";
    if(!isset($_SESSION['user_id'])){
      header("Location: /buynsell/index.php?exp=1");
      exit();
    }
    
    $connection = mysqli_connect($WEBHOST, $USER, $PASSWORD,$DATABASE);
    
    if(!$connection)
      die("Mysql connection with the database failed".mysql_error());
      
      
    if(isset($_GET['myposts']) && $_GET['myposts'] == 1){
    
      echo"<style>ul#tagsmenu li {display : inline; padding:5px;}</style> 
      <ul id = 'tagsmenu'>
	<li><a href = 'posts.php?tag_id=1&myposts=1'>mobiles</a></li>
	<li><a href = 'posts.php?tag_id=2&myposts=1'>tablets</a></li>
	<li><a href = 'posts.php?tag_id=3&myposts=1'>laptops</a></li>
	<li><a href = 'posts.php?tag_id=4&myposts=1'>electronic devices</a></li>
	<li><a href = 'posts.php?tag_id=5&myposts=1'>cycles</a></li>
	<li><a href = 'posts.php?tag_id=6&myposts=1'>academics</a></li>
	<li><a href = 'posts.php?tag_id=8&myposts=1'>eatables</a></li>
	<li><a href = 'posts.php?tag_id=9&myposts=1'>others</a></li>
      </ul>	";
    
      echo "<h3>This page shows posts only from you</h3>";
      if(isset($_GET['tag_id'])){
	$result_items = mysqli_query($connection,"SELECT * FROM items,item_tags WHERE items.item_id = item_tags.item_id AND items.user_id = '{$_SESSION['user_id']}' AND item_tags.tag_id = '{$_GET['tag_id']}' ORDER BY timestamp DESC");
	if(!$result_items)
	  die("Mysql query error has occured ".mysql_error());
	  $result_items_rows = mysqli_num_rows($result_items);
	if($result_items_rows == 0)
	  echo "<span>Nothing to see here move along :)</span>";
	else{
	  for($i=0;$i<$result_items_rows;$i++){
	    $array = mysqli_fetch_array($result_items);
echo "<div class='item col-xs-3'><div class='item_details'>";
	  //echo "<span style = 'color:red'>Post Number: ".($i+1)."</span><br />";
	  echo "<span class='text-center' style = 'color:green'><h4> ".$array['item_name']."</h4></span><br />";
	  echo "<img class='center-block' src='pic.jpg' alt='404' height='200px' width='200px'>";
	  echo "<span class='center-block'><p class='text-center'>Rs. ".$array['price']."</p></span>";
	  //echo "<span>Description:<br /><span style = 'color:green'>".$array['description']."</span></span>";
	  //echo "<span>Reason for selling:<br /><span style = 'color:green'>".$array['reason']."</span></span><br /><br><br>";
	  }
	}
      }
      else{
	$result_items = mysqli_query($connection,"SELECT * FROM items WHERE user_id = '{$_SESSION['user_id']}' ORDER BY timestamp DESC");
	if(!$result_items)
	  die("Mysql query error".mysql_error());
	for($i=0;$i<mysqli_num_rows($result_items);$i++){
	  $array = mysqli_fetch_array($result_items);
echo "<div class='item col-xs-3'><div class='item_details'>";
	  //echo "<span style = 'color:red'>Post Number: ".($i+1)."</span><br />";
	  echo "<span class='text-center' style = 'color:green'><h4> ".$array['item_name']."</h4></span><br />";
	  echo "<img class='center-block' src='pic.jpg' alt='404' height='200px' width='200px'>";
	  echo "<span class='center-block'><p class='text-center'>Rs. ".$array['price']."</p></span>";
	  //echo "<span>Description:<br /><span style = 'color:green'>".$array['description']."</span></span>";
	  //echo "<span>Reason for selling:<br /><span style = 'color:green'>".$array['reason']."</span></span><br /><br><br>";

	}
      }
    
    }
    
    else if(isset($_GET['allposts']) && $_GET['allposts'] == 1){
    
      echo"<style> ul#tagsmenu li {display : inline; padding:5px;}</style> 
      <ul id = 'tagsmenu'>
	<li><a href = 'posts.php?tag_id=1&allposts=1'>mobiles</a></li>
	<li><a href = 'posts.php?tag_id=2&allposts=1'>tablets</a></li>
	<li><a href = 'posts.php?tag_id=3&allposts=1'>laptops</a></li>
	<li><a href = 'posts.php?tag_id=4&allposts=1'>electronic devices</a></li>
	<li><a href = 'posts.php?tag_id=5&allposts=1'>cycles</a></li>
	<li><a href = 'posts.php?tag_id=6&allposts=1'>academics</a></li>
	<li><a href = 'posts.php?tag_id=8&allposts=1'>eatables</a></li>
	<li><a href = 'posts.php?tag_id=9&allposts=1'>others</a></li>
      </ul>";
    
      echo "<h3>This page shows posts from all the users</h3>";
      if(isset($_GET['tag_id'])){
      
	$result_items = mysqli_query($connection,"SELECT * FROM items,item_tags WHERE items.item_id = item_tags.item_id AND item_tags.tag_id = '{$_GET['tag_id']}' ORDER BY timestamp DESC");
	if(!$result_items)
	  die("Mysql query error has occured ".mysql_error());
	  $result_items_rows = mysqli_num_rows($result_items);
	if( $result_items_rows == 0)
	  echo "<span>Nothing to see here move along :)</span>";
	else{
	  for($i=0;$i<$result_items_rows;$i++){
	    $array = mysqli_fetch_array($result_items);
echo "<div class='item col-xs-3'><div class='item_details'>";
	  //echo "<span style = 'color:red'>Post Number: ".($i+1)."</span><br />";
	  echo "<span class='text-center' style = 'color:green'><h4> ".$array['item_name']."</h4></span><br />";
	  echo "<img class='center-block' src='pic.jpg' alt='404' height='200px' width='200px'>";
	  echo "<span class='center-block'><p class='text-center'>Rs. ".$array['price']."</p></span>";
	  //echo "<span>Description:<br /><span style = 'color:green'>".$array['description']."</span></span>";
	  //echo "<span>Reason for selling:<br /><span style = 'color:green'>".$array['reason']."</span></span><br /><br><br>";
	  echo "</div><div class='user_details'><span style = 'color:blue'><b>User Details:<br /></b></span>";
	  
	  $userdetails = mysqli_query($connection,"SELECT * FROM userinfo WHERE id = '{$array['user_id']}'");
	  if(!$userdetails)
	    die("Mysql error in query".mysql_error());
	  $userarray = mysqli_fetch_array($userdetails);
	  echo "<span><span color: green>User Name: </span><span>".$userarray['fullname']."</span><br />";
	  echo "<span><span color: green>RollNumber: </span><span>".$userarray['rollno']."</span><br />";
	  echo "<span><span color: green>Hostel: </span><span>".$userarray['hostel']."</span><br />";
	  echo "<span><span color: green>Room Number: </span><span>".$userarray['roomno']."</span><br />";
	  echo "<span><span color: green>email id: </span><span>".$userarray['emailid']."</span><br />";
	  //include "comments.php";
	  echo "<br><br></div></div>";

	  }
	}
	
      }
      else{
$con=mysqli_connect("localhost","root","","buynsell");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM items") or die(mysqli_error($con));

	for($i=0;$i<mysqli_num_rows($result);$i++){
	  $array = mysqli_fetch_array($result);
	  echo "<div class='item col-xs-3'><div class='item_details'>";
	  //echo "<span style = 'color:red'>Post Number: ".($i+1)."</span><br />";
	  echo "<span class='text-center' style = 'color:green'><h4> ".$array['item_name']."</h4></span><br />";
	  echo "<img class='center-block' src='pic.jpg' alt='404' height='200px' width='200px'>";
	  echo "<span class='center-block'><p class='text-center'>Rs. ".$array['price']."</p></span>";
	  //echo "<span>Description:<br /><span style = 'color:green'>".$array['description']."</span></span>";
	  //echo "<span>Reason for selling:<br /><span style = 'color:green'>".$array['reason']."</span></span><br /><br><br>";
	  echo "</div><div class='user_details'><span style = 'color:blue'><b>User Details:<br /></b></span>";
	  
	  $userdetails = mysqli_query($connection,"SELECT * FROM userinfo WHERE id = '{$array['user_id']}'");
	  if(!$userdetails)
	    die("Mysql error in query".mysql_error());
	  $userarray = mysqli_fetch_array($userdetails);
	  echo "<span><span color: green>User Name: </span><span>".$userarray['fullname']."</span><br />";
	  echo "<span><span color: green>RollNumber: </span><span>".$userarray['rollno']."</span><br />";
	  echo "<span><span color: green>Hostel: </span><span>".$userarray['hostel']."</span><br />";
	  echo "<span><span color: green>Room Number: </span><span>".$userarray['roomno']."</span><br />";
	  echo "<span><span color: green>email id: </span><span>".$userarray['emailid']."</span><br />";
	  //include "comments.php";
	  echo "<br><br></div></div>";

	}
      }
    }

  ?>
</div>
  </body>
</html>