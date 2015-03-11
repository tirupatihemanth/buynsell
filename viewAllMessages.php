<?php

require_once 'functions.php';
session_start();
sessionCheck();
$connectionObject = getConnection();
include "dnb.html";



echo "<h3>Public comments on all your posts</h3>";

	$pubcommentsObject = queryDB ( $connectionObject, "SELECT comments.user_com_id,comments.message, comments.timestamp, comments.item_id, userinfo.rollno, items.item_name, userinfo.last_login FROM items, comments, userinfo WHERE items.item_id = comments.item_id AND items.user_id = '{$_SESSION['user_id']}' AND userinfo.id = comments.user_com_id AND visibility = 1" );
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
echo "<h3>All private comments that the people have done on your posts</h3>";

$privCommentsObject = queryDB ( $connectionObject, "SELECT comments.user_com_id, comments.message, userinfo.rollno, comments.item_id, items.item_name, comments.timestamp, userinfo.last_login FROM items, comments,userinfo WHERE items.item_id = comments.item_id AND items.user_id = '{$_SESSION['user_id']}' AND userinfo.id = comments.user_com_id AND visibility = 0" );
$rows = $privCommentsObject->num_rows;
if ($rows == 0) {
	echo "<span style = 'background-color:#f7f7f7'>Nothing to see here move along :)</span><br />";
} else {
	for($i = 0; $i < $rows; $i ++) {
		$array = $privCommentsObject->fetch_array ( MYSQLI_BOTH );
		
		echo "<span>Sender: <a href='viewprofile.php?user_id=" . $array ['user_com_id'] . "'>" . $array ['rollno'] . "</a></span><br />";
		echo "<span>Item: <a href = 'viewpost.php?item_id=".$array['item_id']."'>".$array['item_name']."</a></span><br />";
		echo "<span style = 'background-color:yellow'>" . ($i + 1) . ". " . $array ['message'] . "</span><br /><br />";
	}
}

echo "<h3>Here's an exclusive list of all private messages that people have sent to you</h3>";

$privMessagesObject = queryDB ( $connectionObject, "SELECT comments.user_com_id, comments.user_id, comments.message, userinfo.rollno, comments.timestamp, userinfo.last_login FROM comments,userinfo WHERE comments.item_id = -1 AND comments.user_id = '{$_SESSION['user_id']}' AND userinfo.id = comments.user_com_id AND visibility = 0 " );
$rows = $privMessagesObject->num_rows;
if ($rows == 0) {
	echo "<span style = 'background-color:#f7f7f7'>Nothing to see here move along :)</span><br />";
} else {
	for($i = 0; $i < $rows; $i ++) {
		$array = $privMessagesObject->fetch_array ( MYSQLI_BOTH );
		echo "<span>Sender: <a href='viewprofile.php?user_id=" . $array ['user_com_id'] . "'>" . $array ['rollno'] . "</a></span><br />";
		echo "<span style = 'background-color:yellow'>" . ($i + 1) . ". " . $array ['message'] . "</span><br /><br />";
	}
}

$connectionObject->close ();

?>