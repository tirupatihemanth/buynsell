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
	
	echo '<html>
    <head>
	<link href="stylesheets/css_afterlogin.css" rel = "stylesheet" type = "text/css"/>
	<title>BUY&SELL@IITM</title>	
	<script src = "./ckeditor/ckeditor.js"></script>
    </head>
    <body>';
	require_once 'dnb.html';
	if ($result ['fullname'] == "")
		echo "<br /><br />BUYNSELL@IITM WELCOMES " . $_SESSION ['user_rollno'];
	else
		echo "BUYNSELL@IITM WELCOMES " . $result ['fullname'];
	
	echo '<div class="col-xs-8 col-xs-offset-2">
	<h4>
	    ...A Site For IITM Junta
	</h4>
	<p>We thank you for joining our project of making the Life At IITM more peaceful!!!</p>
	<p>You have some unused products and would like to sell them It\'s simple now.  Post Below:</p>
	<p>We would like to Introduce to our all new news feed. </p>
	<p>This feed contans some important notifications such as comments on your posts and also private messages sent to you, since your last login.</p>
	<p> All comments on your posts can be seen exclusively from here. <a href="viewAllMessages.php">All Comments</a></p>
	
	<h3>Public comments on your posts(Since Your Last Login)</h3>';
	
	$pubcommentsObject = queryDB ( $connectionObject, "SELECT comments.user_com_id,comments.message, comments.timestamp, comments.item_id, userinfo.rollno, items.item_name, userinfo.last_login FROM items, comments, userinfo WHERE items.item_id = comments.item_id AND items.user_id = '{$result['id']}' AND userinfo.id = comments.user_com_id AND visibility = 1 AND comments.timestamp> userinfo.last_login" );
	$rows = $pubcommentsObject->num_rows;
	if ($rows == 0) {
		echo "<span style = 'background-color:#f7f7f7'>Nothing to see here move along :)</span><br />";
	} else {
		for($i = 0; $i < $rows; $i ++) {
			$array = $pubcommentsObject->fetch_array ( MYSQL_BOTH );
			echo "<span>Sender: <a href = 'viewprofile.php?user_id=" . $array ['user_com_id'] . "'>" . $array ['rollno'] . "</a></span><br />";
			echo "<span>Item: <a href = 'viewpost.php?item_id=".$array['item_id']."'>".$array['item_name']."</a></span><br />";
			echo "<span style = 'background-color:yellow'>" . ($i + 1) . ". " . $array ['message'] . "</span><br /><br />";
		}
	}
	echo "<h3>Some private comments that the people have done on your posts(Since Your last Login)</h3>";
	
	$privCommentsObject = queryDB ( $connectionObject, "SELECT comments.user_com_id, comments.message, userinfo.rollno, comments.item_id, items.item_name, comments.timestamp, userinfo.last_login FROM items, comments,userinfo WHERE items.item_id = comments.item_id AND items.user_id = '{$_SESSION['user_id']}' AND userinfo.id = comments.user_com_id AND visibility = 0 AND comments.timestamp > userinfo.last_login" );
	$rows = $privCommentsObject->num_rows;
	if ($rows == 0) {
		echo "<span style = 'background-color:#f7f7f7'>Nothing to see here move along :)</span><br />";
	} else {
		for($i = 0; $i < $rows; $i ++) {
			$array = $privCommentsObject->fetch_array ( MYSQLI_BOTH );
			echo "<span>Sender: <a href='viewprofile.php?user_id=" . $array ['user_com_id'] . "'>" . $array ['rollno'] . "</a></span><br />";
			echo "<span>Item: <a href = 'viewpost.php?item_id=".$array['item_id']."'>".$array['item_name']."</a></span><br />";
			echo "<span style = 'background-color:yellow'>" . ($i + 1) . ". " . $array ['message'] . "</span><br />";
		}
	}
	
	echo "<h3>Here's an exclusive list of all private messages that people have sent to you(Since you last login)</h3>";
	
	$privMessagesObject = queryDB ( $connectionObject, "SELECT comments.user_com_id, comments.user_id, comments.message, userinfo.rollno, comments.timestamp, userinfo.last_login FROM comments,userinfo WHERE comments.item_id = -1 AND comments.user_id = '{$_SESSION['user_id']}' AND userinfo.id = comments.user_com_id AND visibility = 0 AND comments.timestamp > userinfo.last_login" );
	$rows = $privMessagesObject->num_rows;
	if ($rows == 0) {
		echo "<span style = 'background-color:#f7f7f7'>Nothing to see here move along :)</span><br />";
	} else {
		for($i = 0; $i < $rows; $i ++) {
			$array = $privMessagesObject->fetch_array ( MYSQLI_BOTH );
			echo "<span>Sender: <a href='viewprofile.php?user_id=" . $array ['user_com_id'] . "'>" . $array ['rollno'] . "</a></span><br />";
			//echo "<span>Item: <a href = 'viewpost.php?item_id=".$array['item_id']."'>".$array['item_name']."</a></span><br />";
			echo "<span style = 'background-color:yellow'>" . ($i + 1) . ". " . $array ['message'] . "</span><br />";
		}
	}
	
	$connectionObject->close ();
	echo '</div>
</body>
</html>';
	?>
