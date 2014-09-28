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
	echo "<div class='col-xs-8 col-xs-offset-2'><div class='col-xs-12'><h4 style='background-color:#505050;color:white;padding:10px;'>Top Deals</h4><hr>";

	include "carousal.php";
	echo "<div class='col-xs-4 wrap_offer'>";
	include "offers.php";
	echo "</div></div>";
	
	echo"<br><br><br>";
	echo "<hr><div class='col-xs-12'>";
    if(!isset($_SESSION['user_id'])){
      header("Location: /buynsell/index.php?exp=1");
      exit();
    }
    
    $connection = mysqli_connect($WEBHOST, $USER, $PASSWORD,$DATABASE);
    
    if(!$connection)
      die("Mysql connection with the database failed".mysql_error());
      
      
    if(isset($_GET['myposts']) && $_GET['myposts'] == 1){
    
	
      echo "<h4 style='background-color:#505050;color:white;padding:10px;'>Your Posts</h4>";
      $status = "myposts=1";
	  include "mini_menu.php";
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
	    echo "<a href='viewpost.php?myposts=1&item_id=".$array['item_id']."'>";
	  echo "<div class='item col-xs-3'><div class='item_details'>";
	  //echo "<span style = 'color:red'>Post Number: ".($i+1)."</span><br />";
	  echo "<span class='text-center'><h4> ".$array['item_name']."</h4></span><br />";
	  echo "<img class='center-block' src='photos_items/".$array['user_id'].$array['item_id']."' alt='404' height='200px' width='200px'>";
	  echo "<span class='center-block'><p class='text-center price'>Rs. ".$array['price']."</p></span></div></div>";
	  //echo "<span>Description:<br /><span style = 'color:green'>".$array['description']."</span></span>";
	  //echo "<span>Reason for selling:<br /><span style = 'color:green'>".$array['reason']."</span></span><br /><br><br>";
	  echo "</a>";	
	  }
	}
      }
      else{
	$result_items = mysqli_query($connection,"SELECT * FROM items WHERE user_id = '{$_SESSION['user_id']}' ORDER BY timestamp DESC");
	if(!$result_items)
	  die("Mysql query error".mysql_error());
	if(mysqli_num_rows($result_items)==0)
		echo "<p>You haven't made any posts. To post something click <a href='newpost.php'>here</a> or click post an AD at the top of the page</a></p>";
	for($i=0;$i<mysqli_num_rows($result_items);$i++){
	  $array = mysqli_fetch_array($result_items);
	  echo "<a href = 'viewpost.php?myposts=1&item_id=".$array['item_id']."'>";
		echo "<div class='item col-xs-3'><div class='item_details'>";
	  //echo "<span style = 'color:red'>Post Number: ".($i+1)."</span><br />";
	  echo "<span class='text-center'><h4> ".$array['item_name']."</h4></span><br />";
	  echo "<img class='center-block' src='photos_items/".$array['user_id'].$array['item_id']."' alt='404' height='200px' width='200px'>";
	  echo "<span class='center-block'><p class='text-center price'>Rs. ".$array['price']."</p></span></div></div>";
	  //echo "<span>Description:<br /><span style = 'color:green'>".$array['description']."</span></span>";
	  //echo "<span>Reason for selling:<br /><span style = 'color:green'>".$array['reason']."</span></span><br /><br><br>";
	  echo "</a>";

	}
      }
    
    }
    
    else if(isset($_GET['allposts']) && $_GET['allposts'] == 1){
        
      echo "<h4 style='background-color:#505050;color:white;padding:10px;'>All Deals</h4>";
      $status = "allposts=1";
	include "mini_menu.php";
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
	    echo "<a href = 'viewpost.php?allposts=1&item_id=".$array['item_id']."'>";
	echo "<div class='item col-xs-3'><div class='item_details'>";
	  //echo "<span style = 'color:red'>Post Number: ".($i+1)."</span><br />";
	  echo "<span class='text-center'><h4> ".$array['item_name']."</h4></span><br />";
	  echo "<img class='center-block' src='photos_items/".$array['user_id'].$array['item_id']."' alt='404' height='200px' width='200px'>";
	  echo "<span class='center-block'><p class='text-center price'>Rs. ".$array['price']."</p></span>";
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
	  echo "</a>";

	  }
	}
	
      }
      else{
$con=mysqli_connect($WEBHOST,$USER,$PASSWORD,$DATABASE);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM items") or die(mysqli_error($con));

	for($i=0;$i<mysqli_num_rows($result);$i++){
	  $array = mysqli_fetch_array($result);
	  echo "<a href = 'viewpost.php?allposts=1&item_id=".$array['item_id']."'>";
	  echo "<div class='item col-xs-3'><div class='item_details'>";
	  //echo "<span style = 'color:red'>Post Number: ".($i+1)."</span><br />";
	  echo "<span class='text-center'><h4> ".$array['item_name']."</h4></span><br />";
	  echo "<img class='center-block' src='photos_items/".$array['user_id'].$array['item_id']."' alt='404' height='200px' width='200px'>";
	  echo "<span class='center-block'><p class='text-center price'>Rs. ".$array['price']."</p></span>";
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
	  echo "</a>";

	}
      }
    }

  ?>
  </div>
</div>
  </body>
</html>