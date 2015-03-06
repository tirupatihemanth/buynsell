

<?php
	require_once 'functions.php';
	session_start();
	sessionCheck();
	
	$connectionObject = getConnection();

	include "dnb.html";
	if(isset($_GET['item_id'])){
		
		$resultObject = queryDB($connectionObject, "SELECT items.*, userinfo.fullname, userinfo.id FROM items,userinfo WHERE items.user_id = userinfo.id AND items.item_id = '{$_GET['item_id']}'");
		$tagIdObject = queryDB($connectionObject, "SELECT tags.* FROM item_tags,tags where item_id = '{$_GET['item_id']}' AND tags.tag_id = item_tags.tag_id");
		$product = $resultObject->fetch_array(MYSQL_BOTH);
		echo "<br />";
		echo "<h3> Seller: <a href =viewprofile.php?user_id=".$product['user_id'].">".$product['fullname']."</a></h3>";
		echo "<br /><h3>Details of the product</h3>";
		
		echo "<h3>Images</h3>";
		for($i=0;$i<2;$i++){
			$src = "photos_items/".$product['id'].$product['item_id'].$i;
			if(file_exists($src.".jpeg")){
				echo "<img src=".$src.".jpeg style='width:256px;height:256px' />";
			}
			else if(file_exists($src.".gif")){
				echo "<img src=".$src.".gif style='width:256px;height:256px'/>";
			}
			else if(file_exists($src.".png")){
				echo "<img src=".$src.".png style='width:256px;height:256px'/>";
			}
		}
		
		echo "Name: <br />".$product['item_name']."<br /><br />";
		echo "Price: <br />".$product['price']."<br /><br />";
		echo "Description: <br />".$product['description']."<br /><br />";
		echo "Reason for selling: <br />".$product['reason']."<br /><br />";
		
		echo "<h3>Tags</h3>";
		
		$tagNames = Array();
		$resultObject = queryDB($connectionObject, "SELECT * FROM tags");
			
		for($i=0;$i<$resultObject->num_rows;$i++){
			$result = $resultObject->fetch_array();
			$tagNames[$result[0]] = $result[1];
		}
		echo "<ul>";
		for($i=0;$i<$tagIdObject->num_rows;$i++){
			$tagId = $tagIdObject->fetch_array();
			echo "<li>".$tagNames[$tagId[0]]."</li>";
		}
		echo "</ul>";
		echo "<br /><br />";
		
		echo "<p style = 'color:red'>Caution: The info in this page is as provided by the seller and buynsell or Insti Webops have no responsibility over the quality of the products</p>";
		$array['item_id'] = $_GET['item_id'];
		include "comments.php";
		
	}
	else{
		echo "Nothing to see here, Move Along :)";
	}
	
?>