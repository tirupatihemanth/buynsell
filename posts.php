<?php 
session_start();
require_once 'functions.php';
sessionCheck();
include 'dnb.html';
?>

<!DOCTYPE HTML>
<html>
    
    <body>
        
        
        <div class='container col-xs-10 col-xs-offset-1'>
            <!--Insert content replacing the para and heading below-->

<!--<div class='col-xs-12'><div class='col-xs-12'><h4 style='background-color:#505050;color:white;padding:10px;'>Top Deals</h4><hr>

Don't Delete-->
<br>
<br>
<div class='col-xs-10 col-xs-offset-1'>
    
    <a href='special.php?item_id=00'>
        <img src="photos_items/special.jpeg" class="img-responsive" alt="Responsive image">
        <h4 class='text-center'>Buy the Institute T-Shirt - Now Available exclusively at Buy & Sell!</h4>
    </a>
</div>
<?php
//include "carousal.php";
//echo "<div class='col-xs-4 wrap_offer'>";
//include "offers.php";
//echo "</div></div>";

echo"<br>";
echo "<hr><div class='col-xs-12'>";

$connectionObject = getConnection();
$resultObject = "";
if(isset($_GET['myposts']) && $_GET['myposts']==1){
	$status = "myposts=1";
	if(isset($_GET['tag_id'])){
		$resultObject = queryDB($connectionObject, "SELECT * FROM items,item_tags WHERE items.item_id = item_tags.item_id AND items.user_id = '{$_SESSION['user_id']}' AND item_tags.tag_id = '{$_GET['tag_id']}' ORDER BY timestamp DESC");
	}
	else{
		$resultObject = queryDB($connectionObject, "SELECT * FROM items WHERE user_id = '{$_SESSION['user_id']}' ORDER BY timestamp DESC");
	}
	
}
else if(isset($_GET['allposts']) && $_GET['allposts']==1 && isset($_GET['tag_id'])){
	
	$status = "allposts=1";
	$resultObject = queryDB($connectionObject, "SELECT * FROM items,item_tags WHERE items.item_id = item_tags.item_id AND item_tags.tag_id = '{$_GET['tag_id']}' ORDER BY timestamp DESC");

}
else{
	$status = "allposts=1";
	$resultObject = queryDB($connectionObject, "SELECT * FROM items");
}


if(isset($_GET['myposts']) && $_GET['myposts'] == 1){


  echo "<h4 style='background-color:#505050;color:white;padding:10px;'>Your Posts</h4>";
  $status = "myposts=1";
  include "mini_menu.php";
  if(isset($_GET['tag_id'])){
  	
  	$resultObject = queryDB($connectionObject, "SELECT * FROM items,item_tags WHERE items.item_id = item_tags.item_id AND items.user_id = '{$_SESSION['user_id']}' AND item_tags.tag_id = '{$_GET['tag_id']}' ORDER BY timestamp DESC");

	$rows = $resultObject->num_rows;
    if($rows == 0)
      echo "<span>No ads in this category</span>";
    else{
      for($i=0;$i<$rows;$i++){
        $array = $resultObject->fetch_array();
        echo "<a href='viewpost.php?myposts=1&item_id=".$array['item_id']."'>";
        echo "<div class='item col-xs-3'><div class='item_details'>";
        echo "<span class='text-center'><h4> ".$array['item_name']."</h4></span><br /><a href='viewpost.php?myposts=1&item_id=".$array['item_id']."'>";
          $src = "photos_items/".$array['item_id']."0";
          echo $src;
            if(file_exists($src.".jpeg")){
                    echo "<img src=".$src.".jpeg  class='thumbnail center-block col-xs-12'/>";
                }
                else if(file_exists($src.".gif")){
                    echo "<img src=".$src.".gif  class='thumbnail center-block col-xs-12'/>";
                }
                else if(file_exists($src.".png")){
                    echo "<img src=".$src.".png  class='thumbnail center-block col-xs-12'/>";
            }
        echo "</a><span class='center-block'><p class='text-center price'>Rs. ".$array['price']."</p></span></div></div>";
        echo "</a>";	
      }
    }
  }
  else{
  	
  	$result = queryDB($connectionObject, "SELECT * FROM items WHERE user_id = '{$_SESSION['user_id']}' ORDER BY timestamp DESC");

    $rows = $result->num_rows;
    if($rows==0)
      echo "<p>You haven't made any posts. To post something click <a href='newpost.php'>here</a> or click post an AD at the top of the page</a></p>";
    for($i=0;$i<$rows;$i++){
      $array = $result->fetch_array();
      echo "<a href = 'viewpost.php?myposts=1&item_id=".$array['item_id']."'>";
      echo "<div class='item col-xs-3'><div class='item_details'>";
      echo "<span class='text-center'><h4> ".$array['item_name']."</h4></span><br /><a href='viewpost.php?myposts=1&item_id=".$array['item_id']."'>";
          $src = "photos_items/".$array['item_id']."0";
        echo $src;
            if(file_exists($src.".jpeg")){
                    echo "<img src=".$src.".jpeg  class='thumbnail center-block col-xs-12'/>";
                }
                else if(file_exists($src.".gif")){
                    echo "<img src=".$src.".gif  class='thumbnail center-block col-xs-12'/>";
                }
                else if(file_exists($src.".png")){
                    echo "<img src=".$src.".png  class='thumbnail center-block col-xs-12'/>";
            }
        echo "<span class='center-block'><p class='text-center price'>Rs. ".$array['price']."</p></span></div></div>";
      echo "</a>";

    }
  }

}

else if(isset($_GET['allposts']) && $_GET['allposts'] == 1){

  echo "<h4 style='background-color:#505050;color:white;padding:10px;'>All Deals</h4>";
  $status = "allposts=1";
  include "mini_menu.php";
  if(isset($_GET['tag_id'])){
  	$resultObject = queryDB($connectionObject, "SELECT * FROM items,item_tags WHERE items.item_id = item_tags.item_id AND item_tags.tag_id = '{$_GET['tag_id']}' ORDER BY timestamp DESC");
  	$rows = $resultObject->num_rows;
    
    if( $rows == 0)
      echo "<span>No ads in this category</span>";
    else{
      for($i=0;$i<$rows;$i++){
      	$array = $resultObject->fetch_array();
        echo "<a href = 'viewpost.php?allposts=1&item_id=".$array['item_id']."'>";
        echo "<div class='item col-xs-3'><div class='item_details'>";
        echo "<span class='text-center'><h4> ".$array['item_name']."</h4></span><br /><a href='viewpost.php?myposts=1&item_id=".$array['item_id']."'>";
          $src = "photos_items/".$array['item_id']."0";
          echo $src;
            if(file_exists($src.".jpeg")){
                    echo "<img src=".$src.".jpeg  class='thumbnail center-block col-xs-12'/>";
                }
                else if(file_exists($src.".gif")){
                    echo "<img src=".$src.".gif  class='thumbnail center-block col-xs-12'/>";
                }
                else if(file_exists($src.".png")){
                    echo "<img src=".$src.".png  class='thumbnail center-block col-xs-12'/>";
            }
          echo "<span class='center-block'><p class='text-center price'>Rs. ".$array['price']."</p></span>";
       
/*        echo "</div><div class='user_details'><span style = 'color:blue'><b>User Details:<br /></b></span>";
         $resultObject = queryDB($connectionObject, "SELECT * FROM userinfo WHERE id = '{$array['user_id']}'");
		$userarray = $resultObject->fetch_array();
        echo "<span><span color: green>User Name: </span><span>".$userarray['fullname']."</span><br />";
        echo "<span><span color: green>RollNumber: </span><span>".$userarray['rollno']."</span><br />";
        echo "<span><span color: green>Hostel: </span><span>".$userarray['hostel']."</span><br />";
        echo "<span><span color: green>Room Number: </span><span>".$userarray['roomno']."</span><br />";
        echo "<span><span color: green>email id: </span><span>".$userarray['emailid']."</span><br />"; */
        echo "<br><br></div></div>";
        echo "</a>";

      }
    }

  }
  else{
  	$resultObject = queryDB($connectionObject, "SELECT * FROM items");
	$rows = $resultObject->num_rows;
    for($i=0;$i<$rows;$i++){
    	$array = $resultObject->fetch_array();
      echo "<a href = 'viewpost.php?allposts=1&item_id=".$array['item_id']."'>";
      echo "<div class='item col-xs-3'><div class='item_details'>";
      echo "<span class='text-center'><h4> ".$array['item_name']."</h4></span><br /><a href='viewpost.php?myposts=1&item_id=".$array['item_id']."'>";
          $src = "photos_items/".$array['item_id']."0";
            if(file_exists($src.".jpeg")){
                    echo "<img src=".$src.".jpeg  class='thumbnail center-block col-xs-12'/>";
                }
                else if(file_exists($src.".gif")){
                    echo "<img src=".$src.".gif  class='thumbnail center-block col-xs-12'/>";
                }
                else if(file_exists($src.".png")){
                    echo "<img src=".$src.".png  class='thumbnail center-block col-xs-12'/>";
            }
        echo "<span class='center-block'><p class='text-center price'>Rs. ".$array['price']."</p></span>";

/*      echo "</div><div class='user_details'><span style = 'color:blue'><b>User Details:<br /></b></span>";
       $resultObject = queryDB($connectionObject, "SELECT * FROM userinfo WHERE id = '{$array['user_id']}'");
		$userarray = $resultObject->fetch_array();
      echo "<span><span color: green>User Name: </span><span>".$userarray['fullname']."</span><br />";
      echo "<span><span color: green>RollNumber: </span><span>".$userarray['rollno']."</span><br />";
      echo "<span><span color: green>Hostel: </span><span>".$userarray['hostel']."</span><br />";
      echo "<span><span color: green>Room Number: </span><span>".$userarray['roomno']."</span><br />";
      echo "<span><span color: green>email id: </span><span>".$userarray['emailid']."</span><br />";
      */
      echo "<br><br></div></div>"; 
      echo "</a>";

    }
  }

}

?>
  </div>
</div>

        </div>
    
    <script type="text/javascript" src="skrollr.stylesheets.js"></script>
    <script type="text/javascript" src="skrollr.js"></script>
    <script type="text/javascript">skrollr.init();</script>
    </body>
</html>
