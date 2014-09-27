//use viewpost.php?item_id='value' will give the details about the individual product and the user

<?php
	session_start();
	if(!isset($_SESSION['user_id'])){
		header("Location: /buynsell/index.php?exp=1");
		exit();
	}
	$connection = mysqli_connect($WEBHOST,$USER,$PASSWORD,$DATABASE);
	if(!$connection){
		die("Connection to the databse failed ".mysql_error());
	}

?>

<?php
if(isset($_GET['item_id'])){
	$result = mysql_query("SELECT * FROM items,userinfo WHERE items.user_id = userinfo.id AND items.item_id = '{$_GET['item_id']}'",$connection);
	if(!result)
		die("Mysql query error ".mysql_error());
	$product = mysql_fetch_array($result);
	echo "<h3>Details of the product</h3>";
	echo "Name: <br />".$product['item_name']."<br /><br />";
	echo "Price: <br />".$product['price']."<br /><br />";
	echo "Description: <br />".$product['description']."<br /><br />";
	echo "Reason for selling: <br />".$product['reason']."<br /><br />";
	<br /><br />
	echo "<h3>Details of the seller</h3>";
	echo "Name Of The Seller: ".$product['fullname']."<br /><br />";
	echo "Email Id: ".$product['email']."<br /><br />";
	echo "Phone No.: ".$product['phoneno']."<br /><br />";
	echo "Hostel: ".$product['hostel']."<br /><br />";
	echo "Room No.: ".$product['roomno']."<br /><br />";
}

echo "<p style = 'color:red'>Caution: The info in this page is as provided by the seller and buynsell or Insti Webops have no responsibility over the quality of the products</p>";

?>