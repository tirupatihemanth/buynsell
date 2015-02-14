 <?php
	require_once 'functions.php';
	session_start ();
	sessionCheck ();
	$connectionObject = getConnection ();
	
	$resultObject = queryDB ( $connectionObject, "SELECT * from userinfo WHERE rollno = '{$_SESSION['user_rollno']}'" );
	$result = $resultObject->fetch_array ( MYSQLI_BOTH );
	
	if (! isset ( $_SESSION ['count'] )) {
		$result ['count'] ++;
		queryDB ( $connectionObject, "UPDATE userinfo SET count = {$result['count']} WHERE rollno = '{$_SESSION['user_rollno']}'" );
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
	require_once 'header.php';
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
	<p>We would like to Introduce to our all new news feed. This feed contans some important notifications such as comments on your posts and also private messages sent to you</p>
	<h3>Public comments on your posts</h3>';
	
	$pubcommentsObject = queryDB ( $connectionObject, "SELECT comments.user_com_id,comments.message,userinfo.rollno FROM items, comments, userinfo WHERE items.item_id = comments.item_id AND items.user_id = '{$result['id']}' AND userinfo.id = comments.user_com_id AND visibility = 1" );
	$rows = $pubcommentsObject->num_rows;
	if ($rows == 0) {
		echo "<span style = 'background-color:#f7f7f7'>Nothing to see here move along :)</span><br />";
	} else {
		for($i = 0; $i < $rows; $i ++) {
			$array = $pubcommentsObject->fetch_array ( MYSQL_BOTH );
			echo "<span>Sender: <a href='viewprofile.php?user_id=" . $array ['user_com_id'] . "'>" . $array ['rollno'] . "</a></span><br />";
			echo "<span style = 'background-color:yellow'>" . ($i + 1) . ". " . $array ['message'] . "</span><br /><br />";
		}
	}
	echo "<h3>Some private messages you have got</h3>";
	
	$privCommentsObject = queryDB ( $connectionObject, "SELECT comments.user_com_id, comments.message, userinfo.rollno FROM items, comments,userinfo WHERE items.item_id = comments.item_id AND user_id = '{$_SESSION['user_id']}' AND userinfo.id = comments.user_com_id AND visibility = 0" );
	$rows = $privCommentsObject->num_rows;
	if ($rows == 0) {
		echo "<span style = 'background-color:#f7f7f7'>Nothing to see here move along :)</span><br />";
	} else {
		for($i = 0; $i < $rows; $i ++) {
			$array = $privCommentsObject->fetch_array ( MYSQLI_BOTH );
			echo "<span>Sender: <a href='viewprofile.php?user_id=" . $array ['user_com_id'] . "'>" . $array ['rollno'] . "</a></span><br />";
			echo "<span style = 'background-color:yellow'>" . ($i + 1) . ". " . $array ['message'] . "</span><br />";
		}
	}
	$connectionObject->close ();
	echo '</div>
</body>
</html>';
	?>
