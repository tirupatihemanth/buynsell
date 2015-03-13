<html>
    <head>
	<link href="stylesheets/css_afterlogin.css" rel = "stylesheet" type = "text/css"/>
	<title>BUY&SELL@IITM</title>	
	<script src = "./ckeditor/ckeditor.js"></script>
    </head>
    <body> 
<?php
	require_once 'functions.php';
	session_start ();
	sessionCheck ();
	$connectionObject = getConnection ();
	
	$resultObject = queryDB ( $connectionObject, "SELECT * from userinfo WHERE rollno = '{$_SESSION['user_rollno']}'" );
	$result = $resultObject->fetch_array ( MYSQLI_BOTH );
	
	if (! isset ( $_SESSION ['count'] )) {
		$result ['count'] ++;
		queryDB ( $connectionObject, "UPDATE userinfo SET count = {$result['count']}, last_login=now() WHERE rollno = '{$_SESSION['user_rollno']}'" );
		$_SESSION ['count'] = $result ['count'];
	}
	
	$_SESSION ['user_id'] = $result ['id'];
	$_SESSION ['user_fullname'] = $result ['fullname'];
	
	if (strlen ( $result ['fullname'] ) == 0) {
		$_SESSION ['user_fullname'] = $_SESSION ['user_rollno'];
	}
	
	require_once 'dnb.html';
	
	
	echo '<div class="col-xs-10 col-xs-offset-1 container">';
if ($result ['fullname'] == "")
		echo "<br><div class='jumbotron'><h3>Welcome " . $_SESSION ['user_rollno']."<br></h3><br>We recommend updating your profile. You can do so from your profile settings at the top right corner.";
	else
		echo "<br><div class='jumbotron'><h3>Nice to see you again, " . $result ['fullname']."!</h3>";
echo '
	<h4>
	   This is Buy & Sell - IIT Madras
	</h4>
	<p>You have some unused products and would like to sell them It\'s simple now. Start by posting a new ad using the link above.</p>
	<p>You will also find your notifications below. This feed contans notifications such as comments on your posts and also private messages sent to you</p>
    <p> You can also access all your previous notifications here: <a href="viewAllMessages.php">All Comments</a></p>
    	<p>We thank you for joining our project and helping us in our efforts to make this a successful endeavor.</p>

    <p>Happy Hunting!</p></div>';
	
	echo '<div class="col-xs-10 col-xs-offset-1"><h3>Updates</h3><br><h4>New Comments:</h4>';
	
	$pubcommentsObject = queryDB ( $connectionObject, "SELECT comments.user_com_id,comments.message, comments.timestamp, comments.item_id, userinfo.rollno, items.item_name, userinfo.last_login FROM items, comments, userinfo WHERE items.item_id = comments.item_id AND items.user_id = '{$result['id']}' AND userinfo.id = comments.user_com_id AND visibility = 1 AND comments.timestamp> userinfo.last_login" );
	$rows = $pubcommentsObject->num_rows;
	if ($rows == 0) {
		echo "<span style = 'background-color:#f7f7f7'>You have no new updates</span><br />";
	} else {
		for($i = 0; $i < $rows; $i ++) {
			$array = $pubcommentsObject->fetch_array ( MYSQL_BOTH );
            echo "<div class='well well-sm comments'><a href='viewprofile.php?user_id=" . $array ['user_com_id'] . "'>" . $array ['rollno'] . "</a>  commented on your ad <a href = 'viewpost.php?item_id=".$array['item_id']."'>".$array['item_name']."</a><br>" . $array ['message'] . "<br><h5><small>at ".$array ['timestamp']."</small></h5></div>";
			
		}
	}
	echo "<h4>Private Messages (regarding your ads)</h4>";
	
	$privCommentsObject = queryDB ( $connectionObject, "SELECT comments.user_com_id, comments.message, userinfo.rollno, comments.item_id, items.item_name, comments.timestamp, userinfo.last_login FROM items, comments,userinfo WHERE items.item_id = comments.item_id AND items.user_id = '{$_SESSION['user_id']}' AND userinfo.id = comments.user_com_id AND visibility = 0 AND comments.timestamp > userinfo.last_login" );
	$rows = $privCommentsObject->num_rows;
	if ($rows == 0) {
		echo "<span style = 'background-color:#f7f7f7'>You have no new updates</span><br />";
	} else {
		for($i = 0; $i < $rows; $i ++) {
			$array = $privCommentsObject->fetch_array ( MYSQLI_BOTH );
			echo "<div class='well well-sm comments'><a href='viewprofile.php?user_id=" . $array ['user_com_id'] . "'>" . $array ['rollno'] . "</a>  enquired about <a href = 'viewpost.php?item_id=".$array['item_id']."'>".$array['item_name']."</a><br>" . $array ['message'] . "<br><h5><small>at ".$array ['timestamp']."</small></h5></div>";
		}
	}
	
	echo "<h4>Private Messages</h4>";
	
	$privMessagesObject = queryDB ( $connectionObject, "SELECT comments.user_com_id, comments.user_id, comments.message, userinfo.rollno, comments.timestamp, userinfo.last_login FROM comments,userinfo WHERE comments.item_id = -1 AND comments.user_id = '{$_SESSION['user_id']}' AND userinfo.id = comments.user_com_id AND visibility = 0 AND comments.timestamp > userinfo.last_login" );
	$rows = $privMessagesObject->num_rows;
	if ($rows == 0) {
		echo "<span style = 'background-color:#f7f7f7'>You have no new updates</span><br />";
	} else {
		for($i = 0; $i < $rows; $i ++) {
			$array = $privMessagesObject->fetch_array ( MYSQLI_BOTH );
			echo "<span>Sender: <a href='viewprofile.php?user_id=" . $array ['user_com_id'] . "'>" . $array ['rollno'] . "</a></span><br />";
			//echo "<span>Item: <a href = 'viewpost.php?item_id=".$array['item_id']."'>".$array['item_name']."</a></span><br />";
			echo "<span style = 'background-color:yellow'>" . ($i + 1) . ". " . $array ['message'] . "</span><br />";
		}
	}
	
	$connectionObject->close ();
	echo '</div></div>
</body>
</html>';
	?>
