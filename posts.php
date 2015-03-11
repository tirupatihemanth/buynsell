<?php 
session_start();
require_once 'functions.php';
sessionCheck();
include 'dnb.html';
?>

<!DOCTYPE HTML>
<html>
    
    <body>
        
        
        <div class='content col-xs-10 col-xs-offset-1'>
            <!--Insert content replacing the para and heading below-->

<div class='col-xs-12'><div class='col-xs-12'><h4 style='background-color:#505050;color:white;padding:10px;'>Top Deals</h4><hr>

<?php
include "carousal.php";
echo "<div class='col-xs-4 wrap_offer'>";
include "offers.php";
echo "</div></div>";

echo"<br><br><br>";
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

echo "<h4 style='background-color:#505050;color:white;padding:10px;'>Your Posts</h4>";

$rows = $resultObject->num_rows;

if($rows == 0)
	echo "<span>Nothing to see here move along :)</span>";
else{
	for($i=0;$i<$rows;$i++){
		$array = $resultObject->fetch_array();
		echo "<a href='viewpost.php?".$status."&item_id=".$array['item_id']."'>";
		echo "<div class='item col-xs-3'><div class='item_details'>";
		echo "<span class='text-center'><h4> ".$array['item_name']."</h4></span><br />";
		
		for($j=0;$j<2;$j++){
			$src = "photos_items/".$array['item_id'].$j;
			if(file_exists($src.".jpeg")){
				echo "<img src='".$src.".jpeg' 'alt='404' height='200px' width='200px' /><br />";
				break;
			}
			else if(file_exists($src.".gif")){
				echo "<img src='".$src.".gif'  'alt='404' height='200px' width='200px' /><br />";
				break;
			}
			else if(file_exists($src.".png")){
				echo "<img src='".$src.".png' 'alt='404' height='200px' width='200px'/><br />";
				break;
			}
		}
		
		//echo "<img class='center-block' src='".$src."'alt='404' height='200px' width='200px'>";
		echo "<span class='center-block'><p class='text-center price'>Rs. ".$array['price']."</p></span></div></div>";
		echo "</a>";
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
